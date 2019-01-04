<?php

class Detailberitamodel extends CI_Model {

    function __construct() {
        // Memanggil Constructor Model
        parent::__construct();
    }

    function tambah_detailberita($kode_jadi,$pwk_code) {
        $data = array(
            'arsip_kd' => $kode_jadi,
            'halaman' => $_POST ['halaman'],
            'pwk_code' => $pwk_code
        );
        $this->db->insert('tbl_detail_berita', $data);
    }
    
    function delete_detail($id,$pwk_code) {
        $this->db->where('arsip_kd', $id);
        $this->db->where('pwk_code', $pwk_code);
        $this->db->delete('tbl_detail_berita');
    }

    function detail_berita($id) {
        $this->db->select('*');
        $this->db->from('tbl_detail_berita');
        $this->db->where('tbl_detail_berita.arsip_kd', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
}

?>
