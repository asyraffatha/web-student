<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Chat dengan {{ $receiver->name }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .chat-bubble {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        body {
            background: linear-gradient(135deg,
                    rgba(191, 219, 254, 0.8),
                    rgba(147, 197, 253, 0.7),
                    rgba(96, 165, 250, 0.7));
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
        }

        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }
    </style>
</head>

<body class="min-h-screen text-gray-800 font-sans">

    @php
        $currentUser = Auth::user();
    @endphp

    <main class="max-w-3xl mx-auto py-10 px-4">
        <!-- Tombol Kembali -->
        <div class="mb-6">
            @if ($currentUser->role === 'guru')
                <a href="{{ route('guru.dashboard') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-semibold bg-white text-blue-600 border border-blue-500 rounded-lg shadow hover:bg-blue-50 transition">
                    ⬅️ Kembali ke Dashboard Guru
                </a>
            @elseif ($currentUser->role === 'siswa')
                <a href="{{ route('home') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-semibold bg-white text-blue-600 border border-blue-400 rounded-lg shadow hover:bg-blue-50 transition">
                    ⬅️ Kembali ke Beranda
                </a>
            @endif
        </div>

        <!-- Info Diskusi -->
        <div class="mb-4 p-4 bg-white/90 backdrop-blur-md shadow rounded-xl">
            <h2 class="text-lg font-semibold mb-1 text-blue-700">💬 Sedang berdiskusi dengan:</h2>
            <p class="text-xl font-bold text-blue-900">{{ $receiver->name }}</p>
        </div>

        <!-- Kotak Chat -->
        <div class="bg-white/90 backdrop-blur p-4 rounded-2xl shadow h-[500px] overflow-y-auto mb-4 space-y-3"
            id="chat-box">
            @forelse ($messages as $msg)
                <div class="flex {{ $msg->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }} chat-bubble">
                    <div class="flex items-end space-x-2 max-w-xs">
                        @if ($msg->sender_id !== auth()->id())
                            <span class="text-2xl">👤</span>
                        @endif
                        <div
                            class="px-4 py-2 rounded-2xl text-sm shadow
                            {{ $msg->sender_id === auth()->id() ? 'text-white bg-blue-600' : 'text-gray-900 bg-blue-100' }}">
                            {{ $msg->content }}
                            <div class="text-xs text-right mt-1 text-blue-300">
                                {{ $msg->created_at->format('H:i') }}
                            </div>
                        </div>
                        @if ($msg->sender_id === auth()->id())
                            <span class="text-2xl">🙋‍♂️</span>
                        @endif
                    </div>
                </div>
                @if ($loop->last)
                    <div id="scroll-anchor"></div>
                @endif
            @empty
                <p class="text-gray-600 text-center mt-10">Belum ada pesan. Mulai percakapan sekarang! 💬</p>
            @endforelse
        </div>

        <!-- Form Kirim Pesan -->
        <form action="{{ route('discussion.send') }}" method="POST" class="flex gap-3 items-center">
            @csrf
            <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
            <input type="text" name="content" required
                class="flex-1 px-4 py-2 rounded-full border border-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm bg-white placeholder-blue-400"
                placeholder="💬 Ketik pesan di sini...">
            <button type="submit"
                class="px-6 py-2 rounded-full bg-blue-600 text-white font-semibold hover:bg-blue-700 transition shadow">
                🚀 Kirim
            </button>
        </form>
    </main>

    <!-- Auto scroll script -->
    <script>
        window.onload = () => {
            const anchor = document.getElementById('scroll-anchor');
            anchor?.scrollIntoView({
                behavior: 'smooth'
            });
        }
    </script>

</body>

</html>
