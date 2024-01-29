<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>assets/argon-master/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?= base_url() ?>assets/argon-master/assets/img/favicon.png">
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
                                    <img src="<?= base_url() ?>assets/img/logoabell.png" alt="..." class="img-thumbnail rounded mx-auto d-block mb-6" width="200px" height="200px">
                                    <h4 class="font-weight-bolder">Login</h4>
                                </div>
                                <div class="card-body">
                                    <?= $this->session->flashdata('message');
                                    unset($_SESSION['message']); ?>
                                    <form role="form" method="post" action="proses-login">
                                        <div class="mb-3">
                                            <input type="text" class="form-control form-control-lg" placeholder="Username / No HP" name="username_no_hp" value="<?php echo set_value('username_no_hp'); ?>">
                                            <?= form_error('username_no_hp', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" class="form-control form-control-lg" placeholder="Password" name="password" value="<?php echo set_value('password'); ?>">
                                            <?= form_error('password', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                                        </div>
                                        <a href="<?= base_url() ?>lupa-password" class=" text-primary text-gradient font-weight-bold">Lupa Password?</a>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php if ($this->session->flashdata('logout')) { ?>
            <!-- Tampilkan pesan 'flashdata' sebagai modal -->
            <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Pesan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <?= $this->session->flashdata('logout') ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-primary" data-bs-dismiss="modal">Oke</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if ($this->session->flashdata('expired')) { ?>
            <!-- Tampilkan pesan 'flashdata' sebagai modal -->
            <div class="modal fade" id="expired" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Pesan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <?= $this->session->flashdata('expired') ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-primary" data-bs-dismiss="modal">Oke</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </main>
    <!--   Core JS Files   -->
    <script src="<?= base_url() ?>assets/argon-master/assets/js/core/popper.min.js"></script>
    <script src="<?= base_url() ?>assets/argon-master/assets/js/core/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/argon-master/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url() ?>assets/argon-master/assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.8/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#logout').modal('show');
        });
        $(document).ready(function() {
            $('#expired').modal('show');
        });
    </script>
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