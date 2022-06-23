<?php

namespace App\Services\Product;

use App\Foundation\Search\ProductFinder;
use App\Http\Resources\ProductResource;
use App\Models\Taxon;

class ProductService
{
    public function __construct(private ProductFinder $productFinder)
    {
    }

    public function getProductsByCategory($id)
    {
        $taxon = Taxon::find($id);
        return ProductResource::collection($this->productFinder->withinTaxon($taxon)->simplePaginate(20));
    }
}
