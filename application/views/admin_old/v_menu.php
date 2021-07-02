		
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
                Data Menu
            </h2>
             <a href="" class="ml-auto flex text-theme-1"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> </a>
            <div class="w-full sm:w-auto flex mt-4 sm:mt-0"></div>
        </div>
                <!-- BEGIN: Datatable -->
                <div class="intro-y datatable-wrapper box p-5 mt-5">
                <center><a  type="button" data-toggle="modal" data-target="#modal-tambah" class="button text-white bg-theme-1 shadow-md mr-2">Tambah</a></center>
                    <table class="table table-report table-report--bordered display datatable w-full">
                        <thead>
                            <tr>
                                <th class="border-b-2 whitespace-no-wrap">No.</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Nama Menu</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Link</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Status</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
							<?php
							$no = 1;
							foreach ($menu as $data){ 
							 ?>
                            <tr>
                                
                                <td class="text-center border-b">
                                    <?php echo $no++; ?>
                                </td>
                                <td class="text-center border-b">
                                    <?php echo $data->nama_menu ?>
                                </td>
                                <td class="text-center border-b">
                                     <?php echo $data->link ?>
                                </td>
                                <td class="text-center border-b">
                                    <?php echo $data->status ?>
                                </td>
                                 <td class="border-b w-5">
                                    <div class="flex sm:justify-center items-center">
                                          <a type="button" data-toggle="modal" data-target="#modal-edit<?=$data->id_menu;?>" class="flex items-center mr-3" style="cursor: pointer;"><i data-feather="check-square" class="w-4 h-4 mr-1"></i> Ubah</a>
                                       
                                        <a class="flex items-center text-theme-6" href="<?php echo site_url('admin/menu/hapus/'.$data->id_menu); ?>" onclick="return confirm('Apakah Anda Ingin Menghapus Data <?=$data->nama_menu;?> ?');" class="btn btn-danger btn-circle" data-popup="tooltip" data-placement="top" title="Hapus Data"> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Hapus </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- END: Datatable -->



            <!-- Menu modal -->


            <div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
             <div class="modal__content modal__content--lg p-10">

                
                <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                        <h2 class="font-medium text-base mr-auto">
                            Tambah Menu
                        </h2>
                </div>

                <form action="<?php echo base_url()?>admin/menu/save" method="POST" enctype="multipart/form-data">
                
                <div class="col-span-12 sm:col-span-6">
                <label align="left">Nama Menu :</label>
                <input type="text" name="nama_menu" class="input w-full border mt-2 flex-1" >
                </div>


                <div class="col-span-12 sm:col-span-6">
                <label align="left">Link :</label>
                <input type="text" name="link" class="input w-full border mt-2 flex-1" >
                </div>

                

                <div class="col-span-12 sm:col-span-6">
                <label align="left">Status :</label>
                <select name="status" class="input w-full border mt-2 flex-1">
                    <option value="0">Pilih *</option>
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
                </select>
                </div>

                <br>

                <div class="col-span-12 sm:col-span-12 align text-right">
                  <button type="button" class="button w-24 border text-gray-700 mr-1" data-dismiss="modal">Tutup</button>
                  <button type="submit" class="button w-24 bg-theme-1 text-white">Simpan</button>
                </div>



                </div>

                </form>

                </div>

            </div>




			<?php $no=0; foreach($menu as $data): $no++; ?>
			<div class="modal fade" id="modal-edit<?=$data->id_menu;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			    <div class="modal__content modal__content--lg p-10">

				
				<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                        <h2 class="font-medium text-base mr-auto">
                          	Ubah Menu
                        </h2>


                                                
                	</div>

                <form action="<?php echo base_url()?>admin/menu/edit" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="id_menu" class="input w-full border mt-2 flex-1" value="<?php echo $data->id_menu ?>">

                <div class="col-span-12 sm:col-span-6">
                <label align="left">Nama Menu :</label>
                <input type="text" name="nama_menu" class="input w-full border mt-2 flex-1" value="<?php echo $data->nama_menu ?>">
                </div>


                <div class="col-span-12 sm:col-span-6">
                <label align="left">Link :</label>
                 <input type="text" name="link" class="input w-full border mt-2 flex-1" value="<?php echo $data->link?>">
                </div>
                

                <div class="col-span-12 sm:col-span-6">
                <label align="left">Status :</label>
                <select name="status" class="input w-full border mt-2 flex-1">
                    <option value="<?php echo $data->status ?>"><?php echo $data->status ?></option>
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Non Aktif</option>
                </select>
                </div>
                
                

				<br>

				<div class="col-span-12 sm:col-span-12 align text-right">
				  <button type="button" class="button w-24 border text-gray-700 mr-1" data-dismiss="modal">Tutup</button>
                  <button type="submit" class="button w-24 bg-theme-1 text-white">Simpan</button>
				</div>



				</div>

				</form>

				</div>

			</div>
			<?php endforeach; ?>
			<!-- End menu Modal -->