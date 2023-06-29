<!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    @foreach($data['items'] as $item)
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{ asset($item['image_path']) }}">
                            <h5><a href="{{ route('item-info', ['id' => $item['id']]) }}">{{ $item['title'] }}</a></h5>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->
