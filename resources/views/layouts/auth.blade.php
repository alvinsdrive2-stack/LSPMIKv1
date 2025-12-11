<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="Login - Sistem Verifikasi TUK - LSP LPK MIK" />

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('images/logo-banner.png') }}">

        <title>@yield('title', 'Login') - LSP LPK MIK</title>
        @vite('resources/css/app.css')

        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        @stack('styles')

        <style>
            /* Modal loading transitions */
            #loadingContent {
                transform: scale(0.9);
                opacity: 0;
                transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            }

            #loadingBackdrop {
                opacity: 0;
                transition: opacity 0.5s ease;
            }

            /* Page Transition Styles */
            .page-transition-enter {
                opacity: 0;
            }

            .page-transition-enter-active {
                opacity: 1;
                transition: opacity 0.8s ease;
            }

            .page-transition-exit {
                opacity: 1;
            }

            .page-transition-exit-active {
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            /* Background animation */
            @keyframes gradient {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }

            .animated-bg {
                background: linear-gradient(-45deg, #1F3A73, #3F5FA8, #0F1A36, #1F3A73);
                background-size: 400% 400%;
                animation: gradient 15s ease infinite;
            }

            /* Floating shapes animation */
            @keyframes float {
                0%, 100% { transform: translateY(0px) rotate(0deg); }
                33% { transform: translateY(-20px) rotate(120deg); }
                66% { transform: translateY(20px) rotate(240deg); }
            }

            .float-animation {
                animation: float 6s ease-in-out infinite;
            }

            /* Form animations */
            @keyframes slideInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .slide-in-up {
                animation: slideInUp 0.6s ease-out forwards;
            }

            .slide-in-delay-1 { animation-delay: 0.1s; opacity: 0; animation-fill-mode: forwards; }
            .slide-in-delay-2 { animation-delay: 0.2s; opacity: 0; animation-fill-mode: forwards; }
            .slide-in-delay-3 { animation-delay: 0.3s; opacity: 0; animation-fill-mode: forwards; }
            .slide-in-delay-4 { animation-delay: 0.4s; opacity: 0; animation-fill-mode: forwards; }

            /* Glassmorphism effect */
            .glass {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                box-shadow: 0 8px 32px 0 rgba(31, 58, 115, 0.37);
            }

            /* Custom input styles */
            .custom-input {
                background: rgba(255, 255, 255, 0.9);
                border: 2px solid transparent;
                transition: all 0.3s ease;
            }

            .custom-input:focus {
                background: white;
                border-color: #1F3A73;
                box-shadow: 0 0 0 4px rgba(31, 58, 115, 0.1);
            }

            /* Button animations */
            .btn-primary {
                background: linear-gradient(135deg, #1F3A73 0%, #3F5FA8 100%);
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }

            .btn-primary::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
                transition: left 0.5s;
            }

            .btn-primary:hover::before {
                left: 100%;
            }

            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 20px rgba(31, 58, 115, 0.3);
            }

            /* Role badge animations */
            .role-badge {
                animation: slideInUp 0.6s ease-out forwards;
                animation-delay: 0.5s;
                opacity: 0;
            }

            /* Back link animation */
            .back-link {
                position: relative;
                transition: all 0.3s ease;
            }

            .back-link::after {
                content: '';
                position: absolute;
                bottom: -2px;
                left: 0;
                width: 0;
                height: 2px;
                background: white;
                transition: width 0.3s ease;
            }

            .back-link:hover::after {
                width: 100%;
            }

            /* Error shake animation */
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
                20%, 40%, 60%, 80% { transform: translateX(5px); }
            }

            .shake {
                animation: shake 0.5s ease-in-out;
            }

            .shake-animation {
                animation: shake 0.5s ease-in-out;
            }

            /* Spin animation for blocked state */
            @keyframes spin-slow {
                from { transform: rotate(0deg); }
                to { transform: rotate(360deg); }
            }

            .animate-spin-slow {
                animation: spin-slow 3s linear infinite;
            }

            /* Smooth scroll behavior */
            html {
                scroll-behavior: smooth;
            }

            /* Auth Page Specific Animations */
            @keyframes fadeIn {
                from {
                    opacity: 0;
                }
                to {
                    opacity: 1;
                }
            }

            @keyframes shimmer {
                0% {
                    background-position: -1000px 0;
                }
                100% {
                    background-position: 1000px 0;
                }
            }

            @keyframes sparkle {
                0%, 100% {
                    opacity: 0;
                    transform: scale(0) rotate(0deg);
                }
                50% {
                    opacity: 1;
                    transform: scale(1) rotate(180deg);
                }
            }

            @keyframes float {
                0%, 100% {
                    transform: translateY(0) translateX(0) rotate(0deg);
                }
                25% {
                    transform: translateY(-20px) translateX(10px) rotate(90deg);
                }
                50% {
                    transform: translateY(10px) translateX(-10px) rotate(180deg);
                }
                75% {
                    transform: translateY(-10px) translateX(20px) rotate(270deg);
                }
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes bounce-slow {
                0%, 20%, 50%, 80%, 100% {
                    transform: translateY(0);
                }
                40% {
                    transform: translateY(-20px);
                }
                60% {
                    transform: translateY(-10px);
                }
            }

            .animate-fade-in {
                animation: fadeIn 0.8s ease-out;
            }

            .animate-fade-in-up {
                animation: fadeInUp 0.8s ease-out;
                animation-delay: 0.2s;
                animation-fill-mode: both;
            }

            .animate-bounce-slow {
                animation: bounce-slow 3s ease-in-out infinite;
            }

            .animate-float {
                animation: float 20s ease-in-out infinite;
            }

            .animate-sparkle {
                animation: sparkle 3s ease-in-out infinite;
            }

            .animate-slideDown {
                animation: slideDown 0.5s ease-out;
            }

            @keyframes slideDown {
                from {
                    transform: translateY(-100%);
                    opacity: 0;
                }
                to {
                    transform: translateY(0);
                    opacity: 1;
                }
            }

            /* Input styles for white form */
            .auth-input {
                background: #f3f4f6;
                border: 2px solid #e5e7eb;
                transition: all 0.3s ease;
            }

            .auth-input:focus {
                background: white;
                border-color: #1F3A73;
                box-shadow: 0 0 0 4px rgba(31, 58, 115, 0.1);
            }

            /* Button styles */
            .auth-btn {
                background: linear-gradient(135deg, #1F3A73 0%, #4A90E2 100%);
                transition: all 0.3s ease;
            }

            .auth-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 25px rgba(31, 58, 115, 0.3);
            }

            @keyframes spin-slow {
                from {
                    transform: translate(-50%, -50%) rotate(0deg);
                }
                to {
                    transform: translate(-50%, -50%) rotate(360deg);
                }
            }

            .animate-spin-slow {
                animation: spin-slow 20s linear infinite;
            }
        </style>
    </head>
    <body class="min-h-screen bg-gradient-to-br from-slate-900 via-gray-900 to-slate-800 relative overflow-hidden">
        <!-- Modal Loading Component -->
        <div id="loadingModal" class="fixed inset-0 z-50">
            <div class="fixed inset-0 bg-white bg-opacity-50 backdrop-blur-sm transition-opacity opacity-100" id="loadingBackdrop"></div>
            <div class="fixed inset-0 flex items-center justify-center p-4">
                <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 overflow-hidden transform transition-all duration-500 ease-out scale-100 opacity-100" id="loadingContent">
                    <div class="bg-gradient-to-r from-[#1F3A73] to-[#4A90E2] p-6">
                        <div class="text-center">
                            <div class="w-32 h-[72px] mx-auto mb-4 bg-white p-3 rounded-lg shadow-xl flex items-center justify-center">
                                <img src="/images/logo-banner.png" alt="Loading..." class="w-full h-full object-contain">
                            </div>
                            <h3 class="text-xl font-bold text-white mb-2">LSP LPK MIK</h3>
                            <p class="text-blue-100 text-sm">Sistem Verifikasi TUK</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="text-center mb-4">
                            <i class="fas fa-spinner fa-spin text-4xl text-[#1F3A73] mb-4"></i>
                            <p class="text-gray-700 font-medium">Sistem Sedang Dimuat...</p>
                            <p class="text-gray-500 text-sm mt-1">Mohon tunggu sebentar</p>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                            <div class="bg-gradient-to-r from-[#1F3A73] to-[#4A90E2] h-full rounded-full transition-all duration-300 ease-out"
                                 id="loadingBar" style="width: 0%"></div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-3 border-t">
                        <div class="flex justify-center space-x-6">
                            <i class="fas fa-hard-hat text-[#FF6B35] text-xl"></i>
                            <i class="fas fa-tools text-[#FFD23F] text-xl"></i>
                            <i class="fas fa-hammer text-[#1F3A73] text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Wrapper -->
        <div id="app" class="page-transition-enter">
        <!-- Floating Notifications Container -->
        <div id="floatingNotifications" class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 space-y-2 pointer-events-none">
            @if(session('error') || $errors->any())
                <div class="bg-white/95 backdrop-blur-md border-l-4 border-red-500 text-red-700 px-6 py-4 rounded-lg shadow-xl flex items-center space-x-4 min-w-[400px] animate-slideDown pointer-events-auto" id="floatingAlert">
                    <div class="flex-shrink-0">
                        @if(session('blocked'))
                            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-lock text-red-600"></i>
                            </div>
                        @else
                            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-exclamation-triangle text-red-600"></i>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <p class="font-bold text-red-800">
                            @if(session('blocked'))
                                Akun Diblokir Sementara
                            @else
                                Login Gagal
                            @endif
                        </p>
                        <p class="text-red-600 text-sm mt-0.5">{{ session('error') }}</p>

                        @if(session('attempts') && session('max_attempts'))
                            <div class="mt-2 flex items-center space-x-2">
                                <span class="text-xs text-red-500">Percobaan tersisa:</span>
                                <div class="flex space-x-1">
                                    @for($i = 1; $i <= session('max_attempts'); $i++)
                                        @if($i <= session('attempts'))
                                            <i class="fas fa-circle text-red-500" style="font-size: 6px;"></i>
                                        @else
                                            <i class="far fa-circle text-red-300" style="font-size: 6px;"></i>
                                        @endif
                                    @endfor
                                </div>
                                <span class="text-xs font-bold text-red-700">{{ session('max_attempts') - session('attempts') }}/{{ session('max_attempts') }}</span>
                            </div>
                        @endif

                        @if(session('blocked') && session('remaining_time'))
                            <div class="mt-2 flex items-center space-x-2">
                                <i class="fas fa-clock text-red-500 text-xs"></i>
                                <span class="text-xs text-red-600">Coba lagi dalam: <span id="countdownFloat" class="font-bold font-mono" data-time="{{ session('remaining_time') }}">{{ session('remaining_time') }}s</span></span>
                            </div>
                        @endif
                    </div>
                    <button onclick="closeAlert()" class="flex-shrink-0 text-red-400 hover:text-red-600 transition-colors">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif
        </div>

        <!-- Premium animated background -->
        <div class="absolute inset-0 overflow-hidden">
            <!-- Shimmer overlay -->
            <div class="absolute inset-0 bg-gradient-to-br from-white/40 via-transparent to-white/20 opacity-30 animate-pulse"></div>

            <!-- Moving light streaks -->
            <div class="absolute inset-0">
                <div class="absolute top-0 -left-48 w-96 h-96 bg-gradient-to-r from-white/20 via-white/40 to-transparent rounded-full blur-3xl animate-float" style="animation-duration: 15s;"></div>
                <div class="absolute bottom-0 -right-48 w-96 h-96 bg-gradient-to-l from-white/20 via-white/40 to-transparent rounded-full blur-3xl animate-float" style="animation-duration: 18s; animation-delay: 3s;"></div>
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-gradient-to-br from-transparent via-white/10 to-transparent rounded-full blur-3xl animate-float" style="animation-duration: 25s;"></div>
            </div>

            <!-- Sparkles -->
            <div class="absolute inset-0 pointer-events-none">
                <!-- Sparkle 1 -->
                <div class="absolute top-10 left-10 w-2 h-2 bg-white rounded-full animate-sparkle" style="animation-delay: 0s; box-shadow: 0 0 20px rgba(255,255,255,0.8);"></div>
                <div class="absolute top-10 left-10 w-1 h-1 bg-white rounded-full animate-sparkle" style="animation-delay: 0.5s; box-shadow: 0 0 15px rgba(255,255,255,0.6);"></div>

                <!-- Sparkle 2 -->
                <div class="absolute top-20 right-20 w-2 h-2 bg-white rounded-full animate-sparkle" style="animation-delay: 1s; box-shadow: 0 0 20px rgba(255,255,255,0.8);"></div>
                <div class="absolute top-20 right-20 w-1 h-1 bg-white rounded-full animate-sparkle" style="animation-delay: 1.5s; box-shadow: 0 0 15px rgba(255,255,255,0.6);"></div>

                <!-- Sparkle 3 -->
                <div class="absolute bottom-20 left-1/4 w-2 h-2 bg-white rounded-full animate-sparkle" style="animation-delay: 2s; box-shadow: 0 0 20px rgba(255,255,255,0.8);"></div>
                <div class="absolute bottom-20 left-1/4 w-1 h-1 bg-white rounded-full animate-sparkle" style="animation-delay: 2.5s; box-shadow: 0 0 15px rgba(255,255,255,0.6);"></div>

                <!-- Sparkle 4 -->
                <div class="absolute bottom-40 right-1/3 w-2 h-2 bg-white rounded-full animate-sparkle" style="animation-delay: 3s; box-shadow: 0 0 20px rgba(255,255,255,0.8);"></div>
                <div class="absolute bottom-40 right-1/3 w-1 h-1 bg-white rounded-full animate-sparkle" style="animation-delay: 3.5s; box-shadow: 0 0 15px rgba(255,255,255,0.6);"></div>

                <!-- Sparkle 5 -->
                <div class="absolute top-1/2 right-10 w-2 h-2 bg-white rounded-full animate-sparkle" style="animation-delay: 4s; box-shadow: 0 0 20px rgba(255,255,255,0.8);"></div>
                <div class="absolute top-1/2 right-10 w-1 h-1 bg-white rounded-full animate-sparkle" style="animation-delay: 4.5s; box-shadow: 0 0 15px rgba(255,255,255,0.6);"></div>
            </div>

            <!-- Shimmer sweep effect -->
            <div class="absolute inset-0 pointer-events-none">
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/30 to-transparent opacity-50 animate-shimmer" style="background-size: 200% 200%; animation-duration: 8s;"></div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="relative z-10 min-h-screen flex items-center justify-center px-4 py-12">
            <div class="relative w-full max-w-6xl">
                <div class="flex flex-col lg:flex-row gap-0 items-stretch min-h-[600px] relative">
                    <!-- Background yang menutupi kiri dan sebagian kanan -->
                    <div class="absolute left-0 top-0 bottom-0 w-[60%] bg-gradient-to-br from-white/95 via-white/90 to-gray-50/95 backdrop-blur-xl rounded-l-3xl shadow-2xl border border-white/20">
                        <!-- Decorative pattern -->
                        <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-blue-500/5 to-transparent"></div>
                        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="40" height="40" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="%23000" fill-opacity="0.02"%3E%3Cpath d="M20 20c0-5.5-4.5-10-10-10s-10 4.5-10 10 4.5 10 10 10 10-4.5 10-10zm10 0c0-5.5-4.5-10-10-10s-10 4.5-10 10 4.5 10 10 10 10-4.5 10-10z"/%3E%3C/g%3E%3C/svg%3E');"></div>
                    </div>

                    <!-- Left Side - Logo and Welcome -->
                    <div class="flex-1 flex items-center justify-center p-12 animate-fade-in relative z-10">
                        <!-- Content di atas background -->
                        <div class="text-center lg:text-left">
                            <div class="mb-12">
                                <div class="relative">
                                    <!-- Premium glow effect untuk logo -->
                                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/20 via-transparent to-purple-500/20 blur-3xl scale-150 rounded-full"></div>
                                    <img
                                        src="/images/logo-banner.png"
                                        alt="LSP LPK MIK Logo"
                                        class="relative w-64 h-[142px] lg:w-80 lg:h-[177px] mx-auto lg:mx-0 object-contain drop-shadow-2xl filter saturate-110"
                                    />
                                </div>
                            </div>
                            <div class="space-y-2">
                                <h1 class="text-4xl lg:text-5xl font-black bg-gradient-to-br from-slate-800 via-gray-800 to-slate-700 bg-clip-text text-transparent">
                                    Selamat Datang
                                </h1>
                                <p class="text-xl lg:text-2xl text-gray-600 font-medium">
                                    Sistem Verifikasi TUK
                                </p>
                                <p class="text-lg text-gray-500">
                                    Lembaga Sertifikasi Profesi LPK MIK
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side - Login Form -->
                    <div class="flex-1 flex items-center justify-center p-12 animate-fade-in-up bg-white rounded-tl-3xl rounded-bl-3xl shadow-2xl relative z-20">
                        <div class="w-full max-w-md">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div> <!-- End of app div -->

        <!-- Scripts -->
        <script>
            // Modal loading management
            const loadingModal = {
                show: function() {
                    const modal = document.getElementById('loadingModal');
                    const backdrop = document.getElementById('loadingBackdrop');
                    const content = document.getElementById('loadingContent');
                    const loadingBar = document.getElementById('loadingBar');

                    modal.classList.remove('hidden');
                    loadingBar.style.width = '0%';

                    // Animate modal appearance
                    setTimeout(() => {
                        backdrop.classList.add('opacity-100');
                        content.classList.add('scale-100', 'opacity-100');
                    }, 10);

                    // Animate progress bar
                    let progress = 0;
                    const interval = setInterval(() => {
                        progress += Math.random() * 30;
                        if (progress > 90) progress = 90;
                        loadingBar.style.width = progress + '%';
                    }, 300);

                    this.progressInterval = interval;
                },

                hide: function() {
                    const modal = document.getElementById('loadingModal');
                    const backdrop = document.getElementById('loadingBackdrop');
                    const content = document.getElementById('loadingContent');
                    const loadingBar = document.getElementById('loadingBar');

                    clearInterval(this.progressInterval);
                    loadingBar.style.width = '100%';

                    setTimeout(() => {
                        // Animate modal sliding down and fading out
                        content.style.transform = 'translateY(100px) scale(0.95)';
                        content.style.opacity = '0';
                        backdrop.classList.remove('opacity-100');

                        setTimeout(() => {
                            modal.classList.add('hidden');
                            loadingBar.style.width = '0%';
                            // Reset transform for next show
                            content.style.transform = '';
                            content.style.opacity = '';
                        }, 500);
                    }, 200);
                }
            };

            window.addEventListener('load', function() {
                // Hide loading modal after page loads
                setTimeout(() => {
                    const app = document.getElementById('app');
                    loadingModal.hide();

                    // Start content animation after modal hide animation starts
                    setTimeout(() => {
                        app.classList.remove('page-transition-enter');
                        app.classList.add('page-transition-enter-active');
                    }, 100);
                }, 500);
            });

            // Show loading modal initially
            window.addEventListener('DOMContentLoaded', function() {
                loadingModal.show();

                // Auto-hide floating alert after 10 seconds
                const floatingAlert = document.getElementById('floatingAlert');
                if (floatingAlert) {
                    setTimeout(() => {
                        closeAlert();
                    }, 10000);
                }

                // Handle countdown for floating alert
                const countdownFloat = document.getElementById('countdownFloat');
                if (countdownFloat) {
                    let timeLeft = parseInt(countdownFloat.dataset.time);
                    const countdownInterval = setInterval(() => {
                        timeLeft--;
                        countdownFloat.textContent = timeLeft + 's';
                        if (timeLeft <= 0) {
                            clearInterval(countdownInterval);
                            window.location.reload();
                        }
                    }, 1000);
                }

                // Add entrance animations
                const elements = document.querySelectorAll('.slide-in-up, .slide-in-delay-1, .slide-in-delay-2, .slide-in-delay-3, .slide-in-delay-4');
                elements.forEach((el, index) => {
                    setTimeout(() => {
                        el.style.opacity = '1';
                    }, index * 100);
                });

                // Add loading state to all internal links
                const internalLinks = document.querySelectorAll('a[href^="/"]:not([target="_blank"]):not([data-no-transition])');

                internalLinks.forEach(link => {
                    link.addEventListener('click', function(e) {
                        const href = this.getAttribute('href');

                        // Skip if it's a hash link or current page
                        if (href.startsWith('#') || href === window.location.pathname) {
                            return;
                        }

                        e.preventDefault();

                        // Show loading modal with transition
                        const app = document.getElementById('app');
                        app.classList.remove('page-transition-enter-active');
                        app.classList.add('page-transition-exit-active');

                        setTimeout(() => {
                            loadingModal.show();
                            // Navigate to new page
                            window.location.href = href;
                        }, 300);
                    });
                });

                // Handle form submission with loading state
                const forms = document.querySelectorAll('form');
                forms.forEach(form => {
                    form.addEventListener('submit', function(e) {
                        const submitBtn = this.querySelector('button[type="submit"]');
                        if (submitBtn) {
                            submitBtn.disabled = true;
                            submitBtn.innerHTML = `
                                <span class="inline-flex items-center">
                                    <i class="fas fa-spinner fa-spin -ml-1 mr-3 h-5 w-5 text-white"></i>
                                    Memproses...
                                </span>
                            `;
                        }
                    });
                });

                // Add shake animation to error messages
                const errorAlerts = document.querySelectorAll('.alert-error');
                errorAlerts.forEach(alert => {
                    alert.classList.add('shake');
                    setTimeout(() => {
                        alert.classList.remove('shake');
                    }, 500);
                });
            });

            // Handle browser back/forward buttons
            window.addEventListener('pageshow', function(event) {
                if (event.persisted) {
                    // Page is being restored from cache
                    loadingModal.hide();
                }
            });

            // Close floating alert function
            function closeAlert() {
                const floatingAlert = document.getElementById('floatingAlert');
                if (floatingAlert) {
                    floatingAlert.style.transform = 'translateY(-100%)';
                    floatingAlert.style.opacity = '0';
                    floatingAlert.style.transition = 'all 0.3s ease-out';
                    setTimeout(() => {
                        floatingAlert.remove();
                    }, 300);
                }
            }

            // Prevent FOUC (Flash of Unstyled Content)
            document.documentElement.classList.add('js');
        </script>
    </body>
</html>