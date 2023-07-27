<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-6 mb-4">
        <!-- Comic Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Most Viewed Volumes</h6>
            </div>
            <div class="card-body">
                @php
                    $bg_colors = ['bg-success','bg-warning','','bg-info','bg-danger'];
                @endphp
                @foreach ($data['most_viewed']['data'] as $key=>$item)
                    <h4 class="small font-weight-bold"><a href="" style="color:dimgray">{{ $item['item']['title'] }}, {{ $item['title'] }} </a><span
                            class="float-right">{{ round(($item['view_count']/$data['most_viewed']['total'])*100,2) }}%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar {{ $bg_colors[$key] }}" role="progressbar" style="width: {{ round(($item['view_count']/$data['most_viewed']['total'])*100,2) }}%"
                             aria-valuenow="{{ round(($item['view_count']/$data['most_viewed']['total'])*100,2) }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-lg-4 mb-4">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->

        </div>
    </div>
    <div class="col-lg-4 mb-4">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->

        </div>
    </div>
</div>
