@extends('layouts.app')

@section('title', 'Beranda - LSP LPK MIK')

@section('content')
    <style>
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

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .animate-slide-in-left {
            animation: slideInLeft 0.8s ease-out forwards;
        }

        .animate-slide-in-right {
            animation: slideInRight 0.8s ease-out forwards;
        }

        .animate-delay-100 { animation-delay: 0.1s; opacity: 0; animation-fill-mode: forwards; }
        .animate-delay-200 { animation-delay: 0.2s; opacity: 0; animation-fill-mode: forwards; }
        .animate-delay-300 { animation-delay: 0.3s; opacity: 0; animation-fill-mode: forwards; }
        .animate-delay-400 { animation-delay: 0.4s; opacity: 0; animation-fill-mode: forwards; }
        .animate-delay-500 { animation-delay: 0.5s; opacity: 0; animation-fill-mode: forwards; }
        .animate-delay-600 { animation-delay: 0.6s; opacity: 0; animation-fill-mode: forwards; }

        /* Skip to main content link for accessibility */
        .skip-link {
            position: absolute;
            top: -40px;
            left: 6px;
            background: rgb(var(--p));
            color: white;
            padding: 8px;
            text-decoration: none;
            border-radius: 4px;
            z-index: 100;
            transition: top 0.3s;
        }

        .skip-link:focus {
            top: 6px;
        }

        /* Glass morphism card styles */
        .role-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .role-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.6s;
        }

        .role-card:hover::before {
            left: 100%;
        }

        .role-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(31, 58, 115, 0.3);
        }

        /* Icon hover effects */
        .icon-wrapper {
            transition: all 0.3s ease;
        }

        .role-card:hover .icon-wrapper {
            transform: scale(1.1) rotate(5deg);
        }

        .pulse-glow {
            animation: pulseGlow 2s ease-in-out infinite;
        }

        @keyframes pulseGlow {
            0%, 100% {
                box-shadow: 0 0 20px rgba(255, 107, 53, 0.4);
            }
            50% {
                box-shadow: 0 0 40px rgba(255, 107, 53, 0.6);
            }
        }

        .rotate-slow {
            animation: rotateSlow 8s linear infinite;
        }

        @keyframes rotateSlow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .bounce-in {
            animation: bounceIn 0.6s ease-out;
        }

        @keyframes bounceIn {
            0% { transform: scale(0.3); opacity: 0; }
            50% { transform: scale(1.05); }
            70% { transform: scale(0.9); }
            100% { transform: scale(1); opacity: 1; }
        }
/* Container */
.police-line-container {
    position: relative;
    height: 7px;
    background: #374151;
    overflow: hidden;
    width: 40%;
    margin: 0 auto;
    border-radius: 4px;
}

/* Police line berjalan */
.police-line {
    position: absolute;
    top: 0;
    left: 0;
    width: 200%;
    height: 100%;
    
    background: repeating-linear-gradient(
        90deg,
        #000000 0px,
        #000000 20px,
        #FFD700 20px,
        #FFD700 40px
    );

    animation: policeLineMove 1.2s linear infinite;
}

