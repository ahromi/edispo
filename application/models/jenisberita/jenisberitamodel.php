<?php
class Jenisberitamodel extends CI_Model {
    function __construct()
    {
       //Memanggil Constructor Model
        parent::__construct();
    }
	
	function verifikasi($username,$password)
	{
		$sql = "select * from tbl_user p, tbl_fungsi w where p.fungsi_kd=w.fungsi_kd and p.user_nama  = ? and p.user_password = ? and p.user_status='Y'";
		$query = $this->db->query($sql,array($username,$password));
		return $query->result_array();
	}

	function get_count_data(){
		$this->db->order_by("jenis_nama", "asc"); 
		$this->db->select('*');
		$this->db->from('tbl_jenis_berita');
		$query = $this->db->count_all_results();
		return $query->result_array();
	}
	
	function get_data_jenisberita($num,$offset)
	{
		$this->db->order_by("jenis_nama", "asc"); 
		$this->db->select('*');
		$this->db->from('tbl_jenis_berita');
		$this->db->limit($num,$offset);
		$query = $this->db->get();
		return $query->result_array();
	}
	

	function tambah_jenisberita()
	{
		$data = array(
			   'jenis_nama' => $_POST['jenis_nama']			   		   
            );
		$this->db->insert('tbl_jenis_berita', $data); 
	}



	function search_data_jenisberita($key)
	{
		$this->db->order_by("jenis_nama", "asc"); 
		$this->db->select('*');
		$this->db->from('tbl_jenis_berita');
		$this->db->like('tbl_jenis_berita.jenis_nama',$key);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function detail_jenisberita($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_jenis_berita');
		$this->db->where('jenis_kd',$id);
		$this->db->order_by("jenis_nama", "desc"); 
		$query = $this->db->get();
		return $query->result_array();
	}

	
	
	function edit_jenisberita($id)
	{
 		$data = array(
			   'jenis_nama' => $_POST['jenis_nama']
			  // 'jenisberita_kd' => $_POST['jenis_kd']			   
            );

		$this->db->where('jenis_kd',$id);
		$this->db->update('tbl_jenis_berita', $data); 
	}

	function delete_jenisberita($id)
	{
		$this->db->where('jenis_kd', $id);
		$this->db->delete('tbl_jenis_berita'); 
	}

}
?>