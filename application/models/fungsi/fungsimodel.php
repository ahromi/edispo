<?php
class Fungsimodel extends CI_Model {
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
	
	function get_data_fungsi($num,$offset)
	{
		$this->db->order_by("fungsi_urut", "asc"); 
		$this->db->select('*');
		$this->db->from('tbl_fungsi');
		$this->db->limit($num,$offset);
		$query = $this->db->get();
		return $query->result_array();
	}
        
        function get_data_fungsi_all($limit,$offset)
	{
		$this->db->order_by("fungsi_urut", "asc"); 
		$this->db->select('*');
		$this->db->from('tbl_fungsi');
                $this->db->where_not_in('fungsi_kd',1);
                $this->db->limit($limit,$offset);
		$query = $this->db->get();
		return $query->result_array();
	}
	

	function tambah_fungsi()
	{
		$data = array(
			   'nama_fungsi' => $_POST['nama_fungsi'],			   		   
			   'status_fungsi' => $_POST['status_fungsi'],		   		   
			   'disposisi_fungsi' => $_POST['disposisi_fungsi'],		   		   
			   'fungsi_input' => $_POST['fungsi_input'],	   		   
			   'fungsi_urut' => $_POST['fungsi_urut']		   		   
            );
		$this->db->insert('tbl_fungsi', $data); 
	}



	function search_data_fungsi($key)
	{
		$this->db->order_by("fungsi_kd", "asc"); 
		$this->db->select('*');
		$this->db->from('tbl_fungsi');
		$this->db->like('tbl_fungsi.nama_fungsi',$key);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function detail_fungsi($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_fungsi');
		$this->db->where('fungsi_kd',$id);
		$this->db->order_by("fungsi_kd", "desc"); 
		$query = $this->db->get();
		return $query->result_array();
	}

	
	
	function edit_fungsi($id)
	{
		//melakukan update fungsi pada tabel user
 		$data = array(
			   'nama_fungsi' => $_POST['nama_fungsi'],			   		   
			   'status_fungsi' => $_POST['status_fungsi'],		   		   
			   'disposisi_fungsi' => $_POST['disposisi_fungsi'],		   		   
			   'fungsi_input' => $_POST['fungsi_input'],
			   'fungsi_urut' => $_POST['fungsi_urut']		   		   
             );

		$this->db->where('fungsi_kd',$id);
		$this->db->update('tbl_fungsi', $data); 
		
		//melakukan pengalihan seluruh berita yang menunggu disposisi fungsi tersebut
		if ($_POST['disposisi_fungsi']='T') {
			$data2 = array(
						   'berita_fungsi_disposisi ' => '1' 
						);
			
			$this->db->where('berita_fungsi_disposisi', $id);
			$this->db->where('status_disposisi', 'T');
			$this->db->update('tbl_berita', $data2);
		}
	}

	function delete_fungsi($id)
	{
		$this->db->where('fungsi_kd', $id);
		$this->db->delete('tbl_fungsi'); 
	}

}
?>