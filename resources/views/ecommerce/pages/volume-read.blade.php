@extends('ecommerce.layouts.default')

@section('content')

    @php
    if(!is_null($data['discount']))
    {
        $discount = ($data['discount'] * $data['price']) / 100;
    }
    $rating = 0;
    $rate = 0;

//    if(count($data['reviews']) !=0)
//    {
//        foreach($data['reviews'] as $review)
//        {
//            $rating += $review['rating'];
//        }
//
//        $rate = ($rating / ($data['review_count']*5)) * 100;
//    }
    @endphp

@include('ecommerce.includes.volume.breadcrumb')

@include('ecommerce.includes.volume.info')

@stop
