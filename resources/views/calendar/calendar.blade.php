<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Calendar</title>
    @vite('resources/css/app.css')
    <!-- FullCalendar -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen">

    <main class="flex-1 p-8 min-h-screen relative bg-center bg-no-repeat"
        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); background-image: url('storage/images/LogoTA.png'), linear-gradient(135deg, #667eea 0%, #764ba2 100%); background-size: 400px, cover; background-position: center; background-repeat: no-repeat;">

        <div class="max-w-5xl mx-auto bg-white bg-opacity-90 shadow-2xl rounded-3xl p-8 backdrop-blur-sm">
            <h1 class="text-4xl font-bold text-center text-blue-700 mb-8">📅 Calendar</h1>

            <!-- Back to Home and Add Event Buttons -->
            <div class="flex justify-between mb-6">
                <a href="{{ route('home') }}"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-5 py-2 rounded-lg shadow transition duration-300 ease-in-out">
                    ← Kembali ke Home
                </a>
                <button id="addEventBtn"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-300 ease-in-out shadow">
                    + Tambah Acara
                </button>
            </div>

            <div id='calendar' class="rounded-xl overflow-hidden shadow"></div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 600,
                events: '/events', // Mengambil acara dari server
                dateClick: function(info) {
                    var title = prompt('Judul Acara:');
                    if (title && title.trim() !== '') {
                        // Simpan acara ke server
                        fetch('/events', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    title: title,
                                    start: info.dateStr,
                                    allDay: true
                                })
                            })
                            .then(response => response.json())
                            .then(event => {
                                calendar.refetchEvents(); // reload dari server
                            })
                            .catch(() => alert('Gagal menambah acara.'));
                    }
                },
                eventClick: function(info) {
                    if (confirm('Apakah Anda yakin ingin menghapus acara "' + info.event.title +
                            '"?')) {
                        // Hapus acara dari server
                        fetch('/events/' + info.event.id, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                            .then(response => {
                                if (response.ok) {
                                    info.event.remove(); // Hapus acara dari kalender
                                } else {
                                    alert('Gagal menghapus acara.');
                                }
                            });
                    }
                }
            });
            calendar.render();

            document.getElementById('addEventBtn').addEventListener('click', function() {
                var title = prompt('Judul Acara:');
                if (title && title.trim() !== '') {
                    var date = new Date();
                    fetch('/events', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                title: title,
                                start: date.toISOString().split('T')[0],
                                allDay: true
                            })
                        })
                        .then(response => response.json())
                        .then(event => {
                            calendar.refetchEvents(); // reload dari server
                        })
                        .catch(() => alert('Gagal menambah acara.'));
                }
            });
        });
    </script>
</body>

</html>
