		
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
                        Data Sales
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
                                <th class="border-b-2 text-center whitespace-no-wrap">Email</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Password</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Nama Sales</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">No. Hp</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Alamat</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Pembuat</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
							<?php
							$no = 1;
							foreach ($sales as $data){ 
							?>
                            <tr>
                                
                                <td class="text-center border-b">
                                    <?php echo $no++; ?>
                                </td>
                                <td class="text-center border-b">
                                    <?php echo $data->kode_sales ?>
                                </td>
                                 <td class="text-center border-b">
                                    <?php echo $data->email_sales ?>
                                </td>
                                 <td class="text-center border-b">
                                    <?php echo $data->password_text ?>
                                </td>
                                <td class="text-center border-b">
                                    <?php echo $data->nama_sales ?>
                                </td>
                                 <td class="text-center border-b">
                                    <?php echo $data->nohp ?>
                                </td>
                                 <td class="text-center border-b">
                                    <?php echo $data->alamat ?>
                                </td>
                                <td class="text-center border-b">
                                    <?php echo $data->pembuat ?>
                                </td>
                               
                                <td class="border-b w-5">
                                    <div class="flex sm:justify-center items-center">
                                    	  <a type="button" data-toggle="modal" data-target="#modal-edit<?=$data->id_sales;?>" class="flex items-center mr-3" style="cursor: pointer;"><i data-feather="check-square" class="w-4 h-4 mr-1"></i> Ubah</a>
                                       
                                        
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- END: Datatable -->



                <!-- Sales modal -->

			<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			    <div class="modal__content modal__content--lg p-10">

				
				<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                        <h2 class="font-medium text-base mr-auto">
                          	Tambah Sales
                        </h2>
                                                
                	</div>

                <form action="<?php echo base_url()?>admin/sales/save_sales" method="POST">
                
                <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">

				<div class="col-span-12 sm:col-span-6">
				<label align="left">Kode :</label>
				<input type="text" name="kode_sales" class="input w-full border mt-2 flex-1" value="<?php echo $kode_sales ?>" readonly>
				</div>

				<div class="col-span-12 sm:col-span-6">
				<label align="left">Email :</label>
				<input type="email" name="email_sales" class="input w-full border mt-2 flex-1" placeholder="Masukkan Nama Sales">
				</div>

				<div class="col-span-12 sm:col-span-6">
				<label align="left">Password :</label>
				<input type="password" name="pwd" class="input w-full border mt-2 flex-1" placeholder="Masukkan Nama Sales">
				</div>

				<div class="col-span-12 sm:col-span-6">
				<label align="left">Nama Sales :</label>
				<input type="text" name="nama_sales" class="input w-full border mt-2 flex-1" placeholder="Masukkan Nama Sales">
				</div>


				<div class="col-span-12 sm:col-span-6">
				<label align="left">No. Hp :</label>
				<input type="number" name="nohp" class="input w-full border mt-2 flex-1" placeholder="Masukkan No. Hp">
				</div>

				<div class="col-span-12 sm:col-span-12">
				<label align="left">Alamat :</label>
				<textarea class="summernote" name="alamat">Masukkan Alamat</textarea>
				</div>


				<div class="col-span-12 sm:col-span-12 align text-right">
				  <button type="button" class="button w-24 border text-gray-700 mr-1" data-dismiss="modal">Tutup</button>
                  <button type="submit" class="button w-24 bg-theme-1 text-white">Simpan</button>
				</div>



				</div>

				</form>

				</div>
			</div>


			<?php $no=0; foreach($sales as $data): $no++; ?>
			<div class="modal fade" id="modal-edit<?=$data->id_sales;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			    <div class="modal__content modal__content--lg p-10">

				
				<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                        <h2 class="font-medium text-base mr-auto">
                          	Ubah Sales
                        </h2>
                                                
                	</div>

                <form action="<?php echo base_url()?>admin/sales/edit_sales" method="POST">
                
                <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">

                	<input type="hidden" name="id_sales" value="<?=$data->id_sales;?>" class="input w-full border mt-2 flex-1" value="<?=$data->id_sales;?>" readonly>

				<div class="col-span-12 sm:col-span-6">
				<label align="left">Kode :</label>
				<input type="text" name="kode_sales" value="<?=$data->kode_sales;?>" class="input w-full border mt-2 flex-1" value="<?php echo $kode_sales ?>" readonly>
				</div>

				<div class="col-span-12 sm:col-span-6">
				<label align="left">Email :</label>
				<input type="email" name="email_sales" value="<?=$data->email_sales;?>" class="input w-full border mt-2 flex-1" placeholder="Masukkan Nama Sales">
				</div>

				<div class="col-span-12 sm:col-span-6">
				<label align="left">Password :</label>
				<input type="password" name="pwd" value="<?=$data->password_text;?>" class="input w-full border mt-2 flex-1" placeholder="Masukkan Nama Sales">
				</div>

				<div class="col-span-12 sm:col-span-6">
				<label align="left">Nama Sales :</label>
				<input type="text" name="nama_sales" value="<?=$data->nama_sales;?>" class="input w-full border mt-2 flex-1" placeholder="Masukkan Nama Sales">
				</div>


				<div class="col-span-12 sm:col-span-6">
				<label align="left">No. Hp :</label>
				<input type="number" name="nohp" value="<?=$data->nohp;?>" class="input w-full border mt-2 flex-1" placeholder="Masukkan No. Hp">
				</div>

				<div class="col-span-12 sm:col-span-12">
				<label align="left">Alamat :</label>
				<textarea class="summernote" name="alamat"><?=$data->alamat;?></textarea>
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
			<!-- End Sales Modal -->