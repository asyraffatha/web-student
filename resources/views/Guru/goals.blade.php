<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Goals Progress</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        header {
            background-color: #2e86de;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        main {
            max-width: 1100px;
            margin: 0 auto;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
            padding: 32px 24px;
        }

        h2 {
            color: #2e86de;
            margin-top: 0;
        }

        .selector {
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 32px;
        }

        th,
        td {
            border: 1px solid #e0e0e0;
            padding: 8px 12px;
            text-align: center;
        }

        th {
            background: #f0f4fa;
            color: #2e86de;
        }

        tr:nth-child(even) {
            background: #f9fbfd;
        }

        .no-data {
            color: #888;
            text-align: center;
            padding: 24px;
        }

        .chart-container {
            width: 100%;
            min-height: 400px;
        }

        @media (max-width: 600px) {
            body {
                padding: 6px;
                font-size: 13px;
            }

            header {
                padding: 12px 0;
                text-align: left;
            }

            header h1 {
                font-size: 1.2rem;
            }

            .back-btn-dashboard {
                font-size: 0.95rem !important;
                padding: 8px 18px 8px 12px !important;
            }

            main {
                padding: 14px 6px !important;
                border-radius: 10px !important;
                box-shadow: 0 1px 4px rgba(37, 99, 235, 0.08);
            }

            section {
                margin-bottom: 18px !important;
            }

            h2 {
                font-size: 1rem !important;
                margin-bottom: 6px !important;
            }

            .selector {
                flex-direction: column !important;
                gap: 10px !important;
                align-items: stretch !important;
            }

            .selector label {
                font-size: 0.98rem !important;
            }

            .selector select {
                width: 100% !important;
                margin-left: 0 !important;
                margin-top: 4px !important;
            }

            table {
                font-size: 12px !important;
                min-width: 500px;
            }

            .chart-container {
                padding: 12px 4px !important;
                min-height: 220px !important;
            }

            .no-data {
                padding: 12px !important;
                font-size: 13px !important;
            }
        }
    </style>
</head>

