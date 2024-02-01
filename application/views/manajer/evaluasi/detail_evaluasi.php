<div class="container-fluid py-0 mt-7">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 px-3">
                <div class="row mb-2">
                    <div class="col-6 d-flex align-items-center">
                        <div class="card-header pb-0">
                            <h5>Hasil Evaluasi</h5>
                        </div>
                    </div>
                </div>
                <style>
                    .table td {
                        vertical-align: top !important;
                    }
                </style>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive mx-4">
                        <form action="<?= base_url() ?>evaluasi/proses_rekomendasi_perbaikan" method="post">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th style="width:40% ;text-align:left" class="ps-0 text-uppercase text-xxs font-weight-bolder opacity-9">Pernyataan</th>
                                        <th class="ps-0 text-uppercase text-xxs font-weight-bolder opacity-9">Hasil Evaluasi</th>
                                        <th style="width:40%" class="ps-2 text-uppercase text-xxs font-weight-bolder opacity-9">Rekomendasi Perbaikan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($detail_evaluasi as $e) : ?>
                                        <tr>
                                            <?php foreach ($pernyataan as $p) : ?>
                                                <?php if ($e['id_pernyataan'] == $p['id_pernyataan']) : ?>
                                                    <td style="text-align: left;" class="ps-0 pt-2 m-0>
                                                    <p class=" text-sm font-weight-bold mb-0"><?= $p['pernyataan'] ?></p>
                                                    </td>
                                                <?php endif; ?>
                                            <?php endforeach; ?>

                                            <td style="color: <?= ($e['gap'] >= 0) ? 'green' : 'red'; ?>" class="ps-0 pt-2 m-0>
                                            <p class=" text-sm font-weight-bold mb-0"><?= ($e['gap'] >= 0) ? 'Tidak Perlu Perbaikan' : 'Perlu Perbaikan'; ?></p>
                                            </td>
                                            <td class="text-left">
                                                <?php if (!empty($e['rekomendasi_perbaikan'])) : ?>
                                                    <?php if ($e['gap'] <= 0) : ?>
                                                        <input type="hidden" name="id_detail_evaluasi[]" value="<?= $e['id_detail_evaluasi'] ?>">
                                                        <textarea class="form-control" placeholder="Rekomendasi Perbaikan" id="rekomendasi_perbaikan[]" name="rekomendasi_perbaikan[]" rows="2" required oninvalid="this.setCustomValidity('Harap isi Rekomendasi Perbaikan ini')" oninput="setCustomValidity('')"><?= nl2br(trim($e['rekomendasi_perbaikan'])) ?></textarea>
                                                    <?php endif; ?>
                                                <?php else : ?>
                                                    <?php if ($e['gap'] <= 0) : ?>
                                                        <input type="hidden" name="id_detail_evaluasi[]" value="<?= $e['id_detail_evaluasi'] ?>">
                                                        <textarea class="form-control" placeholder="Rekomendasi Perbaikan" id="rekomendasi_perbaikan[]" name="rekomendasi_perbaikan[]" rows="2" required oninvalid="this.setCustomValidity('Harap isi Rekomendasi Perbaikan ini')" oninput="setCustomValidity('')"></textarea>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                    </div>

                    <div class="text-end mt-4 mb-3">
                        <a href=" <?= base_url() ?>manajer/data-evaluasi" class="btn btn-primary mb-0" type="button">Kembali</a>
                        <button class="btn btn-primary mb-0" type="submit">Update Rekomendasi Perbaikan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>