
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal | Login</title>

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

            <span class="tag">STUDENT LEARNING PORTAL</span>

            <h1>Your Learning Journey Starts Here.</h1>

            <p>
                Access your courses, learning materials,
                assignments, and academic activities
                in one convenient place.
            </p>

            <div class="features">
                <div>✓ Access your enrolled courses</div>
                <div>✓ Explore learning materials</div>
                <div>✓ Submit assignments online</div>
                <div>✓ Track your academic activities</div>
            </div>

        </div>

        <p class="copyright">
            © 2026 Student Portal. All rights reserved.
        </p>

    </div>

    <div class="login-right">

        <div class="login-box">

            <div class="mobile-logo">SP</div>

            <span class="small-title">WELCOME BACK</span>

            <h2>Student Login</h2>

            <p class="subtitle">
                Enter your credentials to access your account.
            </p>

            @if ($errors->any())
                <div class="error-message">
                    {{ $errors->first() }}
                </div>
            @endif

            @if (session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ url('/login') }}" method="POST">
                @csrf

                <div class="form-group">

                    <label for="email">Email Address</label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Enter your email"
                        value="{{ old('email') }}"
                        required
                    >

                </div>

                <div class="form-group">

                    <label for="password">Password</label>

                    <div class="password-wrapper">

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            required
                        >

                        <button
                            type="button"
                            id="togglePassword"
                            class="toggle-password"
                        >
                            Show
                        </button>

                    </div>

                </div>

                <button type="submit" class="login-button">
                    Sign In
                </button>

            </form>

            <div class="register-link">
                <p>
                    Don't have an account?
                    <a href="{{ route('register') }}">
                        Create Account
                    </a>
                </p>
            </div>

            <div class="login-footer">
                <p>Student Learning Management System</p>
            </div>

        </div>

    </div>

</div>

<script src="{{ asset('js/script.js') }}"></script>

</body>
</html>
