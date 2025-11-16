<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MediStore - Premium Medical Equipment')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        .font-display {
            font-family: 'Poppins', sans-serif;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .glass-dark {
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 min-h-screen">
    <!-- Navbar -->
    <nav class="glass-dark sticky top-0 z-50 border-b border-blue-500/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center group">
                        <div class="bg-gradient-to-br from-blue-500 to-cyan-500 text-white w-12 h-12 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/50 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <span class="ml-4 text-2xl font-display font-bold bg-gradient-to-r from-blue-300 to-cyan-300 bg-clip-text text-transparent">MediStore</span>
                    </a>
                </div>

                <!-- Menu -->
                <div class="flex items-center space-x-2">
                    @auth
                        <a href="{{ route('home') }}" class="text-blue-200 hover:text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-blue-500/20">Home</a>
                        <a href="{{ route('products.index') }}" class="text-blue-200 hover:text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-blue-500/20">Products</a>
                        
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="text-blue-200 hover:text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-blue-500/20">Dashboard</a>
                            <a href="{{ route('admin.products.index') }}" class="text-blue-200 hover:text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-blue-500/20">Manage</a>
                        @else
                            <a href="{{ route('cart.index') }}" class="text-blue-200 hover:text-white px-4 py-2 rounded-lg text-sm font-medium relative transition-all duration-200 hover:bg-blue-500/20">
                                <span class="flex items-center">
                                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    Cart
                                </span>
                                <span id="cart-count" class="absolute -top-1 -right-1 bg-gradient-to-r from-cyan-500 to-red-500 text-white text-xs rounded-full w-6 h-6 flex items-center justify-center font-bold shadow-lg">
                                    {{ Auth::user()->carts->sum('quantity') }}
                                </span>
                            </a>
                        @endif

                        <!-- User Dropdown -->
                        <div class="relative" id="user-dropdown-container">
                            <button 
                                id="user-dropdown-button"
                                class="flex items-center space-x-2 text-blue-200 hover:text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-blue-500/20"
                                onclick="toggleUserDropdown(event)"
                            >
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-400 to-cyan-400 flex items-center justify-center text-white font-bold text-sm">
                                    {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                                </div>
                                <span>{{ Auth::user()->username }}</span>
                                <svg id="dropdown-arrow" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div 
                                id="user-dropdown-menu"
                                class="absolute right-0 top-full mt-2 glass-dark rounded-xl shadow-2xl hidden z-50 min-w-[12rem] border border-blue-500/20 overflow-hidden"
                            >
                                <div class="py-2">
                                    <a href="{{ route('profile.index') }}" class="block px-4 py-2 text-sm text-blue-200 hover:text-white hover:bg-blue-500/20 transition-all">Profile</a>
                                    <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-blue-200 hover:text-white hover:bg-blue-500/20 transition-all">My Orders</a>
                                    <div class="border-t border-blue-500/20 my-1"></div>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-400 hover:text-red-300 hover:bg-red-500/10 transition-all">Logout</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('products.index') }}" class="text-blue-200 hover:text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-blue-500/20">Products</a>
                        <a href="{{ route('login') }}" class="text-blue-200 hover:text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-blue-500/20">Login</a>
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white px-6 py-2 rounded-lg text-sm font-medium shadow-lg shadow-blue-500/50 transition-all duration-200 hover:scale-105">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        <div class="glass-dark border border-green-500/30 text-green-300 px-6 py-4 rounded-xl shadow-lg backdrop-blur-sm">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                {{ session('success') }}
            </div>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        <div class="glass-dark border border-red-500/30 text-red-300 px-6 py-4 rounded-xl shadow-lg backdrop-blur-sm">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                {{ session('error') }}
            </div>
        </div>
    </div>
    @endif

    <!-- Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="glass-dark border-t border-blue-500/20 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center">
                <div class="flex items-center justify-center mb-4">
                    <div class="bg-gradient-to-br from-blue-500 to-cyan-500 text-white w-10 h-10 rounded-lg flex items-center justify-center shadow-lg shadow-blue-500/50">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <span class="ml-3 text-xl font-display font-bold bg-gradient-to-r from-blue-300 to-cyan-300 bg-clip-text text-transparent">MediStore</span>
                </div>
                <p class="text-blue-300/70">&copy; 2024 MediStore - Premium Medical Equipment. All rights reserved.</p>
            </div>
        </div>
    </footer>
    
    @auth
    <script>
        function updateCartCount() {
            fetch('{{ route("cart.count") }}')
                .then(response => response.json())
                .then(data => {
                    const cartCount = document.getElementById('cart-count');
                    if (cartCount) {
                        cartCount.textContent = data.count;
                    }
                })
                .catch(error => console.error('Error updating cart count:', error));
        }

        // User Dropdown Toggle
        function toggleUserDropdown(event) {
            event.stopPropagation();
            const dropdownMenu = document.getElementById('user-dropdown-menu');
            const dropdownArrow = document.getElementById('dropdown-arrow');
            
            if (dropdownMenu && dropdownArrow) {
                const isHidden = dropdownMenu.classList.contains('hidden');
                
                if (isHidden) {
                    dropdownMenu.classList.remove('hidden');
                    dropdownArrow.style.transform = 'rotate(180deg)';
                } else {
                    dropdownMenu.classList.add('hidden');
                    dropdownArrow.style.transform = 'rotate(0deg)';
                }
            }
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdownContainer = document.getElementById('user-dropdown-container');
            const dropdownMenu = document.getElementById('user-dropdown-menu');
            const dropdownArrow = document.getElementById('dropdown-arrow');
            
            if (dropdownContainer && dropdownMenu && !dropdownContainer.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
                if (dropdownArrow) {
                    dropdownArrow.style.transform = 'rotate(0deg)';
                }
            }
        });

        document.addEventListener('DOMContentLoaded', updateCartCount);
    </script>
    @endauth
</body>
</html>