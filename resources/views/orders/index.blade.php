@extends('layouts.app')

@section('title', 'My Orders - MediStore')

@section('content')
<div class="container mx-auto">
    <!-- Page Header -->
    <div class="mb-10 text-center">
        <h1 class="text-5xl md:text-6xl font-display font-bold mb-4 bg-gradient-to-r from-blue-200 via-cyan-200 to-blue-200 bg-clip-text text-transparent">
            My Orders
        </h1>
        <p class="text-xl text-blue-300/70">Track and manage your orders</p>
    </div>

    <!-- Filter -->
    <div class="glass-dark rounded-2xl shadow-2xl p-6 mb-8 border border-blue-500/20">
        <form action="{{ route('orders.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
            <div class="flex-1 w-full">
                <label class="block text-sm font-semibold text-blue-200 mb-3">Filter by Status</label>
                <select 
                    name="status" 
                    class="w-full px-4 py-3 glass-dark border border-blue-500/30 rounded-xl text-blue-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                >
                    <option value="">All Orders</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <button 
                type="submit" 
                class="bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white px-8 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg shadow-blue-500/50 hover:scale-105"
            >
                Apply Filter
            </button>
            <a 
                href="{{ route('orders.index') }}" 
                class="glass-dark border border-blue-500/30 hover:border-blue-500/50 text-blue-200 px-8 py-3 rounded-xl font-semibold transition-all duration-300 hover:bg-blue-500/10"
            >
                Reset
            </a>
        </form>
    </div>

    <!-- Orders List -->
    @if($orders->count() > 0)
        <div class="space-y-6 mb-8">
            @foreach($orders as $order)
                <div class="glass-dark rounded-2xl shadow-2xl overflow-hidden border border-blue-500/20 hover:border-blue-500/40 transition-all duration-300">
                    <div class="p-6 md:p-8">
                        <!-- Order Header -->
                        <div class="flex flex-col md:flex-row justify-between items-start mb-6 gap-4">
                            <div>
                                <h3 class="text-2xl font-display font-bold text-blue-200 mb-2">{{ $order->order_number }}</h3>
                                <p class="text-sm text-blue-400/70">{{ $order->created_at->format('d M Y, H:i') }}</p>
                            </div>
                            <div class="text-right">
                                <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold glass-dark border
                                    @if($order->status == 'pending') border-yellow-500/30 text-yellow-300
                                    @elseif($order->status == 'processing') border-blue-500/30 text-blue-300
                                    @elseif($order->status == 'completed') border-green-500/30 text-green-300
                                    @elseif($order->status == 'cancelled') border-red-500/30 text-red-300
                                    @endif
                                ">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>

                        <!-- Order Items Preview -->
                        <div class="border-t border-b border-blue-500/20 py-6 mb-6">
                            <div class="space-y-3">
                                @foreach($order->orderItems->take(2) as $item)
                                    <div class="flex items-center gap-4">
                                        <div class="w-16 h-16 flex-shrink-0 rounded-xl overflow-hidden border border-blue-500/30">
                                            @if($item->product->image)
                                                <img 
                                                    src="{{ asset('storage/' . $item->product->image) }}" 
                                                    alt="{{ $item->product->name }}"
                                                    class="w-full h-full object-cover"
                                                >
                                            @else
                                                <div class="w-full h-full glass-dark flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-blue-400/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <p class="font-display font-bold text-blue-200">{{ $item->product->name }}</p>
                                            <p class="text-sm text-blue-400/70">Qty: {{ $item->quantity }} × Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                @endforeach
                                @if($order->orderItems->count() > 2)
                                    <p class="text-sm text-blue-400/70 mt-2">+ {{ $order->orderItems->count() - 2 }} more items</p>
                                @endif
                            </div>
                        </div>

                        <!-- Order Summary & Actions -->
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                            <div>
                                <p class="text-sm text-blue-400/70 mb-1">Total Amount</p>
                                <p class="text-3xl font-display font-bold bg-gradient-to-r from-blue-300 to-cyan-300 bg-clip-text text-transparent">
                                    Rp {{ number_format($order->total_amount + $order->tax, 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="flex gap-3">
                                <a 
                                    href="{{ route('orders.show', $order->id) }}" 
                                    class="bg-gradient-to-r from-blue-500/20 to-cyan-500/20 border border-blue-500/30 hover:border-blue-500/50 text-blue-200 hover:text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 hover:bg-blue-500/30"
                                >
                                    View Details
                                </a>
                                @if($order->status == 'pending')
                                    <form action="{{ route('orders.cancel', $order->id) }}" method="POST">
                                        @csrf
                                        <button 
                                            type="submit"
                                            onclick="return confirm('Are you sure you want to cancel this order?')"
                                            class="glass-dark border border-red-500/30 hover:border-red-500/50 text-red-400 hover:text-red-300 px-6 py-3 rounded-xl font-semibold transition-all duration-300 hover:bg-red-500/10"
                                        >
                                            Cancel Order
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-10 flex justify-center">
            <div class="glass-dark rounded-xl p-4 border border-blue-500/20">
                {{ $orders->links() }}
            </div>
        </div>
    @else
        <!-- Empty State -->
        <div class="glass-dark rounded-2xl shadow-2xl p-16 text-center border border-blue-500/20">
            <div class="w-32 h-32 mx-auto mb-6 bg-gradient-to-br from-blue-500/20 to-cyan-500/20 rounded-full flex items-center justify-center">
                <svg class="w-16 h-16 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
            </div>
            <h3 class="text-3xl font-display font-bold text-blue-200 mb-3">No Orders Yet</h3>
            <p class="text-blue-300/70 mb-8 text-lg">You haven't placed any orders yet. Start shopping!</p>
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
