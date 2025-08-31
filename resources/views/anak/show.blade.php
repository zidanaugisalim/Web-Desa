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

                <!-- Kolom Kanan -->
                <div>
                    <!-- Form Pengukuran IMT -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Pengukuran IMT</h3>
                        <form id="formPengukuranImt" class="space-y-4">
                            @csrf
                            <div>
                                <label for="berat_badan" class="block text-sm font-medium text-gray-700">Berat Badan (kg)</label>
                                <input type="number" id="berat_badan" name="berat_badan" step="0.1" min="0.1" max="200" required
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label for="tinggi_badan" class="block text-sm font-medium text-gray-700">Tinggi Badan (cm)</label>
                                <input type="number" id="tinggi_badan" name="tinggi_badan" step="0.1" min="30" max="300" required
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label for="tanggal_pengukuran" class="block text-sm font-medium text-gray-700">Tanggal Pengukuran</label>
                                <input type="date" id="tanggal_pengukuran" name="tanggal_pengukuran" value="{{ date('Y-m-d') }}" required
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan (Opsional)</label>
                                <input type="text" id="catatan" name="catatan" placeholder="Catatan tambahan"
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <i class="fas fa-save mr-2"></i> Simpan Pengukuran
                            </button>
                        </form>
                    </div>
                </div>

            </div>

            <!-- Grafik IMT -->
            <div class="mt-8">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">
                        <i class="fas fa-chart-line mr-2"></i> Grafik Pemantauan IMT
                    </h3>
                    <div class="relative">
                        <canvas id="chartIMT" width="400" height="200"></canvas>
                        <div id="noDataMessage" class="text-center text-gray-500 py-8" style="display: none;">
                            <p>Belum ada data pengukuran IMT. Silakan tambahkan pengukuran pertama.</p>
                        </div>
                    </div>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
let chartIMT = null;
const anakId = {{ $anak->id }};

// Inisialisasi grafik saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    loadGrafikIMT();
    
    // Event listener untuk form pengukuran IMT
    document.getElementById('formPengukuranImt').addEventListener('submit', function(e) {
        e.preventDefault();
        simpanPengukuranIMT();
    });
});

// Fungsi untuk memuat grafik IMT
function loadGrafikIMT() {
    fetch(`/anak/${anakId}/pengukuran-imt-data`)
        .then(response => response.json())
        .then(data => {
            if (data.length === 0) {
                document.getElementById('noDataMessage').style.display = 'block';
                document.getElementById('chartIMT').style.display = 'none';
            } else {
                document.getElementById('noDataMessage').style.display = 'none';
                document.getElementById('chartIMT').style.display = 'block';
                buatGrafikIMT(data);
            }
        })
        .catch(error => {
            console.error('Error loading IMT data:', error);
        });
}

// Fungsi untuk membuat grafik IMT
function buatGrafikIMT(data) {
    const ctx = document.getElementById('chartIMT').getContext('2d');
    
    // Hapus grafik lama jika ada
    if (chartIMT) {
        chartIMT.destroy();
    }
    
    const labels = data.map(item => {
        const date = new Date(item.tanggal);
        return date.toLocaleDateString('id-ID');
    });
    
    const imtData = data.map(item => item.imt);
    
    // Warna berdasarkan kategori IMT
    const backgroundColors = data.map(item => {
        switch(item.kategori) {
            case 'Sangat Kurus': return 'rgba(220, 53, 69, 0.8)';
            case 'Kurus': return 'rgba(255, 193, 7, 0.8)';
            case 'Normal': return 'rgba(40, 167, 69, 0.8)';
            case 'Gemuk': return 'rgba(255, 193, 7, 0.8)';
            case 'Obesitas': return 'rgba(220, 53, 69, 0.8)';
            default: return 'rgba(108, 117, 125, 0.8)';
        }
    });
    
    chartIMT = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'IMT',
                data: imtData,
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderWidth: 2,
                fill: false,
                tension: 0.1,
                pointBackgroundColor: backgroundColors,
                pointBorderColor: backgroundColors,
                pointRadius: 6,
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'IMT (kg/m²)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Tanggal Pengukuran'
                    }
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Grafik Pemantauan IMT - {{ $anak->nama }}'
                },
                legend: {
                    display: true
                },
                tooltip: {
                    callbacks: {
                        afterLabel: function(context) {
                            const index = context.dataIndex;
                            const item = data[index];
                            return [
                                `Kategori: ${item.kategori}`,
                                `Berat: ${item.berat_badan} kg`,
                                `Tinggi: ${item.tinggi_badan} cm`
                            ];
                        }
                    }
                }
            }
        }
    });
}

// Fungsi untuk menyimpan pengukuran IMT
function simpanPengukuranIMT() {
    const form = document.getElementById('formPengukuranImt');
    const formData = new FormData(form);
    
    // Disable tombol submit
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Menyimpan...';
    
    fetch(`/anak/${anakId}/pengukuran-imt`, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Reset form
            form.reset();
            document.getElementById('tanggal_pengukuran').value = new Date().toISOString().split('T')[0];
            
            // Reload grafik
            loadGrafikIMT();
            
            // Tampilkan pesan sukses
            showAlert('success', data.message);
        } else {
            showAlert('error', data.message || 'Gagal menyimpan data pengukuran');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('error', 'Terjadi kesalahan saat menyimpan data');
    })
    .finally(() => {
        // Enable tombol submit
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
    });
}

// Fungsi untuk menampilkan alert
function showAlert(type, message) {
    const alertDiv = document.createElement('div');
    alertDiv.className = `fixed top-4 right-4 z-50 p-4 rounded-md shadow-lg ${
        type === 'success' ? 'bg-green-100 border-l-4 border-green-500 text-green-700' : 
        'bg-red-100 border-l-4 border-red-500 text-red-700'
    }`;
    alertDiv.innerHTML = `
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas ${
                    type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'
                }"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium">${message}</p>
            </div>
            <div class="ml-auto pl-3">
                <button onclick="this.parentElement.parentElement.parentElement.remove()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    `;
    
    document.body.appendChild(alertDiv);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (alertDiv.parentElement) {
            alertDiv.remove();
        }
    }, 5000);
}
</script>
@endsection
