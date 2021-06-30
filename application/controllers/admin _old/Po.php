<?php
defined('BASEPATH') Or exit('No Direct Script Access Allowed');


/**
* 
*/
class Po extends CI_Controller{

function __construct(){
parent::__construct();
//cek login
if ($this->session->userdata('status') != "login" ){
redirect(base_url().'auth?pesan=belumlogin');
}
$this->id_sales = $this->session->userdata('id_sales');
$this->nama = $this->session->userdata('nama');
$this->id = $this->session->userdata('id_pengguna');
$this->level = $this->session->userdata('level');
$this->load->model('m_master', 'mm');
}


function index(){

	
	$data['po']=$this->mm->get_po()->result();
	if(is_array($data['po'])){
		$i = 0;
		foreach($data['po'] as $v)
		{
			$data['po'][$i]->detail = $this->db->query('select a.*,(select nama_psales from produk_sales where kode_produk=a.kode_produk) as nama_psales,(select satuan from produk_sales where kode_produk=a.kode_produk) as satuan from po_produk a where kode_po="'.$v->kode_po.'"')->result();
			$i++;
		}
	}
	
	$data['psales'] = $this->db->query('select * from produk_sales where status="ADA"')->result();
	$data['kode_po']=$this->mm->ambil_kodepo();
	$data['sales']=$this->mm->get_data('sales')->result();
	//
	
	$id_sales = $this->id_sales;
	$data['po_notif'] = $this->mm->get_potoko($id_sales)->result();


	$this->load->view('admin/inc/v_header',$data);
	$this->load->view('admin/v_po',$data);
	$this->load->view('admin/inc/v_footer');

}


function save_po(){


$this->form_validation->set_rules('kode_po', 'Kode po', 'required');
$this->form_validation->set_rules('tgl_po', 'Tgl po', 'required');
$this->form_validation->set_rules('total_produk', ' ', 'trim');
$this->form_validation->set_rules('total_harga', ' ', 'trim');
$id_sales = $this->input->post('id_sales');

 



if($this->form_validation->run()==FALSE){
	$this->session->set_flashdata('error'," Data Gagal Di Tambahkan");
	redirect('admin/po');
}else{

	$data=array(
	'id_sales'=>$_POST['id_sales'],	
	'kode_po'=>$_POST['kode_po'],
	'tgl_po'=>date('Y-m-d'),
	'total_produk'=>$_POST['total_produk'],
	'total_harga'=>$_POST['total_harga'],
	'kategori'=>$_POST['kategori'],
	'status'=>'PROSES',
	'pembuat'=>$this->nama

	);


	 	$email_sales = $this->mm->ambil_email_sales($id_sales)->result();
	 	foreach ($email_sales as $es ) {
	 		
        $subject = 'Toko Mengirimkan PO dengan kode '.$this->input->post('kode_po');
        $message =  'Dear Sales , silahkan login untuk mengecek notifikasi dan melihat po toko terbaru <br> Link : '.base_url() ;

           $config = Array(  
            'protocol' => 'smtp',  
            'smtp_host' => 'ssl://smtp.googlemail.com',  
            'smtp_port' => 465,  
            'smtp_user' => 'tokoapp2020@gmail.com',   
            'smtp_pass' => 'Tokocom2020',   
            'mailtype' => 'html',   
            'charset' => 'iso-8859-1'  
           );  
            $this->load->library('email',$config); 
            $this->email->set_newline("\r\n"); 
            $this->email->from('tokoapp2020@gmail.com','Toko App');  
            $this->email->to($es->email_sales);  
            $this->email->subject($subject); 
            $this->email->message($message);    
            $this->email->set_mailtype('html');

            $this->email->send();

          }
	
	
	$id = $this->mm->insert_data($data,'po');
	
	$produk = $_POST['psales'];
	
	foreach($produk as $v){
		$temp = explode("_",$v);
		$kode_produk = $temp[0];
		$harga = $temp[2];
		$jumlah = $temp[1];
		
		$data_detail=array(
		'kode_po'=>$_POST['kode_po'],
		'kode_produk'=>$kode_produk,
		'harga'=>$harga,
		'jumlah'=>$jumlah,

		);
		
		$this->mm->insert_data($data_detail,'po_produk');		
	}


	$data_notif = array(
		'from_id' => $this->id , 
		'to_id' => $_POST['id_sales'] , 
		'rel_id'=>$_POST['kode_po'], 
		'tipe_notifikasi' => 'PO' , 
		'deskripsi_notifikasi' => $this->nama.' Mengirimkan PO Baru' , 
		'read' => '0' 

	);

	$this->mm->insert_data($data_notif,'notifikasi');	


       
	$this->session->set_flashdata('sukses',"Data Berhasil Disimpan");
	redirect('admin/po');
}



}
      

function edit_po(){
ini_set('Display_errors', 1);
$id_po = $this->input->post('id_po');
$this->form_validation->set_rules('id_sales', 'Nama Sales', 'required');
$this->form_validation->set_rules('kode_po', 'Kode po', 'required');
$this->form_validation->set_rules('tgl_po', 'Tgl po', 'required');
$this->form_validation->set_rules('total_produk', ' ', 'trim');
$this->form_validation->set_rules('total_harga', ' ', 'trim');
$this->form_validation->set_rules('kategori', 'Kategori', 'required');

if($this->form_validation->run() != false){
	$kode_po = $_POST['kode_po'];
	
	$data=array(
	'id_sales'=>$_POST['id_sales'],	
	'kode_po'=>$kode_po,
	'id_sales'=>$_POST['id_sales'],
	'tgl_po'=>date('Y-m-d'),
	'total_produk'=>$_POST['total_produk'],
	'total_harga'=>$_POST['total_harga'],
	'kategori'=>$_POST['kategori'],
	'pembuat'=>$this->nama

	);
	$where = array('id_po' => $id_po);
	$this->mm->update_data($where,$data,'po');
	
	$where = array('kode_po' => $kode_po);
	$this->mm->delete_data($where,'po_produk');
	
	print_r($kode_po);
	$produk = $_POST['psales'];


	
	foreach($produk as $v){
		$temp = explode("_",$v);
		$kode_produk = $temp[0];
		$harga = $temp[2];
		$jumlah = $temp[1];
		
		$data_detail=array(
		'kode_po'=>$_POST['kode_po'],
		'kode_produk'=>$kode_produk,
		'harga'=>$harga,
		'jumlah'=>$jumlah,

		);
		
		$this->mm->insert_data($data_detail,'po_produk');	

	}
	
	$this->session->set_flashdata('sukses',"Data Berhasil Di ubah");
	redirect(base_url().'admin/po');
}
else{
	$this->session->set_flashdata('error',validation_errors());
	redirect(base_url().'admin/po');
}	 

}


function hapus_po($kode_po)

{

if($kode_po==""){

$this->session->set_flashdata('error',"Data Anda Gagal Di Hapus");

redirect('admin/po');

}else{

$this->db->where('kode_po', $kode_po);

$this->db->delete('po');

$this->db->query("DELETE from po_produk where kode_po = '$kode_po' ");


$this->session->set_flashdata('sukses',"Data Berhasil Dihapus");

redirect('admin/po');

}
$this->db->where('kode_po', $kode_po);
$this->db->delete('po_produk');



}


}