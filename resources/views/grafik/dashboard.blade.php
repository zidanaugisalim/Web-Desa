@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Dashboard Grafik Gizi</h1>
            <p class="text-gray-600">Visualisasi data status gizi dan perkembangan anak</p>
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
                        <p class="text-3xl font-bold text-blue-600">{{ $totalAnak }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-red-100 text-red-600">
                        <i class="fas fa-exclamation-triangle text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-700">Gizi Buruk</h3>
                        <p class="text-3xl font-bold text-red-600">{{ $giziBuruk }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-orange-100 text-orange-600">
                        <i class="fas fa-pills text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-700">Perlu Vitamin A</h3>
                        <p class="text-3xl font-bold text-orange-600">{{ $perluVitaminA }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                        <i class="fas fa-bug text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-700">Perlu Obat Cacing</h3>
                        <p class="text-3xl font-bold text-purple-600">{{ $perluCacing }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Grafik Status Gizi -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Status Gizi Anak</h2>
                <div class="relative h-64">
                    <canvas id="statusGiziChart"></canvas>
                </div>
            </div>

            <!-- Jadwal Vitamin A & Cacing -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Jadwal Vitamin A & Obat Cacing</h2>
                <div class="space-y-4">
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-calendar-alt text-yellow-400"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-yellow-800">Vitamin A</h3>
                                <p class="text-sm text-yellow-700">Diberikan 2 kali setahun (Februari & Agustus)</p>
                                <p class="text-xs text-yellow-600 mt-1">Untuk anak usia 6-59 bulan</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-green-50 border-l-4 border-green-400 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-calendar-alt text-green-400"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-green-800">Obat Cacing</h3>
                                <p class="text-sm text-green-700">Diberikan 2 kali setahun (Maret & September)</p>
                                <p class="text-xs text-green-600 mt-1">Untuk anak usia 12-59 bulan</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-blue-50 border-l-4 border-blue-400 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-info-circle text-blue-400"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-blue-800">Catatan Penting</h3>
                                <p class="text-sm text-blue-700">Pastikan anak hadir di posyandu sesuai jadwal untuk mendapatkan vitamin dan obat cacing</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Anak yang Perlu Perhatian -->
        <div class="mt-8 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Anak yang Perlu Perhatian Khusus</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Gizi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vitamin A</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Obat Cacing</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="anakPerhatianTable">
                        <!-- Data akan dimuat via JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Grafik Status Gizi
fetch('/api/grafik/status-gizi')
    .then(response => response.json())
    .then(data => {
        const ctx = document.getElementById('statusGiziChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: data.map(item => item.label),
                datasets: [{
                    data: data.map(item => item.value),
                    backgroundColor: [
                        '#10B981', // Normal - Green
                        '#F59E0B', // Gizi Kurang - Yellow
                        '#EF4444', // Gizi Buruk - Red
                        '#8B5CF6', // Gizi Lebih - Purple
                        '#6B7280'  // Belum Diperiksa - Gray
                    ],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.parsed;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = ((value / total) * 100).toFixed(1);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    })
    .catch(error => {
        console.error('Error loading chart data:', error);
    });

// Load data anak yang perlu perhatian
fetch('/api/anak/perlu-perhatian')
    .then(response => response.json())
    .then(data => {
        const tbody = document.getElementById('anakPerhatianTable');
        if (data.length === 0) {
            tbody.innerHTML = '<tr><td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada anak yang perlu perhatian khusus</td></tr>';
            return;
        }
        
        tbody.innerHTML = data.map(anak => `
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${anak.nama}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${
                        anak.status_gizi === 'Gizi Buruk' ? 'bg-red-100 text-red-800' :
                        anak.status_gizi === 'Gizi Kurang' ? 'bg-yellow-100 text-yellow-800' :
                        'bg-green-100 text-green-800'
                    }">
                        ${anak.status_gizi || 'Belum Diperiksa'}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    ${anak.perlu_vitamin_a ? '<span class="text-red-600">Perlu</span>' : '<span class="text-green-600">Sudah</span>'}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    ${anak.perlu_cacing ? '<span class="text-red-600">Perlu</span>' : '<span class="text-green-600">Sudah</span>'}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a href="/anak/${anak.id}" class="text-indigo-600 hover:text-indigo-900">Lihat Detail</a>
                </td>
            </tr>
        `).join('');
    })
    .catch(error => {
        console.error('Error loading table data:', error);
        document.getElementById('anakPerhatianTable').innerHTML = 
            '<tr><td colspan="5" class="px-6 py-4 text-center text-red-500">Error memuat data</td></tr>';
    });
</script>
@endsection