<body>
    <header>
        <div style="display:flex;align-items:center;justify-content:space-between;max-width:1100px;margin:0 auto;">
            <h1 style="font-size:2rem;font-weight:700;letter-spacing:0.5px;">Progress Nilai Siswa</h1>
            <a href="{{ route('guru.dashboard') }}" class="back-btn-dashboard"
                style="display:inline-flex;align-items:center;gap:10px;padding:10px 28px 10px 20px;font-weight:700;font-size:1.1rem;border-radius:2em;background:linear-gradient(90deg,#ff7e5f 0%,#feb47b 100%);color:#fff;box-shadow:0 2px 8px rgba(255,126,95,0.10);border:none;outline:none;position:relative;overflow:hidden;transition:transform 0.18s,box-shadow 0.18s;"
                onmouseover="this.style.transform='scale(1.06)';this.style.boxShadow='0 4px 16px rgba(255,126,95,0.18)';"
                onmouseout="this.style.transform='scale(1)';this.style.boxShadow='0 2px 8px rgba(255,126,95,0.10)';">
                <span style="font-weight:700;letter-spacing:1px;">Kembali Ke Dashboard</span>
                <span
                    style="display:inline-flex;align-items:center;justify-content:center;width:38px;height:38px;background:#fff;border-radius:50%;margin-left:8px;box-shadow:0 1px 4px rgba(255,126,95,0.10);">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <circle cx="11" cy="11" r="10" fill="none" stroke="#ff7e5f" stroke-width="2" />
                        <path d="M13.5 7.5L8.5 11L13.5 14.5" stroke="#ff7e5f" stroke-width="2.2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </span>
            </a>
        </div>
    </header>
    <main
        style="max-width:1100px;margin:32px auto 0 auto;background:#fff;border-radius:18px;box-shadow:0 4px 24px rgba(37,99,235,0.08);padding:32px 24px;">
        <section style="margin-bottom:32px;">
            <h2 style="font-size:1.25rem;font-weight:600;color:#2563eb;margin-bottom:8px;">Filter Data</h2>
            <p style="color:#666;font-size:0.98rem;margin-bottom:16px;">Pilih kelas dan tipe quiz untuk melihat rekap
                nilai siswa secara detail.</p>
            <form method="get" class="selector" style="gap:20px;">
                <div>
                    <label for="kelas" style="font-weight:500;">Pilih Kelas:</label>
                    <select name="kelas" id="kelas" onchange="this.form.submit()"
                        style="margin-left:8px;padding:6px 12px;border-radius:8px;border:1px solid #cbd5e1;">
                        @foreach ($kelasDiampu as $kelas)
                            <option value="{{ $kelas->nama }}" {{ $kelasTerpilih == $kelas->nama ? 'selected' : '' }}>
                                {{ $kelas->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="tipe" style="font-weight:500;">Tipe Quiz:</label>
                    <select name="tipe" id="tipe" onchange="this.form.submit()"
                        style="margin-left:8px;padding:6px 12px;border-radius:8px;border:1px solid #cbd5e1;">
                        @foreach ($tipeQuiz as $key => $label)
                            <option value="{{ $key }}" {{ $tipeQuizTerpilih == $key ? 'selected' : '' }}>
                                {{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                @if ($siswa->count())
                    <div>
                        <label for="siswa_id" style="font-weight:500;">Pilih Siswa:</label>
                        <select name="siswa_id" id="siswa_id" onchange="this.form.submit()"
                            style="margin-left:8px;padding:6px 12px;border-radius:8px;border:1px solid #cbd5e1;min-width:120px;">
                            <option value="">Semua Siswa</option>
                            @foreach ($siswa as $sis)
                                <option value="{{ $sis->id }}"
                                    {{ request('siswa_id') == $sis->id ? 'selected' : '' }}>{{ $sis->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </form>
        </section>
        <section style="margin-bottom:32px;">
            <h2 style="font-size:1.15rem;font-weight:600;color:#2563eb;margin-bottom:8px;">Tabel Nilai Siswa</h2>
            <p style="color:#666;font-size:0.97rem;margin-bottom:16px;">Tabel berikut menampilkan seluruh nilai siswa
                untuk quiz yang dipilih. Scroll ke kanan jika tabel melebar.</p>
            @if ($siswa->count() && $quizzes->count())
                <div
                    style="overflow-x:auto;background:#f8fafc;border-radius:12px;padding:12px 0;box-shadow:0 2px 8px rgba(37,99,235,0.04);">
                    <table style="width:100%;border-collapse:collapse;">
                        <thead style="position:sticky;top:0;z-index:2;">
                            <tr>
                                <th
                                    style="background:#f1f5f9;color:#2563eb;font-weight:700;padding:10px 8px;text-align:left;">
                                    Nama Siswa</th>
                                @foreach ($quizzes as $quiz)
                                    <th
                                        style="background:#2563eb;color:#fff;font-weight:bold;letter-spacing:0.5px;padding:10px 8px;">
                                        {{ $quiz->title }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $s)
                                @if (!request('siswa_id') || request('siswa_id') == $s->id)
                                    <tr
                                        style="background:{{ $loop->even ? '#f3f4f6' : '#fff' }};transition:background 0.2s;">
                                        <td style="text-align:left;font-weight:500;color:#222;padding:8px 8px;">
                                            {{ $s->name }}</td>
                                        @foreach ($quizzes as $q)
                                            <td
                                                style="padding:8px 8px;{{ ($nilai[$s->id][$q->id] ?? null) >= 75 ? 'color:#16a34a;font-weight:600;' : (($nilai[$s->id][$q->id] ?? null) !== null ? 'color:#eab308;font-weight:600;' : 'color:#aaa;') }}">
                                                {{ $nilai[$s->id][$q->id] !== null ? $nilai[$s->id][$q->id] : '-' }}
                                            </td>
                                        @endforeach
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="no-data" style="color:#888;text-align:center;padding:24px;">Belum ada data siswa atau quiz
                    untuk kelas dan tipe ini.</div>
            @endif
        </section>
        <section>
            <h2 style="font-size:1.15rem;font-weight:600;color:#2563eb;margin-bottom:8px;">Grafik Nilai Siswa</h2>
            <p style="color:#666;font-size:0.97rem;margin-bottom:16px;">Grafik berikut memudahkan guru membandingkan
                performa siswa pada setiap quiz.</p>
            <div class="chart-container"
                style="background:#f8fafc;border-radius:12px;padding:24px 16px;box-shadow:0 2px 8px rgba(37,99,235,0.04);">
                <canvas id="barchart"></canvas>
            </div>
        </section>
        <script>
            const labels = {!! json_encode(
                request('siswa_id') ? $siswa->where('id', request('siswa_id'))->pluck('name') : $siswa->pluck('name'),
            ) !!};

            function getRandomColor(idx) {
                const colors = [
                    '#2563eb', '#f59e42', '#10b981', '#e11d48', '#a21caf', '#facc15', '#0ea5e9', '#f472b6', '#14b8a6',
                    '#f87171', '#6366f1', '#fbbf24', '#22d3ee', '#84cc16', '#eab308', '#f43f5e', '#8b5cf6', '#f97316',
                    '#2dd4bf', '#4ade80', '#f472b6', '#f87171', '#a3e635', '#fcd34d', '#fca5a5', '#f9fafb'
                ];
                return colors[idx % colors.length];
            }
            const datasets = [
                @foreach ($quizzes as $q)
                    {
                        label: "{{ $q->title }}",
                        data: [
                            @foreach ($siswa as $s)
                                @if (!request('siswa_id') || request('siswa_id') == $s->id)
                                    {{ $nilai[$s->id][$q->id] !== null ? $nilai[$s->id][$q->id] : 0 }},
                                @endif
                            @endforeach
                        ],
                        backgroundColor: @if ($tipeQuizTerpilih == 'daily')
                            getRandomColor({{ $loop->index }})
                        @else
                            'rgba(37,99,235,0.7)'
                        @endif
                    },
                @endforeach
            ];
            new Chart(document.getElementById('barchart'), {
                type: 'bar',
                data: {
                    labels,
                    datasets
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    },
                    scales: {
                        x: {
                            stacked: true
                        },
                        y: {
                            beginAtZero: true,
                            max: 100
                        }
                    }
                }
            });
        </script>
    </main>
</body>

</html>
