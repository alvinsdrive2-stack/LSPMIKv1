@extends('layouts.auth')

@section('title', 'Login Validator')

@section('roleBadge')
    <div class="inline-flex items-center px-6 py-3 bg-white/10 backdrop-blur rounded-full border border-white/20">
        <svg class="w-6 h-6 text-amber-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <span class="text-white font-semibold">Validator</span>
    </div>
@endsection

@section('content')
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-white mb-2">Login Validator</h2>
        <p class="text-blue-200">Masuk untuk validasi sertifikasi</p>
    </div>

    @if(session('error') || $errors->any())
        <div class="alert-error bg-red-500/20 border border-red-500/50 text-red-100 px-4 py-3 rounded-lg mb-6 slide-in-delay-1 {{ session('blocked') ? 'animate-pulse' : 'shake-animation' }}" id="alertBox">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    @if(session('blocked'))
                        <svg class="w-6 h-6 mr-3 flex-shrink-0 animate-spin-slow" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                    @else
                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    @endif
                    <div>
                        <p class="font-medium text-lg">
                            @if(session('blocked'))
                                Akun Diblokir Sementara
                            @else
                                Login Gagal!
                            @endif
                        </p>
                        <p class="text-sm mt-1">{{ session('error') }}</p>

                        @if(session('attempts') && session('max_attempts'))
                            <div class="mt-3">
                                <div class="flex items-center space-x-2">
                                    <span class="text-xs">Percobaan tersisa:</span>
                                    <div class="flex space-x-1">
                                        @for($i = 1; $i <= session('max_attempts'); $i++)
                                            @if($i <= session('attempts'))
                                                <span class="w-2 h-2 bg-red-400 rounded-full"></span>
                                            @else
                                                <span class="w-2 h-2 bg-white/30 rounded-full"></span>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="text-xs font-bold">{{ session('max_attempts') - session('attempts') }}/{{ session('max_attempts') }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                @if(session('blocked') && session('remaining_time'))
                    <div class="text-right ml-4">
                        <div class="text-xs text-red-200">Coba lagi dalam:</div>
                        <div id="countdown" class="text-2xl font-bold font-mono" data-time="{{ session('remaining_time') }}">
                            {{ session('remaining_time') }}s
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST" class="space-y-6 slide-in-delay-2" id="loginForm">
        @csrf

        <!-- Email Field -->
        <div>
            <label for="email" class="block text-sm font-medium text-blue-100 mb-2">
                Email Address
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <input
                    id="email"
                    name="email"
                    type="email"
                    autocomplete="email"
                    required
                    class="custom-input w-full pl-10 pr-3 py-3 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none"
                    placeholder="Email"
                    value="{{ old('email') }}"
                >
            </div>
            @error('email')
                <p class="mt-2 text-sm text-red-200">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password Field -->
        <div>
            <label for="password" class="block text-sm font-medium text-blue-100 mb-2">
                Password
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <input
                    id="password"
                    name="password"
                    type="password"
                    autocomplete="current-password"
                    required
                    class="custom-input w-full pl-10 pr-10 py-3 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none"
                    placeholder="Password"
                >
                <button
                    type="button"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center"
                    onclick="togglePassword('password')"
                >
                    <svg id="password-toggle" class="h-5 w-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </button>
            </div>
            @error('password')
                <p class="mt-2 text-sm text-red-200">{{ $message }}</p>
            @enderror
        </div>

        

        <!-- Submit Button -->
        <button type="submit" id="submitBtn" class="btn-primary w-full py-3 px-4 rounded-lg text-white font-semibold text-lg flex items-center justify-center transition-all duration-300">
            <span id="btnText">Login</span>
            <svg id="btnIcon" class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
        </button>
    </form>

    <!-- Additional Info -->
    <div class="mt-8 text-center slide-in-delay-3">
        <p class="text-blue-200 text-sm">
            Butuh bantuan? Hubungi Koordinator Validator
        </p>
        <a href="mailto:validator@lsp-gataksindo.com" class="text-white hover:text-blue-200 transition-colors text-sm font-medium">
            validator@lsp-gataksindo.com
        </a>
    </div>

    <script>
        // Check if user is blocked
        let countdownTimer;
        const blockedAlert = document.querySelector('.animate-pulse');
        const countdownEl = document.getElementById('countdown');
        const loginForm = document.getElementById('loginForm');
        const submitBtn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');
        const btnIcon = document.getElementById('btnIcon');

        if (blockedAlert && countdownEl) {
            let timeLeft = parseInt(countdownEl.dataset.time);

            // Disable form inputs
            const inputs = loginForm.querySelectorAll('input');
            inputs.forEach(input => input.disabled = true);

            // Disable submit button
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
            btnText.textContent = 'Diblokir';
            btnIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            `;

            countdownTimer = setInterval(() => {
                timeLeft--;
                countdownEl.textContent = timeLeft + 's';

                if (timeLeft <= 0) {
                    clearInterval(countdownTimer);
                    window.location.reload();
                }
            }, 1000);
        }

        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const toggle = document.getElementById(inputId + '-toggle');

            if (input.type === 'password') {
                input.type = 'text';
                toggle.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                `;
            } else {
                input.type = 'password';
                toggle.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                `;
            }
        }
    </script>
@endsection