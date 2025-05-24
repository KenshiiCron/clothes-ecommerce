@extends('layouts.app')

@section('content')
    <main>
        <section class="flat-spacing-10 mt_37">
            <div class="container">
                <div class="form-register-wrap">
                    <div class="flat-title align-items-start gap-0 mb_20 px-0">
                        <h5 class="mb_18">{{__('labels.fields.register')}}</h5>
                        <p class="text_black-2">{{__('labels.text.sign_up_here')}}!</p>
                    </div>
                    <div class="tf-login-form">
                        <form class="gap-2" action="{{ route('register') }}" method="POST" id="register-form" accept-charset="utf-8">
                            @csrf

                            <div class="tf-field style-1 mb_15">
                                <input class="tf-field-input tf-input" placeholder=" " type="text" name="name" value="{{ old('name') }}">
                                <label class="tf-field-label">{{__('labels.fields.name')}}</label>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="tf-field style-1 mb_15">
                                <select name="gender" class="tf-select w-100">
                                    <option value="">{{__('labels.fields.select')}} {{__('labels.fields.gender')}}</option>
                                    <option value="1" {{ old('gender') == '1' ? 'selected' : '' }}>{{__('labels.fields.male')}}</option>
                                    <option value="2" {{ old('gender') == '2' ? 'selected' : '' }}>{{__('labels.fields.female')}}</option>
                                </select>
                                @error('gender')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="tf-field style-1 mb_15">
                                <input class="tf-field-input tf-input" placeholder=" " type="email" name="email" value="{{ old('email') }}">
                                <label class="tf-field-label">{{__('labels.fields.email')}} *</label>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="tf-field style-1 mb_15">
                                <input class="tf-field-input tf-input" placeholder="123456789" type="number" name="phone" value="{{ old('phone') }}">
                                <label class="tf-field-label">{{__('labels.fields.phone')}} *</label>
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="tf-field style-1 mb_15">
                                <input class="tf-field-input tf-input" placeholder=" " type="password" name="password">
                                <label class="tf-field-label">{{__('labels.fields.password')}} *</label>
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="tf-field style-1 mb_15">
                                <input class="tf-field-input tf-input" placeholder=" " type="password" name="password_confirmation">
                                <label class="tf-field-label">{{__('labels.fields.confirm_password')}}</label>
                                @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="bottom">
                                <div class="w-100 mb_15">
                                    <button type="submit" class="tf-btn btn-fill animate-hover-btn radius-3 w-100 justify-content-center">
                                        <span>{{__('labels.fields.register')}}</span>
                                    </button>
                                </div>

                                <div class="w-100 mb_24">
{{--                                    {{ route('socialite.redirect', 'google') }}--}}
                                    <a href="/" class="tf-btn btn-fill animate-hover-btn radius-3 w-100 d-flex align-items-center justify-content-center border bg-white text-dark text-decoration-none" style="gap: 0.5rem;">
                                        <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google" style="width: 20px; height: 20px;">
                                        <span>{{__('labels.text.register_with_google')}}</span>
                                    </a>
                                </div>

                                <div class="w-100">
                                    <a href="{{route('login')}}" class="btn-link fw-6 w-100 link">
                                        {{__('labels.text.already_have_account')}}
                                        <i class="icon icon-arrow1-top-left"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
