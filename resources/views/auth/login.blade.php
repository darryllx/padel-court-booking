<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Form Login</h1>
    
    @if(session('success'))
        <p><strong>{{ session('success') }}</strong></p>
    @endif
    
    @error('login')
        <p><strong>{{ $message }}</strong></p>
    @enderror
    
    <form method="POST" action="{{ route('login') }}">
        @csrf
        
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
            <button type="submit">Masuk</button>
        </div>
    </form>
    
    <br>
    
    <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
</body>
</html>
