<div class="container-fluid py-0 mt-7">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 px-3">
                <div class="row mb-4">
                    <div class="col-6 d-flex align-items-center">
                        <div class="card-header pb-0">
                            <h5>Data Kuesioner</h5>
                        </div>
                    </div>
                    <div class="col-6 pt-4 text-end">
                        <div>
                            <a id="tambahKuesionerBtn" href="<?= base_url() ?>manajer/tambah-kuesioner" class="btn bg-gradient-dark">+ Tambah Kuesioner</a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0" id="example">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">No.</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Judul Kuesioner</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Tanggal Mulai</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Tanggal Selesai</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Di buat oleh</th>
                                    <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">Status Kuesioner</th>
                                    <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">Status Publish</th>
                                    <th style="width: 20%;" class="text-left text-uppercase text-xxs font-weight-bolder opacity-7" data-sortable="false">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 ?>
                                <?php foreach ($kuesioner as $k) : ?>
                                    <tr>
                                        <td>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $no ?></p>
                                        </td>
                                        <td>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $k->judul_kuesioner ?></p>
                                        </td>
                                        <td>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $k->mulai ?></p>
                                        </td>
                                        <td>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $k->selesai ?></p>
                                        </td>
                                        <td>
                                            <?php
                                            $this->db->where('id_pegawai', $k->id_pegawai);
                                            $data = $this->db->get('t_pegawai')->row();
                                            ?>
                                            <p class="ms-3 text-sm font-weight-bold mb-0"><?= $data->nama_lengkap ?></p>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($k->status_kuesioner == '1') : ?>
                                                <span class="badge badge-sm bg-gradient-success">SUDAH SIAP <i class="bi bi-check-lg"></i></span>
                                            <?php elseif ($k->status_kuesioner == '2') : ?>
                                                <span style="cursor: pointer;" class="badge badge-sm bg-gradient-dark" data-bs-toggle="modal" data-bs-target="#modal_detail_pernyataan<?= $k->id_kuesioner ?>"><i class="bi bi-eye-fill"></i> Lihat pernyataan</span>
                                                <!-- <br><span style="cursor: pointer;" class="mt-1 badge badge-sm bg-gradient-dark" data-bs-toggle="modal" data-bs-target="#modal_edit_status_kuesioner<?= $k->id_kuesioner ?>"><i class="bi bi-pencil-square"></i> Edit status</span> -->

                                            <?php else : ?>
                                                <span class="badge badge-sm bg-gradient-danger">BELUM SIAP <i class="bi bi-exclamation-triangle-fill"></i></span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($k->status_publish == '1') : ?>
                                                <span class="badge badge-sm bg-gradient-success">Sudah Publish <i class="bi bi-check-lg"></i></span>
                                            <?php else : ?>
                                                <span class="badge badge-sm bg-gradient-warning">Belum Publish <i class="bi bi-hourglass-split"></i></span>
                                            <?php endif; ?>
                                        </td>

                                        <td class="text-left">
                                            <?php
                                            $timezone = new DateTimeZone('Asia/Jakarta');
                                            $selesai = new DateTime($k->selesai, $timezone);
                                            $sekarang = new DateTime('now', $timezone);
                                            $selesai->modify('+1 day');
                                            ?>

                                            <?php if ($k->status_publish == '0') : ?>
                                                <form action="<?= base_url() ?>manajer/edit-kuesioner" method="post" class="d-inline-block">
                                                    <input type="hidden" name="id_kuesioner" value="<?= $k->id_kuesioner ?>">
                                                    <button type="submit" class="btn btn-link text-dark p-2 mb-0"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</Button>
                                                </form>
                                            <?php endif ?>

                                            <?php if ($sekarang > $selesai) : ?>
                                                <button class="btn btn-link text-danger text-gradient p-2 mb-0" data-bs-toggle="modal" data-bs-target="#modal_hapus_kuesioner<?= $k->id_kuesioner ?>"><i class="far fa-trash-alt me-2" aria-hidden="true"></i>Hapus</button>

                                                <form action="<?= base_url() ?>manajer/jawaban-pelanggan" method="post" class="d-inline-block">
                                                    <input type="hidden" name="id_kuesioner" value="<?= $k->id_kuesioner ?>">
                                                    <button type="submit" class="btn btn-link text-dark p-2 mb-0"><i class="bi bi-person-hearts me-2" aria-hidden="true" disabled></i>Jawaban Pelanggan</button>
                                                </form>
                                                <?php if ($k->status_evaluasi == '0') : ?>
                                                    <form action="<?= base_url() ?>evaluasi/proses_evaluasi_kuesioner" method="post" class="d-inline-block">
                                                        <input type="hidden" name="id_kuesioner" value="<?= $k->id_kuesioner ?>">
                                                        <button type="submit" class="btn btn-link text-dark p-2 mb-0"><i class="bi bi-clipboard-data-fill text-dark me-2" aria-hidden="true"></i>Hitung Kuesioner</Button>
                                                    </form>
                                                <?php endif; ?>
                                            <?php endif ?>

                                            <?php if ($k->status_kuesioner == '0' or $k->status_kuesioner == '2') : ?>
                                                <button class="btn btn-link text-danger text-gradient p-2 mb-0" data-bs-toggle="modal" data-bs-target="#modal_hapus_kuesioner<?= $k->id_kuesioner ?>"><i class="far fa-trash-alt me-2" aria-hidden="true"></i>Hapus</button>
                                            <?php endif ?>

                                            <?php if ($k->status_publish == '0') : ?>
                                                <form id="publishForm<?= $k->id_kuesioner ?>" action="<?= base_url() ?>kuesioner/publish-kuesioner" method="post" class="d-inline-block">
                                                    <input type="hidden" name="id_kuesioner" value="<?= $k->id_kuesioner ?>">
                                                    <button type="submit" class="btn btn-link p-2 mb-0 publishBtn" data-id="<?= $k->id_kuesioner ?>"><i class="bi bi-arrow-right-square-fill me-2" aria-hidden="true"></i>Publish</button>
                                                </form>
                                            <?php endif ?>

                                            <?php if ($k->status_publish == '1' and $k->status_kuesioner == '1' and $sekarang < $selesai) : ?>
                                                <p class="ms-3 text-sm font-weight-bold mb-0">Tidak ada aksi</p>
                                            <?php endif ?>

                                        </td>
                                    </tr>
                                    <?php $no++ ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php foreach ($kuesioner as $km) : ?>
        <!-- Modal Delete Akun -->
        <div class="modal fade" id="modal_hapus_kuesioner<?= $km->id_kuesioner ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Kuesioner</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus Kuesioner Ini?
                    </div>
                    <div class="modal-footer">
                        <form action="<?= base_url() ?>kuesioner/proses_hapus_kuesioner" method="post">
                            <input type="hidden" name="id_kuesioner" value="<?= $km->id_kuesioner ?>">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batalkan</button>
                            <button type="submit" class="btn bg-gradient-primary">Ya</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Detail Pernyataan -->
        <div class="modal fade" id="modal_detail_pernyataan<?= $km->id_kuesioner ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Pernyataan Kuesioner</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php
                        $this->db->where('id_kuesioner', $km->id_kuesioner);
                        $query = $this->db->get('t_detail_kuesioner')->result();
                        ?>
                        <table style="width: 100%; border-collapse: collapse;">
                            <tr>
                                <th style="border: 1px solid #ddd; padding:10px;">No.</th>
                                <th style="border: 1px solid #ddd; padding:10px;">Pernyataan</th>
                                <th style="border: 1px solid #ddd; padding:10px;">Dimensi</th>
                            </tr>
                            <?php $i = 1 ?>
                            <?php foreach ($query as $q) : ?>
                                <?php
                                $this->db->where('id_pernyataan', $q->id_pernyataan);
                                $pernyataan = $this->db->get('t_pernyataan')->row();

                                $this->db->where('id_dimensi', $pernyataan->id_dimensi);
                                $dimensi = $this->db->get('t_dimensi')->row();
                                ?>
                                <tr>
                                    <td style="border: 1px solid #ddd; padding:10px; text-align: center"><?= $i ?></td>
                                    <td style="border: 1px solid #ddd; padding:10px;"><?= $pernyataan->pernyataan ?></td>
                                    <td style="border: 1px solid #ddd; padding:10px;"><?= $dimensi->dimensi ?></td>
                                </tr>
                                <?php $i++ ?>
                            <?php endforeach ?>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Status Disetujui -->
        <div class="modal fade" id="modal_edit_status_kuesioner<?= $km->id_kuesioner ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Status Kuesioner</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <form action="<?= base_url() ?>kuesioner/proses_edit_status_kuesioner" method="post">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" value="1" name="status_kuesioner" id="status_kuesioner1">
                                    <label class="custom-control-label" for="status_kuesioner1">Setuju</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" value="0" name="status_kuesioner" id="status_kuesioner2">
                                    <label class="custom-control-label" for="status_kuesioner2">Belum setuju, kirim ke admin lagi</label>
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_kuesioner" value="<?= $km->id_kuesioner ?>">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batalkan</button>
                        <button type="submit" class="btn bg-gradient-primary">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <?php endforeach; ?>

    <div class="modal fade" id="PublishKuesionerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pesan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Anda belum dapat mempublish kuesioner ini karena belum genap 6 bulan semenjak kuesioner terakhir dibuat! <i class="bi bi-exclamation-circle-fill"></i>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="TambahKuesionerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pesan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Anda belum dapat menambah kuesioner karena belum genap 6 bulan semenjak kuesioner terakhir dibuat! <i class="bi bi-exclamation-circle-fill"></i>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- TOMBOL PERINGATAN PUBLISH -->
    <!-- <script>
        const tanggalTerakhir = <?= json_encode($tanggal_terakhir->selesai) ?>;
        const batasWaktu = new Date(tanggalTerakhir).setMonth(new Date(tanggalTerakhir).getMonth() + 6);

        function cekBatasWaktu() {
            return new Date() < new Date(batasWaktu);
        }

        document.querySelectorAll('.publishBtn').forEach(btn => {
            btn.addEventListener('click', function(event) {
                event.preventDefault();
                const id = this.getAttribute('data-id');
                if (cekBatasWaktu()) {
                    $('#PublishKuesionerModal').modal('show');
                } else {
                    document.getElementById('publishForm' + id).submit();
                }
            });
        });
    </script> -->