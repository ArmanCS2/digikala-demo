<?php

namespace Database\Seeders;

use App\Models\Market\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $products = Product::all();
        foreach ($products as $product) {
            if ($product->size == 'XLarge') {
                $product->update([
                    'width' => 44,
                    'height' => 66,
                ]);
            }
            if ($product->size == 'XXLarge') {
                $product->update([
                    'width' => 48,
                    'height' => 72,
                ]);
            }

        }
    }
}
