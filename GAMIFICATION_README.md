# Sistem Gamifikasi Mathporia

## Overview

Sistem gamifikasi Mathporia dirancang untuk meningkatkan motivasi dan engagement siswa dalam pembelajaran matematika melalui elemen-elemen gamifikasi seperti poin, level, lencana, dan papan peringkat.

## Fitur Utama

### 1. Sistem Poin & Experience Berdasarkan Skor (Score-Based Points System)

#### Ketentuan Standar Quiz:

**Regular Quiz:**

-   Base Points: 50
-   Base Experience: 100 XP
-   Multiplier berdasarkan skor:
    -   100% (Perfect): 2.0x = 100 poin + 300 XP
    -   90-99% (Excellent): 1.5x = 75 poin + 200 XP
    -   80-89% (Good): 1.2x = 60 poin + 150 XP
    -   70-79% (Average): 1.0x = 50 poin + 100 XP
    -   60-69% (Below Average): 0.8x = 40 poin + 80 XP
    -   <60% (Failed): 0.5x = 25 poin + 30 XP

**Boss Quiz:**

-   Base Points: 150
-   Base Experience: 200 XP
-   Multiplier sama seperti regular quiz
-   Perfect Score: 300 poin + 600 XP

**Teka-teki Quiz:**

-   Base Points: 80
-   Base Experience: 120 XP
-   Perfect Score: 160 poin + 360 XP

**Daily Quiz:**

-   Base Points: 60
-   Base Experience: 80 XP
-   Perfect Score: 120 poin + 240 XP

#### Bonus Achievement:

-   **Perfect Score (100%)**: Bonus 100-300 poin + 150-400 XP
-   **High Score (80-99%)**: Bonus 50-100 poin + 80-150 XP
-   **Level Up**: Bonus 200 poin + 300 XP

#### Ketentuan Standar Materi:

**Video Pembelajaran:**

-   Points: 20
-   Experience: 30 XP

**Dokumen (PDF, DOCX, DOC):**

-   Points: 30
-   Experience: 40 XP

**Materi Interaktif (HTML):**

-   Points: 40
-   Experience: 60 XP

**Presentasi (PPTX, PPT):**

-   Points: 25
-   Experience: 35 XP

**Materi Regular:**

-   Points: 25
-   Experience: 35 XP

### 2. Sistem Level (Leveling System)

-   **Formula Experience**: `base * (level ^ 1.5)`
-   **Level Titles**:
    -   Level 1-4: Pemula
    -   Level 5-9: Pembelajar
    -   Level 10-14: Pencari Ilmu
    -   Level 15-19: Ahli Matematika
    -   Level 20-24: Master Matematika
    -   Level 25-29: Legenda Matematika
    -   Level 30+: Matematikawan Sejati

### 3. Sistem Lencana (Badges System)

#### Achievement Badges

-   **Matematikawan Pemula**: Menyelesaikan 5 materi awal
-   **Juara Kuis**: Skor sempurna dalam 3 kuis
-   **Konsisten Belajar**: Login 7 hari berturut-turut
-   **Pembelajar Aktif**: Menyelesaikan 10 kuis

#### Milestone Badges

-   **Level 5**: Mencapai level 5
-   **Level 10**: Mencapai level 10
-   **Level 20**: Mencapai level 20

#### Special Badges

-   **Poin Master**: Mengumpulkan 1000 poin
-   **Pembelajar Sejati**: Menyelesaikan 20 materi dan 15 kuis

### 4. Papan Peringkat (Leaderboard)

-   **Peringkat berdasarkan**: Total poin
-   **Tipe peringkat**: Sepanjang waktu, mingguan, bulanan
-   **Fitur**: Progress bar, level info, ranking user

## Struktur Database

### Tabel Utama

1. **user_points**: Menyimpan poin dan level user
2. **point_activities**: Aktivitas yang memberikan poin
3. **point_histories**: Riwayat poin yang didapat
4. **badges**: Definisi lencana
5. **user_badges**: Lencana yang dimiliki user
6. **leaderboards**: Papan peringkat
7. **leaderboard_entries**: Entri peringkat
8. **daily_challenges**: Tantangan harian
9. **user_challenges**: Progress tantangan user

## Integrasi dengan Fitur Existing

### Quiz System

-   Otomatis memberikan poin berdasarkan skor dengan ketentuan standar
-   Bonus poin untuk skor sempurna dan tinggi
-   Poin berbeda untuk tipe kuis (Boss, Teka-teki, Daily)
-   Display reward info di halaman result quiz

### Materi System

-   Poin untuk menyelesaikan materi berdasarkan tipe file
-   Auto detect material type (video, document, interactive, presentation)
-   Mark as completed dengan AJAX

### Forum System

-   Poin untuk membuat forum dan berpartisipasi
-   Poin untuk memberikan komentar

### Login System

-   Poin harian untuk login
-   Middleware otomatis memberikan poin

## API Endpoints

### Dashboard

-   `GET /gamification` - Dashboard utama
-   `GET /gamification/stats` - Data statistik user

### Badges

-   `GET /gamification/badges` - Halaman lencana
-   `POST /gamification/check-badges` - Cek lencana baru

### Leaderboard

-   `GET /gamification/leaderboard` - Papan peringkat
-   `GET /gamification/leaderboard-data` - Data leaderboard AJAX

### Point History

-   `GET /gamification/point-history` - Riwayat poin

### Award Points

-   `POST /gamification/award-points` - Berikan poin manual
-   `POST /gamification/award-quiz-points` - Poin kuis
-   `POST /gamification/award-login-points` - Poin login

### Material Completion

-   `POST /materi/{id}/complete` - Tandai materi selesai

## Cara Penggunaan

### Untuk Siswa

1. Akses dashboard gamifikasi melalui menu navigasi
2. Lihat progress level dan poin di header
3. Cek lencana yang telah diperoleh
4. Bandingkan peringkat dengan siswa lain
5. Lihat riwayat aktivitas yang memberikan poin
6. Selesaikan quiz dan materi untuk mendapatkan poin
7. Lihat reward detail di halaman result quiz

### Untuk Developer

1. Gunakan `GamificationService` untuk memberikan poin
2. Panggil `awardQuizPointsByScore()` untuk quiz dengan skor
3. Panggil `awardMaterialPoints()` untuk materi
4. Gunakan middleware `award-daily-login` untuk poin login

## Contoh Penggunaan

```php
// Memberikan poin untuk quiz berdasarkan skor
$gamificationService->awardQuizPointsByScore($user, 85, 'boss');

// Memberikan poin untuk materi
$gamificationService->awardMaterialPoints($user, 'video');

// Mendapatkan info reward quiz
$rewardInfo = $gamificationService->getQuizRewardInfo(95, 'regular');
```

## Notifikasi

-   Notifikasi otomatis saat mendapatkan lencana baru
-   Flash message untuk aktivitas yang memberikan poin
-   Progress bar untuk level berikutnya
-   Reward display di quiz result page

## Monitoring

-   Log semua aktivitas gamifikasi
-   Track progress user
-   Monitor engagement metrics

## Future Enhancements

1. Daily challenges dengan reward khusus
2. Seasonal events dan limited badges
3. Team challenges dan collaborative achievements
4. Advanced analytics dan reporting
5. Mobile push notifications untuk achievements

## Troubleshooting

-   Pastikan user memiliki `userPoint` record
-   Cek cache untuk daily login points
-   Verifikasi point activities exist di database
-   Monitor error logs untuk gamification errors
