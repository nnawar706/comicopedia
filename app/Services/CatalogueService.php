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
}
