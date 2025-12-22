<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengguna</title>
</head>
<body>
    <!-- NAVBAR -->
    <nav>
        <a href="{{ route('dashboard') }}">Beranda</a> |
        <a href="{{ route('users.index') }}">Kelola Pengguna</a> |
        <a href="{{ route('profile.edit') }}">Profil</a> |
        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
            @csrf
            <button type="submit">Keluar</button>
        </form>
    </nav>
    
    <hr>
    
    <h1>Kelola Pengguna</h1>
    
    @if(session('success'))
        <p><strong style="color: green;">{{ session('success') }}</strong></p>
    @endif
    
    <!-- SEARCH & ACTIONS -->
    <div>
        <form method="GET" action="{{ route('users.index') }}" style="display: inline;">
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari nama atau username...">
            <button type="submit">Cari</button>
            @if($search)
                <a href="{{ route('users.index') }}"><button type="button">Reset</button></a>
            @endif
        </form>
        
        <a href="{{ route('users.create') }}"><button type="button">Tambah User Baru</button></a>
        
        <form method="GET" action="{{ route('users.export-pdf') }}" style="display: inline;">
            @if($search)
                <input type="hidden" name="search" value="{{ $search }}">
            @endif
            <button type="submit">Export PDF</button>
        </form>
    </div>
    
    <br>
    
    <!-- TABLE USER -->
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Username</th>
                <th>Role</th>
                <th>Terdaftar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $index => $user)
                <tr>
                    <td>{{ $users->firstItem() + $index }}</td>
                    <td>
                        @if($user->photo)
                            <img src="{{ asset('storage/' . $user->photo) }}" alt="Foto" width="50" height="50">
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ ucfirst($user->role->name) }}</td>
                    <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}"><button type="button">Edit</button></a>
                        
                        <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">Tidak ada data user</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <br>
    
    <!-- PAGINATION -->
    @if($users->hasPages())
        <div>
            @if ($users->onFirstPage())
                <span>Previous</span>
            @else
                <a href="{{ $users->previousPageUrl() }}">Previous</a>
            @endif
            
            |
            
            Halaman {{ $users->currentPage() }} dari {{ $users->lastPage() }}
            
            |
            
            @if ($users->hasMorePages())
                <a href="{{ $users->nextPageUrl() }}">Next</a>
            @else
                <span>Next</span>
            @endif
        </div>
    @endif
</body>
</html>
