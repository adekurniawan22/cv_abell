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
    </style>
</head>

<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    <main class="main-content position-relative border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-expand-lg blur border-radius-lg top-0 z-index-3 mt-4 py-2 start-0 end-0 mx-4">
            <div class="container-fluid">
                <a class="navbar-brand font-weight-bolder ms-lg-0 ms-2 " href="#">
                    <!-- <img src="<?= base_url() ?>assets/img/logo.png" class="navbar-brand-img h-100 " style="width: 30px" alt="main_logo"> -->
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
                        <?php if ($this->session->userdata('id_role') == 2) { ?>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="<?= base_url() ?>manajer/dashboard">
                                    <i class="fa fa-chart-pie opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="<?= base_url() ?>manajer/data-pengguna">
                                    <i class="bi bi-people-fill opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Data Pengguna
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="#">
                                    <i class="bi bi-bar-chart-line-fill opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Evaluasi
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="#">
                                    <i class="bi bi-file-text-fill opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Kuesioner
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($this->session->userdata('id_role') == 3) { ?>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="<?= base_url() ?>pelanggan/dashboard">
                                    <i class="fa fa-chart-pie opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="#">
                                    <i class="bi bi-file-text-fill opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Kuesioner
                                </a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="<?= base_url() ?>profil">
                                <i class="ni ni-circle-08 opacity-6 text-dark me-1" aria-hidden="true"></i>
                                Profil
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav d-lg-block d-none">
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="" data-bs-toggle="modal" data-bs-target="#logout">
                                <i class="bi bi-box-arrow-left opacity-6 text-dark me-1" aria-hidden="true"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->