<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Forum Detail</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <!-- Overlay -->
    {{-- <div class="absolute inset-0 bg-black/40 z-0"></div> --}}

    <div
        class="relative z-10 max-w-3xl w-full bg-white/90 backdrop-blur-md shadow-2xl rounded-2xl p-8 space-y-8 text-gray-800">

        <!-- Tombol Back to Forum -->
        <div>
            <a href="{{ route('forums.index') }}"
                class="inline-block text-blue-600 hover:text-blue-800 text-sm font-semibold mb-4">
                &#8592; Back to the Forum
            </a>
        </div>

        <!-- Judul Forum -->
        <div>
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 drop-shadow-sm">{{ $forum->title }}</h1>
            <p class="mt-2 text-sm text-gray-600">🧑‍💬 <span class="font-medium">{{ $forum->user->name }}</span> •
                {{ $forum->created_at->diffForHumans() }}</p>
        </div>

        <!-- Isi Forum -->
        <div class="prose max-w-none text-gray-700 leading-relaxed">
            <p>{{ $forum->content }}</p>
        </div>

        <hr class="border-gray-300">

        <!-- Komentar -->
        <div class="space-y-4">
            <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-2">💬 Comment</h2>

            @forelse ($forum->comments as $comment)
                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm transition hover:shadow-md">
                    <p class="text-sm text-blue-700 font-semibold">{{ $comment->user->name }}</p>
                    <p class="text-gray-800 mt-1 leading-snug">{{ $comment->content }}</p>
                </div>
            @empty
                <p class="text-gray-500 italic">No comments yet. Be the first!</p>
            @endforelse
        </div>

        <!-- Form Komentar -->
        <form action="{{ route('comments.store', $forum->id) }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-1">✍️ Add a Comment</label>
                <textarea id="content" name="content" rows="4"
                    class="w-full rounded-lg border border-gray-300 p-3 shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500 transition"
                    placeholder="Tulis komentar kamu di sini..." required></textarea>
            </div>
            <div class="text-right">
                <button type="submit"
                    class="bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg shadow hover:bg-blue-700 transition duration-200">
                    Send a Comment
                </button>
            </div>
        </form>
    </div>
</body>

</html>
