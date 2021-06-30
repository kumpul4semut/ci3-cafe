		
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
                Data Hubungi
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
                                <th class="border-b-2 text-center whitespace-no-wrap">Nama</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Email</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
							<?php
							$no = 1;
							foreach ($hubungi as $data){ 
							 ?>
                            <tr>
                                
                                <td class="text-center border-b">
                                    <?php echo $no++; ?>
                                </td>
                                <td class="text-center border-b">
                                    <?php echo $data->nama_kontak ?>
                                </td>
                                <td class="text-center border-b">
                                     <?php echo $data->email_kontak ?>
                                </td>
                                <td class="text-center border-b">
                                    <?php echo $data->text_kontak ?>
                                </td>
                                
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- END: Datatable -->

