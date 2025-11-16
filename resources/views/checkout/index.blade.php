@extends('layouts.app')

@section('title', 'Checkout - MediStore')

@section('content')
<div class="container mx-auto">
    <!-- Page Header -->
    <div class="mb-10 text-center">
        <h1 class="text-5xl md:text-6xl font-display font-bold mb-4 bg-gradient-to-r from-blue-200 via-cyan-200 to-blue-200 bg-clip-text text-transparent">
            Checkout
        </h1>
        <p class="text-xl text-blue-300/70">Complete your order</p>
    </div>

    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Forms -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Shipping Information -->
                <div class="glass-dark rounded-2xl shadow-2xl p-6 md:p-8 border border-blue-500/20">
                    <h2 class="text-2xl font-display font-bold text-blue-200 mb-6">Shipping Information</h2>
                    
                    <div class="space-y-5">
                        <div>
                            <label class="block text-blue-200 font-semibold mb-3">Full Name</label>
                            <input 
                                type="text" 
                                value="{{ $user->username }}" 
                                class="w-full px-4 py-3 glass-dark border border-blue-500/30 rounded-xl text-blue-200" 
                                readonly
                            >
                        </div>

                        <div>
                            <label class="block text-blue-200 font-semibold mb-3">Email</label>
                            <input 
                                type="email" 
                                value="{{ $user->email }}" 
                                class="w-full px-4 py-3 glass-dark border border-blue-500/30 rounded-xl text-blue-200" 
                                readonly
                            >
                        </div>

                        <div>
                            <label class="block text-blue-200 font-semibold mb-3">Contact Number</label>
                            <input 
                                type="text" 
                                value="{{ $user->contact_no }}" 
                                class="w-full px-4 py-3 glass-dark border border-blue-500/30 rounded-xl text-blue-200" 
                                readonly
                            >
                        </div>

                        <div>
                            <label for="shipping_address" class="block text-blue-200 font-semibold mb-3">Shipping Address *</label>
                            <textarea 
                                id="shipping_address" 
                                name="shipping_address" 
                                rows="3"
                                class="w-full px-4 py-3 glass-dark border border-blue-500/30 rounded-xl text-blue-200 placeholder-blue-400/50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('shipping_address') border-red-500/50 @enderror"
                                placeholder="Enter your complete shipping address"
                                required
                            >{{ old('shipping_address', $user->address) }}</textarea>
                            @error('shipping_address')
                                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="notes" class="block text-blue-200 font-semibold mb-3">Order Notes (Optional)</label>
                            <textarea 
                                id="notes" 
                                name="notes" 
                                rows="2"
                                class="w-full px-4 py-3 glass-dark border border-blue-500/30 rounded-xl text-blue-200 placeholder-blue-400/50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                placeholder="Any special instructions for your order"
                            >{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="glass-dark rounded-2xl shadow-2xl p-6 md:p-8 border border-blue-500/20">
                    <h2 class="text-2xl font-display font-bold text-blue-200 mb-6">Payment Method</h2>
                    
                    <div class="space-y-5">
                        <!-- Payment Method Selection -->
                        <div>
                            <label class="block text-blue-200 font-semibold mb-4">Choose Payment Method *</label>
                            <div class="space-y-3">
                                <label class="flex items-center p-4 glass-dark border border-blue-500/30 rounded-xl cursor-pointer hover:border-blue-500/50 hover:bg-blue-500/10 transition-all">
                                    <input 
                                        type="radio" 
                                        name="payment_method" 
                                        value="prepaid" 
                                        class="w-5 h-5 text-blue-500 border-blue-500/30 focus:ring-blue-500 bg-transparent"
                                        onchange="togglePaymentType(true)"
                                        {{ old('payment_method') == 'prepaid' ? 'checked' : '' }}
                                        required
                                    >
                                    <span class="ml-3 font-semibold text-blue-200">Prepaid (Pay Now)</span>
                                </label>
                                
                                <label class="flex items-center p-4 glass-dark border border-blue-500/30 rounded-xl cursor-pointer hover:border-blue-500/50 hover:bg-blue-500/10 transition-all">
                                    <input 
                                        type="radio" 
                                        name="payment_method" 
                                        value="postpaid" 
                                        class="w-5 h-5 text-blue-500 border-blue-500/30 focus:ring-blue-500 bg-transparent"
                                        onchange="togglePaymentType(false)"
                                        {{ old('payment_method') == 'postpaid' ? 'checked' : '' }}
                                    >
                                    <span class="ml-3 font-semibold text-blue-200">Postpaid (Pay on Delivery)</span>
                                </label>
                            </div>
                            @error('payment_method')
                                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Payment Type (for Prepaid) -->
                        <div id="payment-type-section" class="hidden">
                            <label class="block text-blue-200 font-semibold mb-4">Select Payment Type *</label>
                            <div class="space-y-3">
                                <label class="flex items-center p-4 glass-dark border border-blue-500/30 rounded-xl cursor-pointer hover:border-blue-500/50 hover:bg-blue-500/10 transition-all">
                                    <input 
                                        type="radio" 
                                        name="payment_type" 
                                        value="paypal" 
                                        class="w-5 h-5 text-blue-500 border-blue-500/30 focus:ring-blue-500 bg-transparent"
                                        {{ old('payment_type') == 'paypal' ? 'checked' : '' }}
                                    >
                                    <div class="ml-3">
                                        <span class="font-semibold text-blue-200">PayPal</span>
                                        @if($user->paypal_id)
                                            <p class="text-sm text-blue-400/70">{{ $user->paypal_id }}</p>
                                        @endif
                                    </div>
                                </label>

                                <label class="flex items-center p-4 glass-dark border border-blue-500/30 rounded-xl cursor-pointer hover:border-blue-500/50 hover:bg-blue-500/10 transition-all">
                                    <input 
                                        type="radio" 
                                        name="payment_type" 
                                        value="debit_card" 
                                        class="w-5 h-5 text-blue-500 border-blue-500/30 focus:ring-blue-500 bg-transparent"
                                        {{ old('payment_type') == 'debit_card' ? 'checked' : '' }}
                                    >
                                    <span class="ml-3 font-semibold text-blue-200">Debit Card</span>
                                </label>

                                <label class="flex items-center p-4 glass-dark border border-blue-500/30 rounded-xl cursor-pointer hover:border-blue-500/50 hover:bg-blue-500/10 transition-all">
                                    <input 
                                        type="radio" 
                                        name="payment_type" 
                                        value="credit_card" 
                                        class="w-5 h-5 text-blue-500 border-blue-500/30 focus:ring-blue-500 bg-transparent"
                                        {{ old('payment_type') == 'credit_card' ? 'checked' : '' }}
                                    >
                                    <span class="ml-3 font-semibold text-blue-200">Credit Card</span>
                                </label>
                            </div>
                            @error('payment_type')
                                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Order Summary -->
            <div class="lg:col-span-1">
                <div class="glass-dark rounded-2xl shadow-2xl p-6 sticky top-24 border border-blue-500/20">
                    <h2 class="text-2xl font-display font-bold text-blue-200 mb-6">Order Summary</h2>

                    <!-- Items -->
                    <div class="space-y-3 mb-6 max-h-64 overflow-y-auto">
                        @foreach($cartItems as $item)
                            <div class="flex justify-between text-sm text-blue-300">
                                <span>
                                    {{ $item->product->name }} x{{ $item->quantity }}
                                </span>
                                <span class="font-semibold">
                                    Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-blue-500/30 pt-4 space-y-3 mb-6">
                        <div class="flex justify-between text-blue-300">
                            <span>Subtotal</span>
                            <span class="font-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-blue-300">
                            <span>Tax (11%)</span>
                            <span class="font-semibold">Rp {{ number_format($tax, 0, ',', '.') }}</span>
                        </div>
                        <div class="border-t border-blue-500/30 pt-3 flex justify-between text-xl font-display font-bold text-blue-200">
                            <span>Total</span>
                            <span class="bg-gradient-to-r from-blue-300 to-cyan-300 bg-clip-text text-transparent">
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <button 
                        type="submit"
                        class="w-full bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white py-4 rounded-xl font-display font-semibold transition-all duration-300 shadow-lg shadow-blue-500/50 hover:scale-105 mb-4"
                    >
                        Place Order
                    </button>

                    <a 
                        href="{{ route('cart.index') }}" 
                        class="block text-center text-blue-300 hover:text-blue-200 font-semibold transition-colors"
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
