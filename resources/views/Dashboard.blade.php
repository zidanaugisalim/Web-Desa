<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8fafc;
            transition: background-color 0.3s, color 0.3s;
        }

        .dark {
            background-color: #1a1a1a;
            color: #ffffff;
        }

        .dark .bg-gray-800 {
            background-color: #000000;
        }

        .dark .bg-white {
            background-color: #2c2c2c;
        }

        .dark .text-gray-800 {
            color: #ffffff;
        }
    </style>
</head>

<body class="m-0 p-0">
    <div class="bg-gray-800 text-white fixed w-full z-10 top-0">
        <div class="max-w-6xl mx-auto flex justify-between items-center p-4">
            <div class="flex items-center space-x-2">
                <i class="fas fa-user"></i>
                <span>Selamat Datang, {{ Auth::user()->name }}</span>
            </div>
            <div class="flex items-center space-x-4">
                <div>
                    <i class="fas fa-clock"></i>
                    <span id="current-time"></span>
                </div>
                <div>
                    <i class="fas fa-calendar"></i>
                    <span id="current-date"></span>
                </div>
                <div>
                    <i class="fas fa-moon cursor-pointer" id="theme-switch"></i>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="ml-4">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-1 rounded-md text-sm">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>

    <!-- Page Content -->
    <main>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900">Selamat datang, {{ Auth::user()->name }}!</h3>
                                <p class="text-gray-600 mt-1">Kelola data anak dan pantau perkembangan gizi mereka</p>
                            </div>
                            <a href="{{ route('anak.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wider hover:from-green-600 hover:to-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transform hover:scale-105 transition-all duration-200 shadow-lg">
                                <i class="fas fa-plus mr-2"></i> Tambah Data Anak
                            </a>
                        </div>

                        @if(session('success'))
                            <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4 shadow-sm" role="alert">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-check-circle text-green-400 text-xl"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Dashboard Statistics -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                            <!-- Total Data Anak -->
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 border border-blue-200 shadow-sm hover:shadow-md transition-shadow duration-200">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-users text-white text-xl"></i>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-blue-600">Total Data Anak</p>
                                        <p class="text-2xl font-bold text-blue-900">{{ $anak->total() }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Gizi Baik -->
                            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 border border-green-200 shadow-sm hover:shadow-md transition-shadow duration-200">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-heart text-white text-xl"></i>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-green-600">Gizi Baik</p>
                                        <p class="text-2xl font-bold text-green-900">
                                            @php
                                                $giziBaik = $anak->filter(function($item) {
                                                    if ($item->berat_badan && $item->tinggi_badan && $item->tinggi_badan > 0) {
                                                        $tinggi_m = $item->tinggi_badan / 100;
                                                        $imt = $item->berat_badan / ($tinggi_m * $tinggi_m);
                                                        return $imt >= 18.5 && $imt < 25;
                                                    }
                                                    return false;
                                                })->count();
                                            @endphp
                                            {{ $giziBaik }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Perlu Perhatian -->
                            <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-xl p-6 border border-yellow-200 shadow-sm hover:shadow-md transition-shadow duration-200">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 bg-yellow-500 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-exclamation-triangle text-white text-xl"></i>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-yellow-600">Perlu Perhatian</p>
                                        <p class="text-2xl font-bold text-yellow-900">
                                            @php
                                                $perluPerhatian = $anak->filter(function($item) {
                                                    if ($item->berat_badan && $item->tinggi_badan && $item->tinggi_badan > 0) {
                                                        $tinggi_m = $item->tinggi_badan / 100;
                                                        $imt = $item->berat_badan / ($tinggi_m * $tinggi_m);
                                                        return $imt < 18.5 || $imt >= 25;
                                                    }
                                                    return false;
                                                })->count();
                                            @endphp
                                            {{ $perluPerhatian }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Data Bulan Ini -->
                            <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-6 border border-purple-200 shadow-sm hover:shadow-md transition-shadow duration-200">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 bg-purple-500 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-calendar-plus text-white text-xl"></i>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-purple-600">Data Bulan Ini</p>
                                        <p class="text-2xl font-bold text-purple-900">
                                            {{ $anak->filter(function($item) {
                                                return $item->created_at->isCurrentMonth();
                                            })->count() }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tabel Data Anak -->
                        <div class="mt-8">
                            <div class="flex justify-between items-center mb-6">
                                <h4 class="text-xl font-bold text-gray-900">Daftar Data Anak</h4>
                                <div class="flex space-x-3">
                                    <button class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                        <i class="fas fa-download mr-2"></i> Export
                                    </button>
                                    <button class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                        <i class="fas fa-filter mr-2"></i> Filter
                                    </button>
                                </div>
                            </div>
                            @if($anak->count() > 0)
                                <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                                <tr>
                                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Lengkap</th>
                                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">NIK</th>
                                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jenis Kelamin</th>
                                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal Lahir</th>
                                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status Gizi</th>
                                                    <th scope="col" class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                                                </tr>
                                            </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($anak as $item)
                                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-12 w-12">
                                                                @if($item->foto_anak)
                                                                    <img class="h-12 w-12 rounded-full object-cover border-2 border-gray-200 shadow-sm" src="{{ asset('storage/' . $item->foto_anak) }}" alt="{{ $item->nama }}">
                                                                @else
                                                                    <div class="h-12 w-12 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center border-2 border-gray-200 shadow-sm">
                                                                        <i class="fas fa-user text-gray-400 text-lg"></i>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="ml-4">
                                                                <div class="text-sm font-semibold text-gray-900">{{ $item->nama }}</div>
                                                                <div class="text-xs text-gray-500 mt-1">
                                                                    <span class="inline-flex items-center">
                                                                        <i class="fas fa-male text-blue-400 mr-1"></i>
                                                                        {{ $item->nama_ayah }}
                                                                    </span>
                                                                    <span class="mx-2">•</span>
                                                                    <span class="inline-flex items-center">
                                                                        <i class="fas fa-female text-pink-400 mr-1"></i>
                                                                        {{ $item->nama_ibu }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm font-medium text-gray-900">{{ $item->nik }}</div>
                                                        <div class="text-xs text-gray-500">NIK</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $item->jenis_kelamin == 'L' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                                            <i class="fas {{ $item->jenis_kelamin == 'L' ? 'fa-mars' : 'fa-venus' }} mr-1"></i>
                                                            {{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d/m/Y') }}</div>
                                                        <div class="text-xs text-gray-500">
                                                            {{ \Carbon\Carbon::parse($item->tanggal_lahir)->diffForHumans() }}
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @if($item->berat_badan && $item->tinggi_badan && $item->tinggi_badan > 0)
                                                            @php
                                                                $tinggi_m = $item->tinggi_badan / 100; // Konversi cm ke m
                                                                $imt = round($item->berat_badan / ($tinggi_m * $tinggi_m), 2);
                                                                
                                                                // Kategori IMT berdasarkan KMS (Kartu Menuju Sehat)
                                                                $kategori = '';
                                                                $warna = '';
                                                                $icon = '';
                                                                
                                                                // Pengelompokan berdasarkan KMS
                                                                if ($imt < 17) {
                                                                    $kategori = 'Gizi Buruk';
                                                                    $warna = 'bg-red-100 text-red-800 border-red-200';
                                                                    $icon = 'fa-exclamation-triangle';
                                                                } elseif ($imt >= 17 && $imt < 18.5) {
                                                                    $kategori = 'Gizi Kurang';
                                                                    $warna = 'bg-yellow-100 text-yellow-800 border-yellow-200';
                                                                    $icon = 'fa-exclamation-circle';
                                                                } elseif ($imt >= 18.5 && $imt < 25) {
                                                                    $kategori = 'Gizi Baik';
                                                                    $warna = 'bg-green-100 text-green-800 border-green-200';
                                                                    $icon = 'fa-check-circle';
                                                                } else {
                                                                    $kategori = 'Gizi Lebih';
                                                                    $warna = 'bg-orange-100 text-orange-800 border-orange-200';
                                                                    $icon = 'fa-info-circle';
                                                                }
                                                            @endphp
                                                            <div class="space-y-1">
                                                                <div class="text-sm font-semibold text-gray-900">IMT: {{ $imt }}</div>
                                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $warna }}">
                                                                    <i class="fas {{ $icon }} mr-1"></i>
                                                                    {{ $kategori }}
                                                                </span>
                                                            </div>
                                                        @else
                                                            <div class="space-y-1">
                                                                <div class="text-sm text-gray-400">Data tidak lengkap</div>
                                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600 border border-gray-200">
                                                                    <i class="fas fa-question-circle mr-1"></i>
                                                                    Belum diukur
                                                                </span>
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                                        <div class="flex justify-center space-x-2">
                                                            <a href="{{ route('anak.show', $item->id) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-100 text-blue-700 text-xs font-medium rounded-lg hover:bg-blue-200 transition-colors duration-150" title="Lihat Detail">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="{{ route('anak.edit', $item->id) }}" class="inline-flex items-center px-3 py-1.5 bg-yellow-100 text-yellow-700 text-xs font-medium rounded-lg hover:bg-yellow-200 transition-colors duration-150" title="Edit Data">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <form action="{{ route('anak.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 text-xs font-medium rounded-lg hover:bg-red-200 transition-colors duration-150" title="Hapus Data">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-4">
                                    {{ $anak->links() }}
                                </div>
                            @else
                                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-exclamation-circle text-yellow-400"></i>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm text-yellow-700">
                                                Belum ada data anak. <a href="{{ route('anak.create') }}" class="font-medium underline text-yellow-700 hover:text-yellow-600">Tambah data anak</a> untuk memulai.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    // Fungsi untuk toggle tema gelap/terang
    const themeSwitch = document.getElementById('theme-switch');
    const body = document.body;
    let isDarkMode = localStorage.getItem('darkMode') === 'true';

    // Terapkan tema saat halaman dimuat
    if (isDarkMode) {
        body.classList.add('dark');
        themeSwitch.className = 'fas fa-sun cursor-pointer';
    } else {
        themeSwitch.className = 'fas fa-moon cursor-pointer';
    }

    // Toggle tema saat ikon diklik
    themeSwitch.addEventListener('click', () => {
        isDarkMode = !isDarkMode;
        body.classList.toggle('dark', isDarkMode);
        themeSwitch.className = isDarkMode ? 'fas fa-sun cursor-pointer' : 'fas fa-moon cursor-pointer';
        
        // Simpan preferensi tema ke localStorage
        localStorage.setItem('darkMode', isDarkMode);
    });

    // Fungsi untuk menampilkan waktu dan tanggal
    function updateDateTime() {
        const now = new Date();
        const timeElement = document.getElementById('current-time');
        const dateElement = document.getElementById('current-date');

        const time = now.toLocaleTimeString('id-ID', {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });

        const date = now.toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });

        if (timeElement) timeElement.textContent = time;
        if (dateElement) dateElement.textContent = date;
    }

    // Perbarui waktu setiap detik
    setInterval(updateDateTime, 1000);
    updateDateTime(); // Panggil sekali saat halaman dimuat
</script>

</body>
</html>
