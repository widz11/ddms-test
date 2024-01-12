<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = date('Y-m-d H:i:s');
        $data = [
            ['name' => 'Product 1', 'quantity' => 9999, 'price' => 1000, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Product 2', 'quantity' => 9999, 'price' => 2000, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Product 3', 'quantity' => 9999, 'price' => 3000, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Product 4', 'quantity' => 9999, 'price' => 4000, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Product 5', 'quantity' => 9999, 'price' => 5000, 'created_at' => $date, 'updated_at' => $date],
        ];

        Product::insert($data);
    }
}
