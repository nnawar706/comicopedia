@extends('admin.layouts.default')

@section('content')

<div class="container-fluid">
    <!-- Page Heading -->
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('show-items') }}">Admins</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $data['user']['name'] }}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Role</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['user']['roles'][0]['name'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-id-badge fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Joined On</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['user']['created_at'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Avg. Active Hours
                            </div>
                            <div class="row no-gutters align-items-center">
                                {{-- @if (($data['like_count'] + $data['dislike_count']) != 0)
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ ($data['like_count']/($data['like_count']+$data['dislike_count']))*100 }}%</div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar"
                                                style="width: {{ ($data['like_count']/($data['like_count']+$data['dislike_count']))*100 }}%" aria-valuenow="{{ ($data['like_count']/($data['like_count']+$data['dislike_count']))*100 }}" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">0%</div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar"
                                                style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                @endif --}}
                                <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar"
                                                style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-timer fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Permissions</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($data['user']['roles'][0]['permissions']) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">User Information</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3 text-center">
                        <img src="{{ asset($data['user']['profile_photo_path']) }}" class="rounded mx-auto d-block" alt="user-profile-photo" height="120" width="120">
                    </div>
                    <div class="mb-3">
                        <div class="card">
                            <div class="card-body">
                                Name: {{ $data['user']['name'] }}
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="card">
                            <div class="card-body">
                                Email Address: {{ $data['user']['email'] }}
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="card">
                            <div class="card-body">
                                Contact: {{ $data['user']['contact'] }}
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="card">
                            <div class="card-body">
                                Permissions:<hr>
                                <div class="row">
                                    <div class="col-md-3">
                                @foreach ($data['permissions'] as $key => $permission)
                                    @if($key%15 == 0 && $key!=0)
                                        </div><div class="col-md-3">
                                    @endif
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                        {{ $data['user']['roles'][0]['permissions']->contains($permission->id) ? 'checked' : '' }} style="pointer-events: none;">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
