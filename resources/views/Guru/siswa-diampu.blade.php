<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Siswa di Kelas yang Anda Ampu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="p-4">

    <div class="container">
        <h2 class="mb-4">Daftar Siswa di Kelas yang Anda Ampu</h2>

        @foreach ($kelasDiampu as $kelas)
            <div class="card mb-3">
                <div class="card-header">
                    Kelas: {{ $kelas->nama }}
                </div>
                <div class="card-body">
                    @if ($kelas->siswa->count() > 0)
                        <ul class="list-group">
                            @foreach ($kelas->siswa as $siswa)
                                <li class="list-group-item">
                                    {{ $siswa->name }} - {{ $siswa->email }}
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">Tidak ada siswa di kelas ini.</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

</body>

</html>
