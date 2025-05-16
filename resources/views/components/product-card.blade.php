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
        <livewire:product-card-buttons :product="$product"/>
        <div class="size-list">

            @foreach($product->sizes() as $size)
                <span>{{$size->value}}</span>
            @endforeach
{{--            <span>S</span>--}}
{{--            <span>M</span>--}}
{{--            <span>L</span>--}}
{{--            <span>XL</span>--}}
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
