<div class="filter__item">
    <div class="row" id="result">
        <div class="col-lg-4 col-md-5">
            <div class="filter__sort">
                <span>Sort By</span>
                <select id="catalogueSelect">
                    <option value="0_{{$data['genre']['id']}}">Default</option>
                    <option value="4_{{$data['genre']['id']}}">Featured</option>
                    <option value="3_{{$data['genre']['id']}}">Bestsellers</option>
                    <option value="2_{{$data['genre']['id']}}">Upcoming Releases</option>
                    <option value="6_{{$data['genre']['id']}}">Others</option>
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
        $(document).ready(function(){
            $('#catalogueSelect').on('change', function() {
                let value = $(this).val();
                value = value.split('_');
                let selected = value[0];
                let genre_id = value[1];

                if(selected !== '0') {
                    let url = '/genres/'+genre_id+'?catalogue='+selected;
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(response) {
                            $('#result').html(response);
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    });
                }
            })
        });
    </script>
@endpush
