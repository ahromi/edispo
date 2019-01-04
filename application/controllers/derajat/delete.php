<?php
class Delete extends CI_Controller {

 	
	function id()
	{
			$this->load->model('derajat/derajatmodel','derajat',TRUE);
			$this->load->library('pagination');
			$id=$this->uri->segment(4);
			if (empty($id)){
					$this->session->set_flashdata('notifikasi','<p>Terjadi Kesalahan:</p><ul><li><b>Data yang akan dihapus tidak ditemukan!</b></li></ul></p>');
 					redirect('derajat/derajat');
				}
				else{
				
					$this->derajat->delete_derajat($this->uri->segment(4));
					$this->session->set_flashdata('notifikasi2','<b>Derajat Berhasil dihapus!</b>');
 					redirect('derajat/derajat');
			}
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */