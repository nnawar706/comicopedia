<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('uploads/banners/1687893171366.png') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>{{ $data['info']['title'] }}</h2>
                    <div class="breadcrumb__option">
                        <a href="{{ route('welcome') }}">Home</a>
                        <a href="{{ route('item-info', ['id' => $data['info']['item_id']]) }}">Item</a>
                        <span>{{ $data['info']['item']['title'] }}, {{ $data['info']['title'] }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