/* Gerakin background-nya biar jalan terus */
@keyframes policeLineMove {
    0% {
        background-position: 0 0;
    }
    100% {
        background-position: -40px 0;
    }
}


        /* Reduced motion support */
        @media (prefers-reduced-motion: reduce) {
            .animate-fade-in,
            .animate-fade-in-up,
            .animate-slide-in-left,
            .animate-slide-in-right,
            .role-card,
            .role-card::before {
                animation: none !important;
                transition: none !important;
            }
        }

        /* Compact design adjustments */
        .compact-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .hero-compact {
            padding: 3rem 0;
        }

        .grid-compact {
            gap: 1.5rem;
        }

        .card-compact {
            padding: 1.5rem;
        }

        /* Footer adjustments */
        .footer-compact {
            padding: 1.5rem 0;
        }
    </style>

    <!-- Skip to main content link for accessibility -->
    <a href="#main-content" class="skip-link">Skip to main content</a>

    <!-- Hero Section -->
    <section class="min-h-[70vh] flex items-center bg-gradient-to-br from-slate-50 via-white to-blue-50 relative overflow-hidden" role="banner">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5" aria-hidden="true">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%231F3A73" fill-opacity="0.4"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>

        <div class="compact-container w-full">
            <div class="flex items-center">
                <!-- Left Content - Logo (40%) -->
                <div class="w-[40%] flex items-center justify-center animate-fade-in">
                    <div class="relative">
                        <div class="absolute inset-0 animate-pulse"></div>
                        <img
                            src="/images/logo-banner.png"
                            alt="LSP LPK MIK Logo"
                            class="relative w-72 h-72 lg:w-78 lg:h-78 object-contain animate-bounce-slow"
                            loading="eager"
                            style=""
                        />
                    </div>
                </div>

                <!-- Right Content - Text (60%) -->
                <div class="w-[60%] text-left pl-8 lg:pl-12 animate-fade-in">
                    <h1 class="text-4xl lg:text-6xl font-black text-gray-900 mb-4 animate-slide-in-right" style="animation-delay: 0.1s;">
                        SELAMAT DATANG
                    </h1>
                    <h2 class="text-3xl lg:text-4xl font-bold text-[#1F3A73] mb-6 animate-slide-in-right" style="animation-delay: 0.2s;">
                        SISTEM VERIFIKASI TUK
                    </h2>
                    <p class="text-lg lg:text-xl text-gray-600 max-w-2xl animate-slide-in-right" style="animation-delay: 0.3s;">
                        Lembaga Sertifikasi Profesi LPK MIK
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Login Options Section -->
    <main id="main-content" class="py-16 lg:py-20 bg-gradient-to-br from-gray-900 to-gray-800 relative overflow-hidden" role="main">
        <!-- Background decorative elements -->
        <div class="absolute inset-0 opacity-10" aria-hidden="true">
            <div class="absolute top-10 left-10 w-32 h-32 bg-[#FF6B35] rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-48 h-48 bg-[#FFD23F] rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 left-1/4 w-40 h-40 bg-[#4A90E2] rounded-full blur-3xl"></div>
        </div>

        <div class="compact-container relative z-10">
            <div class="text-center mb-12 animate-fade-in-up">
                <h1 class="text-3xl lg:text-4xl font-black text-white mb-6">
                    PILIH PERAN ANDA
                </h1>
                <!-- Police Line Effect -->
                <div class="police-line-container w-full">
                    <div class="police-line"></div>
                </div>
            </div>

            <!-- Role Cards Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 md:gap-6 grid-compact" role="list" aria-label="User role selection">
                <!-- Admin LSP -->
                <div class="animate-fade-in-up animate-delay-100" role="listitem">
                    <a href="/login"
                       class="group block h-full"
                       aria-label="Login sebagai Admin LSP">
                        <div class="role-card rounded-2xl p-6 h-full flex flex-col items-center justify-center text-center cursor-pointer card-compact">
                            <div class="icon-wrapper mb-4 relative">
                                <div class="w-16 h-16 bg-gradient-to-br from-[#4A90E2] to-[#2E86AB] rounded-xl flex items-center justify-center shadow-lg">
                                    <i class="fas fa-user-shield text-2xl text-white"></i>
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-1">Admin LSP</h3>
                            <p class="text-xs text-gray-600 mb-3">Manajemen Sistem</p>
                            <div class="flex items-center justify-center text-[#4A90E2] text-sm font-medium group-hover:text-[#2E86AB]">
                                <span>Masuk</span>
                                <i class="fas fa-arrow-right ml-1 text-xs"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Direktur LSP -->
                <div class="animate-fade-in-up animate-delay-200" role="listitem">
                    <a href="/login"
                       class="group block h-full"
                       aria-label="Login sebagai Direktur LSP">
                        <div class="role-card rounded-2xl p-6 h-full flex flex-col items-center justify-center text-center cursor-pointer card-compact">
                            <div class="icon-wrapper mb-4 pulse-glow">
                                <div class="w-16 h-16 bg-gradient-to-br from-[#FF6B35] to-[#FF9F1A] rounded-xl flex items-center justify-center shadow-lg">
                                    <i class="fas fa-award text-2xl text-white"></i>
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-1">Direktur LSP</h3>
                            <p class="text-xs text-gray-600 mb-3">Approval Sertifikasi</p>
                            <div class="flex items-center justify-center text-[#FF6B35] text-sm font-medium group-hover:text-[#FF9F1A]">
                                <span>Masuk</span>
                                <i class="fas fa-arrow-right ml-1 text-xs"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Verifikator -->
                <div class="animate-fade-in-up animate-delay-300" role="listitem">
                    <a href="/login"
                       class="group block h-full"
                       aria-label="Login sebagai Verifikator">
                        <div class="role-card rounded-2xl p-6 h-full flex flex-col items-center justify-center text-center cursor-pointer card-compact">
                            <div class="icon-wrapper mb-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-[#FFC312] to-[#FFD23F] rounded-xl flex items-center justify-center shadow-lg hover-glow">
                                    <i class="fas fa-check-circle text-2xl text-white"></i>
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-1">Verifikator</h3>
                            <p class="text-xs text-gray-600 mb-3">Proses Verifikasi</p>
                            <div class="flex items-center justify-center text-[#FFC312] text-sm font-medium group-hover:text-[#FFD23F]">
                                <span>Masuk</span>
                                <i class="fas fa-arrow-right ml-1 text-xs"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Ketua TUK -->
                <div class="animate-fade-in-up animate-delay-400" role="listitem">
                    <a href="/login"
                       class="group block h-full"
                       aria-label="Login sebagai Ketua TUK">
                        <div class="role-card rounded-2xl p-6 h-full flex flex-col items-center justify-center text-center cursor-pointer card-compact">
                            <div class="icon-wrapper mb-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <i class="fas fa-building text-2xl text-white"></i>
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-1">Ketua TUK</h3>
                            <p class="text-xs text-gray-600 mb-3">Manajemen TUK</p>
                            <div class="flex items-center justify-center text-purple-600 text-sm font-medium group-hover:text-purple-700">
                                <span>Masuk</span>
                                <i class="fas fa-arrow-right ml-1 text-xs"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Validator -->
                <div class="animate-fade-in-up animate-delay-500" role="listitem">
                    <a href="/login"
                       class="group block h-full"
                       aria-label="Login sebagai Validator">
                        <div class="role-card rounded-2xl p-6 h-full flex flex-col items-center justify-center text-center cursor-pointer card-compact">
                            <div class="icon-wrapper mb-4 bounce-in">
                                <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-orange-500 rounded-xl flex items-center justify-center shadow-lg">
                                    <i class="fas fa-clipboard-check text-2xl text-white"></i>
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-1">Validator</h3>
                            <p class="text-xs text-gray-600 mb-3">Validasi Sertifikasi</p>
                            <div class="flex items-center justify-center text-amber-600 text-sm font-medium group-hover:text-amber-700">
                                <span>Masuk</span>
                                <i class="fas fa-arrow-right ml-1 text-xs"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Archive -->
                <div class="animate-fade-in-up animate-delay-600" role="listitem">
                    <a href="/archive"
                       class="group block h-full"
                       aria-label="Buka Archive">
                        <div class="role-card rounded-2xl p-6 h-full flex flex-col items-center justify-center text-center cursor-pointer card-compact">
                            <div class="icon-wrapper mb-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <i class="fas fa-archive text-2xl text-white"></i>
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-1">Archive</h3>
                            <p class="text-xs text-gray-600 mb-3">Surat Verifikasi</p>
                            <div class="flex items-center justify-center text-indigo-600 text-sm font-medium group-hover:text-indigo-700">
                                <span>Buka</span>
                                <i class="fas fa-arrow-right ml-1 text-xs"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white footer-compact relative overflow-hidden" role="contentinfo">
        <!-- Background pattern -->
        <div class="absolute inset-0 opacity-5" aria-hidden="true">
            <div class="construction-loader">
                <i class="fas fa-tools absolute text-[#FFD23F]" style="top: 30%; left: 10%; font-size: 24px;"></i>
                <i class="fas fa-exclamation-triangle absolute text-[#FF6B35]" style="top: 60%; right: 15%; font-size: 20px;"></i>
                <i class="fas fa-cog absolute text-[#FFD23F]" style="bottom: 30%; left: 20%; font-size: 22px;"></i>
            </div>
        </div>

        <div class="compact-container relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <div class="text-center md:text-left">
                    <p class="text-lg font-bold text-[#ffbf35] mb-1">© 2024 LSP LPK MIK</p>
                    <p class="text-sm text-gray-400">Lembaga Sertifikasi Profesi Konstruksi</p>
                </div>
                <div class="flex items-center space-x-6">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-hard-hat text-xl text-[#FFD23F] animate-bounce-slow"></i>
                        <span class="text-sm text-gray-400">v1.0.0</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                        <span class="text-sm text-gray-400">System Online</span>
                    </div>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-800 text-center">
                <p class="text-xs text-gray-500">
                    <i class="fas fa-hammer text-[#FFD23F] mr-1"></i>
                    Membangun Indonesia yang Kompeten dan Profesional
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Keyboard navigation support
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Tab') {
                document.body.classList.add('keyboard-nav');
            }
        });

        document.addEventListener('mousedown', function() {
            document.body.classList.remove('keyboard-nav');
        });

        // Add focus styles for keyboard navigation
        const style = document.createElement('style');
        style.textContent = `
            .keyboard-nav *:focus {
                outline: 2px solid rgb(var(--p));
                outline-offset: 2px;
            }
        `;
        document.head.appendChild(style);

        // Add entrance animations to elements
        window.addEventListener('DOMContentLoaded', function() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                    }
                });
            }, { threshold: 0.1 });

            // Observe all animated elements
            document.querySelectorAll('[class*="animate-"]').forEach(el => {
                if (el.style.opacity === '0') {
                    observer.observe(el);
                }
            });
        });
    </script>
@endsection