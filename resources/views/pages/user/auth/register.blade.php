@extends('layouts.app')

@section('content')
    <main>
        <section class="flat-spacing-10 mt_37">
            <div class="container">
                <div class="form-register-wrap">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="flat-title align-items-start gap-0 mb_30 px-0">
                        <h5 class="mb_18">Register</h5>
                        <p class="text_black-2">Sign up for early Sale access plus tailored new arrivals, trends and promotions. To opt out, click unsubscribe in our emails</p>
                    </div>
                    <div class="tf-login-form">
                        <form class="gap-2" action="{{ route('register') }}" method="POST" id="register-form" accept-charset="utf-8">
                            @csrf

                            <div class="tf-field style-1 mb_15">
                                <input class="tf-field-input tf-input" placeholder=" " type="text" name="name" value="{{ old('name') }}">
                                <label class="tf-field-label">Name</label>
                                @error('name')
                                <span class="tf-error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="tf-field style-1 mb_15">
                                <select name="gender" class="tf-select w-100">
                                    <option value="">Select Gender</option>
                                    <option value="1" {{ old('gender') == '1' ? 'selected' : '' }}>Male</option>
                                    <option value="2" {{ old('gender') == '2' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('gender')
                                <span class="tf-error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="tf-field style-1 mb_15">
                                <input class="tf-field-input tf-input" placeholder=" " type="email" name="email" value="{{ old('email') }}">
                                <label class="tf-field-label">Email *</label>
                                @error('email')
                                <span class="tf-error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="tf-field style-1 mb_15">
                                <input class="tf-field-input tf-input" placeholder="123456789" type="number" name="phone" value="{{ old('phone') }}">
                                <label class="tf-field-label">Phone</label>
                                @error('phone')
                                <span class="tf-error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="tf-field style-1 mb_15">
                                <input class="tf-field-input tf-input" placeholder=" " type="password" name="password">
                                <label class="tf-field-label">Password *</label>
                                @error('password')
                                <span class="tf-error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="tf-field style-1 mb_15">
                                <input class="tf-field-input tf-input" placeholder=" " type="password" name="password_confirmation">
                                <label class="tf-field-label">Confirm Password</label>
                                @error('password_confirmation')
                                <span class="tf-error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="bottom">
                                <div class="w-100 mb_15">
                                    <button type="submit" class="tf-btn btn-fill animate-hover-btn radius-3 w-100 justify-content-center">
                                        <span>Register</span>
                                    </button>
                                </div>

                                <div class="w-100 mb_24">
{{--                                    {{ route('socialite.redirect', 'google') }}--}}
                                    <a href="/" class="tf-btn btn-fill animate-hover-btn radius-3 w-100 d-flex align-items-center justify-content-center border bg-white text-dark text-decoration-none" style="gap: 0.5rem;">
                                        <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google" style="width: 20px; height: 20px;">
                                        <span>Register with Google</span>
                                    </a>
                                </div>

                                <div class="w-100">
                                    <a href="{{route('login')}}" class="btn-link fw-6 w-100 link">
                                        Already have an account? Log in here
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
