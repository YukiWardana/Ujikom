@extends('layouts.app')

@section('title', 'Order Detail - Toko Alat Kesehatan')

@section('content')
<div class="container mx-auto max-w-4xl">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('orders.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Orders
        </a>
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
                    <p class="text-sm opacity-90 mb-1">Status</p>
                    <span class="inline-block px-4 py-1 rounded-full text-sm font-semibold
                        @if($order->status == 'pending') bg-yellow-500
                        @elseif($order->status == 'processing') bg-blue-500
                        @elseif($order->status == 'completed') bg-green-500
                        @elseif($order->status == 'cancelled') bg-red-500
                        @endif
                    ">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>
            <p class="text-sm opacity-90 mt-2">Ordered on {{ $order->created_at->format('d F Y, H:i') }}</p>
        </div>

        <!-- Customer & Payment Info -->
        <div class="p-6 border-b">
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <h3 class="font-bold text-gray-800 mb-3">Customer Information</h3>
                    <div class="space-y-2 text-sm">
                        <div>
                            <span class="text-gray-600">Name:</span>
                            <span class="font-medium ml-2">{{ $order->user->username }}</span>
                        </div>
                        <div>
                            <span class="text-gray-600">Email:</span>
                            <span class="font-medium ml-2">{{ $order->user->email }}</span>
                        </div>
                        <div>
                            <span class="text-gray-600">Contact:</span>
                            <span class="font-medium ml-2">{{ $order->user->contact_no }}</span>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 mb-3">Payment Information</h3>
                    <div class="space-y-2 text-sm">
                        <div>
                            <span class="text-gray-600">Method:</span>
                            <span class="font-medium ml-2 capitalize">{{ $order->payment_method }}</span>
                        </div>
                        @if($order->payment_type)
                        <div>
                            <span class="text-gray-600">Type:</span>
                            <span class="font-medium ml-2">{{ ucwords(str_replace('_', ' ', $order->payment_type)) }}</span>
                        </div>
                        @endif
                    </div>
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
                    <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg">
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
                            <p class="text-sm text-gray-500">{{ $item->product->category->name }}</p>
                            <p class="text-sm text-gray-600 mt-1">
                                {{ $item->quantity }} × Rp {{ number_format($item->price, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-gray-800">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Order Summary -->
        <div class="p-6 bg-gray-50">
            <div class="max-w-md ml-auto">
                <div class="space-y-2 mb-4">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal:</span>
                        <span>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Tax (11%):</span>
                        <span>Rp {{ number_format($order->tax, 0, ',', '.') }}</span>
                    </div>
                    <div class="border-t pt-2 flex justify-between text-xl font-bold text-gray-800">
                        <span>Total:</span>
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
            Download Invoice
        </a>
        @if($order->status == 'pending')
            <form action="{{ route('orders.cancel', $order->id) }}" method="POST">
                @csrf
                <button 
                    type="submit"
                    onclick="return confirm('Are you sure you want to cancel this order? Stock will be restored.')"
                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold transition"
                >
                    Cancel Order
                </button>
            </form>
        @endif
    </div>

    <!-- Order Timeline -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="font-bold text-gray-800 mb-4">Order Status Timeline</h3>
        <div class="space-y-4">
            <div class="flex items-start gap-4">
                <div class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold">Order Placed</p>
                    <p class="text-sm text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>

            @if($order->status == 'cancelled')
                <div class="flex items-start gap-4">
                    <div class="w-8 h-8 rounded-full bg-red-500 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold">Order Cancelled</p>
                        <p class="text-sm text-gray-500">{{ $order->updated_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            @else
                <div class="flex items-start gap-4">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0
                        {{ in_array($order->status, ['processing', 'completed']) ? 'bg-green-500' : 'bg-gray-300' }}
                    ">
                        @if(in_array($order->status, ['processing', 'completed']))
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        @else
                            <span class="text-white text-xs">2</span>
                        @endif
                    </div>
                    <div>
                        <p class="font-semibold">Processing</p>
                        <p class="text-sm text-gray-500">{{ in_array($order->status, ['processing', 'completed']) ? 'In progress' : 'Waiting...' }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0
                        {{ $order->status == 'completed' ? 'bg-green-500' : 'bg-gray-300' }}
                    ">
                        @if($order->status == 'completed')
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        @else
                            <span class="text-white text-xs">3</span>
                        @endif
                    </div>
                    <div>
                        <p class="font-semibold">Completed</p>
                        <p class="text-sm text-gray-500">{{ $order->status == 'completed' ? 'Order delivered' : 'Waiting...' }}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection