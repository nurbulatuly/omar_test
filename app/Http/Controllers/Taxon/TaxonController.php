<?php

namespace App\Http\Controllers\Taxon;

use App\Http\Controllers\Controller;
use App\Services\Taxon\TaxonService;
use Illuminate\Http\Request;

class TaxonController extends Controller
{
    public function __construct(private TaxonService $taxonService)
    {
    }

    public function fetchTaxons()
    {
        $taxons =$this->taxonService->getTaxons();

        return $taxons;
    }
}
