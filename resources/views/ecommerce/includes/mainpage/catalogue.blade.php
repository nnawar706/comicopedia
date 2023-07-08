<section class="latest-product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>New Arrivals</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            @if(count($data['catalogues'][0]['volumes']) == 0)
                                <p style="color: dimgrey">No Item Found.</p>
                            @else
                            @foreach($data['catalogues'][0]['volumes'] as $key=>$item)
                                @if($key%3 == 0 && $key!=0)
                                </div><div class="latest-prdouct__slider__item">
                                @endif
                                <a href="{{ route('item-info',['id'=>$item['id']]) }}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{ asset($item['image_path']) }}" alt="item-image">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ $item['item']['title'] }}, {{ $item['title'] }}</h6>
                                        <span>&#2547; {{ $item['price'] }}</span>
                                    </div>
                                </a>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Featured</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            @if(count($data['catalogues'][3]['volumes']) == 0)
                                <p style="color: dimgrey">No Item Found.</p>
                            @else
                            @foreach($data['catalogues'][3]['volumes'] as $key=>$item)
                            @if($key%3 == 0 && $key!=0)
                            </div><div class="latest-prdouct__slider__item">
                            @endif
                            <a href="{{ route('item-info',['id'=>$item['id']]) }}" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{ asset($item['image_path']) }}" alt="item-image">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>{{ $item['item']['title'] }}, {{ $item['title'] }}</h6>
                                    <span>&#2547; {{ $item['price'] }}</span>
                                </div>
                            </a>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Bestsellers</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            @if(count($data['catalogues'][2]['volumes']) == 0)
                                <p style="color: dimgrey">No Item Found.</p>
                            @else
                            @foreach($data['catalogues'][2]['volumes'] as $key=>$item)
                            @if($key%3 == 0 && $key!=0)
                            </div><div class="latest-prdouct__slider__item">
                            @endif
                            <a href="{{ route('item-info',['id'=>$item['id']]) }}" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{ asset($item['image_path']) }}" alt="item-image">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>{{ $item['item']['title'] }}, {{ $item['title'] }}</h6>
                                    <span>&#2547; {{ $item['price'] }}</span>
                                </div>
                            </a>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
