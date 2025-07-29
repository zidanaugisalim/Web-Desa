<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Desa Bangunharjo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            background-color: #f8fafc;
        }
        .bg-register {
            background-image: url('https://source.unsplash.com/random/1920x1080/?nature');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="font-sans text-gray-800">
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Left Side - Background Image -->
        <div class="hidden md:flex md:w-1/2 bg-green-600 items-center justify-center p-12">
            <div class="text-white text-center">
                <h1 class="text-4xl font-bold mb-4">Bergabunglah Bersama Kami</h1>
                <p class="text-xl">Daftar untuk menjadi bagian dari Desa Bangunharjo</p>
            </div>
        </div>

        <!-- Right Side - Register Form -->
        <div class="w-full md:w-1/2 flex items-center justify-center p-8">
            <div class="w-full max-w-md">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-800">Buat Akun Baru</h2>
                    <p class="text-gray-600 mt-2">Isi data diri Anda dengan benar</p>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register.submit') }}" class="space-y-4">
                    @csrf
                    
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                class="focus:ring-green-500 focus:border-green-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md p-2 border"
                                placeholder="Nama lengkap">
                        </div>
                    </div>

                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-at text-gray-400"></i>
                            </div>
                            <input type="text" id="username" name="username" value="{{ old('username') }}" required
                                class="focus:ring-green-500 focus:border-green-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md p-2 border"
                                placeholder="username">
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                class="focus:ring-green-500 focus:border-green-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md p-2 border"
                                placeholder="email@contoh.com">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input type="password" id="password" name="password" required
                                class="focus:ring-green-500 focus:border-green-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md p-2 border"
                                placeholder="Minimal 8 karakter">
                        </div>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                class="focus:ring-green-500 focus:border-green-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md p-2 border"
                                placeholder="Ketik ulang password">
                        </div>
                    </div>

                    <div class="flex items-center">
                        <input id="terms" name="terms" type="checkbox" required
                            class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                        <label for="terms" class="ml-2 block text-sm text-gray-700">
                            Saya menyetujui <a href="#" class="text-green-600 hover:text-green-500">syarat dan ketentuan</a>
                        </label>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Daftar Sekarang
                        </button>
                    </div>
                </form>

                <div class="mt-6">
                    <p class="text-center text-sm text-gray-600">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="font-medium text-green-600 hover:text-green-500">
                            Masuk disini
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
