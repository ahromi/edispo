<?php

class Detail extends CI_Controller {

    function id() {
        $this->load->model('instruksi/instruksimodel', 'instruksi', TRUE);
        $this->load->library('pagination');
        if (!empty($_POST['EDIT'])) {
            $note = "";
            //zzzzzzzzzzzzzzzzzzzzzzzzz
            if ($_POST['instruksi_nama'] == "" || $_POST['instruksi_nama'] == "0") {

                $this->session->set_flashdata('notifikasi', "<p>Terjadi Kesalahan: </p><ul><li><b>Instruksi</b> Harus diisi</li> </p>");
                $this->session->set_flashdata('status', 'form-message error');
                redirect('instruksi/detail/id/' . $this->uri->segment(4));
            } else {

                $this->instruksi->edit_instruksi($this->uri->segment(4));
                $this->session->set_flashdata('notifikasi', '<p>Pesan Berhasil</p><ul><li><b>Instruksi Telah berhasil diedit!</b> </li> </ul></p>');
                $this->session->set_flashdata('status', 'form-message correct');
                redirect('instruksi/detail/id/' . $this->uri->segment(4));
            }
        }
        $data['instruksi'] = $this->instruksi->detail_instruksi($this->uri->segment(4));
        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val']=$skin_val;
        if ($skin_val != "") {
            $this->load->view('skins/' . $skin_val . '/instruksi/detail',$data);
        } else {
            $this->load->view('instruksi/detail', $data);
        }

        
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */