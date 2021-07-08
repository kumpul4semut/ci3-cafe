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


    function index()
    {

        $data['meja'] = $this->mm->get_data('meja')->result();
        $data['daftar_menu'] = $this->mm->get_data('daftar_menu')->result();
        $data['metode'] = $this->mm->get_data('metode')->result();

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

        $selected = 'pesanan.*, pelanggan.nama_pelanggan, meja.nama_meja';

        $data['pesanan'] = $this->mm->get_related_data('pesanan', $relation, [], $selected)->result();

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
                $jumlah_bayar += $data->harga;
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
        $this->form_validation->set_rules('id_metode', 'Metode', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $kode_transaksi = $this->db->get_where('pesanan', ['id_pesanan' => $_POST['id_pesanan']])->row()->kode_transaksi;
            // update transaksi
            $data['id_metode'] = $_POST['id_metode'];
            $data['jumlah_bayar'] = $_POST['jumlah_bayar'];

            $where['kode_transaksi'] = $kode_transaksi;
            $this->mm->update_data($where, $data, 'transaksi');
            $this->session->set_flashdata('sukses', "Data Berhasil Disimpan Cetak Struk untuk detail");
            redirect('admin/pesanan');
        }
    }

    public function print_nota()
    {
        $this->load->view("admin/v_print_nota");
        // error_reporting(0);
        // require FCPATH . "vendor/autoload.php";

        // $faktur = $this->mm->pdf($kode_po);

        //print_r($faktur);

        //exit();



        // $dompdf = new Dompdf\Dompdf();
        // $html = $this->load->view("admin/v_print_faktur", [
        //     "faktur" => $faktur
        // ], true);

        // $dompdf->loadHTML($html);
        // $dompdf->render();
        // $filename = "Faktur";
        // $dompdf->stream($filename . '.pdf', array('Attachment' => 0));
    }


    protected function save_pelanggan()
    {
        $data['nama_pelanggan'] = $_POST['nama_pelanggan'];
        $data['email'] = $_POST['email'];
        $data['no_tlp'] = $_POST['no_tlp'];
        return $this->mm->insert($data, 'pelanggan');
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
}
