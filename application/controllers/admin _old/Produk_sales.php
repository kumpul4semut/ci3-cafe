<?php
defined('BASEPATH') Or exit('No Direct Script Access Allowed');


/**
* 
*/
class Produk_sales extends CI_Controller{

function __construct(){
parent::__construct();
//cek login
if ($this->session->userdata('status') != "login" ){
redirect(base_url().'auth/v2?pesan=belumlogin');
}
$this->id_sales = $this->session->userdata('id_sales');
$this->kode_sales = $this->session->userdata('kode_sales');
$this->nama_sales = $this->session->userdata('nama_sales');
$this->pembuat = $this->session->userdata('nama_sales');
$this->level = $this->session->userdata('level');
$this->load->model('M_master', 'mm');
$this->load->library('upload');
}


function index(){

	$kode_sales = $this->kode_sales;

	$data['psales']=$this->mm->get_produksales($kode_sales)->result();
	$data['kode_produk']=$this->mm->ambil_kodepsales();

	$id_sales = $this->id_sales;
	$data['po_notif'] = $this->mm->get_potoko($id_sales)->result();


	$this->load->view('admin/inc/v_header',$data);
	$this->load->view('admin/v_psales',$data);
	$this->load->view('admin/inc/v_footer');

}

function save_psales(){

$this->form_validation->set_rules('nama_psales', 'Nama Produk', 'required');
$this->form_validation->set_rules('harga', 'Harga', 'required');
$this->form_validation->set_rules('satuan', 'Satuan', 'required');
$this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
$this->form_validation->set_rules('status', 'Status', 'required');


if($this->form_validation->run()==FALSE){
$this->session->set_flashdata('error',"Data Gagal Di Tambahkan");
redirect('admin/produk');
}else{

//konfigurasi upload gambar
$config['upload_path'] = './uploads/gambar_psales/';
$config['allowed_types'] = '*';
$config['max_size'] = '*';
$config['file_name'] = 'psales'.time();
$this->load->library('upload',$config);
$this->upload->initialize($config);
if($this->upload->do_upload('gambar_psales')){
$image=$this->upload->data();

$data=array(
'kode_produk'=>$_POST['kode_produk'],
'nama_psales'=>$_POST['nama_psales'],
'harga'=>$_POST['harga'],
'satuan'=>$_POST['satuan'],
'jumlah'=>$_POST['jumlah'],
'status'=>$_POST['status'],
'gambar_psales' => $image['file_name'],
'pembuat'=>$_POST['pembuat']

);
}

$this->mm->insert_data($data,'produk_sales');
$this->session->set_flashdata('sukses',"Data Berhasil Disimpan");
redirect('admin/produk_sales');

	}
}
      

function edit_psales(){
$id_psales = $this->input->post('id_psales');
$old_pict =  $this->input->post('old_pict');
$this->form_validation->set_rules('nama_psales', 'Nama Produk', 'required');
$this->form_validation->set_rules('harga', 'Harga', 'required');
$this->form_validation->set_rules('satuan', 'Satuan', 'required');
$this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
$this->form_validation->set_rules('status', 'Status', 'required');
if($this->form_validation->run() != false){

//konfigurasi upload gambar
$config['upload_path'] = './uploads/gambar_psales/';
$config['allowed_types'] = '*';
$config['max_size'] = '*';
$config['file_name'] = 'psales'.time();
$this->load->library('upload',$config);
$this->upload->initialize($config);

$data = array(
'kode_produk'=>$_POST['kode_produk'],
'nama_psales'=>$_POST['nama_psales'],
'harga'=>$_POST['harga'],
'satuan'=>$_POST['satuan'],
'jumlah'=>$_POST['jumlah'],
'status'=>$_POST['status'],
'pembuat'=>$_POST['pembuat']
);
}

$cek_gambar = $_FILES['gambar_psales']['size'];
if($cek_gambar > 0){
//proses upload edit gambar produk
$this->upload->do_upload('gambar_psales');
@unlink('./uploads/gambar_psales/',$old_pict);
$gambar_psales = $this->upload->data();
$data['gambar_psales'] = $gambar_psales['file_name'];
$this->db->where('id_psales', $_POST['id_psales']);
}

$where = array('id_psales' => $id_psales);
$this->mm->update_data($where,$data,'produk_sales');
$this->session->set_flashdata('sukses',"Data Berhasil Di ubah");
redirect(base_url().'admin/produk_sales');
}


function hapus_psales($id_psales)

{

if($id_psales==""){

$this->session->set_flashdata('error',"Data Anda Gagal Di Hapus");

redirect('admin/produk_sales');

}else{

$this->db->where('id_psales', $id_psales);

$this->db->delete('produk_sales');

$this->session->set_flashdata('sukses',"Data Berhasil Dihapus");

redirect('admin/produk_sales');

}

}


}