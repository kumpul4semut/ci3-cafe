		
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
                Data Slide
            </h2>
             <a href="" class="ml-auto flex text-theme-1"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> </a>
            <div class="w-full sm:w-auto flex mt-4 sm:mt-0"></div>
        </div>
                <!-- BEGIN: Datatable -->
                <div class="intro-y datatable-wrapper box p-5 mt-5">
              
                    <table class="table table-report table-report--bordered display datatable w-full">
                        <thead>
                            <tr>
                                <th class="border-b-2 whitespace-no-wrap">No.</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Gambar Slide</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Judul</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Tulisan Berjalan</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Deskripsi</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Button 1</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Link 1</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Button 2</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Link 2</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
							<?php
							$no = 1;
							foreach ($slide as $data){ 
							 ?>
                            <tr>
                                
                                <td class="text-center border-b">
                                    <?php echo $no++; ?>
                                </td>
                                <td class="text-center border-b">
                                    <img src="<?php echo base_url().'uploads/slide/'.$data->gambar_slide; ?>" width="150" height="150" alt="gambar tidak ada">
                                </td>
                                <td class="text-center border-b">
                                     <?php echo $data->judul_text ?>
                                </td>
                                <td class="text-center border-b">
                                     <?php echo $data->tulisan_berjalan ?>
                                </td>
                                <td class="text-center border-b">
                                     <?php echo $data->deskripsi_text ?>
                                </td>
                                <td class="text-center border-b">
                                     <?php echo $data->nama_button1 ?>
                                </td>
                                <td class="text-center border-b">
                                   <a href="<?php echo $data->link_button1 ?>" target="_blank">Klik</a>  
                                </td>
                                <td class="text-center border-b">
                                     <?php echo $data->nama_button2 ?>
                                </td>
                                <td class="text-center border-b">
                                   <a href="<?php echo $data->link_button2 ?>" target="_blank">Klik</a>  
                                </td>
                                 <td class="border-b w-5">
                                    <div class="flex sm:justify-center items-center">
                                    <a type="button" data-toggle="modal" data-target="#modal-edit<?=$data->id_slide;?>" class="flex items-center mr-3" style="cursor: pointer;"><i data-feather="check-square" class="w-4 h-4 mr-1"></i> Ubah</a>
                                       
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- END: Datatable -->



            <!-- Slide modal -->

			<?php $no=0; foreach($slide as $data): $no++; ?>
			<div class="modal fade" id="modal-edit<?=$data->id_slide;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			    <div class="modal__content modal__content--lg p-10">

				
				<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                        <h2 class="font-medium text-base mr-auto">
                          	Ubah Slide
                        </h2>
                </div>

                <form action="<?php echo base_url()?>admin/slide/edit" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="id_slide" value="<?php echo $data->id_slide ?>" class="input w-full border mt-2 flex-1" >

                <div class="col-span-12 sm:col-span-6">
                <label align="left">Gambar Slide :</label>
                <img src="<?php echo base_url().'uploads/slide/'.$data->gambar_slide; ?>" width="150" height="150" alt="gambar tidak ada">
                <input type="hidden" name="old_pict" class="input w-full border mt-2 flex-1" value="<?php echo $data->gambar_slide ?>">
                <input type="file" name="gambar_slide" class="input w-full border mt-2 flex-1" >
                </div>

                <div class="col-span-12 sm:col-span-6">
                <label align="left">Judul :</label>
                <input type="text" name="judul_text" class="input w-full border mt-2 flex-1" value="<?php echo $data->judul_text ?>">
                </div>

                <div class="col-span-12 sm:col-span-6">
                <label align="left">Tulisan :</label>
                <input type="text" name="tulisan_berjalan" class="input w-full border mt-2 flex-1" value="<?php echo $data->tulisan_berjalan ?>">
                </div>

                <div class="col-span-12 sm:col-span-6">
                <label align="left">Deskripsi :</label>
                <input type="text" name="deskripsi_text" class="input w-full border mt-2 flex-1" value="<?php echo $data->deskripsi_text ?>" >
                </div>

                <div class="col-span-12 sm:col-span-6">
                <label align="left">Button 1 :</label>
                <input type="text" name="nama_button1" class="input w-full border mt-2 flex-1" value="<?php echo $data->nama_button1 ?>">
                </div>

                <div class="col-span-12 sm:col-span-6">
                <label align="left">Link Button 1 :</label>
                <input type="text" name="link_button1" class="input w-full border mt-2 flex-1" value="<?php echo $data->link_button1 ?>" >
                </div>

                <div class="col-span-12 sm:col-span-6">
                <label align="left">Button 2 :</label>
                <input type="text" name="nama_button2" class="input w-full border mt-2 flex-1" value="<?php echo $data->nama_button2 ?>" >
                </div>

                <div class="col-span-12 sm:col-span-6">
                <label align="left">Link Button 2 :</label>
                <input type="text" name="link_button2" class="input w-full border mt-2 flex-1" value="<?php echo $data->link_button2 ?>">
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