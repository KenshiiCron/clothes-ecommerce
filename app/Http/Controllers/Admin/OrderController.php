<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\OrderContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrdersRequest;
use App\Http\Requests\UpdateOrdersRequest;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Kossa\AlgerianCities\Wilaya;

class OrderController extends Controller
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

        $totalOrders = count($orders);
        $totalPending = count($orders->filter(function ($order) {
            return $order->state == 0;
        }));
        $totalConfirmed = count($orders->filter(function ($order) {
            return $order->state == 1;
        }));
        $totalCancelled = count($orders->filter(function ($order) {
            return $order->state == 2;
        }));
        $totalRejected = count($orders->filter(function ($order) {
            return $order->state == 3;
        }));
        return Inertia::render('orders/index', compact('orders', 'totalOrders','totalPending', 'totalConfirmed', 'totalCancelled', 'totalRejected'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $wilayas = wilayas();
        $communes = communes();
        return Inertia::render('orders/create',compact('users','wilayas','communes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrdersRequest $request)
    {
        $data = $request->validated();
        $this->order->new($data);
//        $msg = trans('static.words.yes');
//        dd($msg);
        session()->flash('toast', [
            'type' => 'success',
            'title' => 'Success!',
            'message' => __('messages.flash.create',['resource'=>'order']),
        ]);
        return Inertia::location(route('admin.orders.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = $this->order->findOneById($id)->load('orderItems.product');
        return Inertia::render('orders/show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $order = $this->order->findOneById($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found.'], 404);
        }
        $order->update([
            'state' => $request->state,
        ]);

        return response()->json(['message' => 'Order state updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->order->destroy($id);
        return redirect()->route('admin.orders.index');
    }
}
