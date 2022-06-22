<?php

namespace App\Services\Taxon;

use App\Http\Resources\TaxonResource;
use App\Models\Taxon;

class TaxonService
{
    public  function getTaxon($id)
    {
        return new TaxonResource(Taxon::findOrFail($id));
    }
}
