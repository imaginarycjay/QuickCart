<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory()->create([
            'name' => 'Wireless Bluetooth Headphones',
            'description' => 'High-quality wireless headphones with noise cancellation and 30-hour battery life.',
            'price' => 79.99,
            'stock' => 25,
            'category' => 'Electronics',
            'image' => 'https://via.placeholder.com/300x300?text=Bluetooth+Headphones'
        ]);

        Product::factory()->create([
            'name' => 'Premium Coffee Beans',
            'description' => 'Freshly roasted premium arabica coffee beans from sustainable farms.',
            'price' => 24.99,
            'stock' => 50,
            'category' => 'Food & Beverages',
            'image' => 'https://via.placeholder.com/300x300?text=Coffee+Beans'
        ]);

        Product::factory()->create([
            'name' => 'Yoga Mat',
            'description' => 'Non-slip eco-friendly yoga mat perfect for all types of yoga practice.',
            'price' => 39.99,
            'stock' => 15,
            'category' => 'Sports',
            'image' => 'https://via.placeholder.com/300x300?text=Yoga+Mat'
        ]);

        // Create additional random products
        Product::factory(20)->create();
    }
}
