<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Buat Quiz</title>
    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .card-shadow {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .question-card {
            transform: translateY(0);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: linear-gradient(135deg, #fdfcfb 0%, #e2d1c3 100%);
        }

        .question-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .input-focus {
            transition: all 0.3s ease;
        }

        .input-focus:focus {
            transform: scale(1.02);
            box-shadow: 0 0 20px rgba(102, 126, 234, 0.3);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(252, 182, 159, 0.4);
        }

        .fade-in {
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .delete-btn {
            opacity: 0;
            transform: scale(0.8);
            transition: all 0.3s ease;
        }

        .question-card:hover .delete-btn {
            opacity: 1;
            transform: scale(1);
        }

        .floating-icon {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .pulse-ring {
            animation: pulse-ring 1.5s cubic-bezier(0.215, 0.61, 0.355, 1) infinite;
        }

        @keyframes pulse-ring {
            0% {
                transform: scale(.33);
            }

            80%,
            100% {
                opacity: 0;
            }
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
    </style>
</head>

<body class="min-h-screen gradient-bg">
    <!-- Decorative Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div
            class="absolute -top-4 -right-4 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse">
        </div>
        <div
            class="absolute -bottom-8 -left-4 w-72 h-72 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse">
        </div>
        <div
            class="absolute top-1/2 left-1/2 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse">
        </div>
    </div>

    <div class="relative min-h-screen py-8 px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-8 fade-in">
                <div class="inline-block relative mb-4">
                    <div class="absolute inset-0 pulse-ring bg-white rounded-full"></div>
                    <div
                        class="relative w-20 h-20 bg-white rounded-full flex items-center justify-center floating-icon">
                        <i class="fas fa-clipboard-question text-3xl text-purple-600"></i>
                    </div>
                </div>
                <h1 class="text-4xl font-bold text-white mb-2 drop-shadow-lg">Buat Quiz Baru</h1>
                <p class="text-white/90 text-lg">Buat quiz yang menarik untuk siswa Anda</p>
            </div>

            <!-- Main Container -->
            <div class="bg-white/95 backdrop-blur-sm card-shadow rounded-3xl p-8 fade-in">
                <!-- Navigation -->
                <div class="flex flex-wrap justify-between items-center mb-8 pb-6 border-b border-gray-200">
                    <h2 class="text-3xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-magic mr-3 text-purple-600"></i>
                        Quiz Builder
                    </h2>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('guru.dashboard') }}"
                            class="glass-effect text-gray-700 px-4 py-2 rounded-xl hover:bg-white/40 transition duration-300 flex items-center space-x-2 text-sm">
                            <i class="fas fa-arrow-left"></i>
                            <span>Kembali ke Dashboard</span>
                        </a>
                        <a href="{{ route('quiz.list') }}"
                            class="glass-effect text-gray-700 px-4 py-2 rounded-xl hover:bg-white/40 transition duration-300 flex items-center space-x-2 text-sm">
                            <i class="fas fa-list"></i>
                            <span>Lihat Daftar Quiz</span>
                        </a>
                    </div>
                </div>

                <!-- Success/Error Messages -->
                @if (session('success'))
                    <div
                        class="bg-gradient-to-r from-green-400 to-green-600 text-white p-4 rounded-xl mb-6 flex items-center space-x-3 shadow-lg">
                        <i class="fas fa-check-circle text-2xl"></i>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-gradient-to-r from-red-400 to-red-600 text-white p-4 mb-6 rounded-xl shadow-lg">
                        <div class="flex items-center space-x-3 mb-2">
                            <i class="fas fa-exclamation-triangle text-2xl"></i>
                            <h4 class="font-medium">Terjadi Kesalahan:</h4>
                        </div>
                        <ul class="list-disc pl-8 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('quiz.store') }}" method="POST" class="space-y-8" enctype="multipart/form-data">
                    @csrf

                    <!-- Quiz Information -->
                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Judul Quiz -->
                        <div class="space-y-2">
                            <label class="flex items-center text-sm font-semibold text-gray-700">
                                <i class="fas fa-heading mr-2 text-purple-600"></i>
                                Judul Quiz
                            </label>
                            <input type="text" name="title" required
                                class="input-focus w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:outline-none transition duration-300 bg-white/80 shadow-sm">
                        </div>

                        <!-- Kelas -->
                        <div class="space-y-2">
                            <label class="flex items-center text-sm font-semibold text-gray-700">
                                <i class="fas fa-users-class mr-2 text-indigo-600"></i>
                                Kelas
                            </label>
                            <select name="kelas" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:outline-none bg-white/80 shadow-sm">
                                <option value="">Pilih Kelas</option>
                                @if (isset($kelasDiampu))
                                    @foreach ($kelasDiampu as $kelas)
                                        <option value="{{ $kelas->id }}">
                                            Kelas {{ $kelas->nama ?? ($kelas->kode ?? $kelas->id) }}
                                        </option>
                                    @endforeach
                                @else
                                    @for ($tingkat = 7; $tingkat <= 9; $tingkat++)
                                        @for ($sub = 1; $sub <= 9; $sub++)
                                            <option value="{{ $tingkat . '.' . $sub }}">Kelas
                                                {{ $tingkat . '.' . $sub }}</option>
                                        @endfor
                                    @endfor
                                @endif
                            </select>
                        </div>

                        <!-- Tipe Quiz -->
                        <div class="space-y-2">
                            <label class="flex items-center text-sm font-semibold text-gray-700">
                                <i class="fas fa-layer-group mr-2 text-pink-600"></i>
                                Tipe Quiz
                            </label>
                            <select name="type" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-pink-500 focus:outline-none bg-white/80 shadow-sm">
                                <option value="">Pilih Tipe</option>
                                <option value="daily">Misi Harian</option>
                                <option value="teka-teki">Teka-Teki Harian</option>
                                <option value="boss">Boss Quiz Mingguan</option>
                            </select>
                        </div>

                        <!-- Passing Score -->
                        <div class="space-y-2">
                            <label class="flex items-center text-sm font-semibold text-gray-700">
                                <i class="fas fa-trophy mr-2 text-yellow-500"></i>
                                Passing Score
                            </label>
                            <input type="number" name="passing_score" min="0" required
                                class="input-focus w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:outline-none transition duration-300 bg-white/80 shadow-sm">
                        </div>
                    </div>

                    {{-- deadline --}}
                    <div>
                        <label for="deadline">Deadline</label>
                        <input type="datetime-local" name="deadline" id="deadline" required
                            class="form-input rounded-lg border border-gray-300 px-3 py-2 w-full">
                    </div>
                    <!-- Questions Section -->
                    <div class="space-y-6">
                        <div class="flex items-center justify-between">
                            <h3 class="text-2xl font-bold text-gray-800 flex items-center">
                                <i class="fas fa-question-circle mr-3 text-indigo-600"></i>
                                Pertanyaan Quiz
                            </h3>
                            <div
                                class="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-4 py-2 rounded-full text-sm font-medium">
                                <i class="fas fa-list-ol mr-2"></i>
                                <span id="question-counter">1</span> Pertanyaan
                            </div>
                        </div>

                        <div id="questions-wrapper" class="space-y-6">
                            <!-- Initial Question -->
                            <div class="question-container mb-6 p-4 border rounded-lg bg-white">
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Pertanyaan 1</label>
                                    <textarea name="questions[0][question]" rows="2"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required></textarea>

                                    <!-- Media untuk pertanyaan -->
                                    <div class="mt-2 space-y-2">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Gambar Pertanyaan
                                                (max 2MB)</label>
                                            <input type="file" name="questions[0][image]"
                                                accept="image/jpeg,image/png,image/webp"
                                                class="mt-1 block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none">
                                        </div>
                                        {{-- <div>
                                            <label class="block text-sm font-medium text-gray-700">Video Pertanyaan (max
                                                10MB)</label>
                                            <input type="file" name="questions[0][video]"
                                                accept="video/mp4,video/webm,video/ogg"
                                                class="mt-1 block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none">
                                        </div> --}}
                                    </div>
                                </div>

                                <!-- Opsi jawaban -->
                                <div class="space-y-2">
                                    @foreach (['A', 'B', 'C', 'D'] as $optionIndex => $option)
                                        <div class="flex items-center space-x-2">
                                            <input type="radio" name="questions[0][answer]"
                                                value="{{ $option }}" class="text-blue-600" required>
                                            <input type="text" name="questions[0][options][]"
                                                class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                placeholder="Opsi {{ $option }}" required>

                                            <!-- Gambar untuk opsi -->
                                            <div class="w-32">
                                                <label class="block text-sm font-medium text-gray-700">Gambar (max
                                                    2MB)</label>
                                                <input type="file" name="questions[0][options_images][]"
                                                    accept="image/jpeg,image/png,image/webp"
                                                    class="mt-1 block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div
                        class="flex flex-col sm:flex-row gap-4 justify-between items-center pt-6 border-t border-gray-200">
                        <button type="button" id="add-question"
                            class="btn-secondary text-gray-800 px-8 py-4 rounded-xl font-semibold flex items-center space-x-2 shadow-lg">
                            <i class="fas fa-plus-circle"></i>
                            <span>Tambah Pertanyaan</span>
                        </button>

                        <button type="submit"
                            class="btn-primary text-white px-12 py-4 rounded-xl font-semibold flex items-center space-x-2 shadow-lg">
                            <i class="fas fa-save mr-2"></i>
                            <span>Simpan Quiz</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let questionCount = 1;

        // Add Question Function
        document.getElementById('add-question').addEventListener('click', function() {
            const wrapper = document.getElementById('questions-wrapper');
            questionCount++;

            const html = `
                <div class="question-container mb-6 p-4 border rounded-lg bg-white">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Pertanyaan ${questionCount}</label>
                        <textarea name="questions[${questionCount - 1}][question]" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required></textarea>
                        
                        <!-- Media untuk pertanyaan -->
                        <div class="mt-2 space-y-2">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Gambar Pertanyaan (max 2MB)</label>
                                <input type="file" name="questions[${questionCount - 1}][image]" accept="image/jpeg,image/png,image/webp" class="mt-1 block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none">
                            </div>
                        </div>
                    </div>

                    <!-- Opsi jawaban -->
                    <div class="space-y-2">
                        <div class="flex items-center space-x-2">
                            <input type="radio" name="questions[${questionCount - 1}][answer]" value="A" class="text-blue-600" required>
                            <input type="text" name="questions[${questionCount - 1}][options][]" class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Opsi A" required>
                            <div class="w-32">
                                <label class="block text-sm font-medium text-gray-700">Gambar (max 2MB)</label>
                                <input type="file" name="questions[${questionCount - 1}][options_images][]" accept="image/jpeg,image/png,image/webp" class="mt-1 block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none">
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <input type="radio" name="questions[${questionCount - 1}][answer]" value="B" class="text-blue-600" required>
                            <input type="text" name="questions[${questionCount - 1}][options][]" class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Opsi B" required>
                            <div class="w-32">
                                <label class="block text-sm font-medium text-gray-700">Gambar (max 2MB)</label>
                                <input type="file" name="questions[${questionCount - 1}][options_images][]" accept="image/jpeg,image/png,image/webp" class="mt-1 block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none">
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <input type="radio" name="questions[${questionCount - 1}][answer]" value="C" class="text-blue-600" required>
                            <input type="text" name="questions[${questionCount - 1}][options][]" class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Opsi C" required>
                            <div class="w-32">
                                <label class="block text-sm font-medium text-gray-700">Gambar (max 2MB)</label>
                                <input type="file" name="questions[${questionCount - 1}][options_images][]" accept="image/jpeg,image/png,image/webp" class="mt-1 block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none">
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <input type="radio" name="questions[${questionCount - 1}][answer]" value="D" class="text-blue-600" required>
                            <input type="text" name="questions[${questionCount - 1}][options][]" class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Opsi D" required>
                            <div class="w-32">
                                <label class="block text-sm font-medium text-gray-700">Gambar (max 2MB)</label>
                                <input type="file" name="questions[${questionCount - 1}][options_images][]" accept="image/jpeg,image/png,image/webp" class="mt-1 block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none">
                            </div>
                        </div>
                    </div>
                </div>
            `;

            wrapper.insertAdjacentHTML('beforeend', html);
            updateQuestionCounter();
        });

        // Remove Question Function
        function removeQuestion(button) {
            if (questionCount > 1) {
                const questionCard = button.closest('.question-card');
                questionCard.style.animation = 'fadeOut 0.3s ease-out';
                setTimeout(() => {
                    questionCard.remove();
                    questionCount--;
                    updateQuestionNumbers();
                    updateQuestionCounter();
                }, 300);
            }
        }

        // Update Question Numbers
        function updateQuestionNumbers() {
            const questions = document.querySelectorAll('.question-card');
            questions.forEach((question, index) => {
                const numberCircle = question.querySelector('.w-12.h-12');
                const title = question.querySelector('h4');
                const inputs = question.querySelectorAll('input');

                numberCircle.textContent = index + 1;
                title.textContent = `Pertanyaan ${index + 1}`;

                // Update input names
                inputs.forEach(input => {
                    const name = input.getAttribute('name');
                    if (name && name.includes('questions[')) {
                        const newName = name.replace(/questions\[\d+\]/, `questions[${index}]`);
                        input.setAttribute('name', newName);
                    }
                });
            });
        }

        // Update Question Counter
        function updateQuestionCounter() {
            document.getElementById('question-counter').textContent = questionCount;
        }

        // Auto uppercase for answer inputs
        document.addEventListener('input', function(e) {
            if (e.target.name && e.target.name.includes('[answer]')) {
                e.target.value = e.target.value.toUpperCase();
            }
        });

        // Add fadeOut animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeOut {
                from { opacity: 1; transform: translateY(0); }
                to { opacity: 0; transform: translateY(-20px); }
            }
        `;
        document.head.appendChild(style);

        // Tampilkan input video hanya untuk teka-teki/boss, gambar selalu ada
        const typeSelect = document.querySelector('select[name="type"]');
        // const videoWrapper = document.getElementById('video-upload-wrapper');
        const labelImage = document.getElementById('label-image');
        const descImage = document.getElementById('desc-image');

        // function updateMediaInputs() {
        //     if (typeSelect.value === 'teka-teki' || typeSelect.value === 'boss') {
        //         videoWrapper.classList.remove('hidden');
        //         labelImage.textContent = 'Gambar (jpg, png, webp, max 2MB)';
        //         descImage.textContent = 'Teka-Teki/Boss: gambar & video. Gambar wajib, video opsional.';
        //     } else {
        //         videoWrapper.classList.add('hidden');
        //         labelImage.textContent = 'Gambar (jpg, png, webp, max 2MB)';
        //         descImage.textContent = 'Misi Harian: hanya gambar.';
        //     }
        // }
        // typeSelect.addEventListener('change', updateMediaInputs);
        // window.addEventListener('DOMContentLoaded', updateMediaInputs);

        // Validasi ukuran file gambar/video (gambar max 2MB, video max 10MB)
        document.addEventListener('change', function(e) {
            if (e.target.type === 'file') {
                const maxSizeMB = e.target.getAttribute('data-max-size');
                if (e.target.files.length > 0 && maxSizeMB) {
                    const file = e.target.files[0];
                    const maxBytes = parseInt(maxSizeMB) * 1024;
                    if (file.size > maxBytes) {
                        alert('Ukuran file terlalu besar! Maksimal ' + (maxSizeMB / 1024) + ' MB.');
                        e.target.value = '';
                    }
                }
            }
        });
    </script>

</body>

</html>
