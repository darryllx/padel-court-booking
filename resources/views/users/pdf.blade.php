<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Pengguna</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        .info {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>LAPORAN DATA PENGGUNA</h1>
    
    <div class="info">
        <p><strong>Tanggal Cetak:</strong> {{ date('d/m/Y H:i:s') }}</p>
        <p><strong>Total Pengguna:</strong> {{ $users->count() }}</p>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Role</th>
                <th>Terdaftar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ ucfirst($user->role->name) }}</td>
                    <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div style="margin-top: 30px;">
        <p><strong>Catatan:</strong></p>
        <ul>
            <li>Laporan ini digenerate secara otomatis oleh Sistem Pemesanan Lapangan Padel</li>
            <li>Data yang ditampilkan adalah data pengguna yang aktif</li>
        </ul>
    </div>
</body>
</html>
