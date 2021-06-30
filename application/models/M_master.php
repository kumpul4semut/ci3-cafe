<?php
defined('BASEPATH') or exit ('No Direct Script Access Allowed');

/**
* 
*/
class M_master extends CI_model{
    function edit_data($where,$table){
        return $this->db->get_where($table,$where);
    }

    function get_data($table){
        return $this->db->get($table);
    }

    function insert_data($data,$table) {
         $this->db->insert($table,$data);
         $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }

    public function insert($data, $table)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function insert_konfirmasi($data) {
         $this->db->insert('pembayaran',$data);
          $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }

    function update_data($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    }   

    function delete_data($where,$table){
        $this->db->where($where);
        $result = $this->db->delete($table);
        return $result;
    }


    
    

    public function get_daftarmenu()
    {
        $this->db->select('dm.*,k.nama_kategori');
        $this->db->from('daftar_menu dm');
        $this->db->join('kategori k','k.id_kategori = dm.id_kategori', "left");
       
        return $this->db->get();
    }

  


}


?>