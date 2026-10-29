<?php
// File giao dien dang nhap
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - BookWorld</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f7fa;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
            color: #111827;
        }

        .login-container {
            width: 100%;
            max-width: 896px;
            min-height: 498px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: white;
            border: 1px solid #dce5f2;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 22px 40px rgba(15, 23, 42, 0.15);
        }

        /* Phan ben trai */
        .login-form {
            padding: 48px;
            display: flex;
            flex-direction: column;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 32px;
            font-size: 20px;
            font-weight: bold;
        }

        .logo-icon {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #2864ed;
            color: white;
            border-radius: 8px;
        }

        .logo-name {
            color: #111827;
        }

        .logo-name span {
            color: #2864ed;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 7px;
        }

        .subtitle {
            font-size: 13px;
            color: #8190a7;
            margin-bottom: 26px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 7px;
        }

        .input-wrapper {
            position: relative;
        }

        .form-group input {
            width: 100%;
            height: 43px;
            padding: 0 14px;
            border: 1px solid #dce3ee;
            border-radius: 12px;
            background: #f8fafc;
            outline: none;
            font-size: 13px;
            color: #172033;
            transition: 0.2s;
        }

        .form-group input:focus {
            border-color: #2864ed;
            background: white;
            box-shadow: 0 0 0 3px rgba(40, 100, 237, 0.1);
        }

        .password-input {
            padding-right: 43px !important;
        }

        .toggle-password {
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            color: #8b9ab1;
            cursor: pointer;
            font-size: 15px;
        }

        .login-button {
            width: 100%;
            height: 40px;
            border: none;
            border-radius: 12px;
            background: #2864ed;
            color: white;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 7px 14px rgba(40, 100, 237, 0.16);
            transition: 0.2s;
        }

        .login-button:hover {
            background: #1d50cf;
            transform: translateY(-1px);
        }

        .register-link {
            text-align: center;
            margin-top: 25px;
            font-size: 13px;
            color: #8190a7;
        }

        .register-link a {
            color: #2864ed;
            text-decoration: none;
            font-weight: bold;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .home-link {
            text-align: center;
            margin-top: 10px;
            font-size: 13px;
        }

        .home-link a {
            color: #8190a7;
            text-decoration: none;
        }

        .home-link a:hover {
            color: #2864ed;
        }

        /* Phan ben phai */
        .login-banner {
            background: linear-gradient(145deg, #eaf1ff, #dfe8ff);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .book-card {
            width: 256px;
            max-width: 100%;
            height: 192px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(214, 230, 255, 0.72);
            border: 1px solid white;
            border-radius: 17px;
            box-shadow: 0 4px 7px rgba(31, 41, 55, 0.1);
            color: #2059e9;
            font-size: 17px;
            font-weight: bold;
            margin-bottom: 25px;
        }

        .quote {
            text-align: center;
            font-size: 14px;
            font-style: italic;
            line-height: 1.6;
        }

        /* Hien thi tot tren dien thoai */
        @media (max-width: 700px) {
            body {
                padding: 16px;
            }

            .login-container {
                max-width: 440px;
                grid-template-columns: 1fr;
            }

            .login-form {
                padding: 30px 24px;
            }

            .logo {
                margin-bottom: 28px;
            }

            .login-banner {
                min-height: 240px;
                padding: 28px 20px;
            }

            .book-card {
                height: 130px;
                margin-bottom: 18px;
            }
        }

        @media (max-width: 360px) {
            .login-form {
                padding: 24px 18px;
            }
        }
    </style>
</head>

<body>

    <div class="login-container">

        <!-- Ben trai: Form dang nhap -->
        <div class="login-form">

            <div class="logo">
                <div class="logo-icon">
                    <i class="bi bi-book-half"></i>
                </div>

                <div class="logo-name">
                    Book<span>World</span>
                </div>
            </div>

            <h1>Đăng nhập</h1>
            <p class="subtitle">Vui lòng nhập thông tin để đăng nhập</p>

            <form action="?controller=auth&action=authenticate" method="POST">

                <div class="form-group">
                    <label for="loginName">Tên đăng nhập hoặc Email</label>
                    <input
                        type="text"
                        id="loginName"
                        name="loginName"
                        placeholder="Nhập tên đăng nhập hoặc email"
                        autocomplete="username"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="password">Mật khẩu</label>

                    <div class="input-wrapper">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="password-input"
                            placeholder="Nhập mật khẩu"
                            autocomplete="current-password"
                            required
                        >

                        <button
                            type="button"
                            class="toggle-password"
                            id="togglePassword"
                            aria-label="Hiện mật khẩu"
                        >
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="login-button">
                    Đăng nhập
                </button>

            </form>

            <p class="register-link">
                Chưa có tài khoản?
                <a href="?controller=auth&action=register">Đăng ký ngay</a>
            </p>

            <p class="home-link">
                <a href="?controller=home">
                    <i class="bi bi-arrow-left"></i>
                    Quay về trang chủ
                </a>
            </p>

        </div>

        <!-- Ben phai: Gioi thieu BookWorld -->
        <div class="login-banner">

            <div class="book-card">
                BookWorld Reading
            </div>

            <p class="quote">
                "Sách là người bạn đồng hành tuyệt vời nhất."
            </p>

        </div>

    </div>

    <script>
        // An hoac hien mat khau
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function () {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                togglePassword.innerHTML = '<i class="bi bi-eye-slash"></i>';
                togglePassword.setAttribute('aria-label', 'Ẩn mật khẩu');
            } else {
                passwordInput.type = 'password';
                togglePassword.innerHTML = '<i class="bi bi-eye"></i>';
                togglePassword.setAttribute('aria-label', 'Hiện mật khẩu');
            }
        });
    </script>

</body>
</html>
