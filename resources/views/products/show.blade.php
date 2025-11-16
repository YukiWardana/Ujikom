@extends('layouts.app')

@section('title', $product->name . ' - MediStore')

@section('content')
<div class="container mx-auto">
    <!-- Breadcrumb -->
    <nav class="mb-8 text-sm">
        <ol class="flex items-center space-x-2 text-blue-300/70">
            <li><a href="{{ route('home') }}" class="hover:text-blue-200 transition-colors">Home</a></li>
            <li class="text-blue-400">/</li>
            <li><a href="{{ route('products.index') }}" class="hover:text-blue-200 transition-colors">Products</a></li>
            <li class="text-blue-400">/</li>
            <li class="text-blue-200 font-semibold">{{ $product->name }}</li>
        </ol>
    </nav>

    <!-- Product Detail -->
    <div class="glass-dark rounded-3xl shadow-2xl overflow-hidden mb-10 border border-blue-500/20">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 p-8 md:p-12">
            <!-- Product Image -->
            <div>
                <div class="glass-dark rounded-2xl overflow-hidden aspect-square border border-blue-500/30">
                    @if($product->image)
                        <img 
                            src="{{ asset('storage/' . $product->image) }}" 
                            alt="{{ $product->name }}"
                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                        >
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-900/50 to-cyan-900/50">
                            <svg class="w-32 h-32 text-blue-400/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Product Info -->
            <div>
                <!-- Category Badge -->
                <span class="inline-block glass-dark border border-blue-500/30 text-blue-200 text-sm font-semibold px-4 py-2 rounded-full mb-4">
                    {{ $product->category->name }}
                </span>

                <!-- Product Name -->
                <h1 class="text-4xl md:text-5xl font-display font-bold text-blue-200 mb-6">{{ $product->name }}</h1>

                <!-- Price -->
                <div class="mb-6">
                    <p class="text-5xl md:text-6xl font-display font-bold bg-gradient-to-r from-blue-300 to-cyan-300 bg-clip-text text-transparent">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>
                </div>

                <!-- Stock Status -->
                <div class="mb-6">
                    @if($product->stock > 0)
                        <div class="flex items-center space-x-3 glass-dark border border-green-500/30 rounded-xl px-4 py-3">
                            <svg class="w-6 h-6 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-semibold text-green-300">In Stock ({{ $product->stock }} available)</span>
                        </div>
                    @else
                        <div class="flex items-center space-x-3 glass-dark border border-red-500/30 rounded-xl px-4 py-3">
                            <svg class="w-6 h-6 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-semibold text-red-300">Out of Stock</span>
                        </div>
                    @endif
                </div>

                <!-- Description -->
                <div class="mb-8">
                    <h3 class="text-xl font-display font-bold text-blue-200 mb-3">Product Description</h3>
                    <p class="text-blue-300/70 leading-relaxed">
                        {{ $product->description ?? 'No description available for this product.' }}
                    </p>
                </div>

                <!-- Quantity Selector -->
                @auth
                    @if($product->stock > 0)
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mb-4">
                            @csrf
                            <div class="flex items-center space-x-4 mb-6">
                                <label class="text-blue-200 font-semibold">Quantity:</label>
                                <div class="flex items-center glass-dark border border-blue-500/30 rounded-xl overflow-hidden">
                                    <button 
                                        type="button" 
                                        class="px-5 py-3 text-blue-200 hover:text-white hover:bg-blue-500/20 transition-all"
                                        onclick="decreaseQty()"
                                    >-</button>
                                    <input 
                                        type="number" 
                                        id="quantity"
                                        name="quantity" 
                                        value="1" 
                                        min="1" 
                                        max="{{ $product->stock }}"
                                        class="w-20 text-center py-3 glass-dark border-x border-blue-500/30 text-blue-200 focus:outline-none focus:bg-blue-500/10"
                                    >
                                    <button 
                                        type="button" 
                                        class="px-5 py-3 text-blue-200 hover:text-white hover:bg-blue-500/20 transition-all"
                                        onclick="increaseQty()"
                                    >+</button>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-4">
                                <button 
                                    type="submit" 
                                    class="flex-1 bg-gradient-to-r from-blue-500/20 to-cyan-500/20 border border-blue-500/30 hover:border-blue-500/50 text-blue-200 hover:text-white py-4 rounded-xl font-display font-semibold transition-all duration-300 hover:bg-blue-500/30 flex items-center justify-center space-x-2"
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
                                class="w-full bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white px-8 py-4 rounded-xl font-display font-semibold transition-all duration-300 shadow-lg shadow-blue-500/50 hover:scale-105"
                            >
                                Buy Now
                            </button>
                        </form>
                    @endif
                @else
                    <div class="glass-dark border border-yellow-500/30 rounded-xl p-4 mb-6">
                        <p class="text-yellow-300">
                            Please <a href="{{ route('login') }}" class="font-semibold underline hover:text-yellow-200 transition-colors">login</a> to purchase this product.
                        </p>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <div class="mb-8">
            <h2 class="text-3xl md:text-4xl font-display font-bold text-blue-200 mb-8">Related Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $related)
                    <div class="glass-dark rounded-2xl overflow-hidden border border-blue-500/20 hover:border-blue-500/40 transition-all duration-300 hover:scale-105 hover:shadow-2xl group">
                        <div class="relative h-48 bg-gradient-to-br from-blue-900/50 to-cyan-900/50">
                            @if($related->image)
                                <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-20 h-20 text-blue-400/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-display font-bold text-blue-200 mb-2 line-clamp-2 group-hover:text-white transition-colors">{{ $related->name }}</h3>
                            <p class="text-2xl font-display font-bold bg-gradient-to-r from-blue-300 to-cyan-300 bg-clip-text text-transparent mb-4">Rp {{ number_format($related->price, 0, ',', '.') }}</p>
                            <a href="{{ route('products.show', $related->id) }}" class="block text-center bg-gradient-to-r from-blue-500/20 to-cyan-500/20 border border-blue-500/30 hover:border-blue-500/50 text-blue-200 hover:text-white py-3 rounded-xl font-semibold transition-all duration-300 hover:bg-blue-500/30">
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
            document.getElementById('quantity-buy-now').value = input.value;
        }
    }
    
    function decreaseQty() {
        const input = document.getElementById('quantity');
        const currentValue = parseInt(input.value);
        if (currentValue > 1) {
            input.value = currentValue - 1;
            document.getElementById('quantity-buy-now').value = input.value;
        }
    }

    document.getElementById('quantity').addEventListener('change', function() {
        document.getElementById('quantity-buy-now').value = this.value;
    });
</script>
@endsection
