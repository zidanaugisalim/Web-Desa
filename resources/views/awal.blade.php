<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Bangunharjo - Portal Resmi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
        }

        .hero-overlay {
            background: rgba(0, 0, 0, 0.5);
        }

        .nav-link:hover {
            text-decoration: underline;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="bg-green-700 text-white shadow-lg">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/aad8ce4b-de3d-413a-97e9-47bea336b2ec.png" alt="Logo Desa Bangunharjo" class="rounded-full w-12 h-12" data-aos="fade-left">
                <span class="text-xl font-bold">Desa Bangunharjo</span>
            </div>
            <div class="hidden md:flex space-x-6">
                <a href="#" class="nav-link hover:text-green-200">Beranda</a>
                <a href="#" class="nav-link hover:text-green-200">Profil Desa</a>
                <a href="#" class="nav-link hover:text-green-200">Pelayanan</a>
                <a href="#" class="nav-link hover:text-green-200">Berita</a>
                <a href="#" class="nav-link hover:text-green-200">Galeri</a>
            </div>
            <div>
                @auth
                    <a href="{{ route('dashboard') }}" class="bg-white text-green-700 px-4 py-2 rounded-md font-medium hover:bg-green-50 transition duration-300">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="bg-white text-green-700 px-4 py-2 rounded-md font-medium hover:bg-green-50 transition duration-300">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="ml-2 bg-green-600 text-white px-4 py-2 rounded-md font-medium hover:bg-green-700 transition duration-300">
                        Daftar
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative h-96">
        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/089d17cd-06de-48cf-bd5c-63fe2b49f43d.png" alt="Pemandangan Desa Bangunharjo" class="w-full h-full object-cover">
        <div class="hero-overlay absolute inset-0 flex items-center justify-center">
            <div class="text-center text-white px-4">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Selamat Datang di Desa Bangunharjo</h1>
                <p class="text-xl mb-8">Desa yang asri dengan masyarakat yang ramah dan budaya yang kaya</p>
                <a href="#" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-md font-medium transition duration-300">Jelajahi Desa Kami</a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-12">
        <!-- Tentang Desa -->
        <section class="mb-16">
            <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">Tentang Desa Bangunharjo</h2>
            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <p class="text-gray-700 mb-4">Desa Bangunharjo adalah desa yang terletak di Kecamatan Sewon, Kabupaten Bantul, Daerah Istimewa Yogyakarta. Desa ini terkenal dengan keindahan alamnya, keramahan warganya, dan kekayaan budaya yang masih terjaga dengan baik.</p>
                    <p class="text-gray-700">Mata pencaharian utama penduduk Desa Bangunharjo adalah bertani, dengan komoditas utama berupa padi, sayuran, dan buah-buahan. Selain itu, beberapa warga juga bekerja sebagai pengrajin kerajinan tangan dan pedagang.</p>
                </div>
                <div class="flex justify-center">
                    <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/43c24357-4cfb-4941-a451-aaca67b751a0.png" alt="Peta Desa Bangunharjo" class="rounded-lg shadow-md w-64" data-aos="fade-right">
                </div>
            </div>
        </section>

        <!-- Fitur Unggulan -->
        <section class="mb-16">
            <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">Fitur Unggulan</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="feature-card bg-white p-6 rounded-lg shadow-md transition duration-300" data-aos="fade-up">
                    <div class="text-center mb-4">
                        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/8ffbcecd-efb5-4613-b25d-c1aea651cd80.png" alt="Pelayanan Administrasi" class="mx-auto w-16 h-16">
                    </div>
                    <h3 class="text-xl font-semibold text-center mb-2 text-green-700">Pelayanan Administrasi</h3>
                    <p class="text-gray-700 text-center">Layanan administrasi desa yang cepat dan terpadu untuk berbagai kebutuhan warga.</p>
                </div>
                <div class="feature-card bg-white p-6 rounded-lg shadow-md transition duration-300" data-aos="fade-up">
                    <div class="text-center mb-4">
                        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/78077819-198b-41b7-b346-0336348570fb.png" alt="Kegiatan Budaya" class="mx-auto w-16 h-16">
                    </div>
                    <h3 class="text-xl font-semibold text-center mb-2 text-green-700">Kegiatan Budaya</h3>
                    <p class="text-gray-700 text-center">Beragam kegiatan budaya yang melestarikan warisan leluhur dan mempererat kebersamaan.</p>
                </div>
                <div class="feature-card bg-white p-6 rounded-lg shadow-md transition duration-300" data-aos="fade-up">
                    <div class="text-center mb-4">
                        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/82512c17-3560-4983-bef5-4f085f40ead6.png" alt="Program Pembangunan" class="mx-auto w-16 h-16">
                    </div>
                    <h3 class="text-xl font-semibold text-center mb-2 text-green-700">Program Pembangunan</h3>
                    <p class="text-gray-700 text-center">Program pembangunan desa yang berkelanjutan untuk kesejahteraan masyarakat.</p>
                </div>
            </div>
        </section>

        <!-- Berita Terbaru -->
        <section class="mb-16">
            <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">Berita Terbaru</h2>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg shadow-md overflow-hidden" data-aos="fade-left">
                    <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/e9dbf11d-00fd-4229-8634-8f971ace849c.png" alt="Gotong Royong Bersih Desa" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <div class="text-sm text-gray-500 mb-2">25 Mei 2023</div>
                        <h3 class="font-semibold text-lg mb-2">Gotong Royong Bersih Desa</h3>
                        <p class="text-gray-700">Warga Desa Bangunharjo bersama-sama membersihkan lingkungan untuk menyambut musim penghujan.</p>
                        <a href="#" class="text-green-600 hover:underline mt-2 inline-block">Baca selengkapnya</a>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden" data-aos="fade-right">
                    <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/5c4d8fd4-a684-4a54-9b1e-257f831c2858.png" alt="Pelatihan Kerajinan Tangan" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <div class="text-sm text-gray-500 mb-2">18 Mei 2023</div>
                        <h3 class="font-semibold text-lg mb-2">Pelatihan Kerajinan Tangan</h3>
                        <p class="text-gray-700">Pemerintah desa mengadakan pelatihan pembuatan kerajinan tangan untuk meningkatkan ekonomi warga.</p>
                        <a href="#" class="text-green-600 hover:underline mt-2 inline-block">Baca selengkapnya</a>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden" data-aos="fade-left">
                    <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/d9ce5cc7-3023-4fae-a90c-8db9431da97f.png" alt="Kegiatan Posyandu Bulanan" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <div class="text-sm text-gray-500 mb-2">10 Mei 2023</div>
                        <h3 class="font-semibold text-lg mb-2">Kegiatan Posyandu Bulanan</h3>
                        <p class="text-gray-700">Kegiatan rutin posyandu untuk memantau tumbuh kembang balita dan kesehatan ibu hamil.</p>
                        <a href="#" class="text-green-600 hover:underline mt-2 inline-block">Baca selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="text-center mt-8">
                <a href="#" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md font-medium transition duration-300">Lihat Semua Berita</a>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer class="bg-green-800 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Desa Bangunharjo</h3>
                    <p class="text-green-200">Jalan Raya Bangunharjo No. 123, Kecamatan Sewon, Kabupaten Bantul, DIY</p>
                    <p class="text-green-200 mt-2">Email: info@bangunharjo.desa.id</p>
                    <p class="text-green-200">Telepon: (0274) 1234567</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Menu</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-green-200 hover:text-white">Beranda</a></li>
                        <li><a href="#" class="text-green-200 hover:text-white">Profil Desa</a></li>
                        <li><a href="#" class="text-green-200 hover:text-white">Pelayanan</a></li>
                        <li><a href="#" class="text-green-200 hover:text-white">Berita</a></li>
                        <li><a href="#" class="text-green-200 hover:text-white">Galeri</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Pelayanan</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-green-200 hover:text-white">Administrasi Kependudukan</a></li>
                        <li><a href="#" class="text-green-200 hover:text-white">Surat Menyurat</a></li>
                        <li><a href="#" class="text-green-200 hover:text-white">Bantuan Sosial</a></li>
                        <li><a href="#" class="text-green-200 hover:text-white">Kesehatan</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Media Sosial</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-green-200 hover:text-white">
                            <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/1ad29351-2bce-4011-83f6-1c8ae3931d3e.png" alt="Icon Facebook" class="w-8 h-8" data-aos="fade-up-right">
                        </a>
                        <a href="#" class="text-green-200 hover:text-white">
                            <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/1d085b7a-1e88-44fa-9666-967ef0662d7b.png" alt="Icon Instagram" class="w-8 h-8" data-aos="fade-up-left">
                        </a>
                        <a href="#" class="text-green-200 hover:text-white">
                            <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/d78f8e51-1ea1-49ff-b3a1-d1c31eca44d4.png" alt="Icon YouTube" class="w-8 h-8" data-aos="fade-up-right">
                        </a>
                        <a href="#" class="text-green-200 hover:text-white">
                            <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/44ba075e-11ce-41f8-baa8-5de484cabb7c.png" alt="Icon WhatsApp" class="w-8 h-8" data-aos="fade-up-left">
                        </a>
                    </div>
                    <div class="mt-4">
                        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/1c5b6a7d-ec8d-49f8-ac76-b560acc29dff.png" alt="QR Code" class="mx-auto w-32" data-aos="fade-right">
                    </div>
                </div>
            </div>
            <div class="border-t border-green-700 mt-8 pt-6 text-center text-green-200">
                <p>&copy; 2023 Desa Bangunharjo. Seluruh hak cipta dilindungi.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>
