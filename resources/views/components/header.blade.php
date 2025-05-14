<!-- Header -->
<header id="header" class="header-default header-absolute">
    <div class="px_15 lg-px_40">
        <div class="row wrapper-header align-items-center">
            <div class="col-md-4 col-3 tf-lg-hidden">
                <a href="#mobileMenu" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="16" viewBox="0 0 24 16" fill="none">
                        <path d="M2.00056 2.28571H16.8577C17.1608 2.28571 17.4515 2.16531 17.6658 1.95098C17.8802 1.73665 18.0006 1.44596 18.0006 1.14286C18.0006 0.839753 17.8802 0.549063 17.6658 0.334735C17.4515 0.120408 17.1608 0 16.8577 0H2.00056C1.69745 0 1.40676 0.120408 1.19244 0.334735C0.978109 0.549063 0.857702 0.839753 0.857702 1.14286C0.857702 1.44596 0.978109 1.73665 1.19244 1.95098C1.40676 2.16531 1.69745 2.28571 2.00056 2.28571ZM0.857702 8C0.857702 7.6969 0.978109 7.40621 1.19244 7.19188C1.40676 6.97755 1.69745 6.85714 2.00056 6.85714H22.572C22.8751 6.85714 23.1658 6.97755 23.3801 7.19188C23.5944 7.40621 23.7148 7.6969 23.7148 8C23.7148 8.30311 23.5944 8.59379 23.3801 8.80812C23.1658 9.02245 22.8751 9.14286 22.572 9.14286H2.00056C1.69745 9.14286 1.40676 9.02245 1.19244 8.80812C0.978109 8.59379 0.857702 8.30311 0.857702 8ZM0.857702 14.8571C0.857702 14.554 0.978109 14.2633 1.19244 14.049C1.40676 13.8347 1.69745 13.7143 2.00056 13.7143H12.2863C12.5894 13.7143 12.8801 13.8347 13.0944 14.049C13.3087 14.2633 13.4291 14.554 13.4291 14.8571C13.4291 15.1602 13.3087 15.4509 13.0944 15.6653C12.8801 15.8796 12.5894 16 12.2863 16H2.00056C1.69745 16 1.40676 15.8796 1.19244 15.6653C0.978109 15.4509 0.857702 15.1602 0.857702 14.8571Z" fill="currentColor"></path>
                    </svg>
                </a>
            </div>
            <div class="col-xl-3 col-md-4 col-6">
                <a href="{{route('home')}}" class="logo-header">
                    <img src="{{asset('assets/front/images/logo/logo.svg')}}" alt="logo" class="logo">
                </a>
            </div>
            <div class="col-xl-6 tf-md-hidden">
                <nav class="box-navigation text-center">
                    <ul class="box-nav-ul d-flex align-items-center justify-content-center gap-30">
                        <li class="menu-item">
                            <a href="{{route('home')}}" class="item-link">{{__('labels.navigation.home')}}</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('shop')}}" class="item-link">{{__('labels.navigation.shop')}}</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('about')}}" class="item-link">{{__('labels.navigation.about')}}</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('contact')}}" class="item-link">{{__('labels.navigation.contact')}}</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-xl-3 col-md-4 col-3">
                <ul class="nav-icon d-flex justify-content-end align-items-center gap-20">
                    <li class="nav-search"><a href="#canvasSearch" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft" class="nav-icon-item"><i class="icon icon-search"></i></a></li>
                    <li class="nav-account">
                        @guest
                        <a href="#login" data-bs-toggle="modal" class="nav-icon-item"><i class="icon icon-account"></i></a>
                        @endguest
                            @auth('web')
                                <a href="javascript:void(0)" class="nav-icon-item" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="icon icon-account"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item" href="{{route('account.details')}}">Account</a></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            @endauth

                    </li>
                    <li class="nav-wishlist"><a href="{{route('account.wishlist')}}" class="nav-icon-item"><i class="icon icon-heart"></i><span class="count-box">0</span></a></li>
                    <li class="nav-cart"><a href="#shoppingCart" data-bs-toggle="modal" class="nav-icon-item"><i class="icon icon-bag"></i><span class="count-box">0</span></a></li>
                </ul>
            </div>
        </div>
    </div>
</header>
<!-- /Header -->

<!-- modal login -->

<div class="modal modalCentered fade form-sign-in modal-part-content" id="login">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="header">
                <div class="demo-title">Log in</div>
                <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
            </div>
            <div class="tf-login-form">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="gap-2" action="{{ route('login') }}" method="POST" id="register-form" accept-charset="utf-8">
                    @csrf
                    <div class="tf-field style-1 mb_15">
                        <input class="tf-field-input tf-input" placeholder=" " type="email" name="email" value="{{ old('email') }}">
                        <label class="tf-field-label">Email *</label>
                    </div>
                    <div class="tf-field style-1 mb_15">
                        <input class="tf-field-input tf-input" placeholder=" " type="password" name="password">
                        <label class="tf-field-label">Password *</label>
                    </div>

                    <div class="bottom align-items-center">
                        <div class="w-100 mb_15">
                            <button type="submit" class="tf-btn btn-fill animate-hover-btn radius-3 w-100 justify-content-center">
                                <span>Login</span>
                            </button>
                        </div>

                        <div class="w-100 mb_15">
                            {{--                                    {{ route('socialite.redirect', 'google') }}--}}
                            <a href="/" class="tf-btn btn-fill animate-hover-btn radius-3 w-100 d-flex align-items-center justify-content-center border bg-white text-dark text-decoration-none" style="gap: 0.5rem;">
                                <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google" style="width: 20px; height: 20px;">
                                <span>Login with Google</span>
                            </a>
                        </div>

                    </div>
                </form>
                    <div class="w-100">
                        <a href="{{route('register')}}" class="btn-link fw-6 w-100 link">
                            Don't have an account? Register here
                            <i class="icon icon-arrow1-top-left"></i>
                        </a>
                    </div>
            </div>
        </div>
    </div>
