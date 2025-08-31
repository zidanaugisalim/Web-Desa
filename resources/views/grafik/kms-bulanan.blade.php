@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Grafik KMS Bulanan</h1>
            <p class="text-gray-600">Kartu Menuju Sehat - Monitoring Pertumbuhan Anak</p>
        </div>

        <!-- Filter Anak -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="selectAnak" class="block text-sm font-medium text-gray-700 mb-2">Pilih Anak</label>
                    <select id="selectAnak" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih anak...</option>
                        @foreach($anakList as $anak)
                            <option value="{{ $anak->id }}" {{ request('anak_id') == $anak->id ? 'selected' : '' }}>
                                {{ $anak->nama }} ({{ $anak->tanggal_lahir ? \Carbon\Carbon::parse($anak->tanggal_lahir)->age : 'N/A' }} tahun)
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="selectTahun" class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                    <select id="selectTahun" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @for($year = date('Y'); $year >= date('Y') - 5; $year--)
                            <option value="{{ $year }}" {{ request('tahun', date('Y')) == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endfor
                    </select>
                </div>
                <div class="flex items-end">
                    <button id="btnFilter" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <i class="fas fa-search mr-2"></i>Tampilkan Grafik
                    </button>
                </div>
            </div>
        </div>

        <!-- Info Anak -->
        <div id="infoAnak" class="bg-white rounded-lg shadow-md p-6 mb-8" style="display: none;">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="text-center">
                    <h3 class="text-lg font-semibold text-gray-700">Nama</h3>
                    <p id="namaAnak" class="text-xl font-bold text-blue-600">-</p>
                </div>
                <div class="text-center">
                    <h3 class="text-lg font-semibold text-gray-700">Umur</h3>
                    <p id="umurAnak" class="text-xl font-bold text-green-600">-</p>
                </div>
                <div class="text-center">
                    <h3 class="text-lg font-semibold text-gray-700">Status Gizi</h3>
                    <p id="statusGiziAnak" class="text-xl font-bold">-</p>
                </div>
                <div class="text-center">
                    <h3 class="text-lg font-semibold text-gray-700">Posyandu</h3>
                    <p id="posyanduAnak" class="text-xl font-bold text-purple-600">-</p>
                </div>
            </div>
        </div>

        <!-- Grafik KMS -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Grafik Berat Badan -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Grafik Berat Badan</h2>
                <div class="relative h-80">
                    <canvas id="beratBadanChart"></canvas>
                </div>
            </div>

            <!-- Grafik Tinggi Badan -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Grafik Tinggi Badan</h2>
                <div class="relative h-80">
                    <canvas id="tinggiBadanChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Tabel Data Pengukuran -->
        <div class="mt-8 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Data Pengukuran Bulanan</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bulan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Berat Badan (kg)</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tinggi Badan (cm)</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lingkar Kepala (cm)</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody id="dataPengukuranTable" class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">Pilih anak untuk melihat data pengukuran</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Catatan Vitamin A & Cacing -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Riwayat Vitamin A</h2>
                <div id="riwayatVitaminA" class="space-y-3">
                    <p class="text-gray-500 text-center">Pilih anak untuk melihat riwayat vitamin A</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Riwayat Obat Cacing</h2>
                <div id="riwayatCacing" class="space-y-3">
                    <p class="text-gray-500 text-center">Pilih anak untuk melihat riwayat obat cacing</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
let beratBadanChart = null;
let tinggiBadanChart = null;

// Event listener untuk filter
document.getElementById('btnFilter').addEventListener('click', function() {
    const anakId = document.getElementById('selectAnak').value;
    const tahun = document.getElementById('selectTahun').value;
    
    if (!anakId) {
        alert('Silakan pilih anak terlebih dahulu');
        return;
    }
    
    loadKMSData(anakId, tahun);
});

// Auto load jika ada parameter
const urlParams = new URLSearchParams(window.location.search);
const anakId = urlParams.get('anak_id');
const tahun = urlParams.get('tahun') || new Date().getFullYear();

if (anakId) {
    document.getElementById('selectAnak').value = anakId;
    document.getElementById('selectTahun').value = tahun;
    loadKMSData(anakId, tahun);
}

function loadKMSData(anakId, tahun) {
    // Show loading
    document.getElementById('infoAnak').style.display = 'block';
    document.getElementById('namaAnak').textContent = 'Loading...';
    
    fetch(`/api/grafik/kms-bulanan?anak_id=${anakId}&tahun=${tahun}`)
        .then(response => response.json())
        .then(data => {
            // Update info anak
            document.getElementById('namaAnak').textContent = data.anak.nama;
            document.getElementById('umurAnak').textContent = data.anak.umur + ' tahun';
            document.getElementById('statusGiziAnak').textContent = data.anak.status_gizi || 'Belum Diperiksa';
            document.getElementById('statusGiziAnak').className = `text-xl font-bold ${
                data.anak.status_gizi === 'Gizi Buruk' ? 'text-red-600' :
                data.anak.status_gizi === 'Gizi Kurang' ? 'text-yellow-600' :
                data.anak.status_gizi === 'Normal' ? 'text-green-600' :
                data.anak.status_gizi === 'Gizi Lebih' ? 'text-purple-600' :
                'text-gray-600'
            }`;
            document.getElementById('posyanduAnak').textContent = data.anak.posyandu || 'Belum Ditentukan';
            
            // Update charts
            updateBeratBadanChart(data.pengukuran);
            updateTinggiBadanChart(data.pengukuran);
            
            // Update table
            updateDataTable(data.pengukuran);
            
            // Update riwayat vitamin & cacing
            updateRiwayatVitamin(data.vitamin_a);
            updateRiwayatCacing(data.obat_cacing);
        })
        .catch(error => {
            console.error('Error loading KMS data:', error);
            alert('Error memuat data KMS');
        });
}

function updateBeratBadanChart(data) {
    const ctx = document.getElementById('beratBadanChart').getContext('2d');
    
    if (beratBadanChart) {
        beratBadanChart.destroy();
    }
    
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
    
    beratBadanChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Berat Badan (kg)',
                data: data.map(item => item.berat_badan),
                borderColor: '#3B82F6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#3B82F6',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Berat Badan (kg)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Bulan'
                    }
                }
            }
        }
    });
}

