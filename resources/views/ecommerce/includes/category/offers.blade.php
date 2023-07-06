<div class="product__discount">
    <div class="section-title product__discount__title">
        <h2>Offers</h2>
    </div>
    <div class="row">
        <div class="product__discount__slider owl-carousel">
            @foreach($data['offers'] as $value)
                @php
                $discount = ($value['discount'] * $value['price'])/100;
                @endphp
            <div class="col-lg-4">
                <div class="product__discount__item">
                    <div class="product__discount__item__pic set-bg"
                        data-setbg="{{ asset($value['image_path']) }}">
                        <div class="product__discount__percent">-{{ $value['discount'] }}%</div>
                        <ul class="product__item__pic__hover">
                            <li><a href="{{ route('add-to-wishlist', ['volume_id'=>$value['id']]) }}"><i class="fa fa-heart"></i></a></li>
                            <li><a href="{{ route('volume-info', ['id'=>$value['id']]) }}"><i class="fa fa-info"></i></a></li>
                            <li><a href="{{ route('add-to-cart', ['volume_id' => $value['id']]) }}"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="product__discount__item__text">
                        <span>{{ $value['item']['title'] }}</span>
                        <span style="color: #f30000; font-size: 11px">Applicable till {{ \Carbon\Carbon::parse($value['discount_active_till'])->format('F d, Y') }}</span>
                        <h5><a href="{{ route('volume-info', ['id'=>$value['id']]) }}">{{ $value['title'] }}</a></h5>
                        <div class="product__item__price">&#2547; {{ $value['price'] - $discount }} <span>&#2547; {{ $value['price'] }}</span></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
