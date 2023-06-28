    <!-- Categories Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            @foreach($data['items'] as $item)
            <div class="col-lg-3 col-md-6 pb-1">
                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <p class="text-right">{{ $item['volumes'] }} Volumes</p>
                    <a href="" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" height="400" width="300" src="{{ asset($item['image_path']) }}" alt="series-image">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">{{ $item['title'] }}</h5>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- Categories End -->
