<div class="filter__item">
    <div class="row" id="result">
        <div class="col-lg-4 col-md-5">
            <div class="filter__sort">
                <span>Sort By</span>
                <select id="catalogueSelect">
                    <option value="0" {{ request()->input('search') == null ? 'selected' : ''  }}>Default
                    </option>
                    <option
                        value="5" {{ request()->input('search')=='Offers' ? 'selected' : '' }}>
                        Offers
                    </option>
                    <option
                        value="3" {{ request()->input('search')=='Bestsellers' ? 'selected' : '' }}>
                        Bestsellers
                    </option>
                    <option
                        value="2" {{ request()->input('search')=='Upcoming Releases' ? 'selected' : '' }}>
                        Upcoming Releases
                    </option>
                    <option
                        value="6" {{ request()->input('search')=='Others' ? 'selected' : '' }}>
                        Others
                    </option>
                </select>
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="filter__found">
{{--                <h6><span>{{ $data['catalogue']->total() }}</span> Volumes found</h6>--}}
            </div>
        </div>
        <div class="col-lg-4 col-md-3">

        </div>
    </div>
</div>
