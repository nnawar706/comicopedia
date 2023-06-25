<h2 class="accordion-header" id="flush-heading{{ $key }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $key }}" aria-expanded="false" aria-controls="flush-collapseOne">
                                {{ $item['name'] }}
                            </button>
                        </h2>
                        <div id="flush-collapse{{ $key }}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{ $key }}" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <div class="card card-body">
                                    <div>
                                        Permissions:<hr>
                                        <form method="post" action="{{ route('update-role',['id' => $item['id']])}}">
                                        @method('PUT')
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-3">
                                        @foreach ($data['permissions'] as $index => $permission)
                                            @if($index%15 == 0 && $index!=0)
                                                </div><div class="col-md-3">
                                            @endif
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                                {{ $item['permissions']->contains($permission->id) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                        </div>
                                    </div>
                                    @if(auth()->guard('admin')->user()->hasPermissionTo('role & permissions'))
                                        <hr>
                                        <button type="submit" class="btn btn-primary" style="margin-left: 45%">
                                            Update
                                        </button>
                                        </form>
                                    @endif
                                </div></div>
                            </div>
                        </div>
