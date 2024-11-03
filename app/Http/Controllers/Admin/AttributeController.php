<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\AttributeContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAttributeRequest;
use App\Http\Requests\Admin\UpdateAttributeRequest;
use App\Models\Attribute;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;



class AttributeController extends Controller
{

    /**
     * @var AttributeContract
     */
    protected AttributeContract $attribute;

    /**
     * @param AttributeContract $attribute
     */
    public function __construct(AttributeContract $attribute)
    {
        $this->attribute = $attribute;

        /**
         * Display a listing of the resource.
         */
    }
    public function index()
    {
        $attributes = $this->attribute->findByFilter();
        return Inertia::render('attributes/index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('attributes/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttributeRequest $request)
    {
        $data = $request->validated();
        $attribute = $this->attribute->new($data);
        return Inertia('attributes/index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attribute $attribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $attribute = $this->attribute->findOneById($id);
        $attribute_values = $attribute->attributeValues->toArray();
        return Inertia::render('attributes/edit',[
            'attribute' => $attribute,
            'attribute_values' => $attribute_values
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttributeRequest $request, $id)
    {
        $data = $request->validated();
        $attribute = $this->attribute->update($id, $data);
        return to_route('admin.attributes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attribute $attribute)
    {
        //
    }
}
