<?php
defined('BASEPATH') Or exit('No Direct Script Access Allowed');


/**
* 
*/
class Po_toko extends CI_Controller{

function __construct(){
parent::__construct();
//cek login
if ($this->session->userdata('status') != "login" ){
redirect(base_url().'auth?pesan=belumlogin');
}
$this->id_sales = $this->session->userdata('id_sales');
$this->nama = $this->session->userdata('nama');
$this->id_sales = $this->session->userdata('id_sales');
$this->level = $this->session->userdata('level');
$this->load->model('m_master', 'mm');
}


function index(){


	$id_sales = $this->id_sales;
	$data['po']=$this->mm->get_potoko($id_sales)->result();
	
	
	$data['psales'] = $this->db->query('select * from produk_sales where status="ADA"')->result();
	$data['kode_po']=$this->mm->ambil_kodepo();
	$data['sales']=$this->mm->get_data('sales')->result();
	//
	
	$id_sales = $this->id_sales;
	$data['po_notif'] = $this->mm->get_potoko($id_sales)->result();


	$this->load->view('admin/inc/v_header',$data);
	$this->load->view('admin/v_potoko',$data);
	$this->load->view('admin/inc/v_footer');

}





function proses_po($kode_po)

{

if($kode_po==""){

$this->session->set_flashdata('error',"Data Anda Gagal Di Hapus");

redirect('admin/po_toko');

}else{

$where = $kode_po;

$this->db->query("UPDATE po set status='DIKIRIM' where kode_po = '$kode_po' ");

$data['po_produk'] = $this->db->query("SELECT pp.kode_produk as kode_produk , ps.nama_psales as nama_psales , pp.harga as harga , pp.jumlah as jumlah , ps.satuan as satuan , ps.gambar_psales as gambar_psales  from po_produk pp LEFT JOIN produk_sales ps on pp.kode_produk = ps.kode_produk where kode_po = '$where' GROUP BY pp.kode_produk ")->result();



foreach ($data['po_produk'] as $v) {

$product = $this->db->select('kode_produk')->where(['kode_produk' => $v->kode_produk])->get('produk')->num_rows();
//$product = $this->db->query("SELECT produk.* from produk where kode_produk = '$v->kode_produk' ")->num_rows();
//print_r($product);
//die();


if($product == 0){
$this->db->query("INSERT INTO produk (kode_produk,nama_produk,gambar_produk,hargapem,satuan,stok) VALUES ('$v->kode_produk','$v->nama_psales','$v->gambar_psales','$v->harga','$v->satuan' ,'$v->jumlah')");
}else{
$qty= $this->db->query("select p.stok + pp.jumlah as result from produk p left join po_produk pp on pp.kode_produk = p.kode_produk where kode_po ='$kode_po' GROUP BY pp.kode_produk ")->row();
//$qty2= $this->db->query("select po_produk.jumlah as jumlah from po_produk GROUP BY kode_produk")->row();
//$qty = $qty1 + $qty2;
//$calculate = print_r($qty->result);
//die();
//print_r(round($qty-result));
//die();
$this->db->query("update produk set stok='$qty->result',hargapem='$v->harga' where kode_produk = '$v->kode_produk' ");
//proses update
}
	
}




$this->session->set_flashdata('sukses',"Data Berhasil Diproses dan segera di kirim ke toko");

redirect('admin/po_toko');

}

}


}