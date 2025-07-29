<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Anak Stunting</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            background-color: #f8fafc;
        }
    </style>
</head>

<body>
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white shadow-lg rounded-lg p-8 w-96">
            <h2 class="text-2xl font-bold text-center mb-6">Input Data Anak Stunting</h2>
            <form action="#" method="POST">
                <div class="mb-4">
                    <label for="tanggal_pemeriksaan" class="block text-sm font-medium text-gray-700">Tanggal Pemeriksaan</label>
                    <input type="date" name="tanggal_pemeriksaan" id="tanggal_pemeriksaan" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-600">
                </div>
                <div class="mb-4">
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama Anak</label>
                    <input type="text" name="nama" id="nama" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-600">
                </div>
                <div class="mb-4">
                    <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                    <input type="text" name="nik" id="nik" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-600">
                </div>
                <div class="mb-4">
                    <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-600">
                </div>
                <div class="mb-4">
                    <label for="usia" class="block text-sm font-medium text-gray-700">Usia (tahun)</label>
                    <input type="number" name="usia" id="usia" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-600">
                </div>
                <div class="mb-4">
                    <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-600">
                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="nama_ayah" class="block text-sm font-medium text-gray-700">Nama Ayah</label>
                    <input type="text" name="nama_ayah" id="nama_ayah" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-600">
                </div>
                <div class="mb-4">
                    <label for="nama_ibu" class="block text-sm font-medium text-gray-700">Nama Ibu</label>
                    <input type="text" name="nama_ibu" id="nama_ibu" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-600">
                </div>
                <div class="mb-4">
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <input type="text" name="alamat" id="alamat" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-600">
                </div>
                <div class="mb-4">
                    <label for="berat_badan" class="block text-sm font-medium text-gray-700">Berat Badan (BB/kg)</label>
                    <input type="number" step="0.01" name="berat_badan" id="berat_badan" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-600">
                </div>
                <div class="mb-4">
                    <label for="tinggi_badan" class="block text-sm font-medium text-gray-700">Tinggi Badan (Tb/cm)</label>
                    <input type="number" step="0.1" name="tinggi_badan" id="tinggi_badan" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-600">
                </div>
                <div class="mb-4">
                    <label for="indeks_masa_tubuh" class="block text-sm font-medium text-gray-700">Indeks Masa Tubuh</label>
                    <input type="number" step="0.01" name="indeks_masa_tubuh" id="indeks_masa_tubuh" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-600">
                </div>
                <div class="mb-4">
                    <label for="lingkar_kepala" class="block text-sm font-medium text-gray-700">Lingkar Kepala (cm)</label>
                    <input type="number" step="0.1" name="lingkar_kepala" id="lingkar_kepala" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-600">
                </div>
                <div class="mb-4">
                    <label for="lingkar_lengan" class="block text-sm font-medium text-gray-700">Lingkar Lengan (cm)</label>
                    <input type="number" step="0.1" name="lingkar_lengan" id="lingkar_lengan" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-600">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">ASI Eksklusif</label>
                    <select name="asi_eksklusif" id="asi_eksklusif" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-600">
                        <option value="" disabled selected>Pilih Opsi</option>
                        <option value="Ya">Ya</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">MPASI</label>
                    <select name="mpasi" id="mpasi" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-600">
                        <option value="" disabled selected>Pilih Opsi</option>
                        <option value="Ya">Ya</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                    <input type="text" name="jenis_mpasi" id="jenis_mpasi" placeholder="Jenis yang diberikan" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-600">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Pemberian Vitamin A</label>
                    <select name="vitamin_a" id="vitamin_a" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-600">
                        <option value="" disabled selected>Pilih Opsi</option>
                        <option value="Ya">Ya</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Pemberian PMT</label>
                    <select name="pmt" id="pmt" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-600">
                        <option value="" disabled selected>Pilih Opsi</option>
                        <option value="Ya">Ya</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                    <input type="text" name="jenis_pmt" id="jenis_pmt" placeholder="Jenis yang diberikan" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-600">
                </div>
                <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-md hover:bg-green-700 transition duration-300">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </form>
        </div>
    </div>
</body>

</html>
