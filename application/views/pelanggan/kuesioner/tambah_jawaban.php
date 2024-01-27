<div class="container-fluid py-0 mt-7">
    <div class="row">
        <div class="col-12">
            <div class="card mb-0">
                <div class="card-body ">
                    <div class="mb-4">
                        <?php
                        // Konversi tanggal_langganan ke objek DateTime
                        $tanggal_langganan = new DateTime($pengguna->tanggal_langganan);

                        // Hitung selisih waktu
                        $waktu_sekarang = new DateTime();
                        $selisih = $tanggal_langganan->diff($waktu_sekarang);
                        ?>
                        <p class="text-sm font-weight-bold mb-0"></p>
                        <p><b>Nama Lengkap :</b> <?= $pengguna->nama_lengkap ?></p>
                        <p><b>Lama Berlangganan :</b> <?= $selisih->y . ' Tahun, ' . $selisih->m . ' Bulan, ' . $selisih->d . ' Hari'  ?></p>
                        <p><b>Lokasi PPPoE :</b> <?= $pengguna->lokasi ?></p>
                    </div>
                    <div class="mb-4">
                        <span>Keterangan:</span><br>
                        <span>Berikan tanda ceklis (✓) pada kolom persepsi dan ekspektasi</span><br>
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
                                                <p class="text-sm font-weight-bold mb-0" style="text-align: left;"><?= $p->pernyataan ?></p>
                                            </td>
                                            <!-- Presepsi -->
                                            <td class="text-center">
                                                <div class="form-check d-inline-block">
                                                    <input class="form-check-input" type="radio" name="presepsi<?= $i ?>" id="customRadio1" value="STS" <?php echo set_radio("presepsi{$i}", 'STS'); ?>>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-inline-block">
                                                    <input class="form-check-input" type="radio" name="presepsi<?= $i ?>" id="customRadio1" value="TS" <?php echo set_radio("presepsi{$i}", 'TS'); ?>>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-inline-block">
                                                    <input class="form-check-input" type="radio" name="presepsi<?= $i ?>" id="customRadio1" value="C" <?php echo set_radio("presepsi{$i}", 'C'); ?>>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-inline-block">
                                                    <input class="form-check-input" type="radio" name="presepsi<?= $i ?>" id="customRadio1" value="S" <?php echo set_radio("presepsi{$i}", 'S'); ?>>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-inline-block">
                                                    <input class="form-check-input" type="radio" name="presepsi<?= $i ?>" id="customRadio1" value="SS" <?php echo set_radio("presepsi{$i}", 'SS'); ?>>
                                                </div>
                                            </td>
                                            <!-- End Presepsi -->

                                            <!-- ekspetasi -->
                                            <td>
                                                <div class="form-check d-inline-block">
                                                    <input class="form-check-input" type="radio" name="ekspetasi<?= $i ?>" id="customRadio1" value="STS" <?php echo set_radio("ekspetasi{$i}", 'STS'); ?>>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-inline-block">
                                                    <input class="form-check-input" type="radio" name="ekspetasi<?= $i ?>" id="customRadio1" value="TS" <?php echo set_radio("ekspetasi{$i}", 'TS'); ?>>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-inline-block">
                                                    <input class="form-check-input" type="radio" name="ekspetasi<?= $i ?>" id="customRadio1" value="C" <?php echo set_radio("ekspetasi{$i}", 'C'); ?>>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-inline-block">
                                                    <input class="form-check-input" type="radio" name="ekspetasi<?= $i ?>" id="customRadio1" value="S" <?php echo set_radio("ekspetasi{$i}", 'S'); ?>>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-inline-block">
                                                    <input class="form-check-input" type="radio" name="ekspetasi<?= $i ?>" id="customRadio1" value="SS" <?php echo set_radio("ekspetasi{$i}", 'SS'); ?>>
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

    <script>
        // Fungsi untuk menangani perubahan pada elemen role
        function handleRoleChange() {
            var roleSelect = document.getElementById('role');
            var lokasiFormGroup = document.getElementById('lokasi-form-group');

            // Periksa apakah peran yang dipilih adalah "Pelanggan"
            if (roleSelect.value === 'Pelanggan') {
                // Tampilkan form-group lokasi
                lokasiFormGroup.style.display = 'block';
            } else {
                // Sembunyikan form-group lokasi dan reset nilai
                lokasiFormGroup.style.display = 'none';
                document.getElementById('lokasi').value = '';
            }
        }

        // Panggil fungsi handleRoleChange saat dokumen diinisialisasi
        document.addEventListener('DOMContentLoaded', function() {
            handleRoleChange();
        });
    </script>