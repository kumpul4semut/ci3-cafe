<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tentang extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('m_front', 'mm');
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['tentang'] = $this->mm->get_data('tentang')->result();
		$data['menu'] = $this->mm->get_data('menu')->result();
		$data['pengaturan'] = $this->mm->get_data('pengaturan')->result();
		
		$this->load->view('v_header',$data);
		$this->load->view('v_tentang',$data);
		$this->load->view('v_footer',$data);
	}

	
}
