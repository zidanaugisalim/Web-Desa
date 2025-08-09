@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold mb-6">Tambah Data Anak</h2>
            
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                    <p class="font-bold">Perhatian!</p>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form action="{{ route('anak.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" onsubmit="console.log('Form submitted:', Object.fromEntries(new FormData(this)));">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kolom Kiri -->
                    <div>
                        <div class="mb-4">
                            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama" value="{{ old('nama') }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" required>
                            @error('nama')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                            <input type="text" name="nik" id="nik" value="{{ old('nik') }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" required>
                            @error('nik')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir') }}" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" required>
                                @error('tempat_lahir')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" required>
                                @error('tanggal_lahir')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                            <div class="mt-2 space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="jenis_kelamin" value="L" class="text-green-600 focus:ring-green-500" 
                                        {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }} required>
                                    <span class="ml-2">Laki-laki</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="jenis_kelamin" value="P" class="text-green-600 focus:ring-green-500"
                                        {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }} required>
                                    <span class="ml-2">Perempuan</span>
                                </label>
                            </div>
                            @error('jenis_kelamin')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label for="nama_ayah" class="block text-sm font-medium text-gray-700">Nama Ayah</label>
                                <input type="text" name="nama_ayah" id="nama_ayah" value="{{ old('nama_ayah') }}" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" required>
                                @error('nama_ayah')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="nama_ibu" class="block text-sm font-medium text-gray-700">Nama Ibu</label>
                                <input type="text" name="nama_ibu" id="nama_ibu" value="{{ old('nama_ibu') }}" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" required>
                                @error('nama_ibu')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div>
                        <div class="mb-4">
                            <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                            <textarea name="alamat" id="alamat" rows="3" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label for="rt_rw" class="block text-sm font-medium text-gray-700">RT/RW</label>
                                <input type="text" name="rt_rw" id="rt_rw" value="{{ old('rt_rw') }}" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" required>
                                @error('rt_rw')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="kode_pos" class="block text-sm font-medium text-gray-700">Kode Pos</label>
                                <input type="text" name="kode_pos" id="kode_pos" value="{{ old('kode_pos') }}" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" required>
                                @error('kode_pos')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="provinsi" class="block text-sm font-medium text-gray-700">Provinsi</label>
                            <select name="provinsi" id="provinsi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" required>
                                <option value="">Pilih Provinsi</option>
                                <option value="DI YOGYAKARTA" {{ old('provinsi') == 'DI YOGYAKARTA' ? 'selected' : '' }}>DI YOGYAKARTA</option>
                                <!-- Tambahkan provinsi lain jika diperlukan -->
                            </select>
                            @error('provinsi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="kabupaten" class="block text-sm font-medium text-gray-700">Kabupaten/Kota</label>
                            <select name="kabupaten" id="kabupaten" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" required>
                                <option value="">Pilih Kabupaten/Kota</option>
                                <option value="BANTUL" {{ old('kabupaten') == 'BANTUL' ? 'selected' : '' }}>BANTUL</option>
                                <!-- Kabupaten/kota akan diisi melalui JavaScript -->
                            </select>
                            @error('kabupaten')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="kecamatan" class="block text-sm font-medium text-gray-700">Kecamatan</label>
                            <select name="kecamatan" id="kecamatan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" required>
                                <option value="">Pilih Kecamatan</option>
                                <option value="SEWON" {{ old('kecamatan') == 'SEWON' ? 'selected' : '' }}>SEWON</option>
                                <!-- Kecamatan akan diisi melalui JavaScript -->
                            </select>
                            @error('kecamatan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="desa" class="block text-sm font-medium text-gray-700">Desa/Kelurahan</label>
                            <select name="desa" id="desa" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" required>
                                <option value="">Pilih Desa/Kelurahan</option>
                                <option value="BANGUNHARJO" {{ old('desa') == 'BANGUNHARJO' ? 'selected' : '' }}>BANGUNHARJO</option>
                                <!-- Desa/kelurahan akan diisi melalui JavaScript -->
                            </select>
                            @error('desa')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="puskesmas" class="block text-sm font-medium text-gray-700">Puskesmas</label>
                            <select name="puskesmas" id="puskesmas" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" required>
                                <option value="SEWON II" {{ old('puskesmas') == 'SEWON II' ? 'selected' : '' }}>SEWON II</option>
                            </select>
                            @error('puskesmas')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="posyandu" class="block text-sm font-medium text-gray-700">Posyandu</label>
                            <select name="posyandu" id="posyandu" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" required>
                                <option value="">Pilih Posyandu</option>
                                <option value="Bina Sejahtera 1 Salakan" {{ old('posyandu') == 'Bina Sejahtera 1 Salakan' ? 'selected' : '' }}>Bina Sejahtera 1 Salakan</option>
                                <option value="Harapan Pertiwi Druwo" {{ old('posyandu') == 'Harapan Pertiwi Druwo' ? 'selected' : '' }}>Harapan Pertiwi Druwo</option>
                                <option value="Bina Sejahtera 2 Salakan" {{ old('posyandu') == 'Bina Sejahtera 2 Salakan' ? 'selected' : '' }}>Bina Sejahtera 2 Salakan</option>
                                <option value="Tunas Harapan Jotawang" {{ old('posyandu') == 'Tunas Harapan Jotawang' ? 'selected' : '' }}>Tunas Harapan Jotawang</option>
                                <option value="Mawar Saman" {{ old('posyandu') == 'Mawar Saman' ? 'selected' : '' }}>Mawar Saman</option>
                                <option value="Mekar Melati 1 Demangan" {{ old('posyandu') == 'Mekar Melati 1 Demangan' ? 'selected' : '' }}>Mekar Melati 1 Demangan</option>
                                <option value="Mekar Melati 2 Demangan" {{ old('posyandu') == 'Mekar Melati 2 Demangan' ? 'selected' : '' }}>Mekar Melati 2 Demangan</option>
                                <option value="Harapan Ibu Widoro" {{ old('posyandu') == 'Harapan Ibu Widoro' ? 'selected' : '' }}>Harapan Ibu Widoro</option>
                                <option value="Kuncup Mekar Bakung" {{ old('posyandu') == 'Kuncup Mekar Bakung' ? 'selected' : '' }}>Kuncup Mekar Bakung</option>
                                <option value="Kasih Ibu Semail" {{ old('posyandu') == 'Kasih Ibu Semail' ? 'selected' : '' }}>Kasih Ibu Semail</option>
                                <option value="Kuntum Melati 1 Pandeyan" {{ old('posyandu') == 'Kuntum Melati 1 Pandeyan' ? 'selected' : '' }}>Kuntum Melati 1 Pandeyan</option>
                                <option value="Kuncup Asih Mredo" {{ old('posyandu') == 'Kuncup Asih Mredo' ? 'selected' : '' }}>Kuncup Asih Mredo</option>
                                <option value="Ngesti Rahayu Jurug" {{ old('posyandu') == 'Ngesti Rahayu Jurug' ? 'selected' : '' }}>Ngesti Rahayu Jurug</option>
                                <option value="Kuncup Melati Wojo" {{ old('posyandu') == 'Kuncup Melati Wojo' ? 'selected' : '' }}>Kuncup Melati Wojo</option>
                                <option value="Puspita Pertiwi Randu Belang" {{ old('posyandu') == 'Puspita Pertiwi Randu Belang' ? 'selected' : '' }}>Puspita Pertiwi Randu Belang</option>
                                <option value="Tunas Melati Gatak" {{ old('posyandu') == 'Tunas Melati Gatak' ? 'selected' : '' }}>Tunas Melati Gatak</option>
                                <option value="Mekarsari Ngoto" {{ old('posyandu') == 'Mekarsari Ngoto' ? 'selected' : '' }}>Mekarsari Ngoto</option>
                            </select>
                            @error('posyandu')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="tanggal_pengukuran" class="block text-sm font-medium text-gray-700">Tanggal Pengukuran</label>
                            <input type="date" name="tanggal_pengukuran" id="tanggal_pengukuran" value="{{ old('tanggal_pengukuran', date('Y-m-d')) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" required>
                            @error('tanggal_pengukuran')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="no_telepon" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                            <input type="text" name="no_telepon" id="no_telepon" value="{{ old('no_telepon') }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" required>
                            @error('no_telepon')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Data Kesehatan -->
                <div class="mt-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Data Kesehatan Anak</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label for="berat_badan" class="block text-sm font-medium text-gray-700">Berat Badan (kg)</label>
                                    <input type="number" step="0.1" name="berat_badan" id="berat_badan" value="{{ old('berat_badan') }}" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                    @error('berat_badan')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="tinggi_badan" class="block text-sm font-medium text-gray-700">Tinggi Badan (cm)</label>
                                    <input type="number" step="0.1" name="tinggi_badan" id="tinggi_badan" value="{{ old('tinggi_badan') }}" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                    @error('tinggi_badan')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="posisi_pengukuran" class="block text-sm font-medium text-gray-700">Posisi Pengukuran</label>
                                <select name="posisi_pengukuran" id="posisi_pengukuran" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                    <option value="Berdiri" {{ old('posisi_pengukuran') == 'Berdiri' ? 'selected' : '' }}>Berdiri</option>
                                    <option value="Tidur" {{ old('posisi_pengukuran') == 'Tidur' ? 'selected' : '' }}>Tidur</option>
                                </select>
                                @error('posisi_pengukuran')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label for="lingkar_kepala" class="block text-sm font-medium text-gray-700">Lingkar Kepala (cm)</label>
                                    <input type="number" step="0.1" name="lingkar_kepala" id="lingkar_kepala" value="{{ old('lingkar_kepala') }}" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                    @error('lingkar_kepala')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="lingkar_lengan" class="block text-sm font-medium text-gray-700">Lingkar Lengan (cm)</label>
                                    <input type="number" step="0.1" name="lingkar_lengan" id="lingkar_lengan" value="{{ old('lingkar_lengan') }}" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                    @error('lingkar_lengan')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">ASI Eksklusif</label>
                                <div class="space-x-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="asi_eksklusif" value="1" class="text-green-600 focus:ring-green-500" {{ old('asi_eksklusif') == '1' ? 'checked' : '' }}>
                                        <span class="ml-2">Ya</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="asi_eksklusif" value="0" class="text-green-600 focus:ring-green-500" {{ old('asi_eksklusif') == '0' ? 'checked' : '' }}>
                                        <span class="ml-2">Tidak</span>
                                    </label>
                                </div>
                                @error('asi_eksklusif')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">MP-ASI</label>
                                <div class="space-x-4 mb-2">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="mpasi" value="1" class="text-green-600 focus:ring-green-500 mpasi-radio" {{ old('mpasi') == '1' ? 'checked' : '' }}>
                                        <span class="ml-2">Ya</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="mpasi" value="0" class="text-green-600 focus:ring-green-500 mpasi-radio" {{ old('mpasi') == '0' ? 'checked' : '' }}>
                                        <span class="ml-2">Tidak</span>
                                    </label>
                                </div>
                                <div id="mpasi_jenis_container" class="mt-2 {{ old('mpasi') != '1' ? 'hidden' : '' }}">
                                    <label for="mpasi_jenis" class="block text-sm font-medium text-gray-700">Jenis MP-ASI</label>
                                    <input type="text" name="mpasi_jenis" id="mpasi_jenis" value="{{ old('mpasi_jenis') }}" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                    @error('mpasi_jenis')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                @error('mpasi')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Pemberian Vitamin A</label>
                                <div class="space-x-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="vitamin_a" value="1" class="text-green-600 focus:ring-green-500" {{ old('vitamin_a') == '1' ? 'checked' : '' }}>
                                        <span class="ml-2">Ya</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="vitamin_a" value="0" class="text-green-600 focus:ring-green-500" {{ old('vitamin_a') == '0' ? 'checked' : '' }}>
                                        <span class="ml-2">Tidak</span>
                                    </label>
                                </div>
                                @error('vitamin_a')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Pemberian PMT</label>
                                <div class="space-x-4 mb-2">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="pmt" value="1" class="text-green-600 focus:ring-green-500 pmt-radio" {{ old('pmt') == '1' ? 'checked' : '' }}>
                                        <span class="ml-2">Ya</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="pmt" value="0" class="text-green-600 focus:ring-green-500 pmt-radio" {{ old('pmt') == '0' ? 'checked' : '' }}>
                                        <span class="ml-2">Tidak</span>
                                    </label>
                                </div>
                                <div id="pmt_jenis_container" class="mt-2 {{ old('pmt') != '1' ? 'hidden' : '' }}">
                                    <label for="pmt_jenis" class="block text-sm font-medium text-gray-700">Jenis PMT</label>
                                    <input type="text" name="pmt_jenis" id="pmt_jenis" value="{{ old('pmt_jenis') }}" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                    @error('pmt_jenis')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                @error('pmt')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <label for="catatan_khusus" class="block text-sm font-medium text-gray-700">Catatan Khusus</label>
                    <textarea name="catatan_khusus" id="catatan_khusus" rows="3" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">{{ old('catatan_khusus') }}</textarea>
                    @error('catatan_khusus')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-8 flex justify-end space-x-4">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Toggle MP-ASI jenis field
    document.querySelectorAll('.mpasi-radio').forEach(radio => {
        radio.addEventListener('change', function() {
            const mpasiJenisContainer = document.getElementById('mpasi_jenis_container');
            if (this.value === '1') {
                mpasiJenisContainer.classList.remove('hidden');
            } else {
                mpasiJenisContainer.classList.add('hidden');
            }
        });
    });

    // Toggle PMT jenis field
    document.querySelectorAll('.pmt-radio').forEach(radio => {
        radio.addEventListener('change', function() {
            const pmtJenisContainer = document.getElementById('pmt_jenis_container');
            if (this.value === '1') {
                pmtJenisContainer.classList.remove('hidden');
            } else {
                pmtJenisContainer.classList.add('hidden');
            }
        });
    });

    // Calculate age based on birth date
    document.getElementById('tanggal_lahir').addEventListener('change', function() {
        const birthDate = new Date(this.value);
        const today = new Date();
        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();
        
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        
        document.getElementById('usia').value = age + ' tahun';
    });
    
    // Alamat dropdown handling
    const wilayahData = {
        'DI YOGYAKARTA': {
            'BANTUL': {
                'SEWON': ['BANGUNHARJO']
            }
            // Tambahkan kabupaten/kota lain jika diperlukan
        }
        // Tambahkan provinsi lain jika diperlukan
    };
    
    // Provinsi dropdown change event
    document.getElementById('provinsi').addEventListener('change', function() {
        const provinsi = this.value;
        const kabupatenDropdown = document.getElementById('kabupaten');
        const kecamatanDropdown = document.getElementById('kecamatan');
        const desaDropdown = document.getElementById('desa');
        
        // Reset dropdowns
        kabupatenDropdown.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
        kecamatanDropdown.innerHTML = '<option value="">Pilih Kecamatan</option>';
        desaDropdown.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';
        
        if (provinsi && wilayahData[provinsi]) {
            // Populate kabupaten dropdown
            Object.keys(wilayahData[provinsi]).forEach(kabupaten => {
                const option = document.createElement('option');
                option.value = kabupaten;
                option.textContent = kabupaten;
                kabupatenDropdown.appendChild(option);
            });
        }
    });
    
    // Kabupaten dropdown change event
    document.getElementById('kabupaten').addEventListener('change', function() {
        const provinsi = document.getElementById('provinsi').value;
        const kabupaten = this.value;
        const kecamatanDropdown = document.getElementById('kecamatan');
        const desaDropdown = document.getElementById('desa');
        
        // Reset dropdowns
        kecamatanDropdown.innerHTML = '<option value="">Pilih Kecamatan</option>';
        desaDropdown.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';
        
        if (provinsi && kabupaten && wilayahData[provinsi][kabupaten]) {
            // Populate kecamatan dropdown
            Object.keys(wilayahData[provinsi][kabupaten]).forEach(kecamatan => {
                const option = document.createElement('option');
                option.value = kecamatan;
                option.textContent = kecamatan;
                kecamatanDropdown.appendChild(option);
            });
        }
    });
    
    // Kecamatan dropdown change event
    document.getElementById('kecamatan').addEventListener('change', function() {
        const provinsi = document.getElementById('provinsi').value;
        const kabupaten = document.getElementById('kabupaten').value;
        const kecamatan = this.value;
        const desaDropdown = document.getElementById('desa');
        
        // Reset dropdown
        desaDropdown.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';
        
        if (provinsi && kabupaten && kecamatan && wilayahData[provinsi][kabupaten][kecamatan]) {
            // Populate desa dropdown
            wilayahData[provinsi][kabupaten][kecamatan].forEach(desa => {
                const option = document.createElement('option');
                option.value = desa;
                option.textContent = desa;
                desaDropdown.appendChild(option);
            });
        }
    });
</script>
@endpush
@endsection
