<?php
class Beritamodel extends CI_Model {
	// JIKA MENGGUNAKAN JASA PENGIRIMAN LOCAL MAIL
	public $config = Array (
			'protocol' => 'smtp',
			'smtp_host' => 'localhost',
			'smtp_port' => 25,
	
			// 'smtp_user' => $this->session->userdata('email_administrator'),
			// 'smtp_pass' => $this->session->userdata('email_administrator_password'),
			'smtp_user' => "e-disposisi@localhost",
			'smtp_pass' => "password-Login-Ubuntu",
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => '\r\n',
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
		parent::__construct ();
	}
	function get_count_data() {
		$this->db->order_by ( "user_kd", "desc" );
		$this->db->select ( '*' );
		$this->db->from ( 'tbl_user' );
		$this->db->join ( 'tbl_fungsi', 'tbl_user.fungsi_kd= tbl_fungsi.fungsi_kd' );
		$query = $this->db->count_all_results ();
		return $query->result_array ();
	}
	function check_dokumen($fungsi_id, $id) {
		$this->db->select ( 'count(*) as jml' );
		$this->db->from ( 'tbl_berita' );
		$this->db->join ( 'tbl_disposisi', 'tbl_disposisi.arsip_kd=tbl_berita.arsip_kd' );
		$this->db->join ( 'tbl_disposisi_detail', 'tbl_disposisi.disposisi_kd=tbl_disposisi_detail.disposisi_kd' );
		$this->db->where ( 'tbl_disposisi_detail.detail_fungsi_kd', $fungsi_id );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function get_data_berita($num, $offset) {
		$this->db->order_by ( "arsip_kd", "desc" );
		$this->db->select ( '*,tbl_berita.tgl_diarsipkan as detail_terima' ); // this is for faking view berita
		$this->db->from ( 'tbl_berita' );
		$this->db->join ( 'tbl_jenis_berita', 'tbl_berita.jenis_kd= tbl_jenis_berita.jenis_kd' );
		$this->db->join ( 'tbl_sifat', 'tbl_berita.sifat_kd= tbl_sifat.sifat_kd' );
		$this->db->join ( 'tbl_perwakilan', 'tbl_perwakilan.perwakilan_kd= tbl_berita.perwakilan_kd' );
		$this->db->join ( 'tbl_derajat', 'tbl_derajat.derajat_kd= tbl_berita.derajat_kd' );
		$this->db->limit ( $num, $offset );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function get_data_berita_inpputed($num, $offset) {
		$this->db->order_by ( "arsip_kd", "desc" );
		$this->db->select ( '*,tbl_berita.tgl_diarsipkan as detail_terima' ); // this is for faking view berita
		$this->db->from ( 'tbl_berita' );
		$this->db->join ( 'tbl_jenis_berita', 'tbl_berita.jenis_kd= tbl_jenis_berita.jenis_kd' );
		$this->db->join ( 'tbl_sifat', 'tbl_berita.sifat_kd= tbl_sifat.sifat_kd' );
		$this->db->join ( 'tbl_perwakilan', 'tbl_perwakilan.perwakilan_kd= tbl_berita.perwakilan_kd' );
		$this->db->join ( 'tbl_derajat', 'tbl_derajat.derajat_kd= tbl_berita.derajat_kd' );
		$this->db->where ( 'tbl_berita.berita_input_fungsi', $this->session->userdata ( 'SESSION_FUNGSI_KD' ) );
		$this->db->limit ( $num, $offset );
		// $where = "tbl_berita.berita_input_fungsi='".$this->session->userdata('SESSION_FUNGSI_KD')."'";
		// $this->db->where($where);
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function get_data_berita_fungsi($num, $offset) {
		$this->db->order_by ( "tbl_berita.arsip_kd", "desc" );
		$this->db->select ( '*' );
		$this->db->from ( 'tbl_berita' );
		$this->db->join ( 'tbl_jenis_berita', 'tbl_berita.jenis_kd= tbl_jenis_berita.jenis_kd' );
		$this->db->join ( 'tbl_sifat', 'tbl_berita.sifat_kd= tbl_sifat.sifat_kd' );
		$this->db->join ( 'tbl_perwakilan', 'tbl_perwakilan.perwakilan_kd= tbl_berita.perwakilan_kd' );
		$this->db->join ( 'tbl_derajat', 'tbl_derajat.derajat_kd= tbl_berita.derajat_kd' );
		$this->db->join ( 'tbl_disposisi', 'tbl_disposisi.arsip_kd=tbl_berita.arsip_kd' );
		$this->db->join ( 'tbl_disposisi_detail', 'tbl_disposisi_detail.disposisi_kd=tbl_disposisi.disposisi_kd' );
		$this->db->where ( 'tbl_disposisi_detail.detail_fungsi_kd', $this->session->userdata ( 'SESSION_FUNGSI_KD' ) );
		// $this->db->or_where('tbl_berita.berita_fungsi_disposisi',$this->session->userdata('SESSION_FUNGSI_KD'));
		
		$this->db->where ( 'tbl_berita.berita_disposisikan', 'Y' );
		$this->db->limit ( $num, $offset );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function get_data_berita_lanjutan_fungsi($num, $offset) {
		$this->db->order_by ( "tbl_berita.arsip_kd", "desc" );
		$this->db->select ( '*' );
		$this->db->from ( 'tbl_berita' );
		$this->db->join ( 'tbl_jenis_berita', 'tbl_berita.jenis_kd= tbl_jenis_berita.jenis_kd' );
		$this->db->join ( 'tbl_sifat', 'tbl_berita.sifat_kd= tbl_sifat.sifat_kd' );
		$this->db->join ( 'tbl_perwakilan', 'tbl_perwakilan.perwakilan_kd= tbl_berita.perwakilan_kd' );
		$this->db->join ( 'tbl_derajat', 'tbl_derajat.derajat_kd= tbl_berita.derajat_kd' );
		$this->db->join ( 'tbl_disposisi_lanjutan', 'tbl_disposisi_lanjutan.arsip_kd=tbl_berita.arsip_kd' );
		$this->db->join ( 'tbl_disposisi_lanjutan_detail', 'tbl_disposisi_lanjutan_detail.disposisi_lanjutan_kd=tbl_disposisi_lanjutan.disposisi_lanjutan_kd' );
		$this->db->where ( 'tbl_disposisi_lanjutan_detail.detail_user_kd', $this->session->userdata ( 'SESSION_ID' ) );
		// $this->db->or_where('tbl_berita.berita_fungsi_disposisi',$this->session->userdata('SESSION_FUNGSI_KD'));
		
		$this->db->where ( 'tbl_berita.berita_disposisikan', 'Y' );
		$this->db->limit ( $num, $offset );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function get_data_berita_fungsi_lanjutan_unrecieved($num, $offset) {
		$this->db->order_by ( "tbl_berita.arsip_kd", "desc" );
		$this->db->select ( '*' );
		$this->db->from ( 'tbl_berita' );
		$this->db->join ( 'tbl_jenis_berita', 'tbl_berita.jenis_kd= tbl_jenis_berita.jenis_kd' );
		$this->db->join ( 'tbl_sifat', 'tbl_berita.sifat_kd= tbl_sifat.sifat_kd' );
		$this->db->join ( 'tbl_perwakilan', 'tbl_perwakilan.perwakilan_kd= tbl_berita.perwakilan_kd' );
		$this->db->join ( 'tbl_derajat', 'tbl_derajat.derajat_kd= tbl_berita.derajat_kd' );
		$this->db->join ( 'tbl_disposisi_lanjutan', 'tbl_disposisi_lanjutan.arsip_kd=tbl_berita.arsip_kd' );
		$this->db->join ( 'tbl_disposisi_lanjutan_detail', 'tbl_disposisi_lanjutan_detail.disposisi_lanjutan_kd=tbl_disposisi_lanjutan.disposisi_lanjutan_kd' );
		$this->db->where ( 'tbl_disposisi_lanjutan_detail.detail_user_kd', $this->session->userdata ( 'SESSION_ID' ) );
		$this->db->where ( 'tbl_disposisi_lanjutan_detail.detail_terima', 'T' );
		$this->db->where ( 'tbl_berita.berita_disposisikan', 'Y' );
		$this->db->limit ( $num, $offset );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function get_data_berita_fungsi_lanjutan_inputed($num, $offset) {
		$this->db->order_by ( "tbl_berita.arsip_kd", "desc" );
		$this->db->select ( '*' );
		$this->db->from ( 'tbl_berita' );
		$this->db->join ( 'tbl_jenis_berita', 'tbl_berita.jenis_kd= tbl_jenis_berita.jenis_kd' );
		$this->db->join ( 'tbl_sifat', 'tbl_berita.sifat_kd= tbl_sifat.sifat_kd' );
		$this->db->join ( 'tbl_perwakilan', 'tbl_perwakilan.perwakilan_kd= tbl_berita.perwakilan_kd' );
		$this->db->join ( 'tbl_derajat', 'tbl_derajat.derajat_kd= tbl_berita.derajat_kd' );
		$this->db->join ( 'tbl_fungsi', 'tbl_fungsi.fungsi_kd=tbl_berita.berita_fungsi_disposisi' );
		$this->db->order_by ( 'tbl_berita.arsip_kd', 'desc' );
		$this->db->where ( 'tbl_berita.berita_disposisikan', 'Y' );
		$this->db->where ( 'tbl_berita.status_disposisi', 'T' );
		$this->db->where ( 'tbl_berita.berita_input_fungsi', $this->session->userdata ( 'SESSION_FUNGSI_KD' ) );
		$this->db->limit ( $num, $offset );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function get_data_berita_dubes($num, $offset) {
		$this->db->order_by ( "tbl_berita.arsip_kd", "desc" );
		$this->db->select ( '*' );
		$this->db->from ( 'tbl_berita' );
		$this->db->join ( 'tbl_jenis_berita', 'tbl_berita.jenis_kd= tbl_jenis_berita.jenis_kd' );
		$this->db->join ( 'tbl_sifat', 'tbl_berita.sifat_kd= tbl_sifat.sifat_kd' );
		$this->db->join ( 'tbl_perwakilan', 'tbl_perwakilan.perwakilan_kd= tbl_berita.perwakilan_kd' );
		$this->db->join ( 'tbl_derajat', 'tbl_derajat.derajat_kd= tbl_berita.derajat_kd' );
		$this->db->where ( 'tbl_berita.berita_disposisikan', 'Y' );
		$this->db->limit ( $num, $offset );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function get_data_berita_today($num, $offset) {
		$this->db->order_by ( "tbl_berita.arsip_kd", "desc" );
		$this->db->select ( '*' );
		$this->db->from ( 'tbl_berita' );
		$this->db->join ( 'tbl_jenis_berita', 'tbl_berita.jenis_kd= tbl_jenis_berita.jenis_kd' );
		$this->db->join ( 'tbl_sifat', 'tbl_berita.sifat_kd= tbl_sifat.sifat_kd' );
		$this->db->join ( 'tbl_perwakilan', 'tbl_perwakilan.perwakilan_kd= tbl_berita.perwakilan_kd' );
		$this->db->join ( 'tbl_derajat', 'tbl_derajat.derajat_kd= tbl_berita.derajat_kd' );
		// $this->db->join('tbl_disposisi', 'tbl_disposisi.arsip_kd=tbl_berita.arsip_kd');
		// $this->db->join('tbl_disposisi_detail', 'tbl_disposisi_detail.disposisi_kd=tbl_disposisi.disposisi_kd');
		// $this->db->join('tbl_fungsi', 'tbl_disposisi_detail.detail_fungsi_kd=tbl_fungsi.fungsi_kd');
		$where = "tbl_berita.tgl_diarsipkan = '" . date ( 'Y-m-d' ) . "'";
		$this->db->where ( $where );
		$this->db->limit ( $num, $offset );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function get_data_berita_fungsi_today($num, $offset) {
		$this->db->order_by ( "tbl_berita.arsip_kd", "desc" );
		$this->db->select ( '*' );
		$this->db->from ( 'tbl_berita' );
		$this->db->join ( 'tbl_jenis_berita', 'tbl_berita.jenis_kd= tbl_jenis_berita.jenis_kd' );
		$this->db->join ( 'tbl_sifat', 'tbl_berita.sifat_kd= tbl_sifat.sifat_kd' );
		$this->db->join ( 'tbl_perwakilan', 'tbl_perwakilan.perwakilan_kd= tbl_berita.perwakilan_kd' );
		$this->db->join ( 'tbl_derajat', 'tbl_derajat.derajat_kd= tbl_berita.derajat_kd' );
		$this->db->join ( 'tbl_disposisi', 'tbl_disposisi.arsip_kd=tbl_berita.arsip_kd' );
		$this->db->join ( 'tbl_disposisi_detail', 'tbl_disposisi_detail.disposisi_kd=tbl_disposisi.disposisi_kd' );
		$this->db->join ( 'tbl_fungsi', 'tbl_disposisi_detail.detail_fungsi_kd=tbl_fungsi.fungsi_kd' );
		$where = "tbl_berita.tgl_diarsipkan = '" . date ( 'Y-m-d' ) . "'";
		$this->db->where ( $where );
		$this->db->where ( 'tbl_disposisi_detail.detail_fungsi_kd', $this->session->userdata ( 'SESSION_FUNGSI_KD' ) );
		$this->db->where ( 'tbl_berita.berita_disposisikan', 'Y' );
		$this->db->limit ( $num, $offset );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function get_data_berita_lanjutan_fungsi_today($num, $offset) {
		$this->db->order_by ( "tbl_berita.arsip_kd", "desc" );
		$this->db->select ( '*' );
		$this->db->from ( 'tbl_berita' );
		$this->db->join ( 'tbl_jenis_berita', 'tbl_berita.jenis_kd= tbl_jenis_berita.jenis_kd' );
		$this->db->join ( 'tbl_sifat', 'tbl_berita.sifat_kd= tbl_sifat.sifat_kd' );
		$this->db->join ( 'tbl_perwakilan', 'tbl_perwakilan.perwakilan_kd= tbl_berita.perwakilan_kd' );
		$this->db->join ( 'tbl_derajat', 'tbl_derajat.derajat_kd= tbl_berita.derajat_kd' );
		$this->db->join ( 'tbl_disposisi_lanjutan', 'tbl_disposisi_lanjutan.arsip_kd=tbl_berita.arsip_kd' );
		$this->db->join ( 'tbl_disposisi_lanjutan_detail', 'tbl_disposisi_lanjutan_detail.disposisi_kd=tbl_disposisi_lanjutan.disposisi_kd' );
		$this->db->join ( 'tbl_fungsi', 'tbl_disposisi_lanjutan_detail.detail_fungsi_kd=tbl_fungsi.fungsi_kd' );
		$where = "tbl_berita.tgl_diarsipkan = '" . date ( 'Y-m-d' ) . "'";
		$this->db->where ( $where );
		$this->db->where ( 'tbl_disposisi_lanjutan_detail.detail_user_kd', $this->session->userdata ( 'SESSION_ID' ) );
		$this->db->where ( 'tbl_berita.berita_disposisikan', 'Y' );
		$this->db->limit ( $num, $offset );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function get_data_berita_dubes_today($num, $offset) {
		$this->db->order_by ( "tbl_berita.arsip_kd", "desc" );
		$this->db->select ( '*' );
		$this->db->from ( 'tbl_berita' );
		$this->db->join ( 'tbl_jenis_berita', 'tbl_berita.jenis_kd= tbl_jenis_berita.jenis_kd' );
		$this->db->join ( 'tbl_sifat', 'tbl_berita.sifat_kd= tbl_sifat.sifat_kd' );
		$this->db->join ( 'tbl_perwakilan', 'tbl_perwakilan.perwakilan_kd= tbl_berita.perwakilan_kd' );
		$this->db->join ( 'tbl_derajat', 'tbl_derajat.derajat_kd= tbl_berita.derajat_kd' );
		// $this->db->join('tbl_disposisi', 'tbl_disposisi.arsip_kd= tbl_berita.arsip_kd');
		// $this->db->join('tbl_disposisi_detail', 'tbl_disposisi.disposisi_kd= tbl_disposisi_detail.disposisi_kd');
		$where = "tbl_berita.tgl_diarsipkan = '" . date ( 'Y-m-d' ) . "'";
		$this->db->where ( $where );
		$this->db->where ( 'tbl_berita.berita_disposisikan', 'Y' );
		$this->db->limit ( $num, $offset );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function get_data_berita_undisposisi($num, $offset) {
		$this->db->order_by ( "tbl_berita.arsip_kd", "desc" );
		$this->db->select ( '*' );
		$this->db->from ( 'tbl_berita' );
		$this->db->join ( 'tbl_jenis_berita', 'tbl_berita.jenis_kd= tbl_jenis_berita.jenis_kd' );
		$this->db->join ( 'tbl_sifat', 'tbl_berita.sifat_kd= tbl_sifat.sifat_kd' );
		$this->db->join ( 'tbl_perwakilan', 'tbl_perwakilan.perwakilan_kd= tbl_berita.perwakilan_kd' );
		$this->db->join ( 'tbl_derajat', 'tbl_derajat.derajat_kd= tbl_berita.derajat_kd' );
		// $where = "tbl_berita.status_disposisi = 'T'";
		$this->db->where ( 'tbl_berita.berita_fungsi_disposisi', $this->session->userdata ( 'SESSION_FUNGSI_KD' ) );
		$this->db->where ( 'tbl_berita.berita_disposisikan', 'Y' );
		// $this->db->where($where);
		$this->db->limit ( $num, $offset );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function get_data_berita_unrecieved($num, $offset) {
		$this->db->order_by ( "tbl_berita.arsip_kd", "desc" );
		$this->db->select ( '*' );
		$this->db->from ( 'tbl_berita' );
		$this->db->join ( 'tbl_jenis_berita', 'tbl_berita.jenis_kd= tbl_jenis_berita.jenis_kd' );
		$this->db->join ( 'tbl_sifat', 'tbl_berita.sifat_kd= tbl_sifat.sifat_kd' );
		$this->db->join ( 'tbl_perwakilan', 'tbl_perwakilan.perwakilan_kd= tbl_berita.perwakilan_kd' );
		$this->db->join ( 'tbl_derajat', 'tbl_derajat.derajat_kd= tbl_berita.derajat_kd' );
		$this->db->join ( 'tbl_disposisi', 'tbl_berita.arsip_kd= tbl_disposisi.arsip_kd' );
		$this->db->join ( 'tbl_disposisi_detail', 'tbl_disposisi.disposisi_kd= tbl_disposisi_detail.disposisi_kd' );
		$this->db->where ( 'tbl_berita.berita_disposisikan', 'Y' );
		$where = "tbl_berita.status_disposisi = 'Y' and tbl_disposisi_detail.detail_terima='T' and tbl_disposisi_detail.detail_fungsi_kd='" . $this->session->userdata ( 'SESSION_FUNGSI_KD' ) . "'";
		$this->db->where ( $where );
		$this->db->limit ( $num, $offset );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function get_data_berita_fungsi_undisposisi($num, $offset) {
		$this->db->select ( '*' );
		$this->db->from ( 'tbl_berita' );
		$this->db->join ( 'tbl_jenis_berita', 'tbl_berita.jenis_kd= tbl_jenis_berita.jenis_kd' );
		$this->db->join ( 'tbl_sifat', 'tbl_berita.sifat_kd= tbl_sifat.sifat_kd' );
		$this->db->join ( 'tbl_perwakilan', 'tbl_perwakilan.perwakilan_kd= tbl_berita.perwakilan_kd' );
		$this->db->join ( 'tbl_derajat', 'tbl_derajat.derajat_kd= tbl_berita.derajat_kd' );
		$this->db->join ( 'tbl_fungsi', 'tbl_fungsi.fungsi_kd=tbl_berita.berita_fungsi_disposisi' );
		// $this->db->join('tbl_disposisi', 'tbl_disposisi.arsip_kd=tbl_berita.arsip_kd');
		// $this->db->join('tbl_disposisi_detail', 'tbl_disposisi_detail.disposisi_kd=tbl_disposisi.disposisi_kd');
		// $where = "tbl_berita.status_disposisi = 'T'";
		// $this->db->where($where);
		$this->db->order_by ( 'tbl_berita.arsip_kd', 'desc' );
		
		$this->db->where ( 'tbl_berita.berita_fungsi_disposisi', $this->session->userdata ( 'SESSION_FUNGSI_KD' ) );
		// $this->db->where('tbl_disposisi_detail.detail_fungsi_kd',$this->session->userdata('SESSION_FUNGSI_KD'));
		$this->db->where ( 'tbl_berita.berita_disposisikan', 'Y' );
		$this->db->limit ( $num, $offset );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function get_data_berita_dubes_undisposisi($num, $offset) {
		$this->db->order_by ( 'tbl_berita.status_disposisi', 'asc' );
		$this->db->select ( '*' );
		$this->db->from ( 'tbl_berita' );
		$this->db->join ( 'tbl_jenis_berita', 'tbl_berita.jenis_kd= tbl_jenis_berita.jenis_kd' );
		$this->db->join ( 'tbl_sifat', 'tbl_berita.sifat_kd= tbl_sifat.sifat_kd' );
		$this->db->join ( 'tbl_perwakilan', 'tbl_perwakilan.perwakilan_kd= tbl_berita.perwakilan_kd' );
		$this->db->join ( 'tbl_derajat', 'tbl_derajat.derajat_kd= tbl_berita.derajat_kd' );
		// $where = "tbl_berita.status_disposisi = 'T'";
		$where = "tbl_berita.berita_disposisikan = 'Y'";
		$this->db->order_by ( 'tbl_berita.arsip_kd', 'desc' );
		$this->db->where ( $where );
		$this->db->where ( 'tbl_berita.berita_fungsi_disposisi', $this->session->userdata ( 'SESSION_FUNGSI_KD' ) );
		$this->db->limit ( $num, $offset );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function fungsi_mendispo() {
		$this->db->where ( 'tbl_fungsi.disposisi_fungsi', 'Y' );
		$this->db->where ( 'tbl_fungsi.fungsi_kd !=', $this->session->userdata ( 'SESSION_FUNGSI_KD' ) );
		$query = $this->db->get ( 'tbl_fungsi' );
		return $query->result_array ();
	}
	function tambah_berita($kode_jadi, $kd_berita) {
		$data = array (
				'arsip_kd' => $kode_jadi,
				'berita_kd' => $_POST ['berita_kd'],
				'jenis_kd' => $_POST ['jenis_kd'],
				'sifat_kd' => $_POST ['sifat_kd'],
				'perwakilan_kd' => $_POST ['perwakilan_kd'],
				'derajat_kd' => $_POST ['derajat_kd'],
				'tgl_berita' => $_POST ['tgl_berita'],
				'perihal_berita' => $_POST ['perihal_berita'],
				'tgl_diarsipkan' => date ( 'Y-m-d h:i:s' ),
				'keterangan' => $_POST ['keterangan'],
				'berita_disposisikan' => $_POST ['berita_disposisikan'],
				'berita_fungsi_disposisi' => $_POST ['berita_fungsi_disposisi'],
				'berita_input_fungsi' => $this->session->userdata ( 'SESSION_FUNGSI_KD' ),
				'jabatan_pengirim' => $_POST ['jabatan_pengirim'],
				'berita_file' => $kode_jadi . "_" . $kd_berita . ".pdf" 
		);
		$this->db->insert ( 'tbl_berita', $data );
	}
	function code_generator() {
		$this->db->select ( 'arsip_kd' );
		$this->db->order_by ( "arsip_kd", "desc" );
		$this->db->like ( 'arsip_kd', '-' . date ( 'y' ) . '-', 'both' );
		$this->db->limit ( 1 );
		$this->db->from ( 'tbl_berita' );
		
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function insert_disposisi_fungsi() {
		$data = array (
				'arsip_kd' => $_POST ['arsip_kd'],
				'tgl_disposisi' => date ( 'Y-m-d h:i:s' ),
				'disposisi_oleh' => $this->session->userdata ( 'SESSION_ID' ),
				'catatan' => $_POST ['catatan'] 
		);
		$this->db->insert ( 'tbl_disposisi', $data );
	}
	function update_status_disposisi_berita($id) {
		$data = array (
				'status_disposisi' => 'Y',
				'tgl_disposisi' => date ( 'Y-m-d h:i:s' ) 
		);
		$this->db->where ( 'arsip_kd', $id );
		$this->db->update ( 'tbl_berita', $data );
	}
	function update_status_batal_disposisi($id) {
		$data = array (
				'status_disposisi' => 'T' 
		);
		$this->db->where ( 'arsip_kd', $id );
		$this->db->update ( 'tbl_berita', $data );
	}
	function get_last_disposisi() {
		$this->db->select ( '*' );
		$this->db->order_by ( "disposisi_kd", "desc" );
		$this->db->limit ( 1 );
		$this->db->from ( 'tbl_disposisi' );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function get_disposisi_by_id($id) {
		$this->db->select ( '*' );
		$this->db->order_by ( "disposisi_kd", "desc" );
		$this->db->where ( 'disposisi_kd', $id );
		$this->db->from ( 'tbl_disposisi' );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function alihkan_disposisi($id) {
		$data = array (
				'berita_fungsi_disposisi' => $_POST ['queryString'] 
		);
		$this->db->where ( 'arsip_kd', $id );
		$this->db->update ( 'tbl_berita', $data );
	}
	function insert_detail_disposisi($id_disposisi, $fungsi, $kd_arsip, $jenis, $derajat, $perwakilan, $perihal_berita, $catatan) {
		foreach ( $fungsi as $row ) {
			$data = array (
					'disposisi_kd' => $id_disposisi,
					'detail_fungsi_kd' => $row 
			);
			$this->db->insert ( 'tbl_disposisi_detail', $data );
		}
		
 		
		$this->load->library ( 'email', $this->config );
		$this->email->set_newline ( "\r\n" );
		$this->email->set_crlf ( "\r\n" );
 		$this->email->initialize ( $this->config );
		
		if (isset ( $_POST ['notif'] )) {
			if ($_POST ['notif'] == 'Yes') {
				foreach ( $fungsi as $row ) {
					$this->db->select ( '*' );
					$this->db->where ( 'tbl_fungsi.fungsi_kd', $row );
					$this->db->where ( 'tbl_user.user_notifikasi_email', 1 );
					$this->db->where ( 'tbl_user.koordinator_fungsi', 'Y' );
					$this->db->from ( 'tbl_fungsi' );
					$this->db->join ( 'tbl_user', 'tbl_user.fungsi_kd=tbl_fungsi.fungsi_kd' );
					$query = $this->db->get ();
					$data = $query->result_array ();
					
					foreach ( $data as $val ) {
						$txt = "<html>
							<table>
								<tr>
									<th colspan='3'><b>Informasi Disposisi </b> </th>
								</tr>
								<tr>
									<td>No Arsip </td><td>:</td> <td><i> " . $kd_arsip . "</i></td>
								</tr> 
						  		<tr>
									<td>Jenis Berita </td> <td>:</td> <td>" . $jenis . "</td>
								</tr> 
							    <tr>
									<td>Pengirim </td> <td>:</td><td> " . $perwakilan . " </td>
								</tr>
						        <tr> 
									<td>Derajat </td><td>:</td><td> " . $derajat . "</td>
								</tr>
						        <tr> 
									<td>Perihal </td><td>:</td><td> " . $perihal_berita . "</td>
								</tr>
						        <tr> 
									<td>Catatan Disposisi</td><td>:</td><td> " . $catatan . "</td>
								</tr>
								<tr>
									<td colspan='3'>Untuk membuka disposisi silahkan login ke aplikasi disposisi.</td>
								</tr>
							</table>
						</html>";
						$this->email->set_mailtype ( "html" );
						$this->email->from ( $this->session->userdata ( 'email_administrator' ), 'Admin Edisposisi ' . $this->session->userdata ( 'nama_singkat_perwakilan' ) );
						$this->email->to ( $val ['user_email'] );
						$this->email->subject ( 'Disposisi Baru untuk Anda : No Arsip ' . $kd_arsip );
						$this->email->message ( $txt );
						$this->email->send ();
					}
				}
			}
		} else {
			foreach ( $fungsi as $row ) {
				$this->db->select ( '*' );
				$this->db->where ( 'tbl_fungsi.fungsi_kd', $row );
				$this->db->where ( 'tbl_user.user_notifikasi_email', 1 );
				$this->db->where ( 'tbl_user.koordinator_fungsi', 'Y' );
				$this->db->from ( 'tbl_fungsi' );
				$this->db->join ( 'tbl_user', 'tbl_user.fungsi_kd=tbl_fungsi.fungsi_kd' );
				$query = $this->db->get ();
				$data = $query->result_array ();
				foreach ( $data as $val ) {
					$txt = "<html>
							<table>
								<tr>
									<th colspan='3'><b>Informasi Disposisi </b> </th>
								</tr>
								<tr>
									<td>No Arsip </td><td>:</td> <td><i> " . $kd_arsip . "</i></td>
								</tr> 
						  		<tr>
									<td>Jenis Berita </td> <td>:</td> <td>" . $jenis . "</td>
								</tr> 
							    <tr>
									<td>Pengirim </td> <td>:</td><td> " . $perwakilan . " </td>
								</tr>
						        <tr> 
									<td>Derajat </td><td>:</td><td> " . $derajat . "</td>
								</tr>
						        <tr> 
									<td>Perihal </td><td>:</td><td> " . $perihal_berita . "</td>
								</tr>
						        <tr> 
									<td>Catatan Disposisi</td><td>:</td><td> " . $catatan . "</td>
								</tr>
								<tr>
									<td colspan='3'>Untuk membuka disposisi silahkan login ke aplikasi disposisi.</td>
								</tr>
							</table>
						</html>";
					$this->email->set_mailtype ( "html" );
					$this->email->from ( $this->session->userdata ( 'email_administrator' ), 'Admin Edisposisi ' . $this->session->userdata ( 'nama_singkat_perwakilan' ) );
					$this->email->to ( $val ['user_email'] );
					$this->email->subject ( 'Disposisi Baru untuk Anda : No Arsip ' . $kd_arsip );
					$this->email->message ( $txt );
					$this->email->send ();
				}
			}
		}
	}
	
	function insert_disposisi_instruksi($id, $instruksi) {
		foreach ( $instruksi as $row ) {
			$data = array (
					'arsip_kd' => $id,
					'instruksi_kd' => $row 
			);
			$this->db->insert ( 'tbl_disposisi_instruksi', $data );
		}
	}
	
	function edit_berita($id) {
		$data = array (
				'berita_kd' => $_POST ['berita_kd'],
				'jenis_kd' => $_POST ['jenis_kd'],
				'sifat_kd' => $_POST ['sifat_kd'],
				'perwakilan_kd' => $_POST ['perwakilan_kd'],
				'derajat_kd' => $_POST ['derajat_kd'],
				'tgl_berita' => $_POST ['tgl_berita'],
				'berita_disposisikan' => $_POST ['berita_disposisikan'],
				'jabatan_pengirim' => $_POST ['jabatan_pengirim'],
				'perihal_berita' => $_POST ['perihal_berita'],
				'tgl_diarsipkan' => date ( 'Y-m-d h:i:s' ),
				'berita_fungsi_disposisi' => $_POST ['berita_fungsi_disposisi'],
				'berita_disposisikan' => $_POST ['berita_disposisikan'],
				'jabatan_pengirim' => $_POST ['jabatan_pengirim'],
				'keterangan' => $_POST ['keterangan'] 
		);
		
		$this->db->where ( 'arsip_kd', $id );
		$this->db->update ( 'tbl_berita', $data );
	}
	function update_file($file) {
		$data = array (
				'berita_file' => $file 
		);
		$this->db->where ( 'arsip_kd', $this->uri->segment ( 4 ) );
		$this->db->update ( 'tbl_berita', $data );
	}
	function search_data_berita($key1, $key2, $key3, $key4, $key5) {
		$this->db->order_by ( "arsip_kd", "desc" );
		$this->db->select ( '*' );
		$this->db->from ( 'tbl_berita' );
		$this->db->join ( 'tbl_jenis_berita', 'tbl_berita.jenis_kd= tbl_jenis_berita.jenis_kd' );
		$this->db->join ( 'tbl_sifat', 'tbl_berita.sifat_kd= tbl_sifat.sifat_kd' );
		$this->db->join ( 'tbl_perwakilan', 'tbl_perwakilan.perwakilan_kd= tbl_berita.perwakilan_kd' );
		$this->db->join ( 'tbl_derajat', 'tbl_derajat.derajat_kd= tbl_berita.derajat_kd' );
		if (! empty ( $key4 ) && ! empty ( $key5 )) {
			$where = "tbl_berita.tgl_berita between CAST('$key4' as DATETIME) and CAST('$key5' as DATETIME)";
			$this->db->where ( $where );
		}
		$this->db->like ( 'tbl_berita.arsip_kd', $key1 );
		$this->db->like ( 'tbl_berita.berita_kd', $key2 );
		$this->db->like ( 'tbl_berita.perihal_berita', $key3 );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function search_data_berita_pendispo($key1, $key2, $key3, $key4, $key5) {
		$sql = "SELECT tbl_berita.*, tbl_perwakilan.perwakilan_nama FROM `tbl_berita`
					JOIN `tbl_jenis_berita` ON `tbl_berita`.`jenis_kd`= `tbl_jenis_berita`.`jenis_kd` 
					JOIN `tbl_sifat` ON `tbl_berita`.`sifat_kd`= `tbl_sifat`.`sifat_kd` 
					JOIN `tbl_perwakilan` ON `tbl_perwakilan`.`perwakilan_kd`= `tbl_berita`.`perwakilan_kd` 
					JOIN `tbl_derajat` ON `tbl_derajat`.`derajat_kd`= `tbl_berita`.`derajat_kd` 
					JOIN `tbl_disposisi` ON `tbl_disposisi`.`arsip_kd`=`tbl_berita`.`arsip_kd` 
					JOIN `tbl_disposisi_detail` ON `tbl_disposisi_detail`.`disposisi_kd`=`tbl_disposisi`.`disposisi_kd` 
				WHERE `tbl_berita`.`berita_disposisikan` = 'Y' AND `tbl_disposisi_detail`.`detail_fungsi_kd` = '" . $this->session->userdata ( 'SESSION_FUNGSI_KD' ) . "' AND `tbl_berita`.`arsip_kd` LIKE '%" . $key1 . "%' AND `tbl_berita`.`berita_kd` LIKE '%" . $key2 . "%' AND `tbl_berita`.`perihal_berita` LIKE '%" . $key3 . "%'  AND tbl_berita.tgl_berita>= '" . $key4 . "' AND tbl_berita.tgl_berita<= '" . $key5 . "'
			union all 
			SELECT tbl_berita.*, tbl_perwakilan.perwakilan_nama FROM `tbl_berita`
					JOIN `tbl_jenis_berita` ON `tbl_berita`.`jenis_kd`= `tbl_jenis_berita`.`jenis_kd` 
					JOIN `tbl_sifat` ON `tbl_berita`.`sifat_kd`= `tbl_sifat`.`sifat_kd`
					JOIN `tbl_perwakilan` ON `tbl_perwakilan`.`perwakilan_kd`= `tbl_berita`.`perwakilan_kd` 
					JOIN `tbl_derajat` ON `tbl_derajat`.`derajat_kd`= `tbl_berita`.`derajat_kd` 
				WHERE `tbl_berita`.`berita_fungsi_disposisi`='" . $this->session->userdata ( 'SESSION_FUNGSI_KD' ) . "' and `tbl_berita`.`arsip_kd` LIKE '%" . $key1 . "%' AND `tbl_berita`.`berita_kd` LIKE '%" . $key2 . "%' AND `tbl_berita`.`perihal_berita` LIKE '%" . $key3 . "%' 
				AND tbl_berita.tgl_berita>= '" . $key4 . "' AND tbl_berita.tgl_berita<= '" . $key5 . "'";
		$query = $this->db->query ( $sql );
		return $query->result_array ();
	}
	function search_data_berita_fungsi($key1, $key2, $key3, $key4, $key5) {
		$this->db->order_by ( "tbl_berita.arsip_kd", "desc" );
		$this->db->select ( '*' );
		$this->db->from ( 'tbl_berita' );
		$this->db->join ( 'tbl_jenis_berita', 'tbl_berita.jenis_kd= tbl_jenis_berita.jenis_kd' );
		$this->db->join ( 'tbl_sifat', 'tbl_berita.sifat_kd= tbl_sifat.sifat_kd' );
		$this->db->join ( 'tbl_perwakilan', 'tbl_perwakilan.perwakilan_kd= tbl_berita.perwakilan_kd' );
		$this->db->join ( 'tbl_derajat', 'tbl_derajat.derajat_kd= tbl_berita.derajat_kd' );
		$this->db->join ( 'tbl_disposisi', 'tbl_disposisi.arsip_kd=tbl_berita.arsip_kd' );
		$this->db->join ( 'tbl_disposisi_detail', 'tbl_disposisi_detail.disposisi_kd=tbl_disposisi.disposisi_kd' );
		$this->db->where ( 'tbl_berita.berita_disposisikan', 'Y' );
		if (! empty ( $key4 ) && ! empty ( $key5 )) {
			$where = "tbl_berita.tgl_berita between CAST('$key4' as DATETIME) and CAST('$key5' as DATETIME)";
			$this->db->where ( $where );
		}
		$this->db->like ( 'tbl_berita.arsip_kd', $key1 );
		$this->db->like ( 'tbl_berita.berita_kd', $key2 );
		$this->db->like ( 'tbl_berita.perihal_berita', $key3 );
		$this->db->where ( 'tbl_disposisi_detail.detail_fungsi_kd', $this->session->userdata ( 'SESSION_FUNGSI_KD' ) );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function search_data_berita_fungsi_lanjutan($key1, $key2, $key3, $key4, $key5) {
		$this->db->order_by ( "tbl_berita.arsip_kd", "desc" );
		$this->db->select ( '*' );
		$this->db->from ( 'tbl_berita' );
		$this->db->join ( 'tbl_jenis_berita', 'tbl_berita.jenis_kd= tbl_jenis_berita.jenis_kd' );
		$this->db->join ( 'tbl_sifat', 'tbl_berita.sifat_kd= tbl_sifat.sifat_kd' );
		$this->db->join ( 'tbl_perwakilan', 'tbl_perwakilan.perwakilan_kd= tbl_berita.perwakilan_kd' );
		$this->db->join ( 'tbl_derajat', 'tbl_derajat.derajat_kd= tbl_berita.derajat_kd' );
		$this->db->join ( 'tbl_disposisi_lanjutan', 'tbl_disposisi_lanjutan.arsip_kd=tbl_berita.arsip_kd' );
		$this->db->join ( 'tbl_disposisi_lanjutan_detail', 'tbl_disposisi_lanjutan_detail.disposisi_lanjutan_kd=tbl_disposisi_lanjutan.disposisi_lanjutan_kd' );
		$this->db->where ( 'tbl_berita.berita_disposisikan', 'Y' );
		if (! empty ( $key4 ) && ! empty ( $key5 )) {
			$where = "tbl_berita.tgl_berita between CAST('$key4' as DATETIME) and CAST('$key5' as DATETIME)";
			$this->db->where ( $where );
		}
		$this->db->like ( 'tbl_berita.arsip_kd', $key1 );
		$this->db->like ( 'tbl_berita.berita_kd', $key2 );
		$this->db->like ( 'tbl_berita.perihal_berita', $key3 );
		$this->db->where ( 'tbl_disposisi_lanjutan_detail.detail_user_kd', $this->session->userdata ( 'SESSION_ID' ) );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function search_data_berita_dubes($key1, $key2, $key3, $key4, $key5) {
		$this->db->order_by ( "tbl_berita.arsip_kd", "desc" );
		$this->db->select ( '*' );
		$this->db->from ( 'tbl_berita' );
		$this->db->join ( 'tbl_jenis_berita', 'tbl_berita.jenis_kd= tbl_jenis_berita.jenis_kd' );
		$this->db->join ( 'tbl_sifat', 'tbl_berita.sifat_kd= tbl_sifat.sifat_kd' );
		$this->db->join ( 'tbl_perwakilan', 'tbl_perwakilan.perwakilan_kd= tbl_berita.perwakilan_kd' );
		$this->db->join ( 'tbl_derajat', 'tbl_derajat.derajat_kd= tbl_berita.derajat_kd' );
		$this->db->where ( 'tbl_berita.berita_disposisikan', 'Y' );
		if (! empty ( $key4 ) && ! empty ( $key5 )) {
			$where = "tbl_berita.tgl_berita between CAST('$key4' as DATETIME) and CAST('$key5' as DATETIME)";
			$this->db->where ( $where );
		}
		$this->db->like ( 'tbl_berita.arsip_kd', $key1 );
		$this->db->like ( 'tbl_berita.berita_kd', $key2 );
		$this->db->like ( 'tbl_berita.perihal_berita', $key3 );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function detail_berita($id) {
		$this->db->select ( '*' );
		$this->db->from ( 'tbl_berita' );
		$this->db->join ( 'tbl_jenis_berita', 'tbl_berita.jenis_kd= tbl_jenis_berita.jenis_kd' );
		$this->db->join ( 'tbl_sifat', 'tbl_berita.sifat_kd= tbl_sifat.sifat_kd' );
		$this->db->join ( 'tbl_perwakilan', 'tbl_perwakilan.perwakilan_kd= tbl_berita.perwakilan_kd' );
		$this->db->join ( 'tbl_derajat', 'tbl_derajat.derajat_kd= tbl_berita.derajat_kd' );
		$this->db->where ( 'tbl_berita.arsip_kd', $id );
		$this->db->order_by ( "tbl_berita.berita_kd", "desc" );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function detail_user($id) {
		$this->db->select ( '*' );
		$this->db->from ( 'tbl_user' );
		$this->db->where ( 'tbl_user.fungsi_kd', $id );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function cmb_fungsi() {
		$this->db->order_by ( "fungsi_kd", "desc" );
		$query = $this->db->get ( 'tbl_fungsi' );
		return $query->result_array ();
	}
	function cmb_sifat() {
		$this->db->order_by ( "sifat_kd", "desc" );
		$query = $this->db->get ( 'tbl_sifat' );
		return $query->result_array ();
	}
	function cmb_perwakilan() {
		$this->db->order_by ( "perwakilan_kd", "desc" );
		$query = $this->db->get ( 'tbl_perwakilan' );
		return $query->result_array ();
	}
	function isi_instruksi() {
		$this->db->order_by ( "instruksi_order", "asc" );
		$this->db->where ( 'instruksi_status', 'Aktif' );
		$query = $this->db->get ( 'tbl_instruksi' );
		return $query->result_array ();
	}
	function cmb_jenis() {
		$this->db->order_by ( "jenis_kd", "desc" );
		$query = $this->db->get ( 'tbl_jenis_berita' );
		return $query->result_array ();
	}
	function pelaku_fungsi() {
		$this->db->order_by ( "fungsi_urut", "asc" );
		$this->db->from ( 'tbl_fungsi' );
		$this->db->where ( 'fungsi_kd !=', 1 );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function cmb_derajat() {
		$this->db->order_by ( "derajat_kd", "desc" );
		$query = $this->db->get ( 'tbl_derajat' );
		return $query->result_array ();
	}
	function delete_pengguna($id) {
		$this->db->where ( 'user_kd', $id );
		$this->db->delete ( 'tbl_user' );
	}
	function disposisi_fungsi($id) {
		$this->db->select ( 'tbl_fungsi.nama_fungsi,tbl_disposisi_detail.disposisi_detail_kd,tbl_fungsi.fungsi_kd,tbl_fungsi.fungsi_urut' );
		$this->db->from ( 'tbl_disposisi_detail' );
		$this->db->join ( 'tbl_disposisi', 'tbl_disposisi.disposisi_kd=tbl_disposisi_detail.disposisi_kd' );
		$this->db->join ( 'tbl_fungsi', 'tbl_fungsi.fungsi_kd=tbl_disposisi_detail.detail_fungsi_kd' );
		$this->db->where ( 'tbl_disposisi.arsip_kd', $id );
		$this->db->order_by ( 'tbl_fungsi.fungsi_urut', 'asc' );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function disposisi_instruksi($id) {
		$this->db->order_by ( "tbl_instruksi.instruksi_kd", "desc" );
		$this->db->select ( 'tbl_instruksi.instruksi_nama,tbl_disposisi_instruksi.disposisi_instruksi_kd' );
		$this->db->from ( 'tbl_instruksi' );
		$this->db->join ( 'tbl_disposisi_instruksi', 'tbl_disposisi_instruksi.instruksi_kd=tbl_instruksi.instruksi_kd' );
		$this->db->where ( 'tbl_disposisi_instruksi.arsip_kd', $id );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function get_disposisi($id) {
		$this->db->select ( '*' );
		$this->db->from ( 'tbl_disposisi' );
		$this->db->where ( 'tbl_disposisi.arsip_kd', $id );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function get_undisposisi_fungsi($id) {
		$query = $this->db->query ( "select * from tbl_fungsi where fungsi_kd not in (
										select tbl_disposisi_detail.detail_fungsi_kd from tbl_disposisi_detail 
													inner join tbl_disposisi on tbl_disposisi_detail.disposisi_kd=tbl_disposisi.disposisi_kd
														where tbl_disposisi.arsip_kd='" . $id . "')  and tbl_fungsi.fungsi_kd!=1 order by fungsi_urut desc" );
		return $query->result_array ();
	}
	function get_undisposisi_instruksi($id) {
		$query = $this->db->query ( "select * from tbl_instruksi where instruksi_kd not in (select instruksi_kd from tbl_disposisi_instruksi where arsip_kd='" . $id . "')" );
		return $query->result_array ();
	}
	function delete_detail_disposisi_fungsi($id) {
		$this->db->where ( 'disposisi_detail_kd', $id );
		$this->db->delete ( 'tbl_disposisi_detail' );
	}
	function delete_disposisi_instruksi($id) {
		$this->db->where ( 'disposisi_instruksi_kd', $id );
		$this->db->delete ( 'tbl_disposisi_instruksi' );
	}
	function del_detail_disposisi($id) {
		$this->db->where ( 'disposisi_kd', $id );
		$this->db->delete ( 'tbl_disposisi_detail' );
	}
	function del_disposisi($id) {
		$this->db->where ( 'disposisi_kd', $id );
		$this->db->delete ( 'tbl_disposisi' );
	}
	function del_disposisi_instruksi($id) {
		$this->db->where ( 'arsip_kd', $id );
		$this->db->delete ( 'tbl_disposisi_instruksi' );
	}
	function get_detail_disposisi_fungsi($disposisi_kd, $fungsi_kd) {
		$this->db->select ( 'disposisi_detail_kd, detail_terima, detail_korespondensi, berita_status_pengerjaan' );
		$this->db->from ( 'tbl_disposisi_detail' );
		$this->db->where ( 'tbl_disposisi_detail.disposisi_kd', $disposisi_kd );
		$this->db->where ( 'tbl_disposisi_detail.detail_fungsi_kd', $fungsi_kd );
		$this->db->limit ( 1 );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	
	function get_detail_disposisi_fungsi_lanjutan($disposisi_kd, $user_kd) {
		$this->db->select ( '*' ); 
		$this->db->where ( 'tbl_disposisi_lanjutan_detail.disposisi_lanjutan_kd', $disposisi_kd );
		$this->db->where ( 'tbl_disposisi_lanjutan_detail.detail_user_kd', $user_kd);
		$this->db->limit ( 1 );
		$query = $this->db->get ('tbl_disposisi_lanjutan_detail');
		//print_r($query->result_array()); exit;
		return $query->result_array ();
	}
	function update_terima_disposisi($id) {
		$data = array (
				'detail_terima' => 'Y',
				'detail_korespondensi' => $_POST ['korespondensi'],
				'detail_waktu' => date ( 'Y-m-d h:i:s' ) 
		);
		$this->db->where ( 'disposisi_detail_kd', $id );
		$this->db->update ( 'tbl_disposisi_detail', $data );
	}
	function do_disposisi_lanjutan() {
		$data = array (
				'arsip_kd' => $_POST ['arsip_kd'],
				'disposisi_lanjutan_oleh' => $this->session->userdata ( 'SESSION_ID' ),
				'disposisi_lanjutan_tanggal' => date ( 'Y-m-d h:i:s' ),
				'disposisi_lanjutan_catatan 	' => $_POST ['disposisi_lanjutan_catatan'] 
		);
		$this->db->insert ( 'tbl_disposisi_lanjutan', $data );
	}
	function get_last_disposisi_lanjutan() {
		$this->db->select ( '*' );
		$this->db->order_by ( "disposisi_lanjutan_kd", "desc" );
		$this->db->limit ( 1 );
		$this->db->from ( 'tbl_disposisi_lanjutan' );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function insert_disposisi_lanjutan_fungsi($disposisi_lanjutan_kd, $user_kd, $kd_arsip, $perwakilan,$perihal_berita, $catatan, $derajat) {
 		$this->load->library ( 'email', $this->config );
		$this->email->set_newline ( "\r\n" );
		$this->email->set_crlf ( "\r\n" );
 		$this->email->initialize ( $this->config );
		
		foreach ( $user_kd as $row ) {
			$data = array (
					'disposisi_lanjutan_kd' => $disposisi_lanjutan_kd,
					'detail_user_kd' => $row 
			);
			$this->db->insert ( 'tbl_disposisi_lanjutan_detail', $data );
			$this->db->where('user_kd',$row);
			$query = $this->db->get('tbl_user');
			$val = $query->result_array ();
			
					$txt = "<html>
							<table>
								<tr>
									<th colspan='3'><b>Informasi Disposisi </b> </th>
								</tr>
								<tr>
									<td>No Arsip </td><td>:</td> <td><i> " . $kd_arsip . "</i></td>
								</tr>  
							    <tr>
									<td>Pengirim </td> <td>:</td><td> " . $perwakilan . " </td>
								</tr>
						        <tr> 
									<td>Derajat </td><td>:</td><td> " . $derajat . "</td>
								</tr>
						        <tr> 
									<td>Perihal </td><td>:</td><td> " . $perihal_berita . "</td>
								</tr>
						        <tr> 
									<td>Catatan Disposisi</td><td>:</td><td> " . $catatan . "</td>
								</tr>
								<tr>
									<td colspan='3'>Untuk membuka disposisi silahkan login ke aplikasi disposisi.</td>
								</tr>
							</table>
						</html>";
						$this->email->set_mailtype ( "html" );
			$this->email->from ( $this->session->userdata ( 'email_administrator' ), 'Admin Edisposisi ' . $this->session->userdata ( 'nama_singkat_perwakilan' ) );
			$this->email->to ( $val[0]['user_email'] );
			$this->email->subject ( 'Disposisi Baru untuk Anda : '.$kd_arsip.'');
			$this->email->message ( $txt );
			$this->email->send();
			
			
		}
	}
	function insert_disposisi_lanjutan_instruksi($disposisi_lanjutan_kd, $instruksi_kd) {
		foreach ( $instruksi_kd as $row ) {
			$data = array (
					'disposisi_lanjutan_kd' => $disposisi_lanjutan_kd,
					'instruksi_kd' => $row 
			);
			$this->db->insert ( 'tbl_disposisi_lanjutan_instruksi', $data );
		}
	}
	function get_user_disposed_lanjutan($arsip_kd, $fungsi_kd) {
		$this->db->distinct ();
		$this->db->select ( 'tbl_user.user_nama, tbl_user.user_namalengkap, tbl_user.user_kd, tbl_disposisi_lanjutan_detail.detail_terima,tbl_disposisi_lanjutan_detail.detail_korespondensi, tbl_disposisi_lanjutan_detail.detail_waktu' );
		$this->db->from ( 'tbl_disposisi_lanjutan' );
		$this->db->join ( 'tbl_disposisi_lanjutan_detail', 'tbl_disposisi_lanjutan.disposisi_lanjutan_kd=tbl_disposisi_lanjutan_detail.disposisi_lanjutan_kd' );
		$this->db->join ( 'tbl_disposisi_lanjutan_instruksi', 'tbl_disposisi_lanjutan.disposisi_lanjutan_kd=tbl_disposisi_lanjutan_instruksi.disposisi_lanjutan_kd' );
		$this->db->join ( 'tbl_user', 'tbl_disposisi_lanjutan_detail.detail_user_kd=tbl_user.user_kd' );
		$this->db->where ( 'tbl_user.fungsi_kd', $fungsi_kd );
		$this->db->where ( 'tbl_disposisi_lanjutan.arsip_kd', $arsip_kd );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function get_instruksi_disposed_lanjutan($arsip_kd, $disposisi_lanjutan_kd) {
		$this->db->distinct ();
		$this->db->select ( 'tbl_instruksi.instruksi_nama, tbl_instruksi.instruksi_kd' );
		$this->db->from ( 'tbl_disposisi_lanjutan' );
		$this->db->join ( 'tbl_disposisi_lanjutan_detail', 'tbl_disposisi_lanjutan.disposisi_lanjutan_kd=tbl_disposisi_lanjutan_detail.disposisi_lanjutan_kd' );
		$this->db->join ( 'tbl_disposisi_lanjutan_instruksi', 'tbl_disposisi_lanjutan.disposisi_lanjutan_kd=tbl_disposisi_lanjutan_instruksi.disposisi_lanjutan_kd' );
		$this->db->join ( 'tbl_instruksi', 'tbl_disposisi_lanjutan_instruksi.instruksi_kd=tbl_instruksi.instruksi_kd' );
		$this->db->where ( 'tbl_disposisi_lanjutan.arsip_kd', $arsip_kd );
		$this->db->where ( 'tbl_disposisi_lanjutan.disposisi_lanjutan_kd', $disposisi_lanjutan_kd );
		
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function get_disposisi_lanjutan($arsip_kd, $user_kd) {
		$this->db->select ( '*' );
		$this->db->order_by ( "disposisi_lanjutan_kd", "desc" );
		$this->db->from ( 'tbl_disposisi_lanjutan' );
		$this->db->where ( 'tbl_disposisi_lanjutan.arsip_kd', $arsip_kd );
		$this->db->where ( 'tbl_disposisi_lanjutan.disposisi_lanjutan_oleh', $user_kd );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function get_disposisi_lanjutan_fungsi($arsip_kd, $user_kd) {
		$this->db->select ( 'tbl_disposisi_lanjutan.*' );
		$this->db->order_by ( "disposisi_lanjutan_kd", "desc" );
		$this->db->from ( 'tbl_disposisi_lanjutan' );
		$this->db->join ( 'tbl_disposisi_lanjutan_detail', 'tbl_disposisi_lanjutan_detail.disposisi_lanjutan_kd=tbl_disposisi_lanjutan.disposisi_lanjutan_kd' );
		$this->db->where ( 'tbl_disposisi_lanjutan.arsip_kd', $arsip_kd );
		$this->db->where ( 'tbl_disposisi_lanjutan_detail.detail_user_kd', $user_kd );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function get_detail_disposed_lanjutan($disposisi_lanjutan_kd, $user_kd) {
		$this->db->select ( '*' );
		$this->db->from ( 'tbl_disposisi_lanjutan_detail' );
		$this->db->join ('tbl_user','tbl_user.user_kd=tbl_disposisi_lanjutan_detail.detail_user_kd');
		$this->db->where ( 'tbl_disposisi_lanjutan_detail.disposisi_lanjutan_kd', $disposisi_lanjutan_kd );
		$this->db->where ( 'tbl_disposisi_lanjutan_detail.detail_user_kd', $user_kd );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function update_status_korenspondensi_lanjutan($disposisi_lanjutan_kd, $user_kd) {
		$data = array (
				'detail_korespondensi' => $_POST ['korespondensi_detail'],
				'detail_terima' => 'Y',
				'detail_waktu' => date ( 'Y-m-d h:i:s' ) 
		);
		$this->db->where ( 'disposisi_lanjutan_kd', $disposisi_lanjutan_kd );
		$this->db->where ( 'detail_user_kd', $user_kd );
		$this->db->update ( 'tbl_disposisi_lanjutan_detail', $data );
	}
	function get_korespondensi_disposisi_fungsi($disposisi_kd) {
		$this->db->select ( 'disposisi_detail_kd, detail_terima, detail_korespondensi, nama_fungsi, detail_waktu' );
		$this->db->from ( 'tbl_disposisi_detail' );
		$this->db->join ( 'tbl_fungsi', 'tbl_fungsi.fungsi_kd=tbl_disposisi_detail.detail_fungsi_kd' );
		$this->db->where ( 'tbl_disposisi_detail.disposisi_kd', $disposisi_kd );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function list_perwakilan($val) {
		$this->db->select ( 'perwakilan_kd id, perwakilan_nama label, , perwakilan_nama value' );
		$this->db->like ( 'perwakilan_nama', $this->input->post ( 'queryString' ) );
		$this->db->from ( 'tbl_perwakilan' );
		$this->db->like ( 'perwakilan_nama', $val );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function insert_pengirim() {
		$data = array (
				'perwakilan_nama' => $this->input->post ( 'queryString' ) 
		);
		$this->db->insert ( 'tbl_perwakilan', $data );
	}
	function update_password() {
		$val = explode ( ",", $this->input->post ( 'queryString' ) );
		
		// $data = array (
		// 'user_password' => md5($)
		// );
		$this->db->where ( 'user_kd', $this->uri->segment ( 4 ) );
		$this->db->update ( 'tbl_user', $data );
	}
	function jml_berita_tahun_ini() {
		$this->db->select ( 'count(arsip_kd) as jml' );
		$this->db->from ( 'tbl_berita' );
		$this->db->like ( 'arsip_kd', '-' . date ( 'y' ) . '-', 'both' );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function get_respon($id) {
		$this->db->select ( 'detail_korespondensi' );
		$this->db->from ( 'tbl_disposisi_detail' );
		$this->db->where ( 'disposisi_detail_kd', $id );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function get_pendispo() {
		$this->db->select ( '*' );
		$this->db->from ( 'tbl_fungsi' );
		$this->db->where ( 'disposisi_fungsi', 'Y' );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	function update_berkas_dispo($id, $filename) {
		$this->db->where ( 'arsip_kd', $id );
		$data = array (
				'berita_berkas_disposisi' => $filename 
		);
		$this->db->update ( 'tbl_berita', $data );
	}
	function get_inputted_fungsi_byfile($file) {
		$this->db->where ( 'berita_file', $file );
		$query = $this->db->get ( 'tbl_berita' );
		return $query->result_array ();
	}
	function get_if_lanjutan($fungsi_kd) {
		$this->db->where ( 'fungsi_kd', $fungsi_kd );
		$this->db->where ( 'koordinator_fungsi', 'T' );
		$this->db->from ( 'tbl_user' );
		$query = $this->db->count_all_results ();
		return $query;
	}
	function get_pelaksana_lanjutan($fungsi_kd) {
		$this->db->where ( 'fungsi_kd', $fungsi_kd );
		$this->db->where ( 'koordinator_fungsi', 'T' );
		$query = $this->db->get ( 'tbl_user' );
		return $query->result_array ();
	}
	function get_korespondensi($kd) {
		$this->db->where ( 'arsip_kd', $kd );
		$this->db->order_by ( 'korespondensi_id', 'desc' );
		$query = $this->db->get ( 'tbl_korespondensi' );
		return $query->result_array ();
	}
	function insert_korespondensi($arsip_kd) {
		$data = array (
				'arsip_kd' => $arsip_kd,
				'user_nama' => $this->session->userdata ( 'SESSION_NAMALENGKAP' ),
				'korespondensi_komentar' => $_POST ['korespondensi_komentar'],
				'korespondensi_datetime' => date ( 'Y-m-d h:i:s' ) 
		);
		$this->db->insert ( 'tbl_korespondensi', $data );
	}
	function update_pengerjaan($id_dispo) {
		$this->db->where ( 'disposisi_detail_kd', $id_dispo );
		$data = array (
				'berita_status_pengerjaan' => 'Y' 
		);
		$this->db->update ( 'tbl_disposisi_detail', $data );
	}
	function update_pengerjaan_lanjutan($id_dispo) {
		$this->db->where ( 'disposisi_lanjutan_detail_kd', $id_dispo );
		$data = array (
				'berita_status_pengerjaan' => 'Y' 
		);
		$this->db->update ( 'tbl_disposisi_lanjutan_detail', $data );
	}
	function get_pengerjaan($arsip_kd) {
		$this->db->select('tbl_fungsi.nama_fungsi, tbl_disposisi_detail.berita_status_pengerjaan');
		$this->db->where ( 'tbl_disposisi.arsip_kd', $arsip_kd );
		$this->db->from('tbl_disposisi');
		$this->db->join('tbl_disposisi_detail', 'tbl_disposisi_detail.disposisi_kd=tbl_disposisi.disposisi_kd');
		$this->db->join('tbl_fungsi', 'tbl_fungsi.fungsi_kd=tbl_disposisi_detail.detail_fungsi_kd');		
		$query = $this->db->get ();
		return $query->result_array ();
	}	
}
?>
