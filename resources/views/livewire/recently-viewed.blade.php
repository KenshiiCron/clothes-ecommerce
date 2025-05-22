@if(!$products->isEmpty())
<section class="flat-spacing-4 pt_0">
    <div class="container">
        <div class="flat-title">
            <span class="title">Recently Viewed</span>
        </div>
        <div class="hover-sw-nav hover-sw-2">
            <div dir="ltr" class="swiper tf-sw-recent wrap-sw-over" data-preview="4" data-tablet="3" data-mobile="2" data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1" data-pagination-md="1" data-pagination-lg="1">
                <div class="swiper-wrapper">

                        @foreach($products as $product)
                    <div class="swiper-slide" lazy="true">
                        @include('components.product-card',['product'=> $product])
                    </div>
                        @endforeach

                </div>
            </div>

        </div>
    </div>
</section>
@endif
