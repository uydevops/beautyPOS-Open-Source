<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Cosneff Laser Technology - Giriş Sayfası">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Cosneff Laser Technology - Giriş</title>

    <style>
        body {
            background: linear-gradient(120deg, #121212, #1e1e1e);
            color: #ffffff;
            font-family: Arial, sans-serif;
        }

        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .divider {
            display: flex;
            align-items: center;
            color: #eee;
            font-weight: normal;
        }

        .divider:after {
            margin-left: 10px;
        }

        .divider:before {
            margin-right: 10px;
        }

        .login-card {
            background-color: #2c2c2c;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            padding: 50px;
            border: 1px solid #007bff; /* Mavi sınır eklenmiştir */
        }

        .form-outline .form-control {
            border: none;
            border-bottom: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 0;
            box-shadow: none;
        }

        .form-outline .form-control:focus {
            box-shadow: none;
            border-bottom: 2px solid #007bff;
            background-color: #1e1e1e; /* Odaklanıldığında koyu arka plan */
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 10px;
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Üzerine gelindiğinde daha koyu mavi */
            border-color: #0056b3;
        }

        .alert-danger {
            background-color: #d9534f;
            border-color: #d9534f;
        }

        .alert-danger .fas {
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="{{ asset('images/logo.png') }}" class="img-fluid" alt="Cosneff Laser Technology Logo" style="max-height: 150px;">
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    <form action="{{ route('login.post') }}" method="POST" id="loginForm" class="login-card">
                        @csrf
                        <div class="form-outline mb-4">
                            <label class="form-label" for="username">E-Posta Adresi</label>
                            <input type="text" id="username" class="form-control form-control-lg" name="email" required aria-label="Kullanıcı Adı" />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="password">Şifre</label>
                            <input type="password" id="password" class="form-control form-control-lg" name="password" required aria-label="Şifre" />
                        </div>

                        @if(session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }} <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        @endif

                        <button type="submit" class="btn btn-primary btn-lg btn-block">Giriş Yap <i class="fas fa-sign-in-alt"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>

</html>
