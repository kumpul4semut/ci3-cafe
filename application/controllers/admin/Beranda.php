<?php
defined('BASEPATH') or exit('No Direct Script Access Allowed');


/**
 * 
 */
class Beranda extends CI_Controller
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

		$data['jumlah_meja'] = $this->db->get('meja')->num_rows();
		$data['jumlah_menu'] = $this->db->get('daftar_menu')->num_rows();
		$data['jumlah_pesanan_proses'] = $this->db->get_where('pesanan', ['status' => 'proses'])->num_rows();


		$this->load->view('admin/inc/v_header');
		$this->load->view('admin/v_beranda', $data);
		$this->load->view('admin/inc/v_footer');
	}


	function logout()
	{

		$this->session->sess_destroy();

		redirect(base_url() . 'admin/auth?pesan=logout');
	}

	public function notif()
	{
		$this->db->select('notifikasi.*');
		$this->db->from('notifikasi');
		$this->db->where('ke', $this->session->userdata('id_user'));
		$this->db->where('status_read', 0);
		$this->db->order_by('id_notifikasi', 'desc');
		$result = $this->db->get();

		$respon = [
			'jumlah_notif' => $result->num_rows(),
			'data' => $result->result_array(),
		];

		echo json_encode($respon);
	}
}
