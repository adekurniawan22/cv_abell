<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>assets/argon-master/assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>assets/img/LogoAbell.png" />
    <title>
        <?= $title ?>
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="<?= base_url() ?>assets/argon-master/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/argon-master//assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="<?= base_url() ?>assets/argon-master/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="<?= base_url() ?>assets/argon-master/assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="">
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-4 col-lg-5  col-md-7 mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <?= $this->session->flashdata('message') ?>
                                    <h4 class="font-weight-bolder">Reset Password</h4>
                                    <p class="mb-0">Masukkan password baru</p>
                                </div>
                                <div class="card-body">
                                    <?php if ($this->session->flashdata('form_errors')) { ?>
                                        <div class="alert bg-light">
                                            <?= $this->session->flashdata('form_errors'); ?>
                                        </div>
                                    <?php } ?>
                                    <form role="form" method="post" action="<?= base_url() ?>proses-reset-password">
                                        <input type="hidden" name="hash" value="<?= $hash ?>">
                                        <input type="hidden" name="reset_code" value="<?= $reset_code ?>">
                                        <input type="hidden" name="expiry_time" value="<?= $expiry_time ?>">
                                        <div class="mb-3">
                                            <input type="password" class="form-control form-control-lg" placeholder="Password Baru" name="password_baru" value="<?php echo set_value('password_baru'); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" class="form-control form-control-lg" placeholder="Konfirmasi Password Baru" name="konfirmasi_password_baru" value="<?php echo set_value('konfirmasi_password_baru'); ?>">
                                        </div>
                                        <a href="<?= base_url() ?>login-pegawai" class=" text-primary text-gradient font-weight-bold">Login?</a>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Reset Password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!--   Core JS Files   -->
    <script src="<?= base_url() ?>assets/argon-master/assets/js/core/popper.min.js"></script>
    <script src="<?= base_url() ?>assets/argon-master/assets/js/core/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/argon-master/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url() ?>assets/argon-master/assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="<?= base_url() ?>assets/argon-master/assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>