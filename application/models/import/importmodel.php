<?php
class Importmodel extends CI_Model {
    function __construct()
    {
       //Memanggil Constructor Model
        parent::__construct();
    }
	
 	function get_count_data(){
		$this->db->order_by("fungsi_kd", "asc"); 
		$this->db->select('*');
		$this->db->from('tbl_fungsi');
		$query = $this->db->count_all_results();
		return $query->result_array();
	}
 
 	function tambah_berita_simbra($kode_jadi,$kd_berita,$perihal_berita,$tanggal,$pengirim,$jabatan,$dispo,$pendispo,$derajat)
	{
		
		$data = array(
			   'arsip_kd' => $kode_jadi,
			   'berita_kd' => $kd_berita,
			   'jenis_kd' => 1,
			   'sifat_kd' => 1,
			   'perwakilan_kd' => $pengirim,
			   'derajat_kd' => $derajat,
			   'tgl_berita' => $tanggal,
			   'perihal_berita' => $perihal_berita,
			   'tgl_diarsipkan' => date('Y-m-d h:i:s'),
 			   'berita_disposisikan' => $dispo,
			   'berita_fungsi_disposisi' => $pendispo,
			   'berita_input_fungsi' => $this->session->userdata('SESSION_FUNGSI_KD'),
			   'jabatan_pengirim' => $jabatan,
			   'berita_file' => $kode_jadi."_".$kd_berita.".pdf"
			   );
		$this->db->insert('tbl_berita', $data); 
	}

	function code_generator_simbra()
	{
		$this->db->select('arsip_kd');
		$this->db->order_by("arsip_kd", "desc");
 		$this->db->like('arsip_kd','-'.date('y').'-','both');
		$this->db->limit(1);
		$this->db->from('tbl_berita');
		
		$query = $this->db->get();
		return $query->result_array();
	}

	function jml_berita_tahun_ini()
	{
		$this->db->select('count(arsip_kd) as jml');
		$this->db->from('tbl_berita');
 		$this->db->like('arsip_kd','-'.date('y').'-','both');
 		$query = $this->db->get();
		return $query->result_array();
	}

	function tambah_berita($kode_jadi,$kd_berita)
	{
		
		$data = array(
			   'arsip_kd' => $kode_jadi,
			   'berita_kd' => $_POST['kd_berita'],
			   'jenis_kd' => '1',
			   'sifat_kd' => '1',
			   'perwakilan_kd' => $_POST['pengirim'],
			   'derajat_kd' => '111',
			   'tgl_berita' => $_POST['tgl_berita'],
			   'perihal_berita' => $_POST['perihal_berita'],
			   'tgl_diarsipkan' => date('Y-m-d h:i:s'),
			   'keterangan' => $_POST['keterangan'],
			   'berita_disposisikan' => $_POST['berita_disposisikan'],
			   'berita_fungsi_disposisi' => $_POST['berita_fungsi_disposisi'],
			   'berita_input_fungsi' => $this->session->userdata('SESSION_FUNGSI_KD'),
			   'jabatan_pengirim' => $_POST['jabatan_pengirim'],
			   'berita_file' => $kode_jadi."_".$kd_berita.".pdf"
			   );
		$this->db->insert('tbl_berita', $data); 
	}

}
?>