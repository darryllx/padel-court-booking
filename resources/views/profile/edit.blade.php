<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>
<body>
    <h1>Edit Profile</h1>
    
    <p><a href="{{ route('dashboard') }}">&larr; Kembali ke Dashboard</a></p>
    
    <hr>
    
    @if(session('success'))
        <p><strong style="color: green;">{{ session('success') }}</strong></p>
    @endif
    
    <!-- FORM EDIT PROFILE -->
    <h2>Informasi Profile</h2>
    
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <!-- Foto Profile -->
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
            <label for="username">Username:</label><br>
            <input type="text" id="username" value="{{ $user->username }}" disabled>
            <p><small>Username tidak dapat diubah</small></p>
        </div>
        
        <br>
        
        <div>
            <label>Role:</label><br>
            <input type="text" value="{{ ucfirst($user->role->name) }}" disabled>
            <p><small>Role tidak dapat diubah</small></p>
        </div>
        
        <br>
        
        <div>
            <button type="submit">Simpan Perubahan</button>
        </div>
    </form>
    
    <hr>
    
    <!-- FORM CHANGE PASSWORD -->
    <h2>Ubah Password</h2>
    
    <form method="POST" action="{{ route('profile.change-password') }}">
        @csrf
        @method('PUT')
        
        <div>
            <label for="current_password">Password Saat Ini:</label><br>
            <input type="password" id="current_password" name="current_password" required>
            @error('current_password')
                <p><strong>{{ $message }}</strong></p>
            @enderror
        </div>
        
        <br>
        
        <div>
            <label for="new_password">Password Baru:</label><br>
            <input type="password" id="new_password" name="new_password" required>
            @error('new_password')
                <p><strong>{{ $message }}</strong></p>
            @enderror
            <p><small>Minimal 8 karakter, harus ada huruf besar dan huruf kecil</small></p>
        </div>
        
        <br>
        
        <div>
            <label for="new_password_confirmation">Konfirmasi Password Baru:</label><br>
            <input type="password" id="new_password_confirmation" name="new_password_confirmation" required>
        </div>
        
        <br>
        
        <div>
            <button type="submit">Ubah Password</button>
        </div>
    </form>
    
    <hr>
    
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Keluar</button>
    </form>
</body>
</html>
