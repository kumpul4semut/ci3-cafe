<?php
defined('BASEPATH') or exit ('No Direct Script Access Allowed');

/**
* 
*/
class M_login extends CI_model{
	
    function edit_data($where,$table){
		return $this->db->get_where($table,$where);
	}



}


?>