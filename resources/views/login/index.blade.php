<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Shiro Project | {{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!-- Favicon -->
    <link href="{{ asset('landpage/assets/img/favicons/logo2.png') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">

    <style>
        .bg-image-vertical {
            background-color: #f8f9fa;
        }

        .login-image {
            background-image: url('{{ asset('assets/images/koi-login2.jpg') }}');
            background-size: cover;
            background-position: center;
            height: 100%;
            width: 100%;
        }

        .logo {
            width: 50px;
            height: auto;
            border-radius: 30px;
        }

        .form-container {
            margin-top: 50px;
        }

        .btn-gradien {
            background: linear-gradient(45deg, #B8001F, #52000E);
            color: white;
            border: none;
        }

        .btn-gradien:hover {
            background: linear-gradient(45deg, #52000E, #B8001F);
        }
    </style>
</head>

<body>
    <section class="vh-100 bg-image-vertical">
        <div class="container-fluid h-100">
            <div class="row h-100">
                <!-- Bagian Gambar -->
                <div class="col-sm-6 d-none d-sm-block px-0">
                    <div class="login-image"></div>
                </div>

                <!-- Bagian Form Login -->
                <div class="col-sm-6 text-black d-flex justify-content-center align-items-center">
                    <div class="form-container">
                        <!-- Logo dan Judul -->
                        <div class="d-flex align-items-center mb-4">
                            <img src="{{ asset('assets/images/shiroo.png') }}" alt="Logo" class="logo">
                            <h1 class="ms-3">Shiro</h1>
                        </div>

                        <!-- Alerts -->
                        @if (session()->has('success'))
                            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                        @endif
                        @if (session()->has('loginError'))
                            <div class="alert alert-danger" role="alert">{{ session('loginError') }}</div>
                        @endif

                        <!-- Form Login -->
                        <form action="/login" method="post" style="width: 23rem;">
                            @csrf
                            <div class="form-outline mb-4">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" id="username"
                                    class="form-control form-control-lg @error('username') is-invalid @enderror"
                                    value="{{ old('username') }}" autofocus required>
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-outline mb-4">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" id="password"
                                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                                        required>
                                    <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                        <i class="fas fa-eye" id="eyeIcon"></i>
                                    </span>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-gradien btn-lg w-100 mb-4">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });
    </script>
</body>

</html>
