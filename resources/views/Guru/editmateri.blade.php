<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Materi</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    <div class="max-w-3xl mx-auto mt-10 bg-white shadow-lg rounded-xl p-6">
        <h2 class="text-2xl font-bold text-gray-700 mb-6">Edit Materi</h2>

        <a href="{{ route('materi.create') }}"
            class="inline-block mb-4 text-blue-600 hover:text-blue-800 text-sm font-medium transition duration-200">
            ← Kembali ke Form Tambah Materi
        </a>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('materi.update', $materi->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="judul" class="block text-sm font-medium text-gray-700">Judul Materi</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul', $materi->judul) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    required>
            </div>

            <div>
                <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
                <select name="kelas" id="kelas"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    required>
                    <option value="" disabled>Pilih Kelas</option>
                    @foreach ($kelasDiampu as $kelas)
                        <option value="{{ $kelas->id }}" {{ $materi->kelas == $kelas->id ? 'selected' : '' }}>
                            Kelas {{ $kelas->nama ?? ($kelas->kode ?? $kelas->id) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="deadline">Deadline</label>
                <input type="datetime-local" name="deadline"
                    class="form-input rounded-lg border border-gray-300 px-3 py-2 w-full"
                    value="{{ $materi->deadline ? \Carbon\Carbon::parse($materi->deadline)->format('Y-m-d\TH:i') : '' }}">
            </div>

            <div>
                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>{{ old('deskripsi', $materi->deskripsi) }}</textarea>
            </div>

            <div>
                <label for="file" class="block text-sm font-medium text-gray-700">Ganti File (opsional)</label>
                <input type="file" name="file" id="file"
                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                   file:rounded-md file:border-0
                   file:text-sm file:font-semibold
                   file:bg-blue-50 file:text-blue-700
                   hover:file:bg-blue-100">
                @if ($materi->file_path)
                    <p class="text-sm mt-1">File saat ini:
                        <a href="{{ asset('storage/' . $materi->file_path) }}" target="_blank"
                            class="text-blue-600 hover:underline">
                            Lihat File
                        </a>
                    </p>
                @endif
            </div>

            <div class="text-right">
                <button type="submit"
                    class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition duration-200">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

</body>

</html>
