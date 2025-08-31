@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Arsip Data Anak</h1>
                    <p class="text-gray-600">Data anak yang sudah berumur 5 tahun atau lebih</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wider hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transform hover:scale-105 transition-all duration-200 shadow-lg">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>

        <!-- Statistik Arsip -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <i class="fas fa-archive text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-700">Total Arsip</h3>
                        <p class="text-3xl font-bold text-blue-600">{{ $anakArsip->total() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <i class="fas fa-calendar-check text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-700">Diarsipkan Bulan Ini</h3>
                        <p class="text-3xl font-bold text-green-600">
                            {{ $anakArsip->filter(function($item) {
                                return $item->archived_at && $item->archived_at->isCurrentMonth();
                            })->count() }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                        <i class="fas fa-birthday-cake text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-700">Rata-rata Umur</h3>
                        <p class="text-3xl font-bold text-purple-600">
                            {{ $anakArsip->count() > 0 ? round($anakArsip->avg('umur'), 1) : 0 }} tahun
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Data Arsip -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Daftar Anak yang Diarsipkan</h3>
            </div>
            
            @if($anakArsip->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIK</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Lahir</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Umur</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Gizi Terakhir</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Diarsipkan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($anakArsip as $index => $anak)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ ($anakArsip->currentPage() - 1) * $anakArsip->perPage() + $index + 1 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                @if($anak->foto_anak)
                                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ Storage::url($anak->foto_anak) }}" alt="{{ $anak->nama }}">
                                                @else
                                                    <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                                        <i class="fas fa-user text-gray-500"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $anak->nama }}</div>
                                                <div class="text-sm text-gray-500">{{ $anak->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $anak->nik }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $anak->tanggal_lahir ? $anak->tanggal_lahir->format('d/m/Y') : '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $anak->umur }} tahun
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        @if($anak->status_gizi)
                                            @php
                                                $statusClass = match($anak->status_gizi) {
                                                    'Normal' => 'bg-green-100 text-green-800',
                                                    'Gizi Kurang' => 'bg-yellow-100 text-yellow-800',
                                                    'Gizi Buruk' => 'bg-red-100 text-red-800',
                                                    'Gizi Lebih' => 'bg-purple-100 text-purple-800',
                                                    default => 'bg-gray-100 text-gray-800'
                                                };
                                            @endphp
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClass }}">
                                                {{ $anak->status_gizi }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                Belum Diperiksa
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $anak->archived_at ? $anak->archived_at->format('d/m/Y') : '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('anak.show', $anak->id) }}" class="text-indigo-600 hover:text-indigo-900 transition-colors duration-200">
                                                <i class="fas fa-eye"></i> Lihat
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $anakArsip->links() }}
                </div>
            @else
                <div class="px-6 py-12 text-center">
                    <div class="mx-auto h-24 w-24 text-gray-400 mb-4">
                        <i class="fas fa-archive text-6xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Data Arsip</h3>
                    <p class="text-gray-500">Belum ada anak yang diarsipkan. Anak akan otomatis diarsipkan ketika berumur 5 tahun.</p>
                </div>
            @endif
        </div>

        <!-- Info Otomatisasi -->
        <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-6">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle text-blue-400 text-xl"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">Informasi Arsip Otomatis</h3>
                    <div class="mt-2 text-sm text-blue-700">
                        <p>Sistem akan otomatis memindahkan anak ke arsip ketika:</p>
                        <ul class="list-disc list-inside mt-1 space-y-1">
                            <li>Anak sudah berumur 5 tahun atau lebih</li>
                            <li>Data akan tetap tersimpan dan dapat dilihat di halaman arsip ini</li>
                            <li>Anak yang diarsipkan tidak akan muncul di dashboard utama</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection