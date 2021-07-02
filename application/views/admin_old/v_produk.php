		
		<div class="box">
				<!-- /.box-header -->
				<div class="box-body">
				<?php $data=$this->session->flashdata('sukses'); 
				if($data!=""){ ?>
				<div id="notifikasi" class="alert alert-success rounded-md px-5 py-4 mb-2 bg-theme-9 text-white">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Sukses! </strong> <?=$data;?>
				</div>

				<?php } ?>
				<?php 
				$data2=$this->session->flashdata('error');
				if($data2!=""){ ?>
		
				<div id="notifikasi" class="alert alert-danger rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong> Error! </strong> <?=$data2;?>
				</div>
				<?php } ?>

				</div>
				</div>

		<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                        Data Produk
                    </h2>
                     <a href="" class="ml-auto flex text-theme-1"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> </a>
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">

                      

                       	
                    </div>
                </div>
				
                <!-- BEGIN: Datatable -->
                <div class="intro-y datatable-wrapper box p-5 mt-5">
                    <table class="table table-report table-report--bordered display datatable w-full">
                        <thead>
                            <tr>
                                <th class="border-b-2 whitespace-no-wrap">No.</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Kode</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Nama Produk</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Gambar</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Harga Pembelian</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Harga Penjualan</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Harga Per pcs</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Stok</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
							<?php
							$no = 1;
							foreach ($produk as $data){ 
							?>
                            <tr>
                                
                                <td class="text-center border-b">
                                    <?php echo $no++; ?>
                                </td>
                                <td class="text-center border-b">
                                    <?php echo $data->kode_produk ?>
                                </td>
                                <td class="text-center border-b">
                                    <?php echo $data->nama_produk ?>
                                </td>
                                 <td class="text-center border-b">
                                    <img src="<?php echo base_url().'uploads/gambar_psales/'.$data->gambar_produk; ?>" width="200" height="50" alt="gambar tidak ada">
                                </td>
                                 <td class="text-center border-b">
                                    Rp. <?php echo number_format($data->hargapem,'0','.','.') ?>
                                </td>
                                <td class="text-center border-b">
                                	Rp. <?php echo number_format($data->hargapen,'0','.','.') ?>
                                 
                                </td>
                                 <td class="text-center border-b">

                                	<?php if (empty($data->hargapcs)) {

                                		echo "Data tidak ada";
                                		}

                                		else {

                                			echo "Rp.".number_format($data->hargapcs,'0','.','.');

                                		}
                                		# code...
                                	  ?>
                                 
                                </td>
                                <td class="text-center border-b">
                                    <?php echo $data->stok ?> (<?php echo $data->satuan ?>)
                                </td>
                              
                               
                                <td class="border-b w-5">
                                    <div class="flex sm:justify-center items-center">
                                    	  <a type="button" data-toggle="modal" data-target="#modal-edit<?=$data->id_produk;?>" class="flex items-center mr-3" style="cursor: pointer;"><i data-feather="check-square" class="w-4 h-4 mr-1"></i> Ubah</a>
                                       
                                        <a class="flex items-center text-theme-6" href="<?php echo site_url('admin/produk/hapus_produk/'.$data->id_produk); ?>" onclick="return confirm('Apakah Anda Ingin Menghapus Data <?=$data->nama_produk;?> ?');" class="btn btn-danger btn-circle" data-popup="tooltip" data-placement="top" title="Hapus Data"> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Hapus </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- END: Datatable -->



                <!-- Produk modal -->

			


			<?php $no=0; foreach($produk as $data): $no++; ?>
			<div class="modal fade" id="modal-edit<?=$data->id_produk;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			    <div class="modal__content modal__content--lg p-10">

				
				<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                        <h2 class="font-medium text-base mr-auto">
                          	Ubah Produk
                        </h2>
                                                
                	</div>

                <form action="<?php echo base_url()?>admin/produk/edit_produk" method="POST" enctype="multipart/form-data" oninput="hargapcs.value=parseFloat(a.value)/parseFloat(b.value)">
                
                <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">

                	<input type="hidden" name="id_produk" value="<?=$data->id_produk;?>" class="input w-full border mt-2 flex-1" value="<?=$data->id_produk;?>" readonly>

				<div class="col-span-12 sm:col-span-6">
				<label align="left">Kode :</label>
				<input type="text" name="kode_produk" class="input w-full border mt-2 flex-1" value="<?=$data->kode_produk;?>" readonly>
				</div>

				<div class="col-span-12 sm:col-span-6">
				<label align="left">Nama Produk :</label>
				<input type="text" name="nama_produk" value="<?=$data->nama_produk;?>" class="input w-full border mt-2 flex-1" placeholder="Masukkan Nama Produk" required>
				</div>

				<div class="col-span-12 sm:col-span-6">
				<label align="left">Harga Pembelian :</label>
				<input type="number" name="hargapem" value="<?=$data->hargapem;?>" class="input w-full border mt-2 flex-1" placeholder="Masukkan Harga Pembelian" required>
				</div>

				<div class="col-span-12 sm:col-span-6">
				<label align="left">Harga Penjualan :</label>
				<input type="number" name="hargapen" value="<?=$data->hargapen;?>" id="a" class="input w-full border mt-2 flex-1" placeholder="Masukkan Harga Penjualan" required>
				</div>

				<div class="col-span-12 sm:col-span-6">
				<label align="left">Harga Perpcs :</label>
				<input type="text" name="hargapcs" for="a b" class="input w-full border mt-2 flex-1" placeholder="Masukkan Harga Perpcs" readonly required>
				</div>

				<div class="col-span-12 sm:col-span-6">
				<label align="left">Stok :</label>
				<input type="number" name="stok" value="<?=$data->stok;?>" id="b" class="input w-full border mt-2 flex-1" placeholder="Masukkan Stok" required>
				</div>


				<div class="col-span-12 sm:col-span-6">
				<label align="left">Gambar :</label>
				<img src="<?php echo base_url().'uploads/gambar_psales/'.$data->gambar_produk; ?>" width="200" height="50" alt="gambar tidak ada">
				<input type="file" name="gambar_produk" class="input w-full border mt-2 flex-1" >
				</div>


				<div class="col-span-12 sm:col-span-12 align text-right">
				  <button type="button" class="button w-24 border text-gray-700 mr-1" data-dismiss="modal">Tutup</button>
                  <button type="submit" class="button w-24 bg-theme-1 text-white">Simpan</button>
				</div>



				</div>

				</form>

				</div>

			</div>
			<?php endforeach; ?>
			<!-- End Produk Modal -->
