<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Products::insert([
        ['name' => 'Bibimbap', 'category' => 'Foods', 'size' => null,'price' => 100],
        ['name' => 'Kimchi Fried Rice', 'category' => 'Foods', 'size' => null,'price' => 60],
        ['name' => 'Fruit Soda', 'category' => 'Beverages', 'size' => '12oz','price' => 25],
        ]);
    }
}
