<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="Sistem Verifikasi TUK - LSP LPK MIK" />

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('images/logo-banner.png') }}">

        <title>@yield('title', 'Verifikasi TUK') - LSP LPK MIK</title>
        @vite('resources/css/app.css')

        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        @stack('styles')

        <style>

            /* Page Transition Styles */
            .page-transition-enter {
                opacity: 0;
                transform: translateY(20px);
            }

            .page-transition-enter-active {
                opacity: 1;
                transform: translateY(0);
                transition: opacity 0.5s ease, transform 0.5s ease;
            }

            .page-transition-exit {
                opacity: 1;
                transform: translateY(0);
            }

            .page-transition-exit-active {
                opacity: 0;
                transform: translateY(-20px);
                transition: opacity 0.3s ease, transform 0.3s ease;
            }

            /* Loading Overlay */
            #page-loader {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(135deg, var(--construction-gray) 0%, var(--caution-black) 100%);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 9999;
                transition: opacity 0.5s ease, visibility 0.5s ease;
            }

            #page-loader::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: repeating-linear-gradient(
                    45deg,
                    transparent,
                    transparent 10px,
                    rgba(255, 107, 53, 0.03) 10px,
                    rgba(255, 107, 53, 0.03) 20px
                );
                pointer-events: none;
            }

            #page-loader.hidden {
                opacity: 0;
                visibility: hidden;
            }

            .loader-content {
                text-align: center;
                color: white;
            }

            .loader-logo {
                width: 120px;
                height: 120px;
                margin-bottom: 20px;
                animation: bounceIn 1s ease-out;
                object-fit: contain;
                background: white;
                padding: 15px;
                border-radius: 20px;
                box-shadow: 0 8px 32px rgba(255, 107, 53, 0.3);
                border: 3px solid var(--safety-orange);
            }

            .construction-loader {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 15px;
                margin-bottom: 20px;
            }

            .construction-loader span {
                font-size: 30px;
                animation: toolDance 2s ease-in-out infinite;
            }

            .construction-loader span:nth-child(1) { animation-delay: 0s; }
            .construction-loader span:nth-child(2) { animation-delay: 0.3s; }
            .construction-loader span:nth-child(3) { animation-delay: 0.6s; }

            .loader-text {
                font-family: 'Bebas Neue', sans-serif;
                font-size: 24px;
                text-transform: uppercase;
                letter-spacing: 2px;
                margin-bottom: 10px;
                background: linear-gradient(45deg, var(--safety-orange), var(--safety-yellow));
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .loader-progress {
                width: 300px;
                height: 6px;
                background: rgba(255, 255, 255, 0.2);
                border-radius: 3px;
                overflow: hidden;
                margin: 0 auto;
            }

            .loader-progress-bar {
                height: 100%;
                background: linear-gradient(90deg, var(--safety-orange), var(--safety-yellow));
                border-radius: 3px;
                animation: loadingProgress 2s ease-in-out infinite;
            }

            @keyframes bounceIn {
                0% { transform: scale(0.3); opacity: 0; }
                50% { transform: scale(1.05); }
                70% { transform: scale(0.9); }
                100% { transform: scale(1); opacity: 1; }
            }

            @keyframes toolDance {
                0%, 100% { transform: translateY(0) rotate(0deg); }
                25% { transform: translateY(-15px) rotate(-10deg); }
                75% { transform: translateY(15px) rotate(10deg); }
            }

            @keyframes loadingProgress {
                0% { width: 0%; left: 0; }
                50% { width: 100%; left: 0; }
                100% { width: 0%; left: 100%; }
            }

            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }

            @keyframes pulse {
                0%, 100% { transform: scale(1); opacity: 1; }
                50% { transform: scale(1.1); opacity: 0.8; }
            }

            /* Smooth scroll behavior */
            html {
                scroll-behavior: smooth;
            }

            /* Link transitions */
            .smooth-link {
                position: relative;
                transition: all 0.3s ease;
            }

            .smooth-link::after {
                content: '';
                position: absolute;
                width: 0;
                height: 2px;
                bottom: -2px;
                left: 50%;
                background-color: currentColor;
                transition: all 0.3s ease;
            }

            .smooth-link:hover::after {
                width: 100%;
                left: 0;
            }

            /* Fade in animation for content */
            .fade-in {
                animation: fadeIn 0.8s ease forwards;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            /* Custom scrollbar styling */
            ::-webkit-scrollbar {
                width: 8px;
                height: 8px;
            }

            ::-webkit-scrollbar-track {
                background: #f1f1f1;
            }

            ::-webkit-scrollbar-thumb {
                background: #1F3A73;
                border-radius: 4px;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: #3F5FA8;
            }

            /* Selection color */
            ::selection {
                background-color: #1F3A73;
                color: white;
            }

            ::-moz-selection {
                background-color: #1F3A73;
                color: white;
            }

        </style>
    </head>
    <body class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100">
        <!-- Modal Loading Component -->
        <div id="loadingModal" class="fixed inset-0 z-50 hidden">
            <div class="fixed inset-0 bg-white bg-opacity-50 backdrop-blur-sm transition-opacity" id="loadingBackdrop"></div>
            <div class="fixed inset-0 flex items-center justify-center p-4">
                <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 overflow-hidden transform transition-all duration-500 ease-out" id="loadingContent">
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

        <!-- Main Content -->
        <div id="app" class="page-transition-enter">
            @yield('content')
        </div>

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
                app.classList.remove('page-transition-enter');
                app.classList.add('page-transition-enter-active');
                loadingModal.hide();
            }, 500);
        });

            // Show loading modal initially
            window.addEventListener('DOMContentLoaded', function() {
                loadingModal.show();

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

                // Add smooth scroll for anchor links
                const anchorLinks = document.querySelectorAll('a[href^="#"]');
                anchorLinks.forEach(anchor => {
                    anchor.addEventListener('click', function (e) {
                        e.preventDefault();
                        const target = document.querySelector(this.getAttribute('href'));
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    });
                });

                // Intersection Observer for fade-in animations
                const observerOptions = {
                    threshold: 0.1,
                    rootMargin: '0px 0px -50px 0px'
                };

                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }
                    });
                }, observerOptions);

                // Observe elements with fade-in class
                document.querySelectorAll('.fade-in').forEach(el => {
                    el.style.opacity = '0';
                    el.style.transform = 'translateY(30px)';
                    el.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
                    observer.observe(el);
                });
            });

            // Handle browser back/forward buttons
            window.addEventListener('pageshow', function(event) {
                if (event.persisted) {
                    // Page is being restored from cache
                    loadingModal.hide();
                }
            });

            // Prevent FOUC (Flash of Unstyled Content)
            document.documentElement.classList.add('js');
        </script>

        @stack('scripts')
    </body>
</html>