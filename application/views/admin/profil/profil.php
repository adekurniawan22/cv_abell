<div class="container-fluid py-0 mt-7">
    <div class="row">
        <div class="col-12">
            <div class="card mb-0">
                <div class="card-body ">
                    <form action="<?= base_url() ?>profil/proses-edit-profil" method="post">
                        <div class="form-group">
                            <label for="nama_lengkap" class="form-control-label">Nama Lengkap</label>
                            <input type="hidden" name="id_pengguna" value="<?= $pengguna->id_pengguna ?>">
                            <input class="form-control" type="text" placeholder="Nama Lengkap" id="nama_lengkap" name="nama_lengkap" value="<?php echo set_value('nama_lengkap', $pengguna->nama_lengkap); ?>">
                            <?= form_error('nama_lengkap', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="username" class="form-control-label">Username</label>
                            <input class="form-control" type="text" placeholder="Username" id="username" name="username" value="<?php echo set_value('username', $pengguna->username); ?>">
                            <?= form_error('username', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-control-label">Password</label>
                            <input class="form-control" type="password" placeholder="Masukkan Password Lama" id="password_lama" name="password_lama" value="<?php echo set_value('password_lama'); ?>">
                            <?= form_error('password_lama', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                            <input class="form-control mt-3" type="password" placeholder="Masukkan Password Baru" id="password_baru" name="password_baru" value="<?php echo set_value('password_baru'); ?>">
                            <?= form_error('password_baru', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                            <input class="form-control mt-3" type="password" placeholder="Masukkan Konfirmasi Password Baru" id="konfirmasi_password" name="konfirmasi_password" value="<?php echo set_value('konfirmasi_password'); ?>">
                            <?= form_error('konfirmasi_password', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-control-label">Email</label>
                            <input class="form-control" type="text" placeholder="Email" id="email" name="email" value="<?php echo set_value('email', $pengguna->email); ?>">
                            <?= form_error('email', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="no_hp" class="form-control-label">Nomor HP</label>
                            <input class="form-control" type="text" placeholder="Nomor HP" id="no_hp" name="no_hp" value="<?php echo set_value('no_hp', $pengguna->no_hp); ?>">
                            <?= form_error('no_hp', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="form-control-label">Alamat</label>
                            <textarea class="form-control" placeholder="Alamat" id="alamat" name="alamat" rows="3"><?php echo set_value('alamat', $pengguna->alamat); ?></textarea>
                            <?= form_error('alamat', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="lokasi" class="form-control-label">Lokasi</label>
                            <select class="form-select" aria-label="Default select example" name="lokasi" id="lokasi">
                                <option value="" selected>Pilih Lokasi</option>
                                <option value="Bandung" <?php echo set_select('lokasi', "Bandung", $pengguna->lokasi == "Bandung"); ?>>Bandung</option>
                                <option value="Jakarta" <?php echo set_select('lokasi', "Jakarta", $pengguna->lokasi == "Jakarta"); ?>>Jakarta</option>
                                <option value="Surabaya" <?php echo set_select('lokasi', "Surabaya", $pengguna->lokasi == "Surabaya"); ?>>Surabaya</option>
                            </select>
                            <?= form_error('lokasi', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                        </div>
                        <div class="text-end mt-4">
                            <button class="btn btn-primary mb-0" type="submit">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>