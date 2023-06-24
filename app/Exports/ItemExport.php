<?php

namespace App\Exports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ItemExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = Item::with('genre')->orderBy('genre_id')->get();

        $result = array();

        foreach($data as $key => $value)
        {
            $result[] = array(
                '#'         => $key + 1,
                'serial'    => $value->item_unique_id,
                'genre'     => $value->genre->name,
                'title'     => $value->title,
                'author'    => $value->author,
                'magazine'  => $value->magazine,
                'volumes'   => $value->volumes==0 ? 'N/A' : $value->volumes
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
