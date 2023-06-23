<?php

namespace App\Exports;

use App\Models\Volume;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Carbon;

class VolumeExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = Volume::with('item.genre','catalogue')->orderBy('item_id')->orderBy('catalogue_id')->get();

        $result = array();

        foreach ($data as $key => $value) {
            $result[] = array(
                '#'         => $key + 1,
                'serial'    => $value->product_unique_id,
                'series'    => $value->item->title,
                'title'     => $value->title,
                'author'    => $value->item->author,
                'magazine'  => $value->item->magazine,
                'genre'     => $value->item->genre->name,
                'isbn'      => $value->isbn,
                'cost'      => $value->cost,
                'quantity'  => $value->quantity,
                'price'     => $value->price,
                'discount'  => $value->discount ?? 'N/A',
                'valid'     => $value->discount_active_till ?? 'N/A',
                'catalogue' => $value->catalogue->name,
                'release'   => Carbon::parse($value->release_date)->format('d-m-Y'),
                'status'    => $value->status==1 ? 'Available' : 'Not Available',
            );
        }

        return collect($result);
    }

    public function headings(): array
    {
        return [
            '#', 'Serial', 'Series', 'Volume', 'Author', 'Magazine',
            'Genre', 'ISBN', 'Cost(Tk)', 'Quantity', 'Price(Tk)', 'Discount(%)',
            'Discount Active Till', 'Catalogue', 'Release Date',
            'Status'
        ];
    }
}
