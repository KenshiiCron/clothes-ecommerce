<section class="flat-spacing-11">
    <div class="container">
        <div class="tf-page-cart-wrap layout-2">
            <div class="tf-page-cart-item">
                <h5 class="fw-5 mb_20">{{__('labels.fields.details')}}</h5>
                <form class="form-checkout">
                        <fieldset class=" box fieldset">
                            <label for="name">{{__('labels.fields.name')}}</label>
                            <input type="text" wire:model = 'name'>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </fieldset>
                    <fieldset class="box fieldset">
                        <label for="phone">{{__('labels.fields.phone')}}</label>
                        <input type="number" id="phone"  wire:model = 'phone'>
                        @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </fieldset>
                    <fieldset class="box fieldset">
                        <label for="country">{{__('labels.fields.cities')}}</label>
                        <div class="select-custom">
                            <select class="tf-select w-100" id="city" wire:model.live = 'wilayat_id' data-default="">
                                @foreach($cities as $city)
                                    <option value="{{$city->id}}" >{{$city->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('wilayat_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </fieldset>
                    <fieldset class="box fieldset">
                        <label for="country">{{__('labels.fields.communes')}}</label>
                        <div class="select-custom">
                            <select class="tf-select w-100" id="commune" wire:model.live = 'commune_id' data-default="">
                                <option value="" disabled>---</option>
                                @foreach($communes as $commune)
                                    <option value="{{$commune->id}}" >{{$commune->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('commune_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </fieldset>
                    <fieldset class="box fieldset">
                        <label for="delivery">{{__('labels.fields.shipping_to')}}</label>
                        <div class="select-custom">
                            <select class="tf-select w-100" id="delivery" wire:model.live="shipping_to" data-default="">
                                <option value="1" selected>{{__('labels.fields.desk')}}</option>
                                <option value="2">{{__('labels.fields.home')}}</option>
                            </select>
                        </div>
                        @error('shipping_to')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </fieldset>
                    @if($shipping_to == 2)
                        <fieldset class="box fieldset" wire:transition.fade>
                            <label for="address">{{__('labels.fields.address')}}</label>
                            <input type="text" id="address" wire:model = 'address'>
                            @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </fieldset>
                    @endif
                    <fieldset class="box fieldset">
                        <label for="email">{{__('labels.fields.email')}} ({{__('labels.fields.optional')}})</label>
                        <input type="email" id="email" wire:model = 'email'>
                    </fieldset>
                </form>
            </div>
            <div class="tf-page-cart-footer">
                <div class="tf-cart-footer-inner">
                    <h5 class="fw-5 mb_20">{{__('labels.text.your_order')}}</h5>
                    <div class="tf-page-cart-checkout widget-wrap-checkout">
                        <ul class="wrap-checkout-product">
                            @foreach($products as $product)
                                <li class="checkout-product-item">
                                    <figure class="img-product">
                                        <img src="{{$product['details']->image_url}}" alt="product">
                                        <span class="quantity">{{$product['qty']}}</span>
                                    </figure>
                                    <div class="content">
                                        <div class="info">
                                            <p class="name">{{ucfirst($product['details']->name)}}</p>
                                            @foreach($product['inventory']->attribute_values as $value)
                                                <p class="variant">{{ucfirst($value->attribute->name)}} : {{ucfirst($value->value)}}</p>
                                            @endforeach
                                        </div>
                                        <span class="price">{{$product['total']}} DA</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
           {{--             <div class="coupon-box">
                            <input type="text" placeholder="Discount code">
                            <a href="#" class="tf-btn btn-sm radius-3 btn-fill btn-icon animate-hover-btn">Apply</a>
                        </div>--}}
                        <div class="d-flex justify-content-between line pb_20">
                            <h6 class="fw-5">{{__('labels.fields.total')}}</h6>
                            <h6 class="total fw-5">{{$total_price}} DA</h6>
                        </div>
                    {{--    <div class="wd-check-payment">
                            <div class="fieldset-radio mb_20">
                                <input type="radio" name="payment" id="bank" class="tf-check" checked>
                                <label for="bank">Direct bank transfer</label>

                            </div>
                            <div class="fieldset-radio mb_20">
                                <input type="radio" name="payment" id="delivery" class="tf-check">
                                <label for="delivery">Cash on delivery</label>
                            </div>
                            <p class="text_black-2 mb_20">Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="privacy-policy.html" class="text-decoration-underline">privacy policy</a>.</p>
                            <div class="box-checkbox fieldset-radio mb_20">
                                <input type="checkbox" id="check-agree" class="tf-check">
                                <label for="check-agree" class="text_black-2">I have read and agree to the website <a href="terms-conditions.html" class="text-decoration-underline">terms and conditions</a>.</label>
                            </div>
                        </div>--}}
                        <button class="tf-btn radius-3 btn-fill btn-icon animate-hover-btn justify-content-center" wire:click = 'placeOrder'>Place order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
