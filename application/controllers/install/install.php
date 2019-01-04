<?php
class Install extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('install/installmodel','install',TRUE);
	}
	
	function index()
	{
		$this->load->model('install/installmodel','install',TRUE);
		$data = $this->install->isSetted();
		if ($data!=0){
			$this->load->view('install/install');
		}else {
			$session_exist = $this->session->userdata('SESSION_ID');
			if(!empty($session_exist)){
				$this->load->view('install/install');
			}
			else {
					redirect('login');
			}
		}
	}

	function profil_kbri()
	{
		$data['setting']=$this->install->getSetting();
		$this->load->view('install/profil_kbri',$data);
	}

	function set_keppri_pk()
	{
		$data['fungsi']=$this->install->getFungsi();
		$this->load->view('install/set_keppri_pk',$data);
	}

	function form_pengguna(){
		$this->load->view('install/form_pengguna');
	}
	
	function set_keppri(){
		$data['keppri']=$this->install->getDetailPengguna(1);
		$this->load->view('install/set_keppri',$data);
	}

	function set_keppri_submit(){
		$this->install->setKeppri($_POST['user_namalengkap'],$_POST['user_nama'],$_POST['user_password'],$_POST['fungsi_kd']);
 	}
	
	function set_pk(){
		$data['pk']=$this->install->getDetailPengguna(2);
		$this->load->view('install/set_pk',$data);
	}

	function set_koord()
	{
		$data['pengguna']=$this->install->getKoordinator();
		$data['fungsi']=$this->install->getFungsi();
		$this->load->view('install/set_koord',$data);
	}

	function set_pk_submit(){
		$this->install->setPK($_POST['user_namalengkap'],$_POST['user_nama'],$_POST['user_password'],$_POST['fungsi_kd']);	
	}

	function set_pengguna()
	{
		$data['pengguna']=$this->install->getPengguna();
		$data['fungsi']=$this->install->getFungsi();
		$this->load->view('install/set_pengguna',$data);
	}
	
	function summary(){
		$data['setting'] = $this->install->getSetting();
		$this->load->view('install/summary',$data);
	}
 	
	function submit_set_keppri(){
		$this->install->setKeppriPK();
		$this->install->updatePK_Keppri();
		echo "true";
	}
	
	function submit()
	{
		if (!$this->install->insertSetting()){ echo "Melanjutkan langkah ke-2!"; } else { echo "false"; }	 
	}
	
	function addFungsi(){
		if ($this->install->redundantCheck($_POST['fungsi_nama'],'nama_fungsi','tbl_fungsi')>0){
			echo "false";
		}else{
			$this->install->addFungsi($_POST['fungsi_nama']);
		}
	}

	function addPengguna(){

		if ($this->install->redundantCheck($_POST['user_nama'],'user_nama','tbl_user')>=1){
			echo "redundant_true";
		}elseif($_POST['koord']=='Y'){
			if ($this->install->redundantCheckForKoord($_POST['fungsi_kd'])>=1) {
				echo "redundant_koord";
			}else {
			$this->install->addPengguna($_POST['user_namalengkap'],$_POST['user_nama'],$_POST['user_password'],$_POST['fungsi_kd'],$_POST['user_email'],$_POST['user_notifikasi_email'],$_POST['koord']);
			}		
		}else{ 
			$this->install->addPengguna($_POST['user_namalengkap'],$_POST['user_nama'],$_POST['user_password'],$_POST['fungsi_kd'],$_POST['user_email'],$_POST['user_notifikasi_email'],$_POST['koord']);
		}
	}

	function delFungsi(){
		$this->install->delFungsi($_POST['kd']);
	}
	
	function delUser(){
		$this->install->delUser($_POST['kd']);
	}
	
	function refreshFungsi(){
		$data['fungsi'] = $this->install->refreshFungsi();
		
	 	$i=0; $k=0;
        echo '<table cellpadding="0" cellspacing="0" border="0">';
        
	 	foreach($data['fungsi'] as $val){ $i++; $k++;
        	echo "<td id='id".$val['fungsi_kd']."' style='padding:3px; border:0px; text-align:left; '>&raquo; ".$val['nama_fungsi']."</td>";
           	echo "<td style='padding-left:-13px; border:0px; text-align:left; '><a onClick='delFungsi(".$val['fungsi_kd'].")' style='cursor:pointer;'><img src='".base_url()."resources/images/icon_bad.png'></a></td>";                                       
           	if($i % 2==0){ $i=0;
           		echo "</tr><tr>";
        	}
     	}
     	echo "</table>";
		//echo "{rows:".json_encode($data['jenis'])."}";
	}
	
	function userGrid(){
		$data['user'] = $this->install->getPengguna();
		 	$i=0; 
            echo "<table width='100%' cellpadding='0px' ><tr><th>No.<th style='text-align:left;'>Username</th><th style='text-align:left;'>Nama Lengkap</th><th style='text-align:left;'>Jabatan</th><th style='text-align:left;'>Koord. Fungsi</th><th>Opsi</th></tr>";
	 	    foreach ($data['user'] as $val){ $i++;
	        	echo "<tr>";
	        	echo "<td>".$i."</td>";
	        	echo "<td style='text-align:left;'>".$val['user_nama']."</td>";
	        	echo "<td style='text-align:left;'>".$val['user_namalengkap']."</td>"; 
	        	echo "<td style='text-align:left;'>".$val['nama_fungsi']."</td>";
	        	echo "<td style='text-align:left;'>".$val['koordinator_fungsi']."</td>";
        		echo "<td ><a style='cursor:pointer;' onClick='delPengguna(".$val['user_kd'].");'><img src='".base_url()."resources/images/icon_bad.png'></a></td>";
        		echo "</tr>";
	 	    }
     	echo "</table>";
	}
	
	function finish(){
		$this->install->setStatusConfig();	
	}

	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */