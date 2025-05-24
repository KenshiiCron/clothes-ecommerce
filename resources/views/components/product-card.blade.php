<div class="card-product fl-item" wire:key = '{{$product->id}}'>
    <div class="card-product-wrapper">
        <div class="badge-product">
            @if($product->featured)
                <span class="badge badge-success">{{__('labels.fields.featured')}}</span>
            @endif
                @if($product->inventories->min('old_price') > 0 )
                    <span class="badge badge-danger">{{__('labels.fields.discount')}}</span>
                @endif

        </div>
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
        <livewire:product-card-buttons :product="$product" wire:key="product-card-{{ $product->id }}" />
        <div class="size-list">

            @foreach($product->sizes() as $size)
                <span>{{strtoupper($size->value)}}</span>
            @endforeach
{{--            <span>S</span>--}}
{{--            <span>M</span>--}}
{{--            <span>L</span>--}}
{{--            <span>XL</span>--}}
        </div>
    </div>
    <div class="card-product-info">
        <a href="product-detail.html" class="title link">{{$product->name}}</a>
        <span class="price fs-5">{{$product->inventories->min('price') ?? '/'}} DA</span>
        @if($product->inventories->min('old_price') > 0 )
        <span class="text-danger fs-6 text-decoration-line-through">{{$product->inventories->min('old_price') ?? '/'}} DA</span>
        @endif
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
