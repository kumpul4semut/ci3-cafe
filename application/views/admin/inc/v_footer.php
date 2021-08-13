</body>

<script>
    function onSelectMenu(id_menu = null) {
        var name = `jumlah_${id_menu}`
        if ($("input[name=" + name + "]").prop('required')) {
            // $("input[name=" + name + "]").hide()
            $("input[name=" + name + "]").prop("required", false)
        } else {
            // $("input[name=" + name + "]").show()
            $("input[name=" + name + "]").prop("required", true)
        }

    }
    $(document).ready(function() {
        // on set jam dan tgl
        $("#tgl_pemesanan_add_offline").on('change', function() {
            let tgl_pemesanan = $(this).val()
            let jam_pesan = $("#jam_pesan_add_offline").val()
            $.ajax({
                url: "<?= base_url('admin/pesanan/on_change_time'); ?>",
                dataType: 'json',
                method: "POST",
                data: {
                    tgl_pemesanan: tgl_pemesanan,
                    jam_pesan: jam_pesan,
                },
                success: function(resp) {
                    $("#meja-offline").html('')
                    resp.data.map((item) => {
                        if (item.terbooking) {
                            $('#meja-offline').append(
                                `<option value="${item.id_meja}" disabled>${item.nama_meja} ( Terbooking )</option>`)
                        } else {
                            $('#meja-offline').append(
                                `<option value="${item.id_meja}" >${item.nama_meja}</option>`)
                        }
                    })

                },
                error: function(error) {
                    console.log(error)
                }

            });
        })

        $("#jam_pesan_add_offline").on('change', function() {
            let tgl_pemesanan = $("#tgl_pemesanan_add_offline").val()
            let jam_pesan = $(this).val()
            $.ajax({
                url: "<?= base_url('admin/pesanan/on_change_time'); ?>",
                dataType: 'json',
                method: "POST",
                data: {
                    tgl_pemesanan: tgl_pemesanan,
                    jam_pesan: jam_pesan,
                },
                success: function(resp) {
                    $("#meja-offline").html('')
                    resp.data.map((item) => {
                        $('#meja-offline').append(
                            `<option value="${item.id_meja}">${item.nama_meja}</option>`)
                    })
                },
                error: function(error) {
                    console.log(error)
                }

            });
        })
        // end on set jam dan tgl

        // notif
        setInterval(function() {

            $.ajax({
                url: "<?= base_url('admin/beranda/notif'); ?>",
                type: 'get',
                dataType: 'json',
                success: function(resp) {
                    console.log(resp)
                    if (resp.jumlah_notif > 0) {
                        $('#jumlah-notif').html(resp.jumlah_notif)
                        let url = "<?php if ($this->session->userdata('level') == 'kasir') {
                                        echo base_url('admin/pesanan/index/');
                                    } elseif ($this->session->userdata('level') == 'koki' || $this->session->userdata('level') == 'pelayan') {
                                        echo base_url('admin/list_pesanan/index/');
                                    } ?>"
                        $('#notif').html('')
                        resp.data.map((item) => {
                            $('#notif').append(
                                `<li><a href="${url+item.id_notifikasi }">${item.isi}</a></li>`)
                        })
                    }

                }
            });

        }, 2000)

    })
</script>

</html>