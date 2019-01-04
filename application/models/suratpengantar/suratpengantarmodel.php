<?php

class Suratpengantarmodel extends CI_Model {

    function __construct() {
        //Memanggil Constructor Model
        parent::__construct();
    }

    function get_available_print($pwk_code="") {
        $this->db->select('tbl_detail_berita.pwk_code');
        $this->db->select('count(*) as jml');
        $this->db->from('tbl_detail_berita');
        $this->db->where('tbl_detail_berita.sp_id', null);
        if($pwk_code!=""){
            $this->db->where('tbl_detail_berita.pwk_code', $pwk_code);
        }
        $this->db->group_by('tbl_detail_berita.pwk_code');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function get_list_unclaim($pwk_code="",$sp_id=0) {
        $this->db->select('tbl_detail_berita.*');
        $this->db->select('cetak_sp.*');
        $this->db->select('tbl_berita.keterangan');
        $this->db->select('tbl_berita.berita_kd');
        $this->db->from('tbl_detail_berita');
        $this->db->join('cetak_sp', 'cetak_sp.sp_id= tbl_detail_berita.sp_id');
        $this->db->join('tbl_berita', 'tbl_berita.arsip_kd= tbl_detail_berita.arsip_kd');
        $this->db->where('tbl_detail_berita.sp_id', $sp_id);
        if($pwk_code!=""){
            $this->db->where('tbl_detail_berita.pwk_code', $pwk_code);
        }
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function get_last_number($pwk_code="") {
        $this->db->select('count(*) as jml');
        $this->db->from('cetak_sp');
        if($pwk_code!=""){
            $this->db->like('cetak_sp.sp_number', $pwk_code);
        }
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function update_available_print($pwk_code="",$sp_id=0) {
        $this->db->where('tbl_detail_berita.sp_id', null);
        $this->db->where('tbl_detail_berita.pwk_code', $pwk_code);
        $data = array(
            'sp_id' => $sp_id
        );
        $this->db->update('tbl_detail_berita', $data);
    }

    function search_data_suratpengantar($key1, $key2, $key3, $key4, $key5) {
        $this->db->order_by("tgl_berita", "desc");
        $this->db->select('cetak_sp.sp_number');
        $this->db->select('cetak_sp.sp_id');
        $this->db->select('cetak_sp.print_date');
        $this->db->select('tbl_detail_berita.pwk_code');
        $this->db->select('count(*) as jml');
        $this->db->from('tbl_berita');
        $this->db->join('tbl_jenis_berita', 'tbl_berita.jenis_kd= tbl_jenis_berita.jenis_kd');
        $this->db->join('tbl_sifat', 'tbl_berita.sifat_kd= tbl_sifat.sifat_kd');
        $this->db->join('tbl_perwakilan', 'tbl_perwakilan.perwakilan_kd= tbl_berita.perwakilan_kd');
        $this->db->join('tbl_derajat', 'tbl_derajat.derajat_kd= tbl_berita.derajat_kd');
        $this->db->join('tbl_detail_berita', 'tbl_berita.arsip_kd= tbl_detail_berita.arsip_kd');
        $this->db->join('cetak_sp', 'cetak_sp.sp_id= tbl_detail_berita.sp_id');
        
        if (!empty($key4) && !empty($key5)) {
            $where = "tbl_berita.tgl_berita between CAST('$key4' as DATETIME) and CAST('$key5' as DATETIME)";
            $this->db->where($where);
        }
        $this->db->like('tbl_berita.arsip_kd', $key1);
        $this->db->like('tbl_berita.berita_kd', $key2);
        $this->db->like('tbl_berita.perihal_berita', $key3);
        if ($this->session->userdata('SESSION_HOME_STAFF') == 'T') {
            $this->db->where('tbl_berita.sifat_kd', 2);
        }
        $this->db->group_by('cetak_sp.sp_id');
        $query = $this->db->get();
        return $query->result_array();
    }

}

?>