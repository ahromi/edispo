<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cetak extends CI_Controller {

    public function id() {
        $this->load->model('berita/beritamodel', 'berita', TRUE);
        $this->load->model('install/installmodel', 'setting', TRUE);
        $ignore=array(37);
        $data['fungsi'] = $this->berita->pelaku_fungsi($ignore);
        $data['instruksi'] = $this->berita->isi_instruksi();
        $data['berita'] = $this->berita->detail_berita($this->uri->segment(4));
        $data['instruksi_disposisi'] = $this->berita->disposisi_instruksi($this->uri->segment(4));
        $data['fungsi_disposisi'] = $this->berita->disposisi_fungsi($this->uri->segment(4));
        $data['disposisi'] = $this->berita->get_disposisi($this->uri->segment(4));
        $data['disposed_fungsi'] = $this->berita->get_undisposisi_fungsi($this->uri->segment(4));
        $data['disposed_instruksi'] = $this->berita->get_undisposisi_instruksi($this->uri->segment(4));
        $data['pwk'] = $this->setting->getSetting();
        if (!empty($data['disposisi'][0]['disposisi_kd'])) {
            //$data['detail_terima'] = $this->berita->get_detail_disposisi_fungsi($data['disposisi'][0]['disposisi_kd'],$fungsi_kd);
            $data['korespondensi'] = $this->berita->get_korespondensi_disposisi_fungsi($data['disposisi'][0]['disposisi_kd']);
        }
        
//        echo '<pre>';
//        print_r($data['instruksi_disposisi']);
//        echo '</pre>';
        
        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val'] = $skin_val;
        if ($skin_val != "") {
            $this->load->view('skins/' . $skin_val . '/berita/print', $data);
        } else {
            $this->load->view('berita/print', $data);
        }

        
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */