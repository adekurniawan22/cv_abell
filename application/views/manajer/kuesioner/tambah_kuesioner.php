<div class="container-fluid py-0 mt-7">
    <div class="row">
        <div class="col-12">
            <div class="card mb-0">
                <div class="card-body ">
                    <form action="<?= base_url() ?>manajer/proses-tambah-kuesioner" method="post">
                        <div class="form-group">
                            <label for="judul_kuesioner" class="form-control-label">Judul Kuesioner</label>
                            <input class="form-control" type="text" placeholder="Judul Kuesioner" id="judul_kuesioner" name="judul_kuesioner" value="<?php echo set_value('judul_kuesioner'); ?>">
                            <?= form_error('judul_kuesioner', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="mulai" class="form-control-label">Tanggal Mulai Kuesioner <em id="textTujuh">(tanggal selesai 7 hari setelah tanggal dimulai)</em></label>
                            <input class="form-control" type="date" id="mulai" name="mulai" value="<?php echo set_value('mulai'); ?>">
                            <?= form_error('mulai', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                            <?= form_error('selesai', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="toggleSelesai" onchange="toggleTanggalSelesai(this)">
                            <label class="custom-control-label" for="customCheck1">Ubah tanggal selesai?</label>
                        </div>

                        <div class="form-group" id="tanggalSelesai" style="display: none;">
                            <label for="selesai" class="form-control-label">Tanggal Selesai Kuesioner</label>
                            <input class="form-control" type="date" id="selesai" name="selesai">
                        </div>

                        <div class="text-end mt-4">
                            <a href=" <?= base_url() ?>manajer/data-kuesioner" class="btn btn-primary mb-0" type="button">Kembali</a>
                            <button class="btn btn-primary mb-0" type="submit">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleTanggalSelesai(checkbox) {
            var selesaiInput = document.getElementById("tanggalSelesai");
            var textTujuh = document.getElementById("textTujuh");
            if (checkbox.checked) {
                textTujuh.style.display = "none";
                selesaiInput.style.display = "block";
                selesaiInput.setAttribute("required", true);
            } else {
                textTujuh.style.display = "inline-block";
                selesaiInput.style.display = "none";
                selesaiInput.removeAttribute("required");
            }
        }
    </script>