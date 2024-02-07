<div class="container-fluid py-0 mt-7">
    <div class="row">
        <div class="col-12">
            <div class="card mb-0">
                <div class="card-body ">
                    <div class="mb-4">
                        <?php
                        // Konversi tanggal_langganan ke objek DateTime
                        $tanggal_langganan = new DateTime($pelanggan->mulai_berlangganan);

                        // Hitung selisih waktu
                        $waktu_sekarang = new DateTime();
                        $selisih = $tanggal_langganan->diff($waktu_sekarang);
                        ?>
                        <p class="text-sm font-weight-bold mb-0"></p>
                        <p><b>Nama Lengkap :</b> <?= $pelanggan->nama_lengkap ?></p>
                        <p><b>Lama Berlangganan :</b>
                            <?php
                            // Menampilkan Tahun jika Tahun tidak sama dengan 0
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
                        </p>
                        <?php $lokasi_server = $this->db->get_where('t_lokasi_server', array('id_lokasi_server' => $pelanggan->lokasi_server))->row(); ?>
                        <p><b>Lokasi PPPoE :</b> <?= $lokasi_server->lokasi_server ?></p>
                    </div>

                    <div class="mb-4">
                        <span>Keterangan:</span><br>
                        <span>Isi kolom persepsi dan ekspektasi sesuai dengan yang anda rasakan terkait layanan perusahaan</span><br>
                        <span>STS = Sangat Tidak Setuju</span><br>
                        <span>TS = Tidak Setuju</span><br>
                        <span>C = Cukup</span><br>
                        <span>S = Setuju</span><br>
                        <span>SS = Sangat Setuju</span><br>
                    </div>

                    <form action="<?= base_url() ?>pelanggan/proses-isi-kuesioner" method="post">
                        <div class="table-responsive">
                            <table class="table-kuesioner align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th rowspan="2" style="width: 5%;">No.</th>
                                        <th rowspan="2" style="width: 35%; text-align:left">Pernyataan</th>
                                        <th colspan="5" style="width: 30%;">Presepsi</th>
                                        <th colspan="5" style="width: 30%">Ekspetasi</th>
                                    </tr>
                                    <tr>
                                        <th>STS</th>
                                        <th>TS</th>
                                        <th>C</th>
                                        <th>S</th>
                                        <th>SS</th>
                                        <th>STS</th>
                                        <th>TS</th>
                                        <th>C</th>
                                        <th>S</th>
                                        <th>SS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1 ?>
                                    <?php foreach ($pernyataan as $p) : ?>
                                        <tr>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0"><?= $i ?></p>
                                                <input type="hidden" name="id_kuesioner" value="<?= $p->id_kuesioner ?>">
                                            </td>
                                            <td>
                                                <?php $pernyatan_real = $this->db->get_where('t_pernyataan', ['id_pernyataan' => $p->id_pernyataan])->row(); ?>
                                                <p class="text-sm font-weight-bold mb-0" style="text-align: left;"><?= $pernyatan_real->pernyataan ?></p>
                                            </td>
                                            <!-- Presepsi -->
                                            <td class="text-center">
                                                <div class="form-check d-inline-block">
                                                    <input class="form-check-input" type="radio" name="presepsi<?= $i ?>" id="customRadio1" value="1" <?php echo set_radio("presepsi{$i}", '1'); ?>>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-inline-block">
                                                    <input class="form-check-input" type="radio" name="presepsi<?= $i ?>" id="customRadio1" value="2" <?php echo set_radio("presepsi{$i}", '2'); ?>>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-inline-block">
                                                    <input class="form-check-input" type="radio" name="presepsi<?= $i ?>" id="customRadio1" value="3" <?php echo set_radio("presepsi{$i}", '3'); ?>>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-inline-block">
                                                    <input class="form-check-input" type="radio" name="presepsi<?= $i ?>" id="customRadio1" value="4" <?php echo set_radio("presepsi{$i}", '4'); ?>>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-inline-block">
                                                    <input class="form-check-input" type="radio" name="presepsi<?= $i ?>" id="customRadio1" value="5" <?php echo set_radio("presepsi{$i}", '5'); ?>>
                                                </div>
                                            </td>
                                            <!-- End Presepsi -->

                                            <!-- ekspetasi -->
                                            <td>
                                                <div class="form-check d-inline-block">
                                                    <input class="form-check-input" type="radio" name="ekspetasi<?= $i ?>" id="customRadio1" value="1" <?php echo set_radio("ekspetasi{$i}", '1'); ?>>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-inline-block">
                                                    <input class="form-check-input" type="radio" name="ekspetasi<?= $i ?>" id="customRadio1" value="2" <?php echo set_radio("ekspetasi{$i}", '2'); ?>>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-inline-block">
                                                    <input class="form-check-input" type="radio" name="ekspetasi<?= $i ?>" id="customRadio1" value="3" <?php echo set_radio("ekspetasi{$i}", '3'); ?>>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-inline-block">
                                                    <input class="form-check-input" type="radio" name="ekspetasi<?= $i ?>" id="customRadio1" value="4" <?php echo set_radio("ekspetasi{$i}", '4'); ?>>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-inline-block">
                                                    <input class="form-check-input" type="radio" name="ekspetasi<?= $i ?>" id="customRadio1" value="5" <?php echo set_radio("ekspetasi{$i}", '5'); ?>>
                                                </div>
                                            </td>
                                            <!-- End ekspetasi -->
                                        </tr>
                                        <?php $i++ ?>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="text-end mt-4">
                            <a href=" <?= base_url() ?>pelanggan/kuesioner" class="btn btn-primary mb-0" type="button">Kembali</a>
                            <button class="btn btn-primary mb-0" type="submit">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <?php if (validation_errors()) { ?>
        <!-- Tampilkan pesan 'flashdata' sebagai modal -->
        <div class="modal fade" id="kuesioner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pesan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Maaf, ada kolom presepsi ataupun ekspetasi yang belum terisi.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-primary" data-bs-dismiss="modal">Oke</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>