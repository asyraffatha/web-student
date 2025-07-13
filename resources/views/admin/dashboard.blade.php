<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white shadow-md border-b">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-700">Admin Dashboard</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-semibold shadow">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-6 py-10">
        <div class="mb-10">
            <h2 class="text-3xl font-semibold text-gray-800">Selamat Datang, Admin 🎉</h2>
            <p class="text-gray-600 mt-2">Kelola sistem dan pengguna melalui panel admin di bawah ini.</p>
        </div>

        <!-- Status Card -->
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-10 rounded shadow">
            <p class="text-green-800">
                ✅ Anda login sebagai <strong>{{ Auth::user()->name }}</strong> (<em>Admin</em>)
            </p>
        </div>

        <!-- Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- User Management -->
            <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition p-6 border-t-4 border-blue-600">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold text-gray-700">Manajemen Pengguna</h3>
                    <div class="bg-blue-100 text-blue-600 p-2 rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5.121 17.804A4 4 0 019 15h6a4 4 0 013.879 2.804M15 11a3 3 0 10-6 0 3 3 0 006 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-gray-600 mb-6">Kelola akun guru, siswa, dan admin dari satu tempat.</p>
                <a href="{{ route('admin.user.index') }}"
                    class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition">
                    Kelola Pengguna
                </a>
            </div>

            <!-- Tambahkan kartu fitur lainnya di sini jika perlu -->
        </div>
    </div>

    <footer class="text-center py-6 text-sm text-gray-500">
        &copy; {{ date('Y') }} Sistem Administrasi. All rights reserved.
    </footer>

</body>

</html>
