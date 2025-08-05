<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Seetings</title>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-no-repeat bg-center bg-cover relative"
    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); background-image: url('storage/images/LogoTA.png'), linear-gradient(135deg, #667eea 0%, #764ba2 100%); background-size: 400px, cover; background-position: center; background-repeat: no-repeat;">

    <main class="container mx-auto px-4 py-10">
        <div class="max-w-5xl mx-auto bg-white/90 p-10 rounded-xl shadow-2xl backdrop-blur-md">
            <h1 class="text-3xl font-bold text-gray-800 mb-8 flex items-center gap-3">
                <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                </svg>
                Pengaturan Informasi Siswa
            </h1>

            <!-- Tombol Back to Home -->
            <div class="mb-6">
                <a href="home"
                    class="inline-flex items-center gap-2 bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                    ← Kembali ke Home
                </a>
            </div>

            @php
                $isEdit = isset($setting);
            @endphp
            <form action="{{ $isEdit ? route('setting.update', $setting->id) : route('setting.store') }}" method="POST" enctype="multipart/form-data"
                class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @csrf
                @if($isEdit)
                    @method('PUT')
                @endif

                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-1">Foto Profile</label>
                    <input type="file" name="foto" accept="image/*"
                        class="w-full border rounded-lg px-4 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    @if($isEdit && $setting->foto)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $setting->foto) }}" alt="Foto Profil" style="width: 100px; height: 100px; border-radius: 50%;">
                        </div>
                    @endif
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Nama Lengkap</label>
                    <input type="text" name="nama" required value="{{ old('nama', $setting->nama ?? '') }}"
                        class="w-full border rounded-lg px-4 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">NISN</label>
                    <input type="text" name="nisn" required value="{{ old('nisn', $setting->nisn ?? '') }}"
                        class="w-full border rounded-lg px-4 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Kelas</label>
                    <input type="text" name="kelas" required value="{{ old('kelas', $setting->kelas ?? '') }}"
                        class="w-full border rounded-lg px-4 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Tanggal Kelahiran</label>
                    <input type="date" name="tgl_lahir" required value="{{ old('tgl_lahir', $setting->tgl_lahir ?? '') }}"
                        class="w-full border rounded-lg px-4 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-1">Alamat</label>
                    <textarea name="alamat" rows="3" required
                        class="w-full border rounded-lg px-4 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-400">{{ old('alamat', $setting->alamat ?? '') }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-1">Gender</label>
                    <select name="jenis_kelamin" required
                        class="w-full border rounded-lg px-4 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="">-- Pilih --</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin', $setting->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-Laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin', $setting->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="md:col-span-2 flex justify-end mt-4">
                    <button type="submit"
                        class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:bg-blue-700 transition">
                        {{ $isEdit ? 'Update Informasi' : 'Simpan Informasi' }}
                    </button>
                </div>
            </form>
        </div>
    </main>

</body>

</html>
