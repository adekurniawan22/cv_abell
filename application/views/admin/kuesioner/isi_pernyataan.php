<div class="container-fluid py-0 mt-7">
    <div class="row">
        <div class="col-12">
            <div class="card mb-0">
                <div class="card-body ">
                    <form action="<?= base_url() ?>kuesioner/proses-isi-pernyataan" method="post">
                        <div class="ms-3">
                            <h3><?= $kuesioner->judul_kuesioner ?></h3>
                            <span>Tanggal Mulai : <?= $kuesioner->mulai ?></span><br>
                            <span>Tanggal Selesai : <?= $kuesioner->selesai ?></span><br>
                            <?= form_error('pilih_pernyataan[]', '<p style="font-size: 20px;color: red;" class="my-2">', '</p>'); ?>
                        </div>
                        <input type="hidden" name="id_kuesioner" value="<?= $kuesioner->id_kuesioner ?>">
                        <table class="table align-items-center mb-0 mt-3">
                            <thead>
                                <tr>
                                    <th style="width: 5%;" class="text-uppercase text-xxs font-weight-bolder opacity-7">No.</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Dimensi</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Pernyataan</th>
                                    <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">
                                        <div class="d-flex align-items-center justify-content-center">
                                            Checklist
                                            <input type="checkbox" class="ms-2" id="checkAllBtn">
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $this->db->where('id_kuesioner', $kuesioner->id_kuesioner);
                                $detail_kuesioner = $this->db->get('t_detail_kuesioner')->result();
                                ?>
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
                                        <td>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $p->pernyataan ?></p>
                                        </td>
                                        <td class="text-center ">
                                            <?php
                                            $checked_pernyataan = array_column($detail_kuesioner, 'id_pernyataan');
                                            ?>
                                            <input type="checkbox" class="text-center checkbox" name="pilih_pernyataan[]" value="<?= $p->id_pernyataan ?>" <?php if (in_array($p->id_pernyataan, $checked_pernyataan)) : echo 'checked' ?> <?php endif; ?>>
                                        </td>
                                    </tr>
                                    <?php $no++ ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <div class="text-end mt-4">
                            <a href=" <?= base_url() ?>admin/data-kuesioner" class="btn btn-primary mb-0" type="button">Kembali</a>
                            <button class="btn btn-primary mb-0" type="submit">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk menandai atau menghapus tanda semua checkbox
    function toggleCheckboxes(checked) {
        var checkboxes = document.querySelectorAll('.checkbox');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = checked;
        });
    }

    // Tangani klik tombol "Check All"
    document.getElementById('checkAllBtn').addEventListener('click', function() {
        var isChecked = this.checked;
        toggleCheckboxes(isChecked); // Menandai semua checkbox
    });
</script>