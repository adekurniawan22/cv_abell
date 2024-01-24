<div class="container-fluid py-0 mt-7">
    <div class="row">
        <div class="col-12">
            <div class="card mb-0">
                <div class="card-body ">
                    <form action="<?= base_url() ?>manajer/proses-edit-lokasi-server" method="post">
                        <div class="form-group">
                            <label for="lokasi_server" class="form-control-label">Nama Lokasi Server</label>
                            <input type="hidden" name="id_lokasi_server" value="<?= $lokasi_server->id_lokasi_server ?>">
                            <input class="form-control" type="text" placeholder="Nama Lokasi Server" id="lokasi_server" name="lokasi_server" value="<?php echo set_value('lokasi_server', $lokasi_server->lokasi_server); ?>">
                            <?= form_error('lokasi_server', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                        </div>

                        <div class="text-end mt-4">
                            <a href=" <?= base_url() ?>manajer/data-lokasi-server" class="btn btn-primary mb-0" type="button">Kembali</a>
                            <button class="btn btn-primary mb-0" type="submit">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>