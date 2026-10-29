<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký - BookWorld</title>

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

        .register-container {
            width: 100%;
            max-width: 896px;
            min-height: 550px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: white;
            border: 1px solid #dce5f2;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 22px 40px rgba(15, 23, 42, 0.15);
        }

        /* Logo BookWorld */
        .register-form {
            padding: 40px 48px;
            display: flex;
            flex-direction: column;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 30px;
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
            margin-bottom: 25px;
        }

        /* Cac o nhap */
        .form-group {
            margin-bottom: 17px;
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

        .form-group input::placeholder {
            color: #9aa7bb;
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

        /* Nut dang ky */
        .register-button {
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

        .register-button:hover {
            background: #1d50cf;
            transform: translateY(-1px);
        }

        .login-link {
            text-align: center;
            margin-top: 23px;
            font-size: 13px;
            color: #8190a7;
        }

        .login-link a {
            color: #2864ed;
            text-decoration: none;
            font-weight: bold;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .home-link {
            text-align: center;
            margin-top: 11px;
            font-size: 13px;
        }

        .home-link a {
            color: #8190a7;
            text-decoration: none;
        }

        .home-link a:hover {
            color: #2864ed;
        }

        /* Banner ben phai */
        .register-banner {
            background: linear-gradient(145deg, #eaf1ff, #dfe5ff);
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
            text-align: center;
            margin-bottom: 22px;
        }

        .quote {
            max-width: 300px;
            text-align: center;
            font-size: 14px;
            font-style: italic;
            line-height: 1.6;
        }

        /* Giao dien dien thoai */
        @media (max-width: 700px) {
            body {
                padding: 16px;
            }

            .register-container {
                max-width: 440px;
                grid-template-columns: 1fr;
            }

            .register-form {
                padding: 30px 24px;
            }

            .register-banner {
                min-height: 240px;
                padding: 28px 20px;
            }

            .book-card {
                height: 130px;
                margin-bottom: 18px;
            }
        }

        @media (max-width: 360px) {
            .register-form {
                padding: 24px 18px;
            }
        }
    </style>
</head>

<body>

    <div class="register-container">

        <!-- Ben trai: Form dang ky -->
        <div class="register-form">

            <div class="logo">
                <div class="logo-icon">
                    <i class="bi bi-book-half"></i>
                </div>

                <div class="logo-name">
                    Book<span>World</span>
                </div>
            </div>

            <h1>Đăng ký tài khoản</h1>

            <p class="subtitle">
                Tạo tài khoản để bắt đầu hành trình đọc sách
            </p>

            <form action="?controller=auth&action=store" method="POST">

                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Nhập email"
                        autocomplete="email"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="username">Tên đăng nhập</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Nhập tên đăng nhập"
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
                            autocomplete="new-password"
                            minlength="6"
                            required
                        >

                        <button
                            type="button"
                            class="toggle-password"
                            data-target="password"
                            aria-label="Hiện mật khẩu"
                        >
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirm_password">
                        Nhập lại mật khẩu
                    </label>

                    <div class="input-wrapper">
                        <input
                            type="password"
                            id="confirm_password"
                            name="confirm_password"
                            class="password-input"
                            placeholder="Nhập lại mật khẩu"
                            autocomplete="new-password"
                            minlength="6"
                            required
                        >

                        <button
                            type="button"
                            class="toggle-password"
                            data-target="confirm_password"
                            aria-label="Hiện mật khẩu xác nhận"
                        >
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="register-button">
                    Đăng ký
                </button>

            </form>

            <p class="login-link">
                Đã có tài khoản?
                <a href="?controller=auth&action=login">
                    Đăng nhập ngay
                </a>
            </p>

            <p class="home-link">
                <a href="?controller=home">
                    <i class="bi bi-arrow-left"></i>
                    Quay về trang chủ
                </a>
            </p>

        </div>

        <!-- Ben phai: Gioi thieu -->
        <div class="register-banner">

            <div class="book-card">
                Explore Knowledge
            </div>

            <p class="quote">
                "Mỗi cuốn sách là một cánh cửa đến thế giới mới."
            </p>

        </div>

    </div>

    <script>
        // Hien hoac an tung o mat khau
        const toggleButtons = document.querySelectorAll('.toggle-password');

        toggleButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                const targetId = button.getAttribute('data-target');
                const passwordInput = document.getElementById(targetId);

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    button.innerHTML = '<i class="bi bi-eye-slash"></i>';
                    button.setAttribute('aria-label', 'Ẩn mật khẩu');
                } else {
                    passwordInput.type = 'password';
                    button.innerHTML = '<i class="bi bi-eye"></i>';
                    button.setAttribute('aria-label', 'Hiện mật khẩu');
                }
            });
        });

        // Kiem tra mat khau nhap lai
        const registerForm = document.querySelector('form');
        const passwordInput = document.getElementById('password');
        const confirmPassword = document.getElementById('confirm_password');

        registerForm.addEventListener('submit', function (event) {
            if (passwordInput.value !== confirmPassword.value) {
                event.preventDefault();
                alert('Mật khẩu nhập lại không khớp!');
                confirmPassword.focus();
            }
        });
    </script>

</body>
</html>

