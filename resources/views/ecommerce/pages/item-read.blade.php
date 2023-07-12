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

    $availability = 0;

    foreach($data['volume_list'] as $volume)
    {
        if($volume['status'] == 1 && $volume['quantity'] != 0)
        {
            ++$availability;
        }
    }
    @endphp

@include('ecommerce.includes.general.navbar')
@include('ecommerce.includes.item.breadcrumb')
@include('ecommerce.includes.item.info')
@include('ecommerce.includes.item.volume-list')

@stop
