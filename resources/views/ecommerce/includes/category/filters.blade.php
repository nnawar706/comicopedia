<div class="filter__item">
    <div class="row" id="result">
        <div class="col-lg-4 col-md-5">
            <div class="filter__sort">
                <span>Sort By</span>
                <select id="catalogueSelect">
                    <option value="0_{{$data['genre']['id']}}" {{ request()->input('search') == null  }}>Default
                    </option>
                    <option
                        value="4_{{$data['genre']['id']}}" {{ request()->input('search')=='Featured' ? 'selected' : '' }}>
                        Featured
                    </option>
                    <option
                        value="3_{{$data['genre']['id']}}" {{ request()->input('search')=='Bestsellers' ? 'selected' : '' }}>
                        Bestsellers
                    </option>
                    <option
                        value="2_{{$data['genre']['id']}}" {{ request()->input('search')=='Upcoming Releases' ? 'selected' : '' }}>
                        Upcoming Releases
                    </option>
                    <option
                        value="6_{{$data['genre']['id']}}" {{ request()->input('search')=='Others' ? 'selected' : '' }}>
                        Others
                    </option>
                </select>
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="filter__found">
                <h6><span>{{ $data['catalogue']->total() }}</span> Volumes found</h6>
            </div>
        </div>
        <div class="col-lg-4 col-md-3">

        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#catalogueSelect').on('change', function () {
                let value = $(this).val();
                value = value.split('_');
                let selected = value[0];
                let genre_id = value[1];

                let selectedOption = $(this).find(':selected');
                let selectedText = selectedOption.text();

                window.location.href = (selected === '0') ? '/genres/' + genre_id : '/genres/' + genre_id + '?catalogue=' + selected + '&search=' + selectedText;
            })
        });
    </script>
@endpush
