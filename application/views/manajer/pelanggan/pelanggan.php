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
                    <div class="col-6 pt-4 text-end">
                        <div class="d-inline-block">
                            <button data-bs-toggle="modal" data-bs-target="#add_data" class="btn bg-gradient-dark"><i class="bi bi-file-earmark-plus-fill"></i> Import Data</button>
                        </div>
                        <div class="d-inline-block">
                            <a href="<?= base_url() ?>manajer/tambah-pelanggan" class="btn bg-gradient-dark">+ Tambah Pelanggan</a>
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
                                    <th style="width: 15%;" class="text-uppercase text-xxs font-weight-bolder opacity-7" data-sortable="false">Aksi</th>
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

                                            // Menampilkan Tahun jika Tahun tidak sama dengan 0
                                            if ($selisih->y !== 0) {
                                                echo $selisih->y . ' Tahun, ';
                                            }

                                            // Menampilkan Bulan jika Bulan tidak sama dengan 0
                                            if ($selisih->m !== 0) {
                                                echo $selisih->m . ' Bulan, ';
                                            }

                                            // Menampilkan Hari jika Hari tidak sama dengan 0
                                            if ($selisih->d !== 0) {
                                                echo $selisih->d . ' Hari';
                                            }
                                            ?>
                                        </td>

                                        <td>
                                            <?php foreach ($pegawai as $peg) : ?>
                                                <?php if ($peg->id_pegawai == $p->id_pegawai) : ?>
                                                    <p class="ms-3 text-sm font-weight-bold mb-0"><?= $peg->nama_lengkap ?></p>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </td>
                                        <td class="align-middle">
                                            <form action="<?= base_url() ?>manajer/edit-pelanggan" method="post" class="d-inline-block">
                                                <input type="hidden" name="id_pelanggan" value="<?= $p->id_pelanggan ?>">
                                                <button type="submit" class="btn btn-link text-dark px-3 mb-0"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</Button>
                                            </form>
                                            <button class="btn btn-link text-danger text-gradient px-3 mb-0" data-bs-toggle="modal" data-bs-target="#modal_hapus_pelanggan<?= $p->id_pelanggan ?>"><i class="far fa-trash-alt me-2" aria-hidden="true"></i>Hapus</button>
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


    <?php foreach ($pelanggan as $pm) : ?>
        <!-- Modal Delete Akun -->
        <div class="modal fade" id="modal_hapus_pelanggan<?= $pm->id_pelanggan ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Pelanggan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus akun <?= $pm->nama_lengkap ?> ini?
                    </div>
                    <div class="modal-footer">
                        <form action="<?= base_url() ?>pelanggan/proses_hapus_pelanggan" method="post">
                            <input type="hidden" name="id_pelanggan" value="<?= $pm->id_pelanggan ?>">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batalkan</button>
                            <button type="submit" class="btn bg-gradient-primary">Ya</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- Modal Add data Use Files -->
    <div class="modal fade" id="add_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Baca aturan untuk import data dibawah ini :
                    <ul>
                        <li>File yang hanya dapat diinputkan hanya .xlsx</li>
                        <li>Silahkan lihat contoh format file yang dapat di upload <a href="https://docs.google.com/spreadsheets/d/1-0Y9CNyLj-Iq-SMIInzzqV5Au-7xx3XQ/edit#gid=1471303384" target="_blank" style="text-decoration: underline; color: blue;">disini</a></li>
                    </ul>
                    <hr class="horizontal dark mt-0">
                    <form action="<?= base_url() ?>pelanggan/import_data_excel" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="excel" class="form-control-label">File .xlsx</label>
                            <input class="form-control" type="file" id="excel" name="excel" accept=".xlsx" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn bg-gradient-primary">Import</button>
                    </form>
                </div>
            </div>
        </div>
    </div>