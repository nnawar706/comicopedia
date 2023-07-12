<?php

namespace App\Exports;

use App\Services\OrderService;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = (new OrderService())->getAll()->get();

        $result = array();

        foreach($data as $key => $value)
        {
            $result[] = array(
                '#'             => $key + 1,
                'order_no'      => $value->order_no,
                'tracking_no'   => $value->delivery_tracking_no,
                'customer'      => $value->user_name,
                'contact'       => strval($value->contact),
                'promo'         => $value->is_promo,
                'discount'      => $value->promo_discount,
                'shipping'      => $value->shipping_cost,
                'subtotal'      => $value->total,
                'total'         => $value->total + $value->shipping_cost - $value->promo_discount,
                'ordered_on'    => Carbon::parse($value->created_at)->format('d-m-Y'),
                'status'        => $value->order_status,
            );
        }

        return collect($result);
    }

    public function headings(): array
    {
        return [
            '#','Order No','Tracking No','Customer','Contact','Used Promo','Promo Discount','Shipping Charge',
            'Subtotal','Total','Ordered On','Status'
        ];
    }
}
