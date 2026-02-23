<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

    <h2>Login</h2>

    @if(session('success'))
        <div style="color:green;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div>
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}">
            @error('email')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label>Password</label>
            <input type="password" name="password">
            @error('password')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Login</button>
        <p>
            Don’t have an account?
            <a href="{{ route('registerForm') }}">Register here</a>
        </p>
    </form>

</body>
</html>