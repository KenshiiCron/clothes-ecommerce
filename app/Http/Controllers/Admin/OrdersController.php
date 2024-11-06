<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\CategoryContract;
use App\Contracts\OrderContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrdersRequest;
use App\Http\Requests\UpdateOrdersRequest;
use App\Models\Orders;
use Inertia\Inertia;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /**
     * @var OrderContract
     */
    protected OrderContract $order;

    public function __construct(OrderContract $order)
    {
        $this->order = $order;
    }
    public function index()
    {
        $orders = $this->order->findByFilter();
        return Inertia::render('orders/index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('orders/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrdersRequest $request)
    {
        $data = $request->validated();
        $this->order->new($data);
        return redirect()->route('admin.orders.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = $this->order->findOneById($id);
        return Inertia::render('orders/show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrdersRequest $request, Orders $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orders $orders)
    {
        //
    }
}
