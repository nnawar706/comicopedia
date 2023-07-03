@extends('ecommerce.layouts.default')

@section('content')

    @php
    if(!is_null($data['discount']))
    {
        $discount = ($data['discount'] * $data['price']) / 100;
    }
    @endphp

@include('ecommerce.includes.volume.breadcrumb')

@include('ecommerce.includes.volume.info')

@stop
