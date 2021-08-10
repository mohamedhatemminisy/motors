<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $no_of_rows = 1000;
        for( $i=0; $i < $no_of_rows; $i++ ){
            $product = array(
                'brandName' => 'Toyota',
                'modelName' => 'Camry',
                'pieceName' => 'motor',
                'modelNumber' =>  "202",
                'signNumber' => '1292',
                'created_at' => now(),
                'updated_at' => now(),

            );
        
            Product::insert( $product );
            $product=null;
        }


    }
}
