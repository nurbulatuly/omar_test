<?php

namespace Database\Seeders;

use App\Models\Taxonomy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaxonomySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $categories = DB::table('NomenklaturnyeGruppy')
            ->whereNull('Roditel_UID_Roditel')
            ->orWhere('Roditel_UID_Roditel', '')
            ->get();

        foreach($categories as $category)
        {
            Taxonomy::create([
                'name' => $category->Naimenovanie,
                'foreign_uid' =>  $category->Ssylka_UID_Sylka
            ]);
//            DB::table('taxonomies')->insert(
//                [
//                    'title' => $category->Naimenovanie,
//                    'url_id' => $categories->Ssylka_UID_Sylka,
//                    'parent_url_id' => $categories->Roditel_UID_Roditel
//                ]
//            );
        }
    }
}
