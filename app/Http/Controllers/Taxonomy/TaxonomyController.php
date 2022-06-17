<?php

namespace App\Http\Controllers\Taxonomy;

use App\Http\Controllers\Controller;
use App\Services\Taxonomy\TaxonomyService;
use Illuminate\Http\Request;

class TaxonomyController extends Controller
{
    //
    public function __construct(private TaxonomyService $taxonomyService)
    {
    }

    public function fetchTaxonnomies()
    {
        $taxonomies = $this->taxonomyService->getTaxonomies();

        return $taxonomies;
    }
}
