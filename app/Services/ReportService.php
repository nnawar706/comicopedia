<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;

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
}
