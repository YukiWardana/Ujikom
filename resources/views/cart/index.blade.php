@extends('layouts.app')

@section('title', 'Shopping Cart - Toko Alat Kesehatan')

@section('content')
<div class="container mx-auto">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Shopping Cart</h1>
        <p class="text-gray-600">Review your items before checkout</p>
    </div>

    @if($cartItems->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    @foreach($cartItems as $item)
                        <div class="flex items-center gap-4 p-6 border-b last:border-b-0 hover:bg-gray-50">
                            <!-- Product Image -->
                            <div class="w-24 h-24 flex-shrink-0">
                                @if($item->product->image)
                                    <img 
                                        src="{{ asset('storage/' . $item->product->image) }}" 
                                        alt="{{ $item->product->name }}"
                                        class="w-full h-full object-cover rounded-lg"
                                    >
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-blue-100 to-blue-200 rounded-lg flex items-center justify-center">
                                        <svg class="w-12 h-12 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <!-- Product Info -->
                            <div class="flex-1">
                                <h3 class="font-semibold text-lg text-gray-800 mb-1">
                                    <a href="{{ route('products.show', $item->product->id) }}" class="hover:text-blue-600">
                                        {{ $item->product->name }}
                                    </a>
                                </h3>
                                <p class="text-sm text-gray-500 mb-2">{{ $item->product->category->name }}</p>
                                <p class="text-xl font-bold text-blue-600">
                                    Rp {{ number_format($item->product->price, 0, ',', '.') }}
                                </p>

                                <!-- Stock warning -->
                                @if($item->quantity > $item->product->stock)
                                    <p class="text-sm text-red-600 mt-2">
                                        ⚠️ Only {{ $item->product->stock }} items available
                                    </p>
                                @endif
                            </div>

                            <!-- Quantity & Actions -->
                            <div class="flex flex-col items-end gap-3">
                                <!-- Quantity -->
                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center">
                                    @csrf
                                    @method('PATCH')
                                    <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                                        <button 
                                            type="button" 
                                            onclick="this.nextElementSibling.stepDown(); this.form.submit()"
                                            class="px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-600"
                                        >-</button>
                                        <input 
                                            type="number" 
                                            name="quantity" 
                                            value="{{ $item->quantity }}" 
                                            min="1" 
                                            max="{{ $item->product->stock }}"
                                            class="w-16 text-center py-2 border-x border-gray-300 focus:outline-none"
                                            onchange="this.form.submit()"
                                        >
                                        <button 
                                            type="button" 
                                            onclick="this.previousElementSibling.stepUp(); this.form.submit()"
                                            class="px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-600"
                                        >+</button>
                                    </div>
                                </form>

                                <!-- Subtotal -->
                                <p class="text-lg font-semibold text-gray-800">
                                    Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                </p>

                                <!-- Remove Button -->
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button 
                                        type="submit" 
                                        class="text-red-600 hover:text-red-800 text-sm font-medium"
                                        onclick="return confirm('Remove this item from cart?')"
                                    >
                                        Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Clear Cart Button -->
                <div class="mt-4">
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button 
                            type="submit" 
                            class="text-red-600 hover:text-red-800 font-medium"
                            onclick="return confirm('Clear all items from cart?')"
                        >
                            Clear Cart
                        </button>
                    </form>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Order Summary</h2>

                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal ({{ $cartItems->sum('quantity') }} items)</span>
                            <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Tax (11%)</span>
                            <span>Rp {{ number_format($tax, 0, ',', '.') }}</span>
                        </div>
                        <div class="border-t pt-3 flex justify-between text-lg font-bold text-gray-800">
                            <span>Total</span>
                            <span class="text-blue-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <a 
                        href="{{ route('checkout.index') }}"
                        class="block w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold transition mb-3 text-center"
                    >
                        Proceed to Checkout
                    </a>

                    <a 
                        href="{{ route('products.index') }}" 
                        class="block text-center text-blue-600 hover:text-blue-700 font-medium"
                    >
                        Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    @else
        <!-- Empty Cart State -->
        <div class="bg-white rounded-lg shadow-md p-12 text-center">
            <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <h3 class="text-2xl font-semibold text-gray-700 mb-2">Your Cart is Empty</h3>
            <p class="text-gray-500 mb-6">Start adding products to your cart!</p>
            <a 
                href="{{ route('products.index') }}" 
                class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold transition"
            >
                Browse Products
            </a>
        </div>
    @endif
</div>
@endsection