<?php

use App\Models\Product;

test('can list products', function () {
    Product::factory()->count(5)->create();

    $response = $this->get('/api/products');

    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'product_id',
                    'name',
                    'description',
                    'price',
                    'stock',
                    'category',
                    'image'
                ]
            ]
        ]);
});

test('can filter products by category', function () {
    Product::factory()->create(['category' => 'Electronics']);
    Product::factory()->create(['category' => 'Books']);

    $response = $this->get('/api/products?category=Electronics');

    $response->assertStatus(200);
    $products = $response->json('data');
    
    foreach ($products as $product) {
        expect($product['category'])->toBe('Electronics');
    }
});

test('can search products by name', function () {
    Product::factory()->create(['name' => 'Awesome Gadget']);
    Product::factory()->create(['name' => 'Cool Device']);

    $response = $this->get('/api/products?search=Awesome');

    $response->assertStatus(200);
    $products = $response->json('data');
    
    expect($products)->toHaveCount(1);
    expect($products[0]['name'])->toContain('Awesome');
});

test('can view single product', function () {
    $product = Product::factory()->create();

    $response = $this->get("/api/products/{$product->product_id}");

    $response->assertStatus(200)
        ->assertJson([
            'product_id' => $product->product_id,
            'name' => $product->name,
            'price' => $product->price
        ]);
});

test('product stock management works', function () {
    $product = Product::factory()->create(['stock' => 10]);

    expect($product->isInStock())->toBeTrue();
    
    $product->decreaseStock(5);
    expect($product->fresh()->stock)->toBe(5);
    
    $product->increaseStock(3);
    expect($product->fresh()->stock)->toBe(8);
    
    expect($product->decreaseStock(15))->toBeFalse(); // Not enough stock
});

test('product with zero stock is not in stock', function () {
    $product = Product::factory()->create(['stock' => 0]);
    
    expect($product->isInStock())->toBeFalse();
});
