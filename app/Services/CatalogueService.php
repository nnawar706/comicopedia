<?php

namespace App\Services;

use App\Models\Catalogue;

class CatalogueService
{

    private $catalogue;

    public function __construct(Catalogue $catalogue)
    {
        $this->catalogue = $catalogue;
    }

    public function getCatalogues()
    {
        return $this->catalogue->newQuery()->select('id','name')->orderBy('id')->get();
    }

    public function getAllWithItems()
    {
        return $this->catalogue->newQuery()
        ->with(['volumes' => function($q) {
            $q->select('id','title','catalogue_id','item_id','release_date','details','price','discount','discount_active_till','image_path')
                ->whereNot('status', 0)->orderBy('sell_count', 'desc')->limit(12)
                ->with(['item' => function($q) {
                    $q->select('id','genre_id','title')->with('genre');
                }]);
        }])->get();
    }
}
