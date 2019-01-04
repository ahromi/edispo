<?php

class Delete extends CI_Controller {

    function id() {
        $this->load->model('fungsi/fungsimodel', 'fungsi', TRUE);
        $this->load->library('pagination');
        $id = $this->uri->segment(4);
        if (empty($id)) {
            $this->session->set_flashdata('notifikasi', '<p>Terjadi Kesalahan:</p><ul><li><b>Data yang akan dihapus tidak ditemukan!</b></li></ul></p>');
            redirect('fungsi/fungsi');
        } else {

            $this->fungsi->delete_fungsi($this->uri->segment(4));
            $this->session->set_flashdata('notifikasi2', '<b>Jenis Berita Berhasil dihapus!</b>');
            redirect('fungsi/fungsi');
        }
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */