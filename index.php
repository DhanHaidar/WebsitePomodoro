<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pomodoro Timer & To-Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #f5f5dc; /* Warna cream */
        }

        /* Judul berada di atas container */
        h1 {
            text-align: center;
            margin: 30px 0; /* Memberikan jarak vertikal yang cukup */
        }

        .container {
            background-color: #d3b094; /* Warna coklat cerah pastel */
            border-radius: 10px; /* Menambahkan sudut membulat */
            padding: 20px; /* Menambahkan ruang dalam */
            display: flex;
            flex-direction: column; /* Secara default, susun elemen secara vertikal */
        }

        /* Card Styling */
        .card {
            background-color: #c8a87c; /* Coklat cream agak gelap */
            margin-bottom: 20px; /* Memberikan jarak antar card */
        }

        .card-body {
            background-color: #c8a87c;
        }

        /* Styling untuk input dan button */
        .form-control {
            background-color: #e4d1a1; /* Coklat cream pada input */
            border: 1px solid #c8a87c;
        }

        button {
            background-color: #c8a87c; /* Button dengan warna serasi */
            border: none;
        }

        button:hover {
            background-color: #a98f65; /* Hover effect */
        }

        #todoItems {
            background-color: #a98f65; /* Cream cerah untuk kotak list */
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #todoItems li {
            background-color: #e4d1a1; /* Warna item list */
            margin-bottom: 8px;
            padding: 10px;
            border-radius: 6px;
        }

        #todoItems li:hover {
            background-color: #f1f1e0;
        }

        /* Responsif: Landscape Mode (Lebar lebih dari 768px) */
        @media (min-width: 768px) {
            .container {
                flex-direction: row; /* Menyusun elemen secara horizontal */
                justify-content: space-between; /* Memberikan jarak antara Pomodoro Timer dan To-Do List */
            }

            .card {
                flex: 1;
                margin: 10px;
                margin-bottom: 0; /* Mengurangi margin bawah pada card */
            }

            .card:first-child {
                order: 1; /* Pomodoro Timer tetap di kiri */
            }

            .card:last-child {
                order: 2; /* Daftar Tugas di kanan */
            }
        }

        /* Responsif: Portrait Mode (Lebar kurang dari 768px) */
        @media (max-width: 767px) {
            .container {
                display: block; /* Menyusun konten secara vertikal */
            }

            .card {
                margin-bottom: 20px;
            }
        }

         /* Notifikasi style */
         .notification {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #28a745; /* Warna hijau untuk notifikasi sukses */
            color: white;
            padding: 20px;
            border-radius: 10px;
            font-size: 16px;
            width: 80%;
            max-width: 400px;
            text-align: center;
            opacity: 0;
            animation: fadeInOut 4s forwards;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
        }

        .notification.show {
            opacity: 1;
        }

        .notification.hide {
            opacity: 0;
        }

        @keyframes fadeInOut {
            0% {
                opacity: 0;
                transform: translate(-50%, -50%) scale(0.8);
            }
            10% {
                opacity: 1;
                transform: translate(-50%, -50%) scale(1);
            }
            90% {
                opacity: 1;
                transform: translate(-50%, -50%) scale(1);
            }
            100% {
                opacity: 0;
                transform: translate(-50%, -50%) scale(0.8);
            }
        }

        /* Notifikasi jenis break */
        .notification.break {
            background-color: #f39c12; /* Warna oranye untuk istirahat */
        }

        /* Notifikasi jenis work */
        .notification.work {
            background-color: #3498db; /* Warna biru untuk waktu kerja */
        }

    </style>
</head>
<body>
    <h1>Pomodoro Timer & To-Do List</h1> <!-- Judul berada di luar container -->

    <div class="container my-5">
        <!-- Pomodoro Timer -->
        <div class="card mb-4">
            <div class="card-body">
                <h2 class="card-title">Pomodoro Timer</h2>
                <div class="text-center">
                    <div class="display-4" id="timer">00:00</div>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <button class="btn btn-primary mx-1" id="toggleTimer">Mulai</button> <!-- Ubah tombol ke toggle -->
                    <button class="btn btn-danger mx-1" id="resetTimer">Reset</button>
                </div>
                <div class="mt-3">
                    <label for="workTime">Waktu Kerja (menit):</label>
                    <input type="number" id="workTime" value="0" class="form-control" min="1" max="60">
                    <label for="breakTime" class="mt-2">Waktu Istirahat (menit):</label>
                    <input type="number" id="breakTime" value="0" class="form-control" min="1" max="30">
                </div>
                <div class="card-body text-center">
    <h2 class="card-title">Spotify Player</h2>
    <!-- Spotify iframe dengan ID -->
    <iframe id="spotifyPlayer" style="border-radius:12px" src="https://open.spotify.com/embed/playlist/33Tf0fgyNJNCsZCKw8On4K?utm_source=generator&theme=0" width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>

    <div class="mt-3">
        <label for="spotifyUrl" class="form-label">Masukkan URL Lagu/Playlist:</label>
        <input type="text" id="spotifyUrl" class="form-control" placeholder="Paste URL Playlist Spotify di sini">
        <button id="updatePlayer" class="btn btn-primary mt-2">Putar</button>
        <button id="savePlaylist" class="btn btn-success mt-2">Simpan Playlist</button>
    </div>
</div>

            </div>
        </div>

        <!-- To-Do List -->
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Daftar Tugas</h2>
                <form id="todoForm" class="d-flex mb-3">
                    <input type="text" id="todoInput" class="form-control me-2" placeholder="Tambahkan tugas baru" required>
                    <button type="submit" class="btn btn-success">Tambah</button>
                </form>
                <ul class="list-group" id="todoItems"></ul>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="https://sdk.scdn.co/spotify-player.js"></script>

</body>
</html>
