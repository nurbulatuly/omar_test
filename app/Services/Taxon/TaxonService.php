<?php

namespace App\Services\Taxon;

use App\Http\Resources\TaxonResource;
use App\Models\Taxon;

class TaxonService
{
    public function getTaxons()
    {
        $taxons = TaxonResource::collection(Taxon::all());

        return $taxons;
    }
}
