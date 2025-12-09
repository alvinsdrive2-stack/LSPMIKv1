@extends('layouts.dashboard-dark')

@section('title', 'Konfirmasi Verifikasi TUK - Ketua TUK')

@section('pageTitle', 'Konfirmasi Verifikasi TUK - Ketua TUK')

@section('content')

            @if (session('success'))
            <div class="max-w-7xl mx-auto mt-6 mb-8">
                <div class="success-dark px-6 py-4 rounded-xl flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="font-medium">{!! session('success') !!}</p>
                </div>
            </div>
            @endif

            <div class="glass-dark rounded-2xl shadow-xl p-6 overflow-x-auto">
                            <table id="listTable">
                                <thead>
                                    <tr>
                                        <th>No Surat</th>
                                        <th>Nama File</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Link</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($all_verifications as $verification)
                                        <tr>
                                            <td>{{ $verification['no_surat'] }}</td>
                                            <td>{{ $verification['link'] }}</td>
                                            <td>{{ $verification['created_at'] }}</td>
                                            <td><a href="{{ Storage::disk('public')->url('tuk-paperless/' . \Carbon\Carbon::parse($verification['created_at'])->format('Y-m-d') . '/' . strtoupper($verification['tuk']) . '/' . $verification['link']) }}" target="_blank">
                                                    <div class="btn-primary-dark py-2 px-3 rounded text-center inline-block">Lihat File
                                                    </div>
                                                </a>
                                            </td>
                                            <td><a href="/confirm-tuk/{{ $verification['id'] }}">
                                                    <div class="btn-primary-dark py-2 px-3 rounded text-center inline-block">Konfirmasi
                                                    </div>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
                order: [[2, 'asc']],
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
                }
            });
        });
    </script>
@endsection