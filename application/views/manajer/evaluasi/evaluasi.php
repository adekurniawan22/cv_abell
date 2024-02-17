<div class="container-fluid py-0 mt-7">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 px-3">
                <div class="row mb-4">
                    <div class="col-6 d-flex align-items-center pt-2">
                        <div class="card-header pb-0">
                            <h5>Data Perhitungan</h5>
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
                                    <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">Tanggal Evaluasi</th>
                                    <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">Total Responden</th>
                                    <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">Nilai Kepuasan</th>
                                    <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">Indeks Kepuasan Pelanggan</th>
                                    <th style="width: 10%;" class="text-center text-uppercase text-xxs font-weight-bolder opacity-7" data-sortable="false">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                <?php foreach ($evaluasi as $e) : ?>
                                    <tr>
                                        <td>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $i ?></p>
                                        </td>
                                        <td>
                                            <?php
                                            $this->db->where('id_kuesioner', $e->id_kuesioner);
                                            $kuesioner = $this->db->get('t_kuesioner')->row();
                                            ?>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $kuesioner->judul_kuesioner ?></p>
                                        </td>
                                        <td>
                                            <p class="text-center text-sm font-weight-bold mb-0"><?= $e->tanggal_evaluasi ?></p>
                                        </td>
                                        <td>
                                            <p class="text-center text-sm font-weight-bold mb-0"><?= $e->total_responden ?> Orang</p>
                                        </td>
                                        <td>
                                            <p class="text-center text-sm font-weight-bold mb-0"><?= $e->nilai_csi ?> %</p>
                                        </td>
                                        <td>
                                            <p class="text-center text-sm font-weight-bold mb-0"><?= $e->indeks_csi ?></p>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-link text-danger text-gradient px-3 mb-0" data-bs-toggle="modal" data-bs-target="#modal_hapus_evaluasi<?= $e->id_evaluasi ?>"><i class="far fa-trash-alt me-2" aria-hidden="true" disabled></i>Hapus</button>
                                            <button class="btn btn-link text-dark text-gradient p-2 mb-0" data-bs-toggle="modal" data-bs-target="#lihat_detail<?= $e->id_evaluasi ?>"><i class="bi bi-eye-fill me-2" aria-hidden="true"></i>Detail Evaluasi</button>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php foreach ($evaluasi as $em) : ?>
        <!-- Modal Delete Evaluasi -->
        <div class="modal fade" id="modal_hapus_evaluasi<?= $em->id_evaluasi ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Evaluasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus Evaluasi Ini?
                    </div>
                    <div class="modal-footer">
                        <form action="<?= base_url() ?>evaluasi/proses_hapus_evaluasi" method="post">
                            <input type="hidden" name="id_evaluasi" value="<?= $em->id_evaluasi ?>">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batalkan</button>
                            <button type="submit" class="btn bg-gradient-primary">Ya</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Lihat Detail -->
        <div class="modal fade" id="lihat_detail<?= $em->id_evaluasi ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Evaluasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php
                        $this->db->where('id_evaluasi', $em->id_evaluasi);
                        $this->db->where('gap <', 0);
                        $query = $this->db->get('t_detail_evaluasi')->result();
                        ?>
                        <?php if ($query) : ?>
                            <table style="width: 100%; border-collapse: collapse;">
                                <tr>
                                    <th style="border: 1px solid #ddd; padding:10px;">No.</th>
                                    <th style="border: 1px solid #ddd; padding:10px;">Dimensi</th>
                                    <th style="border: 1px solid #ddd; padding:10px;">Pernyataan</th>
                                    <th style="border: 1px solid #ddd; padding:10px; text-align: center">Nilia WF (%)</th>
                                    <th style="border: 1px solid #ddd; padding:10px;">Rekomendasi Perbaikan</th>
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
                                        <td style="border: 1px solid #ddd; padding:10px;"><?= $dimensi->dimensi ?></td>
                                        <td style="border: 1px solid #ddd; padding:10px;"><?= $pernyataan->pernyataan ?></td>
                                        <td style="border: 1px solid #ddd; padding:10px; text-align: center"><?= $q->wf ?> %</td>
                                        <td style="border: 1px solid #ddd; padding:10px;"><?= $pernyataan->rekomendasi_perbaikan ?></td>
                                    </tr>
                                    <?php $i++ ?>
                                <?php endforeach ?>
                            </table>
                        <?php else : ?>
                            <div class="text-center">
                                <span>Tidak ada rekomendasi perbaikan</span>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="modal-footer">
                        <?php if ($query) : ?>
                            <div class="pt-1">
                                <form action="<?= base_url() ?>manajer/cetak-evaluasi-pdf" method="post" class="" target="_blank">
                                    <input type="hidden" name="id_evaluasi" value="<?= $em->id_evaluasi ?>">
                                    <input type="hidden" name="id_kuesioner" value="<?= $em->id_kuesioner ?>">
                                    <button type="submit" class="btn bg-gradient-primary" data-bs-dismiss="modal"><i class="text-white bi bi-download me-2" aria-hidden="true"></i>PDF</button>
                                </form>
                            </div>
                        <?php endif ?>
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>