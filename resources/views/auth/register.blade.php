<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
</head>
<body>
    <h1>Form Registrasi</h1>
    
    @if(session('success'))
        <p><strong>{{ session('success') }}</strong></p>
    @endif
    
    <form method="POST" action="{{ route('register') }}">
        @csrf
        
        <div>
            <label for="name">Nama Lengkap:</label><br>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <p><strong>{{ $message }}</strong></p>
            @enderror
        </div>
        
        <br>

        <div>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <p><strong>{{ $message }}</strong></p>
            @enderror
        </div>
        
        <br>
        
        <div>
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" value="{{ old('username') }}" required>
            @error('username')
                <p><strong>{{ $message }}</strong></p>
            @enderror
        </div>
        
        <br>
        
        <div>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required>
            @error('password')
                <p><strong>{{ $message }}</strong></p>
            @enderror
        </div>
        
        <br>
        
        <div>
            <label for="password_confirmation">Konfirmasi Password:</label><br>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>
        
        <br>
        
        <div>
            <button type="submit">Daftar</button>
        </div>
        
        <p><em>Catatan: Semua pendaftar otomatis terdaftar sebagai Pengguna.</em></p>
    </form>
    
    <br>
    
    <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
</body>
</html>
