<?php
defined('BASEPATH') or exit('No Direct Script Access Allowed');


/**
 * 
 */
class Metode extends CI_Controller
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

		$data['metode'] = $this->mm->get_data('metode')->result();

		$this->load->view('admin/inc/v_header');
		$this->load->view('admin/v_metode', $data);
		$this->load->view('admin/inc/v_footer');
	}


	function simpan()
	{

		$this->form_validation->set_rules('nama_metode', 'Nama metode', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', "Data Gagal Di Tambahkan");
			redirect('admin/metode');
		} else {

			$data = array(
				'nama_metode' => $_POST['nama_metode']
			);
		}

		$this->mm->insert_data($data, 'metode');
		$this->session->set_flashdata('sukses', "Data Berhasil Disimpan");
		redirect('admin/metode');
	}


	function edit()
	{
		$id_metode = $this->input->post('id_metode');
		$this->form_validation->set_rules('nama_metode', 'Nama metode', 'required');
		if ($this->form_validation->run() != false) {
			$data = array(
				'nama_metode' => $_POST['nama_metode'],
			);
		}
		$where = array('id_metode' => $id_metode);
		$this->mm->update_data($where, $data, 'metode');
		$this->session->set_flashdata('sukses', "Data Berhasil Di ubah");
		redirect(base_url() . 'admin/metode');
	}


	function hapus($id_metode)

	{

		if ($id_metode == "") {

			$this->session->set_flashdata('error', "Data Anda Gagal Di Hapus");

			redirect('admin/metode');
		} else {

			$this->db->where('id_metode', $id_metode);

			$this->db->delete('metode');

			$this->session->set_flashdata('sukses', "Data Berhasil Dihapus");

			redirect('admin/metode');
		}
	}
}
