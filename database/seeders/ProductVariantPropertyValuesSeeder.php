<?php

namespace Database\Seeders;

use App\Models\ProductVariant;
use App\Models\Property;
use App\Models\PropertyValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductVariantPropertyValuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $productVariants = ProductVariant::all();
        $propertyValues = PropertyValue::all();
        foreach ($productVariants as $productVariant){
            $productVariantPropertyValues = $propertyValues
                ->where('foreign_product_variant_uid',$productVariant->foreign_uid)->all();

            $productVariant->addPropertyValues($productVariantPropertyValues);
        }
    }
}
