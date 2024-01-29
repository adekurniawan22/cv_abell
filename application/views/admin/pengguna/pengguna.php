<div class="container-fluid py-0 mt-7">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 px-3">
                <div class="row mb-4">
                    <div class="col-6 d-flex align-items-center">
                        <div class="card-header pb-0">
                            <h5>Data Pengguna</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0" id="example">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Role</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Nama</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Email</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">No. HP</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Alamat</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Lokasi Pemasangan</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Status Akun</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Lama Berlangganan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pengguna as $p) : ?>
                                    <tr>
                                        <td>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $p->role ?></p>
                                        </td>
                                        <td>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $p->nama_lengkap ?></p>
                                        </td>
                                        <td>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $p->email ?></p>
                                        </td>
                                        <td>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $p->no_hp ?></p>
                                        </td>
                                        <td>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $p->alamat ?></p>
                                        </td>
                                        <td>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $p->lokasi ?></p>
                                        </td>
                                        <td class="">
                                            <?php if ($p->role == 'Pelanggan') : ?>
                                                <?php if ($p->status_aktif == '1') : ?>
                                                    <span class="ms-3 badge badge-sm bg-gradient-success">Aktif</span>
                                                <?php else : ?>
                                                    <span class="ms-3 badge badge-sm bg-gradient-danger">Tidak Aktif</span>
                                                <?php endif; ?>
                                            <?php else : ?>
                                                <span></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($p->role == 'Pelanggan') : ?>
                                                <?php
                                                // Konversi tanggal_langganan ke objek DateTime
                                                $tanggal_langganan = new DateTime($p->tanggal_langganan);

                                                // Hitung selisih waktu
                                                $waktu_sekarang = new DateTime();
                                                $selisih = $tanggal_langganan->diff($waktu_sekarang);
                                                ?>
                                                <p class="ms-3 text-sm font-weight-bold mb-0"><?= $selisih->y . ' Tahun, ' . $selisih->m . ' Bulan, ' . $selisih->d . ' Hari'  ?></p>
                                            <?php else : ?>
                                                <span></span>
                                            <?php endif; ?>
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


    <?php foreach ($pengguna as $pm) : ?>
        <!-- Modal Delete Akun -->
        <div class="modal fade" id="modal_hapus_pengguna<?= $pm->id_pengguna ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $pm->role ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus <?= $pm->role ?> ini?
                    </div>
                    <div class="modal-footer">
                        <form action="<?= base_url() ?>manajer/proses-hapus-pengguna" method="post">
                            <input type="hidden" name="id_pengguna" value="<?= $pm->id_pengguna ?>">
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
                        <li>Silahkan lihat contoh format file yang dapat di upload <a href="https://docs.google.com/spreadsheets/d/1HGYBUmcXn-q609-9AgtHM3iHnkGUHap6/edit?usp=sharing&ouid=100799364152492885109&rtpof=true&sd=true" target="_blank" style="text-decoration: underline; color: blue;">disini</a></li>
                    </ul>
                    <hr class="horizontal dark mt-0">
                    <form action="<?= base_url() ?>pengguna/import_data_excel" method="post" enctype="multipart/form-data">
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