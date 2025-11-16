@extends('layouts.app')

@section('title', 'Products - MediStore')

@section('content')
<div class="container mx-auto">
    <!-- Page Header -->
    <div class="mb-10 text-center">
        <h1 class="text-5xl md:text-6xl font-display font-bold mb-4 bg-gradient-to-r from-blue-200 via-cyan-200 to-blue-200 bg-clip-text text-transparent">
            Our Products
        </h1>
        <p class="text-xl text-blue-300/70">Discover premium medical equipment for your healthcare needs</p>
    </div>

    <!-- Search & Filter Section -->
    <div class="glass-dark rounded-2xl shadow-2xl p-6 md:p-8 mb-10 border border-blue-500/20">
        <form action="{{ route('products.index') }}" method="GET" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Search -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-blue-200 mb-3">Search Product</label>
                    <div class="relative">
                        <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}"
                            placeholder="Search by product name..."
                            class="w-full pl-12 pr-4 py-3 glass-dark border border-blue-500/30 rounded-xl text-blue-200 placeholder-blue-400/50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                        >
                    </div>
                </div>

                <!-- Category Filter -->
                <div>
                    <label class="block text-sm font-semibold text-blue-200 mb-3">Category</label>
                    <select 
                        name="category" 
                        class="w-full px-4 py-3 glass-dark border border-blue-500/30 rounded-xl text-blue-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                    >
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Sort By -->
                <div>
                    <label class="block text-sm font-semibold text-blue-200 mb-3">Sort By</label>
                    <select 
                        name="sort" 
                        class="w-full px-4 py-3 glass-dark border border-blue-500/30 rounded-xl text-blue-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                    >
                        <option value="">Latest</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name: A to Z</option>
                    </select>
                </div>
            </div>

            <div class="flex gap-3">
                <button 
                    type="submit" 
                    class="bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white px-8 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg shadow-blue-500/50 hover:scale-105"
                >
                    Apply Filter
                </button>
                <a 
                    href="{{ route('products.index') }}" 
                    class="glass-dark border border-blue-500/30 hover:border-blue-500/50 text-blue-200 px-8 py-3 rounded-xl font-semibold transition-all duration-300 hover:bg-blue-500/10"
                >
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Products Grid -->
    @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
            @foreach($products as $product)
                <div class="glass-dark rounded-2xl overflow-hidden border border-blue-500/20 hover:border-blue-500/40 transition-all duration-300 hover:scale-105 hover:shadow-2xl group">
                    <!-- Product Image -->
                    <div class="relative h-56 bg-gradient-to-br from-blue-900/50 to-blue-800/50 overflow-hidden">
                        @if($product->image)
                            <img 
                                src="{{ asset('storage/' . $product->image) }}" 
                                alt="{{ $product->name }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                            >
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-24 h-24 text-blue-400/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                        @endif

                        <!-- Stock Badge -->
                        @if($product->stock > 0)
                            <span class="absolute top-3 right-3 bg-gradient-to-r from-green-500 to-emerald-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">
                                In Stock
                            </span>
                        @else
                            <span class="absolute top-3 right-3 bg-gradient-to-r from-red-500 to-red-600 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">
                                Out of Stock
                            </span>
                        @endif

                        <!-- Category Badge -->
                        <span class="absolute top-3 left-3 glass-dark border border-blue-500/30 text-blue-200 text-xs font-semibold px-3 py-1.5 rounded-full">
                            {{ $product->category->name }}
                        </span>
                    </div>

                    <!-- Product Info -->
                    <div class="p-5">
                        <!-- Product Name -->
                        <h3 class="text-lg font-display font-bold text-blue-200 mb-3 line-clamp-2 min-h-[3.5rem] group-hover:text-white transition-colors">
                            {{ $product->name }}
                        </h3>

                        <!-- Price -->
                        <p class="text-3xl font-display font-bold bg-gradient-to-r from-blue-300 to-cyan-300 bg-clip-text text-transparent mb-4">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>

                        <!-- Buttons -->
                        <div class="flex gap-2">
                            <a 
                                href="{{ route('products.show', $product->id) }}" 
                                class="flex-1 bg-gradient-to-r from-blue-500/20 to-cyan-500/20 border border-blue-500/30 hover:border-blue-500/50 text-blue-200 hover:text-white text-center py-2.5 rounded-xl font-semibold transition-all duration-300 hover:bg-blue-500/30"
                            >
                                View
                            </a>
                            @auth
                                @if($product->stock > 0)
                                    <form action="{{ route('cart.buyNow', $product->id) }}" method="POST" class="flex-1">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button 
                                            type="submit"
                                            class="w-full bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white py-2.5 rounded-xl font-semibold transition-all duration-300 shadow-lg shadow-blue-500/50 hover:scale-105"
                                        >
                                            Buy
                                        </button>
                                    </form>
                                @else
                                    <button 
                                        disabled
                                        class="flex-1 glass-dark border border-blue-500/20 text-blue-400/50 py-2.5 rounded-xl font-semibold cursor-not-allowed"
                                    >
                                        Out of Stock
                                    </button>
                                @endif
                            @else
                                <a 
                                    href="{{ route('login') }}"
                                    class="flex-1 bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white text-center py-2.5 rounded-xl font-semibold transition-all duration-300 shadow-lg shadow-blue-500/50 hover:scale-105"
                                >
                                    Buy
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-10 flex justify-center">
            <div class="glass-dark rounded-xl p-4 border border-blue-500/20">
                {{ $products->links() }}
            </div>
        </div>
    @else
        <!-- Empty State -->
        <div class="glass-dark rounded-2xl shadow-2xl p-16 text-center border border-blue-500/20">
            <div class="w-32 h-32 mx-auto mb-6 bg-gradient-to-br from-blue-500/20 to-cyan-500/20 rounded-full flex items-center justify-center">
                <svg class="w-16 h-16 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-3xl font-display font-bold text-blue-200 mb-3">No Products Found</h3>
            <p class="text-blue-300/70 mb-8 text-lg">Try adjusting your search or filter criteria</p>
            <a 
                href="{{ route('products.index') }}" 
                class="inline-block bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white px-8 py-4 rounded-xl font-semibold transition-all duration-300 shadow-lg shadow-blue-500/50 hover:scale-105"
            >
                View All Products
            </a>
        </div>
    @endif
</div>
@endsection