</div>

{{--<div class="modal modalCentered fade form-sign-in modal-part-content" id="forgotPassword">--}}
{{--    <div class="modal-dialog modal-dialog-centered">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="header">--}}
{{--                <div class="demo-title">Reset your password</div>--}}
{{--                <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>--}}
{{--            </div>--}}
{{--            <div class="tf-login-form">--}}
{{--                <form class="">--}}
{{--                    <div>--}}
{{--                        <p>Sign up for early Sale access plus tailored new arrivals, trends and promotions. To opt out, click unsubscribe in our emails</p>--}}
{{--                    </div>--}}
{{--                    <div class="tf-field style-1">--}}
{{--                        <input class="tf-field-input tf-input" placeholder=" " type="email"  name="">--}}
{{--                        <label class="tf-field-label" for="">Email *</label>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <a href="#login" data-bs-toggle="modal" class="btn-link link">Cancel</a>--}}
{{--                    </div>--}}
{{--                    <div class="bottom">--}}
{{--                        <div class="w-100">--}}
{{--                            <button type="submit" class="tf-btn btn-fill animate-hover-btn radius-3 w-100 justify-content-center"><span>Reset password</span></button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div class="modal modalCentered fade form-sign-in modal-part-content" id="register">--}}
{{--    <div class="modal-dialog modal-dialog-centered">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="header">--}}
{{--                <div class="demo-title">Register</div>--}}
{{--                <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>--}}
{{--            </div>--}}
{{--            <div class="tf-login-form">--}}
{{--                <form action="{{route('web.register')}}" method="post" accept-charset="utf-8">--}}
{{--                    @csrf--}}
{{--                    <div class="tf-field style-1">--}}
{{--                        <input class="tf-field-input tf-input" placeholder=" " type="text"  name="">--}}
{{--                        <label class="tf-field-label" for="">Name</label>--}}
{{--                    </div>--}}
{{--                    <div class="tf-field style-1">--}}
{{--                        <select name="gender" class="tf-select w-100">--}}
{{--                            <option value="">Select Gender</option>--}}
{{--                            <option value="1">Male</option>--}}
{{--                            <option value="2">Female</option>--}}
{{--                        </select>--}}
{{--                        <label class="tf-field-label" for="">Gender</label>--}}
{{--                        @error('gender')--}}
{{--                        <span class="tf-error-message">{{ $message }}</span>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                    <div class="tf-field style-1">--}}
{{--                        <input class="tf-field-input tf-input" placeholder=" " type="email"  name="email">--}}
{{--                        <label class="tf-field-label" for="">Email *</label>--}}
{{--                    </div>--}}
{{--                    @error('email')--}}
{{--                    <span class="tf-error-message">{{ $message }}</span>--}}
{{--                    @enderror--}}
{{--                    <div class="tf-field style-1">--}}
{{--                        <input class="tf-field-input tf-input" placeholder="123456789" type="number"  name="phone">--}}
{{--                        <label class="tf-field-label" for="">Phone</label>--}}
{{--                        @error('phone')--}}
{{--                        <span class="tf-error-message">{{ $message }}</span>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                    <div class="tf-field style-1">--}}
{{--                        <input class="tf-field-input tf-input" placeholder=" " type="password"  name="password">--}}
{{--                        <label class="tf-field-label" for="">Password *</label>--}}
{{--                        @error('password')--}}
{{--                        <span class="tf-error-message">{{ $message }}</span>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                    <div class="tf-field style-1">--}}
{{--                        <input class="tf-field-input tf-input" placeholder=" " type="password"  name="password_confirmation">--}}
{{--                        <label class="tf-field-label" for="">Confirm Password</label>--}}
{{--                        @error('password_confirmation')--}}
{{--                        <span class="tf-error-message">{{ $message }}</span>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                    <div class="bottom">--}}
{{--                        <div class="w-100">--}}
{{--                            <button type="submit" class="tf-btn btn-fill animate-hover-btn radius-3 w-100 justify-content-center"><span>Register</span></button>--}}
{{--                        </div>--}}
{{--                        <div class="w-100">--}}
{{--                            <a href="#login" data-bs-toggle="modal" class="btn-link fw-6 w-100 link">--}}
{{--                                Already have an account? Log in here--}}
{{--                                <i class="icon icon-arrow1-top-left"></i>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<!-- /modal login -->
