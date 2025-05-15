

@extends('layouts.app')

@section('content')
    <div class="tf-page-title">
        <div class="container-full">
            <div class="heading text-center">Account Details</div>
        </div>
    </div>
    <!-- /page-title -->

    <!-- page-cart -->
    <section class="flat-spacing-11">
        <div class="container">
            <div class="row">
                <livewire:account-sidebar />
                <div class="col-lg-9">
                    <div class="my-account-content account-edit">
                        <h5 class="fw-5 mb_20">Account</h5>
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="">
                            <h6 class="mb_20">Details</h6>
                            <form class="" id="form-account-details" method="POST" action="{{ route('account.details.update') }}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="tf-field style-1 mb_15">
                                    <input class="tf-field-input tf-input" value="{{$user->name}}" type="text" id="property1" name="name">
                                    <label class="tf-field-label fw-4 text_black-2"  for="property1">Name</label>
                                    @error('name')
                                    <span class="tf-error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="tf-field style-1 mb_15">
                                    <select name="gender" class="tf-select w-100">
                                        <option value="">Select Gender</option>
                                        @foreach(\App\Enums\GenderEnum::cases() as $gender)

                                            <option value="{{$gender}}" @selected($user->gender === $gender)>
                                                {{$gender->label()}}</option>
                                        @endforeach
                                    </select>
                                    @error('gender')
                                    <span class="tf-error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="tf-field style-1 mb_15">
                                    <input class="tf-field-input tf-input" value="{{$user->email}}" type="email" id="property3" name="email">
                                    <label class="tf-field-label fw-4 text_black-2" for="property3">Email</label>
                                    @error('email')
                                    <span class="tf-error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="tf-field style-1 mb_15">
                                    <input class="tf-field-input tf-input" value="{{$user->phone}}" type="number" id="property3" name="phone">
                                    <label class="tf-field-label fw-4 text_black-2" for="property3">Phone</label>
                                    @error('phone')
                                    <span class="tf-error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="tf-field style-1 mb_15">
                                    <input class="tf-field-input tf-input" value="{{$user->address}}" type="text" id="property3" name="address">
                                    <label class="tf-field-label fw-4 text_black-2" for="property3">Shipping Address</label>
                                    @error('address')
                                    <span class="tf-error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb_20">
                                    <button type="submit" class="tf-btn w-100 radius-3 btn-fill animate-hover-btn justify-content-center">Save Details</button>
                                </div>
                            </form>
                                <h6 class="mb_20">Password Change</h6>
                            <form class="" id="form-password-change" method="POST" action="{{ route('password.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="tf-field style-1 mb_30">
                                    <input class="tf-field-input tf-input" placeholder=" " type="password" id="property4" name="current_password">
                                    <label class="tf-field-label fw-4 text_black-2" for="property4">Current password</label>
                                    @error('current_password')
                                    <span class="tf-error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="tf-field style-1 mb_30">
                                    <input class="tf-field-input tf-input" placeholder=" " type="password" id="property5" name="password">
                                    <label class="tf-field-label fw-4 text_black-2" for="property5">New password</label>
                                    @error('password')
                                    <span class="tf-error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="tf-field style-1 mb_30">
                                    <input class="tf-field-input tf-input" placeholder=" " type="password" id="property6" name="password_confirmation">
                                    <label class="tf-field-label fw-4 text_black-2" for="property6">Confirm password</label>
                                </div>
                                <div class="mb_20">
                                    <button type="submit" class="tf-btn w-100 radius-3 btn-fill animate-hover-btn justify-content-center">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- page-cart -->


    <div class="btn-sidebar-account">
        <button data-bs-toggle="offcanvas" data-bs-target="#mbAccount" aria-controls="offcanvas"><i class="icon icon-sidebar-2"></i></button>
    </div>
@endsection
