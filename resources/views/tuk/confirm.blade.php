@extends('layouts.dashboard')

@section('title', 'Konfirmasi Verifikasi TUK - Ketua TUK')

@section('pageTitle', 'Konfirmasi Verifikasi TUK - Ketua TUK')

@section('content')

            @if (session('success'))
            <div class="max-w-7xl mx-auto mt-6 mb-8">
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 text-green-800 px-6 py-4 rounded-xl shadow-sm flex items-center animate-slideDown">
                    <svg class="w-6 h-6 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="font-medium text-green-800">{!! session('success') !!}</p>
                </div>
            </div>
            @endif

            <div class="bg-white rounded-2xl shadow-xl p-6 overflow-x-auto border border-gray-200">
                <div class="p-6 bg-gradient-to-r from-gray-700 to-gray-900">
            <h3 class="text-xl font-bold text-white flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Konfirmasi Verifikasi TUK
            </h3>
        </div>

                <table id="listTable" class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-200">
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">No Surat</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">Nama File</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">Tanggal Dibuat</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-900 uppercase tracking-wider">Link</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-900 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($all_verifications as $verification)
                            <tr class="hover:bg-gray-50 transition-colors duration-150 cursor-pointer row-clickable"
                                data-id="{{ $verification['id'] }}"
                                data-file-url="{{ Storage::disk('public')->url('tuk-paperless/' . \Carbon\Carbon::parse($verification['created_at'])->format('Y-m-d') . '/' . strtoupper($verification['tuk']) . '/' . $verification['link']) }}">
                                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $verification['no_surat'] }}</td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700 font-medium">{{ $verification['link'] }}</td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">{{ $verification['created_at'] }}</td>
                                <td class="px-4 py-4 whitespace-nowrap text-center">
                                    
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-center">
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Empty State -->
            @if (count($all_verifications) === 0)
                <div class="bg-white rounded-2xl p-12 text-center border border-gray-200">
                    <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-2xl flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum ada data konfirmasi</h3>
                    <p class="text-gray-600">Tidak ada file yang perlu dikonfirmasi saat ini.</p>
                </div>
            @endif
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
                                        <p id="panelType" class="font-semibold text-gray-900">Konfirmasi TUK</p>
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
                        <div class="bg-gradient-to-r from-[#1F3A73] to-[#4A90E2] p-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <button onclick="toggleLeftPanel()" id="togglePanelBtn" class="p-2 hover:bg-white/20 backdrop-blur rounded-lg transition-all duration-200">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                                        </svg>
                                    </button>
                                    <div class="w-12 h-12 bg-white/20 backdrop-blur rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 id="modalTitle" class="text-xl font-bold text-white">Preview Dokumen</h3>
                                        <p id="modalSubtitle" class="text-blue-100 text-sm">No. Surat: -</p>
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

                            <!-- Approve Button Inside Modal (Bottom Right) -->
                            <button id="modalActionBtn" class="absolute bottom-8 right-8 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white p-5 rounded-full shadow-2xl transform transition-all duration-300 hover:scale-110 group">
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
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.css" rel="stylesheet" />
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.js"></script>

    <style>
        /* Custom DataTable Styling */
        .dataTables_wrapper {
            padding: 0;
            margin-top: 20px;
        }

        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 20px;
        }

        .dataTables_wrapper .dataTables_filter input {
            background: #f9fafb;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            padding: 8px 12px;
            color: #374151;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            background: white;
        }

        .dataTables_wrapper .dataTables_filter label {
            font-weight: 600;
            color: #374151;
            font-size: 14px;
        }

        .dataTables_wrapper .dataTables_length {
            margin-bottom: 20px;
        }

        .dataTables_wrapper .dataTables_length select {
            background: #f9fafb;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            padding: 6px 12px;
            color: #374151;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .dataTables_wrapper .dataTables_length select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .dataTables_wrapper .dataTables_length label {
            font-weight: 600;
            color: #374151;
            font-size: 14px;
        }

        .dataTables_wrapper .dataTables_info {
            color: #6b7280;
            font-size: 14px;
            font-weight: 500;
            margin-top: 20px;
        }

        .dataTables_wrapper .dataTables_paginate {
            margin-top: 20px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            background: white !important;
            border: 2px solid #e5e7eb !important;
            color: #374151 !important;
            padding: 8px 14px !important;
            margin: 0 2px !important;
            border-radius: 8px !important;
            font-weight: 500 !important;
            font-size: 14px !important;
            transition: all 0.3s ease !important;
            min-width: 40px !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #3b82f6 !important;
            color: white !important;
            border-color: #3b82f6 !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%) !important;
            color: white !important;
            border-color: #3b82f6 !important;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            opacity: 0.5 !important;
            cursor: not-allowed !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
            background: white !important;
            color: #9ca3af !important;
            border-color: #e5e7eb !important;
            transform: none;
            box-shadow: none;
        }

        /* Hide the original table header since we have custom header */
        #listTable thead {
            display: none;
        }

        /* Custom table styling */
        #listTable {
            border-collapse: separate;
            border-spacing: 0;
        }

        #listTable tbody tr {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: all 0.2s ease;
        }

        #listTable tbody tr:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        /* Animation for success message */
        @keyframes slideDown {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .animate-slideDown {
            animation: slideDown 0.5s ease-out;
        }
    </style>

    <script>
        $(document).ready(function() {
            $('#listTable').DataTable({
                order: [[2, 'asc']],
                pageLength: 25,
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
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
                columnDefs: [
                    { targets: 0, orderable: true },
                    { targets: 1, orderable: true },
                    { targets: 2, orderable: true },
                    { targets: 3, orderable: false },
                    { targets: 4, orderable: false }
                ]
            });

            // Add click event for table rows
            $('#listTable').on('click', 'tbody tr.row-clickable', function(e) {
                // Don't open modal if clicking on sorting arrows
                if (e.target.closest('.sorting_asc, .sorting_desc, .sorting')) {
                    return;
                }

                // Get data from row
                const $row = $(this);
                const id = $row.data('id');
                const fileUrl = $row.data('file-url');
                const noSurat = $row.find('td').eq(0).text().trim();
                const fileName = $row.find('td').eq(1).text().trim();
                const dateText = $row.find('td').eq(2).text().trim();

                // Store data and open modal
                openDocumentModalWithData(id, fileUrl, noSurat, fileName, dateText);
            });
        });

        // Store current document info
        let currentDocumentId = null;
        let isPanelVisible = false;

        // Open document modal with data
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
                // Show loading state
                actionBtn.disabled = true;
                actionBtn.classList.add('opacity-50', 'cursor-not-allowed');

                // Update button to loading state
                actionBtn.innerHTML = `
                    <svg class="w-6 h-6 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    <span class="absolute right-full mr-3 top-1/2 transform -translate-y-1/2 bg-gray-900 text-white px-4 py-2 rounded-lg text-sm whitespace-nowrap">
                        Memproses...
                    </span>
                `;

                // Navigate to confirmation page
                setTimeout(() => {
                    window.location.href = '/confirm-tuk/' + currentDocumentId;
                }, 500);
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