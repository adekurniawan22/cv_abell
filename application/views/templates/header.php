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
    <link href="<?= base_url() ?>assets/argon-master/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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

        .navbar-nav .nav-link:hover {
            color: #007bff;
            animation: bounce 0.5s ease forwards;
        }

        @keyframes bounce {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-5px);
            }

            100% {
                transform: translateY(0);
            }
        }

        .navbar-nav .nav-link.active {
            color: #007bff;
            font-weight: 600;
        }
    </style>
</head>

<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    <main class="main-content position-relative border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-expand-lg blur border-radius-lg top-0 z-index-3 mt-4 py-2 start-0 end-0 mx-4">
            <div class="container-fluid">
                <div class="navbar-brand font-weight-bolder ms-lg-0 ms-2 d-flex align-items-end" href="#">
                    <img src="<?= base_url('assets/img/LogoAbell.png') ?>" alt="CV. Abell Logo" class="me-1" style="height: 25px;">
                    <span>CV. Abell</span>
                </div>

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
                                <a class="nav-link d-flex align-items-center me-2 <?php echo (current_url() == base_url() . 'manajer/dashboard') ? 'active' : ''; ?>" aria-current="page" href="<?= base_url() ?>manajer/dashboard">
                                    <i class="fa fa-chart-pie opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Dashboard
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 <?php echo (strpos(current_url(), 'pegawai') !== false) ? 'active' : ''; ?>" aria-current="page" href="<?= base_url() ?>manajer/data-pegawai">
                                    <i class="bi bi-people-fill opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Data Pegawai
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 <?php echo (strpos(current_url(), 'pelanggan') !== false) ? 'active' : ''; ?>" aria-current="page" href="<?= base_url() ?>manajer/data-pelanggan">
                                    <i class="bi bi-people-fill opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Data Pelanggan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 <?php echo (strpos(current_url(), 'server') !== false) ? 'active' : ''; ?>" aria-current="page" href="<?= base_url() ?>manajer/data-lokasi-server">
                                    <i class="bi bi-router-fill opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Data Server
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 <?php echo (strpos(current_url(), 'pernyataan') !== false) ? 'active' : ''; ?>" aria-current="page" href="<?= base_url() ?>manajer/data-pernyataan">
                                    <i class="bi bi-list-columns opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Pernyataan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 <?php echo (strpos(current_url(), 'kuesioner') !== false) ? 'active' : ''; ?>" aria-current="page" href="<?= base_url() ?>manajer/data-kuesioner">
                                    <i class="bi bi-file-text-fill opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Kuesioner
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 <?php echo (strpos(current_url(), 'evaluasi') !== false) ? 'active' : ''; ?>" aria-current="page" href="<?= base_url() ?>manajer/data-evaluasi">
                                    <i class="bi bi-bar-chart-line-fill opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Evaluasi Kuesioner
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($this->session->userdata('jabatan') == 'Admin') { ?>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 <?php echo (strpos(current_url(), 'dashboard') !== false) ? 'active' : ''; ?>" aria-current="page" href="<?= base_url() ?>admin/dashboard">
                                    <i class="fa fa-chart-pie opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 <?php echo (strpos(current_url(), 'pegawai') !== false) ? 'active' : ''; ?>" aria-current="page" href="<?= base_url() ?>admin/data-pegawai">
                                    <i class="bi bi-people-fill opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Data Pegawai
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 <?php echo (strpos(current_url(), 'pelanggan') !== false) ? 'active' : ''; ?>" aria-current="page" href="<?= base_url() ?>admin/data-pelanggan">
                                    <i class="bi bi-people-fill opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Data Pelanggan
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($this->session->userdata('jabatan') == 'Pelanggan') { ?>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 <?= (strpos(current_url(), 'kuesioner') !== false || strpos(current_url(), 'pernyataan') !== false) ? 'active' : ''; ?>" aria-current="page" href="<?= base_url() ?>pelanggan/kuesioner">
                                    <i class="bi bi-file-text-fill opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Kuesioner
                                </a>
                            </li>
                        <?php } ?>

                        <?php if ($this->session->userdata('jabatan')) { ?>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 <?php echo (strpos(current_url(), 'profil') !== false) ? 'active' : ''; ?>" aria-current="page" href="<?= base_url() ?>profil">
                                    <i class="ni ni-circle-08 opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Profil
                                </a>
                            </li>
                        <?php } ?>

                    </ul>
                    <ul class="navbar-nav d-lg-block d-none">
                        <?php if ($this->session->userdata('jabatan')) { ?>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2" aria-current="page" href="" data-bs-toggle="modal" data-bs-target="#logout">
                                    <i class="bi bi-box-arrow-left opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Logout
                                </a>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2" aria-current="page" href="" data-bs-toggle="modal" data-bs-target="#login-pelanggan">
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