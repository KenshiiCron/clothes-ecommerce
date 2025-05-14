<div class="list-product-btn">
    <a href="#quick_add" data-bs-toggle="modal"
       class="box-icon bg_white quick-add tf-btn-loading">
        <span class="icon icon-bag"></span>
        <span class="tooltip">Quick Add</span>
    </a>
    <a wire:click="toggleWishlist" href="javascript:void(0);" class="box-icon bg_white wishlist btn-icon-action">
        @if($isInWishlist)
            <span class="icon icon-delete"></span>
            <span class="tooltip">Remove from Wishlist</span>
        @else
            <span class="icon icon-heart"></span>
            <span class="tooltip">Add to Wishlist</span>
        @endif
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
