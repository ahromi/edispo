<?php
class View extends CI_Controller {

	function id()
	{		
			$this->load->model('berita/beritamodel','berita',TRUE);
  			$data['berita'] = $this->berita->detail_berita($this->uri->segment(4));
			$this->load->view('berita/view',$data);
	}
 }

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */