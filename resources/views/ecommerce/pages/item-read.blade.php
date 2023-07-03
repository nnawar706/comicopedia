@extends('ecommerce.layouts.default')

@section('content')

    @php
    if(($data['like_count'] + $data['dislike_count']) == 0)
    {
        $rate = 0;
    }
    else
    {
        $rate = round(($data['like_count'] * 5)/($data['like_count'] + $data['dislike_count']));
    }
    @endphp

@include('ecommerce.includes.item.breadcrumb')

@include('ecommerce.includes.item.info')

@stop
