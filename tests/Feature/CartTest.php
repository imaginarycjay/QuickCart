<?php

use App\Models\Product;
use App\Services\CartService;

test('can view empty cart', function () {
    $response = $this->get('/api/cart');

    $response->assertStatus(200)
        ->assertJson([
            'items' => [],
            'total' => 0,
            'count' => 0
        ]);
});

test('can add product to cart', function () {
    $product = Product::factory()->create([
        'name' => 'Test Product',
        'price' => 29.99,
        'stock' => 10
    ]);

    $response = $this->post('/api/cart', [
        'product_id' => $product->product_id,
        'quantity' => 2
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'message' => 'Item added to cart',
            'cart_count' => 2
        ]);
});

test('can view cart with items', function () {
    $product = Product::factory()->create([
        'price' => 25.00,
        'stock' => 5
    ]);

    $this->post('/api/cart', [
        'product_id' => $product->product_id,
        'quantity' => 2
    ]);

    $response = $this->get('/api/cart');

    $response->assertStatus(200)
        ->assertJson([
            'total' => 50.00,
            'count' => 2
        ]);
});

test('can update cart item quantity', function () {
    $product = Product::factory()->create([
        'stock' => 10
    ]);

    $this->post('/api/cart', [
        'product_id' => $product->product_id,
        'quantity' => 1
    ]);

    $response = $this->put("/api/cart/{$product->product_id}", [
        'quantity' => 3
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'message' => 'Cart updated',
            'cart_count' => 3
        ]);
});

test('can remove item from cart', function () {
    $product = Product::factory()->create();

    $this->post('/api/cart', [
        'product_id' => $product->product_id,
        'quantity' => 1
    ]);

    $response = $this->delete("/api/cart/{$product->product_id}");

    $response->assertStatus(200)
        ->assertJson([
            'message' => 'Item removed from cart',
            'cart_count' => 0
        ]);
});

test('can clear entire cart', function () {
    $product1 = Product::factory()->create();
    $product2 = Product::factory()->create();

    $this->post('/api/cart', ['product_id' => $product1->product_id]);
    $this->post('/api/cart', ['product_id' => $product2->product_id]);

    $response = $this->delete('/api/cart');

    $response->assertStatus(200)
        ->assertJson([
            'message' => 'Cart cleared'
        ]);

    $cartResponse = $this->get('/api/cart');
    $cartResponse->assertJson(['count' => 0]);
});

test('cannot add product with insufficient stock', function () {
    $product = Product::factory()->create([
        'stock' => 2
    ]);

    $response = $this->post('/api/cart', [
        'product_id' => $product->product_id,
        'quantity' => 5
    ]);

    $response->assertStatus(400)
        ->assertJson([
            'message' => 'Not enough stock available'
        ]);
});

test('cannot add non-existent product', function () {
    $response = $this->post('/api/cart', [
        'product_id' => 99999,
        'quantity' => 1
    ]);

    $response->assertStatus(302); // Redirect due to validation error
});

test('cart service works correctly', function () {
    $cartService = new CartService();
    $product = Product::factory()->create(['stock' => 10]);

    // Test adding item
    $item = $cartService->addItem($product->product_id, 2);
    expect($item['quantity'])->toBe(2);

    // Test getting cart total
    $total = $cartService->getCartTotal();
    expect($total)->toBe($product->price * 2);

    // Test getting cart count
    $count = $cartService->getCartCount();
    expect($count)->toBe(2);

    // Test updating quantity
    $cartService->updateQuantity($product->product_id, 5);
    expect($cartService->getCartCount())->toBe(5);

    // Test removing item
    $cartService->removeItem($product->product_id);
    expect($cartService->getCartCount())->toBe(0);
});
