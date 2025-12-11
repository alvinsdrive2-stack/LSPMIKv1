@extends('layouts.dashboard')

@section('title', 'Penugasan Verifikator TUK Sewaktu')

@section('pageTitle', 'Penugasan Verifikator TUK - Admin LSP')

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

        /* Black theme for archive pages */
        .{
            background: #000000;
            border: 2px solid #333333;
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
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .glass-card:hover::before {
            left: 100%;
        }

        .glass-card:hover {
            border-color: #444444;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
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

        /* Success message auto-hide */
        @keyframes fadeOut {
            from {
                opacity: 1;
                transform: translateX(0);
            }
            to {
                opacity: 0;
                transform: translateX(20px);
            }
        }

        .auto-hide {
            animation: fadeOut 0.5s ease-out forwards;
            animation-delay: 5s;
        }
    </style>

    <!-- Success Message -->
    @if (session('success'))
        <div class="p-6 mb-8 animate-slideDown" id="successAlert">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fa fa-check text-green-600 text-lg"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-gray-900 font-semibold">Berhasil!</p>
                    <p class="text-gray-700 text-sm mt-1">{!! session('success') !!}</p>
                </div>
            </div>
        </div>
    @endif

  <style>
        /* Additional black theme styles for forms */
        .form-input-black {
            background: #ffffff !important;
            border: 2px solid #333333 !important;
            color: #000000 !important;
        }

        .form-input-black:focus {
            border-color: #444444 !important;
            box-shadow: 0 0 0 3px rgba(51, 51, 51, 0.1) !important;
        }

        .form-input-black::placeholder {
            color: #666666 !important;
        }

        .form-label-black {
            color: #000000 !important;
        }

        .form-select-black {
            background: #ffffff !important;
            border: 2px solid #333333 !important;
            color: #000000 !important;
        }

        .btn-black-theme {
            background: #000000 !important;
            border: 2px solid #333333 !important;
            color: #000000 !important;
        }

        .btn-black-theme:hover {
            background: #111111 !important;
            border-color: #444444 !important;
        }

        .text-black-custom {
            color: #000000 !important;
        }

        .icon-container-black {
            background: #000000;
            border: 2px solid #333333;
        }
    </style>

    <!-- Main Form Section -->
    <div class="max-w-7xl mx-auto">
        <!-- Form Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 icon-container-black rounded-2xl mb-4 shadow-lg animate-fade-in">
                <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20M10,19L12,15H9V10H15V15L13,19H10Z"/>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-black mb-3 animate-fade-in-up">Form Verifikasi TUK</h1>
            <p class="text-black text-lg animate-fade-in-up animate-delay-100">Lengkapi data verifikasi untuk TUK Sewaktu</p>
        </div>

        <!-- Form Card -->
        <div class=" rounded-2xl shadow-xl overflow-hidden animate-fade-in-up animate-delay-300 bg-white">

                <form action="{{ route('createFileSewaktu') }}" method="POST" class="p-8 space-y-8">
                    @csrf

                <!-- Informasi Utama Section -->
                    <div class="rounded-xl p-6 mb-6 animate-fade-in">
                        <h3 class="text-xl font-bold text-black mb-6 flex items-center">
                            <div class="w-10 h-10 icon-container-black rounded-lg flex items-center justify-center mr-3">
                                <i class="fa fa-info-circle text-white"></i>
                            </div>
                            Informasi Utama
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div class="space-y-2">
                                <label for="nomor" class="block text-sm font-semibold form-label-black flex items-center">
                                    <i class="fas fa-hashtag text-black mr-2 text-xs"></i>
                                    Nomor Surat
                                </label>
                                <div class="relative">
                                    <input type="number" id="nomor" name="nomor" required
                                           class="w-full px-4 py-3 form-input-black rounded-lg placeholder-gray-500 transition-all duration-200"
                                           placeholder="Masukkan nomor surat">
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label for="tuk" class="block text-sm font-semibold form-label-black flex items-center">
                                    <i class="fas fa-building text-black mr-2 text-xs"></i>
                                    Nama TUK
                                </label>
                                <div class="relative">
                                    <input type="text" id="tuk" name="tuk" required
                                           class="w-full px-4 py-3 form-input-black rounded-lg placeholder-gray-500 transition-all duration-200"
                                           placeholder="Masukkan nama TUK">
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label for="jenisTUK" class="block text-sm font-semibold form-label-black flex items-center">
                                    <i class="fas fa-layer-group text-black mr-2 text-xs"></i>
                                    Jenis TUK
                                </label>
                                <div class="relative">
                                    <select id="jenisTUK" name="jenisTUK" required
                                            class="w-full px-4 py-3 form-select-black rounded-lg transition-all duration-200 appearance-none cursor-pointer">
                                        <option value="">Pilih jenis TUK</option>
                                        <option value="Sewaktu">TUK Sewaktu</option>
                                        <option value="Mandiri">TUK Mandiri</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <i class="fas fa-chevron-down text-black"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label for="metodeVerif" class="block text-sm font-semibold form-label-black flex items-center">
                                    <i class="fas fa-clipboard-check text-black mr-2 text-xs"></i>
                                    Metode Verifikasi
                                </label>
                                <div class="relative">
                                    <select id="metodeVerif" name="metodeVerif" required
                                            class="w-full px-4 py-3 form-select-black rounded-lg transition-all duration-200 appearance-none cursor-pointer">
                                        <option value="">Pilih metode verifikasi</option>
                                        <option value="Luring">Luring</option>
                                        <option value="Daring">Daring</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <i class="fas fa-chevron-down text-black"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Jadwal Section -->
                    <div class="rounded-xl p-6 mb-6 animate-fade-in animate-delay-200">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                            <div class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-calendar text-white"></i>
                            </div>
                            Jadwal & Lokasi
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label for="tanggal_asesmen" class="block text-sm font-semibold text-gray-700 flex items-center">
                                    <i class="fas fa-calendar text-gray-400 mr-2 text-xs"></i>
                                    Tanggal Asesmen
                                </label>
                                <div class="relative group">
                                    <input type="text" id="tanggal_asesmen" name="tanggal_asesmen" required
                                           class="w-full px-4 py-3 pl-12 bg-white border-2 border-gray-200 rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 cursor-pointer"
                                           placeholder="Pilih tanggal asesmen" readonly>
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-calendar text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                                    </div>
                                    <div class="absolute inset-0 rounded-lg bg-gradient-to-r from-blue-500/0 to-indigo-500/0 group-focus-within:from-blue-500/5 group-focus-within:to-indigo-500/5 pointer-events-none transition-all duration-300"></div>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label for="tanggal_verifikasi" class="block text-sm font-semibold text-gray-700 flex items-center">
                                    <i class="fas fa-calendar-check text-gray-400 mr-2 text-xs"></i>
                                    Tanggal Verifikasi
                                </label>
                                <div class="relative group">
                                    <input type="text" id="tanggal_verifikasi" name="tanggal_verifikasi" required
                                           class="w-full px-4 py-3 pl-12 bg-white border-2 border-gray-200 rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 cursor-pointer"
                                           placeholder="Pilih tanggal verifikasi" readonly>
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-calendar-check text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                                    </div>
                                    <div class="absolute inset-0 rounded-lg bg-gradient-to-r from-blue-500/0 to-indigo-500/0 group-focus-within:from-blue-500/5 group-focus-within:to-indigo-500/5 pointer-events-none transition-all duration-300"></div>
                                </div>
                            </div>

                            <div class="space-y-2 md:col-span-2">
                                <label for="alamat" class="block text-sm font-semibold text-gray-700 flex items-center">
                                    <i class="fas fa-map-marker-alt text-gray-400 mr-2 text-xs"></i>
                                    Alamat
                                </label>
                                <div class="relative group">
                                    <input type="text" id="alamat" name="alamat" required
                                           class="w-full px-4 py-3 pl-12 bg-white border-2 border-gray-200 rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                                           placeholder="Masukkan alamat lengkap">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-start pt-3.5 pointer-events-none">
                                        <i class="fas fa-map-marker-alt text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                                    </div>
                                    <div class="absolute inset-0 rounded-lg bg-gradient-to-r from-blue-500/0 to-indigo-500/0 group-focus-within:from-blue-500/5 group-focus-within:to-indigo-500/5 pointer-events-none transition-all duration-300"></div>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label for="peserta" class="block text-sm font-semibold text-gray-700 flex items-center">
                                    <i class="fas fa-users text-gray-400 mr-2 text-xs"></i>
                                    Jumlah Peserta
                                </label>
                                <div class="relative group">
                                    <input type="number" id="peserta" name="peserta" required
                                           class="w-full px-4 py-3 pl-12 bg-white border-2 border-gray-200 rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                                           placeholder="Masukkan jumlah peserta">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-users text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                                    </div>
                                    <div class="absolute inset-0 rounded-lg bg-gradient-to-r from-blue-500/0 to-indigo-500/0 group-focus-within:from-blue-500/5 group-focus-within:to-indigo-500/5 pointer-events-none transition-all duration-300"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Personil Section -->
                    <div class="rounded-xl p-6 mb-6 animate-fade-in animate-delay-300">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                            <div class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-users text-white"></i>
                            </div>
                            Personil Terkait
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div class="space-y-2">
                                <label for="met1" class="block text-sm font-semibold text-gray-700 flex items-center">
                                    <i class="fas fa-user-check text-gray-400 mr-2 text-xs"></i>
                                    Validator <span class="text-gray-500 font-normal">(Opsional)</span>
                                </label>
                                <div class="relative group">
                                    <input list="asesor" type="text" id="met1" name="met1"
                                           class="w-full px-4 py-3 pl-12 bg-white border-2 border-gray-200 rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-200"
                                           placeholder="Cari validator...">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-user-check text-gray-400 group-focus-within:text-purple-500 transition-colors"></i>
                                    </div>
                                    <div class="absolute inset-0 rounded-lg bg-gradient-to-r from-purple-500/0 to-pink-500/0 group-focus-within:from-purple-500/5 group-focus-within:to-pink-500/5 pointer-events-none transition-all duration-300"></div>
                                    <datalist id="asesor">
                                        @foreach ($allAsesor as $asesor)
                                            <option value="{{ $asesor->Noreg }}">{{ $asesor->Nama }}</option>
                                        @endforeach
                                    </datalist>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label for="ketua" class="block text-sm font-semibold text-gray-700 flex items-center">
                                    <i class="fas fa-user-tie text-gray-400 mr-2 text-xs"></i>
                                    Ketua TUK
                                </label>
                                <div class="relative group">
                                    <input list="ketua_tuk" type="text" id="ketua" name="ketua_tuk" required
                                           class="w-full px-4 py-3 pl-12 bg-white border-2 border-gray-200 rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-200"
                                           placeholder="Cari ketua TUK...">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-user-tie text-gray-400 group-focus-within:text-purple-500 transition-colors"></i>
                                    </div>
                                    <div class="absolute inset-0 rounded-lg bg-gradient-to-r from-purple-500/0 to-pink-500/0 group-focus-within:from-purple-500/5 group-focus-within:to-pink-500/5 pointer-events-none transition-all duration-300"></div>
                                    <datalist id="ketua_tuk">
                                        @if($ketuaTukList->count() > 0)
                                            @foreach ($ketuaTukList as $ketua)
                                                <option value="{{ $ketua->name }}">{{ $ketua->nama_tuk }}</option>
                                            @endforeach
                                        @endif
                                    </datalist>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label for="asesor" class="block text-sm font-semibold text-gray-700 flex items-center">
                                    <i class="fas fa-user-check text-gray-400 mr-2 text-xs"></i>
                                    Verifikator
                                </label>
                                <div class="relative group">
                                    <input list="asesor" type="text" id="asesor" name="asesor" required
                                           class="w-full px-4 py-3 pl-12 bg-white border-2 border-gray-200 rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-200"
                                           placeholder="Cari verifikator...">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-clipboard-check text-gray-400 group-focus-within:text-purple-500 transition-colors"></i>
                                    </div>
                                    <div class="absolute inset-0 rounded-lg bg-gradient-to-r from-purple-500/0 to-pink-500/0 group-focus-within:from-purple-500/5 group-focus-within:to-pink-500/5 pointer-events-none transition-all duration-300"></div>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label for="admin" class="block text-sm font-semibold text-gray-700 flex items-center">
                                    <i class="fas fa-user-cog text-gray-400 mr-2 text-xs"></i>
                                    Admin TUK
                                </label>
                                <div class="relative group">
                                    <input type="text" id="admin" name="admin" required
                                           class="w-full px-4 py-3 pl-12 bg-white border-2 border-gray-200 rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-200"
                                           placeholder="Masukkan nama admin TUK">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-user-cog text-gray-400 group-focus-within:text-purple-500 transition-colors"></i>
                                    </div>
                                    <div class="absolute inset-0 rounded-lg bg-gradient-to-r from-purple-500/0 to-pink-500/0 group-focus-within:from-purple-500/5 group-focus-within:to-pink-500/5 pointer-events-none transition-all duration-300"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Skema Section -->
                    <div class="rounded-xl p-6 mb-6 animate-fade-in animate-delay-400">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                            <div class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-certificate text-white"></i>
                            </div>
                            Skema Sertifikasi
                        </h3>

                        <div id="skemaContainer" class="space-y-4">
                            <!-- First Skema Group -->
                            <div class="skema-group rounded-lg p-5 hover:border-gray-400 transition-all duration-300 animate-fade-in">
                                <div class="flex items-center justify-between mb-4">
                                    <h4 class="font-semibold text-gray-900 text-lg">Skema #1</h4>
                                    <div class="flex items-center space-x-2 text-xs text-gray-500">
                                        <i class="fas fa-info-circle"></i>
                                        <span>Wajib diisi</span>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    <div class="space-y-2">
                                        <label for="skema1" class="block text-sm font-semibold text-gray-700 flex items-center">
                                            <i class="fas fa-award text-gray-400 mr-2 text-xs"></i>
                                            Skema Sertifikasi
                                        </label>
                                        <div class="relative group">
                                            <input list="jabker" type="text" id="skema1" name="skema[]" required
                                                   class="w-full px-4 py-3 pl-12 bg-white border-2 border-gray-200 rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition-all duration-200"
                                                   placeholder="Pilih skema">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <i class="fas fa-award text-gray-400 group-focus-within:text-amber-500 transition-colors"></i>
                                            </div>
                                            <div class="absolute inset-0 rounded-lg bg-gradient-to-r from-amber-500/0 to-orange-500/0 group-focus-within:from-amber-500/5 group-focus-within:to-orange-500/5 pointer-events-none transition-all duration-300"></div>
                                            <datalist id="jabker">
                                                @foreach ($allJabker as $jabker)
                                                    <option value="{{ $jabker->jabatan_kerja }}">{{ $jabker->id_jabatan_kerja }}</option>
                                                @endforeach
                                            </datalist>
                                        </div>
                                    </div>

                                    <div class="space-y-2">
                                        <label for="jenjang1" class="block text-sm font-semibold text-gray-700 flex items-center">
                                            <i class="fas fa-layer-group text-gray-400 mr-2 text-xs"></i>
                                            Jenjang
                                        </label>
                                        <div class="relative group">
                                            <input type="number" id="jenjang1" name="jenjang[]" required
                                                   class="w-full px-4 py-3 pl-12 bg-white border-2 border-gray-200 rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition-all duration-200"
                                                   placeholder="Masukkan jenjang">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <i class="fas fa-layer-group text-gray-400 group-focus-within:text-amber-500 transition-colors"></i>
                                            </div>
                                            <div class="absolute inset-0 rounded-lg bg-gradient-to-r from-amber-500/0 to-orange-500/0 group-focus-within:from-amber-500/5 group-focus-within:to-orange-500/5 pointer-events-none transition-all duration-300"></div>
                                        </div>
                                    </div>

                                    <div class="space-y-2">
                                        <label for="metode1" class="block text-sm font-semibold text-gray-700 flex items-center">
                                            <i class="fas fa-tasks text-gray-400 mr-2 text-xs"></i>
                                            Metode Asesmen
                                        </label>
                                        <div class="relative group">
                                            <select id="metode1" name="metode[]" required
                                                    class="w-full px-4 py-3 pl-12 bg-white border-2 border-gray-200 rounded-lg text-gray-900 focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition-all duration-200 appearance-none cursor-pointer">
                                                <option value="">Pilih metode</option>
                                                <option value="Observasi">Observasi</option>
                                                <option value="Portofolio">Portofolio</option>
                                                <option value="Observasi & Portofolio">Observasi & Portofolio</option>
                                            </select>
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <i class="fas fa-tasks text-gray-400 group-focus-within:text-amber-500 transition-colors"></i>
                                            </div>
                                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                <i class="fas fa-chevron-down text-gray-400 group-focus-within:text-amber-500 transition-colors"></i>
                                            </div>
                                            <div class="absolute inset-0 rounded-lg bg-gradient-to-r from-amber-500/0 to-orange-500/0 group-focus-within:from-amber-500/5 group-focus-within:to-orange-500/5 pointer-events-none transition-all duration-300"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="button" id="addSkemaBtn"
                                class="mt-6 group relative inline-flex items-center space-x-3 px-6 py-3 bg-gray-800 hover:bg-gray-700 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></div>
                            <i class="fas fa-plus-circle relative"></i>
                            <span class="relative">Tambah Skema</span>
                        </button>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-center pt-6">
                        <button type="submit"
                                class="group relative inline-flex items-center space-x-3 px-10 py-4 bg-gray-800 hover:bg-gray-700 text-white font-bold text-lg rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></div>
                            <i class="fas fa-save relative text-xl"></i>
                            <span class="relative">Simpan Data Verifikasi</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

    <!-- PDF Modal -->
    <div id="pdfModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-2xl shadow-2xl max-w-5xl w-full max-h-[90vh] overflow-hidden transform transition-all">
                <div class="bg-gray-800 p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-white/20 backdrop-blur rounded-xl flex items-center justify-center">
                                <i class="fas fa-file-pdf text-white text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-white">Preview Dokumen</h3>
                                <p class="text-gray-300 text-sm">Lihat dokumen sebelum menyimpan</p>
                            </div>
                        </div>
                        <button onclick="closeModal()" class="p-3 hover:bg-white/20 backdrop-blur rounded-xl transition-all duration-200 group">
                            <i class="fas fa-times text-white text-xl group-hover:rotate-90 transition-transform duration-300"></i>
                        </button>
                    </div>
                </div>
                <div class="p-6 bg-gray-50">
                    <iframe id="pdfViewer" src="" width="100%" height="600px" class="rounded-xl shadow-inner border-2 border-gray-200 bg-white"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Font Awesome with multiple fallbacks -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Bootstrap Icons as fallback -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        /* Icon fallback styles */
        .icon-fallback {
            display: inline-block;
            width: 1em;
            height: 1em;
            text-align: center;
        }

        /* Simple icon indicators when Font Awesome fails */
        .fa-info-circle::before { content: "ℹ"; }
        .fa-hashtag::before { content: "#"; }
        .fa-building::before { content: "🏢"; }
        .fa-layer-group::before { content: "☰"; }
        .fa-tasks::before { content: "✓"; }
        .fa-calendar::before { content: "📅"; }
        .fa-calendar-check::before { content: "✓"; }
        .fa-map-marker-alt::before { content: "📍"; }
        .fa-users::before { content: "👥"; }
        .fa-user-check::before { content: "✓"; }
        .fa-user-tie::before { content: "👤"; }
        .fa-user-cog::before { content: "⚙"; }
        .fa-certificate::before { content: "🏆"; }
        .fa-award::before { content: "🎖"; }
        .fa-chevron-down::before { content: "▼"; }
        .fa-plus-circle::before { content: "+"; }
        .fa-save::before { content: "💾"; }
        .fa-trash::before { content: "✕"; }
        .fa-file-pdf::before { content: "📄"; }
        .fa-file-lines::before { content: "📄"; }
        .fa-info::before { content: "ℹ"; }
    </style>

    <script>
        // Force icon display
        document.addEventListener('DOMContentLoaded', function() {
            // Test Font Awesome
            const testIcon = document.createElement('i');
            testIcon.className = 'fas fa-test';
            testIcon.style.display = 'none';
            document.body.appendChild(testIcon);

            setTimeout(() => {
                const styles = window.getComputedStyle(testIcon);
                if (!styles.fontFamily.includes('Font Awesome')) {
                    console.log('Font Awesome not loaded, using fallback');
                    document.body.classList.add('no-fa');
                }
                document.body.removeChild(testIcon);
            }, 100);
        });
    </script>

    <!-- Flatpickr CSS for modern datepicker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        /* Custom Flatpickr styling to match gray-800 theme */
        .flatpickr-calendar {
            border-radius: 12px;
            box-shadow: 0 20px 25px -5px rgba(31, 41, 55, 0.15), 0 10px 10px -5px rgba(31, 41, 55, 0.1);
            border: 1px solid rgba(31, 41, 55, 0.2);
            background: white;
        }

        .flatpickr-months {
            background: linear-gradient(to bottom, #1f2937, #374151);
            border-radius: 12px 12px 0 0;
        }

        .flatpickr-month {
            background: transparent;
            color: white;
            fill: white;
        }

        .flatpickr-current-month {
            color: white !important;
            background: transparent;
        }

        .flatpickr-current-month .numInputWrapper {
            background: rgba(255, 255, 255, 0.1);
            color: white !important;
            border-radius: 6px;
        }

        .flatpickr-current-month .cur-year,
        .flatpickr-current-month .cur-month {
            color: white !important;
            font-weight: 600;
        }

        .flatpickr-current-month input {
            color: white !important;
            background: transparent !important;
        }

        .flatpickr-current-month .numInputWrapper span.arrowUp:after,
        .flatpickr-current-month .numInputWrapper span.arrowDown:after {
            border-color: white !important;
        }

        .flatpickr-weekday {
            color: #6b7280;
            font-weight: 600;
        }

        .flatpickr-day {
            color: #374151;
            border-radius: 8px;
            transition: all 0.2s;
            font-weight: 500;
        }

        .flatpickr-day:hover {
            background: #1f2937 !important;
            color: white !important;
            border-color: #1f2937;
            transform: scale(1.05);
        }

        .flatpickr-day.selected {
            background: #1f2937 !important;
            color: white !important;
            border-color: #374151;
            font-weight: 600;
        }

        .flatpickr-day.today {
            border-color: #1f2937;
            font-weight: 600;
        }

        .flatpickr-day.startRange,
        .flatpickr-day.endRange {
            background: #1f2937 !important;
            color: white !important;
        }

        .flatpickr-months .flatpickr-prev-month,
        .flatpickr-months .flatpickr-next-month {
            color: white;
            fill: white;
        }

        .flatpickr-months .flatpickr-prev-month:hover,
        .flatpickr-months .flatpickr-next-month:hover {
            color: #e5e7eb;
            fill: #e5e7eb;
        }

        /* Animations */
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

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slideDown {
            animation: slideDown 0.5s ease-out;
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out;
        }

        /* Success message auto-hide */
        @keyframes fadeOut {
            from {
                opacity: 1;
                transform: translateX(0);
            }
            to {
                opacity: 0;
                transform: translateX(20px);
            }
        }

        .auto-hide {
            animation: fadeOut 0.5s ease-out forwards;
            animation-delay: 5s;
        }
    </style>

    <script>
        let skemaCount = 1;

        // Auto-hide success message
        document.addEventListener('DOMContentLoaded', function() {
            const successAlert = document.getElementById('successAlert');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.classList.add('auto-hide');
                    setTimeout(() => {
                        successAlert.remove();
                    }, 500);
                }, 5000);
            }
        });

        // Add new skema fields
        document.getElementById('addSkemaBtn').addEventListener('click', function() {
            skemaCount++;
            const container = document.getElementById('skemaContainer');

            const newField = document.createElement('div');
            newField.className = 'skema-group rounded-lg p-5 hover:border-gray-400 transition-all duration-300 animate-fade-in';
            newField.innerHTML = `
                <div class="flex items-center justify-between mb-4">
                    <h4 class="font-bold text-gray-900 text-lg flex items-center">
                        <i class="fas fa-layer-group text-gray-700 mr-2"></i>
                        Skema #${skemaCount}
                    </h4>
                    <button type="button" onclick="removeSkema(this)" class="p-2 text-red-500 hover:text-red-700 hover:bg-red-50 rounded-lg transition-all duration-200">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="space-y-2">
                        <label for="skema${skemaCount}" class="block text-sm font-semibold text-gray-700 flex items-center">
                            <i class="fas fa-award text-gray-400 mr-2 text-xs"></i>
                            Skema Sertifikasi
                        </label>
                        <div class="relative group">
                            <input list="jabker" type="text" id="skema${skemaCount}" name="skema[]" required
                                   class="w-full px-4 py-3 pl-12 bg-white border-2 border-gray-200 rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition-all duration-200"
                                   placeholder="Pilih skema">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-award text-gray-400 group-focus-within:text-amber-500 transition-colors"></i>
                            </div>
                            <div class="absolute inset-0 rounded-lg bg-gradient-to-r from-amber-500/0 to-orange-500/0 group-focus-within:from-amber-500/5 group-focus-within:to-orange-500/5 pointer-events-none transition-all duration-300"></div>
                            <datalist id="jabker">
                                @foreach ($allJabker as $jabker)
                                    <option value="{{ $jabker->jabatan_kerja }}">{{ $jabker->id_jabatan_kerja }}</option>
                                @endforeach
                            </datalist>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="jenjang${skemaCount}" class="block text-sm font-semibold text-gray-700 flex items-center">
                            <i class="fas fa-layer-group text-gray-400 mr-2 text-xs"></i>
                            Jenjang
                        </label>
                        <div class="relative group">
                            <input type="number" id="jenjang${skemaCount}" name="jenjang[]" required
                                   class="w-full px-4 py-3 pl-12 bg-white border-2 border-gray-200 rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition-all duration-200"
                                   placeholder="Masukkan jenjang">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-layer-group text-gray-400 group-focus-within:text-amber-500 transition-colors"></i>
                            </div>
                            <div class="absolute inset-0 rounded-lg bg-gradient-to-r from-amber-500/0 to-orange-500/0 group-focus-within:from-amber-500/5 group-focus-within:to-orange-500/5 pointer-events-none transition-all duration-300"></div>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="metode${skemaCount}" class="block text-sm font-semibold text-gray-700 flex items-center">
                            <i class="fas fa-tasks text-gray-400 mr-2 text-xs"></i>
                            Metode Asesmen
                        </label>
                        <div class="relative group">
                            <select id="metode${skemaCount}" name="metode[]" required
                                    class="w-full px-4 py-3 pl-12 bg-white border-2 border-gray-200 rounded-lg text-gray-900 focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition-all duration-200 appearance-none cursor-pointer">
                                <option value="">Pilih metode</option>
                                <option value="Observasi">Observasi</option>
                                <option value="Portofolio">Portofolio</option>
                                <option value="Observasi & Portofolio">Observasi & Portofolio</option>
                            </select>
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-tasks text-gray-400 group-focus-within:text-amber-500 transition-colors"></i>
                            </div>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <i class="fas fa-chevron-down text-gray-400 group-focus-within:text-amber-500 transition-colors"></i>
                            </div>
                            <div class="absolute inset-0 rounded-lg bg-gradient-to-r from-amber-500/0 to-orange-500/0 group-focus-within:from-amber-500/5 group-focus-within:to-orange-500/5 pointer-events-none transition-all duration-300"></div>
                        </div>
                    </div>
                </div>
            `;

            container.appendChild(newField);
        });

        // Remove skema field
        function removeSkema(button) {
            const skemaGroup = button.closest('.skema-group');
            skemaGroup.style.transform = 'translateX(20px)';
            skemaGroup.style.opacity = '0';
            skemaGroup.style.transition = 'all 0.3s ease-out';
            setTimeout(() => {
                skemaGroup.remove();
            }, 300);
        }

        // Modal functions
        function openModal(pdfUrl) {
            const modal = document.getElementById('pdfModal');
            const pdfViewer = document.getElementById('pdfViewer');
            pdfViewer.src = pdfUrl;
            modal.classList.remove('hidden');
        }

        function closeModal() {
            const modal = document.getElementById('pdfModal');
            const pdfViewer = document.getElementById('pdfViewer');
            pdfViewer.src = '';
            modal.classList.add('hidden');
        }

        // Enhanced autocomplete for ketua TUK
        const ketuaInput = document.getElementById('ketua');
        const ketuaDatalist = document.getElementById('ketua_tuk');

        ketuaInput.addEventListener('input', function() {
            const selectedValue = this.value;
            const options = ketuaDatalist.querySelectorAll('option');

            options.forEach(option => {
                if (option.value === selectedValue) {
                    this.setAttribute('data-tuk-name', option.textContent);
                }
            });
        });

        ketuaInput.addEventListener('change', function() {
            if (this.value && !this.getAttribute('data-tuk-name')) {
                const options = ketuaDatalist.querySelectorAll('option');
                for (let option of options) {
                    if (option.value.toLowerCase() === this.value.toLowerCase()) {
                        this.setAttribute('data-tuk-name', option.textContent);
                        break;
                    }
                }
            }
        });

        // Close modal on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        // Close modal on background click
        document.getElementById('pdfModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>

    <!-- Flatpickr JS for modern datepicker -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>

    <script>
        // Initialize Flatpickr datepickers
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize datepickers
            flatpickr("#tanggal_asesmen", {
                locale: "id",
                dateFormat: "Y-m-d",
                clickOpens: true,
                animate: true,
                disableMobile: "true"
            });

            flatpickr("#tanggal_verifikasi", {
                locale: "id",
                dateFormat: "Y-m-d",
                clickOpens: true,
                animate: true,
                disableMobile: "true"
            });
        });
    </script>
@endsection