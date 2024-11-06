<?php

namespace App\Http\Controllers\Admin;


use App\Contracts\ProductContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Models\Category;
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
}
