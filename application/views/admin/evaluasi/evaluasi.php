<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
</head>

<style>
    .table {
        border-collapse: collapse;
        width: 80%;
    }

    .table th,
    .table td {
        border: 1px solid black;
        padding: 10px;
    }
</style>

<body>
    <div class="container">
        <h3>Evaluasi</h3>
        <p>Total Responden : <?= $total_responden ?> orang</p>
        <p>Total Seluruh Pelanggan : <?= $jumlah_pelanggan ?> orang</p>
        <?php $persentase_mengisi = ($total_responden / $jumlah_pelanggan) * 100; ?>
        <p>Persentase pelanggan yang mengisi: <?= $persentase_mengisi ?>%</p>
        <table class="table">
            <tr>
                <th>No.</th>
                <th style="text-align: left;">Pernyataan</th>
                <th>Total Presepsi</th>
                <th>Total Ekspetasi</th>
                <th>Nilai MIS</th>
                <th>Nilai MSS</th>
                <th>Nilai WF (%)</th>
                <th>Nilai WS</th>
                <th>Nilai CSI</th>
                <th>Kriteria Nilai CSI</th>
                <th>Nilai GAP</th>
                <th>Rekomendasi Perbaikan</th>
            </tr>
            <?php $i = 0; ?>
            <?php foreach ($pernyataan as $p) : ?>
                <tr style="text-align: center;">
                    <td><?= $i + 1 ?></td>
                    <td style="text-align: left;"><?= $p->pernyataan ?></td>
                    <td><?= $total_ekspetasi[$i] ?></td>
                    <td><?= $total_presepsi[$i] ?></td>
                    <td><?= $nilai_mis[$i] ?></td>
                    <td><?= $nilai_mss[$i] ?></td>
                    <td><?= $nilai_wf[$i] ?></td>
                    <td><?= $nilai_ws[$i] ?></td>
                    <?php if ($i == 0) : ?>
                        <td rowspan="15"><?= $nilai_csi ?></td>
                        <td rowspan="15"><?= $kriteria_nilai_csi ?></td>
                    <?php endif; ?>
                    <td><?= $nilai_gap[$i] ?></td>
                    <td style="color: <?= ($nilai_gap[$i] >= 0) ? 'green' : 'red'; ?>">
                        <?= ($nilai_gap[$i] >= 0) ? 'Tidak Perlu Perbaikan' : 'Perlu Perbaikan'; ?>
                    </td>

                </tr>
                <?php $i++; ?>
            <?php endforeach ?>
        </table>
    </div>

</body>

</html>