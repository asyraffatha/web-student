<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Forum</title>
    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@3.0.24/lib/index.js"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-10">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Edit Forum</h2>

        <!-- Form untuk edit forum -->
        <form action="{{ route('forums.update', $forum->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Input judul forum -->
            <div class="mb-4">
                <label for="title" class="block text-gray-700">Title</label>
                <input type="text" name="title"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                    value="{{ old('title', $forum->title) }}" required>
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Input konten forum -->
            <div class="mb-4">
                <label for="content" class="block text-gray-700">Content</label>
                <textarea name="content"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                    rows="5" required>{{ old('content', $forum->content) }}</textarea>
                @error('content')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Input gambar (optional) -->
            <div class="mb-4">
                <label for="foto" class="block text-gray-700">Upload Foto</label>
                <input type="file" name="foto"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                @if ($forum->foto)
                    <div class="mt-2">
                        <p class="text-sm text-gray-600">Current Photo:</p>
                        <img src="{{ asset('storage/' . $forum->foto) }}" alt="Current Photo"
                            class="w-32 h-32 object-cover mt-2">
                    </div>
                @endif
                @error('foto')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol submit -->
            <div class="mt-6">
                <button type="submit"
                    class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Update
                    Forum</button>
            </div>
        </form>
    </div>

</body>

</html>
