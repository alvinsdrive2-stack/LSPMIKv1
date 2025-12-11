<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Dashboard' }} - LSP LPK MIK</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo-banner.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite('resources/css/app.css')

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Dark Mode Page Transition Styles */
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

        /* Loading Overlay - Dark */
        #page-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #1F3A73 0%, #0F1A36 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease, visibility 0.5s ease;
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
            animation: pulse 2s infinite;
            object-fit: contain;
            background: white;
            padding: 15px;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(31, 58, 115, 0.3);
        }

        .loader-spinner {
            width: 50px;
            height: 50px;
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top: 4px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }

        /* Dark Mode Styles */
        html {
            scroll-behavior: smooth;
        }

        body {
            background: linear-gradient(135deg, #0F1A36 0%, #1F3A73 50%, #0F1A36 100%);
            min-height: 100vh;
            color: #e5e7eb;
        }

        /* Glass effect for dark mode */
        .glass-dark {
            background: rgba(15, 26, 54, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Header styling */
        .header-dark {
            background: rgba(15, 26, 54, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Navigation links */
        .nav-link-dark {
            color: #d1d5db;
            transition: all 0.3s ease;
        }

        .nav-link-dark:hover {
            color: #60a5fa;
        }

        /* Form styling */
        .form-input-dark {
            background: rgba(31, 58, 115, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #e5e7eb;
            transition: all 0.3s ease;
        }

        .form-input-dark:focus {
            background: rgba(31, 58, 115, 0.5);
            border-color: #3F5FA8;
            color: white;
            box-shadow: 0 0 0 3px rgba(63, 95, 168, 0.2);
        }

        /* Button styling */
        .btn-primary-dark {
            background: linear-gradient(135deg, #1F3A73 0%, #3F5FA8 100%);
            color: white;
            transition: all 0.3s ease;
        }

        .btn-primary-dark:hover {
            background: linear-gradient(135deg, #2a4a8a 0%, #4a6fb8 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(31, 58, 115, 0.3);
        }

        /* Table styling for dark mode */
        .dataTables_wrapper {
            background: rgba(15, 26, 54, 0.5);
            border-radius: 8px;
            padding: 20px;
        }

        table.dataTable {
            color: #e5e7eb;
        }

        table.dataTable thead th {
            background: rgba(31, 58, 115, 0.5);
            color: white;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        table.dataTable tbody tr {
            background: rgba(31, 58, 115, 0.1);
        }

        table.dataTable tbody tr:nth-child(even) {
            background: rgba(31, 58, 115, 0.05);
        }

        table.dataTable tbody tr:hover {
            background: rgba(31, 58, 115, 0.2);
        }

        /* DataTables pagination dark mode */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: #60a5fa !important;
            background: rgba(31, 58, 115, 0.3) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: rgba(31, 58, 115, 0.5) !important;
            color: white !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: linear-gradient(135deg, #1F3A73 0%, #3F5FA8 100%) !important;
            color: white !important;
        }

        /* Search input dark mode */
        .dataTables_wrapper .dataTables_filter input {
            background: rgba(31, 58, 115, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #e5e7eb;
            border-radius: 4px;
            padding: 8px 12px;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            background: rgba(31, 58, 115, 0.5);
            border-color: #3F5FA8;
            outline: none;
            box-shadow: 0 0 0 3px rgba(63, 95, 168, 0.2);
        }

        /* Success message dark mode */
        .success-dark {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #10b981;
        }

        /* Card styling */
        .card-dark {
            background: rgba(31, 58, 115, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 24px;
            transition: all 0.3s ease;
        }

        .card-dark:hover {
            background: rgba(31, 58, 115, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(31, 58, 115, 0.2);
        }

        /* Select dropdown dark mode */
        .form-select-dark {
            background: rgba(31, 58, 115, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #e5e7eb;
            transition: all 0.3s ease;
        }

        .form-select-dark:focus {
            background: rgba(31, 58, 115, 0.5);
            border-color: #3F5FA8;
            color: white;
            box-shadow: 0 0 0 3px rgba(63, 95, 168, 0.2);
        }

        /* Footer dark mode */
        .footer-dark {
            background: rgba(15, 26, 54, 0.95);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Text color utilities */
        .text-primary-dark {
            color: #60a5fa;
        }

        .text-muted-dark {
            color: #9ca3af;
        }

        /* Badge dark mode */
        .badge-dark {
            background: rgba(31, 58, 115, 0.5);
            color: #e5e7eb;
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
        }
    </style>
</head>

<body class="font-sans antialiased">
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

    <!-- Main Content Wrapper -->
    <div id="app" class="page-transition-enter">
    <!-- Background Pattern -->
    <div class="fixed inset-0 opacity-5 pointer-events-none">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%231F3A73\" fill-opacity=\"0.4\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>

    <!-- Navigation Header -->
    <header class="header-dark sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-white rounded-lg p-1.5 border border-white/20 shadow-lg">
                            <img src="/images/logo-banner.png" alt="LSP LPK MIK" class="w-full h-full object-contain">
                        </div>
                        <div class="ml-3">
                            <h1 class="text-xl font-bold text-white">{{ $pageTitle ?? 'Dashboard' }}</h1>
                            <p class="text-xs text-gray-300">Lembaga Sertifikasi Profesi LPK MIK</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <!-- Navigation -->
                    <nav class="hidden md:flex space-x-6">
                        <a href="/verification" class="nav-link-dark font-medium flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Verifikasi
                        </a>
                        <a href="/sewaktu" class="nav-link-dark font-medium flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            TUK Sewaktu
                        </a>
                        <a href="/mandiri" class="nav-link-dark font-medium flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            TUK Mandiri
                        </a>
                        <a href="/archive" class="nav-link-dark font-medium flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z"/>
                            </svg>
                            Arsip
                        </a>
                        <a href="/confirm" class="nav-link-dark font-medium flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Konfirmasi
                        </a>
                    </nav>

                    <!-- User Menu -->
                    <div class="flex items-center space-x-3">
                        @if(auth()->check())
                            <div class="text-right">
                                <p class="text-sm font-medium text-white">Halo, {{ auth()->user()->name }}</p>
                                @php
                                    $role = auth()->user()->role ?? 'User';
                                    $words = explode(' ', $role);

                                    // Capitalize each word, except if word is 'lsp'
                                    $words = array_map(function($w) {
                                        return strtolower($w) === 'lsp' ? 'LSP' : ucfirst(strtolower($w));
                                    }, $words);

                                    // Join back
                                    $roleFormatted = implode(' ', $words);
                                @endphp

                                <span class="text-gray-300 text-sm font-medium">
                                    {{ $roleFormatted }}
                                </span>
                            </div>
                            <a href="{{ route('logout') }}"
                               class="flex items-center space-x-2 px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white rounded-lg transition-all duration-200 transform hover:scale-105 shadow-md hover:shadow-lg">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                <span class="font-medium">Logout</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Success Message -->
    @if (session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="success-dark px-6 py-4 rounded-xl flex items-center animate-slideDown">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="font-medium">{!! session('success') !!}</p>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 relative">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-dark mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="text-center md:text-left">
                    <p class="text-sm text-gray-300">© 2024 LSP LPK MIK</p>
                    <p class="text-xs text-gray-400">Sistem Verifikasi TUK v1.0.0</p>
                </div>
                <div class="flex items-center space-x-2 mt-4 md:mt-0">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <span class="text-sm text-gray-300">System Online</span>
                </div>
            </div>
        </div>
    </footer>

    </div> <!-- End of app div -->

    <!-- jQuery & DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.js"></script>

    <!-- Custom JavaScript -->
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

        // Smooth navigation for all internal links
        document.addEventListener('DOMContentLoaded', function() {
            // Show loading modal initially
            loadingModal.show();

            // Animate elements on load
            const elements = document.querySelectorAll('.animate-fade-in, .animate-slide-in');
            elements.forEach((el, index) => {
                setTimeout(() => {
                    el.style.opacity = '0';
                    el.style.transform = 'translateY(20px)';
                    el.style.transition = 'all 0.6s ease-out';

                    setTimeout(() => {
                        el.style.opacity = '1';
                        el.style.transform = 'translateY(0)';
                    }, 100);
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

        // Enhanced DataTable styling
        $(document).ready(function() {
            if (typeof $.fn.DataTable !== 'undefined') {
                $.extend(true, $.fn.dataTable.defaults, {
                    language: {
                        search: "Cari:",
                        lengthMenu: "Tampilkan _MENU_ data per halaman",
                        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                        paginate: {
                            first: "Pertama",
                            last: "Terakhir",
                            next: "Selanjutnya",
                            previous: "Sebelumnya"
                        },
                        emptyTable: "Tidak ada data tersedia",
                        zeroRecords: "Tidak ditemukan data yang cocok"
                    },
                    pageLength: 10,
                    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Semua"]]
                });
            }
        });
    </script>

    @yield('scripts')
</body>
</html>