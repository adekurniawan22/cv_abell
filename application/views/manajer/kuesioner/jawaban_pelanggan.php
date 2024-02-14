<div class="container-fluid py-0 mt-7">
    <div class="row">
        <div class="col-12">
            <?php if (!empty($sudah_isi_kuesioner)) : ?>
                <div class="card mb-4 px-3">
                    <div class="row mb-2">
                        <div class="col-6 d-flex align-items-center">
                            <div class="card-header pb-0">
                                <h5>Hasil Jawaban Pelanggan</h5>
                            </div>
                        </div>
                    </div>
                    <style>
                        .table th,
                        .table td {
                            border: 1px solid black !important;
                            /* padding: 10px; */
                        }
                    </style>

                    <div class="card-body px-0 pt-0 pb-2">

                        <div class="row">
                            <?php foreach ($sudah_isi_kuesioner as $s) : ?>
                                <div class="col-6 mb-3">
                                    <div class="table-responsive mx-2 mb-4">
                                        <div class="card p-3" style="background-color: #f0f0f0;">
                                            <?php
                                            $pelanggan = $this->db->get_where('t_pelanggan', array('id_pelanggan' => $s->id_pelanggan))->row();
                                            ?>
                                            <h6>Nama : <?= $pelanggan->nama_lengkap ?></h6>
                                            <?php $lokasi_server = $this->db->get_where('t_lokasi_server', array('id_lokasi_server' => $pelanggan->lokasi_server))->row(); ?>
                                            <h6>Lokasi PPPoE : <?= $lokasi_server->lokasi_server ?></h6>
                                            <?php
                                            $mulai_berlangganan = new DateTime($pelanggan->mulai_berlangganan);
                                            $waktu_sekarang = new DateTime();
                                            $selisih = $mulai_berlangganan->diff($waktu_sekarang);

                                            ?>
                                            <h6>Lama Berlangganan :
                                                <?php
                                                if ($selisih->y !== 0) {
                                                    echo $selisih->y . ' Tahun, ';
                                                }

                                                // Menampilkan Bulan jika Bulan tidak sama dengan 0
                                                if ($selisih->m !== 0) {
                                                    if ($selisih->d !== 0) {
                                                        echo $selisih->m . ' Bulan, ';
                                                    } else {
                                                        echo $selisih->m . ' Bulan ';
                                                    }
                                                }

                                                // Menampilkan Hari jika Hari tidak sama dengan 0
                                                if ($selisih->d !== 0) {
                                                    echo $selisih->d . ' Hari';
                                                }
                                                ?>
                                            </h6>
                                            <table class="table align-items-center mb-2">
                                                <tr>
                                                    <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-9">No.</th>
                                                    <th style="text-align: left;" class="text-uppercase text-xxs font-weight-bolder opacity-9">Pernyataan</th>
                                                    <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-9">Jawaban Presepsi</th>
                                                    <th class="tetx-center text-uppercase text-xxs font-weight-bolder opacity-9">Jawaban Ekspetasi</th>

                                                </tr>

                                                <?php $i = 0; ?>
                                                <?php foreach ($pernyataan as $p) : ?>
                                                    <tr style="text-align: center;">
                                                        <td>
                                                            <p class=" text-xxs font-weight-bold mb-0"><?= $i + 1 ?></p>
                                                        </td>

                                                        <td>
                                                            <?php $pernyatan_real = $this->db->get_where('t_pernyataan', ['id_pernyataan' => $p->id_pernyataan])->row(); ?>
                                                            <p class="text-xxs font-weight-bold mb-0" style="text-align: left;"><?= $pernyatan_real->pernyataan ?></p>
                                                        </td>

                                                        <?php foreach ($jawaban as $j) : ?>
                                                            <?php if ($j->id_pelanggan == $s->id_pelanggan) : ?>
                                                                <?php if ($j->id_pernyataan == $p->id_pernyataan) : ?>
                                                                    <td>
                                                                        <p class=" text-xxs font-weight-bold mb-0"><?= $j->presepsi ?></p>
                                                                    </td>
                                                                    <td>
                                                                        <p class=" text-xxs font-weight-bold mb-0"><?= $j->ekspetasi ?></p>
                                                                    </td>
                                                                <?php endif ?>
                                                            <?php endif ?>
                                                        <?php endforeach ?>
                                                    </tr>
                                                    <?php $i++; ?>
                                                <?php endforeach ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>

                    <?php else : ?>
                        <div class="card mb-4 p-3 pt-1">
                            <div class="d-flex align-items-center">
                                <div class="card-header pb-0">
                                    <h5>Belum ada responden yg mengisi</h5>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>

                    <div class="text-end mb-3 me-2">
                        <a href=" <?= base_url() ?>manajer/data-kuesioner" class="btn btn-primary mb-0" type="button">Kembali</a>
                    </div>
                    </div>
                </div>
        </div>
    </div>