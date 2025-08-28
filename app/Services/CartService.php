<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartService
{
    private const CART_KEY = 'shopping_cart';

    /**
     * Get all items in the cart
     */
    public function getCartItems(): array
    {
        return Session::get(self::CART_KEY, []);
    }

    /**
     * Add item to cart
     */
    public function addItem(int $productId, int $quantity = 1): array
    {
        $product = Product::find($productId);
        
        if (!$product || !$product->isInStock()) {
            throw new \Exception('Product not available');
        }

        if ($quantity > $product->stock) {
            throw new \Exception('Not enough stock available');
        }

        $cart = $this->getCartItems();
        
        if (isset($cart[$productId])) {
            $newQuantity = $cart[$productId]['quantity'] + $quantity;
            if ($newQuantity > $product->stock) {
                throw new \Exception('Not enough stock available');
            }
            $cart[$productId]['quantity'] = $newQuantity;
        } else {
            $cart[$productId] = [
                'product_id' => $product->product_id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'image' => $product->image
            ];
        }

        Session::put(self::CART_KEY, $cart);
        
        return $cart[$productId];
    }

    /**
     * Remove item from cart
     */
    public function removeItem(int $productId): bool
    {
        $cart = $this->getCartItems();
        
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put(self::CART_KEY, $cart);
            return true;
        }
        
        return false;
    }

    /**
     * Update item quantity in cart
     */
    public function updateQuantity(int $productId, int $quantity): array
    {
        if ($quantity <= 0) {
            $this->removeItem($productId);
            return [];
        }

        $product = Product::find($productId);
        
        if (!$product || $quantity > $product->stock) {
            throw new \Exception('Invalid quantity or not enough stock');
        }

        $cart = $this->getCartItems();
        
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            Session::put(self::CART_KEY, $cart);
            return $cart[$productId];
        }
        
        throw new \Exception('Product not found in cart');
    }

    /**
     * Get cart total
     */
    public function getCartTotal(): float
    {
        $cart = $this->getCartItems();
        $total = 0;
        
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return $total;
    }

    /**
     * Get cart item count
     */
    public function getCartCount(): int
    {
        $cart = $this->getCartItems();
        return array_sum(array_column($cart, 'quantity'));
    }

    /**
     * Clear entire cart
     */
    public function clearCart(): void
    {
        Session::forget(self::CART_KEY);
    }
}