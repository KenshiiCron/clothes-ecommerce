<div class="card-product fl-item">
    <div class="card-product-wrapper">
        <a href="{{route('products.show', $product->id)}}" class="product-img">
            <img class="lazyload img-product"
                 height="440"
                 width="330"
                 style="aspect-ratio: 0.75; object-fit: cover"
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
      {{--      <a href="#compare" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft"
               class="box-icon bg_white compare btn-icon-action">
                <span class="icon icon-compare"></span>
                <span class="tooltip">Add to Compare</span>
                <span class="icon icon-check"></span>
            </a>--}}
            <a href="{{route('products.show', $product->id)}}" data-bs-toggle="modal"
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
        <a href="product-detail.html" class="title link">{{$product->name}}</a>
        <span class="price">{{$product->inventories->min('price') ?? '/'}} DA</span>
        <ul class="list-color-product">
            @foreach($product->inventories as $inventory)
                @foreach($inventory->attribute_values as $value)
                    @if(strtolower($value->attribute->name) == 'color')
                        <li class="list-color-item color-swatch active">
                            <span class="tooltip">{{ucfirst($value->value)}}</span>
                            <span class="swatch-value" style="background-color: {{$value->value}}"></span>
                            <img class="lazyload" data-src="{{$product->image_url}}"
                                 src="{{$product->image_url}}" alt="image-product">
                        </li>
                    @endif
                @endforeach
            @endforeach

        </ul>
    </div>
</div>
