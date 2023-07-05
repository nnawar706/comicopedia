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
                </div>
            </div>
        </div>
    </div>
</section>

@stop
