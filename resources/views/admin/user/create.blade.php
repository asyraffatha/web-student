<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah User</title>
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
                hint.textContent = 'Guru dapat memilih lebih dari satu kelas dengan mencentang kotak.';
            } else if (role === 'siswa') {
                kelasGroup.classList.remove('hidden');
                kelasSelect.classList.remove('hidden');
                kelasCheckboxes.classList.add('hidden');
                hint.textContent = 'Siswa hanya dapat memilih satu kelas dari dropdown.';
            } else {
                kelasGroup.classList.add('hidden');
            }
        }

        document.addEventListener("DOMContentLoaded", () => {
            toggleKelasField();
            document.getElementById('role').addEventListener('change', toggleKelasField);
        });
    </script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-xl">
        <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Tambah User</h2>

        <form method="POST" action="{{ route('admin.user.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block mb-1 text-gray-700">Nama</label>
                <input type="text" name="name"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 text-gray-700">Email</label>
                <input type="email" name="email"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 text-gray-700">Password</label>
                <input type="password" name="password"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 text-gray-700">Role</label>
                <select name="role" id="role"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    required>
                    <option value="">-- Pilih Role --</option>
                    <option value="siswa">Siswa</option>
                    <option value="guru">Guru</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="mb-4 hidden" id="kelas-group">
                <label class="block mb-2 text-gray-700">Kelas</label>

                <!-- Dropdown untuk siswa -->
                <select
                    class="w-full border rounded px-3 py-2 mb-2 focus:outline-none focus:ring-2 focus:ring-blue-400 hidden"
                    name="kelas" id="kelas-select">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach ($allKelas as $kelas)
                        <option value="{{ $kelas->id }}">Kelas {{ $kelas->nama }}</option>
                    @endforeach
                </select>

                <!-- Checkbox untuk guru -->
                <div id="kelas-checkboxes"
                    class="hidden bg-gray-50 border rounded px-3 py-2 max-h-40 overflow-y-auto space-y-1">
                    @foreach ($allKelas as $kelas)
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="kelas[]" value="{{ $kelas->id }}"
                                class="form-checkbox h-4 w-4 text-blue-600">
                            <span>{{ $kelas->nama }}</span>
                        </label><br>
                    @endforeach
                </div>

                <small class="text-gray-500 mt-1 block" id="kelas-hint"></small>
            </div>

            <div class="flex justify-between items-center mt-6">
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">Simpan</button>
                <a href="{{ route('admin.user.index') }}" class="text-gray-600 hover:underline">Kembali</a>
            </div>
        </form>
    </div>
</body>

</html>
