<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @vite('resources/css/app.css')
    <title>Material</title>
</head>

<body>
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white text-indigo-800 p-4 flex-col overflow-y-auto">
            <div class="p-4 border-b border-gray-800">
                <div class="flex items-center justify-between">
                    <img src="{{ asset('images/LogoTA.png') }}" alt="Logo Mathporia"
                        class="max-h-24 w-auto flex-shrink-0">
                </div>
            </div>

            <!-- Search Bar -->
            <div class="p-4">
                <div class="relative">
                    <input type="text"
                        class="w-full bg-gray-800 text-white rounded-md pl-10 pr-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Search...">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>

            <nav class="mt-5 px-2">
                <!-- Main Navigation -->
                <div class="space-y-4">
                    <!-- Dashboard -->
                    <a href="{{ route('home') }}"
                        class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200
                         {{ Request::routeIs('home') ? 'bg-gray-300 text-indigo-800' : 'text-blue hover:bg-gray-300 hover:text-indigo-800' }}">
                        <svg class="h-5 w-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Home
                    </a>
                    <!-- Material Dropdown -->
                    <div class="space-y-1">
                        <button
                            class="w-full flex items-center justify-between px-4 py-2.5 text-sm font-medium rounded-lg  text-indigo-800 hover:bg-gray-300 hover:text-indigo-800 focus:outline-none"
                            aria-expanded="false" aria-controls="material-dropdown">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                </svg>
                                <span class="ml-3">Take Material</span>
                            </div>
                            <svg class="ml-2 h-5 w-5 transform transition-transform duration-200"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div class="hidden space-y-1 pl-11" id="material-dropdown">
                            <a href="{{ route('material') }}"
                                class="group flex items-center px-4 py-2 text-sm rounded-md transition-all duration-200
                                {{ Request::is('material') ? 'bg-gray-300 text-indigo-800' : 'text-indigo-800 hover:bg-gray-300 hover:text-indigo-800' }}">
                                List of Materials
                            </a>
                            <a href="{{ route('discussion') }}"
                                class="group flex items-center px-4 py-2 text-sm rounded-md transition-all duration-200
                                {{ Request::is('discussion') ? 'bg-gray-300 text-indigo-800' : 'text-indigo-800 hover:bg-gray-300 hover:text-indigo-800' }}">
                                Discussion with Teacher
                            </a>
                        </div>
                    </div>

                    <!-- Quiz Dropdown -->
                    <div class="space-y-1">
                        <button
                            class="w-full flex items-center justify-between px-4 py-2.5 text-sm font-medium rounded-lg text-indigo-800 hover:bg-gray-300 hover:text-indigo-800 focus:outline-none"
                            aria-expanded="false" aria-controls="quiz-dropdown">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
                                </svg>

                                <span class="ml-3">Quiz</span>
                            </div>
                            <svg class="ml-2 h-5 w-5 transform transition-transform duration-200"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div class="hidden space-y-1 pl-11" id="quiz-dropdown">
                            <a href="{{ route('quizzes.index') }}"
                                class="group flex items-center px-4 py-2 text-sm rounded-md transition-all duration-200 text-indigo-800 hover:bg-gray-300 hover:text-indigo-800"
                                target="_blank">
                                Take a Quiz
                            </a>
                            <a href="https://www.desmos.com/scientific"
                                class="group flex items-center px-4 py-2 text-sm rounded-md transition-all duration-200 text-indigo-800 hover:bg-gray-300 hover:text-indigo-800"
                                target="_blank">
                                Scientific Calculator
                            </a>
                            <a href="#"
                                class="group flex items-center px-4 py-2 text-sm rounded-md transition-all duration-200 text-indigo-800 hover:bg-gray-300 hover:text-indigo-800">
                                Check History Quiz Score
                            </a>
                        </div>
                    </div>

                    <!-- Member Dropdown -->
                    <div class="space-y-1">
                        <button
                            class="w-full flex items-center justify-between px-4 py-2.5 text-sm font-medium rounded-lg text-indigo-800 hover:bg-gray-300 hover:text-indigo-800 focus:outline-none"
                            aria-expanded="false" aria-controls="member-dropdown">
                            <div class="flex items-center">
                                <svg class="h-5 w-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                Members
                            </div>
                            <svg class="ml-2 h-5 w-5 transform transition-transform duration-200"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div class="hidden space-y-1 pl-11" id="member-dropdown">
                            <a href="{{ route('forums.index') }}"
                                class="group flex items-center px-4 py-2 text-sm rounded-md transition-all duration-200
                                {{ Request::is('forum') ? 'bg-gray-300 text-indigo-800' : 'text-indigo-800 hover:bg-gray-300 hover:text-indigo-800' }}">
                                Discussion Forum
                            </a>
                            <a href="#"
                                class="group flex items-center px-4 py-2 text-sm rounded-md transition-all duration-200 text-indigo-800 hover:bg-gray-300 hover:text-indigo-800">
                                Discussion Team
                            </a>
                        </div>
                    </div>

                    <!-- Calendar -->
                    <a href="{{ route('calendar.index') }}"
                        class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-200
                            {{ Request::routeIs('calendar.calendar') ? 'bg-gray-300 text-indigo-800' : 'text-indigo-800 hover:bg-gray-300 hover:text-indigo-800' }}">
                        <svg class="h-5 w-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Calendar
                    </a>

                    <!-- Documents -->
                    <a href="{{ route('setting.information') }}"
                        class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg text-indigo-800 hover:bg-gray-300 hover:text-indigo-800 group transition-all duration-200">
                        <svg class="h-5 w-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Information
                    </a>
                </div>
            </nav>

            <!-- User Profile -->
            <div class="mt-auto p-4 border-t border-gray-800">
                <div class="flex items-center">
                    <img class="h-8 w-8 rounded-full"
                        src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : 'https://via.placeholder.com/256' }}"
                        alt="{{ Auth::user()->name }}">
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-400">{{ Auth::user()->email }}</p>
                        <span
                            class="inline-block mt-1 px-2 py-1 bg-indigo-100 text-indigo-700 rounded text-xs font-semibold">
                            Kelas: {{ Auth::user()->kelas }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Link Setting -->
            <div class="mt-4 flex justify-center">
                <a href="{{ route('setting.form') }}"
                    class="inline-flex items-center gap-2 text-gray-600 hover:text-white bg-gray-100 hover:bg-gray-500 px-5 py-2.5 rounded-xl shadow-sm transition duration-300 ease-in-out">
                    <!-- Ikon Gear -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11.983 4.917a1 1 0 011.034 0l1.347.777a1 1 0 001.034 0l1.347-.777a1 1 0 011.034 0l.777 1.347a1 1 0 000 1.034l-.777 1.347a1 1 0 000 1.034l.777 1.347a1 1 0 010 1.034l-1.347.777a1 1 0 000 1.034l.777 1.347a1 1 0 01-1.034 0l-1.347-.777a1 1 0 00-1.034 0l-1.347.777a1 1 0 01-1.034 0l-.777-1.347a1 1 0 000-1.034l.777-1.347a1 1 0 000-1.034l-.777-1.347a1 1 0 010-1.034l1.347-.777a1 1 0 000-1.034l-.777-1.347a1 1 0 011.034 0zM12 15a3 3 0 100-6 3 3 0 000 6z">
                        </path>
                    </svg>
                    <span class="font-medium text-sm">Setting</span>
                </a>
            </div>

            <form id="logout-form" method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="#" onclick="confirmLogout()"
                    class="flex items-center text-red-600 hover:text-white bg-red-200 hover:bg-red-600 px-4 py-2 rounded-lg transition duration-300">
                    <!-- Ikon Logout -->
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6-10v4m0 12v-4"></path>
                    </svg>
                    <span>Logout</span>
                </a>
            </form>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 bg-gray-100 overflow-y-auto">
            <h2 class="text-2xl font-semibold text-gray-700 mb-6">Daftar Materi</h2>

            @if ($materis->isEmpty())
                <div class="text-gray-500">Belum ada materi yang ditambahkan.</div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($materis as $materi)
                        <div class="bg-white rounded-lg shadow p-4">
                            <h3 class="text-lg font-semibold text-blue-700">{{ $materi->judul }}</h3>
                            <p class="text-sm text-gray-600 mb-1">Kelas: {{ $materi->kelas }}</p>
                            <p class="text-sm text-gray-700 mb-1">{{ $materi->deskripsi }}</p>

                            {{-- Tampilkan deadline jika ada --}}
                            @if ($materi->deadline)
                                <p class="text-sm text-red-600 mt-2">🕒 Deadline:
                                    {{ \Carbon\Carbon::parse($materi->deadline)->format('d M Y H:i') }}</p>
                            @endif

                            @if (!empty($materi->file_path))
                                <a href="{{ asset('storage/' . $materi->file_path) }}" target="_blank"
                                    class="text-blue-600 hover:underline">
                                    📄 Lihat File
                                </a>
                            @else
                                <p class="text-red-600">❌ Tidak ada file</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </main>


        <script>
            function confirmLogout() {
                if (confirm("Apakah Anda yakin ingin logout?")) {
                    document.getElementById('logout-form').submit();
                }
            }
        </script>
        <script>
            function toggleDropdown() {
                document.getElementById("dropdown").classList.toggle("hidden");
            }
        </script>
        <script>
            // Dropdown functionality
            document.querySelectorAll('button[aria-controls]').forEach(button => {
                button.addEventListener('click', () => {
                    const isExpanded = button.getAttribute('aria-expanded') === 'true';
                    const dropdownContent = document.getElementById(button.getAttribute('aria-controls'));

                    button.setAttribute('aria-expanded', !isExpanded);
                    dropdownContent.classList.toggle('hidden');
                    button.querySelector('svg:last-child').classList.toggle('rotate-180');
                });
            });
        </script>
</body>

</html>
