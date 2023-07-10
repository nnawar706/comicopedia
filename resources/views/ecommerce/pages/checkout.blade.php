@extends('ecommerce.layouts.default')

@section('content')

    @include('ecommerce.includes.checkout.breadcrumb')

    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6><i class="fas fa-user-tag"></i> <a style="text-decoration: underline !important;" href="{{ route('available-coupons') }}">Click here</a> to search for available coupons
                    </h6>
                </div>
            </div>
            @include('ecommerce.includes.checkout.billing-form')
        </div>
    </section>


@stop
