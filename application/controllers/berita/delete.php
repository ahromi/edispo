<?php
class Delete extends CI_Controller {

 	
	function id()
	{
			$this->load->model('pengguna/penggunamodel','pengguna',TRUE);
			$this->load->library('pagination');
			$id=$this->uri->segment(4);
			if (empty($id)){
					$this->session->set_flashdata('notifikasi','<p>Terjadi Kesalahan:</p><ul><li><b>Data yang akan dihapus tidak ditemukan!</b></li></ul></p>');
 					redirect('pengguna/pengguna');
				}
				else{
				
					$this->pengguna->delete_pengguna($this->uri->segment(4));
					$this->session->set_flashdata('notifikasi2','<b>Pengguna Berhasil dihapus!</b>');
 					redirect('pengguna/pengguna');
			}
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */