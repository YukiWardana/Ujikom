@extends('layouts.app')

@section('title', 'My Profile - Toko Alat Kesehatan')

@section('content')
<div class="container mx-auto max-w-4xl">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">My Profile</h1>
        <p class="text-gray-600">Manage your account information</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="text-center mb-6">
                    <div class="w-24 h-24 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-3xl font-bold">{{ strtoupper(substr($user->username, 0, 1)) }}</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">{{ $user->username }}</h3>
                    <p class="text-sm text-gray-500 capitalize">{{ $user->role }}</p>
                </div>
                
                <div class="space-y-2">
                    <a href="#profile-info" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg transition">
                        Profile Information
                    </a>
                    <a href="#change-password" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg transition">
                        Change Password
                    </a>
                    <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg transition">
                        My Orders
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Profile Information -->
            <div id="profile-info" class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Profile Information</h2>
                
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Username -->
                        <div>
                            <label for="username" class="block text-gray-700 font-medium mb-2">Username *</label>
                            <input 
                                type="text" 
                                id="username" 
                                name="username" 
                                value="{{ old('username', $user->username) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('username') border-red-500 @enderror"
                                required
                            >
                            @error('username')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-gray-700 font-medium mb-2">Email *</label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="{{ old('email', $user->email) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror"
                                required
                            >
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Gender -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Jenis Kelamin</label>
                            <div class="flex gap-6 items-center h-12">
                                <label class="flex items-center cursor-pointer">
                                    <input 
                                        type="radio" 
                                        name="gender" 
                                        value="male" 
                                        {{ old('gender', $user->gender) == 'male' ? 'checked' : '' }}
                                        class="w-4 h-4 text-blue-600"
                                    >
                                    <span class="ml-2">Laki-laki</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input 
                                        type="radio" 
                                        name="gender" 
                                        value="female" 
                                        {{ old('gender', $user->gender) == 'female' ? 'checked' : '' }}
                                        class="w-4 h-4 text-blue-600"
                                    >
                                    <span class="ml-2">Perempuan</span>
                                </label>
                            </div>
                        </div>

                        <!-- Date of Birth -->
                        <div>
                            <label for="date_of_birth" class="block text-gray-700 font-medium mb-2">Tanggal Lahir</label>
                            <input 
                                type="date" 
                                id="date_of_birth" 
                                name="date_of_birth" 
                                value="{{ old('date_of_birth', $user->date_of_birth?->format('Y-m-d')) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            >
                        </div>

                        <!-- Contact Number -->
                        <div>
                            <label for="contact_no" class="block text-gray-700 font-medium mb-2">Nomor Telepon</label>
                            <input 
                                type="text" 
                                id="contact_no" 
                                name="contact_no" 
                                value="{{ old('contact_no', $user->contact_no) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            >
                        </div>

                        <!-- City -->
                        <div>
                            <label for="city" class="block text-gray-700 font-medium mb-2">Kota</label>
                            <input 
                                type="text" 
                                id="city" 
                                name="city" 
                                value="{{ old('city', $user->city) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            >
                        </div>

                        <!-- PayPal ID -->
                        <div class="md:col-span-2">
                            <label for="paypal_id" class="block text-gray-700 font-medium mb-2">PayPal ID</label>
                            <input 
                                type="email" 
                                id="paypal_id" 
                                name="paypal_id" 
                                value="{{ old('paypal_id', $user->paypal_id) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            >
                        </div>

                        <!-- Address -->
                        <div class="md:col-span-2">
                            <label for="address" class="block text-gray-700 font-medium mb-2">Alamat</label>
                            <textarea 
                                id="address" 
                                name="address" 
                                rows="3"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            >{{ old('address', $user->address) }}</textarea>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button 
                            type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition"
                        >
                            Update Profile
                        </button>
                    </div>
                </form>
            </div>

            <!-- Change Password -->
            <div id="change-password" class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Change Password</h2>
                
                <form action="{{ route('profile.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-6">
                        <!-- Current Password -->
                        <div>
                            <label for="current_password" class="block text-gray-700 font-medium mb-2">Current Password *</label>
                            <input 
                                type="password" 
                                id="current_password" 
                                name="current_password" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('current_password') border-red-500 @enderror"
                                required
                            >
                            @error('current_password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div>
                            <label for="password" class="block text-gray-700 font-medium mb-2">New Password *</label>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('password') border-red-500 @enderror"
                                required
                            >
                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-sm text-gray-500 mt-1">Password must be at least 8 characters</p>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-gray-700 font-medium mb-2">Confirm New Password *</label>
                            <input 
                                type="password" 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required
                            >
                        </div>
                    </div>

                    <div class="mt-6">
                        <button 
                            type="submit" 
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold transition"
                        >
                            Change Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection