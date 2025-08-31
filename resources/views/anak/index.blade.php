@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Data Anak</h1>
                <p class="text-gray-600">Kelola data anak untuk monitoring gizi dan kesehatan</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('anak.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 flex items-center">
                    <i class="fas fa-plus mr-2"></i>Tambah Anak
                </a>
                <a href="{{ route('grafik.dashboard') }}" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 flex items-center">
                    <i class="fas fa-chart-bar mr-2"></i>Lihat Grafik
                </a>
            </div>
        </div>

        <!-- Filter dan Search -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <form method="GET" action="{{ route('anak.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Cari Nama/NIK</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                           placeholder="Masukkan nama atau NIK...">
                </div>
                <div>
                    <label for="status_gizi" class="block text-sm font-medium text-gray-700 mb-2">Status Gizi</label>
                    <select name="status_gizi" id="status_gizi" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Status</option>
                        <option value="Normal" {{ request('status_gizi') == 'Normal' ? 'selected' : '' }}>Normal</option>
                        <option value="Gizi Kurang" {{ request('status_gizi') == 'Gizi Kurang' ? 'selected' : '' }}>Gizi Kurang</option>
                        <option value="Gizi Buruk" {{ request('status_gizi') == 'Gizi Buruk' ? 'selected' : '' }}>Gizi Buruk</option>
                        <option value="Gizi Lebih" {{ request('status_gizi') == 'Gizi Lebih' ? 'selected' : '' }}>Gizi Lebih</option>
                    </select>
                </div>
                <div>
                    <label for="posyandu" class="block text-sm font-medium text-gray-700 mb-2">Posyandu</label>
                    <input type="text" name="posyandu" id="posyandu" value="{{ request('posyandu') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                           placeholder="Nama posyandu...">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <i class="fas fa-search mr-2"></i>Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Statistik Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <i class="fas fa-child text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-700">Total Anak</h3>
                        <p class="text-3xl font-bold text-blue-600">{{ $totalAnak ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <i class="fas fa-heart text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-700">Gizi Normal</h3>
                        <p class="text-3xl font-bold text-green-600">{{ $giziNormal ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                        <i class="fas fa-exclamation-triangle text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-700">Gizi Kurang</h3>
                        <p class="text-3xl font-bold text-yellow-600">{{ $giziKurang ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-red-100 text-red-600">
                        <i class="fas fa-exclamation-circle text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-700">Gizi Buruk</h3>
                        <p class="text-3xl font-bold text-red-600">{{ $giziBuruk ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Data Anak -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Daftar Anak</h2>
            </div>
            
            @if(isset($anak) && $anak->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIK</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Umur</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Gizi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Posyandu</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vitamin A</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($anak as $child)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                                    <i class="fas fa-child text-blue-600"></i>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $child->nama }}</div>
                                                <div class="text-sm text-gray-500">{{ $child->jenis_kelamin }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $child->nik }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if($child->tanggal_lahir)
                                            {{ \Carbon\Carbon::parse($child->tanggal_lahir)->age }} tahun
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($child->status_gizi)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $child->status_gizi === 'Normal' ? 'bg-green-100 text-green-800' : 
                                                   ($child->status_gizi === 'Gizi Kurang' ? 'bg-yellow-100 text-yellow-800' : 
                                                   ($child->status_gizi === 'Gizi Buruk' ? 'bg-red-100 text-red-800' : 
                                                   'bg-purple-100 text-purple-800')) }}">
                                                {{ $child->status_gizi }}
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                Belum Diperiksa
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $child->posyandu ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex space-x-1">
                                            @if($child->vitamin_a_1_diberikan ?? false)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    V1 ✓
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    V1 ✗
                                                </span>
                                            @endif
                                            
                                            @if($child->vitamin_a_2_diberikan ?? false)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    V2 ✓
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    V2 ✗
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('anak.show', $child->id) }}" class="text-blue-600 hover:text-blue-900">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('anak.edit', $child->id) }}" class="text-yellow-600 hover:text-yellow-900">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('grafik.kms-bulanan', ['anak_id' => $child->id]) }}" class="text-green-600 hover:text-green-900">
                                                <i class="fas fa-chart-line"></i>
                                            </a>
                                            <form action="{{ route('anak.destroy', $child->id) }}" method="POST" class="inline" 
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">
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
                
                <!-- Pagination -->
                @if(method_exists($anak, 'links'))
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $anak->appends(request()->query())->links() }}
                    </div>
                @endif
            @else
                <div class="px-6 py-12 text-center">
                    <div class="mx-auto h-12 w-12 text-gray-400">
                        <i class="fas fa-child text-4xl"></i>
                    </div>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada data anak</h3>
                    <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan data anak pertama.</p>
                    <div class="mt-6">
                        <a href="{{ route('anak.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Anak
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection