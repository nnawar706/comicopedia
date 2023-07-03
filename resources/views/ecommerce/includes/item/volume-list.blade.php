<section class="related-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h3>Volumes</h3>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($data['volume_list'] as $volume)
                @php
                    $discount = (($volume['discount'] ? : 0) * $volume['price'])/100;
                @endphp
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="shadow p-3 mb-5 bg-white rounded product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset($volume['image_path']) }}">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <a href="{{ route('volume-info', ['id' => $volume['id']]) }}"><div class="product__item__text">
                            <h6>{{ $volume['title'] }}</h6>
                            <h5>&#2547; {{ $volume['price'] }}</h5>
                            @if($discount != 0)
                                <p style="font-size: 11px;color: #b30000">** {{ $volume['discount'] }}% discount is applicable till {{ \Carbon\Carbon::parse($volume['discount_active_till'])->format('F d, Y') }}</p>
                            @endif
                        </div></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
