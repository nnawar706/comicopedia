<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large"
                             src="{{ asset($data['info']['image_path']) }}" alt="manga-image" height="700">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3>{{ $data['info']['item']['title'] }}, {{ $data['info']['title'] }}</h3>
                    <div class="product__details__rating">
                        @if($rate == 1)
                            <i class="fas fa-star" style="color:#FFC300"></i>
                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                        @elseif($rate == 2)
                            <i class="fas fa-star" style="color:#FFC300"></i>
                            <i class="fas fa-star" style="color:#FFC300"></i>
                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                        @elseif($rate == 3)
                            <i class="fas fa-star" style="color:#FFC300"></i>
                            <i class="fas fa-star" style="color:#FFC300"></i>
                            <i class="fas fa-star" style="color:#FFC300"></i>
                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                        @elseif($rate == 4)
                            <i class="fas fa-star" style="color:#FFC300"></i>
                            <i class="fas fa-star" style="color:#FFC300"></i>
                            <i class="fas fa-star" style="color:#FFC300"></i>
                            <i class="fas fa-star" style="color:#FFC300"></i>
                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                        @elseif($rate == 5)
                            <i class="fas fa-star" style="color:#FFC300"></i>
                            <i class="fas fa-star" style="color:#FFC300"></i>
                            <i class="fas fa-star" style="color:#FFC300"></i>
                            <i class="fas fa-star" style="color:#FFC300"></i>
                            <i class="fas fa-star" style="color:#FFC300"></i>
                        @else
                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                            <i class="fas fa-star" style="color:#D9D9D9"></i>
                        @endif
                    </div>
                    @if(!is_null($data['info']['discount']))
                        <div class="product__details__price"><s style="color: dimgrey">&#2547; {{ $data['info']['price'] }}</s> <span>&#2547; {{ $data['info']['price'] - $discount }}</span></div>
                    @else
                    <div class="product__details__price">&#2547; {{ $data['info']['price'] }}</div>
                    @endif
                    <div class="d-flex mb-3">
                        <p class="text-dark font-weight-medium mb-0 mr-3">Type:</p>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-2" name="size">
                            <label class="custom-control-label" for="size-2">Hardcover</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-1" name="size">
                            <label class="custom-control-label" for="size-1">Paperback <span style="color: #b30000">(+&#2547; 150)</span></label>
                        </div>
                    </div>
                    <div class="product__details__quantity">
                        <div class="quantity">
                            <div class="pro-qty">
                                <input type="text" value="1" name="quantity">
                            </div>
                        </div>
                    </div>
                    <a href="#" class="primary-btn">ADD TO CART</a>
                    <a href="#" class="heart-icon"><i style="color: #6f6f6f" class="fa fa-heart"></i></a>
                    <ul>
                        <li><b>Volume ID</b> <span>{{ $data['info']['product_unique_id'] }}</span></li>
                        <li><b>Author</b> <span>{{ $data['info']['item']['author'] }}</span></li>
                        <li><b>Magazine</b> <span>{{ $data['info']['item']['magazine'] }}</span></li>
                        <li><b>Genre</b> <span>{{ $data['info']['item']['genre']['name'] }}</span></li>
                        <li><b>ISBN No</b> <span>{{ $data['info']['isbn'] }}</span></li>
                        @if($data['info']['quantity'] != 0 && $data['info']['status'] != 0)
                            <li><b>Availability</b> <span>In Stock</span></li>
                        @else
                            <li><b>Availability</b> <span style="color: #b30000">Out of Stock</span></li>
                        @endif
                        <li><b>Keywords</b> <span>{{ $data['info']['item']['meta_keywords'] }}</span></li>
                        <li><b>Share on</b>
                            <div class="share">
                                <a href="#"><i class="fab fa-facebook"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-pinterest"></i></a>
                            </div>
                        </li>
                        @if(!is_null($data['info']['discount']))
                            <li><span style="font-size: 12px;color: #b30000">*** {{ $data['info']['discount'] }}% discount is applicable till {{ \Carbon\Carbon::parse($data['info']['discount_active_till'])->format('F d, Y') }}</span></li>
                        @endif
                    </ul>
                </div>
            </div>
            @include('ecommerce.includes.volume.reviews')
        </div>
    </div>
</section>
<!-- Product Details Section End -->
