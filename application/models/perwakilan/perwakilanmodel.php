<?php
class Perwakilanmodel extends CI_Model {
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
		$this->db->order_by("perwakilan_nama", "asc"); 
		$this->db->select('*');
		$this->db->from('tbl_perwakilan');
		$query = $this->db->count_all_results();
		return $query->result_array();
	}
	
	function get_data_perwakilan($num,$offset)
	{
		$this->db->order_by("perwakilan_nama", "asc"); 
		$this->db->select('*');
		$this->db->from('tbl_perwakilan');
		$this->db->limit($num,$offset);
		$query = $this->db->get();
		return $query->result_array();
	}
	

	function tambah_perwakilan()
	{
		$data = array(
			   'perwakilan_nama' => $_POST['perwakilan_nama']			   		   
            );
		$this->db->insert('tbl_perwakilan', $data); 
	}



	function search_data_perwakilan($key)
	{
		$this->db->order_by("perwakilan_nama", "desc"); 
		$this->db->select('*');
		$this->db->from('tbl_perwakilan');
		$this->db->like('tbl_perwakilan.perwakilan_nama',$key);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function detail_perwakilan($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_perwakilan');
		$this->db->where('perwakilan_kd',$id);
		$this->db->order_by("perwakilan_nama", "desc"); 
		$query = $this->db->get();
		return $query->result_array();
	}

	
	
	function edit_perwakilan($id)
	{
 		$data = array(
			   'perwakilan_nama' => $_POST['perwakilan_nama']
			  // 'perwakilan_kd' => $_POST['perwakilan_kd']			   
            );

		$this->db->where('perwakilan_kd',$id);
		$this->db->update('tbl_perwakilan', $data); 
	}

	function delete_perwakilan($id)
	{
		$this->db->where('perwakilan_kd', $id);
		$this->db->delete('tbl_perwakilan'); 
	}

}
?>