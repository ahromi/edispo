<?php
class Delete extends CI_Controller {

 	
	function id()
	{
			$this->load->model('perwakilan/perwakilanmodel','perwakilan',TRUE);
			$this->load->library('pagination');
			$id=$this->uri->segment(4);
			if (empty($id)){
					$this->session->set_flashdata('notifikasi','<p>Terjadi Kesalahan:</p><ul><li><b>Data yang akan dihapus tidak ditemukan!</b></li></ul></p>');
 					redirect('perwakilan/perwakilan');
				}
				else{
				
					$this->perwakilan->delete_perwakilan($this->uri->segment(4));
					$this->session->set_flashdata('notifikasi2','<b>Perwakilan Berhasil dihapus!</b>');
 					redirect('perwakilan/perwakilan');
			}
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */