<div class="bg-white rounded-lg shadow-md p-6" x-data="cart()">
    <!-- Cart Header -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Shopping Cart</h2>
        <div class="text-sm text-gray-600">
            <span x-text="cartCount"></span> items
        </div>
    </div>

    <!-- Cart Loading State -->
    <div x-show="loading" class="text-center py-8">
        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600 mx-auto"></div>
        <p class="text-gray-600 mt-2">Loading cart...</p>
    </div>

    <!-- Empty Cart State -->
    <div x-show="!loading && cartItems.length === 0" class="text-center py-12">
        <x-icons.cart class="w-16 h-16 text-gray-400 mx-auto mb-4" />
        <h3 class="text-lg font-medium text-gray-900 mb-2">Your cart is empty</h3>
        <p class="text-gray-600">Add some products to get started!</p>
    </div>

    <!-- Cart Items -->
    <div x-show="!loading && cartItems.length > 0">
        <div class="space-y-4 mb-6">
            <template x-for="item in cartItems" :key="item.product_id">
                <div class="flex items-center space-x-4 p-4 border border-gray-200 rounded-lg">
                    <!-- Product Image -->
                    <img :src="item.image" :alt="item.name" class="w-16 h-16 object-cover rounded-md">
                    
                    <!-- Product Details -->
                    <div class="flex-1">
                        <h4 class="font-medium text-gray-900" x-text="item.name"></h4>
                        <p class="text-gray-600">$<span x-text="item.price.toFixed(2)"></span></p>
                    </div>
                    
                    <!-- Quantity Controls -->
                    <div class="flex items-center space-x-2">
                        <button @click="updateQuantity(item.product_id, item.quantity - 1)"
                                class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center hover:bg-gray-300"
                                :disabled="updating">
                            <span class="text-lg">-</span>
                        </button>
                        <span class="w-8 text-center" x-text="item.quantity"></span>
                        <button @click="updateQuantity(item.product_id, item.quantity + 1)"
                                class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center hover:bg-gray-300"
                                :disabled="updating">
                            <span class="text-lg">+</span>
                        </button>
                    </div>
                    
                    <!-- Remove Button -->
                    <button @click="removeItem(item.product_id)"
                            class="text-red-600 hover:text-red-800"
                            :disabled="updating">
                        <x-icons.close class="w-5 h-5" />
                    </button>
                </div>
            </template>
        </div>

        <!-- Cart Total -->
        <div class="border-t pt-4">
            <div class="flex justify-between items-center mb-4">
                <span class="text-lg font-medium">Total:</span>
                <span class="text-xl font-bold text-green-600">$<span x-text="cartTotal.toFixed(2)"></span></span>
            </div>
            
            <!-- Actions -->
            <div class="flex space-x-4">
                <button @click="clearCart"
                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50"
                        :disabled="updating">
                    Clear Cart
                </button>
                <button class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                        :disabled="updating">
                    Proceed to Checkout
                </button>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    <div x-show="message" class="mt-4 p-4 rounded-md" :class="messageType === 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'">
        <p x-text="message"></p>
    </div>
</div>

<script>
function cart() {
    return {
        cartItems: [],
        cartTotal: 0,
        cartCount: 0,
        loading: true,
        updating: false,
        message: '',
        messageType: 'success',

        async init() {
            await this.loadCart();
        },

        async loadCart() {
            try {
                this.loading = true;
                const response = await fetch('/api/cart');
                const data = await response.json();
                
                this.cartItems = Object.values(data.items);
                this.cartTotal = data.total;
                this.cartCount = data.count;
            } catch (error) {
                this.showMessage('Failed to load cart', 'error');
            } finally {
                this.loading = false;
            }
        },

        async updateQuantity(productId, quantity) {
            if (quantity < 0) return;
            
            try {
                this.updating = true;
                const response = await fetch(`/api/cart/${productId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ quantity })
                });

                const data = await response.json();
                
                if (response.ok) {
                    await this.loadCart();
                    this.showMessage(data.message, 'success');
                } else {
                    this.showMessage(data.message, 'error');
                }
            } catch (error) {
                this.showMessage('Failed to update cart', 'error');
            } finally {
                this.updating = false;
            }
        },

        async removeItem(productId) {
            try {
                this.updating = true;
                const response = await fetch(`/api/cart/${productId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const data = await response.json();
                
                if (response.ok) {
                    await this.loadCart();
                    this.showMessage(data.message, 'success');
                } else {
                    this.showMessage(data.message, 'error');
                }
            } catch (error) {
                this.showMessage('Failed to remove item', 'error');
            } finally {
                this.updating = false;
            }
        },

        async clearCart() {
            if (!confirm('Are you sure you want to clear your cart?')) return;
            
            try {
                this.updating = true;
                const response = await fetch('/api/cart', {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const data = await response.json();
                
                if (response.ok) {
                    await this.loadCart();
                    this.showMessage(data.message, 'success');
                } else {
                    this.showMessage(data.message, 'error');
                }
            } catch (error) {
                this.showMessage('Failed to clear cart', 'error');
            } finally {
                this.updating = false;
            }
        },

        showMessage(msg, type) {
            this.message = msg;
            this.messageType = type;
            setTimeout(() => {
                this.message = '';
            }, 3000);
        }
    }
}
</script>