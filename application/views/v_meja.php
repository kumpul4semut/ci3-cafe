<div class="container">
    <div class="row mt-5">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Menu Pemesanan
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
                    <form action="<?= base_url('home/checkout') ?>" method="POST">
                        <div class="form-group">
                            <label for="nama_pelanggan">Tanggal Pemesanan</label>
                            <input type="text" class="form-control" id="nama_pelanggan" placeholder="Nama pelanggan" name="tgl_pemesanan" value="<?= $tgl_pemesanan ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_pelanggan">Jam Pesan</label>
                            <input type="text" class="form-control" id="nama_pelanggan" placeholder="Nama pelanggan" name="jam_pesan" value="<?= $jam_pesan ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Meja</label>
                            <select class="form-control" name="id_meja" oninvalid="this.setCustomValidity('Form Ini Harus Di isi')" onchange="this.setCustomValidity('')" required>
                                <option value="">Pilih</option>
                                <?php foreach ($meja as $data) : ?>
                                    <?php if (isset($data->terbooking)) : ?>
                                        <option value="<?php echo $data->id_meja ?>" disabled><?php echo $data->nama_meja ?> ( Terbooking )</option>
                                    <?php else : ?>
                                        <option value="<?php echo $data->id_meja ?>"><?php echo $data->nama_meja ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Pilih Menu</label>
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
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="menu[]" value="<?php echo $data->id_menu ?>" onclick="onSelectMenu(<?php echo $data->id_menu ?>)"> <?php echo ($data->nama_menu . ' | ' . rp_format($data->harga) . ' | Tersedia ' . $data->stok . ' stok') ?>
                                                    </label>

                                                </div>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" placeholder="Jumlah" name="jumlah_<?php echo $data->id_menu ?>" oninvalid="this.setCustomValidity('Form Ini Harus Di isi')" onchange="this.setCustomValidity('')" id="input-jumlah">
                                            </td>
                                        </tr>

                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <center><button type="submit" class="btn btn-primary mt-4" id="pilih-meja">Lanjut</button></center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>