@extends('layouts.dashboard')

@section('title', 'File Verifikasi')

@section('pageTitle', 'Daftar File Verifikasi - Admin LSP')

@section('content')
    <style>
        /* Professional white theme for file pages */
        .stat-card-professional {
            background: #FFFFFF;
            border: 1px solid #E5E7EB;
            padding: 1.5rem;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }

        .stat-card-professional:hover {
            border-color: #D1D5DB;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .stat-label-professional {
            color: #000000;
            font-weight: 500;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            letter-spacing: 0.025em;
        }

        .stat-value-professional {
            color: #000000;
            font-size: 2rem;
            font-weight: 700;
            line-height: 1.2;
        }

        .stat-icon-professional {
            background: #F9FAFB;
            border: 1px solid #E5E7EB;
            padding: 0.75rem;
            border-radius: 0.5rem;
            color: #000000;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .main-content-professional {
            background: #FFFFFF;
            border: 1px solid #E5E7EB;
            padding: 2rem;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }

        .text-black-professional {
            color: #000000 !important;
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
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 animate-fade-in-up">
        <div class="stat-card-professional">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 stat-icon-professional rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="stat-label-professional">Total File</p>
                    <p class="stat-value-professional">
                        @if(is_array($all_files_view))
                            {{ count($all_files_view) }}
                        @else
                            {{ $all_files_view->count() }}
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <div class="stat-card-professional">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 stat-icon-professional rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="stat-label-professional">Hari Ini</p>
                    <p class="stat-value-professional">
                        @if(is_array($all_files_view))
                            {{ collect($all_files_view)->where('created_at', '>=', now()->startOfDay())->count() }}
                        @else
                            {{ $all_files_view->where('created_at', '>=', now()->startOfDay())->count() }}
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <div class="stat-card-professional">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 stat-icon-professional rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="stat-label-professional">Minggu Ini</p>
                    <p class="stat-value-professional">
                        @if(is_array($all_files_view))
                            {{ collect($all_files_view)->where('created_at', '>=', now()->startOfWeek())->count() }}
                        @else
                            {{ $all_files_view->where('created_at', '>=', now()->startOfWeek())->count() }}
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <div class="stat-card-professional">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 stat-icon-professional rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="stat-label-professional">Bulan Ini</p>
                    <p class="stat-value-professional">
                        @if(is_array($all_files_view))
                            {{ collect($all_files_view)->where('created_at', '>=', now()->startOfMonth())->count() }}
                        @else
                            {{ $all_files_view->where('created_at', '>=', now()->startOfMonth())->count() }}
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content-professional animate-slide-in">
        <!-- Table Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
            <div>
                <h3 class="text-xl font-bold text-black">Daftar File Verifikasi</h3>
                <p class="text-gray-600 mt-1">Semua file verifikasi TUK yang tersimpan</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <button onclick="window.location.reload()" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-black rounded-lg hover:bg-gray-50 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Refresh
                </button>
            </div>
        </div>

        <!-- Table Container -->
        <div class="card-professional rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table id="listTable" class="table-professional">
                    <thead>
                        <tr>
                            <th class="text-left">No Surat</th>
                            <th class="text-left">Nama File</th>
                            <th class="text-left">Tanggal Dibuat</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($all_files_view as $file)
                            <tr>
                                <td class="whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-8 w-8 bg-gray-100 rounded-full flex items-center justify-center border border-gray-300">
                                            <span class="text-xs font-semibold text-black">{{ substr($file['no_surat'], 0, 2) }}</span>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-black">{{ $file['no_surat'] }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        <p class="text-sm text-black font-medium">{{ $file['link'] }}</p>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($file['created_at'])->format('d M Y') }}</p>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap text-sm text-center">
                                    <a href="{{ Storage::disk('public')->url('tuk/' . \Carbon\Carbon::parse($file['created_at'])->format('Y-m-d') . '/' . strtoupper($file['tuk']) . '/' . $file['link']) }}"
                                       target="_blank"
                                       class="btn-professional">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                        </svg>
                                        Lihat File
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        <p class="text-gray-600 text-sm">Belum ada file verifikasi</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.css" rel="stylesheet" />
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.js"></script>

    <style>
        /* DataTables styling for professional white theme */
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 1rem;
        }

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

        .dataTables_wrapper .dataTables_length {
            margin-bottom: 1rem;
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

        .dataTables_wrapper .dataTables_info {
            color: #4B5563;
            font-size: 0.875rem;
            margin-top: 1rem;
        }

        .dataTables_wrapper .dataTables_paginate {
            margin-top: 1rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            background: #FFFFFF !important;
            border: 1px solid #D1D5DB !important;
            color: #000000 !important;
            border-radius: 0.375rem !important;
            font-weight: 500 !important;
            padding: 0.5rem 0.75rem !important;
            font-size: 0.875rem !important;
            margin: 0 0.125rem !important;
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

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            opacity: 0.5 !important;
            cursor: not-allowed !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
            background: #FFFFFF !important;
            border-color: #D1D5DB !important;
            box-shadow: none !important;
        }
    </style>

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
    </script>
@endsection