<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="\css\login.css">
</head>
<body>
    <div class="container">
       
        <!-- Bagian Kiri -->
        <div class="left-section">
            <h1>PROJECT<span style="color: white">HUB</span></h1>
            <div class="avatar-icon">
                <img src="\src\icons8-user-96.png" alt="">
            </div>
            <p>" Simplify project management with a seamless tool that lets you organize tasks and upload files in one place. "</p>
        </div>

        <!-- Bagian Kanan -->
        <div class="right-section">
            <h2>SIGN IN</h2>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="login-btn">Login</button>
            </form>

            @if ($errors->any())
                <div class="error-messages">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="signup-link">
                Don't have an account? <a href="{{ route('register.create') }}">Sign up</a>
            </div>
        </div>
    </div>
</body>
</html>
