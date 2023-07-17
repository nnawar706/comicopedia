<!-- Related Product Section Begin -->
<section class="categories">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>You may also like</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="categories__slider owl-carousel">
                @foreach ($data['related'] as $value)
                <div class="col-lg-3">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset($value->image_path) }}">
                            <ul class="product__item__pic__hover">
                                <li><a href="{{ route('volume-info', ['id' => $value->volume_id]) }}"><i class="fa fa-info"></i></a></li>
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="{{ route('add-to-cart', ['volume_id' => $value->volume_id]) }}"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <a href="{{ route('volume-info', ['id' => $value->volume_id]) }}">
                            <div class="product__item__text">
                                <h6>{{ $value->item }}, {{ $value->volume }}</h6>
                                @if(is_null($value->discount))
                                    <h6>&#2547; {{ $value->price }}</h6>
                                @else
                                    @php
                                        $discount = ($value['discount'] * $value['price']) / 100;
                                    @endphp
                                    <h6>
                                        <s style="color: dimgrey">&#2547; {{ $value->price }}</s>
                                        <span style="color: #b30000">&#2547; {{ $value->price - $discount }}</span>
                                        <sup style="font-size: 11px;color: #b30000">(till {{ \Carbon\Carbon::parse($value->discount_active_till)->format('F d, Y') }})</sup>
                                    </h6>
                                @endif
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- Related Product Section End -->
