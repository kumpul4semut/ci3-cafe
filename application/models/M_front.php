<?php
defined('BASEPATH') or exit ('No Direct Script Access Allowed');

/**
* 
*/
class M_front extends CI_model{
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

    function insert($data, $table)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
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

     public function get_sub()
    {
        $this->db->select('m.*');
        $this->db->from('menu m');
        $this->db->where('m.status','aktif');
       
        return $this->db->get();
    }


    public function get_berita()
    {
        $this->db->select('b.*,a.nama_admin,a.jabatan,a.foto');
        $this->db->from('berita b');
        $this->db->join('admin a','a.id_admin = b.id_admin', "left");
       
        return $this->db->get();
    }

     public function get_berita_id($id_berita)
    {
        $this->db->select('b.*,a.nama_admin,a.jabatan,a.foto');
        $this->db->from('berita b');
        $this->db->join('admin a','a.id_admin = b.id_admin', "left");
        $this->db->where('b.id_berita',$id_berita);
       
        return $this->db->get();
    }



     public function get_komentar($id_berita)
    {
        $this->db->select('k.*');
        $this->db->from('komentar k');
        $this->db->where('k.id_berita',$id_berita);
       
        return $this->db->get();
    }


   



}


?>