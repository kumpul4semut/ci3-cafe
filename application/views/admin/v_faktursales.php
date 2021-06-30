		
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
                        Data Faktur
                    </h2>
                     <a href="" class="ml-auto flex text-theme-1"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> </a>
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">

                        <a type="button" data-toggle="modal" data-target="#modal-tambah" class="button text-white bg-theme-1 shadow-md mr-2">Tambah Faktur</a>

                       	
                    </div>
                </div>
				
                <!-- BEGIN: Datatable -->
                <div class="intro-y datatable-wrapper box p-5 mt-5">
                    <table class="table table-report table-report--bordered display datatable w-full">
                        <thead>
                            <tr>
                                <th class="border-b-2 whitespace-no-wrap">No.</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Kode Faktur</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Kode PO</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Jatuh Tempo</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Kategori</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Download / Print</th>
                              
                                <th class="border-b-2 text-center whitespace-no-wrap">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
							<?php
							$no = 1;
							foreach ($faktur as $data){ 
							?>
                            <tr>
                                
                                <td class="text-center border-b">
                                    <?php echo $no++; ?>
                                </td>
                                <td class="text-center border-b">
                                    <?php echo $data->kode_faktur ?>
                                </td>
                                <td class="text-center border-b">
                                    <?php echo $data->kode_po ?>
                                </td>
                                <td class="text-center border-b">
                                     <?php echo date('d-m-y', strtotime($data->jatuh_tempo));  ?>
                                </td>
                                <td class="text-center border-b">
                                    <?php echo $data->kategori ?>
                                </td>
                                <td class="text-center border-b">
                                    <a href="<?php echo base_url()?>admin/faktur_sales/print_faktur/<?php echo $data->kode_po ?>" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer mx-auto"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a>
                                </td>
                                
                                
                               
                                <td class="border-b w-5">
                                    <div class="flex sm:justify-center items-center">
                                    	  <a type="button" data-toggle="modal" data-target="#modal-edit<?=$data->id_faktur;?>" class="flex items-center mr-3" style="cursor: pointer;"><i data-feather="check-square" class="w-4 h-4 mr-1"></i> Ubah</a>
                                       
                                        <a class="flex items-center text-theme-6" href="<?php echo site_url('admin/faktur_sales/hapus_faktur/'.$data->kode_po); ?>" onclick="return confirm('Apakah Anda Ingin Menghapus Data <?=$data->kode_faktur;?> ?');" class="btn btn-danger btn-circle" data-popup="tooltip" data-placement="top" title="Hapus Data"> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Hapus </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- END: Datatable -->



                <!-- faktur modal -->

			<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			    <div class="modal__content modal__content--lg p-10">

				
				<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                        <h2 class="font-medium text-base mr-auto">
                          	Tambah faktur
                        </h2>
                                                
                	</div>

                <form action="<?php echo base_url()?>admin/faktur_sales/save_faktur" method="POST">
                
                <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">

				<div class="col-span-12 sm:col-span-12">
				<label align="left">Kode :</label>
				<input type="text" name="kode_faktur" class="input w-full border mt-2 flex-1" value="<?php echo $kode_faktur ?>" readonly>
				</div>

				<div class="col-span-12 sm:col-span-12">
				<label align="left">Pilih Kode PO :</label>
				<select name="kode_po" class="input w-full border mt-2 flex-1">
					<?php foreach ($po as $po) { ?>
					<option value="<?php echo $po->kode_po?>"><?php echo $po->kode_po?> - Total Produk : <?php echo $po->total_produk?> - Total Harga : <?php echo $po->total_harga?> - Kategori : <?php echo $po->kategori?> - Status : <?php echo $po->status?></option>
					<?php } ?>
				</select>
				</div>

				<div class="col-span-12 sm:col-span-12">
				<label align="left">Pilih Jatuh Tempo :</label>
			
				<input type="date" name="jatuh_tempo" class="input w-full border mt-2 flex-1">
				</div>

				


				<div class="col-span-12 sm:col-span-12 align text-right">
				  <button type="button" class="button w-24 border text-gray-700 mr-1" data-dismiss="modal">Tutup</button>
                  <button type="submit" class="button w-24 bg-theme-1 text-white">Simpan</button>
				</div>



				</div>

				</form>

				</div>
			</div>


			<?php $no=0; foreach($faktur as $data): $no++; ?>
			<div class="modal fade" id="modal-edit<?=$data->id_faktur;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			    <div class="modal__content modal__content--lg p-10">

				
				<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                        <h2 class="font-medium text-base mr-auto">
                          	Ubah faktur
                        </h2>
                                                
                	</div>

                <form action="<?php echo base_url()?>admin/faktur_sales/edit_faktur" method="POST">

                <input type="hidden" name="id_faktur" value="<?= $data->id_faktur ?>">
                
                <div class="col-span-12 sm:col-span-12">
				<label align="left">Kode :</label>
				<input type="text" name="kode_faktur" class="input w-full border mt-2 flex-1" value="<?php echo $kode_faktur ?>" readonly>
				</div>

				<div class="col-span-12 sm:col-span-12">
				<label align="left">Pilih Kode PO :</label>
				<select name="kode_po" class="input w-full border mt-2 flex-1" required>
					<option value="<?= $data->kode_po ?>">(Data Di Pilih Saat Ini) <?php echo $data->kode_po?> - Total Produk : <?php echo $data->total_produk?> - Total Harga : <?php echo $data->total_harga?> - Kategori : <?php echo $data->kategori?> - Status : <?php echo $data->status?></option>
					<?php foreach ($faktur as $po) { ?>
					<option value="<?php echo $po->kode_po?>"><?php echo $po->kode_po?> - Total Produk : <?php echo $po->total_produk?> - Total Harga : <?php echo $po->total_harga?> - Kategori : <?php echo $po->kategori?> - Status : <?php echo $po->status?></option>
					<?php } ?>
				</select>
				</div>

				<div class="col-span-12 sm:col-span-12">
				<label align="left">Pilih Jatuh Tempo :</label>
				<br>
				Jatuh Tempo Saat ini <input type="text" value="<?= date('d-m-y', strtotime($data->jatuh_tempo));  ?>" readonly>
				<input type="date" name="jatuh_tempo" class="input w-full border mt-2 flex-1" >
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
			<!-- End faktur Modal -->