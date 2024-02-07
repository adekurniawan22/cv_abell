<div class="container-fluid py-0 mt-7">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 px-3">
                <div class="row mb-4">
                    <div class="col-6 d-flex align-items-center">
                        <div class="card-header pb-0 mt-2">
                            <h5>Data Kuesioner</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0" id="example">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">No.</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Judul Kuesioner</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Tanggal Mulai</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Tanggal Selesai</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Di buat oleh</th>
                                    <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">Status Kuesioner</th>
                                    <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">Status Publish</th>
                                    <th style="width: 15%;" class="text-center text-uppercase text-xxs font-weight-bolder opacity-7" data-sortable="false">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 ?>
                                <?php foreach ($kuesioner as $k) : ?>
                                    <tr>
                                        <td>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $no ?></p>
                                        </td>
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
                                            $this->db->where('id_pegawai', $k->id_pegawai);
                                            $data = $this->db->get('t_pegawai')->row();
                                            ?>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $data->nama_lengkap ?></p>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($k->status_kuesioner == '1') : ?>
                                                <span class="badge badge-sm bg-gradient-success">OK!</span>
                                            <?php elseif ($k->status_kuesioner == '2') : ?>
                                                <span class="badge badge-sm bg-gradient-warning"><i class="bi bi-hourglass-split"></i> Sedang direview</span>
                                            <?php else : ?>
                                                <span class="badge badge-sm bg-gradient-danger">Belum OK</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($k->status_publish == '1') : ?>
                                                <span class="badge badge-sm bg-gradient-success">Publish</span>
                                            <?php else : ?>
                                                <span class="badge badge-sm bg-gradient-warning">Belum Publish!</span>
                                            <?php endif; ?>
                                        </td>

                                        <td class="text-center">
                                            <?php if ($k->status_kuesioner == '1') : ?>
                                                <p class="ms-3 text-sm font-weight-bold mb-0">Tidak ada aksi</p>
                                            <?php elseif ($k->status_kuesioner == '2') : ?>
                                                <button class="btn btn-link text-dark text-gradient px-3 mb-0" data-bs-toggle="modal" data-bs-target="#modal_detail_pernyataan<?= $k->id_kuesioner ?>"><i class="bi bi-eye-fill me-2" aria-hidden="true"></i>Detail Pernyataan</button>
                                            <?php else : ?>
                                                <form action="<?= base_url() ?>admin/isi-pernyataan" method="post" class="d-inline-block">
                                                    <input type="hidden" name="id_kuesioner" value="<?= $k->id_kuesioner ?>">
                                                    <button type="submit" class="btn btn-link text-dark px-3 mb-0"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Isi Pernyataan</Button>
                                                </form>
                                            <?php endif; ?>

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
                        $query = $this->db->get('t_detail_kuesioner')->result();
                        ?>
                        <table style="width: 100%; border-collapse: collapse;">
                            <tr>
                                <th style="border: 1px solid #ddd; padding:10px;">No.</th>
                                <th style="border: 1px solid #ddd; padding:10px;">Pernyataan</th>
                                <th style="border: 1px solid #ddd; padding:10px;">Dimensi</th>
                            </tr>
                            <?php $i = 1 ?>
                            <?php foreach ($query as $q) : ?>
                                <?php
                                $this->db->where('id_pernyataan', $q->id_pernyataan);
                                $pernyataan = $this->db->get('t_pernyataan')->row();

                                $this->db->where('id_dimensi', $pernyataan->id_dimensi);
                                $dimensi = $this->db->get('t_dimensi')->row();
                                ?>
                                <tr>
                                    <td style="border: 1px solid #ddd; padding:10px; text-align: center"><?= $i ?></td>
                                    <td style="border: 1px solid #ddd; padding:10px;"><?= $pernyataan->pernyataan ?></td>
                                    <td style="border: 1px solid #ddd; padding:10px;"><?= $dimensi->dimensi ?></td>
                                </tr>
                                <?php $i++ ?>
                            <?php endforeach ?>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
</div>
<?php endforeach; ?>