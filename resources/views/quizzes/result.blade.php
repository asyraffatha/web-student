<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hasil Quiz</title>
    @vite('resources/css/app.css')
    <style>
        body {
            background-color: #254aa7;
            /* tailwind blue-800 */
            background-image: url('storage/images/LogoTA.png');
            background-size: 400px;
            background-position: center;
            background-repeat: no-repeat;
        }

        .result-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            margin: auto;
        }

        .result-container h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333333;
        }

        .result-container p {
            font-size: 1.5rem;
            color: #333333;
        }

        .score {
            font-size: 2rem;
            font-weight: bold;
            color: #2d6a4f;
        }

        .congratulations-message {
            color: #38a169;
            font-size: 1.5rem;
            font-weight: 600;
            margin-top: 20px;
        }

        .retry-message {
            color: #e53e3e;
            font-size: 1.5rem;
            font-weight: 600;
            margin-top: 20px;
        }

        .back-btn {
            display: inline-block;
            background-color: #3182ce;
            color: #ffffff;
            padding: 15px 30px;
            border-radius: 12px;
            font-size: 1.25rem;
            font-weight: bold;
            margin-top: 30px;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .back-btn:hover {
            background-color: #2b6cb0;
            cursor: pointer;
        }
    </style>
</head>

<body class="flex-1 p-8 min-h-screen relative">
    <div class="result-container">
        <h1>Hasil Quiz: {{ $quiz->title }}</h1>

        <p class="mb-6">
            Skor Anda: <span class="score">{{ number_format($score, 2) }}%</span>
        </p>

        @if ($score >= $quiz->passing_score)
            <p class="congratulations-message">Selamat, Anda Lulus! 🎉</p>
        @else
            <p class="retry-message">Maaf, Anda Belum Lulus. Coba Lagi! 😢</p>
        @endif

        <a href="{{ route('quizzes.index') }}" class="back-btn">
            Kembali ke Daftar Quiz
        </a>
    </div>
</body>

</html>
