<?php

namespace App\Http\Controllers\Admin;


use App\Contracts\ImageContract;
use App\Contracts\ProductContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use JetBrains\PhpStorm\NoReturn;

class ProductController extends Controller
{
    /**
     * @var ProductContract
     */
    protected ProductContract $product;

    /**
     * @param ProductContract $product
     */
    public function __construct(ProductContract $product)
    {
        $this->product = $product;
    }

    public function index(): Response
    {
        $products = $this->product->findByFilter();
        return Inertia::render('products/index', compact('products'));
    }

    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        return Inertia::render('products/create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $this->product->new($data);

        session()->flash('toast', [
            'type' => 'success',
            'title' => 'Success!',
            'message' => __('messages.flash.create',['resource'=>'product']),
        ]);

        return Inertia::location(route('admin.products.index'));
    }

    public function edit($id)
    {
        $product = $this->product->setRelations(['category', 'attributes', 'images'])->findOneById($id);
        $inventories = $product->inventories;
        $inventories_values = collect([]);
        $attributes_values = [];
        foreach ($inventories as $inventory) {
            foreach ($inventory->attribute_values as $value) {
                $inventories_values->push($value);
            }
        }
        foreach ($product->attributes as $attribute) {
            $attributes_values[] = [
                'id' => $attribute->id,
                'values' => $attribute->attribute_values->map(function ($value) {
                    return [
                        'attribute_id' => $value->attribute_id,
                        'id' => $value->id,
                        'value' => $value->value
                    ];
                })->toArray()
            ];
        }


        $attributes = Attribute::whereNotIn('id', $product->attributes->pluck('id')->toArray())->get(['id', 'name']);
        $categories = Category::select('id', 'name')->get();
        return Inertia::render('products/edit', compact('product', 'categories', 'attributes'
            , 'attributes_values', 'inventories'));
    }

    public function update(UpdateProductRequest $request, $id): \Symfony\Component\HttpFoundation\Response
    {
        $this->product->update($id, $request->validated());

        session()->flash('toast', [
            'type' => 'success',
            'title' => 'Success!',
            'message' => __('messages.flash.update',['resource'=>'product']),
        ]);

        return Inertia::location(route('admin.products.edit', $id));
    }

    public function updateImages(UpdateImageRequest $request, $id, ImageContract $image)
    {
        $data = $request->validated();

        if (array_key_exists('deleted_images', $data)) {
            foreach ($data['deleted_images'] as $deletedImage) {
                Image::find($deletedImage['id'])->delete();
            }
        }

        foreach ($data['images'] as $oneImage) {
            $imageData['path'] = $oneImage;
            $imageData['product_id'] = $id;
            $image->new($imageData);
        }

        session()->flash('toast', [
            'type' => 'success',
            'title' => 'Success!',
            'message' => __('messages.flash.update',['resource'=>'product']),
        ]);

        return Inertia::location(route('admin.products.edit', $id));
    }

    public function attachAttribute($id, Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required',
        ]);
        $product = $this->product->findOneById($data['product_id']);
        $att = $product->attributes()->attach($id);
        return redirect()->back();
    }

    public
    function dettachAttribute($id, Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required', 'exists:products,id'
        ]);
        $product = $this->product->findOneById($data['product_id']);
        $product->attributes()->detach($id);
        return redirect()->back();
    }

    public
    function destroy($id)
    {
        $this->product->destroy($id);
        session()->flash('success', __('messages.flash.delete'));
    }
}
