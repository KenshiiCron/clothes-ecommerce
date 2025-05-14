

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
                        <div class="">
                            <h6 class="mb_20">Details</h6>
                            <form class="" id="form-password-change" action="#">
                                <div class="tf-field style-1 mb_15">
                                    <input class="tf-field-input tf-input" placeholder=" " type="text" id="property1" name="first name">
                                    <label class="tf-field-label fw-4 text_black-2" for="property1">First name</label>
                                </div>
                                <div class="tf-field style-1 mb_15">
                                    <input class="tf-field-input tf-input" placeholder=" " type="text" id="property2" name="last name">
                                    <label class="tf-field-label fw-4 text_black-2" for="property2">Last name</label>
                                </div>
                                <div class="tf-field style-1 mb_15">
                                    <input class="tf-field-input tf-input" placeholder=" " type="email" id="property3" name="email">
                                    <label class="tf-field-label fw-4 text_black-2" for="property3">Email</label>
                                </div>
                                <h6 class="mb_20">Password Change</h6>
                                <div class="tf-field style-1 mb_30">
                                    <input class="tf-field-input tf-input" placeholder=" " type="password" id="property4" name="password">
                                    <label class="tf-field-label fw-4 text_black-2" for="property4">Current password</label>
                                </div>
                                <div class="tf-field style-1 mb_30">
                                    <input class="tf-field-input tf-input" placeholder=" " type="password" id="property5" name="password">
                                    <label class="tf-field-label fw-4 text_black-2" for="property5">New password</label>
                                </div>
                                <div class="tf-field style-1 mb_30">
                                    <input class="tf-field-input tf-input" placeholder=" " type="password" id="property6" name="password">
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
