<?php

namespace App\Services\Taxonomy;

use App\Http\Resources\TaxonomyResource;
use App\Models\Taxonomy;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaxonomyService
{
    public function getTaxonomies():AnonymousResourceCollection
    {
        $taxonomies = TaxonomyResource::collection(Taxonomy::all());
        return $taxonomies;
    }
}
