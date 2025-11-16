@extends('layouts.app')

@section('title', 'Checkout - Toko Alat Kesehatan')

@section('content')
<div class="container mx-auto">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Checkout</h1>
        <p class="text-gray-600">Complete your order</p>
    </div>

    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Forms -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Shipping Information -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Shipping Information</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Full Name</label>
                            <input 
                                type="text" 
                                value="{{ $user->username }}" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50" 
                                readonly
                            >
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Email</label>
                            <input 
                                type="email" 
                                value="{{ $user->email }}" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50" 
                                readonly
                            >
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Contact Number</label>
                            <input 
                                type="text" 
                                value="{{ $user->contact_no }}" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50" 
                                readonly
                            >
                        </div>

                        <div>
                            <label for="shipping_address" class="block text-gray-700 font-medium mb-2">Shipping Address *</label>
                            <textarea 
                                id="shipping_address" 
                                name="shipping_address" 
                                rows="3"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('shipping_address') border-red-500 @enderror"
                                placeholder="Enter your complete shipping address"
                                required
                            >{{ old('shipping_address', $user->address) }}</textarea>
                            @error('shipping_address')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="notes" class="block text-gray-700 font-medium mb-2">Order Notes (Optional)</label>
                            <textarea 
                                id="notes" 
                                name="notes" 
                                rows="2"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Any special instructions for your order"
                            >{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Payment Method</h2>
                    
                    <div class="space-y-4">
                        <!-- Payment Method Selection -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-3">Choose Payment Method *</label>
                            <div class="space-y-3">
                                <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition">
                                    <input 
                                        type="radio" 
                                        name="payment_method" 
                                        value="prepaid" 
                                        class="w-5 h-5 text-blue-600"
                                        onchange="togglePaymentType(true)"
                                        {{ old('payment_method') == 'prepaid' ? 'checked' : '' }}
                                        required
                                    >
                                    <span class="ml-3 font-medium">Prepaid (Pay Now)</span>
                                </label>
                                
                                <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition">
                                    <input 
                                        type="radio" 
                                        name="payment_method" 
                                        value="postpaid" 
                                        class="w-5 h-5 text-blue-600"
                                        onchange="togglePaymentType(false)"
                                        {{ old('payment_method') == 'postpaid' ? 'checked' : '' }}
                                    >
                                    <span class="ml-3 font-medium">Postpaid (Pay on Delivery)</span>
                                </label>
                            </div>
                            @error('payment_method')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Payment Type (for Prepaid) -->
                        <div id="payment-type-section" class="hidden">
                            <label class="block text-gray-700 font-medium mb-3">Select Payment Type *</label>
                            <div class="space-y-3">
                                <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition">
                                    <input 
                                        type="radio" 
                                        name="payment_type" 
                                        value="paypal" 
                                        class="w-5 h-5 text-blue-600"
                                        {{ old('payment_type') == 'paypal' ? 'checked' : '' }}
                                    >
                                    <div class="ml-3">
                                        <span class="font-medium">PayPal</span>
                                        @if($user->paypal_id)
                                            <p class="text-sm text-gray-500">{{ $user->paypal_id }}</p>
                                        @endif
                                    </div>
                                </label>

                                <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition">
                                    <input 
                                        type="radio" 
                                        name="payment_type" 
                                        value="debit_card" 
                                        class="w-5 h-5 text-blue-600"
                                        {{ old('payment_type') == 'debit_card' ? 'checked' : '' }}
                                    >
                                    <span class="ml-3 font-medium">Debit Card</span>
                                </label>

                                <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition">
                                    <input 
                                        type="radio" 
                                        name="payment_type" 
                                        value="credit_card" 
                                        class="w-5 h-5 text-blue-600"
                                        {{ old('payment_type') == 'credit_card' ? 'checked' : '' }}
                                    >
                                    <span class="ml-3 font-medium">Credit Card</span>
                                </label>
                            </div>
                            @error('payment_type')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Order Summary</h2>

                    <!-- Items -->
                    <div class="space-y-3 mb-4 max-h-64 overflow-y-auto">
                        @foreach($cartItems as $item)
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">
                                    {{ $item->product->name }} x{{ $item->quantity }}
                                </span>
                                <span class="font-medium">
                                    Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t pt-4 space-y-3 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
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

                    <button 
                        type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold transition mb-3"
                    >
                        Place Order
                    </button>

                    <a 
                        href="{{ route('cart.index') }}" 
                        class="block text-center text-blue-600 hover:text-blue-700 font-medium"
                    >
                        Back to Cart
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function togglePaymentType(show) {
        const paymentTypeSection = document.getElementById('payment-type-section');
        if (show) {
            paymentTypeSection.classList.remove('hidden');
        } else {
            paymentTypeSection.classList.add('hidden');
            // Clear payment type selection
            document.querySelectorAll('input[name="payment_type"]').forEach(input => {
                input.checked = false;
            });
        }
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        const prepaidRadio = document.querySelector('input[name="payment_method"][value="prepaid"]');
        if (prepaidRadio && prepaidRadio.checked) {
            togglePaymentType(true);
        }
    });
</script>
@endsection