<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('uploads/banners/1687893171366.png') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>{{ $data['title'] }}</h2>
                    <div class="breadcrumb__option">
                        <a href="{{ route('welcome') }}">Home</a>
                        <a href="{{ route('item-info', ['id' => $data['item_id']]) }}">Item</a>
                        <span>{{ $data['item']['title'] }}, {{ $data['title'] }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
