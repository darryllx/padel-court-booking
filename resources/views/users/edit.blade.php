<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna</title>
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
    
    <h1>Edit Pengguna</h1>
    
    <p><a href="{{ route('users.index') }}">&larr; Kembali ke Daftar Pengguna</a></p>
    
    <hr>
    
    <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <!-- Foto Profile Saat Ini -->
        <div>
            <label>Foto Profile Saat Ini:</label><br>
            @if($user->photo)
                <img src="{{ asset('storage/' . $user->photo) }}" alt="Foto Profile" width="150" height="150"><br>
            @else
                <p>Belum ada foto profile</p>
            @endif
        </div>
        
        <br>
        
        <div>
            <label for="photo">Upload Foto Baru (Opsional):</label><br>
            <input type="file" id="photo" name="photo" accept="image/*">
            @error('photo')
                <p><strong>{{ $message }}</strong></p>
            @enderror
            <p><small>Format: JPEG, PNG, JPG, GIF. Maksimal 2MB</small></p>
        </div>
        
        <br>
        
        <div>
            <label for="name">Nama Lengkap:</label><br>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            @error('name')
                <p><strong>{{ $message }}</strong></p>
            @enderror
        </div>
        
        <br>

        <div>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            @error('email')
                <p><strong>{{ $message }}</strong></p>
            @enderror
        </div>
        
        <br>
        
        <div>
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" required>
            @error('username')
                <p><strong>{{ $message }}</strong></p>
            @enderror
        </div>
        
        <br>
        
        <div>
            <label for="role_id">Role:</label><br>
            <select id="role_id" name="role_id" required>
                <option value="">-- Pilih Role --</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                        {{ ucfirst($role->name) }}
                    </option>
                @endforeach
            </select>
            @error('role_id')
                <p><strong>{{ $message }}</strong></p>
            @enderror
        </div>
        
        <br>
        
        <div>
            <label for="password">Password Baru (Kosongkan jika tidak ingin mengubah):</label><br>
            <input type="password" id="password" name="password">
            @error('password')
                <p><strong>{{ $message }}</strong></p>
            @enderror
            <p><small>Minimal 8 karakter, harus ada huruf besar dan huruf kecil</small></p>
        </div>
        
        <br>
        
        <div>
            <label for="password_confirmation">Konfirmasi Password Baru:</label><br>
            <input type="password" id="password_confirmation" name="password_confirmation">
        </div>
        
        <br>
        
        <div>
            <button type="submit">Simpan Perubahan</button>
            <a href="{{ route('users.index') }}"><button type="button">Batal</button></a>
        </div>
    </form>
</body>
</html>
