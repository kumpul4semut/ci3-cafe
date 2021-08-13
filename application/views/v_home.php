<div class="home">
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Cari Jadwal
                    </div>
                    <div class="card-body">
                        <?php echo validation_errors('<div id="notifikasi" class="alert alert-danger rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong> Error! </strong> ', '</div>'); ?>
                        <?php if ($this->session->flashdata('sukses')) : ?>
                            <div id="notifikasi" class="alert alert-success rounded-md px-5 py-4 mb-2 bg-theme-9 text-white">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Sukses! </strong> <?= $this->session->flashdata('sukses'); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($this->session->flashdata('error')) : ?>
                            <div id="notifikasi" class="alert alert-danger rounded-md px-5 py-4 mb-2 bg-theme-9 text-white">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Error! </strong> <?= $this->session->flashdata('error'); ?>
                            </div>
                        <?php endif; ?>
                        <form action="<?= base_url('home/cari_jadwal') ?>" method="POST">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" class="form-control" placeholder="Tanggal" name="tgl_pemesanan" oninvalid="this.setCustomValidity('Form Ini Harus Di isi')" onchange="this.setCustomValidity('')" required>
                                    </div>

                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="jam">Jam Booking</label>
                                        <input type="time" class="form-control" id="jam" placeholder="Nomor telepon" name="jam_pesan" oninvalid="this.setCustomValidity('Form Ini Harus Di isi')" onchange="this.setCustomValidity('')" required>
                                    </div>

                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-primary mt-4">Cari jadwal</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>