@extends('layouts.dashboard')

@section('title', 'Verifikasi TUK')

@section('pageTitle', 'Daftar Verifikasi TUK - Verifikator')

@section('content')
    <style>
        /* Animations from sewaktu.blade.php */
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

        /* Glass morphism effect like sewaktu.blade.php */
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .glass-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .glass-card:hover::before {
            left: 100%;
        }

        .glass-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Success message styling */
        .success-alert {
            background: rgba(16, 185, 129, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(16, 185, 129, 0.3);
        }
        /* DataTables Search Box Styling */
.dataTables_wrapper .dataTables_filter {
    float: right;
    text-align: right;
    margin-bottom: 1rem;
}

.dataTables_wrapper .dataTables_filter input {
    margin-left: 0.5rem;
    padding: 0.5rem 1rem;
    border: 1px solid #e5e7eb;
    border-radius: 0.5rem;
    outline: none;
    transition: all 0.3s;
}

.dataTables_wrapper .dataTables_filter input:focus {
    border-color: #1f2937;
    box-shadow: 0 0 0 3px rgba(31, 41, 55, 0.1);
}

.dataTables_wrapper .dataTables_length {
    float: left;
    margin-bottom: 1rem;
}

.dataTables_wrapper .dataTables_length select {
    padding: 0.5rem;
    border: 1px solid #e5e7eb;
    border-radius: 0.5rem;
    margin: 0 0.5rem;
}

.dataTables_wrapper .dataTables_info,
.dataTables_wrapper .dataTables_paginate {
    margin-top: 1rem;
}
    </style>

    <!-- Success Message -->
    @if (session('success'))
        <div class="success-alert rounded-xl p-6 mb-8 animate-slide-in">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-green-800 font-medium">{!! session('success') !!}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="glass-card rounded-2xl p-6 animate-fade-in">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-14 h-14 bg-gray-800 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Verifikasi</p>
                    <p class="text-3xl font-bold text-gray-900">{{ count($all_verifications) }}</p>
                </div>
            </div>
            <div class="mt-4 text-sm text-gray-500">
                Semua verifikasi
            </div>
        </div>

        <div class="glass-card rounded-2xl p-6 animate-fade-in" style="animation-delay: 0.1s;">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-14 h-14 bg-gray-800 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Hari Ini</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $all_verifications->where('created_at', '>=', now()->startOfDay())->count() }}</p>
                </div>
            </div>
            <div class="mt-4 text-sm text-gray-500">
                {{ \Carbon\Carbon::now()->format('d M Y') }}
            </div>
        </div>

        <div class="glass-card rounded-2xl p-6 animate-fade-in" style="animation-delay: 0.2s;">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-14 h-14 bg-gray-800 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Minggu Ini</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $all_verifications->where('created_at', '>=', now()->startOfWeek())->count() }}</p>
                </div>
            </div>
            <div class="mt-4 text-sm text-gray-500">
                Minggu ini
            </div>
        </div>

        <div class="glass-card rounded-2xl p-6 animate-fade-in" style="animation-delay: 0.3s;">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-14 h-14 bg-gray-800 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Bulan Ini</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $all_verifications->where('created_at', '>=', now()->startOfMonth())->count() }}</p>
                </div>
            </div>
            <div class="mt-4 text-sm text-gray-500">
                {{ \Carbon\Carbon::now()->format('M Y') }}
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="glass-card rounded-2xl shadow-xl overflow-hidden animate-slide-in">
        <div class="p-6 bg-gray-800">
            <h3 class="text-xl font-bold text-white flex items-center">
                <div class="w-10 h-10 bg-white/20 backdrop-blur rounded-xl flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                Daftar Verifikasi TUK
            </h3>
        </div>

        <div class="p-6">
            <div class="overflow-x-auto">
                <table id="listTable" class="w-full table">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">No Surat</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Nama File</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Tanggal Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($all_verifications as $data)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 cursor-pointer transition-colors duration-150 row-clickable"
                                data-id="{{ $data['id'] }}"
                                data-file-url="{{ Storage::disk('public')->url('tuk-paperless/' . \Carbon\Carbon::parse($data['created_at'])->format('Y-m-d') . '/' . strtoupper($data['tuk']) . '/' . $data['link']) }}">
                                <td class="py-4 px-4">
                                    <span class="font-mono text-sm bg-gray-100 text-gray-800 px-3 py-1 rounded-lg">{{ $data['no_surat'] }}</span>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </div>
                                        <span class="font-medium text-gray-900">{{ $data['link'] }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="flex items-center space-x-2 text-sm text-gray-600">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>{{ \Carbon\Carbon::parse($data['created_at'])->format('d M Y') }}</span>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        <p class="text-gray-600 text-sm">Belum ada data verifikasi</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Empty State -->
    @if (count($all_verifications) === 0)
        <div class="glass-card rounded-2xl p-12 text-center animate-fade-in">
            <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-2xl flex items-center justify-center">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum ada data verifikasi</h3>
            <p class="text-gray-600">Tidak ada file yang perlu diverifikasi saat ini.</p>
        </div>
    @endif

    <!-- Floating Document Modal -->
    <div id="documentModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-2xl shadow-2xl max-w-7xl w-full max-h-[90vh] overflow-hidden transform transition-all flex">
                <!-- Left Panel (Initially Hidden) -->
                <div id="leftPanel" class="w-80 bg-gray-50 border-r border-gray-200 transition-all duration-300">
                    <div class="p-6 h-full overflow-y-auto">
                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Informasi Dokumen</h3>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm text-gray-500">No. Surat</p>
                                    <p id="panelNoSurat" class="font-semibold text-gray-900">-</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Nama File</p>
                                    <p id="panelFileName" class="font-semibold text-gray-900">-</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Tanggal</p>
                                    <p id="panelDate" class="font-semibold text-gray-900">-</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Tipe</p>
                                    <p id="panelType" class="font-semibold text-gray-900">Verifikasi TUK</p>
                                </div>
                            </div>
                        </div>

                        <!-- Toggle Panel Button -->
                        <button onclick="toggleLeftPanel()" class="w-full px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg transition-colors duration-200 flex items-center justify-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
                            </svg>
                            <span>Sembunyikan Panel</span>
                        </button>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="flex-1 flex flex-col">
                    <!-- Header -->
                    <div class="bg-gray-800 p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <button onclick="toggleLeftPanel()" id="togglePanelBtn" class="p-2 hover:bg-white/20 backdrop-blur rounded-lg transition-all duration-200">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                                    </svg>
                                </button>
                                <div class="w-12 h-12 bg-white/20 backdrop-blur rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 id="modalTitle" class="text-xl font-bold text-white">Preview Dokumen</h3>
                                    <p id="modalSubtitle" class="text-gray-300 text-sm">No. Surat: -</p>
                                </div>
                            </div>
                            <button onclick="closeDocumentModal()" class="p-3 hover:bg-white/20 backdrop-blur rounded-xl transition-all duration-200 group">
                                <svg class="w-6 h-6 text-white group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- PDF Viewer with Action Button -->
                    <div class="flex-1 p-6 bg-gray-50 relative">
                        <iframe id="documentViewer" src="" width="100%" height="100%" class="rounded-xl shadow-inner border-2 border-gray-200 bg-white"></iframe>

                        <!-- Action Button Inside Modal (Bottom Right) -->
                        <button id="modalActionBtn" class="absolute bottom-8 right-8 bg-green-600 hover:bg-green-700 text-white p-5 rounded-full shadow-2xl transform transition-all duration-300 hover:scale-110 group">
                            <svg id="modalActionIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                            </svg>
                            <span class="absolute right-full mr-3 top-1/2 transform -translate-y-1/2 bg-gray-900 text-white px-4 py-2 rounded-lg text-sm whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <span id="modalActionBtnText">Verifikasi</span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.css" rel="stylesheet" />
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#listTable').DataTable({
                order: [[2, 'desc']],
                language: {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    },
                    "emptyTable": "Tidak ada data tersedia",
                    "zeroRecords": "Tidak ditemukan data yang cocok"
                },
                pageLength: 25,
                responsive: true
            });
        });

        // Store current document info
        let currentDocumentId = null;
        let isPanelVisible = false;

        // Add event delegation for row clicks after DataTable is initialized
        $(document).ready(function() {
            $('#listTable').on('click', 'tbody tr.row-clickable', function(e) {
                // Don't open modal if clicking on sorting arrows
                if (e.target.closest('.sorting_asc, .sorting_desc, .sorting')) {
                    return;
                }

                // Get data from row
                const $row = $(this);
                const id = $row.data('id') || $row.find('td').eq(0).text().trim();
                const fileUrl = $row.data('file-url') || $row.find('td').eq(2).find('svg').closest('td').find('a').attr('href');
                const noSurat = $row.find('td').eq(0).text().trim();
                const fileName = $row.find('td').eq(1).find('span').text().trim();
                const dateText = $row.find('td').eq(2).text().trim();

                // Store data and open modal
                openDocumentModalWithData(id, fileUrl, noSurat, fileName, dateText);
            });
        });

        // Open document modal with data
        function openDocumentModal(id, fileUrl, noSurat, fileName) {
            // Store data for later use
            window.documentModalData = { id, fileUrl, noSurat, fileName };

            // For backwards compatibility
            currentDocumentId = id;
        }

        function openDocumentModalWithData(id, fileUrl, noSurat, fileName, dateText) {
            currentDocumentId = id;

            // Update modal content
            document.getElementById('modalTitle').textContent = 'Preview Dokumen - ' + fileName;
            document.getElementById('modalSubtitle').textContent = 'No. Surat: ' + noSurat;

            // Update panel info
            document.getElementById('panelNoSurat').textContent = noSurat;
            document.getElementById('panelFileName').textContent = fileName;
            document.getElementById('panelDate').textContent = dateText;

            // Set iframe source
            const viewer = document.getElementById('documentViewer');
            viewer.src = fileUrl;

            // Show modal
            const modal = document.getElementById('documentModal');
            modal.classList.remove('hidden');

            // Initially hide left panel
            const leftPanel = document.getElementById('leftPanel');
            leftPanel.style.width = '0';
            leftPanel.style.overflow = 'hidden';
            leftPanel.classList.add('opacity-0');

            // Show action button
            const actionBtn = document.getElementById('modalActionBtn');
            actionBtn.classList.remove('hidden');

            // Add click handler to action button
            actionBtn.onclick = function() {
                window.location.href = '/verification/' + currentDocumentId;
            };
        }

        // Toggle left panel visibility
        function toggleLeftPanel() {
            const leftPanel = document.getElementById('leftPanel');
            const toggleBtn = document.getElementById('togglePanelBtn');

            isPanelVisible = !isPanelVisible;

            if (isPanelVisible) {
                leftPanel.style.width = '20rem'; // w-80
                leftPanel.classList.remove('opacity-0');
                leftPanel.style.overflow = 'visible';

                // Change icon to close
                toggleBtn.innerHTML = `
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                `;
            } else {
                leftPanel.style.width = '0';
                leftPanel.classList.add('opacity-0');
                setTimeout(() => {
                    leftPanel.style.overflow = 'hidden';
                }, 300);

                // Change icon to menu
                toggleBtn.innerHTML = `
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                `;
            }
        }

        // Close document modal
        function closeDocumentModal() {
            const modal = document.getElementById('documentModal');
            const actionBtn = document.getElementById('modalActionBtn');
            const viewer = document.getElementById('documentViewer');
            const leftPanel = document.getElementById('leftPanel');

            modal.classList.add('hidden');
            actionBtn.classList.add('hidden');
            viewer.src = '';
            currentDocumentId = null;
            isPanelVisible = false;

            // Reset panel
            leftPanel.style.width = '20rem';
            leftPanel.classList.remove('opacity-0');
            leftPanel.style.overflow = 'visible';
        }

        // Close modal on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDocumentModal();
            }
        });

        // Close modal on background click
        document.getElementById('documentModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDocumentModal();
            }
        });
    </script>
@endsection