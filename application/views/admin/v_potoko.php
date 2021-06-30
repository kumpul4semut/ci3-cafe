			
			

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
                        Data PO Toko
                    </h2>
                     <a href="" class="ml-auto flex text-theme-1"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> </a>
                    
                </div>
				
                <!-- BEGIN: Datatable -->
                <div class="intro-y datatable-wrapper box p-5 mt-5">
                    <table class="table table-report table-report--bordered display datatable w-full">
                        <thead>
                            <tr>
                                <th class="border-b-2 whitespace-no-wrap">No.</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Nama Sales</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Kode</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Tgl PO</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Total Produk</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Total Harga</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Kategori</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Status</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Pembuat</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
							<?php
							$no = 1;
							foreach ($po as $data){ 
							?>
                            <tr>
                                
                                <td class="text-center border-b">
                                    <?php echo $no++; ?>
                                </td>
                                 <td class="text-center border-b">
                                    <?php echo $data->nama_sales ?>
                                </td>
                                <td class="text-center border-b">
                                    <?php echo $data->kode_po ?>
                                </td>
                                 <td class="text-center border-b">
                                    <?php echo date('d-m-y', strtotime($data->tgl_po));  ?>
                                </td>
                                
                                <td class="text-center border-b">
                                    <?php echo $data->total_produk ?>
                                </td>
                                 <td class="text-center border-b">
                                   
                                     Rp. <?php echo number_format($data->total_harga,'0','.','.') ?>
                                </td>

                                 <td class="text-center border-b">
                                    <?php echo $data->kategori ?>
                                </td>
                              
                                <td class="text-center border-b">
                                    <?php if ($data->status == 'DIKIRIM') {
                                        echo "<p style='color:green'>" . $data->status;
                                    } 

                                    else {

                                         echo "<p style='color:red'>" . $data->status;

                                    }




                                    ?>
                                   
                                </td>
                                
                                <td class="text-center border-b">
                                    <?php echo $data->pembuat ?>
                                </td>
                               
                               
                                <td class="border-b w-5">
                                    <div class="flex sm:justify-center items-center">
     									
                                        <a class="flex items-center text-theme-6" href="<?php echo site_url('admin/po_toko/proses_po/'.$data->kode_po); ?>" onclick="return confirm('Apakah Anda Ingin Proses Data PO <?=$data->kode_po;?> ?');" class="btn btn-danger btn-circle" data-popup="tooltip" data-placement="top" title="Proses PO"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-play mx-auto"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>Proses PO </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- END: Datatable -->


			</div>



