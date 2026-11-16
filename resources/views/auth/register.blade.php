<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="login-container">

    <div class="login-left">
        <div class="brand">
            <div class="brand-icon">SP</div>
            <h2>Student Portal</h2>
        </div>

        <div class="welcome-content">
            <span class="tag">JOIN OUR LEARNING COMMUNITY</span>
            <h1>Create Your Student Account.</h1>
            <p>Register to access your courses, lessons and assignments.</p>
        </div>

        <p class="copyright">© 2026 Student Portal</p>
    </div>

    <div class="login-right">
        <div class="login-box">

            <span class="small-title">GET STARTED</span>
            <h2>Create Account</h2>
            <p class="subtitle">Fill in your information to register.</p>

            <form action="{{ route('register.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name"
                        placeholder="Enter your full name"
                        value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email"
                        placeholder="Enter your email"
                        value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password"
                        placeholder="Create password" required>
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password"
                        name="password_confirmation"
                        placeholder="Confirm password" required>
                </div>

                <button type="submit" class="login-button">
                    Create Account
                </button>
            </form>

            <div class="register-link">
                <p>Already have an account?
                    <a href="{{ route('login') }}">Login</a>
                </p>
            </div>

        </div>
    </div>
</div>

</body>
</html>
