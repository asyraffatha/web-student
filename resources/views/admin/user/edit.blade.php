<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function toggleKelasField() {
            const role = document.getElementById('role').value;
            const kelasGroup = document.getElementById('kelas-group');
            const kelasSelect = document.getElementById('kelas-select');
            const kelasCheckboxes = document.getElementById('kelas-checkboxes');
            const hint = document.getElementById('kelas-hint');

            if (role === 'guru') {
                kelasGroup.classList.remove('hidden');
                kelasSelect.classList.add('hidden');
                kelasCheckboxes.classList.remove('hidden');
                hint.textContent = 'Guru dapat memilih lebih dari satu kelas.';
            } else if (role === 'siswa') {
                kelasGroup.classList.remove('hidden');
                kelasSelect.classList.remove('hidden');
                kelasCheckboxes.classList.add('hidden');
                hint.textContent = 'Siswa hanya dapat memilih satu kelas.';
            } else {
                kelasGroup.classList.add('hidden');
                hint.textContent = '';
            }
        }

        document.addEventListener("DOMContentLoaded", () => {
            toggleKelasField();
            document.getElementById('role').addEventListener('change', toggleKelasField);
        });
    </script>
</head>

<body class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen flex items-center justify-center">

    <div class="bg-white rounded-xl shadow-lg p-8 w-full max-w-xl">
        <h2 class="text-3xl font-bold text-center text-blue-700 mb-6">✏️ Edit Pengguna</h2>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded">
                <ul class="list-disc pl-6 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.user.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-medium text-gray-700">Nama</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                    class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    required>
            </div>

            <div class="mb-4">
                <label class="block font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                    class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    required>
            </div>

            <div class="mb-4">
                <label class="block font-medium text-gray-700">Password <small class="text-sm text-gray-500">(Kosongkan
                        jika tidak ingin diubah)</small></label>
                <input type="password" name="password"
                    class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="mb-4">
                <label class="block font-medium text-gray-700">Role</label>
                <select name="role" id="role"
                    class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    required>
                    <option value="">-- Pilih Role --</option>
                    <option value="siswa" {{ $user->role == 'siswa' ? 'selected' : '' }}>Siswa</option>
                    <option value="guru" {{ $user->role == 'guru' ? 'selected' : '' }}>Guru</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <div class="mb-4 hidden" id="kelas-group">
                <label class="block font-medium text-gray-700 mb-1">Kelas</label>

                <!-- Untuk siswa -->
                <select name="kelas" id="kelas-select"
                    class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 hidden mb-2">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach ($allKelas as $kelas)
                        <option value="{{ $kelas->id }}"
                            {{ $user->role == 'siswa' && $user->kelas == $kelas->nama ? 'selected' : '' }}>
                            Kelas {{ $kelas->nama }}
                        </option>
                    @endforeach
                </select>

                <!-- Untuk guru -->
                <div id="kelas-checkboxes"
                    class="hidden border rounded-lg px-4 py-2 bg-gray-50 max-h-40 overflow-y-auto space-y-1">
                    @foreach ($allKelas as $kelas)
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="kelas[]" value="{{ $kelas->id }}"
                                {{ $user->role == 'guru' && $user->kelasDiampu->pluck('id')->contains($kelas->id) ? 'checked' : '' }}
                                class="form-checkbox text-blue-600">
                            <span>{{ $kelas->nama }}</span>
                        </label><br>
                    @endforeach
                </div>

                <small class="text-sm text-gray-500 mt-2 block" id="kelas-hint"></small>
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('admin.user.index') }}"
                    class="text-sm text-gray-600 hover:underline flex items-center">← Kembali</a>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

</body>

</html>
