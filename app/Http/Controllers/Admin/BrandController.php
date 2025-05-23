<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\BrandContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BrandController extends Controller
{
    /**
     * @var BrandContract
     */
    protected BrandContract $brand;

    /**
     * @param BrandContract $brand
     */
    public function __construct(BrandContract $brand)
    {
        $this->brand = $brand;

//        $this->middleware(['permission:view-list-brand'])->only(['index']);
//        $this->middleware(['permission:view-brand'])->only(['show']);
//        $this->middleware(['permission:edit-brand'])->only(['edit', 'update']);
//        $this->middleware(['permission:create-brand'])->only(['create', 'store']);
//        $this->middleware(['permission:delete-brand'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = $this->brand->findByFilter();
        return Inertia::render('brands/index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('brands/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        $this->brand->new($request->validated());
        return redirect()->route('admin.brands.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $brand = $this->brand->findOneById($id);
        return Inertia::render('brands/show',compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $brand = $this->brand->findOneById($id);
        return Inertia::render('brands/edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, $id): \Illuminate\Http\RedirectResponse
    {
        $this->brand->update($id, $request->validated());
        return redirect()->route('admin.brands.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->brand->destroy($id);
        session()->flash('success',__('messages.flash.delete'));
        return redirect()->route('admin.brands.index');
    }
}
