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
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset($volume['image_path']) }}">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">{{ $volume['title'] }}</a></h6>
                            @if($discount != 0)
                                <h5>&#2547; {{ $volume['price'] - $discount }}</h5>
                                <p style="font-size: 10px;color: #b30000">** {{ $volume['discount'] }}% discount is applicable till {{ $volume['discount_active_till'] }}</p>
                            @else
                                <h5>&#2547; {{ $volume['price'] }}</h5>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
