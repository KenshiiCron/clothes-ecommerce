<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\ImageContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Models\Image;

class ImageController extends Controller
{
    /**
     * @var ImageContract
     */
    protected ImageContract $image;

    /**
     * @param ImageContract $image
     */
    public function __construct(ImageContract $image)
    {
        $this->image = $image;

        /**
         * Display a listing of the resource.
         */
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(StoreImageRequest $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreImageRequest $request)
    {
        $data = $request->validated();
        $this->image->new($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImageRequest $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        //
    }
}
