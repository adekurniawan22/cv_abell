<div class="container-fluid py-0 mt-7">
    <div class="row">
        <div class="col-12">
            <div class="card mb-0">
                <div class="card-body ">
                    <form action="<?= base_url() ?>manajer/proses-tambah-pengguna" method="post">
                        <div class="form-group">
                            <label for="nama_lengkap" class="form-control-label">Nama Lengkap</label>
                            <input class="form-control" type="text" placeholder="Nama Lengkap" id="nama_lengkap" name="nama_lengkap" value="<?php echo set_value('nama_lengkap'); ?>">
                            <?= form_error('nama_lengkap', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="username" class="form-control-label">Username</label>
                            <input class="form-control" type="text" placeholder="Username" id="username" name="username" value="<?php echo set_value('username'); ?>">
                            <?= form_error('username', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-control-label">Email</label>
                            <input class="form-control" type="text" placeholder="Email" id="email" name="email" value="<?php echo set_value('email'); ?>">
                            <?= form_error('email', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-control-label">Password</label>
                            <input class="form-control" type="password" placeholder="Password" id="password" name="password" value="<?php echo set_value('password'); ?>">
                            <?= form_error('password', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="no_hp" class="form-control-label">Nomor HP</label>
                            <input class="form-control" type="text" placeholder="Nomor HP" id="no_hp" name="no_hp" value="<?php echo set_value('no_hp'); ?>">
                            <?= form_error('no_hp', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="role" class="form-control-label">Role</label>
                            <select class="form-select" aria-label="Default select example" name="role" id="role">
                                <option value="" selected>Pilih Role</option>
                                <?php foreach ($role as $r) : ?>
                                    <option value="<?= $r->id_role ?>" <?php echo set_select('role', $r->id_role); ?>><?= $r->nama_role ?></option>
                                <?php endforeach ?>
                            </select>
                            <?= form_error('role', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="form-control-label">Alamat</label>
                            <textarea class="form-control" placeholder="Alamat" id="alamat" name="alamat" rows="3"><?php echo set_value('alamat'); ?></textarea>
                            <?= form_error('alamat', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="lokasi" class="form-control-label">Lokasi Pemasangan</label>
                            <select class="form-select" aria-label="Default select example" name="lokasi" id="lokasi">
                                <option value="" selected>Pilih Lokasi</option>
                                <option value="PPPoE Tirtamulya R1" <?php echo set_select('lokasi', "PPPoE Tirtamulya R1"); ?>>PPPoE Tirtamulya R1</option>
                                <option value="PPPoE AbelNet" <?php echo set_select('lokasi', "PPPoE AbelNet"); ?>>PPPoE AbelNet</option>
                                <option value="PPPoE OLT KJ" <?php echo set_select('lokasi', "PPPoE OLT KJ"); ?>>PPPoE OLT KJ</option>
                                <option value="PPPoE OLT CITARIK" <?php echo set_select('lokasi', "PPPoE OLT CITARIK"); ?>>PPPoE OLT CITARIK</option>
                                <option value="PPPoE CIAMPEL" <?php echo set_select('lokasi', "PPPoE CIAMPEL"); ?>>PPPoE CIAMPEL</option>
                            </select>
                            <?= form_error('lokasi', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                        </div>
                        <div class="text-end mt-4">
                            <a href=" <?= base_url() ?>manajer/data-pengguna" class="btn btn-primary mb-0" type="button">Kembali</a>
                            <button class="btn btn-primary mb-0" type="submit">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>