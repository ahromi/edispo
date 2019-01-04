<?php

class View_berita_keluar extends CI_Controller {

    function id() {
        $this->load->model('berita/beritakeluarmodel', 'beritakeluar', TRUE);
        $this->load->model('detailberita/detailberitamodel','detailberita',TRUE);
        $data['berita'] = $this->beritakeluar->detail_berita($this->uri->segment(4));
        $data['detailberita']=  $this->detailberita->detail_berita($this->uri->segment(4));
        session_start();
        $_SESSION['sifat']=$data['berita'][0]['sifat_kd'];
        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val'] = $skin_val;
        if ($skin_val != "") {
            $this->load->view('skins/' . $skin_val . '/berita/view_berita_keluar', $data);
        } else {
            $this->load->view('berita/edit_berita', $data);
        }
        
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
