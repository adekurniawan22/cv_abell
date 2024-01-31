</main>
<main class="main-content mt-7">
    <div class="page-header align-items-center min-vh-85 pt-5 pb-5 mx-3 border-radius-lg" style="background-image: url('<?= base_url() ?>assets/img/banner.jpg'); background-position: top;">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 text-center mx-auto">
                    <h1 class="text-white mb-2 mt-5">Selamat Datang!</h1>
                    <p class="text-lead text-white">"Nikmati Layanan Internet Dengan Koneksi Anti Lag"</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-gradient-white align-items-start pt-5 pb-5 mx-3" id="informasi-perusahaan">
        <div class="container ">
            <h1 class="text-dark mb-2 mt-3">Informasi Perusahaan</h1>
            <div class="row pt-3">
                <div class="col-12">
                    CV.Abell berdiri sejak 2017 dengan tujuan untuk mengoptimalkan potensi internet di lokasi yang belum tercakup internet rumahan atau wifi. Bapak Anjar Abel Mulyadi selaku direktur Perusahaan yang memiliki latar belakang pendidikan dan pengalaman dalam bidang teknologi informasi, melihat peluang signifikan untuk mendirikan suatu entitas usaha yang dapat memfasilitasi perusahaan-perusahaan skala menengah atau kecil maupun rumahan dalam hal internet jaringan. <p></p>
                    Dalam kurun waktu kurang dari 2 tahun, Perusahaan mengalami pelonjakan pengguna yang merupakan salah satu dampak dari pandemic Covid 19. Dari awalnya CV. Abell hanya terdapat satu titik lokasi PPPoE, hingga mencapai 6 titik PPPoE di 2019. Saat ini CV. Abell telah mencakup lebih dari 20 daerah dan 8 kecamatan di kabupaten karawang jawa barat. Kini CV. Abell telah tumbuh menjadi salah satu pelaku utama di industri pemasaran internet terbesar di kecamatan jatisari kabupaten karawang. Dengan komitmen yang kuat terhadap kualitas, inovasi, dan kepuasan pelanggan, CV. Abell terus berkontribusi pada kemajuan dan perkembangan pemasaran internet di Indonesia.

                </div>
            </div>
        </div>
    </div>

    <div class="bg-gradient-white align-items-start pt-3 pb-5 mx-3 border-radius-lg" id="informasi-layanan">
        <div class="container ">
            <h1 class="text-dark text-end mb-2 mt-3">Informasi Layanan</h1>
            <div class="card-group pt-3">
                <div class="card bg-default me-3" style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('<?= base_url() ?>assets/img/layanan-1.jpg'); background-size: cover; background-position: center;">
                    <div class="card-body mt-2">
                        <span class="card-title h6 d-block text-white text-uppercase font-weight-bold my-2">Pemasangan Internet</span>
                        <p class="card-description mb-4 text-white">
                            Dapatkan layanan pemasangan internet dengan koneksi bebas lag untuk pengalaman online yang optimal. Kami menyediakan pemasangan yang cepat dan handal untuk memenuhi kebutuhan internet Anda.
                        </p>
                    </div>
                </div>
                <div class="card bg-default me-3" style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('<?= base_url() ?>assets/img/layanan-2.jpg'); background-size: cover; background-position: center;">
                    <div class="card-body mt-2">
                        <span class="card-title h6 d-block text-white text-uppercase font-weight-bold my-2">Pemasangan Wifi</span>
                        <p class="card-description mb-4 text-white">
                            Nikmati kenyamanan konektivitas dengan layanan pemasangan wifi. Kami menyediakan solusi wifi terbaik untuk memastikan seluruh area Anda tercakup dengan sinyal yang stabil dan kuat.
                        </p>
                    </div>
                </div>
                <div class="card bg-default" style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('<?= base_url() ?>assets/img/layanan-3.jpg'); background-size: cover; background-position: center;">
                    <div class="card-body mt-2">
                        <span class="card-title h6 d-block text-white text-uppercase font-weight-bold my-2">Koneksi Bebas Lag</span>
                        <p class="card-description mb-4 text-white">
                            Dengan koneksi bebas lag, Anda dapat menikmati pengalaman online tanpa hambatan. Pilih paket kami untuk mendapatkan kecepatan dan stabilitas terbaik dalam menggunakan internet.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
<footer>
    <div class="bg-gradient-dark align-items-start pt-2 pb-2 m-3 border-radius-lg" id="informasi-layanan">
        <div class="container ">
            <div class="row">
                <div class="col-12 p-3 text-center">
                    <p class="text-white">Hubungi Kami</p>
                    <div>
                        <a href="#" class="text-white me-3">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="#" class="text-white me-3">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="#" class="text-white me-3">
                            <i class="bi bi-twitter"></i>
                        </a>
                        <a href="#" class="text-white">
                            <i class="bi bi-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="modal fade" id="login-pelanggan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Login Pelanggan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url() ?>auth/proses_login_pelanggan" method="post">
                    <div class="form-group">
                        <label for="no_hp" class="form-control-label">Nomor Handphone</label>
                        <input class="form-control" type="text" placeholder="0899xxxxxxx" id="no_hp" name="no_hp">
                    </div>
            </div>
            <!-- <div class="modal-footer"> -->
            <button type="button" class="mx-3 btn bg-gradient-secondary" data-bs-dismiss="modal">Kembali</button>
            <button type="submit" class="mx-3 btn bg-gradient-primary">Login</button>
            </form>
            <!-- </div> -->
        </div>
    </div>
</div>