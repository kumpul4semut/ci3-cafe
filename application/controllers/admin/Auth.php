<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('M_login', 'l');
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
		
		$this->load->view('admin/v_login');
	}

	

	function login(){
	$u= $this->input->post('username');
	$p = $this->input->post('password');
	$this->form_validation->set_rules('username','Username','trim|required');
	$this->form_validation->set_rules('password','Password','trim|required');
	if($this->form_validation->run() != false){
	$where = array('username' => $u, 'password' => sha1($p));

	$data = $this->l->edit_data($where,'user');
	$d = $this->l->edit_data($where,'user')->row();
	$cek = $data->num_rows();

	if($cek > 0){
	$session = array('id_user' => $d->id_user, 'nama' => $d->nama,'level' => $d->level, 'status' => 'login');
	$this->session->set_userdata($session);
	redirect(base_url().'admin/beranda');
	}else{
	$this->session->set_flashdata('alert','Masuk gagal ! Nama pengguna dan kata sandi salah.');
	redirect(base_url().'admin/auth');
	}
	}else{
	$this->session->set_flashdata('alert','Anda Belum mengisi nama pengguna atau kata sandi');
	$this->load->view('admin/v_login');
	}
	}

	
	
}
