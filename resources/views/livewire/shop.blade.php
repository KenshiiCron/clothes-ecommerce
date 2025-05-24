

<div>
    <section class="flat-spacing-2" >
        <div class="container">
            <div class="tf-shop-control grid-3 align-items-center">
                <div class="tf-control-filter">
                    <a href="#filterShop" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft" class="tf-btn-filter"><span class="icon icon-filter"></span><span class="text">{{__('labels.fields.filter')}}</span></a>
                </div>
                <ul class="tf-control-layout d-flex justify-content-center">
                    <li class="tf-view-layout-switch sw-layout-2" data-value-grid="grid-2">
                        <div class="item"><span class="icon icon-grid-2"></span></div>
                    </li>
                    <li class="tf-view-layout-switch sw-layout-3" data-value-grid="grid-3">
                        <div class="item"><span class="icon icon-grid-3"></span></div>
                    </li>
                    <li class="tf-view-layout-switch sw-layout-4 active" data-value-grid="grid-4">
                        <div class="item"><span class="icon icon-grid-4"></span></div>
                    </li>
                    <li class="tf-view-layout-switch sw-layout-5" data-value-grid="grid-5">
                        <div class="item"><span class="icon icon-grid-5"></span></div>
                    </li>
                    <li class="tf-view-layout-switch sw-layout-6" data-value-grid="grid-6">
                        <div class="item"><span class="icon icon-grid-6"></span></div>
                    </li>
                </ul>
                <div class="tf-control-sorting d-flex justify-content-end">
                    <div class="tf-dropdown-sort" data-bs-toggle="dropdown">
                        <div class="btn-select">
                            <span class="text-sort-value">{{__('labels.sort.'.$currentOrder)}}</span>
                            <span class="icon icon-arrow-down"></span>
                        </div>
                        <div class="dropdown-menu" >
                         {{--   <div class="select-item active" wire:click="filter(['price','desc'])">
                                <span class="text-value-item">{{__('labels.sort.featured')}}</span>
                            </div>--}}
                         {{--   <div class="select-item">
                                <span class="text-value-item" wire:click="order('seller','asc')">{{__('labels.sort.best_selling')}}</span>
                            </div>--}}
                            <div class="select-item" wire:click="order('name','asc')">
                                <span class="text-value-item" >{{__('labels.sort.name_asc')}}</span>
                            </div>
                            <div class="select-item" wire:click="order('name','asc')">
                                <span class="text-value-item" >{{__('labels.sort.name_desc')}}</span>
                            </div>
                            <div class="select-item" wire:click="order('price','asc')">
                                <span class="text-value-item" >{{__('labels.sort.price_asc')}}</span>
                            </div>
                            <div class="select-item" wire:click="order('price','desc')">
                                <span class="text-value-item" >{{__('labels.sort.price_desc')}}</span>
                            </div>
                            <div class="select-item" wire:click="order('created_at','asc')">
                                <span class="text-value-item" >{{__('labels.sort.created_at_asc')}}</span>
                            </div>
                            <div class="select-item" wire:click="order('created_at','desc')" >
                                <span class="text-value-item" >{{__('labels.sort.created_at_desc')}}</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="wrapper-control-shop">
                <div class="meta-filter-shop" ></div>
                <div class="grid-layout wrapper-shop" data-grid="grid-4" wire:loading.remove>
                    @foreach($products as $product)
                        @include('components.product-card',['product'=> $product])
                    @endforeach
                </div>
                <div class="grid-layout wrapper-shop" data-grid="grid-4" wire:loading>
                    <div class="card-product fl-item">
                        <div class="card-product-wrapper">
                            <div class="badge-product">
                                <span class="badge badge-placeholder" style="width: 60px; height: 20px; background-color: #e0e0e0; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></span>
                            </div>
                            <div class="product-img" style="width: 330px; height: 440px; background-color: #e0e0e0; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></div>
                            <div class="size-list">
                                <span style="width: 30px; height: 20px; background-color: #e0e0e0; display: inline-block; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></span>
                                <span style="width: 30px; height: 20px; background-color: #e0e0e0; display: inline-block; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></span>
                                <span style="width: 30px; height: 20px; background-color: #e0e0e0; display: inline-block; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></span>
                            </div>
                        </div>
                        <div class="card-product-info">
                            <div class="title" style="width: 70%; height: 20px; background-color: #e0e0e0; margin-bottom: 10px; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></div>
                            <div class="price" style="width: 40%; height: 18px; background-color: #e0e0e0; margin-bottom: 10px; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></div>
                            <div class="old-price" style="width: 30%; height: 16px; background-color: #e0e0e0; margin-bottom: 10px; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></div>
                            <ul class="list-color-product">
                                <li class="list-color-item">
                                    <span class="swatch-value" style="width: 20px; height: 20px; background-color: #e0e0e0; border-radius: 50%; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></span>
                                </li>
                                <li class="list-color-item">
                                    <span class="swatch-value" style="width: 20px; height: 20px; background-color: #e0e0e0; border-radius: 50%; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-product fl-item">
                        <div class="card-product-wrapper">
                            <div class="badge-product">
                                <span class="badge badge-placeholder" style="width: 60px; height: 20px; background-color: #e0e0e0; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></span>
                            </div>
                            <div class="product-img" style="width: 330px; height: 440px; background-color: #e0e0e0; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></div>
                            <div class="size-list">
                                <span style="width: 30px; height: 20px; background-color: #e0e0e0; display: inline-block; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></span>
                                <span style="width: 30px; height: 20px; background-color: #e0e0e0; display: inline-block; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></span>
                                <span style="width: 30px; height: 20px; background-color: #e0e0e0; display: inline-block; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></span>
                            </div>
                        </div>
                        <div class="card-product-info">
                            <div class="title" style="width: 70%; height: 20px; background-color: #e0e0e0; margin-bottom: 10px; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></div>
                            <div class="price" style="width: 40%; height: 18px; background-color: #e0e0e0; margin-bottom: 10px; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></div>
                            <div class="old-price" style="width: 30%; height: 16px; background-color: #e0e0e0; margin-bottom: 10px; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></div>
                            <ul class="list-color-product">
                                <li class="list-color-item">
                                    <span class="swatch-value" style="width: 20px; height: 20px; background-color: #e0e0e0; border-radius: 50%; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></span>
                                </li>
                                <li class="list-color-item">
                                    <span class="swatch-value" style="width: 20px; height: 20px; background-color: #e0e0e0; border-radius: 50%; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-product fl-item">
                        <div class="card-product-wrapper">
                            <div class="badge-product">
                                <span class="badge badge-placeholder" style="width: 60px; height: 20px; background-color: #e0e0e0; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></span>
                            </div>
                            <div class="product-img" style="width: 330px; height: 440px; background-color: #e0e0e0; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></div>
                            <div class="size-list">
                                <span style="width: 30px; height: 20px; background-color: #e0e0e0; display: inline-block; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></span>
                                <span style="width: 30px; height: 20px; background-color: #e0e0e0; display: inline-block; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></span>
                                <span style="width: 30px; height: 20px; background-color: #e0e0e0; display: inline-block; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></span>
                            </div>
                        </div>
                        <div class="card-product-info">
                            <div class="title" style="width: 70%; height: 20px; background-color: #e0e0e0; margin-bottom: 10px; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></div>
                            <div class="price" style="width: 40%; height: 18px; background-color: #e0e0e0; margin-bottom: 10px; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></div>
                            <div class="old-price" style="width: 30%; height: 16px; background-color: #e0e0e0; margin-bottom: 10px; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></div>
                            <ul class="list-color-product">
                                <li class="list-color-item">
                                    <span class="swatch-value" style="width: 20px; height: 20px; background-color: #e0e0e0; border-radius: 50%; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></span>
                                </li>
                                <li class="list-color-item">
                                    <span class="swatch-value" style="width: 20px; height: 20px; background-color: #e0e0e0; border-radius: 50%; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-product fl-item">
                        <div class="card-product-wrapper">
                            <div class="badge-product">
                                <span class="badge badge-placeholder" style="width: 60px; height: 20px; background-color: #e0e0e0; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></span>
                            </div>
                            <div class="product-img" style="width: 330px; height: 440px; background-color: #e0e0e0; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></div>
                            <div class="size-list">
                                <span style="width: 30px; height: 20px; background-color: #e0e0e0; display: inline-block; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></span>
                                <span style="width: 30px; height: 20px; background-color: #e0e0e0; display: inline-block; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></span>
                                <span style="width: 30px; height: 20px; background-color: #e0e0e0; display: inline-block; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></span>
                            </div>
                        </div>
                        <div class="card-product-info">
                            <div class="title" style="width: 70%; height: 20px; background-color: #e0e0e0; margin-bottom: 10px; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></div>
                            <div class="price" style="width: 40%; height: 18px; background-color: #e0e0e0; margin-bottom: 10px; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></div>
                            <div class="old-price" style="width: 30%; height: 16px; background-color: #e0e0e0; margin-bottom: 10px; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></div>
                            <ul class="list-color-product">
                                <li class="list-color-item">
                                    <span class="swatch-value" style="width: 20px; height: 20px; background-color: #e0e0e0; border-radius: 50%; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></span>
                                </li>
                                <li class="list-color-item">
                                    <span class="swatch-value" style="width: 20px; height: 20px; background-color: #e0e0e0; border-radius: 50%; box-shadow: 0 0 8px rgba(224, 224, 224, 0.5);"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- pagination -->
                <ul class="tf-pagination-wrap tf-pagination-list tf-pagination-btn">
                  {{$products->links()}}
             {{--       <li class="active">
                        <a href="#" class="pagination-link">1</a>
                    </li>
                    <li>
                        <a href="#" class="pagination-link animate-hover-btn">2</a>
                    </li>
                    <li>
                        <a href="#" class="pagination-link animate-hover-btn">3</a>
                    </li>
                    <li>
                        <a href="#" class="pagination-link animate-hover-btn">4</a>
                    </li>
                    <li>
                        <a href="#" class="pagination-link animate-hover-btn">
                            <span class="icon icon-arrow-right"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="pagination-link animate-hover-btn">
                            <span class="icon icon-arrow-left"></span>
                        </a>
                    </li>--}}

                </ul>
            </div>

        </div>
    </section>
    <div class="offcanvas offcanvas-start canvas-filter " id="filterShop" wire:ignore>
        <div class="canvas-wrapper">
            <header class="canvas-header">
                <div class="filter-icon">
                    <span class="icon icon-filter"></span>
                    <span>{{__('labels.fields.filter')}}</span>
                </div>
                <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
            </header>
            <div class="canvas-body">
                <div class="widget-facet wd-categories">
                    <div class="facet-title"  data-bs-toggle="collapse" aria-expanded="true" aria-controls="categories">
                        <span>{{__('labels.fields.products')}} {{__('labels.fields.categories')}}</span>
                        <span class="icon icon-arrow-up"></span>
                    </div>
                    <div id="categories" class="collapse show" >
                        <ul class="list-categoris current-scrollbar mb_36" >
                            @foreach($categories as $category)
                                <li class="cate-item @if($category->id == request('category'))current @endif"><a href="{{route('shop',['category'=> $category->id])}}">{{ucfirst($category->name)}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <form action="#" id="facet-filter-form" class="facet-filter-form">
               {{--     <div class="widget-facet">
                        <div class="facet-title" data-bs-target="#availability" data-bs-toggle="collapse" aria-expanded="true" aria-controls="availability">
                            <span>Availability</span>
                            <span class="icon icon-arrow-up"></span>
                        </div>
                        <div id="availability" class="collapse show">
                            <ul class="tf-filter-group current-scrollbar mb_36">
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <input type="radio" name="availability" class="tf-check" id="availability-1">
                                    <label for="availability-1" class="label"><span>In stock</span>&nbsp;<span>(14)</span></label>
                                </li>
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <input type="radio" name="availability" class="tf-check" id="availability-2">
                                    <label for="availability-2" class="label"><span>Out of stock</span>&nbsp;<span>(2)</span></label>
                                </li>
                            </ul>
                        </div>
                    </div>--}}
                 {{--   <div class="widget-facet">
                        <div class="facet-title" data-bs-target="#price" data-bs-toggle="collapse" aria-expanded="true" aria-controls="price">
                            <span>Price</span>
                            <span class="icon icon-arrow-up"></span>
                        </div>
                        <div id="price" class="collapse show">
                            <div class="widget-price filter-price">
                                <div class="tow-bar-block">
                                    <div class="progress-price"></div>
                                </div>
                                <div class="range-input">
                                    <input class="range-min" type="range" min="0" max="300" value="0" wire:model.live = 'min_price'/>
                                    <input class="range-max" type="range" min="0" max="300" value="300" wire:model.live = 'max_price'/>
                                </div>
                                <div class="box-title-price">
                                    <span class="title-price">Price :</span>
                                    <div class="caption-price">
                                        <div>
                                            <span>DA</span>
                                            <span class="min-price">{{$min_price}}</span>
                                        </div>
                                        <span>-</span>
                                        <div>
                                            <span>DA</span>
                                            <span class="max-price">{{$max_price}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>--}}
          {{--          @if(!$brands->isEmpty())
                        <div class="widget-facet">
                            <div class="facet-title" data-bs-target="#brand" data-bs-toggle="collapse" aria-expanded="true" aria-controls="brand">
                                <span>Brand</span>
                                <span class="icon icon-arrow-up"></span>
                            </div>

                                <div id="brand" class="collapse show">
                                    <ul class="tf-filter-group current-scrollbar mb_36">
                                        @foreach($brands as $brand)
                                            <li class="list-item d-flex gap-12 align-items-center">
                                                <input type="radio" name="brand" class="tf-check" id="{{$brand->id}}" wire:model.live = 'brand'>
                                                <label for="brand-{{$brand->id}}" class="label"><span>{{$brand->name}}</span></label>
                                            </li>
                                        @endforeach
                                </div>
                        </div>
                    @endif--}}
                    @foreach($attributes as $attribute)
                        @if(strtolower($attribute->name) == 'color')
                            <div class="widget-facet">
                                <div class="facet-title" data-bs-target="#{{$attribute->name}}" data-bs-toggle="collapse" aria-expanded="true" aria-controls="color">
                                    <span>Color</span>
                                    <span class="icon icon-arrow-up"></span>
                                </div>
                                <div id="color" class="collapse show">
                                    <ul class="tf-filter-group filter-color current-scrollbar mb_36">
                                        @foreach($attribute->attribute_values as $key => $value)
                                            <li class="list-item d-flex gap-12 align-items-center">
                                                <input type="checkbox"  wire:model.live = 'attribute_values.{{$value->id}}' class="tf-check-color" id="attribute_{{$attribute->id}}_{{$value->id}}"  style="background-color: {{$value->value}}" value="{{$value->id}}">
                                                <label for="attribute_{{$attribute->id}}_{{$value->id}}" class="label"><span>{{ucfirst($value->value)}}</span>&nbsp;</label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @else
                            <div class="widget-facet">
                                <div class="facet-title" data-bs-target="#{{$attribute->name}}" data-bs-toggle="collapse" aria-expanded="true" aria-controls="size">
                                    <span>Size</span>
                                    <span class="icon icon-arrow-up"></span>
                                </div>
                                <div id="size" class="collapse show">
                                    <ul class="tf-filter-group current-scrollbar">
                                        @foreach($attribute->attribute_values as $key => $value)
                                            <li class="list-item d-flex gap-12 align-items-center">
                                                <input type="checkbox" wire:model.live='attribute_values.{{$value->id}}'  class="tf-check tf-check-size" value="{{$value->id}}" id="attribute_{{$attribute->id}}_{{$value->id}}">
                                                <label for="attribute_{{$attribute->id}}_{{$value->id}}" class="label"><span>{{ucfirst($value->value)}}</span>&nbsp;</label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    @endforeach


                </form>
            </div>

        </div>
    </div>
</div>
