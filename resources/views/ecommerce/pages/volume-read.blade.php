@extends('ecommerce.layouts.default')

@section('content')

    @php
    if(!is_null($data['info']['discount']))
    {
        $discount = ($data['info']['discount'] * $data['info']['price']) / 100;
    }
    $rating = 0;
    $rate = 0;

    if(count($data['info']['reviews']) !=0)
    {
        foreach($data['info']['reviews'] as $review)
        {
            $rating += $review['rating'];
        }

        $rate = round($rating / $data['info']['review_count']);
    }
    @endphp

@include('ecommerce.includes.general.navbar')
@include('ecommerce.includes.volume.breadcrumb')
@include('ecommerce.includes.volume.info')
@include('ecommerce.includes.volume.related')

@stop
