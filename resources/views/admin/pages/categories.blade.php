@extends('admin.layouts.default')

@if (session('message'))
        <div class="toast show fixed-bottom ms-auto text-bg-danger" style="--bs-bg-opacity: .8;" animation="true" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('message') }}
                </div>
            </div>
        </div>
@endif

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <br>
            <h5 class="h5 mb-1 text-gray-800">Categories</h5>
            <br>
            <button style="margin-bottom:30px;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add Category
            </button>
            <button style="margin-bottom:30px;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                Re-shuffle Rows
            </button>

            @include('admin.includes.categories.create')

            @include('admin.includes.categories.reshuffle')

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">No of Items</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <th scope="row">{{ $item['order'] }}</th>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['num_items'] }}</td>
                            {{-- <td></td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@stop
