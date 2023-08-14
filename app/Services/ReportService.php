<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReportService
{

    public function getTotalEarning()
    {
        return Order::sum('total');
    }

    public function getTotalCustomers()
    {
        return User::count();
    }

    public function getOverview()
    {
        $data = DB::table('orders')
        ->selectRaw(
            'round(sum(total), 2) as revenue'
        )->first();

        $data->cost = 2300;
        $data->gross_profit = round(($data->revenue - $data->cost), 2);
        $data->net_profit      = round(($data->gross_profit - $data->cost), 2);
        $data->order_value = round(($data->revenue / 4), 2);

        return $data;
    }
}
