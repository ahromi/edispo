<?php

class Detail extends CI_Controller {

    function id() {
        $this->load->model('jenisberita/jenisberitamodel', 'jenisberita', TRUE);
        $this->load->library('pagination');
        if (!empty($_POST['EDIT'])) {
            $note = "";
            //zzzzzzzzzzzzzzzzzzzzzzzzz
            if ($_POST['jenis_nama'] == "" || $_POST['jenis_nama'] == "0") {

                $this->session->set_flashdata('notifikasi', "<p>Terjadi Kesalahan: </p><ul><li><b>Jenis Berita</b> Harus diisi</li> </p>");
                $this->session->set_flashdata('status', 'form-message error');
                redirect('jenisberita/detail/id/' . $this->uri->segment(4));
            } else {

                $this->jenisberita->edit_jenisberita($this->uri->segment(4));
                $this->session->set_flashdata('notifikasi', '<p>Pesan Berhasil</p><ul><li><b>Jenis Berita Telah berhasil diedit!</b> </li> </ul></p>');
                $this->session->set_flashdata('status', 'form-message correct');
                redirect('jenisberita/detail/id/' . $this->uri->segment(4));
            }
        }
        $data['jenisberita'] = $this->jenisberita->detail_jenisberita($this->uri->segment(4));
        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val'] = $skin_val;
        if ($skin_val != "") {
            $this->load->view('skins/' . $skin_val . '/jenisberita/detail', $data);
        } else {
            $this->load->view('jenisberita/detail', $data);
        }
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */