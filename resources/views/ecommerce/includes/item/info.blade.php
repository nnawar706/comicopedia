<!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="{{ asset($data['image_path']) }}" alt="manga-image" height="700">
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
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                        </div>
                        <p>{{ $data['detail'] }}</p>
                        <ul>
                            <li>{{ $rate }}</li>
                            <li><b>Author</b> <span>{{ $data['author'] }}</span></li>
                            <li><b>Magazine</b> <span>{{ $data['magazine'] }}</span></li>
                            <li><b>Genre</b> <span>{{ $data['genre']['name'] }}</span></li>
                            <li><b>Total Volumes</b> <span>{{ $data['volumes'] }}</span></li>
                            <li><b>Availability</b> <span>In Stock</span></li>
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
