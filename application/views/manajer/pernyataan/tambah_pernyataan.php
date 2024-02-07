<div class="container-fluid py-0 mt-7">
    <div class="row">
        <div class="col-12">
            <div class="card mb-0">
                <div class="card-body ">
                    <form action="<?= base_url() ?>manajer/proses-tambah-pernyataan" method="post">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="id_dimensi" class="form-control-label">Dimensi</label>
                                    <select class="form-select" aria-label="Default select example" name="id_dimensi" id="id_dimensi">
                                        <option value="" selected>Pilih Dimensi</option>
                                        <?php foreach ($dimensi as $d) : ?>
                                            <option value="<?= $d->id_dimensi ?>" <?php echo set_select('id_dimensi', $d->id_dimensi); ?>> <?= $d->dimensi ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <?= form_error('id_dimensi', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="pernyataan" class="form-control-label">Pernyataan</label>
                                    <textarea class="form-control" name="pernyataan" id="pernyataan" rows="3"><?php echo set_value('pernyataan'); ?></textarea>
                                    <?= form_error('pernyataan', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="rekomendasi_perbaikan" class="form-control-label">Rekomendasi Perbaikan</label>
                                    <textarea class="form-control" name="rekomendasi_perbaikan" id="rekomendasi_perbaikan" rows="3"><?php echo set_value('rekomendasi_perbaikan'); ?></textarea>
                                    <?= form_error('rekomendasi_perbaikan', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="text-end mt-4">
                            <a href=" <?= base_url() ?>manajer/data-pernyataan" class="btn btn-primary mb-0" type="button">Kembali</a>
                            <button class="btn btn-primary mb-0" type="submit">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>