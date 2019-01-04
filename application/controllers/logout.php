<?php

class Logout extends CI_Controller {

    function index() {
        $this->session->unset_userdata('SESSION_FUNGSI');
        $this->session->unset_userdata('SESSION_USERNAME');
        $this->session->unset_userdata('SESSION_NAMALENGKAP');
        $this->session->unset_userdata('SESSION_ID');
        $this->session->unset_userdata('SESSION_FOTO');

        unset($_SESSION);

        $this->session->set_flashdata('notifikasi1', '<li><blink>Anda telah berhasil logout!!</blink></li>');
        redirect('');
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */