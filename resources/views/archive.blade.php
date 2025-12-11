@extends('layouts.dashboard')

@section('title', 'Archive Verifikasi TUK')

@section('pageTitle', 'Archive Verifikasi TUK')

@section('content')
    <style>
        /* Professional white theme for archive page */
        .archive-container {
            background: #FFFFFF;
            min-height: 100vh;
            padding: 2rem;
        }

        .card-professional {
            background: #FFFFFF;
            border: 1px solid #E5E7EB;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }

        .card-professional:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            border-color: #D1D5DB;
        }

        .stat-card {
            background: #FFFFFF;
            border: 1px solid #E5E7EB;
            padding: 1.5rem;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }

        .stat-card:hover {
            border-color: #D1D5DB;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .stat-label {
            color: #000000;
            font-weight: 500;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            letter-spacing: 0.025em;
        }

        .stat-value {
            color: #000000;
            font-size: 2rem;
            font-weight: 700;
            line-height: 1.2;
        }

        .stat-icon {
            background: #F9FAFB;
            border: 1px solid #E5E7EB;
            padding: 0.75rem;
            border-radius: 0.5rem;
            color: #000000;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .table-professional {
            background: #FFFFFF;
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #E5E7EB;
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }

        .table-professional thead th {
            background: #F9FAFB;
            color: #000000;
            font-weight: 600;
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #E5E7EB;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .table-professional tbody tr {
            border-bottom: 1px solid #F3F4F6;
            transition: background-color 0.2s ease;
        }

        .table-professional tbody tr:hover {
            background: #F9FAFB;
        }

        .table-professional tbody tr:last-child {
            border-bottom: none;
        }

        .table-professional tbody td {
            padding: 1rem;
            color: #000000;
            font-size: 0.875rem;
            line-height: 1.5;
        }

        .badge-professional {
            background: #F3F4F6;
            color: #000000;
            border: 1px solid #D1D5DB;
            padding: 0.375rem 0.75rem;
            border-radius: 9999px;
            font-weight: 500;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        .btn-professional {
            background: #FFFFFF;
            color: #000000;
            border: 1px solid #D1D5DB;
            padding: 0.625rem 1.25rem;
            border-radius: 0.5rem;
            font-weight: 500;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-professional:hover {
            background: #F9FAFB;
            border-color: #9CA3AF;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            text-decoration: none;
        }

        .btn-professional:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.1);
        }

        .empty-state {
            background: #FFFFFF;
            border: 1px solid #E5E7EB;
            padding: 3rem;
            border-radius: 0.75rem;
            text-align: center;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }

        .empty-state h3 {
            color: #000000;
            font-weight: 600;
            margin-top: 1rem;
            font-size: 1.125rem;
        }

        .empty-state p {
            color: #4B5563;
            margin-top: 0.5rem;
            font-size: 0.875rem;
        }

        /* DataTables styling for professional white theme */
        .dataTables_wrapper .dataTables_filter input {
            background: #FFFFFF;
            border: 1px solid #D1D5DB;
            color: #000000;
            border-radius: 0.375rem;
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #9CA3AF;
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.1);
        }

        .dataTables_wrapper .dataTables_filter label {
            color: #000000;
            font-weight: 500;
            font-size: 0.875rem;
        }

        .dataTables_wrapper .dataTables_length select {
            background: #FFFFFF;
            border: 1px solid #D1D5DB;
            color: #000000;
            border-radius: 0.375rem;
            padding: 0.5rem;
            font-size: 0.875rem;
        }

        .dataTables_wrapper .dataTables_length label {
            color: #000000;
            font-weight: 500;
            font-size: 0.875rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            background: #FFFFFF !important;
            border: 1px solid #D1D5DB !important;
            color: #000000 !important;
            border-radius: 0.375rem !important;
            font-weight: 500 !important;
            padding: 0.5rem 0.75rem !important;
            font-size: 0.875rem !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #F9FAFB !important;
            border-color: #9CA3AF !important;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #000000 !important;
            border-color: #000000 !important;
            color: #FFFFFF !important;
        }

        .dataTables_wrapper .dataTables_info {
            color: #4B5563 !important;
            font-size: 0.875rem;
        }

        /* Header styling */
        .header-professional {
            background: linear-gradient(135deg, #e8e8e8 0%, #c9b7b7 100%);
            border-bottom: 1px solid #E5E7EB;
            padding: 1.5rem;
            border-radius: 0.75rem 0.75rem 0 0;
        }

        .header-professional h3 {
            color: #000000;
            font-weight: 600;
            font-size: 1.125rem;
            margin: 0;
        }

        /* Professional animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-slide-in {
            animation: slideIn 0.8s ease-out forwards;
        }
    </style>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="stat-card animate-fade-in-up" style="animation-delay: 0.1s;">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label">Total Surat</p>
                    <p class="stat-value">{{ count($all_files_view) }}</p>
                </div>
                <div class="stat-icon">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="stat-card animate-fade-in-up" style="animation-delay: 0.2s;">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label">Total TUK</p>
                    <p class="stat-value">{{ count($tuk_filtered) }}</p>
                </div>
                <div class="stat-icon">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="stat-card animate-fade-in-up" style="animation-delay: 0.3s;">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label">Bulan Ini</p>
                    <p class="stat-value">
                        {{ collect($all_files_view)->filter(function($file) {
                            return \Carbon\Carbon::parse($file['created_at'])->isCurrentMonth();
                        })->count() }}
                    </p>
                </div>
                <div class="stat-icon">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="stat-card animate-fade-in-up" style="animation-delay: 0.4s;">
            <div class="flex items-center justify-between">
                <div>
                    <p class="stat-label">Tersedia</p>
                    <p class="stat-value">
                        {{ collect($all_files_view)->filter(function($file) {
                            return file_exists(public_path('files/' . $file['no_surat']));
                        })->count() }}
                    </p>
                </div>
                <div class="stat-icon">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card-professional rounded-xl overflow-hidden animate-slide-in">
        <div class="header-professional">
            <h3 class="flex items-center">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v1a1 1 0 001 1h4a1 1 0 001-1v-1m3-2V8a2 2 0 00-2-2H8a2 2 0 00-2 2v6m12 0H6"/>
                </svg>
                Daftar Surat Verifikasi TUK
            </h3>
        </div>

        <div class="p-6">
            <div class="overflow-x-auto">
                <table id="listTable" class="table-professional">
                    <thead>
                        <tr>
                            <th class="text-left">No Surat</th>
                            <th class="text-left">TUK</th>
                            <th class="text-left">Tanggal Dibuat</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_files_view as $file)
                            <tr>
                                <td>
                                    <div class="flex items-center space-x-2">
                                        <span class="badge-professional font-mono">{{ $file['no_surat'] }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge-professional">{{ $file['tuk'] }}</span>
                                </td>
                                <td>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ \Carbon\Carbon::parse($file['created_at'])->format('d M Y') }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="/files/{{ $file['no_surat'] }}" class="btn-professional">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <span>Lihat File</span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Empty State -->
    @if (count($all_files_view) === 0)
        <div class="empty-state animate-fade-in-up">
            <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h3 class="text-xl font-semibold mb-2">Belum ada data surat verifikasi</h3>
            <p class="text-sm">Silakan tambah surat verifikasi baru untuk melihat data di sini.</p>
        </div>
    @endif
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Initialize DataTable with custom settings
            $('#listTable').DataTable({
                order: [[2, 'desc']],
                pageLength: 10,
                responsive: true,
                language: {
                    search: "Cari surat:",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ surat",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    },
                    emptyTable: "Tidak ada data surat tersedia",
                    zeroRecords: "Tidak ditemukan surat yang cocok"
                }
            });

            // Enhanced filter functionality
            $('#status').on('change', function() {
                var selectedTuk = $(this).val();
                $('#listTable').DataTable().column(1).search(selectedTuk).draw();
            });

        });
    </script>
@endsection