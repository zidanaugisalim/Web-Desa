@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold mb-6">Edit Data Anak</h2>
            
            <form action="{{ route('anak.update', $anak->id) }}" method="POST" enctype="multipart/form-data" id="anakForm">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kolom Kiri -->
                    <div>
                        <div class="mb-4">
                            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="nama" id="nama" value="{{ old('nama', $anak->nama) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" required>
                            @error('nama')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="nik" class="block text-sm font-medium text-gray-700">NIK <span class="text-red-500">*</span></label>
                            <input type="text" name="nik" id="nik" value="{{ old('nik', $anak->nik) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" required>
                            @error('nik')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir <span class="text-red-500">*</span></label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir', $anak->tempat_lahir) }}" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" required>
                                @error('tempat_lahir')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir <span class="text-red-500">*</span></label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', $anak->tanggal_lahir->format('Y-m-d')) }}" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" required>
                                @error('tanggal_lahir')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <div class="mt-2 space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="jenis_kelamin" value="L" class="text-green-600 focus:ring-green-500" 
                                        {{ old('jenis_kelamin', $anak->jenis_kelamin) == 'L' ? 'checked' : '' }} required>
                                    <span class="ml-2">Laki-laki</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="jenis_kelamin" value="P" class="text-green-600 focus:ring-green-500"
                                        {{ old('jenis_kelamin', $anak->jenis_kelamin) == 'P' ? 'checked' : '' }} required>
                                    <span class="ml-2">Perempuan</span>
                                </label>
                            </div>
                            @error('jenis_kelamin')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label for="nama_ayah" class="block text-sm font-medium text-gray-700">Nama Ayah <span class="text-red-500">*</span></label>
                                <input type="text" name="nama_ayah" id="nama_ayah" value="{{ old('nama_ayah', $anak->nama_ayah) }}" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" required>
                                @error('nama_ayah')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="nama_ibu" class="block text-sm font-medium text-gray-700">Nama Ibu <span class="text-red-500">*</span></label>
                                <input type="text" name="nama_ibu" id="nama_ibu" value="{{ old('nama_ibu', $anak->nama_ibu) }}" 
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
                            <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat <span class="text-red-500">*</span></label>
                            <textarea name="alamat" id="alamat" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" required>{{ old('alamat', $anak->alamat) }}</textarea>
                            @error('alamat')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="no_telepon" class="block text-sm font-medium text-gray-700">Nomor Telepon <span class="text-red-500">*</span></label>
                            <input type="text" name="no_telepon" id="no_telepon" value="{{ old('no_telepon', $anak->no_telepon) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" required>
                            @error('no_telepon')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label for="rt_rw" class="block text-sm font-medium text-gray-700">RT/RW <span class="text-red-500">*</span></label>
                                <input type="text" name="rt_rw" id="rt_rw" value="{{ old('rt_rw', $anak->rt_rw) }}" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" required>
                                @error('rt_rw')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="kode_pos" class="block text-sm font-medium text-gray-700">Kode Pos <span class="text-red-500">*</span></label>
                                <input type="text" name="kode_pos" id="kode_pos" value="{{ old('kode_pos', $anak->kode_pos) }}" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" required>
                                @error('kode_pos')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="kecamatan" class="block text-sm font-medium text-gray-700">Kecamatan <span class="text-red-500">*</span></label>
                            <input type="text" name="kecamatan" id="kecamatan" value="{{ old('kecamatan', $anak->kecamatan) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" required>
                            @error('kecamatan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="kabupaten" class="block text-sm font-medium text-gray-700">Kabupaten/Kota <span class="text-red-500">*</span></label>
                            <input type="text" name="kabupaten" id="kabupaten" value="{{ old('kabupaten', $anak->kabupaten) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" required>
                            @error('kabupaten')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="provinsi" class="block text-sm font-medium text-gray-700">Provinsi <span class="text-red-500">*</span></label>
                            <input type="text" name="provinsi" id="provinsi" value="{{ old('provinsi', $anak->provinsi) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" required>
                            @error('provinsi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Data Kesehatan -->
                <div class="mt-6 border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Data Kesehatan</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Kolom Kiri -->
                        <div>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label for="berat_badan" class="block text-sm font-medium text-gray-700">Berat Badan (kg) <span class="text-red-500">*</span></label>
                                    <input type="number" step="0.1" min="0.1" max="200" name="berat_badan" id="berat_badan" 
                                        value="{{ old('berat_badan', $anak->berat_badan) }}" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" required>
                                    @error('berat_badan')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="mb-4">
                                    <label for="tinggi_badan" class="block text-sm font-medium text-gray-700">Tinggi Badan (cm) <span class="text-red-500">*</span></label>
                                    <input type="number" step="0.1" min="30" max="300" name="tinggi_badan" id="tinggi_badan" 
                                        value="{{ old('tinggi_badan', $anak->tinggi_badan) }}" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" required>
                                    @error('tinggi_badan')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Posisi Pengukuran <span class="text-red-500">*</span></label>
                                <div class="mt-2 space-x-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="posisi_pengukuran" value="Berdiri" class="text-green-600 focus:ring-green-500" 
                                            {{ old('posisi_pengukuran', $anak->posisi_pengukuran) == 'Berdiri' ? 'checked' : '' }} required>
                                        <span class="ml-2">Berdiri</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="posisi_pengukuran" value="Tidur" class="text-green-600 focus:ring-green-500"
                                            {{ old('posisi_pengukuran', $anak->posisi_pengukuran) == 'Tidur' ? 'checked' : '' }} required>
                                        <span class="ml-2">Tidur</span>
                                    </label>
                                </div>
                                @error('posisi_pengukuran')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label for="lingkar_kepala" class="block text-sm font-medium text-gray-700">Lingkar Kepala (cm)</label>
                                    <input type="number" step="0.1" min="20" max="100" name="lingkar_kepala" id="lingkar_kepala" 
                                        value="{{ old('lingkar_kepala', $anak->lingkar_kepala) }}" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                    @error('lingkar_kepala')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="mb-4">
                                    <label for="lingkar_lengan" class="block text-sm font-medium text-gray-700">Lingkar Lengan (cm)</label>
                                    <input type="number" step="0.1" min="5" max="50" name="lingkar_lengan" id="lingkar_lengan" 
                                        value="{{ old('lingkar_lengan', $anak->lingkar_lengan) }}" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                    @error('lingkar_lengan')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Kolom Kanan -->
                        <div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">ASI Eksklusif <span class="text-red-500">*</span></label>
                                <div class="mt-2 space-x-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="asi_eksklusif" value="1" class="text-green-600 focus:ring-green-500" 
                                            {{ old('asi_eksklusif', $anak->asi_eksklusif) == 1 ? 'checked' : '' }} required>
                                        <span class="ml-2">Ya</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="asi_eksklusif" value="0" class="text-green-600 focus:ring-green-500"
                                            {{ !old('asi_eksklusif') && $anak->asi_eksklusif == 0 || old('asi_eksklusif') === '0' ? 'checked' : '' }} required>
                                        <span class="ml-2">Tidak</span>
                                    </label>
                                </div>
                                @error('asi_eksklusif')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">MP-ASI <span class="text-red-500">*</span></label>
                                <div class="mt-2 space-x-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="mpasi" value="1" class="text-green-600 focus:ring-green-500 mpasi-radio" 
                                            {{ old('mpasi', $anak->mpasi) == 1 ? 'checked' : '' }} required>
                                        <span class="ml-2">Ya</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="mpasi" value="0" class="text-green-600 focus:ring-green-500 mpasi-radio"
                                            {{ !old('mpasi') && $anak->mpasi == 0 || old('mpasi') === '0' ? 'checked' : '' }} required>
                                        <span class="ml-2">Tidak</span>
                                    </label>
                                </div>
                                @error('mpasi')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                
                                <div id="mpasi_jenis_container" class="mt-3 {{ old('mpasi', $anak->mpasi) ? '' : 'hidden' }}">
                                    <label for="mpasi_jenis" class="block text-sm font-medium text-gray-700">Jenis MP-ASI</label>
                                    <input type="text" name="mpasi_jenis" id="mpasi_jenis" 
                                        value="{{ old('mpasi_jenis', $anak->mpasi_jenis) }}" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                    @error('mpasi_jenis')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Vitamin A <span class="text-red-500">*</span></label>
                                <div class="mt-2 space-x-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="vitamin_a" value="1" class="text-green-600 focus:ring-green-500" 
                                            {{ old('vitamin_a', $anak->vitamin_a) == 1 ? 'checked' : '' }} required>
                                        <span class="ml-2">Ya</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="vitamin_a" value="0" class="text-green-600 focus:ring-green-500"
                                            {{ !old('vitamin_a') && $anak->vitamin_a == 0 || old('vitamin_a') === '0' ? 'checked' : '' }} required>
                                        <span class="ml-2">Tidak</span>
                                    </label>
                                </div>
                                @error('vitamin_a')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">PMT <span class="text-red-500">*</span></label>
                                <div class="mt-2 space-x-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="pmt" value="1" class="text-green-600 focus:ring-green-500 pmt-radio" 
                                            {{ old('pmt', $anak->pmt) == 1 ? 'checked' : '' }} required>
                                        <span class="ml-2">Ya</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="pmt" value="0" class="text-green-600 focus:ring-green-500 pmt-radio"
                                            {{ !old('pmt') && $anak->pmt == 0 || old('pmt') === '0' ? 'checked' : '' }} required>
                                        <span class="ml-2">Tidak</span>
                                    </label>
                                </div>
                                @error('pmt')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                
                                <div id="pmt_jenis_container" class="mt-3 {{ old('pmt', $anak->pmt) ? '' : 'hidden' }}">
                                    <label for="pmt_jenis" class="block text-sm font-medium text-gray-700">Jenis PMT</label>
                                    <input type="text" name="pmt_jenis" id="pmt_jenis" 
                                        value="{{ old('pmt_jenis', $anak->pmt_jenis) }}" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                    @error('pmt_jenis')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                

                <!-- Catatan Khusus -->
                <div class="mt-6">
                    <label for="catatan_khusus" class="block text-sm font-medium text-gray-700">Catatan Khusus</label>
                    <textarea name="catatan_khusus" id="catatan_khusus" rows="3" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">{{ old('catatan_khusus', $anak->catatan_khusus) }}</textarea>
                    @error('catatan_khusus')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-8 flex justify-end space-x-4">
                    <a href="{{ route('anak.show', $anak->id) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Simpan Perubahan
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
    
    // Trigger the change event on page load to ensure proper initial state
    document.addEventListener('DOMContentLoaded', function() {
        const selectedMpasi = document.querySelector('.mpasi-radio:checked');
        if (selectedMpasi) {
            selectedMpasi.dispatchEvent(new Event('change'));
        }
        
        const selectedPmt = document.querySelector('.pmt-radio:checked');
        if (selectedPmt) {
            selectedPmt.dispatchEvent(new Event('change'));
        }
        
        // Form validation before submit
        const anakForm = document.getElementById('anakForm');
        if (anakForm) {
            anakForm.addEventListener('submit', function(e) {
                const alamatField = document.getElementById('alamat');
                if (!alamatField.value.trim()) {
                    e.preventDefault();
                    alert('Alamat tidak boleh kosong!');
                    alamatField.focus();
                }
                
                // Log form data for debugging
                console.log('Form data before submit:', new FormData(anakForm));
            });
        }
    });
</script>
@endpush

@endsection
