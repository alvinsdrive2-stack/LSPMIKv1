@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="text-center mb-8">
        <h2 class="text-4xl font-bold bg-gradient-to-r from-gray-900 via-gray-700 to-gray-900 bg-clip-text text-transparent mb-3">Selamat Datang Kembali</h2>
        <p class="text-gray-600 text-lg">Masuk ke akun Anda untuk melanjutkan</p>
    </div>

    <form action="{{ route('login') }}" method="POST" class="space-y-5" id="loginForm">
        @csrf

        <!-- Email Field -->
        <div class="space-y-2">
            <label for="email" class="block text-sm font-semibold text-gray-700">
                <i class="fas fa-envelope text-gray-400 mr-2"></i>Email Address
            </label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fas fa-at text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                </div>
                <input
                    id="email"
                    name="email"
                    type="email"
                    autocomplete="email"
                    required
                    class="w-full pl-12 pr-4 py-4 bg-gray-50 border-2 border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 autofill:bg-white"
                    placeholder="nama@email.com"
                    value="{{ old('email') }}"
                    style="-webkit-appearance: none; appearance: none;"
                >
                <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-blue-500/0 to-purple-500/0 group-focus-within:from-blue-500/5 group-focus-within:to-purple-500/5 pointer-events-none transition-all duration-300"></div>
            </div>
            @error('email')
                <p class="mt-1.5 text-sm text-red-600 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1.5"></i>{{ $message }}
                </p>
            @enderror
        </div>

        <!-- Password Field -->
        <div class="space-y-2">
            <label for="password" class="block text-sm font-semibold text-gray-700">
                <i class="fas fa-lock text-gray-400 mr-2"></i>Password
            </label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fas fa-key text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                </div>
                <input
                    id="password"
                    name="password"
                    type="password"
                    autocomplete="current-password"
                    required
                    class="w-full pl-12 pr-14 py-4 bg-gray-50 border-2 border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 autofill:bg-white"
                    placeholder="Masukkan password Anda"
                    style="-webkit-appearance: none; appearance: none;"
                >
                <button
                    type="button"
                    class="absolute inset-y-0 right-0 pr-4 flex items-center group"
                    onclick="togglePassword('password')"
                >
                    <i id="password-toggle" class="fas fa-eye text-gray-400 hover:text-blue-500 group-focus-within:text-blue-500 transition-all duration-200 cursor-pointer"></i>
                </button>
                <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-blue-500/0 to-purple-500/0 group-focus-within:from-blue-500/5 group-focus-within:to-purple-500/5 pointer-events-none transition-all duration-300"></div>
            </div>
            @error('password')
                <p class="mt-1.5 text-sm text-red-600 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1.5"></i>{{ $message }}
                </p>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" id="submitBtn" class="group relative w-full py-4 px-6 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></div>
            <span id="btnText" class="relative flex items-center text-lg">
                <i class="fas fa-sign-in-alt mr-3"></i>
                Masuk
            </span>
        </button>
    </form>

    <!-- Back to Home -->
    <div class="mt-8 text-center">
        <a href="/" class="inline-flex items-center text-gray-500 hover:text-gray-700 transition-colors text-sm group">
            <i class="fas fa-arrow-left w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform duration-200"></i>
            <span class="border-b border-gray-300 group-hover:border-gray-700 transition-colors duration-200">Kembali ke Beranda</span>
        </a>
    </div>

    <!-- Additional Info -->
    <div class="mt-6 p-4 bg-gray-50 rounded-xl">
        <div class="flex items-center justify-center space-x-2 text-gray-500">
            <i class="fas fa-info-circle"></i>
            <p class="text-sm">Butuh bantuan?</p>
        </div>
        <a href="mailto:support@lsp-MIK.com" class="text-blue-600 hover:text-blue-700 transition-colors text-sm font-medium flex items-center justify-center mt-1">
            <i class="fas fa-envelope mr-2"></i>
            support@lsp-MIK.com
        </a>
    </div>

    <style>
        /* Custom autofill styles */
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            -webkit-background-clip: text;
            -webkit-text-fill-color: #111827;
            background-color: white !important;
            background-image: none !important;
            transition: background-color 5000s ease-in-out 0s;
            box-shadow: inset 0 0 0 2px #3b82f6;
            border-radius: 0.75rem;
        }

        input:autofill,
        input:autofill:hover,
        input:autofill:focus,
        input:autofill:active {
            background-color: white !important;
            background-image: none !important;
            transition: background-color 5000s ease-in-out 0s;
            box-shadow: inset 0 0 0 2px #3b82f6;
        }

        /* Chrome/Safari specific dropdown styling */
        input::-webkit-credentials-auto-fill-button,
        input::-webkit-caps-lock-indicator,
        input::-webkit-contacts-auto-fill-button,
        input::-webkit-strong-password-auto-fill-button {
            background-color: #3b82f6;
            color: white;
            border-radius: 0.375rem;
            margin: 0.5rem;
            padding: 0.25rem 0.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        /* Dropdown menu styling */
        input::-webkit-calendar-picker-indicator {
            background-color: #3b82f6;
            color: white;
            border-radius: 0.375rem;
            padding: 0.25rem;
            margin: 0.25rem;
            cursor: pointer;
        }

        /* Loading state animation */
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .loading-state {
            animation: spin 1s linear infinite;
        }
    </style>

    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const toggle = document.getElementById(inputId + '-toggle');

            if (input.type === 'password') {
                input.type = 'text';
                toggle.classList.remove('fa-eye');
                toggle.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                toggle.classList.remove('fa-eye-slash');
                toggle.classList.add('fa-eye');
            }
        }

        // Handle form submission with loading state
        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.getElementById('loginForm');
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');

            if (loginForm) {
                loginForm.addEventListener('submit', function(e) {
                    // Prevent multiple submissions
                    if (submitBtn.disabled) {
                        e.preventDefault();
                        return;
                    }

                    // Disable button and show loading state
                    submitBtn.disabled = true;
                    btnText.innerHTML = `
                        <i class="fas fa-spinner fa-spin mr-3"></i>
                        Masuk...
                    `;
                });
            }
        });
    </script>
@endsection