@extends('layouts.app')

@section('title', 'Order Success - Toko Alat Kesehatan')

@section('content')
<div class="container mx-auto max-w-3xl">
    <!-- Success Message -->
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-4">
            <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Order Placed Successfully!</h1>
        <p class="text-gray-600">Thank you for your purchase. Your order has been received.</p>
    </div>

    <!-- Order Details Card -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
        <!-- Order Header -->
        <div class="bg-blue-600 text-white p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm opacity-90 mb-1">Order Number</p>
                    <p class="text-2xl font-bold">{{ $order->order_number }}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm opacity-90 mb-1">Order Date</p>
                    <p class="font-semibold">{{ $order->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>
        </div>

        <!-- Customer Info -->
        <div class="p-6 border-b">
            <h3 class="font-bold text-gray-800 mb-3">Customer Information</h3>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-gray-600 mb-1">Name</p>
                    <p class="font-medium">{{ $order->user->username }}</p>
                </div>
                <div>
                    <p class="text-gray-600 mb-1">Email</p>
                    <p class="font-medium">{{ $order->user->email }}</p>
                </div>
                <div>
                    <p class="text-gray-600 mb-1">Contact</p>
                    <p class="font-medium">{{ $order->user->contact_no }}</p>
                </div>
                <div>
                    <p class="text-gray-600 mb-1">Payment Method</p>
                    <p class="font-medium capitalize">
                        {{ $order->payment_method }}
                        @if($order->payment_type)
                            ({{ ucwords(str_replace('_', ' ', $order->payment_type)) }})
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- Shipping Address -->
        <div class="p-6 border-b">
            <h3 class="font-bold text-gray-800 mb-3">Shipping Address</h3>
            <p class="text-gray-600">{{ $order->shipping_address }}</p>
        </div>

        <!-- Order Items -->
        <div class="p-6 border-b">
            <h3 class="font-bold text-gray-800 mb-4">Order Items</h3>
            <div class="space-y-4">
                @foreach($order->orderItems as $item)
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 flex-shrink-0">
                            @if($item->product->image)
                                <img 
                                    src="{{ asset('storage/' . $item->product->image) }}" 
                                    alt="{{ $item->product->name }}"
                                    class="w-full h-full object-cover rounded"
                                >
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-blue-100 to-blue-200 rounded flex items-center justify-center">
                                    <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-800">{{ $item->product->name }}</h4>
                            <p class="text-sm text-gray-500">Quantity: {{ $item->quantity }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-gray-800">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                            <p class="text-sm text-gray-500">@ Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Order Summary -->
        <div class="p-6 bg-gray-50">
            <div class="space-y-2 mb-4">
                <div class="flex justify-between text-gray-600">
                    <span>Subtotal</span>
                    <span>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-gray-600">
                    <span>Tax (11%)</span>
                    <span>Rp {{ number_format($order->tax, 0, ',', '.') }}</span>
                </div>
                <div class="border-t pt-2 flex justify-between text-xl font-bold text-gray-800">
                    <span>Total</span>
                    <span class="text-blue-600">Rp {{ number_format($order->total_amount + $order->tax, 0, ',', '.') }}</span>
                </div>
            </div>

            @if($order->notes)
                <div class="mt-4 pt-4 border-t">
                    <p class="text-sm text-gray-600 mb-1">Order Notes:</p>
                    <p class="text-gray-800">{{ $order->notes }}</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex gap-4 justify-center mb-8">
        <a 
            href="{{ route('invoice.download', $order->id) }}" 
            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition inline-flex items-center gap-2"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Download Invoice (PDF)
        </a>
        <a 
            href="{{ route('products.index') }}" 
            class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-semibold transition"
        >
            Continue Shopping
        </a>
    </div>

    <!-- Info Box -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-center">
        <p class="text-blue-800">
            <strong>What's Next?</strong> We will process your order and send you a confirmation email shortly.
        </p>
    </div>
</div>
@endsection