<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-gray-800 text-white shadow">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold">Admin Panel</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-4 py-10">
        <h2 class="text-3xl font-semibold mb-6">Selamat Datang Admin</h2>

        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-8">
            Selamat datang, <strong>{{ Auth::user()->name }}</strong>! Anda login sebagai <strong>Admin</strong>.
        </div>

        <!-- Card Manajemen User -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-6">
                <div class="flex items-center mb-4">
                    <div class="bg-blue-500 text-white rounded-full p-2">
                        <!-- User Icon -->
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5.121 17.804A4 4 0 019 15h6a4 4 0 013.879 2.804M15 11a3 3 0 10-6 0 3 3 0 006 0z" />
                        </svg>
                    </div>
                    <h3 class="ml-4 text-xl font-bold text-gray-700">Manajemen User</h3>
                </div>
                <p class="text-gray-600 mb-4">Kelola akun pengguna seperti Guru dan Siswa.</p>
                <a href="{{ route('admin.user.index') }}"
                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                    Lihat
                </a>
            </div>
        </div>
    </div>

    <footer class="text-center py-6 text-sm text-gray-500">
        &copy; {{ date('Y') }} Sistem Admin. All rights reserved.
    </footer>

</body>

</html>
