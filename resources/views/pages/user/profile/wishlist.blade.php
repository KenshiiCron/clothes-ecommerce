

@extends('layouts.app')

@section('content')
    <div class="tf-page-title">
        <div class="container-full">
            <div class="heading text-center">My Wishlist</div>
        </div>
    </div>
    <!-- /page-title -->


    <section class="flat-spacing-11">
        <div class="container">
            <div class="row">
                <livewire:account-sidebar />
                <div class="col-lg-9">
                    <div class="my-account-content account-wishlist">
                        <h5 class="fw-5 mb_20">My Wishlist</h5>
                        <div class="grid-layout wrapper-shop" data-grid="grid-3">
                            @dump(auth()->user()->wishlist)
                            <!-- card product 1 -->
{{--                            <div class="card-product">--}}
{{--                                <div class="card-product-wrapper">--}}
{{--                                    <a href="product-detail.html" class="product-img">--}}
{{--                                        <img class="lazyload img-product" data-src="{{asset('assets/front/images/products/white-3.jpg')}}" src="{{asset('assets/front/images/products/white-3.jpg')}}" alt="image-product">--}}
{{--                                        <img class="lazyload img-hover" data-src="{{asset('assets/front/images/products/white-4.jpg')}}" src="{{asset('assets/front/images/products/white-4.jpg')}}" alt="image-product">--}}
{{--                                    </a>--}}
{{--                                    <div class="list-product-btn absolute-2">--}}
{{--                                        <a href="#quick_add" data-bs-toggle="modal" class="box-icon bg_white quick-add tf-btn-loading">--}}
{{--                                            <span class="icon icon-bag"></span>--}}
{{--                                            <span class="tooltip">Quick Add</span>--}}
{{--                                        </a>--}}
{{--                                        <a href="javascript:void(0);" class="box-icon bg_white wishlist btn-icon-action">--}}
{{--                                            <span class="icon icon-heart"></span>--}}
{{--                                            <span class="tooltip">Add to Wishlist</span>--}}
{{--                                            <span class="icon icon-delete"></span>--}}
{{--                                        </a>--}}
{{--                                        <a href="#compare" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft" class="box-icon bg_white compare btn-icon-action">--}}
{{--                                            <span class="icon icon-compare"></span>--}}
{{--                                            <span class="tooltip">Add to Compare</span>--}}
{{--                                            <span class="icon icon-check"></span>--}}
{{--                                        </a>--}}
{{--                                        <a href="#quick_view" data-bs-toggle="modal" class="box-icon bg_white quickview tf-btn-loading">--}}
{{--                                            <span class="icon icon-view"></span>--}}
{{--                                            <span class="tooltip">Quick View</span>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="card-product-info">--}}
{{--                                    <a href="product-detail.html" class="title link">Ribbed Tank Top</a>--}}
{{--                                    <span class="price">$16.95</span>--}}
{{--                                    <ul class="list-color-product">--}}
{{--                                        <li class="list-color-item color-swatch active">--}}
{{--                                            <span class="tooltip">Orange</span>--}}
{{--                                            <span class="swatch-value bg_orange-3"></span>--}}
{{--                                            <img class="lazyload" data-src="images/products/orange-1.jpg" src="images/products/orange-1.jpg" alt="image-product">--}}
{{--                                        </li>--}}
{{--                                        <li class="list-color-item color-swatch">--}}
{{--                                            <span class="tooltip">Black</span>--}}
{{--                                            <span class="swatch-value bg_dark"></span>--}}
{{--                                            <img class="lazyload" data-src="images/products/black-1.jpg" src="images/products/black-1.jpg" alt="image-product">--}}
{{--                                        </li>--}}
{{--                                        <li class="list-color-item color-swatch">--}}
{{--                                            <span class="tooltip">White</span>--}}
{{--                                            <span class="swatch-value bg_white"></span>--}}
{{--                                            <img class="lazyload" data-src="images/products/white-1.jpg" src="images/products/white-1.jpg" alt="image-product">--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </div>--}}



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="btn-sidebar-account">
        <button data-bs-toggle="offcanvas" data-bs-target="#mbAccount" aria-controls="offcanvas"><i class="icon icon-sidebar-2"></i></button>
    </div>
@endsection
