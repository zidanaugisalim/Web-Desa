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
                            <h3 class="text-lg font-semibold">Selamat datang, {{ Auth::user()->name }}!</h3>
                            <a href="{{ route('anak.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 active:bg-green-600 disabled:opacity-25 transition">
                                <i class="fas fa-plus mr-2"></i> Tambah Data Anak
                            </a>
                        </div>

                        @if(session('success'))
                            <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                                <p class="font-bold">Sukses!</p>
                                <p>{{ session('success') }}</p>
                            </div>
                        @endif

                        <!-- Tabel Data Anak -->
                        <div class="mt-8">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Daftar Data Anak</h4>
                            @if($anak->count() > 0)
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lengkap</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIK</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Kelamin</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Lahir</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($anak as $item)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-10 w-10">
                                                                @if($item->foto_anak)
                                                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/' . $item->foto_anak) }}" alt="{{ $item->nama }}">
                                                                @else
                                                                    <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                                        <i class="fas fa-user text-gray-400"></i>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">{{ $item->nama }}</div>
                                                                <div class="text-sm text-gray-500">{{ $item->nama_ayah }} (Ayah) / {{ $item->nama_ibu }} (Ibu)</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ $item->nik }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $item->jenis_kelamin == 'L' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                                            {{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d/m/Y') }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                        <a href="{{ route('anak.show', $item->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                                            <i class="fas fa-eye"></i> Lihat
                                                        </a>
                                                        <a href="{{ route('anak.edit', $item->id) }}" class="text-yellow-600 hover:text-yellow-900 mr-3">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                        <form action="{{ route('anak.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-600 hover:text-red-900">
                                                                <i class="fas fa-trash"></i> Hapus
                                                            </button>
                                                        </form>
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
