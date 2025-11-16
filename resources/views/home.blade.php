@extends('layouts.app')

@section('title', 'Home - Toko Alat Kesehatan')

@section('content')
<div class="text-center">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white rounded-lg p-12 mb-12">
        <h1 class="text-5xl font-bold mb-4">Welcome to Toko Alat Kesehatan</h1>
        <p class="text-xl mb-8">Toko peralatan medis terpercaya Anda</p>
        <a href="{{ route('products.index') }}" class="inline-block bg-white text-blue-600 hover:bg-gray-100 px-8 py-3 rounded-lg font-semibold text-lg transition shadow-lg">
            Browse Products
        </a>
    </div>
    
    <!-- Features -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="text-blue-600 mb-4">
                <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold mb-2">Produk Berkualitas</h3>
            <p class="text-gray-600">Peralatan medis berkualitas tinggi dari merek-merek terpercaya</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="text-blue-600 mb-4">
                <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold mb-2">Harga Terbaik</h3>
            <p class="text-gray-600">Harga kompetitif dengan diskon spesial</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="text-blue-600 mb-4">
                <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold mb-2">Pengiriman Cepat</h3>
            <p class="text-gray-600">Pengiriman cepat dan aman sampai ke rumah Anda</p>
        </div>
    </div>
</div>
@endsection
