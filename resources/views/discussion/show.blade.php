<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Chat dengan {{ $receiver->name }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen text-gray-800">

    <main class="max-w-3xl mx-auto py-10 px-4">
        @php
            $currentUser = Auth::user();
        @endphp

        <!-- Tombol Kembali -->
        <div class="mb-6">
            @if ($currentUser->role === 'guru')
                <a href="{{ route('guru.dashboard') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-semibold bg-white text-blue-600 border border-blue-500 rounded-lg shadow hover:bg-blue-50 transition">
                    ⬅️ Kembali ke Dashboard Guru
                </a>
            @elseif ($currentUser->role === 'siswa')
                <a href="{{ route('home') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-semibold bg-white text-green-600 border border-green-500 rounded-lg shadow hover:bg-green-50 transition">
                    ⬅️ Kembali ke Beranda
                </a>
            @endif
        </div>

        <!-- Info Diskusi -->
        <div class="mb-4 p-4 bg-white shadow rounded-lg">
            @if ($currentUser->role === 'guru')
                <h2 class="text-lg font-semibold mb-1">🧑‍🏫 Anda sedang berdiskusi dengan siswa:</h2>
                <p class="text-xl font-bold text-blue-600">{{ $receiver->name }}</p>
            @elseif ($currentUser->role === 'siswa')
                <h2 class="text-lg font-semibold mb-1">👨‍🏫 Anda sedang berdiskusi dengan guru:</h2>
                <p class="text-xl font-bold text-green-600">{{ $receiver->name }}</p>
            @else
                <h2 class="text-xl font-bold mb-1">💬 Diskusi dengan:</h2>
                <p class="text-lg font-semibold">{{ $receiver->name }}</p>
            @endif
        </div>

        <!-- Kotak Chat -->
        <div class="bg-white p-4 rounded-lg shadow h-[500px] overflow-y-auto mb-4 space-y-2">
            @forelse ($messages as $msg)
                <div class="flex {{ $msg->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                    <div
                        class="px-4 py-2 rounded-xl max-w-xs break-words
                        {{ $msg->sender_id === auth()->id() ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-800' }}">
                        {{ $msg->content }}
                        <div class="text-xs mt-1 text-right text-gray-100/80">
                            {{ $msg->created_at->format('H:i') }}
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center mt-10">Belum ada pesan. Mulai percakapan sekarang!</p>
            @endforelse
        </div>

        <!-- Form Kirim Pesan -->
        <form action="{{ route('discussion.send') }}" method="POST" class="flex gap-2">
            @csrf
            <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
            <input type="text" name="content" required
                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                placeholder="Ketik pesan...">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Kirim
            </button>
        </form>
    </main>

</body>

</html>
