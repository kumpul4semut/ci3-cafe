		
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
                        Data Bayar Faktur
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
                                <th class="border-b-2 text-center whitespace-no-wrap">Kode PO</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Total Harga</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Total Bayar</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Total Tagihan</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Jatuh Tempo</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Kategori</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Status</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Download / Print</th>
                              
                                <th class="border-b-2 text-center whitespace-no-wrap">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
							<?php
							$no = 1;
							foreach ($faktur as $data){ 
							//$totaltagihan = $data->total_harga - array_sum(array($data->total_bayar)); ?>
                            <tr>
                                
                                <td class="text-center border-b">
                                    <?php echo $no++; ?>
                                </td>
                                <td class="text-center border-b">
                                    <?php echo $data->kode_po ?>
                                </td>
                                <td class="text-center border-b">
                                    Rp. <?php echo number_format($data->total_harga,'0','.','.') ?>
                                </td>
                                <td class="text-center border-b">
                                    Rp. <?php echo number_format($data->total_bayar,'0','.','.') ?>
                                </td>
                               
                                <td class="text-center border-b">
                                    Rp. <?php echo number_format($data->total_tagihan,'0','.','.') ?>
                                </td>
                                <td class="text-center border-b">
                                     <?php echo date('d-m-y', strtotime($data->jatuh_tempo));  ?>
                                </td>
                                 <td class="text-center border-b">
                                    <?php echo $data->kategori ?>
                                </td>
                                <td class="text-center border-b">
                                    <?php echo $data->status ?>
                                </td>
                                <td class="text-center border-b">
                                    <a href="<?php echo base_url()?>admin/faktur_sales/print_faktur/<?php echo $data->kode_po ?>" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer mx-auto"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a>
                                </td>
                                
                                
                               
                                <td class="text-center border-b">
                                     <div class="flex sm:justify-center items-center">
                                    	  <a type="button" data-toggle="modal" data-target="#modal-bayar<?=$data->kode_po;?>" class="flex items-center mr-3" style="cursor: pointer;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign mx-auto"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>Bayar</a>
                                 	</div>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- END: Datatable -->



                <!-- faktur modal -->

			

			<?php $no=0; foreach($faktur as $data): $no++; ?>
			<div class="modal fade" id="modal-bayar<?=$data->kode_po;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			    <div class="modal__content modal__content--lg p-10">

				
				<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                        <h2 class="font-medium text-base mr-auto">
                          	Bayar Faktur
                        </h2>


                                                
                	</div>

                <form action="<?php echo base_url()?>admin/faktur/bayar_faktur" method="POST" enctype="multipart/form-data">
                
                <div class="col-span-12 sm:col-span-6">
                <input type="hidden" name="id_faktur" value="<?php echo $data->id_faktur ?>">
                <input type="hidden" name="kode_faktur" value="<?php echo $data->kode_faktur ?>">
                <input type="hidden" name="id_sales" value="<?php echo $data->id_sales ?>">
				<input type="hidden" name="kode_po" value="<?php echo $data->kode_po ?>">
				<input type="hidden" name="total_harga" value="<?php echo $data->total_harga ?>">
				<input type="hidden" name="jatuh_tempo" value="<?php echo $data->jatuh_tempo ?>">
				<input type="hidden" name="pembuat" value="<?php echo $data->pembuat ?>">
				<input type="date" name="tgl_bayar" value="<?php echo date('Y-m-d'); ?>" class="input w-full border mt-2 flex-1" readonly>
				<input type="number" name="dibayar" class="input w-full border mt-2 flex-1" >
                <input type="file" name="bukti_bayar" class="input w-full border mt-2 flex-1" >
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
			<!-- End faktur Modal -->