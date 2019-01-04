<?php
class Penggunamodel extends CI_Model {
    function __construct()
    {
       //Memanggil Constructor Model
        parent::__construct();
    }
	
	function verifikasi($username,$password)
	{
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->join('tbl_fungsi','tbl_user.fungsi_kd=tbl_fungsi.fungsi_kd');
		$this->db->where('tbl_user.user_nama',$username);
		$this->db->where('tbl_user.user_password',$password);
		$this->db->where('tbl_user.user_status','Y');
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_count_data(){
		$this->db->order_by("user_kd", "desc"); 
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->join('tbl_fungsi', 'tbl_user.fungsi_kd= tbl_fungsi.fungsi_kd');
		$query = $this->db->count_all_results();
		return $query->result_array();
	}
	
	function get_data_pengguna($num,$offset)
	{
		$this->db->order_by("user_kd", "desc"); 
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->join('tbl_fungsi', 'tbl_user.fungsi_kd= tbl_fungsi.fungsi_kd');
		$this->db->limit($num,$offset);
		$query = $this->db->get();
		return $query->result_array();
	}
	

	function tambah_pengguna()
	{
		$data = array(
			   'user_nama' => $_POST['user_nama'],
			   'user_password' => md5($_POST['user_password']),
			   'fungsi_kd' => $_POST['fungsi_kd'],
			   'koordinator_fungsi' => $_POST['koordinator_fungsi'],
			   'user_namalengkap' => $_POST['user_namalengkap'],
			   'user_menerima_disposisi' => $_POST['user_menerima_disposisi'],
			   'user_status' => $_POST['user_status'],
			   'user_email' => $_POST['user_email'],
			   'user_notifikasi_email' => $_POST['user_notifikasi_email']
            );
		$this->db->insert('tbl_user', $data); 
	}

	function tambah_pengguna_with_foto()
	{
  		$data = array(
			   'user_nama' => $_POST['user_nama'],
			   'user_password' => md5($_POST['user_password']),
			   'fungsi_kd' => $_POST['fungsi_kd'],
			   'koordinator_fungsi' => $_POST['koordinator_fungsi'],
			   'user_namalengkap' => $_POST['user_namalengkap'],
			   'user_status' => $_POST['user_status'],
			   'user_menerima_disposisi' => $_POST['user_menerima_disposisi'],
			   'user_email' => $_POST['user_email'],
			   'user_notifikasi_email' => $_POST['user_notifikasi_email'],
			   'user_foto' => $_FILES['userfile']['name']
            );
		$this->db->insert('tbl_user', $data); 
	}


	function change_password(){
		$data = array (
					   'user_password' => md5($_POST['user_password'])
					   );	
		$this->db->where('user_kd',$this->uri->segment(4));
		$this->db->update('tbl_user', $data); 
	}

	function change_foto(){
		$data = array (
 					   'user_foto' => $_FILES['userfile']['name']
					   );	
		$this->db->where('user_kd',$this->uri->segment(4));
		$this->db->update('tbl_user', $data); 
	}

	function search_data_pengguna($key)
	{
		$this->db->order_by("user_kd", "desc"); 
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->join('tbl_fungsi', 'tbl_user.fungsi_kd= tbl_fungsi.fungsi_kd');
		$this->db->like('tbl_user.user_nama',$key);
		$this->db->or_like('tbl_user.user_namalengkap',$key);
		$this->db->or_like('tbl_fungsi.nama_fungsi',$key);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function detail_pengguna($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->join('tbl_fungsi', 'tbl_user.fungsi_kd= tbl_fungsi.fungsi_kd');
		$this->db->where('user_kd',$id);
		$this->db->order_by("user_kd", "desc"); 
		$query = $this->db->get();
		return $query->result_array();
	}

	function cmb_fungsi()
	{
		$this->db->order_by("fungsi_kd", "desc"); 
		$query = $this->db->get('tbl_fungsi');
		return $query->result_array();
	}
	
	function isi_instruksi()
	{
		$this->db->order_by("instruksi_kd", "desc"); 
		$query = $this->db->get('tbl_instruksi');
		return $query->result_array();
	}
	
	function edit_pengguna($id)
	{
 		$data = array(
			   'user_nama' => $_POST['user_nama'],
			   'fungsi_kd' => $_POST['fungsi_kd'],
			   'user_namalengkap' => $_POST['user_namalengkap'],
			   'koordinator_fungsi' => $_POST['koordinator_fungsi'],
			   'user_menerima_disposisi' => $_POST['user_menerima_disposisi'],
			   'user_status' => $_POST['user_status'],
			   'user_email' => $_POST['user_email'],
			   'user_notifikasi_email' => $_POST['user_notifikasi_email']
            );

		$this->db->where('user_kd',$id);
		$this->db->update('tbl_user', $data); 
	}

	function delete_pengguna($id)
	{
		$this->db->where('user_kd', $id);
		$this->db->delete('tbl_user'); 
	}
	
	function cek_paswd_lama($id,$paswd)
	{
 		$this->db->select('count(*) as jml');
		$this->db->from('tbl_user');
 		$this->db->where('user_kd',$id);
 		$this->db->where('user_password',$paswd);
 		$query = $this->db->get();
		return $query->result_array();
	}
	
	function ubah_paswd($id,$paswd)
	{
 		$data = array(
 			   'user_password' => $paswd
            );
 		$this->db->where('user_kd',$id);
  		$this->db->update('tbl_user', $data); 
	}

}
?>