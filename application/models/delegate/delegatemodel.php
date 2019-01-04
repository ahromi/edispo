<?php
class Delegatemodel extends CI_Model {
    function __construct()
    {
       //Memanggil Constructor Model
        parent::__construct();
    }
	
 	function get_combo_delegate_fungsi(){
		$this->db->select('*');
		$this->db->from('tbl_fungsi');
		$this->db->where('disposisi_fungsi', 'T');	
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_fungsi_delegated()
	{	
		$sql="select * from tbl_fungsi where disposisi_fungsi='Y' and (fungsi_kd != 1 and fungsi_kd != 2)";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	

	function update_delegation($id)
	{
		$sql="update tbl_fungsi set disposisi_fungsi='T' where disposisi_fungsi='Y' and (fungsi_kd != 1 and fungsi_kd != 2)";
		$this->db->query($sql);	
		
		$data = array(
		               'disposisi_fungsi' => 'Y' 
		            );
		
		$this->db->where('fungsi_kd', $id);
		$this->db->update('tbl_fungsi', $data);
		
	}
		
	function update_redelegation($id)
	{
 		$data = array(
		               'disposisi_fungsi' => 'T' 
		            );
		
		$this->db->where('fungsi_kd', $id);
		$this->db->update('tbl_fungsi', $data);

		//melakukan pengalihan seluruh berita yang menunggu disposisi fungsi tersebut
 		$data2 = array(
		               'berita_fungsi_disposisi ' => '1' 
		            );
		
		$this->db->where('berita_fungsi_disposisi', $id);
		$this->db->where('status_disposisi', 'T');
		$this->db->update('tbl_berita', $data2);
		
	}
	


}
?>