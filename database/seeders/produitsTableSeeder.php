<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produits;

class produitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        produits::create([
            'ref'=>'P15478145748',
            'libelle'=>'IPHONE 11 PRO MAX',
            'prix'=>5000,
            'qtedispo'=>150,
            'description'=>'256GB/6GB 5G ',
            'code'=>'CAT0002'
        ]);
    }
}
