<?php
defined('BASEPATH') Or exit('No Direct Script Access Allowed');


/**
* 
*/
class Penjualan extends CI_Controller{

function __construct(){
parent::__construct();
//cek login
if ($this->session->userdata('status') != "login" ){
redirect(base_url().'auth?pesan=belumlogin');
}
$this->id_sales = $this->session->userdata('id_sales');
$this->nama = $this->session->userdata('nama');
$this->level = $this->session->userdata('level');
$this->load->model('m_master', 'mm');
$this->load->library('cart');
}


function index(){

$data['kode_penjualan']=$this->mm->ambil_kodepenjualan();
$data['produk'] = $this->mm->get_data('produk')->result();
$data['penjualan'] = $this->mm->get_data('penjualan')->result();
$data['content'] = 'admin/penjualan';
$data['cart'] = $this->cart->contents();
$data['sub'] = $this->cart->contents();
//print_r($data['cart']);
//die();
if (!$data['cart']) {
$data['message'] = '<p>Your cart is empty!</p>';
} else {
$data['message'] = $this->session->flashdata('message');
}

$id_sales = $this->id_sales;
  $data['po_notif'] = $this->mm->get_potoko($id_sales)->result();


$this->load->view('admin/inc/v_header',$data);
$this->load->view('admin/v_penjualan',$data);
$this->load->view('admin/inc/v_footer');

}

function save_penjualan(){



$data=array(
'kode_penjualan'=>$_POST['kode_penjualan1'],
'tgl_penjualan'=>date('Y-m-d'),
'total_produk'=>$_POST['total_produk'],
'total_harga'=>$_POST['total_harga'],
'pembuat'=>$this->nama

);
$this->mm->insert($data,'penjualan');



$kode_produk = $_POST['kode_produk'];



$result = array();
      foreach ($kode_produk as $key => $val) {
         $result[] = array(             
            'kode_penjualan' => $_POST['kode_penjualan'][$key],
            'kode_produk' => $_POST['kode_produk'][$key],
            'harga' => $_POST['harga'][$key],
            'jumlah' => $_POST['jumlah'][$key]         
         );      
      }      

 //print_r($result);
 // die();


$this->db->insert_batch('penjualan_produk',$result);

$kode_penjualan = $this->input->post('kode_penjualan1');


$kode_produk = $this->db->query("select kode_produk from penjualan_produk where kode_penjualan = '$kode_penjualan' group by kode_produk ")->row();

$jumlah = $this->db->query("select jumlah from penjualan_produk where kode_penjualan = '$kode_penjualan' ")->row();

$pstok = $this->db->query("select stok from produk where kode_produk = '$kode_produk->kode_produk' ")->row();

$calstok = $pstok->stok - $jumlah->jumlah;

//print_r($calstok);
//die();




$this->db->query("update produk set stok='$calstok' where kode_produk = '$kode_produk->kode_produk' ")->result_array();




//proses update
  





$this->cart->destroy();
$this->session->set_flashdata('sukses',"Data Berhasil Disimpan");
redirect('admin/penjualan');
}


public function add(){


$data = array(
'id' => $this->input->post('id'),
'name' => $this->input->post('name'),
'kode_produk' => $this->input->post('kode_produk'),
'qty' => $this->input->post('qty'),
'price' => $this->input->post('price')
);

$this->cart->insert($data);
$this->session->set_flashdata('sukses',"Data Berhasil Ditambahkan");
redirect('admin/penjualan');

}




public function remove($rowid){
 if ($id == "all") {
            $this->cart->destroy();
        } else {
            $data = array(
                'rowid' => $rowid,
                'qty' => 0
            );
            $this->cart->update($data);
        }
        redirect('admin/penjualan');

}




public function update_cart()
{
foreach ($_POST['cart'] as $id => $cart) {
$price = $cart['price'];
$amount = $price * $cart['qty'];

$this->Cart_model->update_cart($cart['rowid'], $cart['qty'], $price, $amount);
}

redirect('admin/penjualan');
}

public function del(){
$this->cart->destroy();
redirect('admin/penjualan');
}


public function pencarian(){
$keyword = $this->input->post('cari');
$data['produk']=$this->mm->pencarian_produk($keyword);
$this->load->view('admin/inc/v_header');
$this->load->view('admin/v_penjualan',$data);
$this->load->view('admin/inc/v_footer');
}


}