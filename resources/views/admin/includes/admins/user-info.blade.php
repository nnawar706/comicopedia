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
