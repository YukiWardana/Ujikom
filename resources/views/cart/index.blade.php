@extends('layouts.app')

@section('title', 'Shopping Cart - MediStore')

@section('content')
<div class="container mx-auto">
    <!-- Page Header -->
    <div class="mb-10 text-center">
        <h1 class="text-5xl md:text-6xl font-display font-bold mb-4 bg-gradient-to-r from-blue-200 via-cyan-200 to-blue-200 bg-clip-text text-transparent">
            Shopping Cart
        </h1>
        <p class="text-xl text-blue-300/70">Review your items before checkout</p>
    </div>

    @if($cartItems->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2 space-y-4">
                @foreach($cartItems as $item)
                    <div class="glass-dark rounded-2xl border border-blue-500/20 hover:border-blue-500/40 transition-all duration-300 overflow-hidden">
                        <div class="flex flex-col md:flex-row items-center gap-6 p-6">
                            <!-- Product Image -->
                            <div class="w-32 h-32 flex-shrink-0 rounded-xl overflow-hidden border border-blue-500/30">
                                @if($item->product->image)
                                    <img 
                                        src="{{ asset('storage/' . $item->product->image) }}" 
                                        alt="{{ $item->product->name }}"
                                        class="w-full h-full object-cover"
                                    >
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-900/50 to-cyan-900/50">
                                        <svg class="w-12 h-12 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <!-- Product Info -->
                            <div class="flex-1 min-w-0">
                                <h3 class="text-xl font-display font-bold text-blue-200 mb-2 hover:text-white transition-colors">
                                    <a href="{{ route('products.show', $item->product->id) }}">
                                        {{ $item->product->name }}
                                    </a>
                                </h3>
                                <p class="text-sm text-blue-400 mb-3">{{ $item->product->category->name }}</p>
                                <p class="text-2xl font-display font-bold bg-gradient-to-r from-blue-300 to-cyan-300 bg-clip-text text-transparent">
                                    Rp {{ number_format($item->product->price, 0, ',', '.') }}
                                </p>

                                <!-- Stock warning -->
                                @if($item->quantity > $item->product->stock)
                                    <div class="mt-3 glass-dark border border-red-500/30 rounded-lg p-2">
                                        <p class="text-sm text-red-400 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            Only {{ $item->product->stock }} items available
                                        </p>
                                    </div>
                                @endif
                            </div>

                            <!-- Quantity & Actions -->
                            <div class="flex flex-col items-end gap-4">
                                <!-- Quantity -->
                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center">
                                    @csrf
                                    @method('PATCH')
                                    <div class="flex items-center glass-dark border border-blue-500/30 rounded-xl overflow-hidden">
                                        <button 
                                            type="button" 
                                            onclick="this.nextElementSibling.stepDown(); this.form.submit()"
                                            class="px-4 py-2 text-blue-200 hover:text-white hover:bg-blue-500/20 transition-all"
                                        >-</button>
                                        <input 
                                            type="number" 
                                            name="quantity" 
                                            value="{{ $item->quantity }}" 
                                            min="1" 
                                            max="{{ $item->product->stock }}"
                                            class="w-16 text-center py-2 glass-dark border-x border-blue-500/30 text-blue-200 focus:outline-none focus:bg-blue-500/10"
                                            onchange="this.form.submit()"
                                        >
                                        <button 
                                            type="button" 
                                            onclick="this.previousElementSibling.stepUp(); this.form.submit()"
                                            class="px-4 py-2 text-blue-200 hover:text-white hover:bg-blue-500/20 transition-all"
                                        >+</button>
                                    </div>
                                </form>

                                <!-- Subtotal -->
                                <p class="text-2xl font-display font-bold text-blue-200">
                                    Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                </p>

                                <!-- Remove Button -->
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button 
                                        type="submit" 
                                        class="text-red-400 hover:text-red-300 text-sm font-semibold transition-all hover:underline"
                                        onclick="return confirm('Remove this item from cart?')"
                                    >
                                        Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Clear Cart Button -->
                <div class="mt-6">
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button 
                            type="submit" 
                            class="glass-dark border border-red-500/30 hover:border-red-500/50 text-red-400 hover:text-red-300 px-6 py-3 rounded-xl font-semibold transition-all duration-300 hover:bg-red-500/10"
                            onclick="return confirm('Clear all items from cart?')"
                        >
                            Clear Cart
                        </button>
                    </form>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="glass-dark rounded-2xl border border-blue-500/20 p-6 sticky top-24 shadow-2xl">
                    <h2 class="text-2xl font-display font-bold text-blue-200 mb-6">Order Summary</h2>

                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-blue-300">
                            <span>Subtotal ({{ $cartItems->sum('quantity') }} items)</span>
                            <span class="font-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-blue-300">
                            <span>Tax (11%)</span>
                            <span class="font-semibold">Rp {{ number_format($tax, 0, ',', '.') }}</span>
                        </div>
                        <div class="border-t border-blue-500/30 pt-4 flex justify-between text-xl font-display font-bold text-blue-200">
                            <span>Total</span>
                            <span class="bg-gradient-to-r from-blue-300 to-cyan-300 bg-clip-text text-transparent">
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <a 
                        href="{{ route('checkout.index') }}"
                        class="block w-full bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white py-4 rounded-xl font-display font-semibold transition-all duration-300 shadow-lg shadow-blue-500/50 hover:scale-105 mb-4 text-center"
                    >
                        Proceed to Checkout
                    </a>

                    <a 
                        href="{{ route('products.index') }}" 
                        class="block text-center text-blue-300 hover:text-blue-200 font-semibold transition-colors"
                    >
                        Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    @else
        <!-- Empty Cart State -->
        <div class="glass-dark rounded-2xl shadow-2xl p-16 text-center border border-blue-500/20">
            <div class="w-32 h-32 mx-auto mb-6 bg-gradient-to-br from-blue-500/20 to-cyan-500/20 rounded-full flex items-center justify-center">
                <svg class="w-16 h-16 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <h3 class="text-3xl font-display font-bold text-blue-200 mb-3">Your Cart is Empty</h3>
            <p class="text-blue-300/70 mb-8 text-lg">Start adding products to your cart!</p>
            <a 
                href="{{ route('products.index') }}" 
                class="inline-block bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white px-10 py-4 rounded-xl font-display font-semibold transition-all duration-300 shadow-lg shadow-blue-500/50 hover:scale-105"
            >
                Browse Products
            </a>
        </div>
    @endif
</div>
@endsection
