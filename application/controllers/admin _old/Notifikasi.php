<?php
defined('BASEPATH') Or exit('No Direct Script Access Allowed');


/**
* 
*/
class Notifikasi extends CI_Controller{

function __construct(){
parent::__construct();
//cek login
if ($this->session->userdata('status') != "login" ){

redirect(base_url().'auth?pesan=belumlogin');
}
$this->id_sales = $this->session->userdata('id_sales');
$this->level = $this->session->userdata('level');
$this->id_sales = $this->session->userdata('id_sales');
$this->load->model('m_master', 'mm');
$this->load->helper('tgl_indo');
}



function get(){
$query = $this->db->query("SELECT n.* FROM notifikasi n WHERE n.read ='0' and n.to_id='$this->id_sales' ");

//print_r($query->result());

$result = $query->num_rows();

if($result > 0){
return $result;
echo $result;
}   

}


public function get_notif() {
	$notif = $this->db->query("SELECT n.* FROM notifikasi n WHERE n.read ='0' and n.to_id='$this->id_sales' and tipe_notifikasi='PO' order by id_notifikasi desc")->result();
	$data['count'] = $this->db->query("SELECT n.read FROM notifikasi n WHERE n.read ='0' and n.to_id='$this->id_sales'  ")->num_rows();
	$data['noread'] = $this->db->query("SELECT n.read FROM notifikasi n WHERE n.read ='0' and n.to_id='$this->id_sales' ")->num_rows();
	$result = array();
	
	foreach ($notif as $data) {
		$html='';
		
		$html .= '<a type="button" data-toggle="modal" data-target="#modal-po'.$data->rel_id.'">View</a><div class="flex items-center">';
		$html .= '<a  class="font-medium truncate mr-5">'.$data->tipe_notifikasi.'</a>';
		$html .= '<div class="text-xs text-gray-500 ml-auto whitespace-no-wrap">'.$data->date.'</div>';
		$html .= '</div>';
		$html .= '<div class="w-full truncate text-gray-600">'.$data->deskripsi_notifikasi.'</div>';
	
		$result[]['data']['html'] = $html;
	}
	
	echo json_encode($result);
}

public function notif_faktur() {
	$notif = $this->db->query("SELECT n.* FROM notifikasi n WHERE n.read ='0' and n.to_id='$this->id_sales' and tipe_notifikasi='BAYAR' order by id_notifikasi desc")->result();
	$data['count'] = $this->db->query("SELECT n.read FROM notifikasi n WHERE n.read ='0' and n.to_id='$this->id_sales'  ")->num_rows();
	$data['noread'] = $this->db->query("SELECT n.read FROM notifikasi n WHERE n.read ='0' and n.to_id='$this->id_sales' ")->num_rows();
	$result = array();
	
	foreach ($notif as $data) {
		$html='';
		
		$html .= '<a href="http://localhost/tetatrans/toko/admin/faktur_sales/print_faktur/'.$data->rel_id.'" target="_blank">View</a><div class="flex items-center">';
		$html .= '<a  class="font-medium truncate mr-5">'.$data->tipe_notifikasi.'</a>';
		$html .= '<div class="text-xs text-gray-500 ml-auto whitespace-no-wrap">'.$data->date.'</div>';
		$html .= '</div>';
		$html .= '<div class="w-full truncate text-gray-600">'.$data->deskripsi_notifikasi.'</div>';
	
		$result[]['data']['html'] = $html;
	}
	
	echo json_encode($result);
}

public function notif_po() {
	
$rel_id = $this->input->post('rel_id');
$data = array(
'read'=>'1'
);

$where = array('rel_id' => $rel_id);
$this->mm->update_data($where,$data,'notifikasi');
	
}




}