<?php

namespace App\Http\Controllers\Admin;


use App\Contracts\ProductContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

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
        return Inertia::render('products/create',compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $this->product->new($data);
        $request->session()->flash('success', 'Product created successfully.');
        return redirect()->route('admin.products.index');
    }

    public function edit($id)
    {
        $product = $this->product->findOneById($id);
        $product_category = $product->category->only(['id', 'name']);
        $categories = Category::select('id', 'name')->get();
        return Inertia::render('products/edit', compact('product','product_category','categories'));
    }

    public function update(UpdateProductRequest $request, $id): \Illuminate\Http\RedirectResponse
    {
        $brand = $this->product->update($id, $request->validated());
        return redirect()->route('admin.products.index');
    }
}
