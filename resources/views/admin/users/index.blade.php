<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Pengguna - NEXA SUBMIT</title>

    <style>
        body {
            margin: 0;
            padding: 40px;
            font-family: Arial, sans-serif;
            background: #f4f7fb;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 18px;
            box-shadow: 0 8px 30px rgba(0,0,0,.08);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        th, td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #f1f5f9;
        }

        .pending {
            color: #b45309;
            font-weight: bold;
        }

        .verified {
            color: #16a34a;
            font-weight: bold;
        }

        .rejected {
            color: #dc2626;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Verifikasi Pengguna</h1>

    <p>Kelola pengguna NEXA SUBMIT.</p>

    <table>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Verifikasi</th>
           <th>Akun</th>
<th>Aksi</th>
        </tr>

        @foreach ($users as $user)

        <tr>
            <td>{{ $user->name }}</td>

            <td>{{ $user->email }}</td>

            <td>{{ ucfirst($user->role) }}</td>

            <td>
                @if ($user->verification_status === 'pending')
                    <span class="pending">Menunggu</span>

                @elseif ($user->verification_status === 'verified')
                    <span class="verified">Terverifikasi</span>

                @else
                    <span class="rejected">Ditolak</span>
                @endif
            </td>

           <td>{{ $user->is_active ? 'Aktif' : 'Tidak Aktif' }}</td>

<td>

    @if ($user->verification_status === 'pending')

        {{-- VERIFIKASI --}}
        <form method="POST"
              action="{{ route('admin.users.verify', $user) }}"
              style="display:inline-block;">
            @csrf

            <button type="submit"
                    style="background:#16a34a;color:white;border:0;padding:8px 12px;border-radius:8px;cursor:pointer;">
                Verifikasi
            </button>
        </form>

        {{-- TOLAK --}}
        <form method="POST"
              action="{{ route('admin.users.reject', $user) }}"
              style="display:inline-block;margin-left:5px;">
            @csrf

            <button type="submit"
                    style="background:#dc2626;color:white;border:0;padding:8px 12px;border-radius:8px;cursor:pointer;">
                Tolak
            </button>
        </form>


    @elseif ($user->verification_status === 'rejected')

        {{-- VERIFIKASI LAGI --}}
        <form method="POST"
              action="{{ route('admin.users.verify', $user) }}"
              style="display:inline-block;">
            @csrf

            <button type="submit"
                    style="background:#16a34a;color:white;border:0;padding:8px 12px;border-radius:8px;cursor:pointer;">
                Verifikasi Lagi
            </button>
        </form>

        {{-- TOLAK LAGI --}}
        <form method="POST"
              action="{{ route('admin.users.reject', $user) }}"
              style="display:inline-block;margin-left:5px;">
            @csrf

            <button type="submit"
                    style="background:#dc2626;color:white;border:0;padding:8px 12px;border-radius:8px;cursor:pointer;">
                Tolak
            </button>
        </form>


    @elseif ($user->verification_status === 'verified')

        <span style="color:#16a34a;font-weight:bold;">
            Sudah Diverifikasi
        </span>

    @endif

</td>
        </tr>

        @endforeach

    </table>

</div>

</body>
</html>