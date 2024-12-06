<div class="card-product fl-item">
    <div class="card-product-wrapper">
        <a href="{{route('products.show', $product->id)}}" class="product-img">
            <img class="lazyload img-product"
                 data-src="{{$product->image_url}}"
                 src="{{$product->image_url}}" alt="image-product">
            <img class="lazyload img-hover"
                 data-src="{{$product->image_url}}"
                 src="{{$product->image_url}}" alt="image-product">
        </a>
        <div class="list-product-btn">
            <a href="#quick_add" data-bs-toggle="modal"
               class="box-icon bg_white quick-add tf-btn-loading">
                <span class="icon icon-bag"></span>
                <span class="tooltip">Quick Add</span>
            </a>
            <a href="javascript:void(0);" class="box-icon bg_white wishlist btn-icon-action">
                <span class="icon icon-heart"></span>
                <span class="tooltip">Add to Wishlist</span>
                <span class="icon icon-delete"></span>
            </a>
            <a href="#compare" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft"
               class="box-icon bg_white compare btn-icon-action">
                <span class="icon icon-compare"></span>
                <span class="tooltip">Add to Compare</span>
                <span class="icon icon-check"></span>
            </a>
            <a href="#quick_view" data-bs-toggle="modal"
               class="box-icon bg_white quickview tf-btn-loading">
                <span class="icon icon-view"></span>
                <span class="tooltip">Quick View</span>
            </a>
        </div>
        <div class="size-list">
            <span>S</span>
            <span>M</span>
            <span>L</span>
            <span>XL</span>
        </div>
    </div>
    <div class="card-product-info">
        <a href="product-detail.html" class="title link">Ribbed Tank Top</a>
        <span class="price">$16.95</span>
        <ul class="list-color-product">
            <li class="list-color-item color-swatch active">
                <span class="tooltip">Orange</span>
                <span class="swatch-value bg_orange-3"></span>
                <img class="lazyload" data-src="{{asset('assets/front/images/products/orange-1.jpg')}}"
                     src="{{asset('assets/front/images/products/orange-1.jpg')}}" alt="image-product">
            </li>
            <li class="list-color-item color-swatch">
                <span class="tooltip">Black</span>
                <span class="swatch-value bg_dark"></span>
                <img class="lazyload" data-src="{{asset('assets/front/images/products/black-1.jpg')}}"
                     src="{{asset('assets/front/images/products/black-1.jpg')}}" alt="image-product">
            </li>
            <li class="list-color-item color-swatch">
                <span class="tooltip">White</span>
                <span class="swatch-value bg_white"></span>
                <img class="lazyload" data-src="{{asset('assets/front/images/products/white-1.jpg')}}"
                     src="{{asset('assets/front/images/products/white-1.jpg')}}" alt="image-product">
            </li>
        </ul>
    </div>
</div>
