@extends('layouts.app')


@section('content')
    <main>
        <section class="flat-spacing-10">
            <div class="container">
                <div class="form-register-wrap">
                        <h5 class="mb_18">Login</h5>
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
                            <div class="w-100 mb_10">
                                <a href="{{route('password.request')}}" class="btn-link fw-6 w-100 link">
                                    Forgot your password?
                                </a>
                            </div>

                            <div class="bottom">
                                <div class="w-100 mb_15">
                                    <button type="submit" class="tf-btn btn-fill animate-hover-btn radius-3 w-100 justify-content-center">
                                        <span>Login</span>
                                    </button>
                                </div>

                                <div class="w-100 mb_24">
                                    {{--                                    {{ route('socialite.redirect', 'google') }}--}}
                                    <a href="/" class="tf-btn btn-fill animate-hover-btn radius-3 w-100 d-flex align-items-center justify-content-center border bg-white text-dark text-decoration-none" style="gap: 0.5rem;">
                                        <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google" style="width: 20px; height: 20px;">
                                        <span>Login with Google</span>
                                    </a>
                                </div>

                                <div class="w-100">
                                    <a href="{{route('register')}}" class="btn-link fw-6 w-100 link">
                                        Don't have an account? Register here
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
