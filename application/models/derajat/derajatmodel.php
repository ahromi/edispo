<?php
class Derajatmodel extends CI_Model {
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
		$this->db->order_by("derajat_nama", "asc"); 
		$this->db->select('*');
		$this->db->from('tbl_derajat');
		$query = $this->db->count_all_results();
		return $query->result_array();
	}
	
	function get_data_derajat($num,$offset)
	{
		$this->db->order_by("derajat_nama", "asc"); 
		$this->db->select('*');
		$this->db->from('tbl_derajat');
		$this->db->limit($num,$offset);
		$query = $this->db->get();
		return $query->result_array();
	}
	

	function tambah_derajat()
	{
		$data = array(
			   'derajat_nama' => $_POST['derajat_nama'],
			   'derajat_kd' => $_POST['derajat_kd']			   		   
            );
		$this->db->insert('tbl_derajat', $data); 
	}


	function search_data_derajat($key)
	{
		$this->db->order_by("derajat_nama", "desc"); 
		$this->db->select('*');
		$this->db->from('tbl_derajat');
		$this->db->like('tbl_derajat.derajat_nama',$key);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function detail_derajat($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_derajat');
		$this->db->where('derajat_kd',$id);
		$this->db->order_by("derajat_nama", "desc"); 
		$query = $this->db->get();
		return $query->result_array();
	}

	
	
	function edit_derajat($id)
	{
 		$data = array(
			   'derajat_nama' => $_POST['derajat_nama'],
			   'derajat_kd' => $_POST['derajat_kd']			   
            );

		$this->db->where('derajat_kd',$id);
		$this->db->update('tbl_derajat', $data); 
	}

	function delete_derajat($id)
	{
		$this->db->where('derajat_kd', $id);
		$this->db->delete('tbl_derajat'); 
	}

}
?>