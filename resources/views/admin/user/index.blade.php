<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Manajemen User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen text-gray-800">

    <div class="max-w-7xl mx-auto px-6 py-10">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-700">📋 Manajemen Pengguna</h1>
                <p class="text-sm text-gray-500 mt-1">Lihat, ubah, dan kelola akun pengguna sistem.</p>
            </div>
            <a href="/admin/dashboard" class="text-sm text-blue-600 hover:underline flex items-center gap-1 font-medium">
                ← Kembali ke Dashboard
            </a>
        </div>

        <!-- Flash Message -->
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded shadow">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tambah User Button -->
        <div class="mb-6">
            <a href="{{ route('admin.user.create') }}"
                class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg shadow transition">
                + Tambah User
            </a>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto rounded-xl shadow bg-white">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold">ID</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Nama</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Email</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Role</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Kelas</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-2 text-sm">{{ $user->id }}</td>
                            <td class="px-4 py-2 text-sm">{{ $user->name }}</td>
                            <td class="px-4 py-2 text-sm">{{ $user->email }}</td>
                            <td class="px-4 py-2 text-sm">
                                @php
                                    $roleColors = [
                                        'admin' => 'bg-blue-600',
                                        'guru' => 'bg-purple-600',
                                        'siswa' => 'bg-green-600',
                                    ];
                                @endphp
                                <span
                                    class="text-white px-2 py-1 text-xs rounded {{ $roleColors[$user->role] ?? 'bg-gray-500' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-sm">
                                @if ($user->role === 'guru')
                                    {{ $user->kelasDiampu->pluck('nama')->implode(', ') ?: '-' }}
                                @elseif ($user->role === 'siswa')
                                    {{ $user->kelas ?? '-' }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-4 py-2 text-center flex justify-center gap-2 items-center">
                                <a href="{{ route('admin.user.edit', $user->id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm px-4 py-1 rounded shadow">
                                    Edit
                                </a>
                                <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin hapus user ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white text-sm px-4 py-1 rounded shadow">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
