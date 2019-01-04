<?php
class Installmodel extends CI_Model {
    function __construct()
    {
       //Memanggil Constructor Model
        parent::__construct();
    }
	
    function getSetting(){
    	$query = $this->db->get('tbl_setting');
    	return $query->result_array();
    }
    function getVersion(){
    	$query = $this->db->get('tbl_version');
    	return $query->result_array();
    }
    
	function getKeppri(){
		$this->db->where('fungsi_kd','1');
		$query=$this->db->get('tbl_user');
		return $query->result_array();
	}

	function getPK(){
		$this->db->where('fungsi_kd','2');
		$query=$this->db->get('tbl_user');
		return $query->result_array();
	}
	
    function getPengguna(){
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->join('tbl_fungsi','tbl_fungsi.fungsi_kd=tbl_user.fungsi_kd');
                $this->db->where('tbl_fungsi.fungsi_kd !=','1');
		$this->db->where('tbl_fungsi.fungsi_kd !=','2');
		$query = $this->db->get();
		return $query->result_array();		
    }

    function getKoordinator(){
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->join('tbl_fungsi','tbl_fungsi.fungsi_kd=tbl_user.fungsi_kd');
    	$this->db->where('tbl_fungsi.fungsi_kd !=','1');
		$this->db->where('tbl_fungsi.fungsi_kd !=','2');
		$this->db->where('tbl_fungsi.koordinator_fungsi =','Y');
		$query = $this->db->get();
		return $query->result_array();		
    }
	
    function getDetailPengguna($id){
		$this->db->where('user_kd',$id);
		$query=$this->db->get('tbl_user');
		return $query->result_array();
    }
    
	function getFungsi(){
		$this->db->where("fungsi_kd !=",'1');
		$this->db->where("fungsi_kd !=",'2');
		$query = $this->db->get('tbl_fungsi');
		return $query->result_array();		
	}
    
	function refreshFungsi(){
		$this->db->where("fungsi_kd !=",'1');
		$this->db->where("fungsi_kd !=",'2');
		$query = $this->db->get('tbl_fungsi');
		return $query->result_array();	
	}
	
	function redundantCheck($fungsi_nama,$field,$table){
		$this->db->where($field,$fungsi_nama);
		$this->db->from($table);
		return $this->db->count_all_results();	
		
	}

	function redundantCheckForKoord($fungsi_kd){
		$this->db->where('fungsi_kd =',$fungsi_kd);
		$this->db->where('koordinator_fungsi =','Y');
		$this->db->from('tbl_user');
		return $this->db->count_all_results();	
		
	}

	function addFungsi($fungsi_nama){
		$data = array(
			'nama_fungsi' => $fungsi_nama,
			'status_fungsi' => 'Y',
			'disposisi_fungsi' => 'T'
		);
		$this->db->insert('tbl_fungsi',$data); 
	}

	function setKeppri($user_namalengkap,$user_nama,$user_password,$fungsi_kd){
		$data = array(
			'user_namalengkap' => $user_namalengkap,
			'user_nama' => $user_nama,
			'user_password' => md5($user_password),
			'fungsi_kd'=> $fungsi_kd,
			'user_status'=> 'Y');
		$this->db->where('user_kd','1');
		$this->db->update('tbl_user',$data); 
	}
	
	function setPK($user_namalengkap,$user_nama,$user_password,$fungsi_kd){
		$data = array(
			'user_namalengkap' => $user_namalengkap,
			'user_nama' => $user_nama,
			'user_password' => md5($user_password),
			'fungsi_kd'=> $fungsi_kd,
			'user_status'=> 'Y');
		$this->db->where('user_kd','2');
		$this->db->update('tbl_user',$data); 
	}
	
	function setPwd($paswd,$id){
		$data = array(
			'user_pasword'=> md5($paswd));
		$this->db->where('user_kd',$id);
		$this->db->update('tbl_user',$data); 
	}
	
	function addPengguna($user_namalengkap,$user_nama,$user_password,$fungsi_kd,$user_email,$user_notifikasi_email,$koord){
		$data = array(
			'user_namalengkap' => $user_namalengkap,
			'user_nama' => $user_nama,
			'user_password' => md5($user_password),
			'fungsi_kd'=> $fungsi_kd,
			'koordinator_fungsi'=> $koord,
			'user_email'=> $user_email,
			'user_notifikasi_email'=> $user_notifikasi_email,
			'user_status'=> 'Y'
		);
		$this->db->insert('tbl_user',$data); 
	}
	
	
	function delFungsi($id){
		$this->db->where('fungsi_kd', $id);
		$this->db->delete('tbl_fungsi'); 
	}

	function delUser($id){
		$this->db->where('user_kd', $id);
		$this->db->delete('tbl_user'); 
	}
		
	function insertSetting(){
		$data = array(
			'nama_perwakilan' => $_POST['nama_perwakilan'],
			'nama_singkat_perwakilan' => $_POST['nama_singkat_perwakilan'], 
			'nama_jabatan_kepala_perwakilan' => $_POST['nama_jabatan_kepala_perwakilan'], 
			'warna_latar' => $_POST['warna_latar'],
			'alamat_perwakilan' => $_POST['alamat_perwakilan'],
			'email_administrator' => $_POST['email_administrator'],
			'email_administrator_password' => $_POST['email_administrator_password']
		);
		$this->db->update('tbl_setting',$data);		
		
		$data2 = array(
			'nama_fungsi'=> $_POST['nama_jabatan_kepala_perwakilan']);
		$this->db->where('fungsi_kd',1);
		$this->db->update('tbl_fungsi',$data2);
		
	}
	
	function isSetted(){	
	/*	$where="nama_perwakilan is NULL";
		$this->db->where($where);
		$this->db->from('tbl_setting');
		$query = $this->db->count_all_results();
		return $query;
	*/
 		$this->db->where('status_config',0);
		$this->db->from('tbl_setting');
		$query = $this->db->count_all_results();
		return $query;
	}
	
 	function setStatusConfig(){
		$data = array(
			'status_config' => '1'
		);
		$this->db->update('tbl_setting',$data);		

	}
	
}
?>