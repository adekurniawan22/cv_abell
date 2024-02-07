<div class="container-fluid py-0 mt-7">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 px-3">
                <div class="row mb-4">
                    <div class="col-6 d-flex align-items-center">
                        <div class="card-header pb-0">
                            <h5>Data Pernyataan</h5>
                        </div>
                    </div>
                    <div class="col-6 pt-4 text-end">
                        <div class="d-inline-block">
                            <a href="<?= base_url() ?>manajer/tambah-pernyataan" class="btn bg-gradient-dark">+ Tambah Pernyataan</a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0" id="example">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">No.</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Dimensi</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Pernyataan</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Rekomendasi Perbaikan</th>
                                    <th style="width: 15%;" class="text-uppercase text-xxs font-weight-bolder opacity-7" data-sortable="false">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($pernyataan as $p) : ?>
                                    <tr>
                                        <td>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $no ?></p>
                                        </td>
                                        <td>
                                            <?php $dimensi = $this->db->get_where('t_dimensi', ['id_dimensi' => $p->id_dimensi])->row(); ?>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $dimensi->dimensi ?></p>
                                        </td>
                                        <td style="width:30%; word-wrap: break-word; white-space: pre-line;">
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $p->pernyataan ?></p>
                                        </td>
                                        <td style="width:40%;word-wrap: break-word; white-space: pre-line;">
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $p->rekomendasi_perbaikan ?></p>
                                        </td>

                                        <td class="align-middle">
                                            <form action="<?= base_url() ?>manajer/edit-pernyataan" method="post" class="d-inline-block">
                                                <input type="hidden" name="id_pernyataan" value="<?= $p->id_pernyataan ?>">
                                                <button type="submit" class="btn btn-link text-dark px-3 mb-0"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</Button>
                                            </form>
                                            <button class="btn btn-link text-danger text-gradient px-3 mb-0" data-bs-toggle="modal" data-bs-target="#modal_hapus_pernyataan<?= $p->id_pernyataan ?>"><i class="far fa-trash-alt me-2" aria-hidden="true"></i>Hapus</button>
                                        </td>
                                    </tr>
                                    <?php $no++ ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php foreach ($pernyataan as $pm) : ?>
        <!-- Modal Delete Akun -->
        <div class="modal fade" id="modal_hapus_pernyataan<?= $pm->id_pernyataan ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus pernyataan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus akun pernyataan ini?
                    </div>
                    <div class="modal-footer">
                        <form action="<?= base_url() ?>pernyataan/proses_hapus_pernyataan" method="post">
                            <input type="hidden" name="id_pernyataan" value="<?= $pm->id_pernyataan ?>">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batalkan</button>
                            <button type="submit" class="btn bg-gradient-primary">Ya</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>