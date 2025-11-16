<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MediStore</title>
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
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo & Header -->
        <div class="text-center mb-8">
            <div class="animate-float mb-6">
                <div class="bg-gradient-to-br from-blue-500 to-cyan-500 text-white w-24 h-24 rounded-3xl flex items-center justify-center mx-auto shadow-2xl shadow-blue-500/50">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
            </div>
            <h1 class="text-4xl font-display font-bold mb-2 bg-gradient-to-r from-blue-200 via-cyan-200 to-blue-200 bg-clip-text text-transparent">
                Welcome Back
            </h1>
            <p class="text-blue-300/70">Sign in to your MediStore account</p>
        </div>

        <!-- Login Card -->
        <div class="glass-dark rounded-3xl shadow-2xl p-8 border border-blue-500/20">
            <!-- Success Message -->
            @if(session('success'))
            <div class="mb-6 glass-dark border border-green-500/30 text-green-300 px-4 py-3 rounded-xl">
                {{ session('success') }}
            </div>
            @endif

            <!-- Error Messages -->
            @if($errors->any())
            <div class="mb-6 glass-dark border border-red-500/30 text-red-300 px-4 py-3 rounded-xl">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                
                <!-- Username -->
                <div class="mb-6">
                    <label for="username" class="block text-blue-200 font-semibold mb-3">Username</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        value="{{ old('username') }}"
                        class="w-full px-4 py-3 glass-dark border border-blue-500/30 rounded-xl text-blue-200 placeholder-blue-400/50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                        placeholder="Enter your username"
                        required
                    >
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-blue-200 font-semibold mb-3">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="w-full px-4 py-3 glass-dark border border-blue-500/30 rounded-xl text-blue-200 placeholder-blue-400/50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                        placeholder="Enter your password"
                        required
                    >
                </div>

                <!-- Remember Me -->
                <div class="mb-6 flex items-center">
                    <input 
                        type="checkbox" 
                        id="remember" 
                        name="remember" 
                        class="w-5 h-5 text-blue-500 border-blue-500/30 rounded focus:ring-blue-500 bg-transparent"
                    >
                    <label for="remember" class="ml-3 text-blue-300">Remember Me</label>
                </div>

                <!-- Login Button -->
                <button 
                    type="submit" 
                    class="w-full bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white font-display font-semibold py-4 rounded-xl transition-all duration-300 shadow-lg shadow-blue-500/50 hover:scale-105"
                >
                    LOGIN
                </button>
            </form>

            <!-- Register Link -->
            <div class="mt-6 text-center">
                <p class="text-blue-300/70">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-blue-300 hover:text-white font-semibold transition-colors">
                        Register here
                    </a>
                </p>
            </div>
        </div>

        <!-- Demo Credentials -->
        <div class="mt-6 glass-dark rounded-2xl shadow-lg p-4 border border-blue-500/20">
            <p class="font-semibold mb-3 text-blue-200">Demo Login:</p>
            <div class="space-y-2 text-sm">
                <p class="text-blue-300/70">
                    Admin: <span class="font-mono glass-dark border border-blue-500/30 px-2 py-1 rounded-lg text-blue-200">admin / password</span>
                </p>
                <p class="text-blue-300/70">
                    Customer: <span class="font-mono glass-dark border border-blue-500/30 px-2 py-1 rounded-lg text-blue-200">customer1 / password</span>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
