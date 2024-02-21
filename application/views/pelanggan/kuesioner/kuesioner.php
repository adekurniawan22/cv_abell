<div class="container-fluid py-0 mt-7">
    <div class="row">
        <div class="col-12">
            <?php if (!empty($b)) : ?>
                <div class="card mb-4 px-3">
                    <div class="row mb-4">
                        <div class="col-lg-12 col-sm-12 d-flex align-items-center">
                            <div class="card-header pb-3 mt-3 bg-secondary text-white">
                                <span>"Kepada pelanggan yang terhormat, kami dari tim CV. ABELL sedang melakukan evaluasi terhadap layanan kami. Mohon isi kuesioner di bawah ini untuk membantu kami meningkatkan kualitas pelayanan. Terima kasih."</span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0" id="">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Judul Kuesioner</th>
                                        <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">Tanggal Mulai</th>
                                        <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">Tanggal Selesai</th>
                                        <th style="width: 25%;" class="text-center text-uppercase text-xxs font-weight-bolder opacity-7" data-sortable="false">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($kuesioner_pelanggan as $k) : ?>
                                        <?php
                                        $this->db->where('id_kuesioner', $k->id_kuesioner);
                                        $this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan'));
                                        $query = $this->db->get('t_sudah_isi_kuesioner')->row();
                                        ?>

                                        <?php if ($query) : ?>
                                            <tr class="d-none"></tr>
                                        <?php else : ?>
                                            <tr>
                                                <td>
                                                    <p class="ms-3 text-sm font-weight-bold mb-0"><?= $k->judul_kuesioner ?></p>
                                                </td>
                                                <td>
                                                    <p class="text-center text-sm font-weight-bold mb-0"><?= $k->mulai ?></p>
                                                </td>
                                                <td>
                                                    <p class="text-center text-sm font-weight-bold mb-0"><?= $k->selesai ?></p>
                                                </td>

                                                <td class="text-center">
                                                    <form action="<?= base_url() ?>pelanggan/isi-kuesioner" method="post" class="d-inline-block">
                                                        <input type="hidden" name="id_kuesioner" value="<?= $k->id_kuesioner ?>">
                                                        <button type="submit" class="btn btn-primary px-3 mb-0"><i class="bi bi-arrow-right-square-fill me-2" aria-hidden="true"></i>ISI KUESIONER</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endif ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <div class="card mb-4 px-3">
                    <div class="row mb-4">
                        <div class="col-lg-12 col-sm-12 d-inline-block align-items-center text-center">
                            <h4 class="pt-4">Saat ini belum ada data kuesioner</h4>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($a) : ?>
                <div class="card mb-4 px-3">
                    <div class="row mb-1">
                        <div class="col-lg-12 col-sm-12 d-flex align-items-center">
                            <div class="card-header pb-0 mt-0 mb-0 text-white">
                                <h3>Histori Kuesioner</h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0" id="">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Judul Kuesioner</th>
                                        <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">Tanggal Mulai</th>
                                        <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">Tanggal Selesai</th>
                                        <th style="width: 25%;" class="text-center text-uppercase text-xxs font-weight-bolder opacity-7" data-sortable="false">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($a as $k) : ?>
                                        <tr>
                                            <td>
                                                <p class="ms-3 text-sm font-weight-bold mb-0"><?= $k['judul_kuesioner'] ?></p>
                                            </td>
                                            <td>
                                                <p class="text-center text-sm font-weight-bold mb-0"><?= $k['mulai'] ?></p>
                                            </td>
                                            <td>
                                                <p class="text-center text-sm font-weight-bold mb-0"><?= $k['selesai'] ?></p>
                                            </td>

                                            <td class="text-center">
                                                <p class="text-center text-sm font-weight-bold mb-0">Anda sudah mengisi kuesioner ini</p>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>