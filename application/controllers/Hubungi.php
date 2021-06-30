<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hubungi extends CI_Controller {
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
		$this->load->view('v_hubungi',$data);
		$this->load->view('v_footer',$data);
	}


	function simpan(){


		$this->form_validation->set_rules('nama_kontak', 'Nama Kontak', 'required');
		

		if($this->form_validation->run()==FALSE){
		$this->session->set_flashdata('error',"Data Gagal Di Tambahkan");
		redirect('hubungi');
		}else{

		$data=array(
		'nama_kontak'=>$_POST['nama_kontak'],
		'email_kontak'=>$_POST['email_kontak'],
		'text_kontak'=>$_POST['text_kontak']
		);
		}

		$this->mm->insert_data($data,'kontak');
		$this->session->set_flashdata('sukses',"Komentar sukses di kirim");
		redirect('hubungi');

		}

	
}
