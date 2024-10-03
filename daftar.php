<?php

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/service/auth.php';

// ketika daftar
if (isset($_POST['daftar'])) {
    if (daftar($_POST, 'admin', '/daftar.php')) {
        echo "
        <script>
            alert('User berhasil registrasi')
            document.location.href = '" . BASE_URL . "/daftar.php'
        </script>";
        exit;
    } else {
        echo "
        <script>
            alert('User gagal registrasi')
            document.location.href = '" . BASE_URL . "/daftar.php'
        </script>";
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Pages / Login - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="img/logo/logo-sekolah.jpg" rel="icon">

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">
                            <a href="index.php" class="logo d-flex align-items-center w-auto">
                                <img src="assets/img/logo.png" alt="">
                                <span class="d-none d-lg-block">SMAS PAPUA 1 KOTA SORONG</span>
                            </a>
                        </div><!-- End Logo -->

                        <div class="card mb-3">

                            <div class="card-body p-5">
                                <div class="pb-3">
                                    <h5 class="card-title pb-0 fs-4">Daftar
                                    </h5>
                                </div>

                                <form action="" class="row g-3" method="post">

                                    <div class="col-12">
                                        <label for="yourname" class="form-label">name</label>
                                        <div class="input-group has-validation">
                                            <input type="text" name="name" class="form-control" id="yourname" required>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="youremail" class="form-label">email</label>
                                        <div class="input-group has-validation">
                                            <input type="email" name="email" class="form-control" id="youremail" required>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Username</label>
                                        <div class="input-group has-validation">
                                            <input type="text" name="username" class="form-control" id="yourUsername" required>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="yourPassword" required>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword2" class="form-label">Konfirmasi Password</label>
                                        <input type="password" name="konfirmasi_password" class="form-control" id="yourPassword2" required>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit" name="daftar">Daftar</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>

    </div>

</body>

</html>