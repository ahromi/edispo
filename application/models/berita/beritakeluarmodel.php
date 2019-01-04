<?php

class Beritakeluarmodel extends CI_Model {

    // JIKA MENGGUNAKAN JASA PENGIRIMAN LOCAL MAIL
    public $config = Array(
        'protocol' => 'smtp',
        'smtp_host' => '10.1.10.233',
        'smtp_port' => 25,
        // 'smtp_user' => $this->session->userdata('email_administrator'),
        // 'smtp_pass' => $this->session->userdata('email_administrator_password'),
        'smtp_user' => "e-dispo@embassyofindonesia.org",
        'smtp_pass' => "",
        'mailtype' => 'html',
        'charset' => 'utf-8',
//        'newline' => '\r\n',
        'mailtype' => 'html',
        'validation' => 'TRUE'
    );

    /*
     * JIKA MENGGUNAKAN JASA PENGIRIMAN MAIL KEMLU
     * $config['protocol'] = 'smtp';
     * $config['smtp_host'] = 'mail.kemlu.go.id';
     * $config['smtp_port'] = '25';
     * $config['smtp_user'] = $this->session->userdata('email_administrator');
     * $config['smtp_pass'] = $this->session->userdata('email_administrator_password');
     * $config['charset'] = 'iso-8859-1';
     *
     * JIKA MENGGUNAKAN JASA PENGIRIMAN GOOGLE MAIL
     * $config = Array(
     * 'protocol' => 'smtp',
     * 'smtp_host' => 'ssl://smtp.googlemail.com',
     * 'smtp_port' => 465,
     * 'smtp_user' => 'puspabs@gmail.com',
     * 'smtp_pass' => '',
     * 'mailtype' => 'html',
     * 'charset' => 'iso-8859-1'
     * );
     */

    function __construct() {
        // Memanggil Constructor Model
        parent::__construct();
    }

    function jml_berita_tahun_ini($sifat) {
        $this->db->select('count(arsip_kd) as jml');
        $this->db->from('tbl_berita_keluar');
        $this->db->like('arsip_kd', $sifat . '-' . date('y') . '-', 'both');
        $query = $this->db->get();
        return $query->result_array();
    }

    function jml_berita_keluar($fungsi_kd = 0,$bulan="") {
        $this->db->select('count(*) as jml');
        $this->db->from('tbl_berita_keluar');
        if ($fungsi_kd > 0) {
            $this->db->where('fungsi_kd', $fungsi_kd);
        }
        if($bulan == ""){
            $this->db->where('date_format(tbl_berita_keluar.tgl_berita,"%Y%m")', $bulan);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_berita_keluar($num, $offset, $fungsi_kd = 0) {
        $this->db->order_by("arsip_kd", "desc");
        $this->db->select('*');
        $this->db->from('tbl_berita_keluar');
        $this->db->join('tbl_fungsi', 'tbl_fungsi.fungsi_kd= tbl_berita_keluar.fungsi_kd');
        if ($fungsi_kd > 3) {
            $this->db->where('tbl_berita_keluar.fungsi_kd', $this->session->userdata('SESSION_FUNGSI_KD'));
        }
        $this->db->limit($num, $offset);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function get_berita_keluar_rahasia($fungsi_kd = 0) {
        $this->db->order_by("arsip_kd", "desc");
        $this->db->select('*');
        $this->db->from('tbl_berita_keluar');
        $this->db->join('tbl_fungsi', 'tbl_fungsi.fungsi_kd= tbl_berita_keluar.fungsi_kd');
        if ($fungsi_kd > 3) {
            $this->db->where('tbl_berita_keluar.fungsi_kd', $this->session->userdata('SESSION_FUNGSI_KD'));
        }
        $this->db->where('sifat_kd',1);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function get_berita_keluar_biasa($fungsi_kd = 0) {
        $this->db->order_by("arsip_kd", "desc");
        $this->db->select('*');
        $this->db->from('tbl_berita_keluar');
        $this->db->join('tbl_fungsi', 'tbl_fungsi.fungsi_kd= tbl_berita_keluar.fungsi_kd');
        if ($fungsi_kd > 3) {
            $this->db->where('tbl_berita_keluar.fungsi_kd', $this->session->userdata('SESSION_FUNGSI_KD'));
        }
        $this->db->where('sifat_kd',2);
        $query = $this->db->get();
        return $query->result_array();
    }

    function tambah_berita($kode_jadi, $kd_berita) {
        $data = array(
            'arsip_kd' => $kode_jadi,
            'sifat_kd' => $_POST ['rad_sifat_dokumen'],
            'berita_kd' => $_POST ['berita_kd'],
            'fungsi_kd' => $_POST ['fungsi_pengirim_kd'],
            'tgl_berita' => $_POST ['tgl_berita'],
            'perihal_berita' => $_POST ['perihal_berita'],
            'berita_file' => $kode_jadi . "_" . $kd_berita . ".pdf"
        );
        $this->db->insert('tbl_berita_keluar', $data);
    }

    function edit_berita($id) {
        $data = array(
            'berita_kd' => $_POST ['berita_kd'],
            'fungsi_kd' => $_POST ['fungsi_pengirim_kd'],
            'tgl_berita' => $_POST ['tgl_berita'],
            'perihal_berita' => $_POST ['perihal_berita']
        );

        $this->db->where('arsip_kd', $id);
        $this->db->update('tbl_berita_keluar', $data);
    }

    function update_file($file) {
        $data = array(
            'berita_file' => $file
        );
        $this->db->where('arsip_kd', $this->uri->segment(4));
        $this->db->update('tbl_berita_keluar', $data);
    }

    function detail_berita($id) {
        $this->db->select('*');
        $this->db->from('tbl_berita_keluar');
        $this->db->join('tbl_sifat', 'tbl_berita_keluar.sifat_kd= tbl_sifat.sifat_kd');
        $this->db->join('tbl_fungsi', 'tbl_fungsi.fungsi_kd= tbl_berita_keluar.fungsi_kd');
        $this->db->where('tbl_berita_keluar.arsip_kd', $id);
        $this->db->order_by("tbl_berita_keluar.berita_kd", "desc");
        $query = $this->db->get();
        return $query->result_array();
    }

}

?>
