<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\PropertyValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertyValuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $propertyValuesTmc = DB::table('EdinitsyIzmereniya')
            ->select('EdinitsaPoKlassifikatoru','Koeffitsient','Vladelets_UID_Vladelec')
            ->where('EdinitsaPoKlassifikatoru','!=','')
            ->get();
        $properties = Property::all();

        foreach ($propertyValuesTmc as $propertyValueTmc){
            $property = $properties->first(function ($item) use ($propertyValueTmc){
                return $item->name == $propertyValueTmc->EdinitsaPoKlassifikatoru;
            });
            if ($property){
                $property-> propertyValues()->create([
                    'title' => $propertyValueTmc->Koeffitsient,
                    'foreign_product_variant_uid' => $propertyValueTmc->Vladelets_UID_Vladelec

                ]);
            }
        }

    }
}
