<?php

class Detail extends CI_Controller {

    function id() {
        $this->load->model('perwakilan/perwakilanmodel', 'perwakilan', TRUE);
        $this->load->library('pagination');
        if (!empty($_POST['EDIT'])) {
            $note = "";
            //zzzzzzzzzzzzzzzzzzzzzzzzz
            if ($_POST['perwakilan_nama'] == "" || $_POST['perwakilan_nama'] == "0") {

                $this->session->set_flashdata('notifikasi', "<p>Terjadi Kesalahan: </p><ul><li><b>Nama Perwakilan</b> Harus diisi</li> </p>");
                $this->session->set_flashdata('status', 'form-message error');
                redirect('perwakilan/detail/id/' . $this->uri->segment(4));
            } else {

                $this->perwakilan->edit_perwakilan($this->uri->segment(4));
                $this->session->set_flashdata('notifikasi', '<p>Pesan Berhasil</p><ul><li><b>Perwakilan Telah berhasil diedit!</b> </li> </ul></p>');
                $this->session->set_flashdata('status', 'form-message correct');
                redirect('perwakilan/detail/id/' . $this->uri->segment(4));
            }
        }
        $data['perwakilan'] = $this->perwakilan->detail_perwakilan($this->uri->segment(4));
        
        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val'] = $skin_val;
        if ($skin_val != "") {
            $this->load->view('skins/' . $skin_val . '/perwakilan/detail', $data);
        } else {
            $this->load->view('perwakilan/detail', $data);
        }
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */