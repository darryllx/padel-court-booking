<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <!-- NAVBAR -->
    <nav>
        <a href="{{ route('dashboard') }}">Beranda</a> |
        <a href="{{ route('profile.edit') }}">Profil</a> |
        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
            @csrf
            <button type="submit">Keluar</button>
        </form>
    </nav>
    
    <hr>
    
    <h1>Selamat Datang di Dashboard</h1>
    
    @if(session('success'))
        <p><strong>{{ session('success') }}</strong></p>
    @endif
    
    <!-- Tampilkan foto profile jika ada -->
    @if(Auth::user()->photo)
        <div>
            <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Foto Profile" width="100" height="100">
        </div>
        <br>
    @endif
    
    <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
    <p><strong>Username:</strong> {{ Auth::user()->username }}</p>
    <p><strong>Role:</strong> {{ ucfirst(Auth::user()->role->name) }}</p>
    
    <hr>
    
    @if(Auth::user()->role->name === 'admin')
        <h1>HALAMAN KHUSUS ADMIN</h1>
        
        <h2>Menu Kelola</h2>
        <ul>
            <li><a href="{{ route('users.index') }}">Kelola Data Pengguna</a></li>
            <li>Kelola Lapangan Padel</li>
            <li>Kelola Pemesanan</li>
            <li>Kelola Jadwal Lapangan</li>
            <li>Kelola Pembayaran</li>
            <li>Laporan dan Statistik</li>
        </ul>
    @elseif(Auth::user()->role->name === 'member')
        <h1>HALAMAN KHUSUS MEMBER</h1>
        
        <h2>Pemesanan Lapangan Anda</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Lapangan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>23 Des 2025</td>
                    <td>08:00 - 09:30</td>
                    <td>Lapangan A</td>
                    <td>Terkonfirmasi</td>
                </tr>
                <tr>
                    <td>25 Des 2025</td>
                    <td>10:00 - 11:30</td>
                    <td>Lapangan B</td>
                    <td>Terkonfirmasi</td>
                </tr>
                <tr>
                    <td>27 Des 2025</td>
                    <td>16:00 - 17:30</td>
                    <td>Lapangan A</td>
                    <td>Menunggu</td>
                </tr>
            </tbody>
        </table>
    @endif
</body>
</html>
