@extends('admin.layouts.default')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <h5 class="h4 mb-1 text-gray-800">General Setting</h5>
            <br>
            <p>
                <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" 
                aria-controls="collapseExample1">
                    Logo & Favicon
                </a>
                <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" 
                aria-controls="collapseExample2">
                    Contact Information
                </a>
                <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="false" 
                aria-controls="collapseExample3">
                    Website Information
                </a>
                <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample4" role="button" aria-expanded="false" 
                aria-controls="collapseExample4">
                    Social Media
                </a>
            </p>
            <div class="collapse show" id="collapseExample1">
                <div class="card card-body">
                    This panel is hidden by default but revealed when the user activates the relevant trigger.
                </div>
            </div>
            <div class="collapse" id="collapseExample2">
                <div class="card card-body">
                    Some placeholder content for the collapse component.
                </div>
            </div>
            <div class="collapse" id="collapseExample3">
                <div class="card card-body">
                    This panel is hidden by default but revealed when the user activates the relevant trigger.
                </div>
            </div>
            <div class="collapse" id="collapseExample4">
                <div class="card card-body">
                    This panel is hidden by default but revealed when the user activates the relevant trigger.
                </div>
            </div>
        </div>
    </div>
</div>

@stop