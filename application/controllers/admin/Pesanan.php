<?php
defined('BASEPATH') or exit('No Direct Script Access Allowed');

class Pesanan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        //cek login
        if ($this->session->userdata('status') != "login") {

            redirect(base_url() . 'admin/auth?pesan=belumlogin');
        }
        $this->level = $this->session->userdata('level');
        $this->id_user = $this->session->userdata('id_user');
        $this->nama = $this->session->userdata('nama');
        $this->load->model('m_master', 'mm');
    }


    function index($id_notifikasi = null)
    {
        if ($id_notifikasi) {
            $this->db->where('id_notifikasi', $id_notifikasi);
            $this->db->set('status_read', 1);
            $this->db->update('notifikasi');
        }

        $data['meja'] = $this->mm->get_data('meja')->result();
        $data['daftar_menu'] = $this->mm->get_data('daftar_menu')->result();
        // $data['metode'] = $this->mm->get_data('metode')->result();

        $relation = [
            'pelanggan' => [
                'table' => 'pelanggan',
                'key' => 'pesanan.id_pelanggan=pelanggan.id_pelanggan'
            ],
            'meja' => [
                'table' => 'meja',
                'key' => 'pesanan.id_meja=meja.id_meja'
            ],
        ];

        $selected = 'pesanan.*, pelanggan.*, meja.nama_meja';
        $order = [
            'field' => 'pesanan.id_pesanan',
            'direction' => 'DESC',
        ];
        $data['pesanan'] = $this->mm->get_related_data('pesanan', $relation, [], $selected, $order)->result();
        foreach ($data['pesanan'] as $key => $d_pesanan) {
            $data['pesanan'][$key]->detail_pesanan = $this->db->get_where('detail_pesanan', ['kode_pesanan' => $d_pesanan->kode_pesanan])->result();
        }
        $this->load->view('admin/inc/v_header');
        $this->load->view('admin/v_pesanan', $data);
        $this->load->view('admin/inc/v_footer');
    }


    function simpan()
    {

        $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('no_tlp', 'Nomor Telepon', 'required');
        $this->form_validation->set_rules('id_meja', 'Meja', 'required');
        $this->form_validation->set_rules('tgl_pemesanan', 'Tanggal Pemesanan', 'required');
        $this->form_validation->set_rules('jam_pesan', 'Jam Pesan', 'required');
        $this->form_validation->set_rules('menu[]', 'Menu', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            // create pelanggan
            $id_pelanggan = $this->save_pelanggan();

            // create pesanan
            $id_pesanan = $this->save_pesanan($id_pelanggan);

            // create detail pesanan
            $where_pesanan['id_pesanan'] = $id_pesanan;
            $pesanan = $this->db->get_where('pesanan', $where_pesanan)->row();
            $kode_pesanan = $pesanan->kode_pesanan;
            $kode_transaksi = $pesanan->kode_transaksi;
            $this->save_detail_pesanan($kode_pesanan);

            // update pesanan
            $relation = [
                'daftar_menu' => [
                    'table' => 'daftar_menu',
                    'key' => 'detail_pesanan.id_menu=daftar_menu.id_menu'
                ],
            ];

            $where_detail_pesanan['kode_pesanan'] = $kode_pesanan;
            $selected = 'detail_pesanan.*, daftar_menu.*';

            $detail_pesanan = $this->mm->get_related_data('detail_pesanan', $relation, $where_detail_pesanan, $selected)->result();
            $jumlah_pesan = 0;
            $jumlah_bayar = 0;
            foreach ($detail_pesanan as $data) {
                $jumlah_pesan += $data->jumlah;
                $jumlah_bayar += ($data->harga * $data->jumlah);
            }

            // pesanan
            $data_update['jumlah_pesan'] = $jumlah_pesan;
            $data_update['jumlah_bayar'] = $jumlah_bayar;

            // transaksi
            $data_update_trx['jumlah_pesan'] = $jumlah_pesan;
            $data_update_trx['jumlah_harga'] = $jumlah_bayar;

            $where_pesanan_update['kode_pesanan'] = $kode_pesanan;
            $where_transaksi_update['kode_transaksi'] = $kode_transaksi;
            // update pesanan
            $this->mm->update_data($where_pesanan_update, $data_update, 'pesanan');
            // update transaksi
            $this->mm->update_data($where_transaksi_update, $data_update_trx, 'transaksi');
            // end update pesanan

            $this->session->set_flashdata('sukses', "Data Berhasil Disimpan");
            redirect('admin/pesanan');
        }
    }

    public function bayar()
    {
        // $this->form_validation->set_rules('id_metode', 'Metode', 'required');
        $this->form_validation->set_rules('jumlah_bayar', 'Jumlah Bayar', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $kode_transaksi = $this->db->get_where('pesanan', ['id_pesanan' => $_POST['id_pesanan']])->row()->kode_transaksi;
            // update transaksi
            // $data['id_metode'] = $_POST['id_metode'];
            $data['jumlah_bayar'] = $_POST['jumlah_bayar'];

            $where['kode_transaksi'] = $kode_transaksi;
            $this->mm->update_data($where, $data, 'transaksi');
            $this->session->set_flashdata('sukses', "Data Berhasil Disimpan Cetak Struk untuk detail");
            redirect('admin/pesanan');
        }
    }

    public function print_nota($kode_pesanan = null)
    {
        // $this->load->view("admin/v_print_nota");



        //pesanan
        $this->db->select('pesanan.*, meja.nama_meja');
        $this->db->from('pesanan');
        $this->db->join('meja', 'pesanan.id_meja = meja.id_meja', 'left');
        $this->db->where('kode_pesanan', $kode_pesanan);
        $pesanan = $this->db->get()->row();
        // end pesanan

        $data['pesanan'] = $pesanan;
        $data['pelanggan'] = $this->db->get_where('pelanggan', ['id_pelanggan' => $pesanan->id_pelanggan])->row();
        $data['transaksi'] = $this->db->get_where('transaksi', ['kode_transaksi' => $pesanan->kode_transaksi])->row();

        // menu
        $this->db->select('detail_pesanan.*, daftar_menu.nama_menu, daftar_menu.harga');
        $this->db->from('detail_pesanan');
        $this->db->join('daftar_menu', 'detail_pesanan.id_menu = daftar_menu.id_menu', 'left');
        $this->db->where('detail_pesanan.kode_pesanan', $pesanan->kode_pesanan);
        $data['menu_select'] = $this->db->get()->result();

        error_reporting(0);
        require FCPATH . "vendor/autoload.php";

        $dompdf = new Dompdf\Dompdf();
        $html = $this->load->view("admin/v_print_nota", $data, true);

        $dompdf->loadHTML($html);
        $dompdf->render();
        $filename = "Nota";
        $dompdf->stream($filename . '.pdf', array('Attachment' => 0));
    }

    public function detail($kode_pesanan = null)
    {
        if (isset($kode_pesanan)) {

            // pesanan
            $this->db->select('pesanan.*, meja.nama_meja');
            $this->db->from('pesanan');
            $this->db->join('meja', 'pesanan.id_meja = meja.id_meja', 'left');
            $this->db->where('kode_pesanan', $kode_pesanan);
            $pesanan = $this->db->get()->row();
            // end pesanan

            $data['pesanan'] = $pesanan;
            $data['pelanggan'] = $this->db->get_where('pelanggan', ['id_pelanggan' => $pesanan->id_pelanggan])->row();
            $data['transaksi'] = $this->db->get_where('transaksi', ['kode_transaksi' => $pesanan->kode_transaksi])->row();

            // menu
            $this->db->select('detail_pesanan.*, daftar_menu.nama_menu, daftar_menu.harga');
            $this->db->from('detail_pesanan');
            $this->db->join('daftar_menu', 'detail_pesanan.id_menu = daftar_menu.id_menu', 'left');
            $this->db->where('detail_pesanan.kode_pesanan', $pesanan->kode_pesanan);
            $data['menu_select'] = $this->db->get()->result();

            $this->load->view('admin/inc/v_header');
            $this->load->view('admin/v_pesanan_detail', $data);
            $this->load->view('admin/inc/v_footer');
        }
    }

    public function edit()
    {
        // edit pelanggan
        $id_pelanggan = $this->save_pelanggan($is_edit = true);

        // edit pesanan
        $id_pesanan = $this->edit_pesanan();

        // jika pilihan menu berubah
        $where_pesanan['id_pesanan'] = $_POST['id_pesanan'];
        $pesanan = $this->db->get_where('pesanan', $where_pesanan)->row();
        $kode_pesanan = $pesanan->kode_pesanan;
        $kode_transaksi = $pesanan->kode_transaksi;
        $this->edit_detail_pesanan($kode_pesanan);

        // update pesanan
        $relation = [
            'daftar_menu' => [
                'table' => 'daftar_menu',
                'key' => 'detail_pesanan.id_menu=daftar_menu.id_menu'
            ],
        ];

        $where_detail_pesanan['kode_pesanan'] = $kode_pesanan;
        $selected = 'detail_pesanan.*, daftar_menu.*';

        $detail_pesanan = $this->mm->get_related_data('detail_pesanan', $relation, $where_detail_pesanan, $selected)->result();
        $jumlah_pesan = 0;
        $jumlah_bayar = 0;
        foreach ($detail_pesanan as $data) {
            $jumlah_pesan += $data->jumlah;
            $jumlah_bayar += ($data->harga * $data->jumlah);
        }

        // pesanan
        $data_update['jumlah_pesan'] = $jumlah_pesan;
        $data_update['jumlah_bayar'] = $jumlah_bayar;

        // transaksi
        $data_update_trx['jumlah_pesan'] = $jumlah_pesan;
        $data_update_trx['jumlah_harga'] = $jumlah_bayar;

        $where_pesanan_update['kode_pesanan'] = $kode_pesanan;
        $where_transaksi_update['kode_transaksi'] = $kode_transaksi;
        // update pesanan
        $this->mm->update_data($where_pesanan_update, $data_update, 'pesanan');
        // update transaksi
        $this->mm->update_data($where_transaksi_update, $data_update_trx, 'transaksi');
        // end update pesanan

        $this->session->set_flashdata('sukses', "Data Berhasil Diubah");
        redirect('admin/pesanan');
    }

    public function ubah_status()
    {
        $this->form_validation->set_rules('status[]', 'Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $this->db->select('pesanan.*, meja.nama_meja');
            $this->db->from('pesanan');
            $this->db->join('meja', 'pesanan.id_meja = meja.id_meja', 'left');
            $this->db->where('pesanan.id_pesanan',  $_POST['id_pesanan']);

            //$pesanan_select = $this->db->get_where('pesanan', ['id_pesanan' => $_POST['id_pesanan']])->row_array();
            $pesanan_select = $this->db->get()->row_array();
            $status = '';
            foreach ($_POST['status'] as $data) {
                $status = $data;
            }
            if ($pesanan_select['status'] == 'menunggu' && $status == 'terbooking') {
                # notif email ke pelanggan
                $this->db->select('detail_pesanan.*, daftar_menu.nama_menu, daftar_menu.harga');
                $this->db->from('detail_pesanan');
                $this->db->join('daftar_menu', 'detail_pesanan.id_menu = daftar_menu.id_menu', 'left');
                $this->db->where('detail_pesanan.kode_pesanan',  $pesanan_select['kode_pesanan']);

                $data = [
                    'menu_select' => $this->db->get()->result_array(),
                    'pesanan' => $pesanan_select,
                ];

                $message = $this->load->view('admin/v_email', $data, true);
                $data_notif = [
                    'to' =>  $this->db->get_where('pelanggan', ['id_pelanggan' => $pesanan_select['id_pelanggan']])->row()->email,
                    'message' => $message,
                ];
                $send_email = $this->notif_email($data_notif);
                if ($send_email) {
                    $this->db->where('id_pesanan', $_POST['id_pesanan']);
                    foreach ($_POST['status'] as $status) {
                        $this->db->set('status', $status);
                    }

                    $this->db->update('pesanan');
                    $this->session->set_flashdata('sukses', "Data Berhasil Diubah");
                    $this->index();
                }
            } elseif ($pesanan_select['status'] != 'proses' && $status == 'proses') {
                // create notifikasi
                $meja = $this->db->get_where('meja', ['id_meja' =>  $this->db->get_where('pesanan', ['kode_pesanan' => $pesanan_select['kode_pesanan']])->row()->id_meja])->row()->nama_meja;

                $isi = 'Pesanan ' . $meja . ' dalam proses';

                // create notif
                $data_notif = [
                    'dari' => 'pelanggan',
                    'ke' => $this->db->get_where('user', ['level' => 'koki'])->row()->id_user,
                    'judul' => 'Pesanan proses',
                    'isi' => $isi,
                    'status_read' => 0,
                ];
                $this->db->insert('notifikasi', $data_notif);

                $this->db->where('id_pesanan', $_POST['id_pesanan']);
                foreach ($_POST['status'] as $status) {
                    $this->db->set('status', $status);
                }

                if ($this->db->update('pesanan')) {
                    $this->session->set_flashdata('sukses', "Data Berhasil Diubah");
                    redirect('admin/pesanan');
                }
            } elseif ($pesanan_select['status'] != 'selesai' && $status == 'selesai') {
                $detail_pesanan = $this->db->get_where('detail_pesanan', ['kode_pesanan' => $pesanan_select['kode_pesanan']])->result_array();
                foreach ($detail_pesanan as $d_detail) {
                    $daftar_menu = $this->db->get_where('daftar_menu', ['id_menu' => $d_detail['id_menu']])->row_array();
                    $new_stok = ($daftar_menu['stok'] - $d_detail['jumlah']);
                    $this->db->set('stok', $new_stok);
                    $this->db->where('id_menu', $d_detail['id_menu']);
                    $this->db->update('daftar_menu');
                }


                $this->db->where('id_pesanan', $_POST['id_pesanan']);
                foreach ($_POST['status'] as $status) {
                    $this->db->set('status', $status);
                }

                if ($this->db->update('pesanan')) {
                    $this->session->set_flashdata('sukses', "Data Berhasil Diubah");
                    redirect('admin/pesanan');
                }
            } else {
                $this->db->where('id_pesanan', $_POST['id_pesanan']);
                foreach ($_POST['status'] as $status) {
                    $this->db->set('status', $status);
                }

                if ($this->db->update('pesanan')) {
                    $this->session->set_flashdata('sukses', "Data Berhasil Diubah");
                    redirect('admin/pesanan');
                }
            }
        }
    }

    public function on_change_time()
    {
        $tgl_pemesanan = $_POST['tgl_pemesanan'];
        $jam_pesan = $_POST['jam_pesan'];


        $this->db->where('tgl_pemesanan',  $tgl_pemesanan);
        $this->db->where('jam_pesan',  $jam_pesan);
        $this->db->where('status', 'proses');
        $pesanan1 = $this->db->get('pesanan')->result_array();

        $this->db->where('tgl_pemesanan',  $tgl_pemesanan);
        $this->db->where('jam_pesan',  $jam_pesan);
        $this->db->where('status', 'terbooking');
        $pesanan2 = $this->db->get('pesanan')->result_array();

        $pesanan = array_merge($pesanan1, $pesanan2);

        $meja = $this->mm->get_data('meja')->result_array();
        foreach ($pesanan as $d_psn) {
            foreach ($meja as $key => $d_meja) {
                if ($d_psn['id_meja'] == $d_meja['id_meja']) {
                    $meja[$key]['terbooking'] = true;
                }
            }
        }


        $respon = [
            'message' => 'sukses',
            'post' => $tgl_pemesanan . $jam_pesan,
            'data' => $meja,
        ];
        echo json_encode($respon);
    }


    protected function save_pelanggan($is_edit = null)
    {
        $data['nama_pelanggan'] = $_POST['nama_pelanggan'];
        $data['email'] = $_POST['email'];
        $data['no_tlp'] = $_POST['no_tlp'];
        if (isset($is_edit)) {
            $where['id_pelanggan'] = $_POST['id_pelanggan'];
            return $this->mm->update_data($where, $data, 'pelanggan');
        } else {
            return $this->mm->insert($data, 'pelanggan');
        }
    }

    protected function edit_pesanan()
    {
        $data['id_meja'] = $_POST['id_meja'];
        $data['tgl_pemesanan'] = $_POST['tgl_pemesanan'];
        $data['jam_pesan'] = $_POST['jam_pesan'];
        $where['id_pesanan'] = $_POST['id_pesanan'];
        return $this->mm->update_data($where, $data, 'pesanan');
    }

    protected function edit_detail_pesanan($kode_pesanan)
    {

        $menu_selecteds = $_POST['menu'];
        foreach ($menu_selecteds as $id_menu) {
            // cek stoknya jika melebihi error ya 
            $where_menu['id_menu'] = $id_menu;
            $daftar_menu = $this->db->get_where('daftar_menu', $where_menu)->row();
            if ($_POST['jumlah_' . $id_menu] > $daftar_menu->stok) {
                $this->session->set_flashdata('error', "Jumlah pesanan melebihi stok");
                return $this->index();
            }
            //hapus semua dulu 
            $this->db->where('kode_pesanan',  $kode_pesanan);
            $this->db->delete('detail_pesanan');

            //lalu tambah baru
            $data['id_menu'] = $id_menu;
            $data['kode_pesanan'] = $kode_pesanan;
            $data['jumlah'] = $_POST['jumlah_' . $id_menu];
            $this->mm->insert($data, 'detail_pesanan');
        }
    }

    protected function save_pesanan($id_pelanggan)
    {
        // kode_pesanan
        $config_psn['kolom'] = 'kode_pesanan';
        $config_psn['table'] = 'pesanan';
        $config_psn['kode'] = 'PSN';

        // kode_transaksi
        $config_trx['kolom'] = 'kode_transaksi';
        $config_trx['table'] = 'transaksi';
        $config_trx['kode'] = 'TRX';

        // save ke table transaksi
        $data_trx['kode_transaksi'] =  $this->mm->genkode($config_trx);
        $id_transaksi = $this->mm->insert($data_trx, 'transaksi');
        $kode_transaksi =  $this->db->get_where('transaksi', ['id_transaksi' => $id_transaksi])->row()->kode_transaksi;;

        // save ke table pesanan
        $data['id_pelanggan'] = $id_pelanggan;
        $data['id_meja'] = $_POST['id_meja'];
        $data['kode_pesanan'] = $this->mm->genkode($config_psn);
        $data['kode_transaksi'] =  $kode_transaksi;
        $data['tgl_pemesanan'] = $_POST['tgl_pemesanan'];
        $data['jam_pesan'] = $_POST['jam_pesan'];
        $data['jumlah_pesan'] = '';
        $data['jumlah_bayar'] = '';

        // jika tgl_pemesanan hari ini status proses jika besok terbooking
        $date_now = date("Y-m-d");
        if ($_POST['tgl_pemesanan'] > $date_now) {
            $data['status'] = 'terbooking';  //'menunggu', 'terbooking', 'proses', 'selesai'
        } else {
            $data['status'] = 'proses';  //'menunggu', 'terbooking', 'proses', 'selesai'
        }
        return $this->mm->insert($data, 'pesanan');
    }

    protected function save_detail_pesanan($kode_pesanan)
    {

        $menu_selecteds = $_POST['menu'];
        foreach ($menu_selecteds as $id_menu) {
            // cek stoknya jika melebihi error ya 
            $where_menu['id_menu'] = $id_menu;
            $daftar_menu = $this->db->get_where('daftar_menu', $where_menu)->row();
            if ($_POST['jumlah_' . $id_menu] > $daftar_menu->stok) {
                $this->session->set_flashdata('error', "Jumlah pesanan melebihi stok");
                return $this->index();
            }

            $data['id_menu'] = $id_menu;
            $data['kode_pesanan'] = $kode_pesanan;
            $data['jumlah'] = $_POST['jumlah_' . $id_menu];
            $this->mm->insert($data, 'detail_pesanan');
        }
    }

    protected function notif_email($data_notif)
    {

        // with email
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'bugelcornerr@gmail.com',
            'smtp_pass' => 'bugel@2021',
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1'
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");

        $this->email->from('bugelcornerr@gmail.com', 'bugelcornerr@gmail.com');
        $this->email->to($data_notif['to']);
        $this->email->subject('Pesanan Terbooking');
        $this->email->message($data_notif['message']);

        if ($this->email->send()) {
            return true;
        } else {
            show_error($this->email->print_debugger());
        }
    }
}
