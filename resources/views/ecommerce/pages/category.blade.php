@extends('ecommerce.layouts.default')

@section('content')

@include('ecommerce.includes.category.breadcrumb')

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    @include('ecommerce.includes.category.items')
                    @include('ecommerce.includes.category.types')
                    @include('ecommerce.includes.category.price')
                    @include('ecommerce.includes.category.latest')
                </div>
            </div>
            <div class="col-lg-9 col-md-7">
                @include('ecommerce.includes.category.offers')
                @include('ecommerce.includes.category.filters')
                @include('ecommerce.includes.category.shop-list')
            </div>
        </div>
    </div>
</section>

@stop
