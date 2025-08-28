<x-layout title="QuickCart" full>
    <div class="min-h-screen overflow-y-auto">
        <!-- Hero Section -->
        <section class="h-screen flex flex-col items-center justify-center px-8 pt-16 text-center bg-gradient-to-br from-blue-50 to-indigo-100">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6">
                    Welcome to QuickCart
                </h1>
                <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                    Your ultimate shopping destination. Discover amazing products, add them to your cart, and enjoy a seamless shopping experience.
                </p>
                <button onclick="document.getElementById('products').scrollIntoView({behavior: 'smooth'})" 
                        class="bg-blue-600 text-white px-8 py-3 rounded-lg text-lg font-semibold hover:bg-blue-700 transition-colors">
                    Start Shopping
                </button>
            </div>
        </section>

        <!-- Products Section -->
        <section id="products" class="py-16 px-8 bg-gray-50">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Featured Products</h2>
                    <p class="text-lg text-gray-600">Browse our collection and add your favorites to the cart</p>
                </div>
                
                <x-product-grid />
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-16 px-8 bg-white">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Why Choose QuickCart?</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <x-icons.cart class="w-8 h-8 text-blue-600" />
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Easy Shopping</h3>
                        <p class="text-gray-600">Add products to your cart with just one click. Manage quantities and remove items effortlessly.</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-green-600 text-2xl font-bold">✓</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Real-time Updates</h3>
                        <p class="text-gray-600">See your cart update instantly as you shop. Stock levels and pricing are always up-to-date.</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-purple-600 text-2xl">🚀</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Fast & Secure</h3>
                        <p class="text-gray-600">Built with modern Laravel backend and Alpine.js frontend for the best performance.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Cart Demo Section -->
        <section class="py-16 px-8 bg-gray-50">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">Test the Cart Functionality</h2>
                <p class="text-lg text-gray-600 mb-8">
                    This is a demonstration of GitHub Copilot's agent capabilities. The cart system includes:
                </p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-left">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="font-semibold text-lg mb-3">Backend Features</h3>
                        <ul class="space-y-2 text-gray-600">
                            <li>• RESTful API endpoints</li>
                            <li>• Session-based cart storage</li>
                            <li>• Stock validation</li>
                            <li>• Comprehensive test suite (18 tests)</li>
                            <li>• Service layer architecture</li>
                        </ul>
                    </div>
                    
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="font-semibold text-lg mb-3">Frontend Features</h3>
                        <ul class="space-y-2 text-gray-600">
                            <li>• Alpine.js reactive components</li>
                            <li>• Real-time cart updates</li>
                            <li>• Product search & filtering</li>
                            <li>• Responsive cart sidebar</li>
                            <li>• Error handling & notifications</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-layout>
