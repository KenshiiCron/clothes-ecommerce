<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\CarouselContract;
use App\Http\Controllers\Controller;
use App\Models\Carousel;
use App\Http\Requests\StoreCarouselRequest;
use App\Http\Requests\UpdateCarouselRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CarouselController extends Controller
{
    /**
     * @var CarouselContract
     */
    protected CarouselContract $carousel;

    /**
     * @param CarouselContract $carousel
     */
    public function __construct(CarouselContract $carousel)
    {
        $this->carousel = $carousel;

//        $this->middleware(['permission:view-list-carousel'])->only(['index']);
//        $this->middleware(['permission:view-carousel'])->only(['show']);
//        $this->middleware(['permission:edit-carousel'])->only(['edit', 'update']);
//        $this->middleware(['permission:create-carousel'])->only(['create', 'store']);
//        $this->middleware(['permission:delete-carousel'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carousels = $this->carousel->findByFilter();
        return Inertia::render('carousels/index', compact('carousels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::select('id', 'name')->get();
        return Inertia::render('carousels/create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
        $data = $request->validated();
        $carousel = $this->carousel->new($data);
        return redirect()->route('admin.carousels.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Carousel $carousel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $carousel = $this->carousel->findOneById($id);
        $products = Product::select('id', 'name')->get();
        return Inertia::render('carousels/edit', compact('carousel', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarouselRequest $request, $id)
    {
        $carousel = $this->carousel->update($id, $request->validated());
        return redirect()->route('admin.carousels.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->carousel->destroy($id);
        session()->flash('success',__('messages.flash.delete'));
        return redirect()->route('admin.carousels.index');
    }
}
