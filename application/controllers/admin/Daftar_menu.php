<?php
defined('BASEPATH') or exit('No Direct Script Access Allowed');


/**
 * 
 */
class Daftar_menu extends CI_Controller
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

		$data['daftar_menu'] = $this->mm->get_daftarmenu()->result();
		$data['kategori'] = $this->mm->get_data('kategori')->result();

		$this->load->view('admin/inc/v_header');
		$this->load->view('admin/v_daftarmenu', $data);
		$this->load->view('admin/inc/v_footer');
	}


	function simpan()
	{

		$this->form_validation->set_rules('nama_menu', 'Nama menu', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', "Data Gagal Di Tambahkan");
			redirect('admin/kategori');
		} else {

			$data = array(
				'id_kategori' => $_POST['id_kategori'],
				'nama_menu' => $_POST['nama_menu'],
				'stok' => $_POST['stok'],
				'harga' => $_POST['harga'],
				'status' => $_POST['status'],
			);
		}

		$this->mm->insert_data($data, 'daftar_menu');
		$this->session->set_flashdata('sukses', "Data Berhasil Disimpan");
		redirect('admin/daftar_menu');
	}


	function edit()
	{
		$id_menu = $this->input->post('id_menu');
		$this->form_validation->set_rules('nama_menu', 'Nama menu', 'required');
		if ($this->form_validation->run() != false) {
			$data = array(
				'id_kategori' => $_POST['id_kategori'],
				'nama_menu' => $_POST['nama_menu'],
				'stok' => $_POST['stok'],
				'harga' => $_POST['harga'],
				'status' => $_POST['status'],
			);
		}
		$where = array('id_menu' => $id_menu);
		$this->mm->update_data($where, $data, 'daftar_menu');
		$this->session->set_flashdata('sukses', "Data Berhasil Di ubah");
		redirect(base_url() . 'admin/daftar_menu');
	}


	function hapus($id_menu)

	{

		if ($id_menu == "") {

			$this->session->set_flashdata('error', "Data Anda Gagal Di Hapus");

			redirect('admin/daftar_menu');
		} else {

			$this->db->where('id_menu', $id_menu);

			$this->db->delete('daftar_menu');

			$this->session->set_flashdata('sukses', "Data Berhasil Dihapus");

			redirect('admin/daftar_menu');
		}
	}
}
