<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class UserService{
    public function getRatio()
    {
        $end = Carbon::now();
        $start = $end->copy()->subMonths(11)->startOfMonth();

        $data = DB::table('users')
            ->whereBetween('created_at', [$start, $end])
            ->selectRaw("count(*) as total_user, monthname(created_at) as month_name, month(created_at) as month")
            ->groupByRaw("month_name, month")->get();

        $data = json_decode($data, true);

        $curMonth = date('n');

        for($i=0;$i<12;$i++) {
            $month = ($curMonth - $i + 12) % 12;
            $month = $month === 0 ? 12 : $month;
            $year = date('Y') - (date('n') < $month ? 1 : 0);

            $exist = count(array_filter($data, function ($obj) use ($month) {
                    return $obj['month'] == $month;
                })) > 0;

            if(!$exist) {
                $data[] = array(
                    'total_user'      => 0,
                    'month_name'      => date('F', mktime(0, 0, 0, $month, 1)) . ', ' . $year,
                    'month'           => $month
                );
            }
        }

        return array_reverse($data);
    }
}
