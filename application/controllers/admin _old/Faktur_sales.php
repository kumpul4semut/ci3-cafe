<?php
defined('BASEPATH') Or exit('No Direct Script Access Allowed');


/**
* 
*/
class Faktur_sales extends CI_Controller{

function __construct(){
parent::__construct();
//cek login
if ($this->session->userdata('status') != "login" ){
redirect(base_url().'auth?pesan=belumlogin');
}
$this->nama = $this->session->userdata('nama_sales');
$this->id_sales = $this->session->userdata('id_sales');
$this->level = $this->session->userdata('level');
$this->load->model('m_master', 'mm');
}


function index(){

	
	$id_sales = $this->id_sales;
	$data['po']=$this->mm->get_potoko($id_sales)->result();
	$data['faktur']=$this->mm->get_faktur_sales()->result();
	$data['kode_faktur']=$this->mm->ambil_kodefaktur();

	$id_sales = $this->id_sales;
	$data['po_notif'] = $this->mm->get_potoko($id_sales)->result();


	$this->load->view('admin/inc/v_header',$data);
	$this->load->view('admin/v_faktursales',$data);
	$this->load->view('admin/inc/v_footer');

}

function print_faktur($kode_po){

error_reporting(0);
require FCPATH . "vendor/autoload.php";



$faktur = $this->mm->pdf($kode_po);

//print_r($faktur);

//exit();



$dompdf = new Dompdf\Dompdf();
$html = $this->load->view("admin/v_print_faktur", [
"faktur" => $faktur
], true);

$dompdf->loadHTML($html);
$dompdf->render();
$filename = "Faktur";
$dompdf->stream($filename . '.pdf',array('Attachment'=>0));

}

function save_faktur(){

$this->form_validation->set_rules('kode_po', 'Kode PO', 'required');
$this->form_validation->set_rules('jatuh_tempo', 'Jatuh Tempo', 'required');



if($this->form_validation->run()==FALSE){
$this->session->set_flashdata('error',"Data Gagal Di Tambahkan");
redirect('admin/faktur_sales');
}else{


$data=array(
'kode_faktur'=>$_POST['kode_faktur'],
'kode_po'=>$_POST['kode_po'],
'jatuh_tempo'=>$_POST['jatuh_tempo'],
'status'=>'TAGIHAN',
'pembuat'=>$this->nama


);
}

$this->mm->insert_data($data,'faktur');
$this->session->set_flashdata('sukses',"Data Berhasil Disimpan");
redirect('admin/faktur_sales');

	
}


function edit_faktur(){
$id_faktur = $this->input->post('id_faktur');

$data = array(
'kode_faktur'=>$_POST['kode_faktur'],
'kode_po'=>$_POST['kode_po'],
'jatuh_tempo'=>$_POST['jatuh_tempo'],
'status'=>'TAGIHAN',
'pembuat'=>$this->nama
);


$where = array('id_faktur' => $id_faktur);
$this->mm->update_data($where,$data,'faktur');
$this->session->set_flashdata('sukses',"Data Berhasil Di ubah");
redirect(base_url().'admin/faktur_sales');
}


function hapus_faktur($kode_po)

{

if($kode_po==""){

$this->session->set_flashdata('error',"Data Anda Gagal Di Hapus");

redirect('admin/faktur_sales');

}else{

$this->db->where('kode_po', $kode_po);

$this->db->delete('faktur');

$this->db->query("DELETE from po_produk where kode_po = '$kode_po' ");
$this->db->query("DELETE from po where kode_po = '$kode_po' ");



$this->session->set_flashdata('sukses',"Data Berhasil Dihapus");

redirect('admin/faktur_sales');

}

}







}