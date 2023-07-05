<div class="product__discount">
    <div class="section-title product__discount__title">
        <h2>Offers</h2>
    </div>
    <div class="row">
        <div class="product__discount__slider owl-carousel">
            @foreach($data['offers'] as $value)
            <div class="col-lg-4">
                <div class="product__discount__item">
                    <div class="product__discount__item__pic set-bg"
                        data-setbg="{{ asset($value['image_path']) }}">
                        <div class="product__discount__percent">-{{ $value['discount'] }}%</div>
                        <ul class="product__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="product__discount__item__text">
                        <span>{{ $value['item']['title'] }}</span>
                        <h5><a href="#">{{ $value['title'] }}</a></h5>
                        <div class="product__item__price">$30.00 <span>$36.00</span></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
