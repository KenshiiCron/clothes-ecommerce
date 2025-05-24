@extends('layouts.app')

@section('content')
    <div class="tf-page-title">
        <div class="container-full">
            <div class="heading text-center">{{__('labels.fields.our_shop')}}</div>
            <p class="text-center text-2 text_black-2 mt_5">{{__('labels.text.see_our_shop')}}</p>
        </div>
    </div>
    <!-- /page-title -->

    <!-- Section Product -->

    <livewire:shop />
@endsection
