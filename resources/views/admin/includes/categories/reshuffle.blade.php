<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Re-shuffle Categories</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route('shuffle-categories') }}">
                @method('PUT')
                <div class="modal-body shuffle-body">
                    @csrf
                    <ul class="sortable-list">
                        @foreach($data as $item)
                            <li class="item" draggable="true">
                                <div class="details">
                                    <span>{{ $item['name'] }}</span>
                                    <input name="{{ $item['name'] }}" hidden>
                                </div>
                                <i class="fa fa-bars"></i>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
