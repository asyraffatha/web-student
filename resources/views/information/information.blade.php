<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Informasi Siswa</title>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen flex items-center justify-center bg-no-repeat bg-center bg-cover"
    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); background-image: url('storage/images/LogoTA.png'), linear-gradient(135deg, #667eea 0%, #764ba2 100%); background-size: 400px, cover; background-position: center; background-repeat: no-repeat;">

    <div class="w-full max-w-2xl bg-white bg-opacity-90 backdrop-blur-md p-8 rounded-2xl shadow-2xl">
        <h1 class="text-3xl font-extrabold text-blue-800 mb-6 border-b pb-2 text-center">📄 Informasi Siswa</h1>

        @if (session('success'))
            <div class="mb-6 px-4 py-3 bg-green-100 text-green-700 rounded-lg shadow">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if ($setting)
            <!-- Foto Profil -->
            <div class="flex justify-center mb-6">
                <<img src="{{ asset('storage/' . $setting->foto) }}" alt="Foto Profil Siswa"
                    style="width: 150px; height: 150px; border-radius: 50%;">
            </div>

            <div class="space-y-4 text-gray-800 text-lg">
                <p><span class="font-semibold">👤 Nama Lengkap:</span> {{ $setting->nama }}</p>
                <p><span class="font-semibold">📘 NISN:</span> {{ $setting->nisn }}</p>
                <p><span class="font-semibold">🏫 Kelas:</span> {{ $setting->kelas }}</p>
                <p><span class="font-semibold">🎂 Tanggal Lahir:</span>
                    {{ \Carbon\Carbon::parse($setting->tgl_lahir)->format('d M Y') }}</p>
                <p><span class="font-semibold">🏡 Alamat:</span> {{ $setting->alamat }}</p>
                <p><span class="font-semibold">🚻 Jenis Kelamin:</span> {{ $setting->jenis_kelamin }}</p>
            </div>

            <div class="mt-8 flex justify-center gap-6">
                <a href="/setting"
                    class="inline-flex items-center gap-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    ✏️ Edit
                </a>
                <form action="{{ route('setting.destroy', $setting->id) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus data siswa ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center gap-1 px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                        🗑️ Hapus
                    </button>
                </form>
            </div>
        @else
            <div class="text-center text-yellow-800 bg-yellow-100 px-6 py-4 rounded-lg shadow">
                ⚠️ Belum ada informasi siswa yang diinput.
            </div>

            <div class="mt-6 text-center">
                <a href="/setting"
                    class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                    ➕ Tambahkan Informasi Siswa
                </a>
            </div>
        @endif

        <div class="mt-8 text-center">
            <a href="/home" class="text-gray-500 hover:underline">← Kembali ke Beranda</a>
        </div>
    </div>
</body>

</html>
