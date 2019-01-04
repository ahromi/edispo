<?php
class Status extends CI_Controller {

 	
	function id()
	{
			$this->load->model('instruksi/instruksimodel','instruksi',TRUE);
			$this->load->library('pagination');
			$id=$this->uri->segment(4);
			if (empty($id)){
					$this->session->set_flashdata('notifikasi','<p>Terjadi Kesalahan:</p><ul><li><b>Data yang akan diubah tidak ditemukan!</b></li></ul></p>');
 					redirect('instruksi/instruksi');
				}
				else{
				
					$this->instruksi->status_instruksi($this->uri->segment(4));
					$this->session->set_flashdata('notifikasi2','<b>Status Instruksi Berhasil diubah!</b>');
 					redirect('instruksi/instruksi');
			}
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */