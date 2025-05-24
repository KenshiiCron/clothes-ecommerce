<!DOCTYPE html>
<html lang="en">
<head>
    {{-- Meta Tags --}}
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title',config('app.name'))</title>
    <meta name="description"
          content="{{config('settings.site_description')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name=“keywords”
          content="{{config('settings.seo_meta_keywords')}}">
    <meta name=“author” content="Algeorithme">
    <meta name="og:image" content="{{asset('assets/site/images/logos/logo.webp')}}">
    <meta name=“og:description”
          content="{{config('settings.site_description')}}">
    <meta name=“og:url” content="https://www.algeorithme.com">
    <meta name=“og:title” content="@yield('title',config('app.name'))">

    {{-- Favicon --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/site/images/logos/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('assets/site/images/logos/favicon.ico')}}">

    {{-- CSS Imports --}}
    <!-- font -->
    <link rel="stylesheet" href="{{asset('assets/front/fonts/fonts.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/fonts/font-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/front/css/styles.css')}}"/>


    {{-- CSS Imports --}}

    @stack('css')
    @livewireStyles
    {{--@viteReactRefresh
    @vite(['resources/views/js/app.jsx'])--}}
</head>

<body class="preload-wrapper">
    {{-- Preloader --}}
    <div class="preload preload-container">
        <div class="preload-logo">
            <div class="spinner"></div>
        </div>
    </div>
    {{-- Preloader --}}
    <div id="wrapper">

        @include('components.top-bar')

        @include('components.header')

        @yield('content')

        @include('components.footer')
    </div>

    <!-- gotop -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 286.138;"></path>
        </svg>
    </div>
    <!-- /gotop -->

    <!-- toolbar-bottom -->

    <!-- /toolbar-bottom -->



    <!-- mobile menu -->
    <div class="offcanvas offcanvas-start canvas-filter canvas-sidebar canvas-sidebar-account" id="mbAccount">
        <div class="canvas-wrapper">
            <header class="canvas-header">
                <span class="title">{{__('labels.fields.account')}}</span>
                <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
            </header>
            <div class="canvas-body sidebar-mobile-append"> </div>
        </div>
    </div>
    <div class="offcanvas offcanvas-start canvas-mb" id="mobileMenu">
        <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
        <div class="mb-canvas-content">
            <div class="mb-body">
                <ul class="nav-ul-mb" id="wrapper-menu-navigation">
                    <li class="nav-mb-item">
                        <a href="{{route('home')}}" class="collapsed mb-menu-link current"  aria-expanded="true" >
                            <span>{{__('labels.navigation.home')}}</span>
                        </a>
                    </li>
                    <li class="nav-mb-item">
                        <a href="{{route('shop')}}" class="collapsed mb-menu-link current"  aria-expanded="true" >
                            <span>{{__('labels.navigation.shop')}}</span>
                        </a>
                    </li>
                    <li class="nav-mb-item">
                        <a {{--href="{{route('contact')}}"--}} class="collapsed mb-menu-link current"  aria-expanded="true" >
                            <span>{{__('labels.navigation.contact')}}</span>
                        </a>
                    </li>
                    <li class="nav-mb-item">
                        <a {{--href="{{route('about')}}"--}} class="collapsed mb-menu-link current"  aria-expanded="true" >
                            <span>{{__('labels.navigation.about')}}</span>
                        </a>
                    </li>

                </ul>
                <div class="mb-other-content">
                    <div class="d-flex group-icon">
                        <a href="{{route('account.wishlist')}}" class="site-nav-icon"><i class="icon icon-heart"></i>{{__('labels.fields.wishlist')}}</a>
                    </div>
                    <ul class="mb-info">
                        <li>Address: 1234 Fashion Street, Suite 567, <br> New York, NY 10001</li>
                        <li>Email: <b>info@fashionshop.com</b></li>
                        <li>Phone: <b>(212) 555-1234</b></li>
                    </ul>
                </div>
            </div>
            <div class="mb-bottom">
                <a href="{{auth()->user() ? route('account.details') : route('login')}}" class="site-nav-icon"><i class="icon icon-account"></i>{{auth()->user() ?  __('labels.fields.profile') : __('labels.fields.login')}}</a>
                <div class="bottom-bar-language">
                    <div class="tf-currencies">
                        <select class="image-select center style-default type-currencies">
                            <option data-thumbnail="images/country/fr.svg">EUR <span>€ | France</span></option>
                            <option data-thumbnail="images/country/de.svg">EUR <span>€ | Germany</span></option>
                            <option selected data-thumbnail="images/country/us.svg">USD <span>$ | United States</span></option>
                            <option data-thumbnail="images/country/vn.svg">VND <span>₫ | Vietnam</span></option>
                        </select>
                    </div>
                    <div class="tf-languages">
                        <select class="image-select center style-default type-languages">
                            <option>English</option>
                            <option>العربية</option>
                            <option>简体中文</option>
                            <option>اردو</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /mobile menu -->
    <!-- canvasSearch -->
    <div class="offcanvas offcanvas-end canvas-search" id="canvasSearch">
        <div class="canvas-wrapper">
            <header class="tf-search-head">
                <div class="title fw-5">
                    Search our site
                    <div class="close">
                        <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
                    </div>
                </div>
                <div class="tf-search-sticky">
                    <form class="tf-mini-search-frm" action = '{{route('shop')}}'>
                        @csrf
                        <fieldset class="text">
                            <input type="text" placeholder="Search" class="" name="search" tabindex="0" value="{{request('search')}}" aria-required="true" required="">
                        </fieldset>
                        <button class="" type="submit"><i class="icon-search"></i></button>
                    </form>
                </div>
            </header>
            <div class="canvas-body p-0">
                <div class="tf-search-content">
                    <div class="tf-cart-hide-has-results">
                        <div class="tf-col-quicklink">
                            <div class="tf-search-content-title fw-5">Quick link</div>
                            <ul class="tf-quicklink-list">
                                @foreach($searchCategories as $categorie)
                                    <li class="tf-quicklink-item">
                                        <a href="{{route('shop',['category' => $categorie->id])}}">{{ucfirst($categorie->name)}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="tf-col-content">
                            <div class="tf-search-content-title fw-5">Need some inspiration?</div>
                            <div class="tf-search-hidden-inner">
                                <div class="tf-loop-item">
                                    <div class="image">
                                        <a href="product-detail.html">
                                            <img src="images/products/white-3.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="content">
                                        <a href="product-detail.html">Cotton jersey top</a>
                                        <div class="tf-product-info-price">
                                            <div class="compare-at-price">$10.00</div>
                                            <div class="price-on-sale fw-6">$8.00</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tf-loop-item">
                                    <div class="image">
                                        <a href="product-detail.html">
                                            <img src="images/products/white-2.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="content">
                                        <a href="product-detail.html">Mini crossbody bag</a>
                                        <div class="tf-product-info-price">
                                            <div class="price fw-6">$18.00</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tf-loop-item">
                                    <div class="image">
                                        <a href="product-detail.html">
                                            <img src="images/products/white-1.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="content">
                                        <a href="product-detail.html">Oversized Printed T-shirt</a>
                                        <div class="tf-product-info-price">
                                            <div class="price fw-6">$18.00</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /canvasSearch -->

    <!-- toolbarShopmb -->
    <div class="offcanvas offcanvas-start canvas-mb toolbar-shop-mobile" id="toolbarShopmb">
        <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
        <div class="mb-canvas-content">
            <div class="mb-body">
                <ul class="nav-ul-mb" id="wrapper-menu-navigation">
                    <li class="nav-mb-item">
                        <a href="shop-default.html" class="tf-category-link mb-menu-link">
                            <div class="image">
                                <img src="images/shop/cate/cate1.jpg" alt="">
                            </div>
                            <span>Accessories</span>
                        </a>
                    </li>
                    <li class="nav-mb-item">
                        <a href="shop-default.html" class="tf-category-link mb-menu-link">
                            <div class="image">
                                <img src="images/shop/cate/cate2.jpg" alt="">
                            </div>
                            <span>Dog</span>
                        </a>
                    </li>
                    <li class="nav-mb-item">
                        <a href="shop-default.html" class="tf-category-link mb-menu-link">
                            <div class="image">
                                <img src="images/shop/cate/cate3.jpg" alt="">
                            </div>
                            <span>Grocery</span>
                        </a>
                    </li>
                    <li class="nav-mb-item">
                        <a href="shop-default.html" class="tf-category-link mb-menu-link">
                            <div class="image">
                                <img src="images/shop/cate/cate4.png" alt="">
                            </div>
                            <span>Handbag</span>
                        </a>
                    </li>
                    <li class="nav-mb-item">
                        <a href="#cate-menu-one" class="tf-category-link has-children collapsed mb-menu-link" data-bs-toggle="collapse" aria-expanded="true" aria-controls="cate-menu-one">
                            <div class="image">
                                <img src="images/shop/cate/cate5.jpg" alt="">
                            </div>
                            <span>Fashion</span>
                            <span class="btn-open-sub"></span>
                        </a>
                        <div id="cate-menu-one" class="collapse list-cate">
                            <ul class="sub-nav-menu" id="cate-menu-navigation">
                                <li>
                                    <a href="#cate-shop-one" class="tf-category-link has-children sub-nav-link collapsed"  data-bs-toggle="collapse" aria-expanded="true" aria-controls="cate-shop-one">
                                        <div class="image">
                                            <img src="images/shop/cate/cate6.jpg" alt="">
                                        </div>
                                        <span>Mens</span>
                                        <span class="btn-open-sub"></span>
                                    </a>
                                    <div id="cate-shop-one" class="collapse">
                                        <ul class="sub-nav-menu sub-menu-level-2">
                                            <li>
                                                <a href="shop-default.html" class="tf-category-link sub-nav-link">
                                                    <div class="image">
                                                        <img src="images/shop/cate/cate1.jpg" alt="">
                                                    </div>
                                                    <span>Accessories</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="shop-default.html" class="tf-category-link sub-nav-link">
                                                    <div class="image">
                                                        <img src="images/shop/cate/cate8.jpg" alt="">
                                                    </div>
                                                    <span>Shoes</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="#cate-shop-two" class="tf-category-link has-children sub-nav-link collapsed"  data-bs-toggle="collapse" aria-expanded="true" aria-controls="cate-shop-two">
                                        <div class="image">
                                            <img src="images/shop/cate/cate9.jpg" alt="">
                                        </div>
                                        <span>Womens</span>
                                        <span class="btn-open-sub"></span>
                                    </a>
                                    <div id="cate-shop-two" class="collapse">
                                        <ul class="sub-nav-menu sub-menu-level-2">
                                            <li>
                                                <a href="shop-default.html" class="tf-category-link sub-nav-link">
                                                    <div class="image">
                                                        <img src="images/shop/cate/cate4.png" alt="">
                                                    </div>
                                                    <span>Handbag</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="shop-default.html" class="tf-category-link sub-nav-link">
                                                    <div class="image">
                                                        <img src="images/shop/cate/cate7.jpg" alt="">
                                                    </div>
                                                    <span>Tee</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-mb-item">
                        <a href="#cate-menu-two" class="tf-category-link has-children collapsed mb-menu-link" data-bs-toggle="collapse" aria-expanded="true" aria-controls="cate-menu-two">
                            <div class="image">
                                <img src="images/shop/cate/cate6.jpg" alt="">
                            </div>
                            <span>Men</span>
                            <span class="btn-open-sub"></span>
                        </a>
                        <div id="cate-menu-two" class="collapse list-cate">
                            <ul class="sub-nav-menu" id="cate-menu-navigation1">
                                <li>
                                    <a href="shop-default.html" class="tf-category-link sub-nav-link">
                                        <div class="image">
                                            <img src="images/shop/cate/cate1.jpg" alt="">
                                        </div>
                                        <span>Accessories</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="shop-default.html" class="tf-category-link sub-nav-link">
                                        <div class="image">
                                            <img src="images/shop/cate/cate8.jpg" alt="">
                                        </div>
                                        <span>Shoes</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-mb-item">
                        <a href="shop-default.html" class="tf-category-link mb-menu-link">
                            <div class="image">
                                <img src="images/shop/cate/cate7.jpg" alt="">
                            </div>
                            <span>Tee</span>
                        </a>
                    </li>
                    <li class="nav-mb-item">
                        <a href="shop-default.html" class="tf-category-link mb-menu-link">
                            <div class="image">
                                <img src="images/shop/cate/cate8.jpg" alt="">
                            </div>
                            <span>Shoes</span>
                        </a>
                    </li>
                    <li class="nav-mb-item">
                        <a href="#cate-menu-three" class="tf-category-link has-children collapsed mb-menu-link" data-bs-toggle="collapse" aria-expanded="true" aria-controls="cate-menu-three">
                            <div class="image">
                                <img src="images/shop/cate/cate9.jpg" alt="">
                            </div>
                            <span>Women</span>
                            <span class="btn-open-sub"></span>
                        </a>
                        <div id="cate-menu-three" class="collapse list-cate">
                            <ul class="sub-nav-menu" id="cate-menu-navigation2">
                                <li>
                                    <a href="shop-default.html" class="tf-category-link sub-nav-link">
                                        <div class="image">
                                            <img src="images/shop/cate/cate4.png" alt="">
                                        </div>
                                        <span>Handbag</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="shop-default.html" class="tf-category-link sub-nav-link">
                                        <div class="image">
                                            <img src="images/shop/cate/cate7.jpg" alt="">
                                        </div>
                                        <span>Tee</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="mb-bottom">
                <a href="shop-default.html" class="tf-btn fw-5 btn-line">View all collection<i class="icon icon-arrow1-top-left"></i></a>
            </div>
        </div>
    </div>
    <!-- /toolbarShopmb -->

    <!-- shoppingCart -->
    <!-- /shoppingCart -->

    <!-- modal compare -->
    <div class="offcanvas offcanvas-bottom canvas-compare" id="compare">
        <div class="canvas-wrapper">
            <header class="canvas-header">
                <div class="close-popup">
                    <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
                </div>
            </header>
            <div class="canvas-body">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="tf-compare-list">
                                <div class="tf-compare-head">
                                    <div class="title">Compare Products</div>
                                </div>
                                <div class="tf-compare-offcanvas">
                                    <div class="tf-compare-item">
                                        <div class="position-relative">
                                            <div class="icon">
                                                <i class="icon-close"></i>
                                            </div>
                                            <a href="product-detail.html">
                                                <img class="radius-3" src="images/products/orange-1.jpg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="tf-compare-item">
                                        <div class="position-relative">
                                            <div class="icon">
                                                <i class="icon-close"></i>
                                            </div>
                                            <a href="product-detail.html">
                                                <img class="radius-3" src="images/products/pink-1.jpg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tf-compare-buttons">
                                    <div class="tf-compare-buttons-wrap">
                                        <a href="compare.html" class="tf-btn radius-3 btn-fill justify-content-center fw-6 fs-14 flex-grow-1 animate-hover-btn ">Compare</a>
                                        <div class="tf-compapre-button-clear-all link">
                                            Clear All
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /modal compare -->
    <!-- modal quick_add -->
    <div class="modal fade modalDemo" id="quick_add">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="header">
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="wrap">
                    <div class="tf-product-info-item">
                        <div class="image">
                            <img src="images/products/orange-1.jpg" alt="">
                        </div>
                        <div class="content">
                            <a href="product-detail.html">Ribbed Tank Top</a>
                            <div class="tf-product-info-price">
                                <!-- <div class="price-on-sale">$8.00</div>
                                <div class="compare-at-price">$10.00</div>
                                <div class="badges-on-sale"><span>20</span>% OFF</div> -->
                                <div class="price">$18.00</div>
                            </div>
                        </div>
                    </div>
                    <div class="tf-product-info-variant-picker mb_15">
                        <div class="variant-picker-item">
                            <div class="variant-picker-label">
                                Color: <span class="fw-6 variant-picker-label-value">Orange</span>
                            </div>
                            <div class="variant-picker-values">
                                <input id="values-orange" type="radio" name="color" checked>
                                <label class="hover-tooltip radius-60" for="values-orange" data-value="Orange">
                                    <span class="btn-checkbox bg-color-orange"></span>
                                    <span class="tooltip">Orange</span>
                                </label>
                                <input id="values-black" type="radio" name="color">
                                <label class=" hover-tooltip radius-60" for="values-black" data-value="Black">
                                    <span class="btn-checkbox bg-color-black"></span>
                                    <span class="tooltip">Black</span>
                                </label>
                                <input id="values-white" type="radio" name="color">
                                <label class="hover-tooltip radius-60" for="values-white" data-value="White">
                                    <span class="btn-checkbox bg-color-white"></span>
                                    <span class="tooltip">White</span>
                                </label>
                            </div>
                        </div>
                        <div class="variant-picker-item">
                            <div class="variant-picker-label">
                                Size: <span class="fw-6 variant-picker-label-value">S</span>
                            </div>
                            <div class="variant-picker-values">
                                <input type="radio" name="size" id="values-s" checked>
                                <label class="style-text" for="values-s" data-value="S">
                                    <p>S</p>
                                </label>
                                <input type="radio" name="size" id="values-m">
                                <label class="style-text" for="values-m" data-value="M">
                                    <p>M</p>
                                </label>
                                <input type="radio" name="size" id="values-l">
                                <label class="style-text" for="values-l" data-value="L">
                                    <p>L</p>
                                </label>
                                <input type="radio" name="size" id="values-xl">
                                <label class="style-text" for="values-xl" data-value="XL">
                                    <p>XL</p>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="tf-product-info-quantity mb_15">
                        <div class="quantity-title fw-6">Quantity</div>
                        <div class="wg-quantity">
                            <span class="btn-quantity minus-btn">-</span>
                            <input type="text" name="number" value="1">
                            <span class="btn-quantity plus-btn">+</span>
                        </div>
                    </div>
                    <div class="tf-product-info-buy-button">
                        <form>
                            <a class="tf-btn btn-fill justify-content-center fw-6 fs-16 flex-grow-1 animate-hover-btn btn-add-to-cart"><span>Add to cart -&nbsp;</span><span class="tf-qty-price">$18.00</span></a>
                            <div class="tf-product-btn-wishlist btn-icon-action">
                                <i class="icon-heart"></i>
                                <i class="icon-delete"></i>
                            </div>
                            <a href="#compare" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft" class="tf-product-btn-wishlist box-icon bg_white compare btn-icon-action">
                                <span class="icon icon-compare"></span>
                                <span class="icon icon-check"></span>
                            </a>
                            <div class="w-100">
                                <a href="#" class="btns-full">Buy with <img src="images/payments/paypal.png" alt=""></a>
                                <a href="#" class="payment-more-option">More payment options</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /modal quick_add -->
    <!-- modal quick_view -->
    <div class="modal fade modalDemo" id="quick_view">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="header">
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="wrap">
                    <div class="tf-product-media-wrap">
                        <div dir="ltr" class="swiper tf-single-slide">
                            <div class="swiper-wrapper" >
                                <div class="swiper-slide">
                                    <div class="item">
                                        <img src="images/products/orange-1.jpg" alt="">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="item">
                                        <img src="images/products/pink-1.jpg" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-button-next button-style-arrow single-slide-prev"></div>
                            <div class="swiper-button-prev button-style-arrow single-slide-next"></div>
                        </div>
                    </div>
                    <div class="tf-product-info-wrap position-relative">
                        <div class="tf-product-info-list">
                            <div class="tf-product-info-title">
                                <h5><a class="link" href="product-detail.html">Ribbed Tank Top</a></h5>
                            </div>
                            <div class="tf-product-info-badges">
                                <div class="badges text-uppercase">Best seller</div>
                                <div class="product-status-content">
                                    <i class="icon-lightning"></i>
                                    <p class="fw-6">Selling fast! 48 people have this in their carts.</p>
                                </div>
                            </div>
                            <div class="tf-product-info-price">
                                <div class="price">$18.00</div>
                            </div>
                            <div class="tf-product-description">
                                <p>Nunc arcu faucibus a et lorem eu a mauris adipiscing conubia ac aptent ligula facilisis a auctor habitant parturient a a.Interdum fermentum.</p>
                            </div>
                            <div class="tf-product-info-variant-picker">
                                <div class="variant-picker-item">
                                    <div class="variant-picker-label">
                                        Color: <span class="fw-6 variant-picker-label-value">Orange</span>
                                    </div>
                                    <div class="variant-picker-values">
                                        <input id="values-orange-1" type="radio" name="color-1" checked>
                                        <label class="hover-tooltip radius-60" for="values-orange-1" data-value="Orange">
                                            <span class="btn-checkbox bg-color-orange"></span>
                                            <span class="tooltip">Orange</span>
                                        </label>
                                        <input id="values-black-1" type="radio" name="color-1">
                                        <label class=" hover-tooltip radius-60" for="values-black-1" data-value="Black">
                                            <span class="btn-checkbox bg-color-black"></span>
                                            <span class="tooltip">Black</span>
                                        </label>
                                        <input id="values-white-1" type="radio" name="color-1">
                                        <label class="hover-tooltip radius-60" for="values-white-1" data-value="White">
                                            <span class="btn-checkbox bg-color-white"></span>
                                            <span class="tooltip">White</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="variant-picker-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="variant-picker-label">
                                            Size: <span class="fw-6 variant-picker-label-value">S</span>
                                        </div>
                                        <div class="find-size btn-choose-size fw-6">Find your size</div>
                                    </div>
                                    <div class="variant-picker-values">
                                        <input type="radio" name="size-1" id="values-s-1" checked>
                                        <label class="style-text" for="values-s-1" data-value="S">
                                            <p>S</p>
                                        </label>
                                        <input type="radio" name="size-1" id="values-m-1">
                                        <label class="style-text" for="values-m-1" data-value="M">
                                            <p>M</p>
                                        </label>
                                        <input type="radio" name="size-1" id="values-l-1">
                                        <label class="style-text" for="values-l-1" data-value="L">
                                            <p>L</p>
                                        </label>
                                        <input type="radio" name="size-1" id="values-xl-1">
                                        <label class="style-text" for="values-xl-1" data-value="XL">
                                            <p>XL</p>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="tf-product-info-quantity">
                                <div class="quantity-title fw-6">Quantity</div>
                                <div class="wg-quantity">
                                    <span class="btn-quantity minus-btn">-</span>
                                    <input type="text" name="number" value="1">
                                    <span class="btn-quantity plus-btn">+</span>
                                </div>
                            </div>
                            <div class="tf-product-info-buy-button">
                                <form class="">
                                    <a href="javascript:void(0);" class="tf-btn btn-fill justify-content-center fw-6 fs-16 flex-grow-1 animate-hover-btn btn-add-to-cart"><span>Add to cart -&nbsp;</span><span class="tf-qty-price">$8.00</span></a>
                                    <a href="javascript:void(0);" class="tf-product-btn-wishlist hover-tooltip box-icon bg_white wishlist btn-icon-action">
                                        <span class="icon icon-heart"></span>
                                        <span class="tooltip">Add to Wishlist</span>
                                        <span class="icon icon-delete"></span>
                                    </a>
                                    <a href="#compare" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft" class="tf-product-btn-wishlist hover-tooltip box-icon bg_white compare btn-icon-action">
                                        <span class="icon icon-compare"></span>
                                        <span class="tooltip">Add to Compare</span>
                                        <span class="icon icon-check"></span>
                                    </a>
                                    <div class="w-100">
                                        <a href="#" class="btns-full">Buy with <img src="images/payments/paypal.png" alt=""></a>
                                        <a href="#" class="payment-more-option">More payment options</a>
                                    </div>
                                </form>
                            </div>
                            <div>
                                <a href="product-detail.html" class="tf-btn fw-6 btn-line">View full details<i class="icon icon-arrow1-top-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /modal quick_view -->
    <!-- modal find_size -->
    <div class="modal fade modalDemo tf-product-modal" id="find_size">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="header">
                    <div class="demo-title">Size chart</div>
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="tf-rte">
                    <div class="tf-table-res-df">
                        <h6>Size guide</h6>
                        <table class="tf-sizeguide-table">
                            <thead>
                            <tr>
                                <th>Size</th>
                                <th>US</th>
                                <th>Bust</th>
                                <th>Waist</th>
                                <th>Low Hip</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>XS</td>
                                <td>2</td>
                                <td>32</td>
                                <td>24 - 25</td>
                                <td>33 - 34</td>
                            </tr>
                            <tr>
                                <td>S</td>
                                <td>4</td>
                                <td>34 - 35</td>
                                <td>26 - 27</td>
                                <td>35 - 26</td>
                            </tr>
                            <tr>
                                <td>M</td>
                                <td>6</td>
                                <td>36 - 37</td>
                                <td>28 - 29</td>
                                <td>38 - 40</td>
                            </tr>
                            <tr>
                                <td>L</td>
                                <td>8</td>
                                <td>38 - 29</td>
                                <td>30 - 31</td>
                                <td>42 - 44</td>
                            </tr>
                            <tr>
                                <td>XL</td>
                                <td>10</td>
                                <td>40 - 41</td>
                                <td>32 - 33</td>
                                <td>45 - 47</td>
                            </tr>
                            <tr>
                                <td>XXL</td>
                                <td>12</td>
                                <td>42 - 43</td>
                                <td>34 - 35</td>
                                <td>48 - 50</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tf-page-size-chart-content">
                        <div>
                            <h6>Measuring Tips</h6>
                            <div class="title">Bust</div>
                            <p>Measure around the fullest part of your bust.</p>
                            <div class="title">Waist</div>
                            <p>Measure around the narrowest part of your torso.</p>
                            <div class="title">Low Hip</div>
                            <p class="mb-0">With your feet together measure around the fullest part of your hips/rear.
                            </p>
                        </div>
                        <div>
                            <img class="sizechart lazyload" data-src="images/shop/products/size_chart2.jpg" src="images/shop/products/size_chart2.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /modal find_size -->
    <!-- auto popup  -->
    <div class="modal modalCentered fade auto-popup modal-newleter">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-top">
                    <img class="lazyload" data-src="images/item/banner-newleter.jpg" src="images/item/banner-newleter.jpg" alt="home-01">
                    <span class="icon icon-close btn-hide-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="modal-bottom">
                    <h4 class="text-center">Don’t mis out</h4>
                    <h6 class="text-center">Be the first one to get the new product at early bird prices.</h6>
                    <form id="subscribe-form" action="#" class="form-newsletter" method="post" accept-charset="utf-8" data-mailchimp="true">
                        <div id="subscribe-content">
                            <input type="email" name="email-form" id="subscribe-email" placeholder="Email *">
                            <button type="button" id="subscribe-button" class="tf-btn btn-fill radius-3 animate-hover-btn w-100 justify-content-center">Keep me updated</button>
                        </div>
                        <div id="subscribe-msg"></div>
                    </form>
                    <div class="text-center">
                        <a href="#" data-bs-dismiss="modal" class="tf-btn btn-line fw-6 btn-hide-popup">Not interested</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /auto popup  -->


{{-- Javascript Imports --}}
<script type="text/javascript" src="{{asset('assets/front/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/swiper-bundle.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/carousel.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/bootstrap-select.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/lazysize.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/count-down.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/wow.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/multiple-modal.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/main.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2-theme-bootstrap-4@4"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Javascript Imports --}}

@stack('js')
@livewireScripts
<script>
    let Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 3000,
        customClass: {
            popup: "my-custom-popup",
            title: "my-custom-title",
        },
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });


    @if(session()->has('success'))
    Toast.fire({
        icon: 'success',
        title: '{{__('messages.flash.success')}}',
        text: '{{session()->get('success')}}'
    })
    @endif

    @if(session()->has('error'))
    Toast.fire({
        icon: 'error',
        title: '{{__('messages.flash.error')}}',
        text: '{{session()->get('error')}}'
    })
    @endif
    Livewire.on('swal-toast', (event) => {
        console.log(event)
        Toast.fire({
            icon: event[0].icon,
            title: event[0].title,
            text: event[0].text
        });
    });
</script>
<script>
    import Alpine from 'alpinejs'

    window.Alpine = Alpine

    Alpine.start()
</script>
</body>
</html>

