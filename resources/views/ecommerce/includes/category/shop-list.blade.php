<div class="row">
    @foreach($data['catalogue']->items() as $value)
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="product__item">
            <div class="product__item__pic set-bg" data-setbg="{{ asset($value['image_path']) }}">
                <ul class="product__item__pic__hover">
                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                    <li><a href="{{ route('volume-info', ['id'=>$value['id']]) }}"><i class="fa fa-info"></i></a></li>
                    <li><a href="{{ route('add-to-cart', ['volume_id' => $value['id']]) }}"><i class="fa fa-shopping-cart"></i></a></li>
                </ul>
            </div>
            <div class="product__item__text">
                <h6><a href="{{ route('volume-info', ['id'=>$value['id']]) }}">{{ $value['item']['title'] }}, {{ $value['title'] }}</a></h6>
                <h5>${{ $value['price'] }}</h5>
            </div>
        </div>
    </div>
    @endforeach
    <div class="product__pagination">
        {{$data['catalogue']->links('pagination::bootstrap-5')}}
    </div>
</div>
