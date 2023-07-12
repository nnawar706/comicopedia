<?php

namespace App\Exports;

use App\Services\OrderService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = (new OrderService())->getAll();

        $result = array();

        foreach($data as $key => $value)
        {
            $result[] = array(
                '#'         => $key + 1,
                'order_no'    => $value->item_unique_id,
                'tracking_no'     => $value->genre->name,
                'customer'     => $value->title,
                'subtotal'    => $value->author,
                'promo'         => '',
                'discount'    => $value->author,
                'shipping'  => $value->magazine,
                'total'   => $value->volumes==0 ? 'N/A' : $value->volumes,
                'status' => 1,
                'ordered_on' => 1,
            );
        }

        return collect($result);
    }

    public function headings(): array
    {
        return [
            '#','Serial No','Genre','Title','Author','Magazine','Volumes'
        ];
    }
}
