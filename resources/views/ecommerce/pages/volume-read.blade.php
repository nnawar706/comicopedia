@extends('ecommerce.layouts.default')

@section('content')

    @php
    if(!is_null($data['discount']))
    {
        $discount = ($data['discount'] * $data['price']) / 100;
    }
    $rating = 0;
    $rate = 0;

    if(count($data['reviews']) !=0)
    {
        foreach($data['reviews'] as $review)
        {
            $rating += $review['rating'];
        }

        $rate = round($rating / $data['review_count']);
    }
    @endphp

@include('ecommerce.includes.volume.breadcrumb')

@include('ecommerce.includes.volume.info')

@stop
