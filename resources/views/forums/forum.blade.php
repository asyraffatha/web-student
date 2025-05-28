<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>discussion forum</title>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen flex items-center justify-center p-6"
    style="
  background-color: #254aa7; 
  background-image: url('storage/images/LogoTA.png'); 
  background-size: 400px; 
  background-position: center; 
  background-repeat: no-repeat;
">

    {{-- <div class="absolute inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-0"></div> --}}

    <div class="container mx-auto px-4 py-12 relative z-10 text-white">

        {{-- Tombol kembali ke dashboard --}}
        <div class="mb-8">
            <a href="{{ route('home') }}"
                class="inline-flex items-center gap-2 text-blue-200 hover:text-white font-semibold text-sm transition-all duration-200">
                ⬅️ <span>Back to the Home</span>
            </a>
        </div>

        {{-- Header Forum --}}
        <div class="flex flex-col sm:flex-row justify-between items-center mb-12 gap-4">
            <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight drop-shadow-lg">💬 Discussion Forum</h1>
            <a href="{{ route('forums.create') }}"
                class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold px-6 py-2 rounded-xl shadow-lg transition-all duration-300">
                + Create a New Forum
            </a>
        </div>

        {{-- Pesan sukses --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-800 border border-green-300 px-6 py-4 rounded-xl shadow-md mb-8">
                {{ session('success') }}
            </div>
        @endif

        {{-- Daftar forum --}}
        @forelse ($forums as $forum)
            <div
                class="bg-white bg-opacity-80 hover:bg-opacity-90 shadow-md transition-all duration-300 rounded-xl overflow-hidden mb-6 border border-gray-200 backdrop-blur-sm">
                <div class="px-6 py-5 border-b border-gray-200 bg-gray-50/70">
                    <h2 class="text-2xl font-bold text-gray-800">{{ $forum->title }}</h2>
                    <p class="text-sm text-gray-600 mt-1">👤 <span class="font-medium">{{ $forum->user->name }}</span> ·
                        <span>{{ $forum->created_at->diffForHumans() }}</span>
                    </p>
                </div>
                <div class="px-6 py-4 text-gray-700 leading-relaxed">
                    {{ Str::limit($forum->content, 200, '...') }}
                </div>
                <div class="px-6 py-4 bg-gray-100/60 flex flex-wrap gap-3">
                    <a href="{{ route('forums.show', $forum->id) }}"
                        class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-medium hover:bg-blue-200 transition">
                        🔍 See Details
                    </a>
                    <a href="{{ route('forums.edit', $forum->id) }}"
                        class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded-full text-sm font-medium hover:bg-yellow-200 transition">
                        ✏️ Edit
                    </a>
                    <form action="{{ route('forums.destroy', $forum->id) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus forum ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-medium hover:bg-red-200 transition">
                            🗑️ Delete
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="text-center text-gray-100 mt-10 text-lg italic">
                There is no forum available yet. Let's create your first forum! ✨
            </div>
        @endforelse

    </div>
</body>

</html>
