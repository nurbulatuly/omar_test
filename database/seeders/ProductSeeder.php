<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Taxon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products =  DB::table('TMTs')
            ->where('OsnovnoyShtrikhKod','!=','')
            ->select('ddappBrendlayn','Nomenklatura_UID_TMC','NomenklaturnayaGruppa_UID_NomGruppa')
            ->get()
            ->unique('ddappBrendlayn');

        $taxons = Taxon::all();
        foreach ($products as $product){
            $taxon = $taxons->first(function ($item) use ($product){
                return $item->foreign_uid == $product->NomenklaturnayaGruppa_UID_NomGruppa;
            });
            $newProduct = Product::create([
                'title' => $product->ddappBrendlayn,
                'foreign_uid' => $product->Nomenklatura_UID_TMC
            ]);

            if ($taxon){
                $newProduct->addTaxon($taxon);
            }
        }

    }
}
