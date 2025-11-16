@extends('layouts.app')

@section('title', $product->name . ' - Toko Alat Kesehatan')

@section('content')
<div class="container mx-auto">
    <!-- Breadcrumb -->
    <nav class="mb-6 text-sm">
        <ol class="flex items-center space-x-2 text-gray-600">
            <li><a href="{{ route('home') }}" class="hover:text-blue-600">Home</a></li>
            <li>/</li>
            <li><a href="{{ route('products.index') }}" class="hover:text-blue-600">Products</a></li>
            <li>/</li>
            <li class="text-gray-800 font-medium">{{ $product->name }}</li>
        </ol>
    </nav>

    <!-- Product Detail -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8">
            <!-- Product Image -->
            <div>
                <div class="bg-gray-200 rounded-lg overflow-hidden aspect-square">
                    @if($product->image)
                        <img 
                            src="{{ asset('storage/' . $product->image) }}" 
                            alt="{{ $product->name }}"
                            class="w-full h-full object-cover"
                        >
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-100 to-blue-200">
                            <svg class="w-32 h-32 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Product Info -->
            <div>
                <!-- Category Badge -->
                <span class="inline-block bg-blue-100 text-blue-600 text-sm font-semibold px-3 py-1 rounded-full mb-3">
                    {{ $product->category->name }}
                </span>

                <!-- Product Name -->
                <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $product->name }}</h1>

                <!-- Price -->
                <div class="mb-6">
                    <p class="text-4xl font-bold text-blue-600">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>
                </div>

                <!-- Stock Status -->
                <div class="mb-6">
                    @if($product->stock > 0)
                        <div class="flex items-center space-x-2 text-green-600">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-semibold">In Stock ({{ $product->stock }} available)</span>
                        </div>
                    @else
                        <div class="flex items-center space-x-2 text-red-600">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-semibold">Out of Stock</span>
                        </div>
                    @endif
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Product Description</h3>
                    <p class="text-gray-600 leading-relaxed">
                        {{ $product->description ?? 'No description available for this product.' }}
                    </p>
                </div>

                <!-- Quantity Selector -->
                @auth
                    @if($product->stock > 0)
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mb-4">
                            @csrf
                            <div class="flex items-center space-x-4 mb-4">
                                <label class="text-gray-700 font-medium">Quantity:</label>
                                <div class="flex items-center border border-gray-300 rounded-lg">
                                    <button 
                                        type="button" 
                                        class="px-4 py-2 text-gray-600 hover:bg-gray-100"
                                        onclick="decreaseQty()"
                                    >-</button>
                                    <input 
                                        type="number" 
                                        id="quantity"
                                        name="quantity" 
                                        value="1" 
                                        min="1" 
                                        max="{{ $product->stock }}"
                                        class="w-16 text-center border-x border-gray-300 py-2 focus:outline-none"
                                    >
                                    <button 
                                        type="button" 
                                        class="px-4 py-2 text-gray-600 hover:bg-gray-100"
                                        onclick="increaseQty()"
                                    >+</button>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-4">
                                <button 
                                    type="submit" 
                                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold transition flex items-center justify-center space-x-2"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    <span>Add to Cart</span>
                                </button>
                            </div>
                        </form>
                        
                        <!-- Buy Now (Separate Form) -->
                        <form action="{{ route('cart.buyNow', $product->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="quantity" id="quantity-buy-now" value="1">
                            <button 
                                type="submit" 
                                class="w-full bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg font-semibold transition"
                            >
                                Buy Now
                            </button>
                        </form>
                    @endif
                @else
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                        <p class="text-yellow-800">
                            Please <a href="{{ route('login') }}" class="font-semibold underline">login</a> to purchase this product.
                        </p>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Related Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $related)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                        <div class="relative h-48 bg-gray-200">
                            @if($related->image)
                                <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-100 to-blue-200">
                                    <svg class="w-20 h-20 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2 line-clamp-2">{{ $related->name }}</h3>
                            <p class="text-xl font-bold text-blue-600 mb-3">Rp {{ number_format($related->price, 0, ',', '.') }}</p>
                            <a href="{{ route('products.show', $related->id) }}" class="block text-center bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-medium transition">
                                View Details
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

<script>
    const maxQty = {{ $product->stock }};
    
    function increaseQty() {
        const input = document.getElementById('quantity');
        const currentValue = parseInt(input.value);
        if (currentValue < maxQty) {
            input.value = currentValue + 1;
        }
    }
    
    function decreaseQty() {
        const input = document.getElementById('quantity');
        const currentValue = parseInt(input.value);
        if (currentValue > 1) {
            input.value = currentValue - 1;
        }
    }

    document.getElementById('quantity').addEventListener('change', function() {
        document.getElementById('quantity-buy-now').value = this.value;
    });
</script>
@endsection