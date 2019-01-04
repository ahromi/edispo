<?php

class Paswd extends CI_Controller {

    function index() {
        $this->load->model('pengguna/penggunamodel', 'pengguna', TRUE);
        if (!empty($_POST['SUBMIT'])) {
            if (empty($_POST['paswd_baru']) || empty($_POST['paswd_lama']) || empty($_POST['paswd_baru_ulang'])) {
                $this->session->set_flashdata('note', "Isi Form pengubahan password dengan benar! Silahkan Ulangi!!");
                redirect('pengguna/paswd/index');
            } else {
                if ($_POST['paswd_baru'] != $_POST['paswd_baru_ulang']) {
                    $this->session->set_flashdata('note', "Password baru tidak sama! Proses Gagal!");
                    redirect('pengguna/paswd/index');
                } else {
                    $data['jml'] = $this->pengguna->cek_paswd_lama($this->session->userdata('SESSION_ID'), md5($_POST['paswd_lama']));
                    if ($data['jml'][0]['jml'] != 0) {
                        $this->pengguna->ubah_paswd($this->session->userdata('SESSION_ID'), md5($_POST['paswd_baru']));
                        $this->session->set_flashdata('note', "Penggantian Password Berhasil. Silahkan Logout Untuk mencoba password baru anda!");
                        redirect('pengguna/paswd/index');
                    } else {
                        $this->session->set_flashdata('note', "Password lama anda tidak dikenali/salah!");
                        redirect('pengguna/paswd/index');
                    }
                }
            }
        } else {
            //skins chooser
            $skin_val = $this->config->item('skin');
            if ($skin_val != "") {
                $this->load->view('skins/' . $skin_val . '/pengguna/paswd');
            } else {
                $this->load->view('pengguna/paswd');
            }
        }
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */