<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    public function __construct(
        private CartService $cartService
    ) {}

    /**
     * Get cart contents
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'items' => $this->cartService->getCartItems(),
            'total' => $this->cartService->getCartTotal(),
            'count' => $this->cartService->getCartCount()
        ]);
    }

    /**
     * Add item to cart
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,product_id',
            'quantity' => 'integer|min:1'
        ]);

        try {
            $item = $this->cartService->addItem(
                $request->product_id,
                $request->quantity ?? 1
            );

            return response()->json([
                'message' => 'Item added to cart',
                'item' => $item,
                'cart_count' => $this->cartService->getCartCount()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request, int $productId): JsonResponse
    {
        $request->validate([
            'quantity' => 'required|integer|min:0'
        ]);

        try {
            if ($request->quantity === 0) {
                $this->cartService->removeItem($productId);
                $message = 'Item removed from cart';
                $item = null;
            } else {
                $item = $this->cartService->updateQuantity($productId, $request->quantity);
                $message = 'Cart updated';
            }

            return response()->json([
                'message' => $message,
                'item' => $item,
                'cart_count' => $this->cartService->getCartCount(),
                'cart_total' => $this->cartService->getCartTotal()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Remove item from cart
     */
    public function destroy(int $productId): JsonResponse
    {
        $success = $this->cartService->removeItem($productId);

        if ($success) {
            return response()->json([
                'message' => 'Item removed from cart',
                'cart_count' => $this->cartService->getCartCount(),
                'cart_total' => $this->cartService->getCartTotal()
            ]);
        }

        return response()->json([
            'message' => 'Item not found in cart'
        ], 404);
    }

    /**
     * Clear entire cart
     */
    public function clear(): JsonResponse
    {
        $this->cartService->clearCart();

        return response()->json([
            'message' => 'Cart cleared'
        ]);
    }
}
