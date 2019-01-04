<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index()
	{
		$this->load->model('install/installmodel','install',TRUE);
		$data = $this->install->isSetted();
		if ($data!=0){
			redirect('install/install');
		}
		else{
			$val['setting'] = $this->install->getSetting();
			//echo $val['setting'][0]['nama_perwakilan'];
			 
		  	$this->session->set_userdata('nama_perwakilan', $val['setting'][0]['nama_perwakilan']);	
		  	$this->session->set_userdata('nama_singkat_perwakilan', $val['setting'][0]['nama_singkat_perwakilan']);	
	  	  	$this->session->set_userdata('nama_jabatan_kepala_perwakilan', $val['setting'][0]['nama_jabatan_kepala_perwakilan']);	
		  	$this->session->set_userdata('warna_latar', $val['setting'][0]['warna_latar']);	
			redirect('login');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */