<div class="container-fluid py-0 mt-7">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 px-3">
                <div class="row mb-4">
                    <div class="col-6 d-flex align-items-center">
                        <div class="card-header pb-0">
                            <h5>Data Pelanggan</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0" id="example">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Nama Lengkap</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">No. HP</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Alamat</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Lokasi Server</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Status Akun</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Lama Berlangganan</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Ditambahkan Oleh</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pelanggan as $p) : ?>
                                    <tr>
                                        <td>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $p->nama_lengkap ?></p>
                                        </td>
                                        <td>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $p->no_hp ?></p>
                                        </td>
                                        <td>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= nl2br($p->alamat) ?></p>
                                        </td>
                                        <td>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $p->lokasi_server ?></p>
                                        </td>
                                        <td>
                                            <?php if ($p->status_aktif == '1') : ?>
                                                <span class="ms-3 badge badge-sm bg-gradient-success">Aktif</span>
                                            <?php else : ?>
                                                <span class="ms-3 badge badge-sm bg-gradient-danger">Tidak Aktif</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php
                                            $mulai_berlangganan = new DateTime($p->mulai_berlangganan);
                                            $waktu_sekarang = new DateTime();
                                            $selisih = $mulai_berlangganan->diff($waktu_sekarang);
                                            ?>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $selisih->y . ' Tahun, ' . $selisih->m . ' Bulan, ' . $selisih->d . ' Hari'  ?></p>
                                        </td>
                                        <td>
                                            <?php foreach ($pegawai as $peg) : ?>
                                                <?php if ($peg->id_pegawai == $p->id_pegawai) : ?>
                                                    <p class="ms-3 text-sm font-weight-bold mb-0"><?= $peg->nama_lengkap ?></p>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>