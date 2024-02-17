<div class="container-fluid py-0 mt-7">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 px-3">
                <div class="row mb-4">
                    <div class="col-6 d-flex align-items-center">
                        <div class="card-header pb-0">
                            <h5>Data Lokasi Server</h5>
                        </div>
                    </div>
                    <div class="col-6 pt-4 text-end">
                        <div>
                            <a href="<?= base_url() ?>manajer/tambah-lokasi-server" class="btn bg-gradient-dark">+ Tambah Lokasi Server</a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0" id="example">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Lokasi Server</th>
                                    <th style="width: 25%;" class="text-uppercase text-xxs font-weight-bolder opacity-7" data-sortable="false">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($lokasi_server as $l) : ?>
                                    <tr>
                                        <td>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $l->lokasi_server ?></p>
                                        </td>

                                        <td class="align-middle">
                                            <form action="<?= base_url() ?>manajer/edit-lokasi-server" method="post" class="d-inline-block">
                                                <input type="hidden" name="id_lokasi_server" value="<?= $l->id_lokasi_server ?>">
                                                <button type="submit" class="btn btn-link text-dark p-2 mb-0"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true" disabled></i>Edit</Button>
                                            </form>
                                            <button class="btn btn-link text-danger text-gradient p-2 mb-0" data-bs-toggle="modal" data-bs-target="#modal_hapus_lokasi<?= $l->id_lokasi_server ?>"><i class="far fa-trash-alt me-2" aria-hidden="true" disabled></i>Hapus</button>
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

    <?php foreach ($lokasi_server as $lm) : ?>
        <!-- Modal Delete Akun -->
        <div class="modal fade" id="modal_hapus_lokasi<?= $lm->id_lokasi_server ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Lokasi Server</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus <?= $lm->lokasi_server ?>?
                    </div>
                    <div class="modal-footer">
                        <form action="<?= base_url() ?>lokasi_server/proses_hapus_lokasi_server" method="post">
                            <input type="hidden" name="id_lokasi_server" value="<?= $lm->id_lokasi_server ?>">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batalkan</button>
                            <button type="submit" class="btn bg-gradient-primary">Ya</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>