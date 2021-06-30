<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('m_front', 'mm');
		$this->load->helper('tgl_indo');
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

		
		$data['berita'] = $this->mm->get_berita()->result();
		$data['menu'] = $this->mm->get_data('menu')->result();
		$data['pengaturan'] = $this->mm->get_data('pengaturan')->result();
		

		
		$this->load->view('v_header',$data);
		$this->load->view('v_berita',$data);
		$this->load->view('v_footer',$data);
	}

	public function baca($id_berita)//single post page
    {
        
        $data['total_komentar'] = $this->db->query("SELECT count(id_komentar) as total from komentar where id_berita ='$id_berita' ")->result();
        $data['berita_id'] = $this->mm->get_berita_id($id_berita)->result();
		$data['menu'] = $this->mm->get_data('menu')->result();
		$data['pengaturan'] = $this->mm->get_data('pengaturan')->result();
		$data['komentar'] = $this->mm->get_komentar($id_berita)->result();

        $this->load->view('v_header',$data);
		$this->load->view('v_baca',$data);
		$this->load->view('v_footer',$data);
    }


		function simpan_komentar($id_berita){


		$data['berita_id'] = $this->mm->get_berita_id($id_berita)->result();

		$this->form_validation->set_rules('komentar', 'Silahkan isi komentar', 'required');
		

		if($this->form_validation->run()==FALSE){
		$this->session->set_flashdata('error',"Data Gagal Di Tambahkan");
		redirect('admin/komentar');
		}else{

		$data=array(
		'id_berita'=>$_POST['id_berita'],
		'nama'=>$_POST['nama'],
		'email'=>$_POST['email'],
		'nohp'=>$_POST['nohp'],
		'komentar'=>$_POST['komentar']
		);
		}

		$this->mm->insert_data($data,'komentar');
		$this->session->set_flashdata('sukses',"Komentar sukses di kirim");
		redirect('berita/baca/'.$id_berita);

		}

	
}
