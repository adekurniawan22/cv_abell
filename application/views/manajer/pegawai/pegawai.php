<div class="container-fluid py-0 mt-7">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 px-3">
                <div class="row mb-4">
                    <div class="col-6 d-flex align-items-center">
                        <div class="card-header pb-0">
                            <h5>Data Pegawai</h5>
                        </div>
                    </div>
                    <div class="col-6 pt-4 text-end">
                        <div class="d-inline-block">
                            <a href="<?= base_url() ?>manajer/tambah-pegawai" class="btn bg-gradient-dark">+ Tambah Pegawai</a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0" id="example">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Jabatan</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Nama Lengkap</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Username</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Email</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">No. HP</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Alamat</th>
                                    <th style="width: 15%;" class="text-uppercase text-xxs font-weight-bolder opacity-7" data-sortable="false">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pegawai as $p) : ?>
                                    <tr>
                                        <td>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $p->jabatan ?></p>
                                        </td>
                                        <td>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $p->nama_lengkap ?></p>
                                        </td>
                                        <td>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $p->username ?></p>
                                        </td>
                                        <td>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $p->email ?></p>
                                        </td>
                                        <td>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $p->no_hp ?></p>
                                        </td>
                                        <td>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= nl2br($p->alamat) ?></p>
                                        </td>
                                        <?php if ($p->jabatan == 'Manajer') : ?>
                                            <td class="align-middle">
                                                <button type="submit" class="btn btn-link text-dark px-3 mb-0" style="cursor: no-drop;" title="Tombol Dilarang"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</button>
                                                <button class="btn btn-link text-danger text-gradient px-3 mb-0" style="cursor: no-drop;" title="Tombol Dilarang"><i class="far fa-trash-alt me-2" aria-hidden="true"></i>Hapus</button>
                                            </td>
                                        <?php else : ?>
                                            <td class="align-middle">
                                                <form action="<?= base_url() ?>manajer/edit-pegawai" method="post" class="d-inline-block">
                                                    <input type="hidden" name="id_pegawai" value="<?= $p->id_pegawai ?>">
                                                    <button type="submit" class="btn btn-link text-dark px-3 mb-0"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</Button>
                                                </form>
                                                <button class="btn btn-link text-danger text-gradient px-3 mb-0" data-bs-toggle="modal" data-bs-target="#modal_hapus_pegawai<?= $p->id_pegawai ?>"><i class="far fa-trash-alt me-2" aria-hidden="true"></i>Hapus</button>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php foreach ($pegawai as $pm) : ?>
        <!-- Modal Delete Akun -->
        <div class="modal fade" id="modal_hapus_pegawai<?= $pm->id_pegawai ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $pm->jabatan ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus akun <?= $pm->nama_lengkap ?> ini?
                    </div>
                    <div class="modal-footer">
                        <form action="<?= base_url() ?>pegawai/proses_hapus_pegawai" method="post">
                            <input type="hidden" name="id_pegawai" value="<?= $pm->id_pegawai ?>">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batalkan</button>
                            <button type="submit" class="btn bg-gradient-primary">Ya</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>