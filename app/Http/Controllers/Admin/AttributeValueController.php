<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\AttributeValueContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAttributeValueRequest;
use App\Http\Requests\Admin\UpdateAttributeValueRequest;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;



class AttributeValueController extends Controller
{

    /**
     * @var AttributeValueContract
     */
    protected AttributeValueContract $attribute_value;

    /**
     * @param AttributeValueContract $attribute_value
     */
    public function __construct(AttributeValueContract $attribute_value)
    {
        $this->attribute_value = $attribute_value;

        /**
         * Display a listing of the resource.
         */
    }
    public function index()
    {
        //$attribute_values = $this->attribute_value->findByFilter();
        //return Inertia::render('attribute_values/index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //return Inertia::render('attributes/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttributeValueRequest $request)
    {
        $data = $request->validated();
        $attribute = $this->attribute_value->new($data);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     */
    public function show(AttributeValue $attribute)
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
    public function update(UpdateAttributeValueRequest $request, $id)
    {
        $data = $request->validated();
        $this->attribute_value->update($id, $data);
        return to_route('admin.attribute-values.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AttributeValue $attribute)
    {
        //
    }
}
