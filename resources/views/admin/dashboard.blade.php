@extends('layouts.app')

@section('title', 'Admin Dashboard - MediStore')

@section('content')
<div class="container mx-auto">
    <!-- Page Header -->
    <div class="mb-10 text-center">
        <h1 class="text-5xl md:text-6xl font-display font-bold mb-4 bg-gradient-to-r from-blue-200 via-cyan-200 to-blue-200 bg-clip-text text-transparent">
            Admin Dashboard
        </h1>
        <p class="text-xl text-blue-300/70">Welcome back, <span class="text-blue-200 font-semibold">{{ Auth::user()->username }}</span>! Here's what's happening today.</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Orders -->
        <div class="glass-dark rounded-2xl shadow-2xl p-6 border border-blue-500/20 hover:border-blue-500/40 transition-all duration-300 hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-blue-400/70 mb-2">Total Orders</p>
                    <p class="text-4xl font-display font-bold text-blue-200">{{ $totalOrders }}</p>
                </div>
                <div class="bg-gradient-to-br from-blue-500/20 to-blue-600/20 p-4 rounded-2xl border border-blue-500/30">
                    <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Products -->
        <div class="glass-dark rounded-2xl shadow-2xl p-6 border border-blue-500/20 hover:border-blue-500/40 transition-all duration-300 hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-blue-400/70 mb-2">Total Products</p>
                    <p class="text-4xl font-display font-bold text-blue-200">{{ $totalProducts }}</p>
                </div>
                <div class="bg-gradient-to-br from-green-500/20 to-emerald-600/20 p-4 rounded-2xl border border-green-500/30">
                    <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Customers -->
        <div class="glass-dark rounded-2xl shadow-2xl p-6 border border-blue-500/20 hover:border-blue-500/40 transition-all duration-300 hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-blue-400/70 mb-2">Total Customers</p>
                    <p class="text-4xl font-display font-bold text-blue-200">{{ $totalCustomers }}</p>
                </div>
                <div class="bg-gradient-to-br from-blue-500/20 to-cyan-500/20 p-4 rounded-2xl border border-blue-500/30">
                    <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="glass-dark rounded-2xl shadow-2xl p-6 border border-blue-500/20 hover:border-blue-500/40 transition-all duration-300 hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-blue-400/70 mb-2">Total Revenue</p>
                    <p class="text-2xl font-display font-bold bg-gradient-to-r from-yellow-300 to-orange-300 bg-clip-text text-transparent">
                        Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                    </p>
                </div>
                <div class="bg-gradient-to-br from-yellow-500/20 to-orange-600/20 p-4 rounded-2xl border border-yellow-500/30">
                    <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Recent Orders -->
        <div class="glass-dark rounded-2xl shadow-2xl overflow-hidden border border-blue-500/20">
            <div class="p-6 border-b border-blue-500/20">
                <h2 class="text-2xl font-display font-bold text-blue-200">Recent Orders</h2>
            </div>
            <div class="divide-y divide-blue-500/20">
                @forelse($recentOrders as $order)
                    <div class="p-5 hover:bg-blue-500/10 transition-all">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <p class="font-display font-bold text-blue-200">{{ $order->order_number }}</p>
                                <p class="text-sm text-blue-400/70">{{ $order->user->username }}</p>
                            </div>
                            <span class="px-3 py-1.5 text-xs font-semibold rounded-full
                                @if($order->status == 'pending') glass-dark border border-yellow-500/30 text-yellow-300
                                @elseif($order->status == 'processing') glass-dark border border-blue-500/30 text-blue-300
                                @elseif($order->status == 'completed') glass-dark border border-green-500/30 text-green-300
                                @else glass-dark border border-red-500/30 text-red-300
                                @endif
                            ">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="text-sm text-blue-400/70">{{ $order->created_at->diffForHumans() }}</p>
                            <p class="font-display font-bold bg-gradient-to-r from-blue-300 to-cyan-300 bg-clip-text text-transparent">
                                Rp {{ number_format($order->total_amount + $order->tax, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-blue-400/70">
                        <p>No orders yet</p>
                    </div>
                @endforelse
            </div>
            <div class="p-4 glass-dark border-t border-blue-500/20">
                <a href="#" class="text-blue-300 hover:text-blue-200 font-semibold text-sm transition-colors">View All Orders →</a>
            </div>
        </div>

        <!-- Low Stock Products -->
        <div class="glass-dark rounded-2xl shadow-2xl overflow-hidden border border-blue-500/20">
            <div class="p-6 border-b border-blue-500/20">
                <h2 class="text-2xl font-display font-bold text-blue-200">Low Stock Alert</h2>
            </div>
            <div class="divide-y divide-blue-500/20">
                @forelse($lowStockProducts as $product)
                    <div class="p-5 hover:bg-blue-500/10 transition-all">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 flex-shrink-0 rounded-xl overflow-hidden border border-blue-500/30">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full glass-dark flex items-center justify-center">
                                        <svg class="w-6 h-6 text-blue-400/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <p class="font-display font-bold text-blue-200">{{ $product->name }}</p>
                                <p class="text-sm text-blue-400/70">{{ $product->category->name }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-blue-400/70">Stock</p>
                                <p class="font-display font-bold {{ $product->stock <= 5 ? 'text-red-400' : 'text-yellow-400' }}">
                                    {{ $product->stock }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-blue-400/70">
                        <p>All products have sufficient stock</p>
                    </div>
                @endforelse
            </div>
            <div class="p-4 glass-dark border-t border-blue-500/20">
                <a href="{{ route('admin.products.index') }}" class="text-blue-300 hover:text-blue-200 font-semibold text-sm transition-colors">Manage Products →</a>
            </div>
        </div>
    </div>

    <!-- Orders by Status & Top Products -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Orders by Status -->
        <div class="glass-dark rounded-2xl shadow-2xl p-6 border border-blue-500/20">
            <h2 class="text-2xl font-display font-bold text-blue-200 mb-6">Orders by Status</h2>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-3 glass-dark border border-blue-500/20 rounded-xl hover:border-blue-500/40 transition-all">
                    <div class="flex items-center gap-3">
                        <div class="w-4 h-4 bg-yellow-500 rounded-full shadow-lg shadow-yellow-500/50"></div>
                        <span class="text-blue-200 font-medium">Pending</span>
                    </div>
                    <span class="font-display font-bold text-blue-200">{{ $ordersByStatus['pending'] ?? 0 }}</span>
                </div>
                <div class="flex items-center justify-between p-3 glass-dark border border-blue-500/20 rounded-xl hover:border-blue-500/40 transition-all">
                    <div class="flex items-center gap-3">
                        <div class="w-4 h-4 bg-blue-500 rounded-full shadow-lg shadow-blue-500/50"></div>
                        <span class="text-blue-200 font-medium">Processing</span>
                    </div>
                    <span class="font-display font-bold text-blue-200">{{ $ordersByStatus['processing'] ?? 0 }}</span>
                </div>
                <div class="flex items-center justify-between p-3 glass-dark border border-blue-500/20 rounded-xl hover:border-blue-500/40 transition-all">
                    <div class="flex items-center gap-3">
                        <div class="w-4 h-4 bg-green-500 rounded-full shadow-lg shadow-green-500/50"></div>
                        <span class="text-blue-200 font-medium">Completed</span>
                    </div>
                    <span class="font-display font-bold text-blue-200">{{ $ordersByStatus['completed'] ?? 0 }}</span>
                </div>
                <div class="flex items-center justify-between p-3 glass-dark border border-blue-500/20 rounded-xl hover:border-blue-500/40 transition-all">
                    <div class="flex items-center gap-3">
                        <div class="w-4 h-4 bg-red-500 rounded-full shadow-lg shadow-red-500/50"></div>
                        <span class="text-blue-200 font-medium">Cancelled</span>
                    </div>
                    <span class="font-display font-bold text-blue-200">{{ $ordersByStatus['cancelled'] ?? 0 }}</span>
                </div>
            </div>
        </div>

        <!-- Top Selling Products -->
        <div class="glass-dark rounded-2xl shadow-2xl p-6 border border-blue-500/20">
            <h2 class="text-2xl font-display font-bold text-blue-200 mb-6">Top Selling Products</h2>
            <div class="space-y-4">
                @forelse($topProducts as $index => $product)
                    <div class="flex items-center gap-4 p-3 glass-dark border border-blue-500/20 rounded-xl hover:border-blue-500/40 transition-all">
                        <div class="w-10 h-10 flex items-center justify-center bg-gradient-to-br from-blue-500/20 to-cyan-500/20 border border-blue-500/30 text-blue-300 rounded-full font-display font-bold text-sm">
                            {{ $index + 1 }}
                        </div>
                        <div class="w-14 h-14 flex-shrink-0 rounded-xl overflow-hidden border border-blue-500/30">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full glass-dark flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-400/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <p class="font-display font-bold text-blue-200 text-sm">{{ $product->name }}</p>
                            <p class="text-xs text-blue-400/70">{{ $product->total_sold }} sold</p>
                        </div>
                        <p class="font-display font-bold bg-gradient-to-r from-blue-300 to-cyan-300 bg-clip-text text-transparent text-sm">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                    </div>
                @empty
                    <p class="text-center text-blue-400/70 py-8">No sales data yet</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
