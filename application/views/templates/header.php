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
    <link href="<?= base_url() ?>assets/argon-master/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="<?= base_url() ?>assets/argon-master/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="<?= base_url() ?>assets/argon-master/assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.8/datatables.min.css" rel="stylesheet">

    <style>
        .atur-height {
            height: 85% !important;
        }

        .btn-aside {
            color: #333;
            transition: all 0.3s ease;
        }

        .btn-aside:hover {
            color: #007bff;
            background-color: #f8f9fa;
            transform: translateY(-3px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .dataTable {
            padding: 10px;
        }

        .dataTables_info {
            margin-left: 20px;
            padding-bottom: 10px;
        }

        .dataTables_length {
            margin-left: 20px;
        }

        .dataTables_filter {
            margin-right: 20px;
        }

        .pagination {
            margin-right: 20px !important;
            padding-bottom: 10px !;
        }

        .page-item.active .page-link {
            color: white !important;
        }

        .page-item.previous.disabled,
        .page-item.next.disabled {
            cursor: no-drop;
        }

        .page-item.previous .page-link,
        .page-item.next .page-link,
        .page-link {
            background: white;
            color: #8898aa !important;
        }

        .page-item.active .page-link:hover,
        .page-item.previous .page-link:hover,
        .page-item.next .page-link:hover,
        .page-link:hover {
            background-color: #e9ecef;
            color: #8898aa !important;
            border-color: #e9ecef !important;
        }

        #sidenav-main {
            z-index: 1000 !important;
        }

        .modal {
            z-index: 1050
        }

        .table-kuesioner {
            border-collapse: collapse;
            width: 100%;
        }

        .table-kuesioner th,
        .table-kuesioner td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        #loading {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
        }
    </style>
</head>

<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    <main class="main-content position-relative border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-expand-lg blur border-radius-lg top-0 z-index-3 mt-4 py-2 start-0 end-0 mx-4">
            <div class="container-fluid">
                <a class="navbar-brand font-weight-bolder ms-lg-0 ms-2 " href="#">
                    CV. Abell
                </a>
                <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon mt-2">
                        <span class="navbar-toggler-bar bar1"></span>
                        <span class="navbar-toggler-bar bar2"></span>
                        <span class="navbar-toggler-bar bar3"></span>
                    </span>
                </button>
                <div class="collapse navbar-collapse" id="navigation">
                    <ul class="navbar-nav mx-auto">
                        <?php if ($this->session->userdata('jabatan') == 'Manajer') { ?>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="<?= base_url() ?>manajer/dashboard">
                                    <i class="fa fa-chart-pie opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="<?= base_url() ?>manajer/data-pegawai">
                                    <i class="bi bi-people-fill opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Data Pegawai
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="<?= base_url() ?>manajer/data-pelanggan">
                                    <i class="bi bi-people-fill opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Data Pelanggan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="<?= base_url() ?>manajer/data-lokasi-server">
                                    <i class="bi bi-router-fill opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Data Server
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="<?= base_url() ?>manajer/data-evaluasi">
                                    <i class="bi bi-bar-chart-line-fill opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Evaluasi Kuesioner
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="<?= base_url() ?>manajer/data-kuesioner">
                                    <i class="bi bi-file-text-fill opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Kuesioner
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($this->session->userdata('jabatan') == 'Admin') { ?>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="<?= base_url() ?>admin/dashboard">
                                    <i class="fa fa-chart-pie opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="<?= base_url() ?>admin/data-pegawai">
                                    <i class="bi bi-people-fill opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Data Pegawai
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="<?= base_url() ?>admin/data-pelanggan">
                                    <i class="bi bi-people-fill opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Data Pelanggan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="<?= base_url() ?>admin/data-evaluasi">
                                    <i class="bi bi-bar-chart-line-fill opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Evaluasi Kuesioner
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="<?= base_url() ?>admin/data-kuesioner">
                                    <i class="bi bi-file-text-fill opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Kuesioner
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($this->session->userdata('jabatan') == 'Pelanggan') { ?>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="<?= base_url() ?>">
                                    <i class="bi bi-house-door-fill opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Home
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="https://wa.me/6285155245688" target="_blank">
                                    <i class="bi bi-whatsapp opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Hubungi Kami
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="<?= base_url() ?>pelanggan/kuesioner">
                                    <i class="bi bi-file-text-fill opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Kuesioner
                                </a>
                            </li>
                        <?php } ?>

                        <?php if ($this->session->userdata('jabatan')) { ?>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="<?= base_url() ?>profil">
                                    <i class="ni ni-circle-08 opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Profil
                                </a>
                            </li>
                        <?php } ?>

                        <?php if (empty($this->session->userdata('jabatan'))) { ?>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="<?= base_url() ?>">
                                    <i class="bi bi-house-door-fill opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Home
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="https://wa.me/6285155245688" target="_blank">
                                    <i class="bi bi-whatsapp opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Hubungi Kami
                                </a>
                            </li>
                        <?php } ?>

                    </ul>
                    <ul class="navbar-nav d-lg-block d-none">
                        <?php if ($this->session->userdata('jabatan')) { ?>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="" data-bs-toggle="modal" data-bs-target="#logout">
                                    <i class="bi bi-box-arrow-left opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Logout
                                </a>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="" data-bs-toggle="modal" data-bs-target="#login-pelanggan">
                                    <i class="fas fa-key opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Login
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->