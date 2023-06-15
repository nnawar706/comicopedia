@extends('admin.layouts.default')

@section('content')

<div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
            <a href="#" class="btn btn-danger btn-icon-split" style="float: right; margin-bottom:10px;">
                <span class="icon text-white-50"><i class="fas fa-trash"></i></span>
                <span class="text">Deactivate Account</span>
            </a>
        </div>
    </div>
    <div class="row">
        @include('admin.includes.profile.update-info')
    </div>
    <div class="row">
        @include('admin.includes.profile.update-password')
    </div>
    
</div>

@stop