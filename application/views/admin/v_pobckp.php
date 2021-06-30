			
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
			<script type="text/javascript">  
			$().ready(function() {  
			
			$('[id*=edit_form_]').submit(function() {
				var fid = $(this).closest("form").attr('id');
				var arr = fid.split('_');
				$('#'+fid+' #select2_'+arr[2]+' option').each(function(i) {  
				$(this).attr("selected", "selected");  
				});  
			});
			
			$('#add').click(function() {  
				var fid = $(this).closest("form").attr('id');
				console.log(fid);
				var value = !$('#'+fid+' #select1 option:selected').remove().appendTo('#'+fid+' #select2');
				var tproduk = 0 ;
				var tharga = 0 ;
				$('#'+fid+" #select2 option").each(function()
				{
					var temp = $(this).val();
					var res = temp.split("_");
					
					var stok = res[1];
					var harga = res[2];
					
					tproduk = tproduk + parseFloat(stok);
					tharga = tharga + parseFloat(harga);
					
					//console.log($(this).val());
				});
				$('#'+fid+' #tproduk').val(tproduk);
				$('#'+fid+' #tharga').val(tharga);
				
				return value;
				
				//return !$('#select1 option:selected').remove().appendTo('#select2');
				//var produk = document.getElementById('select2').value;
				//console.log(produk);    
			});  
			$('#remove').click(function() {  
				var fid = $(this).closest("form").attr('id');
				var value = !$('#'+fid+' #select2 option:selected').remove().appendTo('#'+fid+' #select1');  
				
				var tproduk = 0 ;
				var tharga = 0 ;
				$('#'+fid+" #select2 option").each(function()
				{
					var temp = $(this).val();
					var res = temp.split("_");
					
					var stok = res[1];
					var harga = res[2];
					
					tproduk = tproduk + parseFloat(stok);
					tharga = tharga + parseFloat(harga);
					
					//console.log($(this).val());
				});
				$('#'+fid+' #tproduk').val(tproduk);
				$('#'+fid+' #tharga').val(tharga);
				
				return value;
				
				//return !$('#select2 option:selected').remove().appendTo('#select1');  
			});  
			
			$('[id*=add_]').click(function() {  
				var fid = $(this).closest("form").attr('id');
				var arr = fid.split('_');
				//console.log($('#'+fid+' #select1_'+arr[2]+' option:selected').val());
				var value = !$('#'+fid+' #select1_'+arr[2]+' option:selected').remove().appendTo('#'+fid+' #select2_'+arr[2]+'');
				var tproduk = 0 ;
				var tharga = 0 ;
				$('#'+fid+" #select2_"+arr[2]+" option").each(function()
				{
					var temp = $(this).val();
					var res = temp.split("_");
					
					var stok = res[1];
					var harga = res[2];
					
					tproduk = tproduk + parseFloat(stok);
					tharga = tharga + parseFloat(harga);
					
					//console.log($(this).val());
				});
				$('#'+fid+' #tproduk_'+arr[2]+'').val(tproduk);
				$('#'+fid+' #tharga_'+arr[2]+'').val(tharga);
				
				return value;
				
				//return !$('#select1 option:selected').remove().appendTo('#select2');
				//var produk = document.getElementById('select2').value;
				//console.log(produk);    
			});  
			$('[id*=remove_]').click(function() {  
				var fid = $(this).closest("form").attr('id');
				var arr = fid.split('_');
				var value = !$('#'+fid+' #select2_'+arr[2]+' option:selected').remove().appendTo('#'+fid+' #select1_'+arr[2]+'');  
				
				var tproduk = 0 ;
				var tharga = 0 ;
				$('#'+fid+" #select2_"+arr[2]+" option").each(function()
				{
					var temp = $(this).val();
					var res = temp.split("_");
					
					var stok = res[1];
					var harga = res[2];
					
					tproduk = tproduk + parseFloat(stok);
					tharga = tharga + parseFloat(harga);
					
					//console.log($(this).val());
				});
				$('#'+fid+' #tproduk_'+arr[2]+'').val(tproduk);
				$('#'+fid+' #tharga_'+arr[2]+'').val(tharga);
				
				return value;
				
				//return !$('#select2 option:selected').remove().appendTo('#select1');  
			});  
			
			});  
			</script> 

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
                        Data PO
                    </h2>
                     <a href="" class="ml-auto flex text-theme-1"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> </a>
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">

                        <a type="button" data-toggle="modal" data-target="#modal-tambah" class="button text-white bg-theme-1 shadow-md mr-2">Tambah PO</a>

                       	
                    </div>
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
                                <th class="border-b-2 text-center whitespace-no-wrap">Status</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Pembuat</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Faktur</th>
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
                                    <?php echo $data->status ?>
                                </td>
                              
                                </td>
                                <td class="text-center border-b">
                                    <?php echo $data->pembuat ?>
                                </td>
                                <td class="text-center border-b">
                                    <a href=""><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip mx-auto"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg></a>
                                </td>
                               
                                <td class="border-b w-5">
                                    <div class="flex sm:justify-center items-center">
                                    	  <a type="button" data-toggle="modal" data-target="#modal-edit<?=$data->id_po;?>" class="flex items-center mr-3"><i data-feather="check-square" class="w-4 h-4 mr-1"></i> Ubah</a>
                                       
                                        <a class="flex items-center text-theme-6" href="<?php echo site_url('admin/po/hapus_po/'.$data->id_po); ?>" onclick="return confirm('Apakah Anda Ingin Menghapus Data <?=$data->kode_po;?> ?');" class="btn btn-danger btn-circle" data-popup="tooltip" data-placement="top" title="Hapus Data"> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Hapus </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- END: Datatable -->



                <!-- po modal -->

			<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			    <div class="modal__content modal__content--xl p-10">

				
				<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                        <h2 class="font-medium text-base mr-auto">
                          	Tambah PO
                        </h2>
                                                
                	</div>

                <form id="add_form" action="<?php echo base_url()?>admin/po/save_po" method="POST">
                
                <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">

              <div class="col-span-12 sm:col-span-12">
				<label align="left">Nama Sales :</label>
				<select class="input w-full border mt-2 flex-1" name="id_sales">
					<option value="0">Pilih</option>
					<?php foreach ($sales as $s) { ?>
					<option value="<?php echo $s->id_sales?>"><?php echo $s->nama_sales?></option>
					<?php } ?>
				</select>
				</div>	 

				<div class="col-span-12 sm:col-span-6">
				<label align="left">Kode :</label>
				<input type="text" name="kode_po" class="input w-full border mt-2 flex-1" value="<?php echo $kode_po ?>" readonly>
				</div>

				<div class="col-span-12 sm:col-span-6">
				<label align="left">Tgl PO :</label>
				<input type="text" name="tgl_po" class="input w-full border mt-2 flex-1" value="<?php echo date('d-m-y') ?>" readonly>
				</div>
				
				<div class="col-span-12 sm:col-span-6">
				<label align="left">Pilih Produk :</label>
				<select class="input w-full border mt-2 flex-1" multiple="true" id="select1">
					<?php foreach ($psales as $ps) {?>
					<option value="<?php echo $ps->id_psales?>_<?php echo $ps->stok?>_<?php echo $ps->harga?>"><?php echo $ps->nama_psales?> <?php echo $ps->stok?> (<?php echo $ps->satuan?>) - Rp. <?php echo number_format($ps->harga,'0','.','.') ?></option>
					<?php } ?>
					
				</select>
				 <a href="#" id="add">Tambah &gt;&gt;</a>  
				</div>


				<div class="col-span-12 sm:col-span-6">
				<label align="left">Produk Terpilih :</label>
				<select class="input w-full border mt-2 flex-1" name="psales[]" multiple="true" id="select2">
					
				</select>
				 <a href="#" id="remove">&lt;&lt; Hapus</a>  
				</div>

				<div class="col-span-12 sm:col-span-6">
				<label align="left">Total Produk :</label>
				<input type="number" name="total_produk" class="input w-full border mt-2 flex-1" id="tproduk" readonly>
				</div>

				<div class="col-span-12 sm:col-span-6">
				<label align="left">Total Harga :</label>
				<input type="text" name="total_harga" class="input w-full border mt-2 flex-1" id="tharga" readonly>
				</div>

				


				<div class="col-span-12 sm:col-span-12 align text-right">
				  <button type="button" onclick="tutupModal(this);" class="button w-24 border text-gray-700 mr-1" data-dismiss="modal">Tutup</button>
                  <button type="submit" onclick="submitAdd(this);" class="button w-24 bg-theme-1 text-white">Simpan</button>
				</div>



				</div>

				</form>

				</div>
			</div>


			<?php $no=0; foreach($po as $data): $no++;  ?>
			<div class="modal fade" id="modal-edit<?=$data->id_po;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			    <div class="modal__content modal__content--lg p-10">

				
				<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                        <h2 class="font-medium text-base mr-auto">
                          	Ubah po
                        </h2>
                                                
                	</div>

                <form action="<?php echo base_url()?>admin/po/edit_po" id="edit_form_<?=$data->id_po;?>" method="POST">
                
                <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">

                <input type="hidden" name="id_po" value="<?=$data->id_po;?>" class="input w-full border mt-2 flex-1" value="<?=$data->id_po;?>" readonly>

                 <div class="col-span-12 sm:col-span-12">
				<label align="left">Nama Sales :</label>
				<select class="input w-full border mt-2 flex-1" name="id_sales">
					

					<option value="<?php echo $data->id_sales?>" selected><?php echo $data->nama_sales?> (Data Saat Ini)</option>
				
					<?php foreach ($sales as $s) { ?>
					<option value="<?php echo $s->id_sales?>"><?php echo $s->nama_sales?></option>
					<?php } ?>
				</select>
				</div>	 

				<div class="col-span-12 sm:col-span-6">
				<label align="left">Kode :</label>
				<input type="text" name="kode_po" class="input w-full border mt-2 flex-1" value="<?php echo $data->kode_po ?>" readonly>
				</div>

				<div class="col-span-12 sm:col-span-6">
				<label align="left">Tgl PO :</label>
				<input type="date" name="tgl_po" class="input w-full border mt-2 flex-1" value="<?php echo $data->tgl_po ?>" >
				</div>
				
				<div class="col-span-12 sm:col-span-6">
				<label align="left">Pilih Produk :</label>
				<select class="input w-full border mt-2 flex-1" multiple="true" id="select1_<?=$data->id_po;?>">
					<?php foreach ($psales as $pd) {
						$check = true;
						foreach($data->detail as $v){
							if($pd->id_psales == $v->kode_psales) $check = false;
						}
						if($check){
						?>
					<option value="<?php echo $pd->id_psales?>_<?php echo $pd->stok?>_<?php echo $pd->harga?>"><?php echo $pd->nama_psales?> <?php echo $pd->stok?> (<?php echo $pd->satuan?>) - Rp. <?php echo number_format($pd->harga,'0','.','.') ?></option>
						<?php } } ?>
					
				</select>
				 <a href="#" id="add_<?=$data->id_po;?>">Tambah &gt;&gt;</a>  
				</div>


				<div class="col-span-12 sm:col-span-6">
				<label align="left">Produk Terpilih :</label>
				<select class="input w-full border mt-2 flex-1" name="psales[]" multiple="true" id="select2_<?=$data->id_po;?>">
					<?php foreach ($data->detail as $ps) {?>
					<option value="<?php echo $ps->kode_psales?>_<?php echo $ps->jumlah?>_<?php echo $ps->harga?>"><?php echo $ps->nama_psales?> <?php echo $ps->jumlah?> (<?php echo $ps->satuan?>) - Rp. <?php echo number_format($ps->harga,'0','.','.') ?></option>
					<?php } ?>
				</select>
				 <a href="#" id="remove_<?=$data->id_po;?>">&lt;&lt; Hapus</a>  
				</div>

				<div class="col-span-12 sm:col-span-6">
				<label align="left">Total Produk :</label>
				<input type="number" name="total_produk" value="<?php echo $data->total_produk ?>" class="input w-full border mt-2 flex-1" id="tproduk_<?=$data->id_po;?>" readonly>
				</div>

				<div class="col-span-12 sm:col-span-6">
				<label align="left">Total Harga :</label>
				<input type="text" name="total_harga" value="<?php echo $data->total_harga ?>" class="input w-full border mt-2 flex-1" id="tharga_<?=$data->id_po;?>" readonly>
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
			<!-- End po Modal -->


			<script type="text/javascript">
			
			function tutupModal(el){
				$('#modal-tambah').modal('hide');
			}
			
			function submitAdd(el){
				$('#select2 option').each(function(i) {  
				$(this).attr("selected", "selected");  
				}); 
				document.getElementById("add_form").submit();
			}

			function format2(n, currency) {
			return currency + " " + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1.");
			}

			function sum() {
			var select2 = document.getElementById('select2').value;
			var result = (parseInt(select2)) ;
			console.log(result);

			if (!isNaN(result)) {
			
			document.getElementById('tproduk').value = result;
			}
			}  
			</script>