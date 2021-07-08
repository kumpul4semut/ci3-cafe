<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_front', 'mm');
	}

	public function index()
	{
		// $data['menu'] = $this->mm->get_data('menu')->result();
		// $data['slide'] = $this->mm->get_data('slide')->result();
		// $data['sambutan_kepsek'] = $this->mm->get_data('sambutan_kepsek')->result();
		// $data['sambutan_wakil'] = $this->mm->get_data('sambutan_wakil')->result();
		// $data['angka'] = $this->mm->get_data('data_angka')->result();
		// $data['galeri'] = $this->mm->get_data('galeri')->result();
		// $data['berita'] = $this->mm->get_data('berita')->result();
		// $data['pengaturan'] = $this->mm->get_data('pengaturan')->result();

		$this->load->view('v_header');
		$this->load->view('v_home');
		$this->load->view('v_footer');
	}
}
