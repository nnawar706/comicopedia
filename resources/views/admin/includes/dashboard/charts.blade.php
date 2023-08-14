<div class="row">
    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
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
                    <canvas id="earningChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-7">
        <div class="mb-4">
            <div class="row" style="margin-top:50px">
                <div class="col-lg-6 mb-4">
                    <div class="card bg-primary text-white shadow">
                        <div class="card-body">
                            Revenue
                            <div class="large">{{ $data['dashboard_data']->revenue }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-success text-white shadow">
                        <div class="card-body">
                            Expense
                            <div class="large">{{ $data['dashboard_data']->cost }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-info text-white shadow">
                        <div class="card-body">
                            Avg. Order Value
                            <div class="large">{{ $data['dashboard_data']->order_value }}</div>
                        </div>
                    </div>
                </div>
                @php
                    $total = 0;
                    foreach ($data['order_data'] as $item)
                    {
                        $total += $item['orders_count'];
                    }
                @endphp
                <div class="col-lg-6 mb-4">
                    <div class="card bg-warning text-white shadow">
                        <div class="card-body">
                            Total Orders
                            <div class="large">{{ $total }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-danger text-white shadow">
                        <div class="card-body">
                            Gross Profit
                            <div class="large">{{ $data['dashboard_data']->gross_profit }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-secondary text-white shadow">
                        <div class="card-body">
                            Net Profit
                            <div class="large">{{ $data['dashboard_data']->net_profit }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
