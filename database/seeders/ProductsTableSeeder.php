<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('products')->insert([
            [
                'name' => 'Iced Caramel Macchiato',
                'description' => 'A refreshing espresso-based drink with milk and caramel drizzle.',
                'price' => 150.00,
                'stock' => 20,
                'category' => 'Beverage',
                'image' => 'iced-caramel-macchiato.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Classic Cheeseburger',
                'description' => 'Juicy beef patty with melted cheese, lettuce, and tomato.',
                'price' => 200.00,
                'stock' => 15,
                'category' => 'Food',
                'image' => 'classic-cheeseburger.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Blueberry Cheesecake',
                'description' => 'Creamy cheesecake topped with blueberry sauce.',
                'price' => 180.00,
                'stock' => 10,
                'category' => 'Dessert',
                'image' => 'blueberry-cheesecake.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        //
    }
}
