<!-- Top Bar -->
<div class="tf-top-bar bg_white line">
    <div class="px_15 lg-px_40">
        <div class="tf-top-bar_wrap grid-3 gap-30 align-items-center">
            <ul class="tf-top-bar_item tf-social-icon d-flex gap-10">
                @if(config('settings.social_facebook'))
                    <li><a href="{{config('settings.social_facebook')}}" target="_blank"
                           class="box-icon w_28 round social-facebook bg_line"><i
                                class="icon fs-12 icon-fb"></i></a></li>
                @endif
                @if(config('settings.social_twitter'))
                    <li><a href="{{config('settings.social_twitter')}}" target="_blank"
                           class="box-icon w_28 round social-twiter bg_line"><i
                                class="icon fs-10 icon-Icon-x"></i></a>
                    </li>
                @endif
                @if(config('settings.social_instagram'))
                    <li><a href="{{config('settings.social_instagram')}}" target="_blank"
                           class="box-icon w_28 round social-instagram bg_line"><i
                                class="icon fs-12 icon-instagram"></i></a></li>
                @endif
                @if(config('settings.social_tiktok'))
                    <li><a href="{{config('settings.social_tiktok')}}" target="_blank"
                           class="box-icon w_28 round social-tiktok bg_line"><i
                                class="icon fs-12 icon-tiktok"></i></a>
                    </li>
                @endif
                @if(config('settings.social_youtube'))
                    <li><a href="{{config('settings.social_youtube')}}" target="_blank"
                           class="box-icon w_28 round social-pinterest bg_line"><i
                                class="icon fs-12 icon-youtube"></i></a></li>
                @endif
            </ul>
            <div class="text-center overflow-hidden">
                <div dir="ltr" class="swiper tf-sw-top_bar" data-preview="1" data-space="0" data-loop="true"
                     data-speed="1000" data-delay="2000">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <p class="top-bar-text fw-5">Spring Fashion Sale <a href="shop-default.html"
                                                                                title="all collection"
                                                                                class="tf-btn btn-line">Shop now<i
                                        class="icon icon-arrow1-top-left"></i></a></p>
                        </div>
                        <div class="swiper-slide">
                            <p class="top-bar-text fw-5">Summer sale discount off 70%</p>
                        </div>
                        <div class="swiper-slide">
                            <p class="top-bar-text fw-5">Time to refresh your wardrobe.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="top-bar-language tf-cur justify-content-end">
                <div class="tf-languages">
                    <form action="{{route('switchLocale')}}" method="post">
                        @csrf
                        <select class="image-select center style-default type-languages" name="locale" id="locale"
                                onchange="this.form.submit()">
                            <option value="fr" @if(App::getLocale() == 'fr') selected @endif>Français</option>
                            <option value="en" @if(App::getLocale() == 'en') selected @endif>English</option>
                            <option value="ar" @if(App::getLocale() == 'ar') selected @endif>العربية</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Top Bar -->
