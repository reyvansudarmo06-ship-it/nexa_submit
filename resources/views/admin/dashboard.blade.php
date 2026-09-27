<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - NEXA SUBMIT</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            color: #1f2937;
        }

        .navbar {
            background: #111827;
            color: white;
            padding: 18px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand {
            font-size: 20px;
            font-weight: bold;
        }

        .admin-badge {
            background: #2563eb;
            padding: 7px 14px;
            border-radius: 20px;
            font-size: 13px;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .welcome {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.06);
            margin-bottom: 25px;
        }

        .welcome h1 {
            margin-top: 0;
            margin-bottom: 10px;
        }

        .welcome p {
            color: #6b7280;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.06);
        }

        .card h3 {
            margin-top: 0;
        }

        .card p {
            color: #6b7280;
        }

        @media (max-width: 768px) {
            .cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <div class="navbar">
        <div class="brand">NEXA SUBMIT</div>

        <div class="admin-badge">
            ADMIN
        </div>
    </div>

    <div class="container">

        <div class="welcome">
            <h1>Admin Dashboard</h1>

            <p>
                Selamat datang,
                <strong>{{ auth()->user()->name }}</strong>.
            </p>

            <p>
                Kamu sedang masuk sebagai administrator NEXA SUBMIT.
            </p>
        </div>

        <div class="cards">

            <div class="card">
                <h3>👥 Manajemen Pengguna</h3>
                <p>
                    Kelola akun siswa dan guru serta status verifikasinya.
                </p>
            </div>

            <div class="card">
                <h3>🔐 Verifikasi Akun</h3>
                <p>
                    Periksa akun yang masih menunggu proses verifikasi.
                </p>
            </div>

            <div class="card">
                <h3>📊 Sistem</h3>
                <p>
                    Pantau aktivitas dan kondisi sistem NEXA SUBMIT.
                </p>
            </div>

        </div>

    </div>

</body>
</html>