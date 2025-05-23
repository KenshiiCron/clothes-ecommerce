@extends('layouts.app')

@section('content')
    <!-- Slider -->
    <div class="tf-slideshow slider-effect-fade position-relative">
        <div dir="ltr" class="swiper tf-sw-slideshow" data-preview="1" data-tablet="1" data-mobile="1"
             data-centered="false" data-space="0" data-loop="true" data-auto-play="false" data-delay="0"
             data-speed="1000">
            <div class="swiper-wrapper">
                @foreach($carousels as $carousel)
                    <div class="swiper-slide">
                        <div class="wrap-slider">
                            <img src="{{$carousel->image_url}}"
                                 alt="fashion-slideshow"
                            >
                            <div class="box-content">
                                <div class="container">
                                    @if($carousel->type != \App\Enums\Carousel\Type::NOTHING)
                                        <h1 class="fade-item fade-item-1">{{$carousel->name}}</h1>
                                    @endif
                                    <p class="fade-item fade-item-2">{{$carousel->description}}</p>
                                    @if($carousel->type == \App\Enums\Carousel\Type::LINK)
                                        <a href="{{$carousel->lihk}}"
                                           class="fade-item fade-item-3 tf-btn btn-fill animate-hover-btn btn-xl radius-3"><span>Shop collection</span><i
                                                class="icon icon-arrow-right"></i></a>
                                    @elseif($carousel->type == \App\Enums\Carousel\Type::PRODUCT)
                                        <a href="{{route('products.show', $carousel->product_id)}}"
                                           class="fade-item fade-item-3 tf-btn btn-fill animate-hover-btn btn-xl radius-3"><span>Shop collection</span><i
                                                class="icon icon-arrow-right"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="wrap-pagination">
            <div class="container">
                <div class="sw-dots sw-pagination-slider justify-content-center"></div>
            </div>
        </div>
    </div>
    <!-- /Slider -->
    <!-- Marquee -->
    <div class="tf-marquee bg_yellow-2">
        <div class="wrap-marquee">
            <div class="marquee-item">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="" width="15" height="20" viewBox="0 0 15 20">
                        <path d="M14.5833 8H8.61742L9.94318 0L0 12H5.96591L4.64015 20L14.5833 8"></path>
                    </svg>
                </div>
                <p class="text">Spring Clearance Event: Save Up to 70%</p>
            </div>
            <div class="marquee-item">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="" width="15" height="20" viewBox="0 0 15 20">
                        <path d="M14.5833 8H8.61742L9.94318 0L0 12H5.96591L4.64015 20L14.5833 8"></path>
                    </svg>
                </div>
                <p class="text">Spring Clearance Event: Save Up to 70%</p>
            </div>
            <div class="marquee-item">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="" width="15" height="20" viewBox="0 0 15 20">
                        <path d="M14.5833 8H8.61742L9.94318 0L0 12H5.96591L4.64015 20L14.5833 8"></path>
                    </svg>
                </div>
                <p class="text">Spring Clearance Event: Save Up to 70%</p>
            </div>
            <div class="marquee-item">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="" width="15" height="20" viewBox="0 0 15 20">
                        <path d="M14.5833 8H8.61742L9.94318 0L0 12H5.96591L4.64015 20L14.5833 8"></path>
                    </svg>
                </div>
                <p class="text">Spring Clearance Event: Save Up to 70%</p>
            </div>
            <div class="marquee-item">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="" width="15" height="20" viewBox="0 0 15 20">
                        <path d="M14.5833 8H8.61742L9.94318 0L0 12H5.96591L4.64015 20L14.5833 8"></path>
                    </svg>
                </div>
                <p class="text">Spring Clearance Event: Save Up to 70%</p>
            </div>
            <div class="marquee-item">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="" width="15" height="20" viewBox="0 0 15 20">
                        <path d="M14.5833 8H8.61742L9.94318 0L0 12H5.96591L4.64015 20L14.5833 8"></path>
                    </svg>
                </div>
                <p class="text">Spring Clearance Event: Save Up to 70%</p>
            </div>
            <div class="marquee-item">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="" width="15" height="20" viewBox="0 0 15 20">
                        <path d="M14.5833 8H8.61742L9.94318 0L0 12H5.96591L4.64015 20L14.5833 8"></path>
                    </svg>
                </div>
                <p class="text">Spring Clearance Event: Save Up to 70%</p>
            </div>
            <div class="marquee-item">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="" width="15" height="20" viewBox="0 0 15 20">
                        <path d="M14.5833 8H8.61742L9.94318 0L0 12H5.96591L4.64015 20L14.5833 8"></path>
                    </svg>
                </div>
                <p class="text">Spring Clearance Event: Save Up to 70%</p>
            </div>
            <div class="marquee-item">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="" width="15" height="20" viewBox="0 0 15 20">
                        <path d="M14.5833 8H8.61742L9.94318 0L0 12H5.96591L4.64015 20L14.5833 8"></path>
                    </svg>
                </div>
                <p class="text">Spring Clearance Event: Save Up to 70%</p>
            </div>
            <div class="marquee-item">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="" width="15" height="20" viewBox="0 0 15 20">
                        <path d="M14.5833 8H8.61742L9.94318 0L0 12H5.96591L4.64015 20L14.5833 8"></path>
                    </svg>
                </div>
                <p class="text">Spring Clearance Event: Save Up to 70%</p>
            </div>
        </div>

    </div>
    <!-- /Marquee -->
    <!-- Categories -->
    <section class="flat-spacing-4 flat-categorie">
        <div class="container-full">
            <div class="flat-title-v2">
                <div class="box-sw-navigation">
                    <div class="nav-sw nav-next-slider nav-next-collection"><span class="icon icon-arrow-left"></span>
                    </div>
                    <div class="nav-sw nav-prev-slider nav-prev-collection"><span class="icon icon-arrow-right"></span>
                    </div>
                </div>
                <span class="text-3 fw-7 text-uppercase title wow fadeInUp"
                      data-wow-delay="0s">{{trans_choice('labels.models.category', 2)}}</span>
            </div>
            <div class="row">
                <div class="col-12">
                    <div dir="ltr" class="swiper tf-sw-collection" data-preview="5" data-tablet="3" data-mobile="2"
                         data-space-lg="30" data-space-md="30" data-space="15" data-loop="false" data-auto-play="false">
                        <div class="swiper-wrapper">
                            @foreach($categories as $category)
                                <div class="swiper-slide" lazy="true">
                                    <div class="collection-item style-left hover-img">
                                        <div class="collection-inner">
                                            <a href="{{route('shop')}}?category={{$category->slug}}" class="collection-image img-style">
                                                <img class="lazyload"
                                                     data-src="{{$category->image_url}}"
                                                     src="{{$category->image_url}}"
                                                     height="690"
                                                     width="690"
                                                     style="object-fit: cover; aspect-ratio: 1"
                                                     alt="collection-img">
                                            </a>
                                            <div class="collection-content">
                                                <a href="{{route('shop')}}?category={{$category->slug}}"
                                                   class="tf-btn collection-title hover-icon fs-15"><span>{{$category->name}}</span><i
                                                        class="icon icon-arrow1-top-left"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                {{--                <div class="col-xl-3 col-lg-4 col-md-4">--}}
                {{--                    <div class="discovery-new-item">--}}
                {{--                        <h5>Discovery all new items</h5>--}}
                {{--                        <a href="shop-collection-list.html"><i class="icon-arrow1-top-left"></i></a>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>

        </div>
    </section>
    <!-- /Categories -->
    <!-- Seller -->
    <section class="flat-spacing-5 pt_0 flat-seller">
        <div class="container">
            <div class="flat-title">
                <span class="title wow fadeInUp" data-wow-delay="0s">Best Seller</span>
                <p class="sub-title wow fadeInUp" data-wow-delay="0s">Shop the Latest Styles: Stay ahead of the curve
                    with our newest arrivals</p>
            </div>
            <div class="grid-layout loadmore-item wow fadeInUp" data-wow-delay="0s" data-grid="grid-4">
                @foreach($featuredProducts as $product)
                    @include('components.product-card', $product)
                @endforeach

            </div>
            <div class="tf-pagination-wrap view-more-button text-center">
                <button class="tf-btn-loading tf-loading-default style-2 btn-loadmore "><span
                        class="text">Load more</span></button>
            </div>
        </div>
    </section>
    <!-- /Seller -->
    <!-- Lookbook -->
    <section class="flat-spacing-6">
        <div class="flat-title wow fadeInUp" data-wow-delay="0s">
            <span class="title">Shop the look</span>
            <p class="sub-title">Inspire and let yourself be inspired, from one unique fashion to another.</p>
        </div>
        <div dir="ltr" class="swiper tf-sw-lookbook" data-preview="2" data-tablet="2" data-mobile="1" data-space-lg="0"
             data-space-md="0">
            <div class="swiper-wrapper">
                <div class="swiper-slide" lazy="true">
                    <div class="wrap-lookbook lookbook-1">
                        <div class="image">
                            <img class="lazyload" data-src="{{asset('assets/front/images/shop/file/lookbook-3.jpg')}}"
                                 src="{{asset('assets/front/images/shop/file/lookbook-3.jpg')}}" alt="image-lookbook">
                        </div>
                        <div class="lookbook-item item-1">
                            <div class="inner">
                                <div class="btn-group dropdown dropup dropdown-center">
                                    <button class="tf-pin-btn" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span></span>
                                    </button>
                                    <ul class="dropdown-menu p-0 border-0">
                                        <li>
                                            <div class="lookbook-product">
                                                <a href="product-detail.html" class="image">
                                                    <img class="lazyload"
                                                         data-src="{{asset('assets/front/images/shop/products/img-p2.png')}}')}}"
                                                         src="{{asset('assets/front/images/shop/products/img-p2.png')}}"
                                                         alt="lookbook-item">
                                                </a>
                                                <div class="content-wrap">
                                                    <div class="product-title">
                                                        <a href="#">Jersey thong body</a>
                                                    </div>
                                                    <div class="price">$112.00</div>
                                                </div>
                                                <a href="#quick_view" data-bs-toggle="modal" class=""><i
                                                        class="icon-view"></i></a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="lookbook-item item-2">
                            <div class="inner">
                                <div class="btn-group dropdown dropup dropdown-center">
                                    <button class="tf-pin-btn" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span></span>
                                    </button>
                                    <ul class="dropdown-menu p-0 border-0">
                                        <li>
                                            <div class="lookbook-product">
                                                <a href="product-detail.html" class="image">
                                                    <img class="lazyload"
                                                         data-src="{{asset('assets/front/images/shop/products/img-p4.png')}}"
                                                         src="{{asset('assets/front/images/shop/products/img-p4.png')}}"
                                                         alt="">
                                                </a>
                                                <div class="content-wrap">
                                                    <div class="product-title">
                                                        <a href="#">Ribbed modal T-shirt</a>
                                                    </div>
                                                    <div class="price">$20.00</div>
                                                </div>
                                                <a href="#quick_view" data-bs-toggle="modal" class=""><i
                                                        class="icon-view"></i></a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide" lazy="true">
                    <div class="wrap-lookbook lookbook-2">
                        <div class="image">
                            <img class="lazyload" data-src="{{asset('assets/front/images/shop/file/lookbook-4.jpg')}}"
                                 src="{{asset('assets/front/images/shop/file/lookbook-4.jpg')}}" alt="image-lookbook">
                        </div>
                        <div class="lookbook-item item-1">
                            <div class="inner">
                                <div class="btn-group dropdown dropup dropdown-center">
                                    <button class="tf-pin-btn" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span></span>
                                    </button>
                                    <ul class="dropdown-menu p-0 border-0">
                                        <li>
                                            <div class="lookbook-product">
                                                <a href="product-detail.html" class="image">
                                                    <img class="lazyload"
                                                         data-src="{{asset('assets/front/images/shop/products/img-p5.png')}}"
                                                         src="{{asset('assets/front/images/shop/products/img-p5.png')}}"
                                                         alt="">
                                                </a>
                                                <div class="content-wrap">
                                                    <div class="product-title">
                                                        <a href="#">Ribbed Tank Top</a>
                                                    </div>
                                                    <div class="price">$20.00</div>
                                                </div>
                                                <a href="#quick_view" data-bs-toggle="modal" class=""><i
                                                        class="icon-view"></i></a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wrap-pagination">
                <div class="container-full">
                    <div class="sw-dots sw-pagination-lookbook justify-content-center"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Lookbook -->
    <!-- Testimonial -->
    <section class="flat-spacing-5 pt_0 flat-testimonial">
        <div class="container">
            <div class="flat-title wow fadeInUp" data-wow-delay="0s">
                <span class="title">Happy Clients</span>
                <p class="sub-title">Hear what they say about us</p>
            </div>
            <div class="wrap-carousel">
                <div dir="ltr" class="swiper tf-sw-testimonial" data-preview="3" data-tablet="2" data-mobile="1"
                     data-space-lg="30" data-space-md="15">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="testimonial-item style-column wow fadeInUp" data-wow-delay="0s">
                                <div class="rating">
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                </div>
                                <div class="heading">Best Online Fashion Site</div>
                                <div class="text">
                                    “ I always find something stylish and affordable on this web fashion site ”
                                </div>
                                <div class="author">
                                    <div class="name">Robert smith</div>
                                    <div class="metas">Customer from USA</div>
                                </div>
                                <div class="product">
                                    <div class="image">
                                        <a href="product-detail.html">
                                            <img class="lazyload"
                                                 data-src="{{asset('assets/front/images/shop/products/img-p2.png')}}"
                                                 src="{{asset('assets/front/images/shop/products/img-p2.png')}}" alt="">
                                        </a>
                                    </div>
                                    <div class="content-wrap">
                                        <div class="product-title">
                                            <a href="product-detail.html">Jersey thong body</a>
                                        </div>
                                        <div class="price">$105.95</div>
                                    </div>
                                    <a href="product-detail.html" class=""><i class="icon-arrow1-top-left"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial-item style-column wow fadeInUp" data-wow-delay=".1s">
                                <div class="rating">
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                </div>
                                <div class="heading">Great Selection and Quality</div>
                                <div class="text">
                                    "I love the variety of styles and the high-quality clothing on this web fashion
                                    site."
                                </div>
                                <div class="author">
                                    <div class="name">Allen Lyn</div>
                                    <div class="metas">Customer from France</span></div>
                                </div>
                                <div class="product">
                                    <div class="image">
                                        <a href="product-detail.html">
                                            <img class="lazyload"
                                                 data-src="{{asset('assets/front/images/shop/products/img-p3.png')}}"
                                                 src="{{asset('assets/front/images/shop/products/img-p3.png')}}" alt="">
                                        </a>
                                    </div>
                                    <div class="content-wrap">
                                        <div class="product-title">
                                            <a href="product-detail.html">Cotton jersey top</a>
                                        </div>
                                        <div class="price">$7.95</div>
                                    </div>
                                    <a href="product-detail.html" class=""><i class="icon-arrow1-top-left"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial-item style-column wow fadeInUp" data-wow-delay=".2s">
                                <div class="rating">
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                </div>
                                <div class="heading">Best Customer Service</div>
                                <div class="text">
                                    "I finally found a web fashion site with stylish and flattering options in my size."
                                </div>
                                <div class="author">
                                    <div class="name">Peter Rope</div>
                                    <div class="metas">Customer from USA</div>
                                </div>
                                <div class="product">
                                    <div class="image">
                                        <a href="product-detail.html">
                                            <img class="lazyload"
                                                 data-src="{{asset('assets/front/images/shop/products/img-p4.png')}}"
                                                 src="{{asset('assets/front/images/shop/products/img-p4.png')}}" alt="">
                                        </a>
                                    </div>
                                    <div class="content-wrap">
                                        <div class="product-title">
                                            <a href="product-detail.html">Ribbed modal T-shirt</a>
                                        </div>
                                        <div class="price">From $18.95</div>
                                    </div>
                                    <a href="product-detail.html" class=""><i class="icon-arrow1-top-left"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial-item style-column wow fadeInUp" data-wow-delay=".3s">
                                <div class="rating">
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                </div>
                                <div class="heading">Great Selection and Quality</div>
                                <div class="text">
                                    "I love the variety of styles and the high-quality clothing on this web fashion
                                    site."
                                </div>
                                <div class="author">
                                    <div class="name">Hellen Ase</div>
                                    <div class="metas">Customer from Japan</span></div>
                                </div>
                                <div class="product">
                                    <div class="image">
                                        <a href="product-detail.html">
                                            <img class="lazyload"
                                                 data-src="{{asset('assets/front/images/shop/products/img-p5.png')}}"
                                                 src="{{asset('assets/front/images/shop/products/img-p5.png')}}" alt="">
                                        </a>
                                    </div>
                                    <div class="content-wrap">
                                        <div class="product-title">
                                            <a href="product-detail.html">Customer from Japan</a>
                                        </div>
                                        <div class="price">$16.95</div>
                                    </div>
                                    <a href="product-detail.html" class=""><i class="icon-arrow1-top-left"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nav-sw nav-next-slider nav-next-testimonial lg"><span class="icon icon-arrow-left"></span>
                </div>
                <div class="nav-sw nav-prev-slider nav-prev-testimonial lg"><span class="icon icon-arrow-right"></span>
                </div>
                <div class="sw-dots style-2 sw-pagination-testimonial justify-content-center"></div>
            </div>
        </div>
    </section>
    <!-- /Testimonial -->
    <!-- brand -->
    <section class="flat-spacing-5 pt_0">
        <div class="container">
            <div dir="ltr" class="swiper tf-sw-brand" data-loop="false" data-play="false" data-preview="6"
                 data-tablet="3" data-mobile="2" data-space-lg="0" data-space-md="0">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="brand-item">
                            <img class="lazyload" data-src="{{asset('assets/front/images/brand/brand-01.png')}}"
                                 src="{{asset('assets/front/images/brand/brand-01.png')}}" alt="image-brand">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-item">
                            <img class="lazyload" data-src="{{asset('assets/front/images/brand/brand-02.png')}}"
                                 src="{{asset('assets/front/images/brand/brand-02.png')}}" alt="image-brand">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-item">
                            <img class="lazyload" data-src="{{asset('assets/front/images/brand/brand-03.png')}}"
                                 src="{{asset('assets/front/images/brand/brand-03.png')}}" alt="image-brand">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-item">
                            <img class="lazyload" data-src="{{asset('assets/front/images/brand/brand-04.png')}}"
                                 src="{{asset('assets/front/images/brand/brand-04.png')}}" alt="image-brand">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-item">
                            <img class="lazyload" data-src="{{asset('assets/front/images/brand/brand-05.png')}}"
                                 src="{{asset('assets/front/images/brand/brand-05.png')}}" alt="image-brand">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-item">
                            <img class="lazyload" data-src="{{asset('assets/front/images/brand/brand-06.png')}}"
                                 src="{{asset('assets/front/images/brand/brand-06.png')}}" alt="image-brand">
                        </div>
                    </div>
                </div>
            </div>
            <div class="sw-dots style-2 sw-pagination-brand justify-content-center"></div>
        </div>
    </section>
    <!-- /brand -->
    <!-- Shop Gram -->
    <section class="flat-spacing-7">
        <div class="container">
            <div class="flat-title wow fadeInUp" data-wow-delay="0s">
                <span class="title">Shop Gram</span>
                <p class="sub-title">Inspire and let yourself be inspired, from one unique fashion to another.</p>
            </div>
            <div class="wrap-carousel wrap-shop-gram">
                <div dir="ltr" class="swiper tf-sw-shop-gallery" data-preview="5" data-tablet="3" data-mobile="2"
                     data-space-lg="7" data-space-md="7">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="gallery-item hover-img wow fadeInUp" data-wow-delay=".2s">
                                <div class="img-style">
                                    <img class="lazyload img-hover"
                                         data-src="{{asset('assets/front/images/shop/gallery/gallery-7.jpg')}}"
                                         src="{{asset('assets/front/images/shop/gallery/gallery-7.jpg')}}"
                                         alt="image-gallery">
                                </div>
                                <a href="#quick_add" data-bs-toggle="modal" class="box-icon"><span
                                        class="icon icon-bag"></span> <span class="tooltip">Quick Add</span></a>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="gallery-item hover-img wow fadeInUp" data-wow-delay=".3s">
                                <div class="img-style">
                                    <img class="lazyload img-hover"
                                         data-src="{{asset('assets/front/images/shop/gallery/gallery-3.jpg')}}"
                                         src="{{asset('assets/front/images/shop/gallery/gallery-3.jpg')}}"
                                         alt="image-gallery">
                                </div>
                                <a href="#quick_add" data-bs-toggle="modal" class="box-icon"><span
                                        class="icon icon-bag"></span> <span class="tooltip">Quick Add</span></a>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="gallery-item hover-img wow fadeInUp" data-wow-delay=".4s">
                                <div class="img-style">
                                    <img class="lazyload img-hover"
                                         data-src="{{asset('assets/front/images/shop/gallery/gallery-5.jpg')}}"
                                         src="{{asset('assets/front/images/shop/gallery/gallery-5.jpg')}}"
                                         alt="image-gallery">
                                </div>
                                <a href="#quick_add" data-bs-toggle="modal" class="box-icon"><span
                                        class="icon icon-bag"></span> <span class="tooltip">Quick Add</span></a>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="gallery-item hover-img wow fadeInUp" data-wow-delay=".5s">
                                <div class="img-style">
                                    <img class="lazyload img-hover"
                                         data-src="{{asset('assets/front/images/shop/gallery/gallery-8.jpg')}}"
                                         src="{{asset('assets/front/images/shop/gallery/gallery-8.jpg')}}"
                                         alt="image-gallery">
                                </div>
                                <a href="product-detail.html" class="box-icon"><span class="icon icon-bag"></span> <span
                                        class="tooltip">View product</span></a>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="gallery-item hover-img wow fadeInUp" data-wow-delay=".6s">
                                <div class="img-style">
                                    <img class="lazyload img-hover"
                                         data-src="{{asset('assets/front/images/shop/gallery/gallery-6.jpg')}}"
                                         src="{{asset('assets/front/images/shop/gallery/gallery-6.jpg')}}"
                                         alt="image-gallery">
                                </div>
                                <a href="product-detail.html" class="box-icon"><span class="icon icon-bag"></span> <span
                                        class="tooltip">View product</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sw-dots sw-pagination-gallery justify-content-center"></div>
            </div>
        </div>
    </section>
    <!-- /Shop Gram -->
    <!-- Icon box -->
    <section class="flat-spacing-7 flat-iconbox wow fadeInUp" data-wow-delay="0s">
        <div class="container">
            <div class="wrap-carousel wrap-mobile">
                <div dir="ltr" class="swiper tf-sw-mobile" data-preview="1" data-space="15">
                    <div class="swiper-wrapper wrap-iconbox">
                        <div class="swiper-slide">
                            <div class="tf-icon-box style-border-line text-center">
                                <div class="icon">
                                    <i class="icon-shipping"></i>
                                </div>
                                <div class="content">
                                    <div class="title">Free Shipping</div>
                                    <p>Free shipping over order $120</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="tf-icon-box style-border-line text-center">
                                <div class="icon">
                                    <i class="icon-payment fs-22"></i>
                                </div>
                                <div class="content">
                                    <div class="title">Flexible Payment</div>
                                    <p>Pay with Multiple Credit Cards</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="tf-icon-box style-border-line text-center">
                                <div class="icon">
                                    <i class="icon-return fs-22"></i>
                                </div>
                                <div class="content">
                                    <div class="title">14 Day Returns</div>
                                    <p>Within 30 days for an exchange</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="tf-icon-box style-border-line text-center">
                                <div class="icon">
                                    <i class="icon-suport"></i>
                                </div>
                                <div class="content">
                                    <div class="title">Premium Support</div>
                                    <p>Outstanding premium support</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="sw-dots style-2 sw-pagination-mb justify-content-center"></div>
            </div>
        </div>
    </section>
    <!-- /Icon box -->
@endsection
