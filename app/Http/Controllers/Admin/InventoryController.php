<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\InventoryContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreInventoryRequest;
use App\Http\Requests\Admin\UpdateInventoryRequest;
use App\Models\Inventory;

class InventoryController extends Controller

{
    /**
     * @var InventoryContract
     */
    protected InventoryContract $inventory;

    /**
     * @param InventoryContract $inventory
     */
    public function __construct(InventoryContract $inventory)
    {
        $this->inventory = $inventory;
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInventoryRequest $request)
    {
        if(isset($request->values)){
           $values = $request->values;
        };
        unset($request['values']);
        $data = $request->validated();
        $inventory = $this->inventory->new($data);
        foreach ($values as $key => $value) {
            $inventory->attribute_values()->attach($value['id']);
        }
        $request->session()->flash('success', 'Product created successfully.');
        return redirect()->route('admin.products.edit',$inventory->product_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id,UpdateInventoryRequest $request)
    {
        if(isset($request->values)){
            $values = $request->values;
        };
        unset($request['values']);
        $data = $request->validated();
        $inventory = $this->inventory->update($id,$data);
        $inventory->attribute_values()->detach();
        foreach ($values as $key => $value) {
            $inventory->attribute_values()->attach($value['id']);
        }
        $request->session()->flash('success', 'Product created successfully.');
        return redirect()->route('admin.products.edit',$inventory->product_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->inventory->destroy($id);
        session()->flash('success',__('messages.flash.delete'));
    }
}
