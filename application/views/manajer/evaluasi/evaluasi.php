<div class="container-fluid py-0 mt-7">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 px-3">
                <div class="row mb-4">
                    <div class="col-6 d-flex align-items-center">
                        <div class="card-header pb-0">
                            <h5>Data Evaluasi</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0" id="example">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Tanggal Evaluasi</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Total Responden</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Total Pelanggan</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Hasil Kepuasan Pelanggan</th>
                                    <th style="width: 25%;" class="text-uppercase text-xxs font-weight-bolder opacity-7" data-sortable="false">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($evaluasi as $e) : ?>
                                    <tr>
                                        <td>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $e->tanggal_evaluasi ?></p>
                                        </td>
                                        <td>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $e->total_responden ?></p>
                                        </td>
                                        <td>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $e->total_pelanggan ?></p>
                                        </td>
                                        <td>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $e->kriteria_nilai_csi ?></p>
                                        </td>
                                        <td class="align-middle">
                                            <form action="<?= base_url() ?>manajer/detail-evaluasi" method="post" class="d-inline-block">
                                                <input type="hidden" name="id_evaluasi" value="<?= $e->id_evaluasi ?>">
                                                <input type="hidden" name="id_kuesioner" value="<?= $e->id_kuesioner ?>">
                                                <button type="submit" class="btn btn-link text-dark px-3 mb-0"><i class="bi bi-eye-fill me-2" aria-hidden="true" disabled></i>Lihat Hasil Evaluasi</button>
                                            </form>
                                            <form action="<?= base_url() ?>manajer/cetak-evaluasi-pdf" method="post" class="d-inline-block" target="_blank">
                                                <input type="hidden" name="id_evaluasi" value="<?= $e->id_evaluasi ?>">
                                                <input type="hidden" name="id_kuesioner" value="<?= $e->id_kuesioner ?>">
                                                <button type="submit" class="btn btn-link text-dark px-3 mb-0"><i class="bi bi-download text-dark me-2" aria-hidden="true"></i>PDF</Button>
                                            </form>
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