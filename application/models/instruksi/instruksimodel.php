<?php
class Instruksimodel extends CI_Model {
    function __construct()
    {
       //Memanggil Constructor Model
        parent::__construct();
    }
	
 	function get_count_data(){
		$this->db->order_by("instruksi", "asc"); 
		$this->db->select('*');
		$this->db->from('tbl_instruksi');
		$query = $this->db->count_all_results();
		return $query->result_array();
	}
	
	function get_data_instruksi($num,$offset)
	{
		$this->db->order_by("instruksi_nama", "asc"); 
		$this->db->select('*');
		$this->db->from('tbl_instruksi');
		$this->db->limit($num,$offset);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function tambah_instruksi()
	{
		$data = array(
			   'instruksi_nama' => $_POST['instruksi_nama']			   		   
            );
		$this->db->insert('tbl_instruksi', $data); 
	}

	function search_data_instruksi($key)
	{
		$this->db->order_by("instruksi_nama", "asc"); 
		$this->db->select('*');
		$this->db->from('tbl_instruksi');
		$this->db->like('tbl_instruksi.instruksi_nama',$key);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function detail_instruksi($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_instruksi');
		$this->db->where('instruksi_kd',$id);
		$this->db->order_by("instruksi_nama", "desc"); 
		$query = $this->db->get();
		return $query->result_array();
	}

	function edit_instruksi($id)
	{
 		$data = array(
			   'instruksi_nama' => $_POST['instruksi_nama']
			  // 'jenisberita_kd' => $_POST['jenis_kd']			   
            );

		$this->db->where('instruksi_kd',$id);
		$this->db->update('tbl_instruksi', $data); 
	}

	function status_instruksi($id)
	{ 		
		if ($this->uri->segment(5)=='Inaktif'){
			$val="Aktif";
		}
		else {
			$val="Inaktif";			
		}
		$data = array(
			   'instruksi_status' => $val   
            );

		$this->db->where('instruksi_kd',$id);
		$this->db->update('tbl_instruksi', $data); 
	}

}
?>