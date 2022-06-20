<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $propertiesTmc = DB::table('EdinitsyIzmereniya')
            ->select('EdinitsaPoKlassifikatoru')
            ->where('EdinitsaPoKlassifikatoru','!=','')
            ->groupBy('EdinitsaPoKlassifikatoru')
            ->get();

        foreach ($propertiesTmc as $propertyTmc){
            Property::create([
                'name' => $propertyTmc->EdinitsaPoKlassifikatoru,
                'type' => $propertyTmc->EdinitsaPoKlassifikatoru
            ]);
        }
    }
}
