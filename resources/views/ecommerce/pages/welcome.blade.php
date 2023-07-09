@extends('ecommerce.layouts.default')

@section('content')

@include('ecommerce.includes.mainpage.navbar')
@include('ecommerce.includes.mainpage.items')
@include('ecommerce.includes.mainpage.featured')
@include('ecommerce.includes.mainpage.catalogue')
@if(count($data['catalogues'][2]['volumes']) != 0)
    @include('ecommerce.includes.mainpage.upcoming')
@endif

@stop
