<?php
defined('BASEPATH') or exit('No Direct Script Access Allowed');

class List_pesanan extends CI_Controller
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
        $array_id_menu_select = [];
        foreach ($data['pesanan'] as $key => $d_pesanan) {
            $data['pesanan'][$key]->detail_pesanan = $this->db->get_where('detail_pesanan', ['kode_pesanan' => $d_pesanan->kode_pesanan])->result();
        }
        $this->load->view('admin/inc/v_header');
        $this->load->view('admin/v_list_pesanan', $data);
        $this->load->view('admin/inc/v_footer');
    }

    public function ubah_status()
    {
        $this->form_validation->set_rules('status[]', 'Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $pesanan_select = $this->db->get_where('pesanan', ['id_pesanan' => $_POST['id_pesanan']])->row_array();
            $status = '';
            foreach ($_POST['status'] as $data) {
                $status = $data;
            }
            if ($pesanan_select['status'] != 'selesai' && $status == 'selesai') {
                $detail_pesanan = $this->db->get_where('detail_pesanan', ['kode_pesanan' => $pesanan_select['kode_pesanan']])->result_array();
                foreach ($detail_pesanan as $d_detail) {
                    // update stok
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
                    redirect('admin/list_pesanan');
                }
            } elseif ($pesanan_select['status'] != 'siap antar' && $status == 'siap antar') {
                // create notifikasi
                $meja = $this->db->get_where('meja', ['id_meja' =>  $this->db->get_where('pesanan', ['kode_pesanan' => $pesanan_select['kode_pesanan']])->row()->id_meja])->row()->nama_meja;

                $isi = 'Pesanan ' . $meja . ' siap antar';

                // create notif
                $data_notif = [
                    'dari' => 'pelanggan',
                    'ke' => $this->db->get_where('user', ['level' => 'pelayan'])->row()->id_user,
                    'judul' => 'Pesanan siap antar',
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
            } else {

                $this->db->where('id_pesanan', $_POST['id_pesanan']);
                foreach ($_POST['status'] as $status) {
                    $this->db->set('status', $status);
                }

                if ($this->db->update('pesanan')) {
                    $this->session->set_flashdata('sukses', "Data Berhasil Diubah");
                    redirect('admin/list_pesanan');
                }
            }
        }
    }


    public function detail($kode_pesanan = null)
    {
        if (isset($kode_pesanan)) {
            $this->load->view('admin/inc/v_header');
            $this->load->view('admin/v_pesanan_detail');
            $this->load->view('admin/inc/v_footer');
        }
    }
}
