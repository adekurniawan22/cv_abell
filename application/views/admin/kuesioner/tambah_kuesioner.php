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
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="mulai" class="form-control-label">Tanggal Mulai Kuesioner</label>
                                    <input class="form-control" type="date" id="mulai" name="mulai" required oninvalid="this.setCustomValidity('Harap isi tanggal mulai kuesioner ini.')" oninput="setCustomValidity('')">
                                </div>
                                <div class="col-6">
                                    <label for="selesai" class="form-control-label">Tanggal Selesai Kuesioner</label>
                                    <input class="form-control" type="date" id="selesai" name="selesai" required oninvalid="this.setCustomValidity('Harap isi tanggal selesai kuesioner ini.')" oninput="setCustomValidity('')">
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal bg-dark mt-4">

                        <!-- Container untuk input pernyataan -->
                        <div id="container-pernyataan">
                            <div class="form-group">
                                <label for="pernyataan" class="form-control-label">Pernyataan 1</label>
                                <input class="form-control" type="text" placeholder="Pernyataan 1" id="pernyataan" name="pernyataan[]" required oninvalid="this.setCustomValidity('Harap isi pernyataan ini.')" oninput="setCustomValidity('')">
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
                            <label for="pernyataan" class="form-control-label">Pernyataan ${counter}</label>
                            <input class="form-control" type="text" placeholder="Pernyataan ${counter}" id="pernyataan" name="pernyataan[]" required oninvalid="this.setCustomValidity('Harap isi pertanyaan ini.')" oninput="setCustomValidity('')">
                            <?= form_error('pernyataan[]', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                        </div>
        `;

            // Tambahkan elemen input pertanyaan ke dalam container
            document.getElementById('container-pernyataan').appendChild(newInput);
        }
    </script>