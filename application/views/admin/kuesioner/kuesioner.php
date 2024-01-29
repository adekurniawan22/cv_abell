<div class="container-fluid py-0 mt-7">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 px-3">
                <div class="row mb-4">
                    <div class="col-6 d-flex align-items-center">
                        <div class="card-header pb-0">
                            <h5>Data Kuesioner</h5>
                        </div>
                    </div>
                    <div class="col-6 pt-4 text-end">
                        <div>
                            <a href="<?= base_url() ?>admin/tambah-kuesioner" class="btn bg-gradient-dark">+ Tambah Kuesioner</a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0" id="example">
                            <thead>
                                <tr>

                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Judul Kuesioner</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Tanggal Mulai</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Tanggal Selesai</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Di buat oleh</th>
                                    <th style="width: 25%;" class="text-uppercase text-xxs font-weight-bolder opacity-7" data-sortable="false">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($kuesioner as $k) : ?>
                                    <tr>
                                        <td>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $k->judul_kuesioner ?></p>
                                        </td>
                                        <td>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $k->mulai ?></p>
                                        </td>
                                        <td>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $k->selesai ?></p>
                                        </td>
                                        <td>
                                            <?php
                                            $this->db->where('id_pengguna', $k->id_pengguna);
                                            $data = $this->db->get('t_pengguna')->row();
                                            ?>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $data->nama_lengkap ?></p>
                                        </td>

                                        <td class="align-middle">
                                            <button class="btn btn-link text-dark text-gradient px-3 mb-0" data-bs-toggle="modal" data-bs-target="#modal_detail_pernyataan<?= $k->id_kuesioner ?>"><i class="bi bi-eye-fill me-2" aria-hidden="true" disabled></i>Detail Pernyataan</button>
                                            <form action="<?= base_url() ?>admin/edit-kuesioner" method="post" class="d-inline-block">
                                                <input type="hidden" name="id_kuesioner" value="<?= $k->id_kuesioner ?>">
                                                <button type="submit" class="btn btn-link text-dark px-3 mb-0"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true" disabled></i>Edit</Button>
                                            </form>
                                            <button class="btn btn-link text-danger text-gradient px-3 mb-0" data-bs-toggle="modal" data-bs-target="#modal_hapus_kuesioner<?= $k->id_kuesioner ?>"><i class="far fa-trash-alt me-2" aria-hidden="true" disabled></i>Delete</button>
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

    <?php foreach ($kuesioner as $km) : ?>
        <!-- Modal Delete Akun -->
        <div class="modal fade" id="modal_hapus_kuesioner<?= $km->id_kuesioner ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Kuesioner</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus Kuesioner Ini?
                    </div>
                    <div class="modal-footer">
                        <form action="<?= base_url() ?>kuesioner/proses_hapus_kuesioner" method="post">
                            <input type="hidden" name="id_kuesioner" value="<?= $km->id_kuesioner ?>">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batalkan</button>
                            <button type="submit" class="btn bg-gradient-primary">Ya</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Detail Pernyataan -->
        <div class="modal fade" id="modal_detail_pernyataan<?= $km->id_kuesioner ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Pernyataan Kuesioner</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php
                        $this->db->where('id_kuesioner', $km->id_kuesioner);
                        $query = $this->db->get('t_pernyataan')->result();
                        ?>
                        <ul>
                            <?php foreach ($query as $q) : ?>
                                <li><?= $q->pernyataan ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
</div>
<?php endforeach; ?>