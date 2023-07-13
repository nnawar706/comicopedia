<div class="sidebar__item">
    <h4>Price (&#2547;)</h4>
    <div class="price-range-wrap">
        <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
             data-min="500" data-minprice="{{request()->input('min_price') ?? 500}}" data-max="3500"
             data-maxprice="{{request()->input('max_price') ?? 3500}}">
            <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
            <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
            <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
        </div>
        <div class="range-slider">
            <div class="price-input">
                <input type="text" id="minamount">
                <input type="text" id="maxamount">
                <br><br>
                <button type="submit" id="priceRange" style="padding:2px 18px;background-color: #1c294e; color: #fff;border: none;border-radius: 20px">Go</button>
            </div>
        </div>
    </div>
</div>
