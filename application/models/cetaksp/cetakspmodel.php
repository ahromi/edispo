<?php

class Cetakspmodel extends CI_Model {

    function __construct() {
        //Memanggil Constructor Model
        parent::__construct();
    }

    function tambah($data_fields=array()) {
        $data = array(
            'sp_number' => $data_fields['sp_number'],
            'print_date'=>date('Y-m-d H:i:s'),
            'printed_by'=>  $this->session->userdata('SESSION_NAMALENGKAP')
        );
        $this->db->insert('cetak_sp', $data);
    }
    
    function get_by_sp_number($sp_number="") {
        $this->db->select('cetak_sp.sp_id');
        $this->db->from('cetak_sp');
        if($sp_number!=""){
            $this->db->where('cetak_sp.sp_number', $sp_number);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

}

?>