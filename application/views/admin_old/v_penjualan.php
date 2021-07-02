 <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                        Penjualan
                    </h2>
                


                <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
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
                    
                    </div>
                </div>



                 



                <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
                    <!-- BEGIN: Item List -->
                    <div class="intro-y col-span-12 lg:col-span-8">
                        <div class="lg:flex intro-y">
                            <div class="relative text-gray-700">
                                <form action="<?php echo base_url()?>admin/penjualan/pencarian" method="POST">
                                <input type="text" name="cari" class="input input--lg w-full lg:w-64 box pr-10 placeholder-theme-13" placeholder="Search item...">
                                <input type="submit" value="Cari">
                                </form>
                            </div>
                            
                        </div>
                       
                        <div class="grid grid-cols-12 gap-5 mt-5 pt-5 border-t border-theme-5">
                              <?php foreach ($produk as $p) { ?>
                            <a href="javascript:;" data-toggle="modal" data-target="#add-item-modal-<?=$p->kode_produk ?>" class="intro-y block col-span-12 sm:col-span-4 xxl:col-span-3">
                                <div class="box rounded-md p-3 relative zoom-in" id="data_produk">
                                    <div class="flex-none pos-image relative block">
                                        <div class="pos-image__preview image-fit">
                                            <img alt="Midone Tailwind HTML Admin Template" src="<?php echo base_url().'uploads/gambar_psales/'.$p->gambar_produk; ?>">
                                        </div>
                                    </div>
                                    <div class="block font-medium text-center truncate mt-3"><?= $p->nama_produk ?></div>
                                </div>
                            </a>
                            <?php } ?>
                           
                        </div>

                         <!-- BEGIN: Datatable -->

                <div class="grid grid-cols-12 gap-5 mt-5 pt-5 border-t border-theme-5">
                    <h1>Data Penjualan</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="border-b-2 whitespace-no-wrap">No.</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Kode Penjualan</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Tgl Penjualan</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Total Produk</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Total Harga</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Pembuat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($penjualan as $data){ 
                            ?>
                            <tr>
                                
                                <td class="text-center border-b">
                                    <?php echo $no++; ?>
                                </td>
                                <td class="text-center border-b">
                                    <?php echo $data->kode_penjualan ?>
                                </td>
                                <td class="text-center border-b">
                                    <?php echo $data->tgl_penjualan ?>
                                </td>
                                
                                 <td class="text-center border-b">
                                    <?php echo $data->total_produk ?>
                                </td>
                                <td class="text-center border-b">
                                    Rp. <?php echo number_format($data->total_harga,'0','.','.') ?>
                                 
                                </td>
                                 <td class="text-center border-b">
                                    <?php echo $data->pembuat ?>
                                 
                                </td>
                               
                              
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- END: Datatable -->
                    </div>

                    
                    <!-- END: Item List -->

                    
                           
                        


                    <!-- BEGIN: Cart-->
                    <div class="col-span-12 lg:col-span-4">
                        <div class="intro-y pr-1">
                            
                        </div>
                        <div class="tab-content">
                        


                                           


                            <div class="tab-content__pane active" id="cart">
                              
                                <div class="pos__ticket box p-2 mt-5">
                                    <?php
                                    //for($i=1;$i<=2;$i++){
                                    error_reporting(0);
                                   
                                    foreach ($cart as $item):
                                    ?>
                                    <a href="javascript:;" data-toggle="modal" data-target="#add-item-modal" class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">
                                        <div class="pos__ticket__item-name truncate mr-1"><?= $item['name'];?></div>
                                        <div class="text-gray-600">x <?= $item['qty']; ?></div>
                                        <button type="button" onclick="location.href='<?php echo base_url();?>admin/penjualan/remove/<?php echo $item['rowid']; ?>'" ><i  class="w-4 h-4 text-gray-600 ml-2" data-feather="delete" ></i></button>
                                        <div class="ml-auto">Rp. <?= number_format($item['price'],'0','.','.') ; ?></div>

                                    </a>
                                    
                                    <?php

                                    endforeach;
                                  
                                    ?>

                                </div>
                               
                                
                                <div class="box p-5 mt-5">
                                    
                                   

                                    <div class="flex">
                                        <div class="mr-auto">Subtotal</div>
                                        
                                    <div>
                                    <table>

                                    <?php
                                    //for($i=1;$i<=2;$i++){
                                    error_reporting(0);
                                    $no = 1;
                                    foreach ($sub as $s)
                                    {

                                    ?>
                                        <tr>
                                           
                                            <td>Rp. <?= number_format($s['subtotal'],'0','.','.') ; ?></td>
                                        </tr>
                                    </table>
                                    <?php

                                    }
                                  
                                    ?>
                                    </div>


                                   
                                     
                                    </div>


                                    <div class="flex">
                                        <div class="mr-auto"></div>
                                        
                                    <div>
                                    
                                    </div>

                                    ------------------- +
                                     
                                    </div>


                                    
                                    
                                    <div class="flex mt-4 pt-4 border-gray-200">
                                    <div class="mr-auto font-medium text-base">Total</div>
                                        

                                   
                                     
                                    <div class="font-medium text-base">Rp. <?= number_format($this->cart->total(),'0','.','.') ; ?></div>
                                   
                                       
                                    </div>
                                    </div>

                               
                                <div class="flex mt-5">
                                    <button type="button" onclick="location.href='<?php echo base_url();?>admin/penjualan/del'"  class="button w-32 border border-gray-400 text-gray-600">Bersihkan Semua</button>
                                    
                                    <form  class="flex mt-5" action="<?php echo base_url()?>admin/penjualan/save_penjualan" method="POST">
                                        
                                    <input type="hidden" name="kode_penjualan1" value="<?= $kode_penjualan ?>">
                                    <input type="hidden" name="tgl_penjualan" value="<?= date('d-m-y') ?>">
                                    <input type="hidden" name="total_produk" value="<?= $this->cart->total_items() ?>">
                                    <input type="hidden" name="total_harga" value="<?= $this->cart->total() ?>">
                                    
                                     <?php 
                                   
                                     foreach ($cart as $item) { ?>

                                         <input type="hidden" name="kode_penjualan[]" value="<?= $kode_penjualan ?>">
                                         <input type="hidden" name="kode_produk[]" value="<?= $item['kode_produk']; ?>">
                                         <input type="hidden" name="harga[]" value="<?= $item['price']; ?>">
                                         <input type="hidden" name="jumlah[]" value="<?= $item['qty']; ?>">

                                     <?php } ?>
                                    
                                    <button class="button w-32 text-white bg-theme-1 shadow-md ml-auto" type="submit">Simpan</button>
                                    
                                    </form>
                                </div>
                               
                            </div>
                           
                        </div>

                    </div>


                    <!-- END: Ticket -->






                    </div>







               
                <!-- BEGIN: Add Item Modal -->
                <?php $no=0; foreach($produk as $p): $no++; ?>
                <div class="modal" id="add-item-modal-<?=$p->kode_produk ?>">
                    <div class="modal__content">
                        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                            <h2 class="font-medium text-base mr-auto">
                                <?= $p->nama_produk ?>
                            </h2>
                        </div>
                        
                        <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                            <div class="col-span-12">
                                <label>Quantity</label>
                                <div class="flex mt-2 flex-1">
                                <form  action="<?php echo base_url()?>admin/penjualan/add" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?= $p->id_produk ?>">
                                    <input type="hidden" name="name" value="<?= $p->nama_produk ?>">
                                    <input type="hidden" name="kode_produk" value="<?= $p->kode_produk ?>">
                                    <input type="number" name="qty" class="input w-full border text-center">
                                    <input type="hidden" name="price" value="<?= $p->hargapcs ?>">
                                 
                                </div>
                            </div>
                        </div>
                        <div class="px-5 py-3 text-right border-t border-gray-200">
                            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
                            <button type="submit" class="button w-24 bg-theme-1 text-white">Add Item</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <!-- END: Add Item Modal -->
            </div>
            <!-- END: Content -->





    