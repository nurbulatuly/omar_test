<?php

namespace Database\Seeders;

use App\Models\Taxon;
use App\Models\Taxonomy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaxonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = DB::table('NomenklaturnyeGruppy')
            ->whereNotNull('Roditel_UID_Roditel')
            ->where('Roditel_UID_Roditel', '!=', '')
            ->get();

        foreach($categories as $category) {
            $taxonomy = Taxonomy::where('foreign_uid', $category->Roditel_UID_Roditel)->first();

            $taxonomy->taxons()->create([
                'name' => $category->Naimenovanie,
                'foreign_uid' => $category->Ssylka_UID_Sylka,
                'foreign_parent_uid' => $category->Roditel_UID_Roditel
            ]);
        }
    }
}
