@extends('layouts.app')


@section('content')
    <main>
        <section class="flat-spacing-10" style="padding: 150px 150px;">
            <div class="container">
                <div class="form-register-wrap">
                        <h6 class="mb_18">Please enter your email address and we will send you a link to reset your password.</h6>
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
                        <form class="gap-2" action="{{ route('password.email') }}" method="POST" id="register-form" accept-charset="utf-8">
                            @csrf
                            <div class="tf-field style-1 mb_15">
                                <input class="tf-field-input tf-input" placeholder=" " type="email" name="email" value="{{ old('email') }}">
                                <label class="tf-field-label">Email</label>
                            </div>
                            <div class="bottom">
                                <div class="w-100 mb_15">
                                    <button type="submit" class="tf-btn btn-fill animate-hover-btn radius-3 w-100 justify-content-center">
                                        <span>Send Email</span>
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
