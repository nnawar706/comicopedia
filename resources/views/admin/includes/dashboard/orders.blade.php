<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Recent Orders</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if(count($data['orders']) == 0)
                    <p class="text-center">No Orders Available</p>
                    @else
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Order Number</th>
                                <th>Customer</th>
                                <th>Total Payable</th>
                                <th>Ordered On</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['orders'] as $order)
                            <tr>
                                <td><a href="{{ route('read-order-view',['id' => $order->id]) }}" style="text-decoration:underline">{{ $order['order_no'] }}</a></td>
                                <td>{{ $order['user']['name'] }}</td>
                                <td>{{ $order['total'] + $order['shipping_cost'] - $order['promo_discount'] }}</td>
                                <td>{{ Illuminate\Support\Carbon::parse($order->created_at)->format('M d, Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Orders Summary</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                         aria-labelledby="dropdownMenuLink">
                        <button class="dropdown-item" onclick="downloadAreaChart()">Download</button>
                        <button class="dropdown-item" onclick="exportAreaChartPDF()">Export PDF</button>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myOrderChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Comparison among orders, carts, and wishlists</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                         aria-labelledby="dropdownMenuLink">
                        <button class="dropdown-item" onclick="downloadAreaChart()">Download</button>
                        <button class="dropdown-item" onclick="exportAreaChartPDF()">Export PDF</button>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myComparisonChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
