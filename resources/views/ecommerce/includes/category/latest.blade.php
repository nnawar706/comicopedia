<div class="sidebar__item">
    <div class="latest-product__text">
        <h4>New Arrivals</h4>
        <div class="latest-product__slider owl-carousel">
            <div class="latest-prdouct__slider__item">
                @foreach($data['latest'] as $key => $value)
                @if($key%3 == 0 && $key!=0)
                    </div><div class="latest-prdouct__slider__item">
                @endif
                <a href="{{ route('volume-info',['id' => $value['id']]) }}" class="latest-product__item">
                    <div class="latest-product__item__pic">
                        <img src="{{ asset($value['image_path']) }}" height="110" width="110" alt="volume-image">
                    </div>
                    <div class="latest-product__item__text">
                        <h6>{{ $value['item']['title'] }}, {{ $value['title']}}</h6>
                        <span>&#2547; {{ $value['price'] }} </span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
