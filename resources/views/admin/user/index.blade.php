<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Manajemen User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen text-gray-800">

    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold">Manajemen Pengguna</h1>
            <a href="/admin/dashboard" class="text-sm text-blue-600 hover:underline">← Kembali ke Dashboard</a>
        </div>

        <!-- Tambah User Button -->
        <div class="mb-4">
            <a href="{{ route('admin.user.create') }}"
                class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded shadow">
                + Tambah User
            </a>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold">ID</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">Nama</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">Email</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">Role</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">Kelas</th>
                        <th class="px-4 py-2 text-center text-sm font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @foreach ($users as $user)
                        <tr>
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
                                @php
                                    $kelas = is_array($user->kelas_diampu)
                                        ? $user->kelas_diampu
                                        : json_decode($user->kelas_diampu, true);
                                @endphp

                                @if ($user->role === 'guru')
                                    -
                                @elseif ($user->role === 'siswa')
                                    {{ $user->kelas ?? '-' }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-4 py-2 text-center">
                                <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin hapus user ini?');" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-1 rounded shadow">
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
