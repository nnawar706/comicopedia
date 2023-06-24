<h2 class="accordion-header" id="flush-headingOne">
    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
        Top Banners<span style="margin-left:10px;font-size: 12px; color: #5a5c69">*Dimensions: 970x250</span>
    </button>
</h2>
<div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
    <div class="accordion-body">
        <div class="card card-body">
            <div class="d-flex flex-nowrap">
                @if(count($data[0]['banners']) === 0)
                    <p>No Banner Found</p>
                @else
                    @foreach($data[0]['banners'] as $item)
                        <div style="position: relative; display: inline-block">
                            <img class="img-thumbnail" src="{{ asset($item['photo_path']) }}" height="100" width="100">
                            <a href="/admin/banners/delete/{{ $item['id'] }}"><button style="position: absolute; top:15px; right:15px; padding:0; background-color: transparent; border:none; color: #fff; font-size: 20px; cursor:pointer">&times;</button></a>
                        </div>
                    @endforeach
                @endif
            </div>
            @if(auth()->guard('admin')->user()->hasPermissionTo('add banner'))
                <button type="button" class="btn btn-primary text-center" data-bs-toggle="modal"
                        data-bs-target="#updateTop" data-whatever="@mdo">
                    Add New
                </button>
            @endif
        </div>
    </div>
</div>
<div class="modal fade" id="updateTop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel1">Top Banner</h6>
            </div>
            <div class="modal-body image-body text-center">
                <form action="/admin/banners/1" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="file-drop-area">
                        <span class="choose-file-button">Choose Files</span>
                        <span class="file-message">or drag and drop files here</span>
                        <input type="file" name="images[]" class="file-input" accept=".jpg,.jpeg,.png" required multiple>
                    </div>
                    <div id="imagePreview"></div>
                    <hr>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
