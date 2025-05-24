
@extends('layouts.app')

@section('content')
    <div class="tf-page-title">
        <div class="container-full">
            <div class="heading text-center">My Orders</div>
        </div>
    </div>
    <!-- /page-title -->

    <!-- page-cart -->
    <section class="flat-spacing-11">
        <div class="container">
            <div class="row">
                <livewire:account-sidebar />
                <div class="col-lg-9">
                    <div class="my-account-content account-order">
                        <h5 class="fw-5 mb_20">My Orders</h5>
                        <div class="wrap-account-order">
                            <table>
                                <thead>
                                <tr>
                                    <th class="fw-6">Order</th>
                                    <th class="fw-6">Date</th>
                                    <th class="fw-6">Status</th>
                                    <th class="fw-6">Total</th>
                                    <th class="fw-6">Actions</th>
                                </tr>
                                </thead>
                                @foreach($orders as $order)
                                <tbody x-data="{ open: false }">
                                <tr  class="tf-order-item">
                                    <td>
                                        #{{$order->order_number}}
                                    </td>
                                    <td>
                                        {{$order->created_at->translatedFormat('l, d F Y H:i')}}
                                    </td>
                                    <td>
                                        <span class="badge {{$order->state->color()}}">
                                        {{$order->state->label()}}
                                        </span>
                                    </td>
                                    <td>
                                        {{$order->total_price}}DA
                                    </td>
                                    <td >
                                        <button @click="open = !open" class="tf-btn btn-fill animate-hover-btn rounded-0 justify-content-center">
                                            <span>View</span>
                                        </button>
                                    </td>
                                </tr>
                                <tr x-show="open" x-transition.scale.origin.top x-cloak>
                                    <td colspan="5" class="bg-gray-50 p-4">
                                        <div>
                                                <table>
                                                    <thead>
                                                    <tr>
                                                        <th>Image</th>
                                                        <th>Name</th>
                                                        <th>Quantity</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>


                                                    @foreach($order->orderItems as $item)
                                                        <tr>
                                                           <td>
                                                               <img class="object-fit-cover" style="max-width: 100px; height: auto" src="{{$item->product->image_url}}" alt="">
                                                           </td>
                                                            <td>
                                                                {{$item->product->name}}
                                                            </td>
                                                            <td>
                                                                {{$item->pivot->qty}}
                                                            </td>
                                                            <td>
                                                                <a class="text-danger" href="{{route('products.show',$item->product->id)}}"><i class="icon icon-arrow1-top-left"></i></a>
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>

                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                                @endforeach

                            </table>
                            {{$orders->links()}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- page-cart -->


    <div class="btn-sidebar-account">
        <button data-bs-toggle="offcanvas" data-bs-target="#mbAccount" aria-controls="offcanvas"><i class="icon icon-sidebar-2"></i></button>
    </div>
@endsection
