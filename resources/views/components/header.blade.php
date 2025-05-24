<!-- Header -->
<livewire:header-component/>
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
                        <label class="tf-field-label">{{__('labels.fields.email')}} *</label>
                    </div>
                    <div class="tf-field style-1 mb_15">
                        <input class="tf-field-input tf-input" placeholder=" " type="password" name="password">
                        <label class="tf-field-label">{{__('labels.fields.password')}} *</label>
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
                                <span>{{__('labels.text.login_with_google')}}</span>
                            </a>
                        </div>
                    </div>
                </form>
                    <div class="w-100 mb_10">
                        <a href="{{route('password.request')}}" class="btn-link fw-6 w-100 link">
                            {{__('labels.text.forgot_password')}}?
                        </a>
                    </div>
                    <div class="w-100">
                        <a href="{{route('register')}}" class="btn-link fw-6 w-100 link">
                            {{__('labels.text.dont_have_account')}}
                            <i class="icon icon-arrow1-top-left"></i>
                        </a>
                    </div>
            </div>
        </div>
    </div>
</div>
    <livewire:side-cart/>



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
