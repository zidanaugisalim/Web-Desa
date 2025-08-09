@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Detail Data Anak</h2>
                <div class="space-x-2">
                    <a href="{{ route('anak.edit', $anak->id) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                        <i class="fas fa-edit mr-2"></i> Edit
                    </a>
                    <form action="{{ route('anak.destroy', $anak->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <i class="fas fa-trash mr-2"></i> Hapus
                        </button>
                    </form>
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p class="font-bold">Sukses!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Kolom Kiri -->
                <div>
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Informasi Pribadi</h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nama Lengkap</p>
                                <p class="mt-1">{{ $anak->nama }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">NIK</p>
                                <p class="mt-1">{{ $anak->nik }}</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Tempat Lahir</p>
                                    <p class="mt-1">{{ $anak->tempat_lahir }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Tanggal Lahir</p>
                                    <p class="mt-1">{{ \Carbon\Carbon::parse($anak->tanggal_lahir)->format('d/m/Y') }}</p>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Jenis Kelamin</p>
                                <p class="mt-1">{{ $anak->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nama Orang Tua</p>
                                <p class="mt-1">{{ $anak->nama_ayah }} (Ayah) / {{ $anak->nama_ibu }} (Ibu)</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">No. Telepon</p>
                                <p class="mt-1">{{ $anak->no_telepon }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Alamat</h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Alamat Lengkap</p>
                                <p class="mt-1">{{ $anak->alamat }}</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">RT/RW</p>
                                    <p class="mt-1">{{ $anak->rt_rw }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Kode Pos</p>
                                    <p class="mt-1">{{ $anak->kode_pos }}</p>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Desa/Kelurahan</p>
                                <p class="mt-1">{{ $anak->desa ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Kecamatan</p>
                                <p class="mt-1">{{ $anak->kecamatan }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Kabupaten/Kota</p>
                                <p class="mt-1">{{ $anak->kabupaten }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Provinsi</p>
                                <p class="mt-1">{{ $anak->provinsi }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Puskesmas</p>
                                <p class="mt-1">{{ $anak->puskesmas ?? 'SEWON II' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Posyandu</p>
                                <p class="mt-1">{{ $anak->posyandu ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Tanggal Pengukuran</p>
                                <p class="mt-1">{{ $anak->tanggal_pengukuran ? $anak->tanggal_pengukuran->format('d/m/Y') : '-' }}</p>
                            </div>
                        </div>
                    </div>

                    @if($anak->catatan_khusus)
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Catatan Khusus</h3>
                        <p class="whitespace-pre-line">{{ $anak->catatan_khusus }}</p>
                    </div>
                    @endif
                </div>

            </div>

            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Dibuat pada: {{ $anak->created_at->format('d/m/Y H:i') }}</p>
                        @if($anak->created_at != $anak->updated_at)
                            <p class="text-sm text-gray-500">Diperbarui pada: {{ $anak->updated_at->format('d/m/Y H:i') }}</p>
                        @endif
                    </div>
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
