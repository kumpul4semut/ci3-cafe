<div class="container">
    <div class="row mt-5">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Pembayaran
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
                    <form action="<?= base_url('home/bayar') ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nama_pelanggan">Tanggal Pemesanan</label>
                            <input type="text" class="form-control" id="nama_pelanggan" placeholder="Nama pelanggan" name="tgl_pemesanan" value="<?= $this->session->tgl_pemesanan ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_pelanggan">Jam Pesan</label>
                            <input type="text" class="form-control" id="nama_pelanggan" placeholder="Nama pelanggan" name="jam_pesan" value="<?= $this->session->jam_pesan ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Meja</label>
                            <select name="id_meja" id="" class="form-control">
                                <option value="<?= $meja_select->id_meja ?>" selected><?= $meja_select->nama_meja ?></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama_pelanggan">Pembayaran</label>
                            <input type="text" class="form-control" id="nama_pelanggan" placeholder="Nama pelanggan" name="total_bayar" value="Transfer melalui rekening <?php echo $profile->rekening ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="nama_pelanggan">Total Bayar</label>
                            <input type="text" class="form-control" id="nama_pelanggan" placeholder="Nama pelanggan" name="total_bayar" value="<?= rp_format($total_bayar) ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label>Menu Dipilih</label>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="padding: 10px;">Nama menu</th>
                                        <th style="padding: 10px;">Jumlah Pesanan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($daftar_menu as $data) : ?>
                                        <tr>
                                            <td>
                                                <p><?php echo ($data->nama_menu . ' | ' . rp_format($data->harga) . ' | Tersedia ' . $data->stok . ' stok') ?></p>
                                            </td>
                                            <td>
                                                <p><?php echo $data->jumlah ?></p>
                                            </td>
                                        </tr>

                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="form-group">
                            <label for="nama_pelanggan">Nama Pelanggan</label>
                            <input type="text" class="form-control" placeholder="Nama Pelanggan" name="nama_pelanggan" oninvalid="this.setCustomValidity('Form Ini Harus Di isi')" onchange="this.setCustomValidity('')" required>
                        </div>

                        <div class="form-group">
                            <label for="nama_pelanggan">Email</label>
                            <input type="email" class="form-control" placeholder="email" name="email" oninvalid="this.setCustomValidity('Form Ini Harus Di isi')" onchange="this.setCustomValidity('')" required>
                        </div>

                        <div class="form-group">
                            <label for="nama_pelanggan">Nomor Telepon</label>
                            <input type="text" class="form-control" placeholder="Nomor Telepon" name="no_tlp" oninvalid="this.setCustomValidity('Form Ini Harus Di isi')" onchange="this.setCustomValidity('')" required>
                        </div>

                        <!-- <div class="form-group">
                            <label for="nama_pelanggan">Jumlah Bayar</label>
                            <input type="text" class="form-control" placeholder="Jumlah Bayar" name="jumlah_bayar" oninvalid="this.setCustomValidity('Form Ini Harus Di isi')" onchange="this.setCustomValidity('')" required>
                        </div> -->

                        <div class="form-group">
                            <label for="nama_pelanggan">Upload Bukti Transfer</label>
                            <input type="file" class="form-control" name="upload_bukti" oninvalid="this.setCustomValidity('Form Ini Harus Di isi')" onchange="this.setCustomValidity('')" required>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-4">
                                    <label for="">Captcha</label>
                                    <p id="Captcha-image"><?php echo $img; ?></p>
                                    <button type="button" class="btn btn-primary" onclick="getNewCaptcha();"><i class="fa fa-refresh text-white"></i></button>
                                </div>
                                <div class="col-sm-4">
                                    <label for="">Masukan kode Captcha</label>
                                    <input type="text" class="form-control" name="secutity_code" oninvalid="this.setCustomValidity('Form Ini Harus Di isi')" onchange="this.setCustomValidity('')" required>
                                </div>
                            </div>
                        </div>
                        <center><button type="submit" class="btn btn-primary mt-4">Simpan</button></center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>