<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Forum</title>
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

    <div class="w-full max-w-3xl bg-white/80 backdrop-blur-md rounded-2xl shadow-2xl p-10 border border-gray-200">
        <h1 class="text-3xl font-bold text-center text-blue-700 mb-8">📝 Create a New Forum</h1>

        {{-- Notifikasi Error --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg shadow">
                <ul class="list-disc pl-5 space-y-1 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>⚠️ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulir --}}
        <form action="{{ route('forums.store') }}" method="POST" class="space-y-6">
            @csrf

            <input type="hidden" name="kelas" value="{{ Auth::user()->kelas }}">

            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">📌 Forum Title</label>
                <input type="text" id="title" name="title" class="w-full ..." required>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">📝 Description</label>
                <textarea id="description" name="description" rows="3" class="w-full ..." required>{{ old('description') }}</textarea>
            </div>

            <!-- Content -->
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-1">💬 Content</label>
                <textarea id="content" name="content" rows="6" class="w-full ..." required></textarea>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-between mt-6">
                <a href="{{ route('forums.index') }}"
                    class="text-gray-600 hover:text-blue-600 text-sm underline transition">
                    ← Back to the Forum
                </a>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition">
                    💾 Save the Forum
                </button>
            </div>
        </form>
    </div>
</body>

</html>
