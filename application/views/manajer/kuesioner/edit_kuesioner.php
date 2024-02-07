<div class="container-fluid py-0 mt-7">
    <div class="row">
        <div class="col-12">
            <div class="card mb-0">
                <div class="card-body ">
                    <form action="<?= base_url() ?>manajer/proses-edit-kuesioner" method="post">
                        <input type="hidden" name="id_kuesioner" value="<?= $kuesioner->id_kuesioner ?>">
                        <div class="form-group">
                            <label for="judul_kuesioner" class="form-control-label">Judul Kuesioner</label>
                            <input class="form-control" type="text" placeholder="Judul Kuesioner" id="judul_kuesioner" name="judul_kuesioner" value="<?php echo set_value('judul_kuesioner', $kuesioner->judul_kuesioner); ?>">
                            <?= form_error('judul_kuesioner', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="mulai" class="form-control-label">Tanggal Mulai Kuesioner</label>
                            <input class="form-control" type="date" id="mulai" name="mulai" value="<?php echo set_value('mulai', $kuesioner->mulai); ?>">
                            <?= form_error('mulai', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="selesai" class="form-control-label">Tanggal Selesai Kuesioner</label>
                            <input class="form-control" type="date" id="selesai" name="selesai" value="<?php echo set_value('selesai', $kuesioner->selesai); ?>">
                            <?= form_error('selesai', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                        </div>

                        <div class="text-end mt-4">
                            <a href=" <?= base_url() ?>manajer/data-kuesioner" class="btn btn-primary mb-0" type="button">Kembali</a>
                            <button class="btn btn-primary mb-0" type="submit">edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>