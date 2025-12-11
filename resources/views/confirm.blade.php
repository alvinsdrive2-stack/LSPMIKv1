@extends('layouts.dashboard')

@section('title', 'Konfirmasi Verifikasi TUK')

@section('pageTitle', 'Konfirmasi Verifikasi TUK - Direktur LSP')

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

        /* Button styles from sewaktu.blade.php */
        .btn-gray {
            background: #1f2937;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-gray:hover {
            background: #374151;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(31, 41, 55, 0.3);
        }

        /* Table enhancements */
        .table-hover tbody tr:hover {
            background-color: rgba(31, 41, 55, 0.05);
        }
    </style>

    <!-- Statistics Overview -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Menunggu Konfirmasi -->
        <div class="glass-card rounded-2xl p-6 animate-fade-in">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Menunggu Konfirmasi</p>
                    <p class="text-3xl font-bold text-gray-900">{{ count($all_verifications) }}</p>
                </div>
                <div class="w-14 h-14 bg-gray-800 rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4 text-sm text-gray-500">
                Perlu persetujuan direktur
            </div>
        </div>

        <!-- Menunggu SK -->
        <div class="glass-card rounded-2xl p-6 animate-fade-in" style="animation-delay: 0.1s;">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Menunggu SK</p>
                    <p class="text-3xl font-bold text-gray-900">{{ count($all_sk) }}</p>
                </div>
                <div class="w-14 h-14 bg-gray-800 rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4 text-sm text-gray-500">
                Siap dibuat SK
            </div>
        </div>

        <!-- Total Proses -->
        <div class="glass-card rounded-2xl p-6 animate-fade-in" style="animation-delay: 0.2s;">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Proses</p>
                    <p class="text-3xl font-bold text-gray-900">{{ count($all_verifications) + count($all_sk) }}</p>
                </div>
                <div class="w-14 h-14 bg-gray-800 rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4 text-sm text-gray-500">
                Semua berkas aktif
            </div>
        </div>

        <!-- Hari Ini -->
        <div class="glass-card rounded-2xl p-6 animate-fade-in" style="animation-delay: 0.3s;">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Hari Ini</p>
                    <p class="text-3xl font-bold text-gray-900">
                        {{ collect($all_verifications)->merge($all_sk)->filter(function($item) {
                            return \Carbon\Carbon::parse($item['created_at'])->isToday();
                        })->count() }}
                    </p>
                </div>
                <div class="w-14 h-14 bg-gray-800 rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4 text-sm text-gray-500">
                {{ \Carbon\Carbon::now()->format('d M Y') }}
            </div>
        </div>
    </div>

    <!-- Verifications Table -->
    <div class="glass-card rounded-2xl shadow-xl overflow-hidden mb-8 animate-slide-in">
        <div class="p-6 bg-gray-800">
            <h3 class="text-xl font-bold text-white flex items-center">
                <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                Menunggu Konfirmasi Direktur
                @if (count($all_verifications) > 0)
                    <span class="ml-auto px-3 py-1 bg-white/20 rounded-full text-sm">{{ count($all_verifications) }} item</span>
                @endif
            </h3>
        </div>

        <div class="p-6">
            @if (count($all_verifications) > 0)
                <div class="overflow-x-auto">
                    <table id="listTable" class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">No Surat</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Nama File</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_verifications as $verification)
                                <tr class="border-b border-gray-100 hover:bg-gray-50 cursor-pointer transition-colors duration-150"
                                    onclick="openDocumentModal('{{ $verification['id'] }}', '{{ Storage::disk('public')->url('tuk-paperless/' . \Carbon\Carbon::parse($verification['created_at'])->format('Y-m-d') . '/' . strtoupper($verification['tuk']) . '/' . $verification['link']) }}', '{{ $verification['no_surat'] }}', '{{ $verification['link'] }}')">
                                    <td class="py-4 px-4">
                                        <span class="font-mono text-sm bg-gray-100 text-gray-800 px-3 py-1 rounded-lg">{{ $verification['no_surat'] }}</span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                            </div>
                                            <span class="font-medium text-gray-900">{{ $verification['link'] }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="text-sm text-gray-600">
                                            {{ \Carbon\Carbon::parse($verification['created_at'])->format('d M Y H:i') }}
                                        </div>
                                    </td>
                                  </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-20 h-20 mx-auto mb-4 bg-gray-100 rounded-2xl flex items-center justify-center">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">Tidak Ada Verifikasi Menunggu</h4>
                    <p class="text-gray-600">Semua verifikasi telah dikonfirmasi.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- SK Table -->
    <div class="glass-card rounded-2xl shadow-xl overflow-hidden animate-slide-in" style="animation-delay: 0.2s;">
        <div class="p-6 bg-gray-800">
            <h3 class="text-xl font-bold text-white flex items-center">
                <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                Menunggu Pembuatan SK
                @if (count($all_sk) > 0)
                    <span class="ml-auto px-3 py-1 bg-white/20 rounded-full text-sm">{{ count($all_sk) }} item</span>
                @endif
            </h3>
        </div>

        <div class="p-6">
            @if (count($all_sk) > 0)
                <div class="overflow-x-auto">
                    <table class="w-full table-hover">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">No Surat</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Nama File</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Tanggal</th>
                                <th class="text-center py-3 px-4 font-semibold text-gray-700">File</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_sk as $sk)
                                <tr class="border-b border-gray-100 hover:bg-gray-50 cursor-pointer transition-colors duration-150"
                                    onclick="openDocumentModal('{{ $sk['id'] }}', '{{ Storage::disk('public')->url('tuk-paperless/' . \Carbon\Carbon::parse($sk['created_at'])->format('Y-m-d') . '/' . strtoupper($sk['tuk']) . '/' . $sk['link']) }}', '{{ $sk['no_surat'] }}', '{{ $sk['link'] }}', 'sk')">
                                    <td class="py-4 px-4">
                                        <span class="font-mono text-sm bg-gray-100 text-gray-800 px-3 py-1 rounded-lg">{{ $sk['no_surat'] }}</span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                            </div>
                                            <span class="font-medium text-gray-900">{{ $sk['link'] }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="text-sm text-gray-600">
                                            {{ \Carbon\Carbon::parse($sk['created_at'])->format('d M Y H:i') }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-20 h-20 mx-auto mb-4 bg-gray-100 rounded-2xl flex items-center justify-center">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">Tidak Ada SK Menunggu</h4>
                    <p class="text-gray-600">Tidak ada SK yang perlu dibuat saat ini.</p>
                </div>
            @endif
        </div>
    </div>

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
                                    <p id="panelType" class="font-semibold text-gray-900">-</p>
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
                        <button id="modalActionBtn" class="absolute bottom-8 right-8 bg-gray-800 hover:bg-gray-700 text-white p-5 rounded-full shadow-2xl transform transition-all duration-300 hover:scale-110 group">
                            <svg id="modalActionIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="absolute right-full mr-3 top-1/2 transform -translate-y-1/2 bg-gray-900 text-white px-4 py-2 rounded-lg text-sm whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <span id="modalActionBtnText">Konfirmasi</span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Initialize DataTable for verifications table only
            $('#listTable').DataTable({
                order: [[2, 'desc']],
                pageLength: 10,
                responsive: true,
                language: {
                    search: "Cari verifikasi:",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ verifikasi",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    },
                    emptyTable: "Tidak ada data verifikasi tersedia",
                    zeroRecords: "Tidak ditemukan verifikasi yang cocok"
                }
            });
        });

        // Store current document info
        let currentDocumentId = null;
        let currentDocumentType = 'verification'; // 'verification' or 'sk'

        // Open document modal
        function openDocumentModal(id, fileUrl, noSurat, fileName, type = 'verification') {
            currentDocumentId = id;
            currentDocumentType = type;

            // Get date from the clicked row
            const clickedRow = event.currentTarget;
            const dateText = clickedRow.querySelector('td:nth-child(3) .text-gray-600').textContent;

            // Update modal content
            document.getElementById('modalTitle').textContent = 'Preview Dokumen - ' + fileName;
            document.getElementById('modalSubtitle').textContent = 'No. Surat: ' + noSurat;

            // Update panel info
            document.getElementById('panelNoSurat').textContent = noSurat;
            document.getElementById('panelFileName').textContent = fileName;
            document.getElementById('panelDate').textContent = dateText;
            document.getElementById('panelType').textContent = type === 'sk' ? 'Pembuatan SK' : 'Verifikasi TUK';

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

            // Update button text and icon based on type
            const actionBtnText = document.getElementById('modalActionBtnText');
            const actionBtnIcon = document.getElementById('modalActionIcon');

            if (type === 'sk') {
                actionBtnText.textContent = 'Buat SK';
                actionBtnIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>';
            } else {
                actionBtnText.textContent = 'Konfirmasi';
                actionBtnIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>';
            }

            // Add click handler to action button
            actionBtn.onclick = function() {
                if (currentDocumentType === 'sk') {
                    window.location.href = '/sk/' + currentDocumentId;
                } else {
                    window.location.href = '/confirm/' + currentDocumentId;
                }
            };
        }

        // Toggle left panel visibility
        let isPanelVisible = false;
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