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
                    .table th,
                    .table td {
                        border: 1px solid black !important;
                        /* padding: 10px; */
                    }
                </style>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive mx-4">
                        <table class="table align-items-center mb-0">
                            <tr>
                                <th class="text-uppercase text-xxs font-weight-bolder opacity-9">No.</th>
                                <th style="text-align: left;" class="text-uppercase text-xxs font-weight-bolder opacity-9">Pernyataan</th>
                                <th class="text-uppercase text-xxs font-weight-bolder opacity-9">Total Presepsi</th>
                                <th class="text-uppercase text-xxs font-weight-bolder opacity-9">Total Ekspetasi</th>
                                <th class="text-uppercase text-xxs font-weight-bolder opacity-9">Nilai MIS</th>
                                <th class="text-uppercase text-xxs font-weight-bolder opacity-9">Nilai MSS</th>
                                <th class="text-uppercase text-xxs font-weight-bolder opacity-9">Nilai WF (%)</th>
                                <th class="text-uppercase text-xxs font-weight-bolder opacity-9">Nilai WS</th>
                                <th class="text-uppercase text-xxs font-weight-bolder opacity-9">Nilai CSI</th>
                                <th class="text-uppercase text-xxs font-weight-bolder opacity-9">Kriteria Nilai CSI</th>
                                <th class="text-uppercase text-xxs font-weight-bolder opacity-9">Nilai GAP</th>
                                <th class="text-uppercase text-xxs font-weight-bolder opacity-9">Rekomendasi Perbaikan</th>
                            </tr>

                            <?php $i = 0; ?>
                            <?php foreach ($detail_evaluasi as $e) : ?>
                                <tr style="text-align: center;">
                                    <td>
                                        <p class=" text-xxs font-weight-bold mb-0"><?= $i + 1 ?></p>
                                    </td>
                                    <?php foreach ($pernyataan as $p) : ?>
                                        <?php if ($e['id_pernyataan'] == $p['id_pernyataan']) : ?>
                                            <td style="text-align: left;">
                                                <p class=" text-xxs font-weight-bold mb-0"><?= $p['pernyataan'] ?></p>
                                            </td>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <td>
                                        <p class=" text-xxs font-weight-bold mb-0"><?= $e['total_ekspetasi'] ?></p>
                                    </td>
                                    <td>
                                        <p class=" text-xxs font-weight-bold mb-0"><?= $e['total_presepsi'] ?></p>
                                    </td>
                                    <td>
                                        <p class=" text-xxs font-weight-bold mb-0"><?= $e['mis'] ?></p>
                                    </td>
                                    <td>
                                        <p class=" text-xxs font-weight-bold mb-0"><?= $e['mss'] ?></p>
                                    </td>
                                    <td>
                                        <p class=" text-xxs font-weight-bold mb-0"><?= $e['wf'] ?></p>
                                    </td>
                                    <td>
                                        <p class=" text-xxs font-weight-bold mb-0"><?= $e['ws'] ?></p>
                                    </td>
                                    <?php if ($i == 0) : ?>
                                        <td rowspan="15">
                                            <p class=" text-xxs font-weight-bold mb-0 text-center"><?= $evaluasi->nilai_csi ?></p>
                                        </td>
                                        <td rowspan="15">
                                            <p class=" text-xxs font-weight-bold mb-0"><?= $evaluasi->kriteria_nilai_csi ?></p>
                                        </td>
                                    <?php endif; ?>
                                    <td>
                                        <p class=" text-xxs font-weight-bold mb-0"><?= $e['gap'] ?></p>
                                    </td>
                                    <td style="color: <?= ($e['gap'] >= 0) ? 'green' : 'red'; ?>">
                                        <p class=" text-xxs font-weight-bold mb-0"><?= ($e['gap'] >= 0) ? 'Tidak Perlu Perbaikan' : 'Perlu Perbaikan'; ?></p>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach ?>
                        </table>
                    </div>

                    <div class="text-end mt-4 mb-3">
                        <a href=" <?= base_url() ?>admin/data-evaluasi" class="btn btn-primary mb-0" type="button">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>