<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Forum</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Simple Gradient Background */
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(59, 130, 246, 0.2);
        }

        .input-focus {
            transition: all 0.3s ease;
        }

        .input-focus:focus {
            transform: scale(1.02);
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.4);
        }

        .emoji-big {
            font-size: 2rem;
            display: inline-block;
            margin-right: 0.5rem;
        }

        .char-counter {
            font-size: 0.75rem;
            color: #6b7280;
            text-align: right;
            margin-top: 0.25rem;
        }

        .progress-bar {
            height: 4px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 2px;
            overflow: hidden;
            margin-bottom: 1rem;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #3b82f6, #60a5fa);
            transition: width 0.3s ease;
            border-radius: 2px;
        }

        .fun-button {
            background: linear-gradient(45deg, #2563eb, #3b82f6);
            transform: perspective(1px) translateZ(0);
            transition: all 0.3s ease;
        }

        .fun-button:hover {
            background: linear-gradient(45deg, #1d4ed8, #2563eb);
            transform: scale(1.05);
            box-shadow: 0 15px 30px rgba(59, 130, 246, 0.4);
        }

        .sparkle {
            position: absolute;
            width: 10px;
            height: 10px;
            background: #93c5fd;
            border-radius: 50%;
            animation: sparkle 1.5s ease-in-out infinite;
        }

        @keyframes sparkle {

            0%,
            100% {
                opacity: 0;
                transform: scale(0);
            }

            50% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .tooltip {
            position: relative;
        }

        .tooltip:hover::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background: #1e40af;
            color: white;
            padding: 0.5rem;
            border-radius: 0.5rem;
            font-size: 0.75rem;
            white-space: nowrap;
            z-index: 10;
        }

        /* Interactive mouse trail */
        .mouse-trail {
            position: fixed;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.6), transparent);
            pointer-events: none;
            z-index: 1;
            transition: all 0.1s ease;
        }

        /* Blue-themed gradients */
        .blue-text-gradient {
            background: linear-gradient(135deg, #1e40af, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .blue-border-gradient {
            border: 2px solid transparent;
            background: linear-gradient(white, white) padding-box,
                linear-gradient(135deg, #3b82f6, #60a5fa) border-box;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .fade-in {
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="gradient-bg min-h-screen">
    <!-- Floating particles effect -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-4 h-4 bg-white opacity-20 rounded-full animate-ping"></div>
        <div class="absolute top-3/4 right-1/4 w-6 h-6 bg-white opacity-10 rounded-full animate-pulse"></div>
        <div class="absolute top-1/2 left-3/4 w-3 h-3 bg-white opacity-15 rounded-full animate-bounce"></div>
    </div>

    <div class="min-h-screen flex items-center justify-center p-6">
        <!-- Mouse trail effect -->
        <div class="mouse-trail" id="mouseTrail"></div>

        <!-- Sparkle effects -->
        <div class="sparkle" style="top: 20%; left: 10%; animation-delay: 0s;"></div>
        <div class="sparkle" style="top: 60%; right: 15%; animation-delay: 0.5s;"></div>
        <div class="sparkle" style="bottom: 30%; left: 20%; animation-delay: 1s;"></div>

        <div class="max-w-4xl w-full glass-effect rounded-3xl shadow-2xl card-hover fade-in overflow-hidden">
            <!-- Progress bar -->
            <div class="progress-bar">
                <div class="progress-fill" style="width: 75%"></div>
            </div>

            <!-- Header with blue gradient text -->
            <div class="relative p-8 pb-6">
                <div class="relative">
                    <h2 class="text-4xl font-bold blue-text-gradient mb-2">
                        <span class="emoji-big">✏️</span>Edit Forum
                    </h2>
                    <p class="text-white/80">Transform your ideas into amazing forum content</p>
                </div>
            </div>

            <!-- Form section -->
            <div class="px-8 pb-8">
                <form action="{{ route('forums.update', $forum->id) }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Title Input -->
                    <div class="group">
                        <label for="title"
                            class="block text-white font-semibold mb-2 transition-colors group-hover:text-blue-200">
                            <span class="emoji-big">📝</span>Forum Title
                        </label>
                        <input type="text" name="title" id="titleInput"
                            class="w-full px-6 py-4 bg-white/90 border-2 border-blue-200 rounded-2xl text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 input-focus transition-all duration-300 blue-border-gradient"
                            value="{{ old('title', $forum->title) }}" placeholder="Enter an amazing title..."
                            maxlength="100" required>
                        <div class="char-counter">
                            <span id="titleCount">0</span>/100 characters
                        </div>
                        @error('title')
                            <p class="text-red-400 text-sm mt-2 bg-red-500/20 px-3 py-1 rounded-lg">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content Input -->
                    <div class="group">
                        <label for="content"
                            class="block text-white font-semibold mb-2 transition-colors group-hover:text-blue-200">
                            <span class="emoji-big">✍️</span>Forum Content
                        </label>
                        <textarea name="content" id="contentInput"
                            class="w-full px-6 py-4 bg-white/90 border-2 border-blue-200 rounded-2xl text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 input-focus transition-all duration-300 resize-none blue-border-gradient"
                            rows="6" placeholder="Share your thoughts and ideas..." maxlength="1000" required>{{ old('content', $forum->content) }}</textarea>
                        <div class="char-counter">
                            <span id="contentCount">0</span>/1000 characters
                        </div>
                        @error('content')
                            <p class="text-red-400 text-sm mt-2 bg-red-500/20 px-3 py-1 rounded-lg">{{ $message }}</p>
                        @enderror
                    </div>



                    <!-- Action Buttons -->
                    <div class="pt-4 flex gap-4">
                        <a href="{{ route('forums.index') }}"
                            class="flex-1 px-8 py-4 bg-gradient-to-r from-gray-500 to-gray-600 text-white font-bold rounded-2xl shadow-lg fun-button transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-transparent text-center">
                            <span class="flex items-center justify-center space-x-2">
                                <span class="emoji-big">⬅️</span>
                                <span>Back to Forum</span>
                            </span>
                        </a>

                        <button type="submit"
                            class="flex-1 px-8 py-4 fun-button text-white font-bold rounded-2xl shadow-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 focus:ring-offset-transparent">
                            <span class="flex items-center justify-center space-x-2">
                                <span class="emoji-big">🚀</span>
                                <span>Update Forum</span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Character counter functionality
        function updateCharCount(input, counterId, maxLength) {
            const count = input.value.length;
            const counter = document.getElementById(counterId);
            counter.textContent = count;

            // Color coding based on usage
            if (count > maxLength * 0.8) {
                counter.style.color = '#ef4444'; // red
            } else if (count > maxLength * 0.6) {
                counter.style.color = '#f59e0b'; // yellow
            } else {
                counter.style.color = '#6b7280'; // gray
            }
        }

        // Mouse trail effect
        function createMouseTrail() {
            const trail = document.getElementById('mouseTrail');

            document.addEventListener('mousemove', (e) => {
                trail.style.left = e.clientX - 10 + 'px';
                trail.style.top = e.clientY - 10 + 'px';
                trail.style.opacity = '1';
            });

            document.addEventListener('mouseleave', () => {
                trail.style.opacity = '0';
            });
        }

        // Progress bar animation
        function animateProgressBar() {
            const progressFill = document.querySelector('.progress-fill');
            let width = 0;
            const targetWidth = 75;

            const interval = setInterval(() => {
                if (width >= targetWidth) {
                    clearInterval(interval);
                } else {
                    width += 2;
                    progressFill.style.width = width + '%';
                }
            }, 50);
        }

        // Initialize everything when DOM loads
        document.addEventListener('DOMContentLoaded', function() {
            // Character counters
            const titleInput = document.getElementById('titleInput');
            const contentInput = document.getElementById('contentInput');

            // Set initial counts
            updateCharCount(titleInput, 'titleCount', 100);
            updateCharCount(contentInput, 'contentCount', 1000);

            // Add event listeners
            titleInput.addEventListener('input', () => updateCharCount(titleInput, 'titleCount', 100));
            contentInput.addEventListener('input', () => updateCharCount(contentInput, 'contentCount', 1000));

            // Interactive effects
            const inputs = document.querySelectorAll('input, textarea');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('scale-105');
                });
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('scale-105');
                });
            });

            // Initialize mouse trail and progress bar
            createMouseTrail();
            animateProgressBar();
        });
    </script>
</body>

</html>
