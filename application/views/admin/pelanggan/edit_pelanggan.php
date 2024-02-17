<div class="container-fluid py-0 mt-7">
    <div class="row">
        <div class="col-12">
            <div class="card mb-0">
                <div class="card-body ">
                    <form action="<?= base_url() ?>admin/proses-edit-pelanggan" method="post">
                        <div class="form-group">
                            <label for="foto" class="form-control-label">Status Aktif</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" name="status_aktif" type="checkbox" id="flexSwitchCheckDefault" <?php echo ($pelanggan->status_aktif == '1') ? 'checked' : ''; ?>>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_lengkap" class="form-control-label">Nama Lengkap</label>
                            <input type="hidden" name="id_pelanggan" value="<?= $pelanggan->id_pelanggan ?>">
                            <input class="form-control" type="text" placeholder="Nama Lengkap" id="nama_lengkap" name="nama_lengkap" value="<?php echo set_value('nama_lengkap', $pelanggan->nama_lengkap); ?>">
                            <?= form_error('nama_lengkap', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="no_hp" class="form-control-label">Nomor HP</label>
                            <input class="form-control" type="text" placeholder="Nomor HP" id="no_hp" name="no_hp" value="<?php echo set_value('no_hp', $pelanggan->no_hp); ?>">
                            <?= form_error('no_hp', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="form-control-label">Alamat</label>
                            <textarea class="form-control" placeholder="Alamat" id="alamat" name="alamat" rows="3"><?php echo set_value('alamat', $pelanggan->alamat); ?></textarea>
                            <?= form_error('alamat', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                        </div>
                        <div class="form-group"">
                            <label for=" lokasi_server" class="form-control-label">Lokasi Pemasangan</label>
                            <select class="form-select" aria-label="Default select example" name="lokasi_server" id="lokasi_server">
                                <option value="" selected>Pilih Lokasi</option>
                                <?php foreach ($lokasi as $l) : ?>
                                    <option value="<?= $l->id_lokasi_server ?>" <?php echo set_select('lokasi_server', $l->id_lokasi_server, $pelanggan->lokasi_server == $l->id_lokasi_server); ?>><?= $l->lokasi_server ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('lokasi_server', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="mulai_berlangganan" class="form-control-label">Tanggal Mulai Berlangganan</label>
                            <input class="form-control" type="date" placeholder="Tanggal Mulai Berlangganan" id="mulai_berlangganan" name="mulai_berlangganan" value="<?php echo set_value('mulai_berlangganan', $pelanggan->mulai_berlangganan); ?>">
                            <?= form_error('mulai_berlangganan', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                        </div>
                        <div class="text-end mt-4">
                            <a href=" <?= base_url() ?>admin/data-pelanggan" class="btn btn-primary mb-0" type="button">Kembali</a>
                            <button class="btn btn-primary mb-0" type="submit">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>