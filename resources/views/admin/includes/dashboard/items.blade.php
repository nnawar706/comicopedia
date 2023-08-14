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
                    <h4 class="small font-weight-bold"><a href="{{ route('read-volume-view',['id' => $item['id']]) }}" style="color:dimgray">{{ $item['item']['title'] }}, {{ $item['title'] }} </a><span
                            class="float-right">{{ round(($item['view_count']/$data['most_viewed']['total'])*100,2) }}%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar {{ $bg_colors[$key] }}" role="progressbar" style="width: {{ round(($item['view_count']/$data['most_viewed']['total'])*100,2) }}%"
                             aria-valuenow="{{ round(($item['view_count']/$data['most_viewed']['total'])*100,2) }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Most Sold Volumes</h6>
                <div class="dropdown no-arrow"></div>
                <a href="#" role="button" id="dropdownMenuLink"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                    aria-labelledby="dropdownMenuLink">
                    <button class="dropdown-item" onclick="downloadPieChart()">Download</button>
                    <button class="dropdown-item" onclick="exportPieChartPDF()">Export PDF</button>
                </div>
            </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-pie pt-4 pb-2">
                <canvas id="volumeChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <a href="#" class="btn btn-warning btn-circle btn-sm">
                        <i class="fas fa-exclamation-triangle"></i>
                    </a>
                    Inventory Stock Alert
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Stock Amount</th>
                                <th>Pending Order</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="" style="text-decoration:underline">Black Clover, Volume 15</a></td>
                                <td>2</td>
                                <td>7</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
