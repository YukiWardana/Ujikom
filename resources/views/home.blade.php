@extends('layouts.app')

@section('title', 'Home - MediStore')

@section('content')
<div>
    <!-- Hero Section -->
    <div class="relative overflow-hidden glass-dark rounded-3xl p-12 md:p-20 mb-16 border border-blue-500/30 shadow-2xl">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600/20 to-cyan-600/20"></div>
        <div class="relative z-10 text-center">
            <div class="animate-float mb-6">
                <div class="inline-block bg-gradient-to-br from-blue-500 to-cyan-500 w-24 h-24 rounded-3xl flex items-center justify-center shadow-2xl shadow-blue-500/50">
                    <svg class="w-14 h-14 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
            </div>
            <h1 class="text-5xl md:text-7xl font-display font-bold mb-6 bg-gradient-to-r from-blue-200 via-cyan-200 to-blue-200 bg-clip-text text-transparent">
                Welcome to MediStore
            </h1>
            <p class="text-xl md:text-2xl text-blue-200 mb-10 max-w-2xl mx-auto">
                Premium Medical Equipment Store - Your Trusted Partner in Healthcare
            </p>
            <a href="{{ route('products.index') }}" class="inline-block bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white px-10 py-4 rounded-xl font-display font-semibold text-lg transition-all duration-300 shadow-2xl shadow-blue-500/50 hover:scale-110 hover:shadow-blue-500/70">
                Explore Products
            </a>
        </div>
        <!-- Decorative elements -->
        <div class="absolute top-10 right-10 w-32 h-32 bg-blue-500/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 left-10 w-40 h-40 bg-cyan-500/20 rounded-full blur-3xl"></div>
    </div>
    
    <!-- Features -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
        <div class="glass-dark p-8 rounded-2xl border border-blue-500/20 hover:border-blue-500/40 transition-all duration-300 hover:scale-105 hover:shadow-2xl group">
            <div class="bg-gradient-to-br from-blue-500/20 to-cyan-500/20 w-16 h-16 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                <svg class="w-8 h-8 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-display font-bold mb-3 text-blue-200">Premium Quality</h3>
            <p class="text-blue-300/70 leading-relaxed">High-quality medical equipment from trusted brands worldwide</p>
        </div>

        <div class="glass-dark p-8 rounded-2xl border border-blue-500/20 hover:border-blue-500/40 transition-all duration-300 hover:scale-105 hover:shadow-2xl group">
            <div class="bg-gradient-to-br from-blue-500/20 to-cyan-500/20 w-16 h-16 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                <svg class="w-8 h-8 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-display font-bold mb-3 text-blue-200">Best Prices</h3>
            <p class="text-blue-300/70 leading-relaxed">Competitive pricing with exclusive discounts and special offers</p>
        </div>

        <div class="glass-dark p-8 rounded-2xl border border-blue-500/20 hover:border-blue-500/40 transition-all duration-300 hover:scale-105 hover:shadow-2xl group">
            <div class="bg-gradient-to-br from-blue-500/20 to-cyan-500/20 w-16 h-16 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                <svg class="w-8 h-8 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-display font-bold mb-3 text-blue-200">Fast Delivery</h3>
            <p class="text-blue-300/70 leading-relaxed">Quick and secure delivery right to your doorstep</p>
        </div>
    </div>
</div>
@endsection