function updateTinggiBadanChart(data) {
    const ctx = document.getElementById('tinggiBadanChart').getContext('2d');
    
    if (tinggiBadanChart) {
        tinggiBadanChart.destroy();
    }
    
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
    
    tinggiBadanChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Tinggi Badan (cm)',
                data: data.map(item => item.tinggi_badan),
                borderColor: '#10B981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#10B981',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Tinggi Badan (cm)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Bulan'
                    }
                }
            }
        }
    });
}

function updateDataTable(data) {
    const tbody = document.getElementById('dataPengukuranTable');
    const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    
    tbody.innerHTML = data.map((item, index) => `
        <tr>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${months[index]}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${item.berat_badan || '-'}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${item.tinggi_badan || '-'}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${item.lingkar_kepala || '-'}</td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${
                    item.status === 'Normal' ? 'bg-green-100 text-green-800' :
                    item.status === 'Kurang' ? 'bg-yellow-100 text-yellow-800' :
                    item.status === 'Buruk' ? 'bg-red-100 text-red-800' :
                    'bg-gray-100 text-gray-800'
                }">
                    ${item.status || 'Belum Diperiksa'}
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                ${item.hadir ? '<span class="text-green-600">Hadir</span>' : '<span class="text-red-600">Tidak Hadir</span>'}
            </td>
        </tr>
    `).join('');
}

function updateRiwayatVitamin(data) {
    const container = document.getElementById('riwayatVitaminA');
    
    if (data.length === 0) {
        container.innerHTML = '<p class="text-gray-500 text-center">Belum ada riwayat vitamin A</p>';
        return;
    }
    
    container.innerHTML = data.map(item => `
        <div class="flex items-center justify-between p-3 bg-yellow-50 rounded-lg">
            <div>
                <p class="font-medium text-yellow-800">${item.tanggal}</p>
                <p class="text-sm text-yellow-600">${item.keterangan}</p>
            </div>
            <div class="text-right">
                <span class="px-2 py-1 text-xs font-semibold rounded-full ${
                    item.diberikan ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
                }">
                    ${item.diberikan ? 'Sudah' : 'Belum'}
                </span>
            </div>
        </div>
    `).join('');
}

function updateRiwayatCacing(data) {
    const container = document.getElementById('riwayatCacing');
    
    if (data.length === 0) {
        container.innerHTML = '<p class="text-gray-500 text-center">Belum ada riwayat obat cacing</p>';
        return;
    }
    
    container.innerHTML = data.map(item => `
        <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
            <div>
                <p class="font-medium text-green-800">${item.tanggal}</p>
                <p class="text-sm text-green-600">${item.keterangan}</p>
            </div>
            <div class="text-right">
                <span class="px-2 py-1 text-xs font-semibold rounded-full ${
                    item.diberikan ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
                }">
                    ${item.diberikan ? 'Sudah' : 'Belum'}
                </span>
            </div>
        </div>
    `).join('');
}
</script>
@endsection