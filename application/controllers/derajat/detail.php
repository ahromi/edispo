<?php

class Detail extends CI_Controller {

    function id() {
        $this->load->model('derajat/derajatmodel', 'derajat', TRUE);
        $this->load->library('pagination');
        if (!empty($_POST['EDIT'])) {
            $note = "";
            //zzzzzzzzzzzzzzzzzzzzzzzzz
            if ($_POST['derajat_kd'] == "000") {
                //kd_derajat yg boleh 000=biasa
                if ($_POST['derajat_nama'] == "" || $_POST['derajat_nama'] == "0") {

                    $this->session->set_flashdata('notifikasi', "<p>Terjadi Kesalahan: </p><ul><li><b>Nama Derajat</b> Harus diisi</li> </p>");
                    $this->session->set_flashdata('status', 'form-message error');
                    redirect('derajat/detail/id/' . $this->uri->segment(4));
                }
            } else {
                if ($_POST['derajat_kd'] == "" || $_POST['derajat_kd'] == "0") {

                    $this->session->set_flashdata('notifikasi', "<p>Terjadi Kesalahan: </p><ul><li><b>Kode Derajat</b> Harus diisi</li> </p>");
                    $this->session->set_flashdata('status', 'form-message error');
                    redirect('derajat/detail/id/' . $this->uri->segment(4));
                } elseif ($_POST['derajat_nama'] == "" || $_POST['derajat_nama'] == "0") {

                    $this->session->set_flashdata('notifikasi', "<p>Terjadi Kesalahan: </p><ul><li><b>Nama Derajat</b> Harus diisi</li> </p>");
                    $this->session->set_flashdata('status', 'form-message error');
                    redirect('derajat/detail/id/' . $this->uri->segment(4));
                }
            }


            //jk lolos jebakan, mk valid untuk disimpan ke db	
            $this->derajat->edit_derajat($this->uri->segment(4));
            $this->session->set_flashdata('notifikasi', '<p>Pesan Berhasil</p><ul><li><b>Derajat Telah berhasil diedit!</b> </li> </ul></p>');
            $this->session->set_flashdata('status', 'form-message correct');
            //redirect('derajat/detail/id/'.$this->uri->segment(4));

            redirect('derajat/detail/id/' . $_POST['derajat_kd']);
        }
        $data['derajat'] = $this->derajat->detail_derajat($this->uri->segment(4));
        
        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val'] = $skin_val;
        if ($skin_val != "") {
            $this->load->view('skins/' . $skin_val . '/derajat/detail', $data);
        } else {
            $this->load->view('derajat/detail', $data);
        }
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */