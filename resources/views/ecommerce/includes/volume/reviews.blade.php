<div class="col-lg-12">
    <div class="product__details__tab">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                   aria-selected="true">Information</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                   aria-selected="false">Reviews <span>({{ $data['review_count'] }})</span></a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                <div class="product__details__tab__desc">
                    <h6>Summary</h6>
                    <p>{{ $data['details'] }}</p>
                </div>
            </div>
            <div class="tab-pane" id="tabs-3" role="tabpanel">
                <div class="product__details__tab__desc">
                    <h6>Customer Reviews</h6>
                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                        Proin eget tortor risus.</p>
                </div>
            </div>
        </div>
    </div>
</div>
