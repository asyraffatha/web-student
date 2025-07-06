<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Informasi Siswa</title>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-no-repeat bg-center bg-cover"
    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); background-image: url('storage/images/LogoTA.png'), linear-gradient(135deg, #667eea 0%, #764ba2 100%); background-size: 400px, cover; background-position: center; background-repeat: no-repeat;">

    <main class="container mx-auto px-4 py-10">
        <div class="max-w-5xl mx-auto bg-white/90 p-10 rounded-xl shadow-2xl backdrop-blur-md">
            <h1 class="text-3xl font-bold text-gray-800 mb-8 flex items-center gap-3">
                <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                </svg>
                Edit Informasi Siswa
            </h1>

            <form action="{{ route('setting.update', $setting->id) }}" method="POST" enctype="multipart/form-data"
                class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @csrf
                @method('PUT')

                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-1">Foto Profile</label>
                    <input type="file" name="foto" accept="image/*"
                        class="w-full border rounded-lg px-4 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    @if ($setting->foto)
                        <p class="text-sm mt-1">
                            Foto saat ini:
                            <a href="{{ asset('storage/' . $setting->foto) }}" target="_blank"
                                class="text-blue-600 hover:underline">Lihat</a>
                        </p>
                    @endif
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama', $setting->nama) }}" required
                        class="w-full border rounded-lg px-4 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">NISN</label>
                    <input type="text" name="nisn" value="{{ old('nisn', $setting->nisn) }}" required
                        class="w-full border rounded-lg px-4 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Kelas</label>
                    <input type="text" name="kelas" value="{{ old('kelas', $setting->kelas) }}" required
                        class="w-full border rounded-lg px-4 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir', $setting->tgl_lahir) }}" required
                        class="w-full border rounded-lg px-4 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-1">Alamat</label>
                    <textarea name="alamat" rows="3" required
                        class="w-full border rounded-lg px-4 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-400">{{ old('alamat', $setting->alamat) }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-1">Jenis Kelamin</label>
                    <select name="jenis_kelamin" required
                        class="w-full border rounded-lg px-4 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="">-- Pilih --</option>
                        <option value="Laki-laki"
                            {{ old('jenis_kelamin', $setting->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                            Laki-laki</option>
                        <option value="Perempuan"
                            {{ old('jenis_kelamin', $setting->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                            Perempuan</option>
                    </select>
                </div>

                <div class="md:col-span-2 flex justify-between items-center mt-4">
                    <a href="{{ route('setting.information') }}"
                        class="inline-flex items-center gap-2 bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                        ← Kembali ke Informasi
                    </a>
                    <button type="submit"
                        class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:bg-blue-700 transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </main>

</body>

</html>
