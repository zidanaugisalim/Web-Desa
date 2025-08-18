<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Bangunharjo - Portal Resmi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

        :root {
            --primary-color: #059669;
            --primary-dark: #047857;
            --secondary-color: #10b981;
            --accent-color: #34d399;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --bg-light: #f8fafc;
            --bg-white: #ffffff;
        }

        * {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e5f3f0 100%);
            line-height: 1.6;
        }

        .hero-overlay {
            background: linear-gradient(135deg, rgba(5, 150, 105, 0.8) 0%, rgba(4, 120, 87, 0.9) 100%);
        }

        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: #34d399;
            transform: translateY(-2px);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 50%;
            background: #34d399;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .feature-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid rgba(5, 150, 105, 0.1);
        }

        .feature-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px rgba(5, 150, 105, 0.15);
            border-color: rgba(5, 150, 105, 0.3);
        }

        .gradient-text {
            background: linear-gradient(135deg, #059669 0%, #10b981 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .btn-primary {
            background: linear-gradient(135deg, #059669 0%, #10b981 100%);
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(5, 150, 105, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(5, 150, 105, 0.4);
        }

        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .pulse-animation {
            animation: pulse 2s infinite;
        }

        .mobile-menu {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .mobile-menu.active {
            transform: translateX(0);
        }

        .stats-counter {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary-color);
        }

        .parallax-bg {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .news-card {
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .news-card img {
            transition: transform 0.3s ease;
        }

        .news-card:hover img {
            transform: scale(1.1);
        }

        .scroll-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: var(--primary-color);
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            opacity: 0;
            visibility: hidden;
            z-index: 1000;
        }

        .scroll-to-top.visible {
            opacity: 1;
            visibility: visible;
        }

        .scroll-to-top:hover {
            background: var(--primary-dark);
            transform: translateY(-3px);
        }

        .loading-spinner {
            border: 3px solid #f3f3f3;
            border-top: 3px solid var(--primary-color);
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .dark-mode {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            color: #ffffff;
        }

        .dark-mode .feature-card {
            background: linear-gradient(145deg, #2d2d2d 0%, #1a1a1a 100%);
            border-color: rgba(52, 211, 153, 0.2);
        }

        .dark-mode .bg-white {
            background: #2d2d2d !important;
            color: #ffffff;
        }

        .dark-mode .text-gray-800 {
            color: #ffffff !important;
        }

        .dark-mode .text-gray-700 {
            color: #d1d5db !important;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .stats-counter {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body id="body">
    <!-- Loading Screen -->
    <div id="loading-screen" class="fixed inset-0 bg-white z-50 flex items-center justify-center">
        <div class="text-center">
            <div class="loading-spinner mx-auto mb-4"></div>
            <p class="text-gray-600">Memuat halaman...</p>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="bg-gradient-to-r from-green-700 to-green-600 text-white shadow-xl fixed w-full z-40 top-0 transition-all duration-300" id="navbar">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center space-x-3" data-aos="fade-right">
                    <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/aad8ce4b-de3d-413a-97e9-47bea336b2ec.png" 
                         alt="Logo Desa Bangunharjo" 
                         class="rounded-full w-12 h-12 floating-animation">
                    <div>
                        <span class="text-xl font-bold gradient-text-white">Desa Bangunharjo</span>
                        <p class="text-xs text-green-200">Portal Resmi</p>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden lg:flex space-x-8" data-aos="fade-down">
                    <a href="#beranda" class="nav-link">
                        <i class="fas fa-home mr-2"></i>Beranda
                    </a>
                    <a href="#tentang" class="nav-link">
                        <i class="fas fa-info-circle mr-2"></i>Tentang
                    </a>
                    <a href="#fitur" class="nav-link">
                        <i class="fas fa-star mr-2"></i>Fitur
                    </a>
                    <a href="#data" class="nav-link">
                        <i class="fas fa-chart-bar mr-2"></i>Data
                    </a>
                    <a href="#berita" class="nav-link">
                        <i class="fas fa-newspaper mr-2"></i>Berita
                    </a>
                    <a href="#kontak" class="nav-link">
                        <i class="fas fa-envelope mr-2"></i>Kontak
                    </a>
                </div>

                <!-- Action Buttons & Theme Toggle -->
                <div class="flex items-center space-x-3" data-aos="fade-left">
                    <!-- Dark Mode Toggle -->
                    <button id="theme-toggle" class="p-2 rounded-full hover:bg-green-600 transition-colors duration-300">
                        <i class="fas fa-moon" id="theme-icon"></i>
                    </button>

                    <!-- Auth Buttons -->
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-primary text-white px-6 py-2 rounded-full font-medium flex items-center space-x-2">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="bg-white text-green-700 px-4 py-2 rounded-full font-medium hover:bg-green-50 transition duration-300 flex items-center space-x-2">
                            <i class="fas fa-sign-in-alt"></i>
                            <span>Login</span>
                        </a>
                        <a href="{{ route('register') }}" class="btn-primary text-white px-4 py-2 rounded-full font-medium flex items-center space-x-2">
                            <i class="fas fa-user-plus"></i>
                            <span>Daftar</span>
                        </a>
                    @endauth

                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-md hover:bg-green-600 transition-colors duration-300">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="mobile-menu lg:hidden fixed top-0 left-0 w-80 h-full bg-green-800 z-50 p-6">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-xl font-bold">Menu</h3>
                <button id="close-mobile-menu" class="p-2 rounded-md hover:bg-green-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <nav class="space-y-4">
                <a href="#beranda" class="block py-3 px-4 rounded-md hover:bg-green-700 transition-colors duration-300 mobile-menu-link">
                    <i class="fas fa-home mr-3"></i>Beranda
                </a>
                <a href="#tentang" class="block py-3 px-4 rounded-md hover:bg-green-700 transition-colors duration-300 mobile-menu-link">
                    <i class="fas fa-info-circle mr-3"></i>Tentang
                </a>
                <a href="#fitur" class="block py-3 px-4 rounded-md hover:bg-green-700 transition-colors duration-300 mobile-menu-link">
                    <i class="fas fa-star mr-3"></i>Fitur
                </a>
                <a href="#data" class="block py-3 px-4 rounded-md hover:bg-green-700 transition-colors duration-300 mobile-menu-link">
                    <i class="fas fa-chart-bar mr-3"></i>Data
                </a>
                <a href="#berita" class="block py-3 px-4 rounded-md hover:bg-green-700 transition-colors duration-300 mobile-menu-link">
                    <i class="fas fa-newspaper mr-3"></i>Berita
                </a>
                <a href="#kontak" class="block py-3 px-4 rounded-md hover:bg-green-700 transition-colors duration-300 mobile-menu-link">
                    <i class="fas fa-envelope mr-3"></i>Kontak
                </a>
            </nav>
        </div>
    </nav>

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>

    <!-- Hero Section -->
    <section id="beranda" class="relative min-h-screen flex items-center justify-center parallax-bg" style="background-image: url('https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/089d17cd-06de-48cf-bd5c-63fe2b49f43d.png');">
        <div class="hero-overlay absolute inset-0"></div>
        
        <!-- Hero Content -->
        <div class="relative z-10 text-center text-white px-4 max-w-6xl mx-auto">
            <div class="animate__animated animate__fadeInUp">
                <h1 class="hero-title text-5xl md:text-7xl font-bold mb-6 leading-tight">
                    Selamat Datang di
                    <span class="block gradient-text-white">Desa Bangunharjo</span>
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-green-100 max-w-3xl mx-auto leading-relaxed">
                    Desa yang asri dengan masyarakat yang ramah, budaya yang kaya, dan teknologi yang modern untuk pelayanan terbaik
                </p>
                
                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-12">
                    <a href="#tentang" class="btn-primary text-white px-8 py-4 rounded-full font-semibold text-lg flex items-center space-x-3 group">
                        <i class="fas fa-compass"></i>
                        <span>Jelajahi Desa Kami</span>
                        <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    <a href="#data" class="glass-effect text-white px-8 py-4 rounded-full font-semibold text-lg flex items-center space-x-3 hover:bg-white hover:bg-opacity-20 transition-all duration-300">
                        <i class="fas fa-chart-line"></i>
                        <span>Lihat Data Desa</span>
                    </a>
                </div>

                <!-- Statistics -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-16">
                    <div class="glass-effect p-6 rounded-2xl text-center" data-aos="fade-up" data-aos-delay="100">
                        <div class="stats-counter" data-target="1250">31.977</div>
                        <p class="text-green-200 font-medium">Penduduk</p>
                    </div>
                    <div class="glass-effect p-6 rounded-2xl text-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="stats-counter" data-target="350">0</div>
                        <p class="text-green-200 font-medium">Keluarga</p>
                    </div>
                    <div class="glass-effect p-6 rounded-2xl text-center" data-aos="fade-up" data-aos-delay="300">
                        <div class="stats-counter" data-target="15">0</div>
                        <p class="text-green-200 font-medium">RT/RW</p>
                    </div>
                    <div class="glass-effect p-6 rounded-2xl text-center" data-aos="fade-up" data-aos-delay="400">
                        <div class="stats-counter" data-target="98">0</div>
                        <p class="text-green-200 font-medium">% Literasi</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 text-white animate-bounce">
            <a href="#tentang" class="flex flex-col items-center space-y-2">
                <span class="text-sm">Scroll untuk melihat lebih</span>
                <i class="fas fa-chevron-down text-xl"></i>
            </a>
        </div>
    </section>

    <!-- About Section -->
    <section id="tentang" class="py-20 bg-gradient-to-br from-white to-green-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl md:text-5xl font-bold mb-6 gradient-text">Tentang Desa Bangunharjo</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Mengenal lebih dekat desa yang kaya akan budaya, tradisi, dan inovasi modern
                </p>
            </div>

            <div class="grid lg:grid-cols-2 gap-12 items-center mb-16">
                <div data-aos="fade-right">
                    <div class="space-y-6">
                        <div class="bg-white p-6 rounded-2xl shadow-lg border-l-4 border-green-500">
                            <h3 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-map-marker-alt text-green-600 mr-3"></i>
                                Lokasi Strategis
                            </h3>
                            <p class="text-gray-700 leading-relaxed">
                                Desa Bangunharjo terletak di Kecamatan Sewon, Kabupaten Bantul, Daerah Istimewa Yogyakarta. 
                                Posisi strategis ini menjadikan desa kami sebagai pintu gerbang menuju berbagai destinasi wisata 
                                dan pusat ekonomi di Yogyakarta.
                            </p>
                        </div>

                        <div class="bg-white p-6 rounded-2xl shadow-lg border-l-4 border-blue-500">
                            <h3 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-users text-blue-600 mr-3"></i>
                                Masyarakat Harmonis
                            </h3>
                            <p class="text-gray-700 leading-relaxed">
                                Desa ini terkenal dengan keindahan alamnya, keramahan warganya, dan kekayaan budaya yang masih 
                                terjaga dengan baik. Gotong royong dan toleransi menjadi nilai utama yang dipegang teguh.
                            </p>
                        </div>

                        <div class="bg-white p-6 rounded-2xl shadow-lg border-l-4 border-yellow-500">
                            <h3 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-seedling text-yellow-600 mr-3"></i>
                                Ekonomi Berkelanjutan
                            </h3>
                            <p class="text-gray-700 leading-relaxed">
                                Mata pencaharian utama penduduk adalah bertani dengan komoditas padi, sayuran, dan buah-buahan. 
                                Dikembangkan pula sektor kerajinan tangan dan UMKM untuk meningkatkan kesejahteraan masyarakat.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="relative" data-aos="fade-left">
                    <div class="relative">
                        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/43c24357-4cfb-4941-a451-aaca67b751a0.png" 
                             alt="Peta Desa Bangunharjo" 
                             class="rounded-2xl shadow-2xl w-full floating-animation">
                        <div class="absolute -top-4 -right-4 bg-green-500 text-white p-4 rounded-full">
                            <i class="fas fa-map text-2xl"></i>
                        </div>
                    </div>
                    
                    <!-- Info Cards -->
                    <div class="absolute -bottom-6 -left-6 bg-white p-4 rounded-xl shadow-lg">
                        <div class="flex items-center space-x-3">
                            <div class="bg-green-100 p-2 rounded-lg">
                                <i class="fas fa-home text-green-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Luas Wilayah</p>
                                <p class="font-bold text-gray-800">6.791.015 Ha</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vision Mission -->
            <div class="grid md:grid-cols-2 gap-8" data-aos="fade-up">
                <div class="bg-gradient-to-br from-green-500 to-green-600 text-white p-8 rounded-2xl">
                    <div class="flex items-center mb-6">
                        <div class="bg-white bg-opacity-20 p-3 rounded-full mr-4">
                            <i class="fas fa-eye text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold">Visi Desa</h3>
                    </div>
                    <p class="text-green-100 leading-relaxed">
                        "Mewujudkan Desa Bangunharjo sebagai desa yang maju, mandiri, dan sejahtera 
                        dengan tetap melestarikan nilai-nilai budaya lokal dan lingkungan yang berkelanjutan."
                    </p>
                </div>

                <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white p-8 rounded-2xl">
                    <div class="flex items-center mb-6">
                        <div class="bg-white bg-opacity-20 p-3 rounded-full mr-4">
                            <i class="fas fa-bullseye text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold">Misi Desa</h3>
                    </div>
                    <ul class="text-blue-100 space-y-2">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle mr-2 mt-1 text-blue-200"></i>
                            Meningkatkan kualitas pelayanan publik
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle mr-2 mt-1 text-blue-200"></i>
                            Mengembangkan potensi ekonomi lokal
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle mr-2 mt-1 text-blue-200"></i>
                            Melestarikan budaya dan lingkungan
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="fitur" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl md:text-5xl font-bold mb-6 gradient-text">Fitur Unggulan</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Layanan dan program inovatif untuk meningkatkan kualitas hidup masyarakat Desa Bangunharjo
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 mb-16">
                <div class="feature-card p-8 rounded-2xl text-center group" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative mb-6">
                        <div class="bg-gradient-to-br from-green-400 to-green-600 w-20 h-20 rounded-2xl mx-auto flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/8ffbcecd-efb5-4613-b25d-c1aea651cd80.png" alt="Pelayanan Administrasi" class="w-10 h-10">
                        </div>
                        <div class="absolute -top-2 -right-2 bg-green-500 text-white text-xs px-2 py-1 rounded-full">
                            24/7
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-800 group-hover:text-green-600 transition-colors">
                        Pelayanan Administrasi
                    </h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Layanan administrasi desa yang cepat, terpadu, dan digital untuk berbagai kebutuhan warga dengan sistem online yang mudah diakses.
                    </p>
                    <div class="flex justify-center space-x-4 text-sm text-gray-500">
                        <span class="flex items-center">
                            <i class="fas fa-clock mr-1 text-green-500"></i>
                            Cepat
                        </span>
                        <span class="flex items-center">
                            <i class="fas fa-shield-alt mr-1 text-green-500"></i>
                            Aman
                        </span>
                        <span class="flex items-center">
                            <i class="fas fa-mobile-alt mr-1 text-green-500"></i>
                            Digital
                        </span>
                    </div>
                </div>

                <div class="feature-card p-8 rounded-2xl text-center group" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative mb-6">
                        <div class="bg-gradient-to-br from-blue-400 to-blue-600 w-20 h-20 rounded-2xl mx-auto flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/78077819-198b-41b7-b346-0336348570fb.png" alt="Kegiatan Budaya" class="w-10 h-10">
                        </div>
                        <div class="absolute -top-2 -right-2 bg-blue-500 text-white text-xs px-2 py-1 rounded-full">
                            Aktif
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-800 group-hover:text-blue-600 transition-colors">
                        Kegiatan Budaya
                    </h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Beragam kegiatan budaya yang melestarikan warisan leluhur, mempererat kebersamaan, dan mengembangkan kreativitas masyarakat.
                    </p>
                    <div class="flex justify-center space-x-4 text-sm text-gray-500">
                        <span class="flex items-center">
                            <i class="fas fa-calendar mr-1 text-blue-500"></i>
                            Rutin
                        </span>
                        <span class="flex items-center">
                            <i class="fas fa-users mr-1 text-blue-500"></i>
                            Komunitas
                        </span>
                        <span class="flex items-center">
                            <i class="fas fa-heart mr-1 text-blue-500"></i>
                            Tradisi
                        </span>
                    </div>
                </div>

                <div class="feature-card p-8 rounded-2xl text-center group" data-aos="fade-up" data-aos-delay="300">
                    <div class="relative mb-6">
                        <div class="bg-gradient-to-br from-purple-400 to-purple-600 w-20 h-20 rounded-2xl mx-auto flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/82512c17-3560-4983-bef5-4f085f40ead6.png" alt="Program Pembangunan" class="w-10 h-10">
                        </div>
                        <div class="absolute -top-2 -right-2 bg-purple-500 text-white text-xs px-2 py-1 rounded-full">
                            2024
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-800 group-hover:text-purple-600 transition-colors">
                        Program Pembangunan
                    </h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Program pembangunan desa yang berkelanjutan, inovatif, dan partisipatif untuk meningkatkan kesejahteraan masyarakat.
                    </p>
                    <div class="flex justify-center space-x-4 text-sm text-gray-500">
                        <span class="flex items-center">
                            <i class="fas fa-chart-line mr-1 text-purple-500"></i>
                            Progresif
                        </span>
                        <span class="flex items-center">
                            <i class="fas fa-leaf mr-1 text-purple-500"></i>
                            Berkelanjutan
                        </span>
                        <span class="flex items-center">
                            <i class="fas fa-handshake mr-1 text-purple-500"></i>
                            Partisipatif
                        </span>
                    </div>
                </div>
            </div>

            <!-- Additional Features -->
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6" data-aos="fade-up">
                <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-xl text-center">
                    <div class="bg-green-500 w-12 h-12 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <i class="fas fa-wifi text-white text-xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 mb-2">WiFi Gratis</h4>
                    <p class="text-sm text-gray-600">Internet gratis di area publik</p>
                </div>

                <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl text-center">
                    <div class="bg-blue-500 w-12 h-12 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <i class="fas fa-heartbeat text-white text-xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 mb-2">Posyandu</h4>
                    <p class="text-sm text-gray-600">Layanan kesehatan rutin</p>
                </div>

                <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 p-6 rounded-xl text-center">
                    <div class="bg-yellow-500 w-12 h-12 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-white text-xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 mb-2">Pendidikan</h4>
                    <p class="text-sm text-gray-600">Program literasi digital</p>
                </div>

                <div class="bg-gradient-to-br from-red-50 to-red-100 p-6 rounded-xl text-center">
                    <div class="bg-red-500 w-12 h-12 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <i class="fas fa-shield-alt text-white text-xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 mb-2">Keamanan</h4>
                    <p class="text-sm text-gray-600">Sistem keamanan 24 jam</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Data Anak Section -->
    <section id="data" class="py-20 bg-gradient-to-br from-gray-50 to-gray-100">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl md:text-5xl font-bold mb-6 gradient-text">Data Anak Desa Bangunharjo</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Monitoring dan analisis data kesehatan anak untuk mendukung program stunting prevention
                </p>
            </div>

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Chart Container -->
                <div class="lg:col-span-2">
                    <div class="bg-white p-8 rounded-2xl shadow-lg" data-aos="fade-right">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-2xl font-bold text-gray-800">Distribusi Data Anak per Pengguna</h3>
                            <div class="flex space-x-2">
                                <button class="chart-toggle-btn active bg-green-100 text-green-600 p-2 rounded-lg hover:bg-green-200 transition-colors" data-chart="bar">
                                    <i class="fas fa-chart-bar"></i>
                                </button>
                                <button class="chart-toggle-btn bg-gray-100 text-gray-600 p-2 rounded-lg hover:bg-gray-200 transition-colors" data-chart="line">
                                    <i class="fas fa-chart-line"></i>
                                </button>
                                <button class="chart-toggle-btn bg-gray-100 text-gray-600 p-2 rounded-lg hover:bg-gray-200 transition-colors" data-chart="doughnut">
                                    <i class="fas fa-chart-pie"></i>
                                </button>
                            </div>
                        </div>
                        <div class="relative min-h-[300px] flex items-center justify-center">
                            <canvas id="anakChart" width="400" height="300"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="space-y-6" data-aos="fade-left">
                    <div class="bg-white p-6 rounded-2xl shadow-lg">
                        <div class="flex items-center justify-between mb-4">
                            <div class="bg-blue-100 p-3 rounded-xl">
                                <i class="fas fa-users text-blue-600 text-2xl"></i>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-500">Total Data Anak</p>
                                <p class="text-3xl font-bold text-gray-800" id="totalAnak">0</p>
                            </div>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full transition-all duration-500" style="width: 75%"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Data terdaftar di sistem</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-lg">
                        <div class="flex items-center justify-between mb-4">
                            <div class="bg-green-100 p-3 rounded-xl">
                                <i class="fas fa-heartbeat text-green-600 text-2xl"></i>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-500">Status Gizi Baik</p>
                                <p class="text-3xl font-bold text-gray-800">85%</p>
                            </div>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-600 h-2 rounded-full transition-all duration-500" style="width: 85%"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Meningkat 5% dari bulan lalu</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-lg">
                        <div class="flex items-center justify-between mb-4">
                            <div class="bg-yellow-100 p-3 rounded-xl">
                                <i class="fas fa-exclamation-triangle text-yellow-600 text-2xl"></i>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-500">Perlu Perhatian</p>
                                <p class="text-3xl font-bold text-gray-800">12</p>
                            </div>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-yellow-600 h-2 rounded-full transition-all duration-500" style="width: 15%"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Menurun 3 anak dari bulan lalu</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-lg">
                        <div class="flex items-center justify-between mb-4">
                            <div class="bg-purple-100 p-3 rounded-xl">
                                <i class="fas fa-chart-line text-purple-600 text-2xl"></i>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-500">Pengguna Aktif</p>
                                <p class="text-3xl font-bold text-gray-800" id="activeUsersCount">-</p>
                            </div>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-purple-600 h-2 rounded-full transition-all duration-500" style="width: 90%"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Tingkat partisipasi tinggi</p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-12 text-center" data-aos="fade-up">
                <div class="bg-white p-8 rounded-2xl shadow-lg inline-block">
                    <h4 class="text-xl font-bold text-gray-800 mb-6">Aksi Cepat</h4>
                    <div class="flex flex-wrap justify-center gap-4">
                        <a href="/login" class="btn-primary inline-flex items-center px-6 py-3 rounded-xl">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Data Anak
                        </a>
                        <a href="/login" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl transition-colors inline-flex items-center">
                            <i class="fas fa-download mr-2"></i>
                            Export Data
                        </a>
                        <a href="/login" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-xl transition-colors inline-flex items-center">
                            <i class="fas fa-chart-bar mr-2"></i>
                            Lihat Laporan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
        
    <!-- News Section -->
    <section id="berita" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl md:text-5xl font-bold mb-6 gradient-text">Berita Terbaru</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Informasi terkini seputar kegiatan dan perkembangan Desa Bangunharjo
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 mb-12">
                <article class="news-card group" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative overflow-hidden rounded-2xl">
                        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/e9dbf11d-00fd-4229-8634-8f971ace849c.png" 
                             alt="Gotong Royong Bersih Desa" 
                             class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                Lingkungan
                            </span>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <i class="fas fa-calendar mr-2"></i>
                            <span>25 Mei 2023</span>
                            <span class="mx-2">•</span>
                            <i class="fas fa-user mr-2"></i>
                            <span>Admin Desa</span>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-800 group-hover:text-green-600 transition-colors">
                            Gotong Royong Bersih Desa
                        </h3>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Warga Desa Bangunharjo bersama-sama membersihkan lingkungan untuk menyambut musim penghujan dengan semangat kebersamaan.
                        </p>
                        <div class="flex items-center justify-between">
                            <a href="#" class="text-green-600 hover:text-green-700 font-medium inline-flex items-center group">
                                Baca selengkapnya
                                <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                            <div class="flex items-center text-gray-400 text-sm">
                                <i class="fas fa-eye mr-1"></i>
                                <span>245</span>
                            </div>
                        </div>
                    </div>
                </article>

                <article class="news-card group" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative overflow-hidden rounded-2xl">
                        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/5c4d8fd4-a684-4a54-9b1e-257f831c2858.png" 
                             alt="Pelatihan Kerajinan Tangan" 
                             class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                Ekonomi
                            </span>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <i class="fas fa-calendar mr-2"></i>
                            <span>18 Mei 2023</span>
                            <span class="mx-2">•</span>
                            <i class="fas fa-user mr-2"></i>
                            <span>Admin Desa</span>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-800 group-hover:text-blue-600 transition-colors">
                            Pelatihan Kerajinan Tangan
                        </h3>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Pemerintah desa mengadakan pelatihan pembuatan kerajinan tangan untuk meningkatkan ekonomi kreatif warga.
                        </p>
                        <div class="flex items-center justify-between">
                            <a href="#" class="text-blue-600 hover:text-blue-700 font-medium inline-flex items-center group">
                                Baca selengkapnya
                                <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                            <div class="flex items-center text-gray-400 text-sm">
                                <i class="fas fa-eye mr-1"></i>
                                <span>189</span>
                            </div>
                        </div>
                    </div>
                </article>

                <article class="news-card group" data-aos="fade-up" data-aos-delay="300">
                    <div class="relative overflow-hidden rounded-2xl">
                        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/d9ce5cc7-3023-4fae-a90c-8db9431da97f.png" 
                             alt="Kegiatan Posyandu Bulanan" 
                             class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                Kesehatan
                            </span>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <i class="fas fa-calendar mr-2"></i>
                            <span>10 Mei 2023</span>
                            <span class="mx-2">•</span>
                            <i class="fas fa-user mr-2"></i>
                            <span>Admin Desa</span>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-800 group-hover:text-red-600 transition-colors">
                            Kegiatan Posyandu Bulanan
                        </h3>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Kegiatan rutin posyandu untuk memantau tumbuh kembang balita dan kesehatan ibu hamil di lingkungan desa.
                        </p>
                        <div class="flex items-center justify-between">
                            <a href="#" class="text-red-600 hover:text-red-700 font-medium inline-flex items-center group">
                                Baca selengkapnya
                                <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                            <div class="flex items-center text-gray-400 text-sm">
                                <i class="fas fa-eye mr-1"></i>
                                <span>312</span>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

            <!-- Newsletter Subscription -->
            <div class="bg-gradient-to-r from-green-600 to-green-700 rounded-2xl p-8 text-center text-white" data-aos="fade-up">
                <div class="max-w-2xl mx-auto">
                    <h3 class="text-2xl font-bold mb-4">Dapatkan Berita Terbaru</h3>
                    <p class="mb-6 opacity-90">
                        Berlangganan newsletter kami untuk mendapatkan informasi terkini seputar kegiatan dan perkembangan Desa Bangunharjo
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                        <input type="email" 
                               placeholder="Masukkan email Anda" 
                               class="flex-1 px-4 py-3 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-white">
                        <button class="bg-white text-green-600 px-6 py-3 rounded-xl font-medium hover:bg-gray-100 transition-colors">
                            Berlangganan
                        </button>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12" data-aos="fade-up">
                <a href="#" class="btn-primary inline-flex items-center px-8 py-4 text-lg">
                    <i class="fas fa-newspaper mr-2"></i>
                    Lihat Semua Berita
                </a>
            </div>
        </div>
    </section>
    </div>

    <footer class="bg-green-800 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Desa Bangunharjo</h3>
                    <p class="text-green-200">Jalan Raya Bangunharjo No. 123, Kecamatan Sewon, Kabupaten Bantul, DIY</p>
                    <p class="text-green-200 mt-2">Email: bangunharjogumregah@gmail.com</p>
                    <p class="text-green-200">Telepon: (0274) 445437</p>
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
                    <div class="flex flex-col space-y-2">
                        <div class="flex items-center space-x-2">
                            <i class="fab fa-facebook text-green-200 text-xl"></i>
                            <a href="https://www.facebook.com/kalurahanbangunharjo" target="_blank" class="text-green-200 hover:text-white">kalurahanbangunharjo</a>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fab fa-instagram text-green-200 text-xl"></i>
                            <a href="https://www.instagram.com/kalurahanbangunharjo" target="_blank" class="text-green-200 hover:text-white">kalurahanbangunharjo</a>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fab fa-tiktok text-green-200 text-xl"></i>
                            <a href="https://www.tiktok.com/@kalurahanbangunharjo" target="_blank" class="text-green-200 hover:text-white">kalurahanbangunharjo</a>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fab fa-twitter text-green-200 text-xl"></i>
                            <a href="https://www.twitter.com/kalbangunharjo" target="_blank" class="text-green-200 hover:text-white">kalbangunharjo</a>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fab fa-youtube text-green-200 text-xl"></i>
                            <a href="https://www.youtube.com/c/KalurahanBangunharjo" target="_blank" class="text-green-200 hover:text-white">Kalurahan Bangunharjo</a>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-envelope text-green-200 text-xl"></i>
                            <a href="mailto:bangunharjogumregah@gmail.com" class="text-green-200 hover:text-white">bangunharjogumregah@gmail.com</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-t border-green-700 mt-8 pt-6 text-center text-green-200">
                <p>&copy; 2023 Desa Bangunharjo. Seluruh hak cipta dilindungi.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });

        // Loading Screen
        window.addEventListener('load', function() {
            const loadingScreen = document.getElementById('loading-screen');
            if (loadingScreen) {
                setTimeout(() => {
                    loadingScreen.style.opacity = '0';
                    setTimeout(() => {
                        loadingScreen.style.display = 'none';
                    }, 500);
                }, 1000);
            }
        });

        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
                const icon = this.querySelector('i');
                icon.classList.toggle('fa-bars');
                icon.classList.toggle('fa-times');
            });
        }

        // Dark Mode Toggle
        const darkModeBtn = document.getElementById('dark-mode-btn');
        if (darkModeBtn) {
            darkModeBtn.addEventListener('click', function() {
                document.documentElement.classList.toggle('dark');
                const icon = this.querySelector('i');
                icon.classList.toggle('fa-moon');
                icon.classList.toggle('fa-sun');
                
                // Save preference
                const isDark = document.documentElement.classList.contains('dark');
                localStorage.setItem('darkMode', isDark);
            });

            // Load saved preference
            const savedDarkMode = localStorage.getItem('darkMode');
            if (savedDarkMode === 'true') {
                document.documentElement.classList.add('dark');
                const icon = darkModeBtn.querySelector('i');
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            }
        }

        // Smooth Scrolling for Navigation Links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Scroll to Top Button
        const scrollToTopBtn = document.getElementById('scroll-to-top');
        if (scrollToTopBtn) {
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    scrollToTopBtn.classList.remove('opacity-0', 'pointer-events-none');
                    scrollToTopBtn.classList.add('opacity-100');
                } else {
                    scrollToTopBtn.classList.add('opacity-0', 'pointer-events-none');
                    scrollToTopBtn.classList.remove('opacity-100');
                }
            });

            scrollToTopBtn.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }

        // Navbar Background on Scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('nav');
            if (navbar) {
                if (window.scrollY > 50) {
                    navbar.classList.add('bg-white/95', 'backdrop-blur-md', 'shadow-lg');
                    navbar.classList.remove('bg-transparent');
                } else {
                    navbar.classList.remove('bg-white/95', 'backdrop-blur-md', 'shadow-lg');
                    navbar.classList.add('bg-transparent');
                }
            }
        });

        // Counter Animation
        function animateCounter(element, target, duration = 2000) {
            let start = 0;
            const increment = target / (duration / 16);
            
            function updateCounter() {
                start += increment;
                if (start < target) {
                    element.textContent = Math.floor(start);
                    requestAnimationFrame(updateCounter);
                } else {
                    element.textContent = target;
                }
            }
            updateCounter();
        }

        // Trigger counter animation when in view
        const observerOptions = {
            threshold: 0.5,
            rootMargin: '0px 0px -100px 0px'
        };

        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counters = entry.target.querySelectorAll('[data-count]');
                    counters.forEach(counter => {
                        const target = parseInt(counter.getAttribute('data-count'));
                        animateCounter(counter, target);
                    });
                    counterObserver.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observe hero stats section
        const heroStats = document.querySelector('.hero-stats');
        if (heroStats) {
            counterObserver.observe(heroStats);
        }

        // Chart Variables
        let currentChart = null;
        let chartData = null;
        
        // Fungsi untuk mengambil data anak per user
        async function fetchAnakPerUserData() {
            try {
                const response = await fetch('/api/anak-per-user');
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return await response.json();
            } catch (error) {
                console.error('Error fetching data:', error);
                return [];
            }
        }
        
        // Fungsi untuk mengambil total anak
        async function fetchTotalAnak() {
            try {
                const response = await fetch('/api/total-anak');
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                const data = await response.json();
                return data.total;
            } catch (error) {
                console.error('Error fetching total:', error);
                return 0;
            }
        }
        
        // Chart Toggle Functionality
        function initChartToggle() {
            const toggleBtns = document.querySelectorAll('.chart-toggle-btn');
            
            toggleBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Remove active class from all buttons
                    toggleBtns.forEach(b => {
                        b.classList.remove('active', 'bg-green-100', 'text-green-600');
                        b.classList.add('bg-gray-100', 'text-gray-600');
                    });
                    
                    // Add active class to clicked button
                    this.classList.add('active', 'bg-green-100', 'text-green-600');
                    this.classList.remove('bg-gray-100', 'text-gray-600');
                    
                    // Get chart type and update chart
                    const chartType = this.getAttribute('data-chart');
                    updateChart(chartType);
                });
            });
        }

        // Update Chart Function
        function updateChart(type) {
            if (currentChart) {
                currentChart.destroy();
            }
            
            if (!chartData || chartData.length === 0) {
                return;
            }
            
            const ctx = document.getElementById('anakChart').getContext('2d');
            const labels = chartData.map(item => item.name);
            const data = chartData.map(item => item.jumlah_anak);
            
            const colors = [
                'rgba(34, 197, 94, 0.8)',
                'rgba(59, 130, 246, 0.8)',
                'rgba(168, 85, 247, 0.8)',
                'rgba(245, 158, 11, 0.8)',
                'rgba(239, 68, 68, 0.8)',
                'rgba(20, 184, 166, 0.8)'
            ];
            
            let chartConfig = {
                type: type,
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Anak',
                        data: data,
                        backgroundColor: type === 'doughnut' ? colors.slice(0, data.length) : 'rgba(34, 197, 94, 0.8)',
                        borderColor: type === 'doughnut' ? colors.slice(0, data.length) : 'rgba(34, 197, 94, 1)',
                        borderWidth: 2,
                        tension: type === 'line' ? 0.4 : 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: type === 'doughnut' ? 'right' : 'top',
                            labels: {
                                usePointStyle: true,
                                padding: 20
                            }
                        },
                        title: {
                            display: true,
                            text: 'Distribusi Data Anak per Pengguna',
                            font: {
                                size: 16,
                                weight: 'bold'
                            }
                        }
                    },
                    scales: type === 'doughnut' ? {} : {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            };
            
            currentChart = new Chart(ctx, chartConfig);
        }

        // Fungsi untuk membuat grafik
        async function createChart() {
            // Mengambil data
            const userData = await fetchAnakPerUserData();
            const totalAnak = await fetchTotalAnak();
            
            // Menyimpan data untuk chart toggle
            chartData = userData;
            
            // Menampilkan total anak
            document.getElementById('totalAnak').textContent = totalAnak;
            
            // Update active users count
            const activeUsersElement = document.getElementById('activeUsersCount');
            if (activeUsersElement) {
                activeUsersElement.textContent = userData.length;
            }
            
            // Jika tidak ada data, tampilkan pesan
            if (userData.length === 0) {
                const chartContainer = document.getElementById('anakChart').parentNode;
                chartContainer.innerHTML = '<div class="flex items-center justify-center h-full"><p class="text-gray-500 text-center">Belum ada data anak yang tersedia.<br>Data akan muncul setelah pengguna menginput data anak.</p></div>';
                return;
            }
            
            // Initialize chart with default type (bar)
            updateChart('bar');
            
            // Initialize chart toggle functionality
            initChartToggle();
        }
        
        // Memanggil fungsi untuk membuat grafik saat halaman dimuat
        document.addEventListener('DOMContentLoaded', createChart);
    </script>
</body>
</html>