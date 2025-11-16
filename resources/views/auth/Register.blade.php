<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - MediStore</title>
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
<body class="bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 min-h-screen py-8 px-4">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="animate-float mb-6">
                <div class="bg-gradient-to-br from-blue-500 to-cyan-500 text-white w-24 h-24 rounded-3xl flex items-center justify-center mx-auto shadow-2xl shadow-blue-500/50">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
            </div>
            <h1 class="text-4xl font-display font-bold mb-2 bg-gradient-to-r from-blue-200 via-cyan-200 to-blue-200 bg-clip-text text-transparent">
                Create Account
            </h1>
            <p class="text-blue-300/70">Join MediStore today</p>
        </div>

        <!-- Register Card -->
        <div class="glass-dark rounded-3xl shadow-2xl p-8 border border-blue-500/20">
            <!-- Error Messages -->
            @if($errors->any())
            <div class="mb-6 glass-dark border border-red-500/30 text-red-300 px-4 py-3 rounded-xl">
                <p class="font-semibold mb-2">Please fix the following errors:</p>
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Username -->
                    <div>
                        <label for="username" class="block text-blue-200 font-semibold mb-3">Username *</label>
                        <input 
                            type="text" 
                            id="username" 
                            name="username" 
                            value="{{ old('username') }}"
                            class="w-full px-4 py-3 glass-dark border border-blue-500/30 rounded-xl text-blue-200 placeholder-blue-400/50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                            required
                        >
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-blue-200 font-semibold mb-3">E-mail *</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            class="w-full px-4 py-3 glass-dark border border-blue-500/30 rounded-xl text-blue-200 placeholder-blue-400/50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                            required
                        >
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-blue-200 font-semibold mb-3">Password *</label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="w-full px-4 py-3 glass-dark border border-blue-500/30 rounded-xl text-blue-200 placeholder-blue-400/50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                            required
                        >
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-blue-200 font-semibold mb-3">Retype Password *</label>
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            class="w-full px-4 py-3 glass-dark border border-blue-500/30 rounded-xl text-blue-200 placeholder-blue-400/50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                            required
                        >
                    </div>

                    <!-- Date of Birth -->
                    <div>
                        <label for="date_of_birth" class="block text-blue-200 font-semibold mb-3">Date of Birth *</label>
                        <input 
                            type="date" 
                            id="date_of_birth" 
                            name="date_of_birth" 
                            value="{{ old('date_of_birth') }}"
                            class="w-full px-4 py-3 glass-dark border border-blue-500/30 rounded-xl text-blue-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                            required
                        >
                    </div>

                    <!-- Gender -->
                    <div>
                        <label class="block text-blue-200 font-semibold mb-3">Gender *</label>
                        <div class="flex gap-6 items-center h-12">
                            <label class="flex items-center cursor-pointer">
                                <input 
                                    type="radio" 
                                    name="gender" 
                                    value="male" 
                                    {{ old('gender') == 'male' ? 'checked' : '' }}
                                    class="w-5 h-5 text-blue-500 border-blue-500/30 focus:ring-blue-500 bg-transparent"
                                    required
                                >
                                <span class="ml-2 text-blue-300">Male</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input 
                                    type="radio" 
                                    name="gender" 
                                    value="female" 
                                    {{ old('gender') == 'female' ? 'checked' : '' }}
                                    class="w-5 h-5 text-blue-500 border-blue-500/30 focus:ring-blue-500 bg-transparent"
                                >
                                <span class="ml-2 text-blue-300">Female</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Address -->
                <div class="mt-6">
                    <label for="address" class="block text-blue-200 font-semibold mb-3">Address *</label>
                    <textarea 
                        id="address" 
                        name="address" 
                        rows="3"
                        class="w-full px-4 py-3 glass-dark border border-blue-500/30 rounded-xl text-blue-200 placeholder-blue-400/50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                        required
                    >{{ old('address') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <!-- City -->
                    <div>
                        <label for="city" class="block text-blue-200 font-semibold mb-3">City *</label>
                        <select 
                            id="city" 
                            name="city" 
                            class="w-full px-4 py-3 glass-dark border border-blue-500/30 rounded-xl text-blue-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                            required
                        >
                            <option value="">Select City</option>
                            <option value="Jakarta" {{ old('city') == 'Jakarta' ? 'selected' : '' }}>Jakarta</option>
                            <option value="Surabaya" {{ old('city') == 'Surabaya' ? 'selected' : '' }}>Surabaya</option>
                            <option value="Bandung" {{ old('city') == 'Bandung' ? 'selected' : '' }}>Bandung</option>
                            <option value="Yogyakarta" {{ old('city') == 'Yogyakarta' ? 'selected' : '' }}>Yogyakarta</option>
                            <option value="Semarang" {{ old('city') == 'Semarang' ? 'selected' : '' }}>Semarang</option>
                        </select>
                    </div>

                    <!-- Contact Number -->
                    <div>
                        <label for="contact_no" class="block text-blue-200 font-semibold mb-3">Contact No. *</label>
                        <input 
                            type="tel" 
                            id="contact_no" 
                            name="contact_no" 
                            value="{{ old('contact_no') }}"
                            class="w-full px-4 py-3 glass-dark border border-blue-500/30 rounded-xl text-blue-200 placeholder-blue-400/50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                            placeholder="08xxxxxxxxxx"
                            required
                        >
                    </div>

                    <!-- PayPal ID -->
                    <div class="md:col-span-2">
                        <label for="paypal_id" class="block text-blue-200 font-semibold mb-3">PayPal ID (Optional)</label>
                        <input 
                            type="email" 
                            id="paypal_id" 
                            name="paypal_id" 
                            value="{{ old('paypal_id') }}"
                            class="w-full px-4 py-3 glass-dark border border-blue-500/30 rounded-xl text-blue-200 placeholder-blue-400/50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                            placeholder="your-email@paypal.com"
                        >
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex gap-4 mt-8">
                    <button 
                        type="submit" 
                        class="flex-1 bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white font-display font-semibold py-4 rounded-xl transition-all duration-300 shadow-lg shadow-blue-500/50 hover:scale-105"
                    >
                        Submit
                    </button>
                    <button 
                        type="reset" 
                        class="flex-1 glass-dark border border-blue-500/30 hover:border-blue-500/50 text-blue-200 font-semibold py-4 rounded-xl transition-all duration-300 hover:bg-blue-500/10"
                    >
                        Clear
                    </button>
                </div>
            </form>

            <!-- Login Link -->
            <div class="mt-6 text-center">
                <p class="text-blue-300/70">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-blue-300 hover:text-white font-semibold transition-colors">
                        Login here
                    </a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
