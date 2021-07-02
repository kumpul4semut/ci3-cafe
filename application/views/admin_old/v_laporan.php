		
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
					Laporan
					</h2>
					<a href="" class="ml-auto flex text-theme-1"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> </a>
					
					</div>

				<br>

				<div class="intro-y pr-1">
                            <div class="box p-2">
                                <div class="chat__tabs nav-tabs justify-center flex"> 
                                	<a data-toggle="tab" data-target="#omset" href="javascript:;" class="flex-1 py-2 rounded-md text-center active">Target Omset</a> 
                                	<a data-toggle="tab" data-target="#tp" href="javascript:;" class="flex-1 py-2 rounded-md text-center">Target Penjualan</a> 
                                	<a data-toggle="tab" data-target="#pen" href="javascript:;" class="flex-1 py-2 rounded-md text-center">Penjualan</a> 
                                	<a data-toggle="tab" data-target="#pem" href="javascript:;" class="flex-1 py-2 rounded-md text-center">Pembelian</a> 
                                	
                               </div>
                            </div>
                        </div>

                <div class="tab-content">
                <div class="tab-content__pane active" id="omset">
				
                <!-- BEGIN: report -->
                <div class="intro-y datatable-wrapper box p-5 mt-5">
                  <h2 class="text-lg font-medium mr-auto">
					Laporan Target Omset
				 </h2>
				 <br>
                 <form action="<?php echo base_url()?>admin/laporan/target_omset" target="_blank" method="POST">
                 
                 <label>Pilih Bulan</label>
                 <input type="month" name="date1" class="input w-56 border" required>

                
 				
                 <input type="submit" class="input w-56 border" value="Export">

                 </form>


                </div>
                <!-- END: report-->
            </div>
        
            <div class="tab-content__pane" id="tp">
            	<!-- BEGIN: report -->
                <div class="intro-y datatable-wrapper box p-5 mt-5">
                  <h2 class="text-lg font-medium mr-auto">
					Laporan Target Penjualan
				 </h2>
				 <br>
                <form action="<?php echo base_url()?>admin/laporan/target_pen" target="_blank" method="POST">
                 
                 <label>Pilih Bulan</label>
                 <input type="month" name="date1" class="input w-56 border" required>

                
 				
                 <input type="submit" class="input w-56 border" value="Export">

                 </form>


                </div>
                <!-- END: report-->
            </div>

            <div class="tab-content__pane" id="pen">
            	<!-- BEGIN: report -->
                <div class="intro-y datatable-wrapper box p-5 mt-5">
                  <h2 class="text-lg font-medium mr-auto">
					Laporan Penjualan
				 </h2>
				 <br>
                 <form action="<?php echo base_url()?>admin/laporan/laporan_pen" target="_blank" method="POST">
                 <label>Dari TGL</label>
                 <input type="date" name="date1" class="input w-56 border" required>

                 <label> Sampai TGL</label>
                 <input type="date" name="date2" class="input w-56 border" required>
 				
                 <input type="submit" class="input w-56 border" value="Export">

                 </form>


                </div>
                <!-- END: report-->
            </div>
           
           <div class="tab-content__pane" id="pem">
            	<!-- BEGIN: report -->
                <div class="intro-y datatable-wrapper box p-5 mt-5">
                  <h2 class="text-lg font-medium mr-auto">
					Laporan Pembelian
				 </h2>
				 <br>
                 <form action="<?php echo base_url()?>admin/laporan/laporan_pem" target="_blank" method="POST">
                 <label>Dari TGL</label>
                 <input type="date" name="date1" class="input w-56 border" required>

                 <label> Sampai TGL</label>
                 <input type="date" name="date2" class="input w-56 border" required>
 				
                 <input type="submit" class="input w-56 border" value="Export">

                 </form>


                </div>
                <!-- END: report-->
            </div>
           

        </div>
        </div>




                <!-- Penjualan modal -->

			<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			    <div class="modal__content modal__content--lg p-10">

				
				<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                        <h2 class="font-medium text-base mr-auto">
                          	Atur Penjualan
                        </h2>
                                                
                	</div>

                <form action="<?php echo base_url()?>admin/target_penjualan/save_target" method="POST">
                
                <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">

				<div class="col-span-12 sm:col-span-6">
				<label align="left">Waktu :</label>
				<input type="date" name="waktu_tpenjualan" class="input w-full border mt-2 flex-1" required>
				</div>

				<div class="col-span-12 sm:col-span-6">
				<label align="left">Target :</label>
				<input type="number" name="target_penjualan" class="input w-full border mt-2 flex-1" placeholder="Masukkan Target" required>
				</div>


				<div class="col-span-12 sm:col-span-12 align text-right">
				  <button type="button" class="button w-24 border text-gray-700 mr-1" data-dismiss="modal">Tutup</button>
                  <button type="submit" class="button w-24 bg-theme-1 text-white">Simpan</button>
				</div>



				</div>

				</form>

				</div>
			</div>


			<!-- Edit Penjualan modal -->
			<?php $no=0; foreach($target as $data): $no++; ?>
			<div class="modal fade" id="modal-edit<?=$data->id_tpenjualan;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			    <div class="modal__content modal__content--lg p-10">

				
				<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                        <h2 class="font-medium text-base mr-auto">
                          	Atur Penjualan
                        </h2>
                                                
                	</div>

                <form action="<?php echo base_url()?>admin/target_penjualan/edit_target" method="POST">
                <input type="hidden" name="id_tpenjualan" value="<?=$data->id_tpenjualan;?>" class="input w-full border mt-2 flex-1" readonly>
                <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">

				<div class="col-span-12 sm:col-span-6">
				<label align="left">Waktu :</label>
				<input type="date" name="waktu_tpenjualan" value="<?= $data->waktu_tpenjualan ?>" class="input w-full border mt-2 flex-1" required>
				</div>

				<div class="col-span-12 sm:col-span-6">
				<label align="left">Target :</label>
				<input type="number" name="target_penjualan" value="<?= $data->target_penjualan ?>" class="input w-full border mt-2 flex-1" placeholder="Masukkan Target" required>
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

		