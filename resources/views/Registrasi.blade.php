<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrasi</title>
    <link rel="stylesheet" href="\css\register.css">
</head>
<body>
    <div class="container">
       
        <!-- Bagian Kiri -->
        <div class="left-section">
            <h1>PROJECT<span style="color: white">HUB</span></h1>
            <div class="avatar-icon">
                <img src="\src\icons8-user-96.png" alt="">
            </div>
            <p>" Simplify project management with a seamless tool that lets you organize tasks and upload files in one place "</p>
        </div>

        <!-- Bagian Kanan -->
        <div class="right-section">
            <h2>SIGN UP</h2>
            <form action="{{ route('register.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
                </div>
                <button type="submit" class="register-btn">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
