<div class="container-fluid py-0 mt-7">
    <div class="row">
        <div class="col-12">
            <div class="card mb-0">
                <div class="card-body ">
                    <form action="<?= base_url() ?>admin/proses-tambah-kuesioner" method="post">
                        <div class="form-group">
                            <label for="judul_kuesioner" class="form-control-label">Judul Kuesioner</label>
                            <input class="form-control" type="text" placeholder="Judul Kuesioner" id="judul_kuesioner" name="judul_kuesioner" required oninvalid="this.setCustomValidity('Harap isi judul kesioner ini.')" oninput="setCustomValidity('')">
                        </div>

                        <!-- Container untuk input pernyataan -->
                        <div id="container-pernyataan">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-9">
                                        <label for="pernyataan" class="form-control-label">Pernyataan 1</label>
                                        <input class="form-control" type="text" placeholder="Pernyataan 1" id="pernyataan" name="pernyataan[]" required oninvalid="this.setCustomValidity('Harap isi pernyataan ini.')" oninput="setCustomValidity('')">
                                    </div>
                                    <div class="col-3">
                                        <label for="dimensi" class="form-control-label">Dimensi</label>
                                        <select class="form-select" aria-label="Default select example" name="dimensi[]" id="dimensi" required oninvalid="this.setCustomValidity('Harap isi dimensi ini.')" oninput="setCustomValidity('')">
                                            <option value="" selected>Pilih Dimensi</option>
                                            <?php foreach ($dimensi as $d) : ?>
                                                <option value=" <?= $d->id_dimensi ?>"><?= $d->dimensi ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success mb-2" type="button" onclick="tambahPernyataan()">+ Tambah Pernyataan</button>


                        <div class="text-end mt-4">
                            <a href=" <?= base_url() ?>admin/data-kuesioner" class="btn btn-primary mb-0" type="button">Kembali</a>
                            <button class="btn btn-primary mb-0" type="submit">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let counter = 1; // Digunakan untuk menghitung jumlah input pertanyaan

        function tambahPernyataan() {
            counter++; // Tambah counter

            // Buat elemen input pertanyaan baru
            let newInput = document.createElement('div');
            newInput.innerHTML = `
            <div class="form-group">
                <div class="row">
                    <div class="col-9">
                        <label for="pernyataan" class="form-control-label">Pernyataan ${counter}</label>
                        <input class="form-control" type="text" placeholder="Pernyataan ${counter}" id="pernyataan" name="pernyataan[]" required oninvalid="this.setCustomValidity('Harap isi pernyataan ini.')" oninput="setCustomValidity('')">
                    </div>
                    <div class="col-3">
                        <label for="dimensi" class="form-control-label">Dimensi</label>
                        <select class="form-select" aria-label="Default select example" name="dimensi[]" id="dimensi" required oninvalid="this.setCustomValidity('Harap isi dimensi ini.')" oninput="setCustomValidity('')">
                            <option value="" selected>Pilih Dimensi</option>
                            <?php foreach ($dimensi as $d) : ?>
                                <option value=" <?= $d->id_dimensi ?>"><?= $d->dimensi ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
`;

            // Tambahkan elemen input pertanyaan ke dalam container
            document.getElementById('container-pernyataan').appendChild(newInput);
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Get the date input elements
            var mulaiInput = document.getElementById('mulai');
            var selesaiInput = document.getElementById('selesai');
            var error = document.getElementById('errorMessage');

            function validateDates() {
                var mulaiValue = new Date(mulaiInput.value);
                var selesaiValue = new Date(selesaiInput.value);

                // Check if the end date is before the start date
                if (selesaiValue < mulaiValue) {
                    selesaiInput.setCustomValidity('Tanggal selesai tidak boleh melewati tanggal mulai.');
                    error.style.display = 'block'
                } else {
                    selesaiInput.setCustomValidity('');
                    error.style.display = 'none'
                }
            }

            // Initial validation
            validateDates();

            // Add event listeners for input change
            mulaiInput.addEventListener('input', validateDates);
            selesaiInput.addEventListener('input', validateDates);
        });
    </script>