<!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="{{ asset($data['image_path']) }}" alt="manga-image" height="750">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            @foreach($data['volume_list'] as $key => $volume)
                            <img data-imgbigurl="{{ asset($volume['image_path']) }}"
                                src="{{ asset($volume['image_path']) }}" alt="product-image">
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{ $data['title'] }}</h3>
                        <div class="product__details__rating">
                            @if($rate === 1)
                                <i class="fas fa-star" style="color:#FFC300"></i>
                                <i class="fas fa-star" style="color:#D9D9D9"></i>
                                <i class="fas fa-star" style="color:#D9D9D9"></i>
                                <i class="fas fa-star" style="color:#D9D9D9"></i>
                                <i class="fas fa-star" style="color:#D9D9D9"></i>
                            @elseif($rate === 2)
                                <i class="fas fa-star" style="color:#FFC300"></i>
                                <i class="fas fa-star" style="color:#FFC300"></i>
                                <i class="fas fa-star" style="color:#D9D9D9"></i>
                                <i class="fas fa-star" style="color:#D9D9D9"></i>
                                <i class="fas fa-star" style="color:#D9D9D9"></i>
                            @elseif($rate === 3)
                                <i class="fas fa-star" style="color:#FFC300"></i>
                                <i class="fas fa-star" style="color:#FFC300"></i>
                                <i class="fas fa-star" style="color:#FFC300"></i>
                                <i class="fas fa-star" style="color:#D9D9D9"></i>
                                <i class="fas fa-star" style="color:#D9D9D9"></i>
                            @elseif($rate === 4)
                                <i class="fas fa-star" style="color:#FFC300"></i>
                                <i class="fas fa-star" style="color:#FFC300"></i>
                                <i class="fas fa-star" style="color:#FFC300"></i>
                                <i class="fas fa-star" style="color:#FFC300"></i>
                                <i class="fas fa-star" style="color:#D9D9D9"></i>
                            @elseif($rate === 5)
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

                            <button class="primary-btn sm" style="float: right">like</button>
                        </div>
                        <p>{{ $data['detail'] }}<br>
                            <b>
                                <span><i class="fa fa-thumbs-up"></i> {{ $data['like_count'] }}</span>
                                <span style="margin-left: 30px"><i class="fa fa-thumbs-down"></i> {{ $data['dislike_count'] }}</span>
                            </b>
                        </p>
                        <ul>
                            <li><b>Item ID</b> <span>{{ $data['item_unique_id'] }}</span></li>
                            <li><b>Author</b> <span>{{ $data['author'] }}</span></li>
                            <li><b>Magazine</b> <span>{{ $data['magazine'] }}</span></li>
                            <li><b>Genre</b> <span>{{ $data['genre']['name'] }}</span></li>
                            <li><b>Total Volumes</b> <span>{{ $data['volumes'] }}</span></li>
                            @if($availability == count($data['volume_list']))
                                <li><b>Availability</b> <span>All the volumes are available</span></li>
                            @else
                                <li><b>Availability</b> <span>{{ $availability }} out of {{ count($data['volume_list']) }} volumes are available</span></li>
                            @endif

                            <li><b>Keywords</b> <span>{{ $data['meta_keywords'] }}</span></li>
                            <li><b>Share on</b>
                                <div class="share">
                                    <a href="#"><i class="fab fa-facebook"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                    <a href="#"><i class="fab fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->