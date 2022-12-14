<div class="col-sm-12 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li class="active">Metode</li>
        </ol>
    </div>
    <!--/.row-->

    <br>


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"><svg class="glyph stroked male user ">
                        <use xlink:href="#stroked-male-user" />
                    </svg>
                    <a type="button" data-toggle="modal" data-target="#modal-tambah" style="text-decoration:none;cursor: pointer;">Tambah Metode</a>
                </div>
                <div class="panel-body">
                    <div class="box">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <?php $data = $this->session->flashdata('sukses');
                            if ($data != "") { ?>
                                <div id="notifikasi" class="alert alert-success rounded-md px-5 py-4 mb-2 bg-theme-9 text-white">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Sukses! </strong> <?= $data; ?>
                                </div>

                            <?php } ?>
                            <?php
                            $data2 = $this->session->flashdata('error');
                            if ($data2 != "") { ?>

                                <div id="notifikasi" class="alert alert-danger rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong> Error! </strong> <?= $data2; ?>
                                </div>
                            <?php } ?>

                        </div>
                    </div>

                    <table data-toggle="table" data-show-refresh="false" data-show-toggle="true" data-show-columns="true" data-search="true" data-pagination="true" data-sort-name="name" data-sort-order="desc">
                        <thead>
                            <tr>
                                <th data-field="no" data-sortable="true" width="10px"> No</th>
                                <th data-field="id" data-sortable="true">Nama Metode</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0;
                            foreach ($metode as $row) : $no++; ?>
                                <tr>
                                    <td data-field="no" width="10px"><?php echo $no; ?></td>
                                    <td data-field="nama_metode"><?php echo $row->nama_metode; ?></td>
                                    <td>

                                        <a type="button" data-toggle="modal" data-target="#modal-edit<?= $row->id_metode; ?>" class="ubah btn btn-primary btn-xs" style="cursor: pointer;"><i class="glyphicon glyphicon-edit"></i></a>
                                        <a class="hapus btn btn-danger btn-xs" href="<?php echo site_url('admin/metode/hapus/' . $row->id_metode); ?>" onclick="return confirm('Apakah Anda Ingin Menghapus Data <?= $row->nama_metode; ?> ?');" class="btn btn-danger btn-circle" data-popup="tooltip" data-placement="top" title="Hapus Data"><i class="glyphicon glyphicon-trash"></i></a>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- metode modal -->

<div class="modal fade bs-example-modal-lg" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Tambah</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url() ?>admin/metode/simpan" method="POST" enctype="multipart/form-data">

                    <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label align="left">Nama metode :</label>
                                    <input type="text" name="nama_metode" class="form-control" oninvalid="this.setCustomValidity('Form Ini Harus Di isi')" onchange="this.setCustomValidity('')" required>
                                </div>
                            </div>



                        </div>

                        <center><button type="submit" class="btn btn-success">Simpan</button></center>


                    </div>
                </form>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Tutup</button>

            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->




<!-- metode modal -->
<?php $no = 0;
foreach ($metode as $row) : $no++; ?>
    <div class="modal fade bs-example-modal-lg" id="modal-edit<?= $row->id_metode ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Ubah</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url() ?>admin/metode/edit" method="POST" enctype="multipart/form-data">


                        <input type="hidden" name="id_metode" value="<?= $row->id_metode ?>">

                        <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label align="left">Nama metode :</label>
                                        <input type="text" name="nama_metode" value="<?= $row->nama_metode ?>" class="form-control">
                                    </div>
                                </div>



                            </div>

                            <center><button type="submit" class="btn btn-success">Simpan</button></center>


                        </div>
                    </form>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Tutup</button>

                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php endforeach; ?>







<?php echo $this->session->flashdata("msg"); ?>


<script>
    $(function() {
        $('#hover, #striped, #condensed').click(function() {
            var classes = 'table';

            if ($('#hover').prop('checked')) {
                classes += ' table-hover';
            }
            if ($('#condensed').prop('checked')) {
                classes += ' table-condensed';
            }
            $('#table-style').bootstrapTable('destroy')
                .bootstrapTable({
                    classes: classes,
                    striped: $('#striped').prop('checked')
                });
        });
    });

    function rowStyle(row, index) {
        var classes = ['active', 'success', 'info', 'warning', 'danger'];

        if (index % 2 === 0 && index / 2 < classes.length) {
            return {
                classes: classes[index / 2]
            };
        }
        return {};
    }
</script>