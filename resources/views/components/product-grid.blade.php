<div class="bg-white" x-data="productGrid()">
    <!-- Filter and Search -->
    <div class="mb-6 flex flex-wrap gap-4">
        <div class="flex-1 min-w-64">
            <input type="text" 
                   x-model="search" 
                   @input.debounce.300ms="loadProducts"
                   placeholder="Search products..." 
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>
        <select x-model="selectedCategory" 
                @change="loadProducts"
                class="px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option value="">All Categories</option>
            <option value="Electronics">Electronics</option>
            <option value="Clothing">Clothing</option>
            <option value="Books">Books</option>
            <option value="Home & Garden">Home & Garden</option>
            <option value="Sports">Sports</option>
            <option value="Food & Beverages">Food & Beverages</option>
        </select>
    </div>

    <!-- Loading State -->
    <div x-show="loading" class="text-center py-12">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto"></div>
        <p class="text-gray-600 mt-4">Loading products...</p>
    </div>

    <!-- Product Grid -->
    <div x-show="!loading" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
        <template x-for="product in products" :key="product.product_id">
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                <!-- Product Image -->
                <img :src="product.image" 
                     :alt="product.name" 
                     class="w-full h-48 object-cover">
                
                <!-- Product Info -->
                <div class="p-4">
                    <h3 class="font-semibold text-lg text-gray-900 mb-2" x-text="product.name"></h3>
                    <p class="text-gray-600 text-sm mb-3 line-clamp-2" x-text="product.description"></p>
                    
                    <!-- Price and Stock -->
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xl font-bold text-green-600">$<span x-text="product.price"></span></span>
                        <span class="text-sm text-gray-500" x-show="product.stock > 0">
                            <span x-text="product.stock"></span> in stock
                        </span>
                        <span class="text-sm text-red-500" x-show="product.stock === 0">
                            Out of stock
                        </span>
                    </div>
                    
                    <!-- Add to Cart Button -->
                    <button @click="addToCart(product)"
                            class="w-full py-2 px-4 rounded-md text-white font-medium transition-colors bg-blue-600 hover:bg-blue-700">
                        <span x-text="'Add to Cart'"></span>
                    </button>
                </div>
            </div>
        </template>
    </div>

    <!-- No Products Found -->
    <div x-show="!loading && products.length === 0" class="text-center py-12">
        <p class="text-gray-600 text-lg">No products found.</p>
    </div>

    <!-- Success/Error Messages -->
    <div x-show="message" class="fixed bottom-4 right-4 p-4 rounded-md shadow-lg z-50" :class="messageType === 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'">
        <p x-text="message"></p>
    </div>
</div>

<script>
function productGrid() {
    return {
        products: [],
        search: '',
        selectedCategory: '',
        loading: true,
        addingToCart: {},
        message: '',
        messageType: 'success',

        async init() {
            await this.loadProducts();
        },

        async loadProducts() {
            try {
                this.loading = true;
                let url = '/api/products?';
                const params = new URLSearchParams();
                
                if (this.search) params.append('search', this.search);
                if (this.selectedCategory) params.append('category', this.selectedCategory);
                
                const response = await fetch(url + params.toString());
                const data = await response.json();
                
                this.products = data.data || [];
            } catch (error) {
                this.showMessage('Failed to load products', 'error');
            } finally {
                this.loading = false;
            }
        },

        async addToCart(product) {
            try {
                this.addingToCart[product.product_id] = true;
                
                const response = await fetch('/api/cart', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        product_id: product.product_id,
                        quantity: 1
                    })
                });

                const data = await response.json();
                
                if (response.ok) {
                    this.showMessage(data.message, 'success');
                    // Update navbar cart count if it exists
                    this.$dispatch('cart-updated', { count: data.cart_count });
                } else {
                    this.showMessage(data.message, 'error');
                }
            } catch (error) {
                this.showMessage('Failed to add product to cart', 'error');
            } finally {
                this.addingToCart[product.product_id] = false;
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