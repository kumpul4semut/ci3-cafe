		
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
					Grafik Target Omset
				 </h2>
				 <br>
                
                <canvas id="target-omset" height="50"></canvas> 


                </div>
                <!-- END: report-->
            </div>
        
            <div class="tab-content__pane" id="tp">
            	<!-- BEGIN: report -->
                <div class="intro-y datatable-wrapper box p-5 mt-5">
                  <h2 class="text-lg font-medium mr-auto">
					Grafik Target Penjualan
				 </h2>
				 <br>
            <canvas id="target-penjualan" height="50"></canvas> 


                </div>
                <!-- END: report-->
            </div>

            <div class="tab-content__pane" id="pen">
            	<!-- BEGIN: report -->
                <div class="intro-y datatable-wrapper box p-5 mt-5">
                  <h2 class="text-lg font-medium mr-auto">
					Grafik Penjualan
				 </h2>
				 <br>
                 
                <canvas id="grafik-penjualan" height="50"></canvas> 


                </div>
                <!-- END: report-->
            </div>
           
           <div class="tab-content__pane" id="pem">
            	<!-- BEGIN: report -->
                <div class="intro-y datatable-wrapper box p-5 mt-5">
                  <h2 class="text-lg font-medium mr-auto">
					Grafik Pembelian Per Tahun
				 </h2>
				 <br>
                

                 <canvas id="grafik-pembelian" height="50"></canvas> 

                </div>
                <!-- END: report-->
            </div>
           

        </div>
        </div>





		<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>




        <script>
         var ctx = document.getElementById('grafik-pembelian').getContext('2d');
         var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',
        // The data for our dataset
        data: {
            labels: [
            <?php
            if (count($grafik_pem)>0) {
              foreach ($grafik_pem as $data) {
                echo "'" .bulan($data->bulan)."',";
              }
            }
          ?>
            ],

            datasets: [{
                label:'Grafik Pembelian',
                backgroundColor: ['rgb(255, 99, 132)', 'rgba(56, 86, 255, 0.87)', 'rgb(60, 179, 113)','rgb(175, 238, 239)'],
                borderColor: ['rgb(255, 99, 132)'],
                data: [<?php
            if (count($grafik_pem)>0) {
              foreach ($grafik_pem as $data) {
                echo "'" .$data->harga."',";
              }
            }
          ?>]
            }],


        },


        // Configuration options go here
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });

         var ctx = document.getElementById('grafik-penjualan').getContext('2d');
         var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',
        // The data for our dataset
        data: {
            labels: [
            <?php
            if (count($grafik_pem)>0) {
              foreach ($grafik_pen as $data) {
                echo "'" .bulan($data->bulan)."',";
              }
            }
          ?>
            ],

            datasets: [{
                label:'Grafik Penjualan',
                backgroundColor: ['rgb(255, 99, 132)', 'rgba(56, 86, 255, 0.87)', 'rgb(60, 179, 113)','rgb(175, 238, 239)'],
                borderColor: ['rgb(255, 99, 132)'],
                data: [<?php
            if (count($grafik_pen)>0) {
              foreach ($grafik_pen as $data) {
                echo "'" .$data->harga."',";
              }
            }
          ?>]
            }],


        },


        // Configuration options go here
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });

         var ctx = document.getElementById('target-penjualan').getContext('2d');
         var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',
        // The data for our dataset
        data: {
            labels: [
            <?php
            if (count($target_pen)>0) {
              foreach ($target_pen as $data) {
                echo "'" .bulan($data->bulan)."',";
              }
            }
          ?>
            ],

            datasets: [{
                label:'Grafik Target Penjualan',
                backgroundColor: ['rgb(255, 99, 132)', 'rgba(56, 86, 255, 0.87)', 'rgb(60, 179, 113)','rgb(175, 238, 239)'],
                borderColor: ['rgb(255, 99, 132)'],
                data: [<?php
            if (count($target_pen)>0) {
              foreach ($target_pen as $data) {
                echo "'" .$data->pencapaian."',";
              }
            }
          ?>]
            }],


        },


        // Configuration options go here
       options: {
        //konfigurasi tooltip
        tooltips: {
            callbacks: {
                label: function(tooltipItem, data) {
                    var dataset = data.datasets[tooltipItem.datasetIndex];
                    var labels = data.labels[tooltipItem.index];
                    var currentValue = dataset.data[tooltipItem.index];
                    return labels+": "+currentValue+" %";
                }
            }
        }
      }
});

         var ctx = document.getElementById('target-omset').getContext('2d');
         var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',
        // The data for our dataset
        data: {
            labels: [
            <?php
            if (count($target_omset)>0) {
              foreach ($target_omset as $data) {
                echo "'" .bulan($data->bulan)."',";
              }
            }
          ?>
            ],

            datasets: [{
                label:'Grafik Target Omset',
                backgroundColor: ['rgb(255, 99, 132)', 'rgba(56, 86, 255, 0.87)', 'rgb(60, 179, 113)','rgb(175, 238, 239)'],
                borderColor: ['rgb(255, 99, 132)'],
                data: [<?php
            if (count($target_omset)>0) {
              foreach ($target_omset as $data) {
                echo "'" .$data->pencapaian."',";
              }
            }
          ?>]
            }],


        },


        // Configuration options go here
       options: {
        //konfigurasi tooltip
        tooltips: {
            callbacks: {
                label: function(tooltipItem, data) {
                    var dataset = data.datasets[tooltipItem.datasetIndex];
                    var labels = data.labels[tooltipItem.index];
                    var currentValue = dataset.data[tooltipItem.index];
                    return labels+": "+currentValue+" %";
                }
            }
        }
      }
});

       
 

</script>
		