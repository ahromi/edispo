<?php

class Detail extends CI_Controller {

    function id() {
        $this->load->model('pengguna/penggunamodel', 'pengguna', TRUE);
        $this->load->library('pagination');
        if (!empty($_POST['EDIT'])) {
            $note = "";
            if (empty($_POST['user_nama']) || empty($_POST['user_namalengkap']) || $_POST['fungsi_kd'] == "") {
                if (empty($_POST['user_username']) && empty($_POST['user_namalengkap']) && $_POST['fungsi_kd'] == "0") {
                    $this->session->set_flashdata('notifikasi', '<p>Terjadi Beberapa Kesalahan:</p><ul><li><b>Username </b> Harus diisi</li> <li><b>Fungsi Pengguna </b> Harus diisi</li> <li><b>Nama Pengguna</b>  Harus diisi</li></p>');
                    $this->session->set_flashdata('status', 'form-message error');
                } else {
                    if (empty($_POST['user_nama'])) {
                        $note = $note . '<li><b>Username </b>  Harus diisi</li> ';
                    }
                    if (empty($_POST['user_namalengkap'])) {
                        $note = $note . '<li><b>Nama Pengguna </b>  Harus diisi</li>  ';
                    }
                    $this->session->set_flashdata('user_nama', $_POST['user_nama']);
                    $this->session->set_flashdata('user_namalengkap', $_POST['user_namalengkap']);

                    $this->session->set_flashdata('notifikasi', '<p>Terjadi Kesalahan:</p><ul>' . $note . '</ul></p>');
                }
                redirect('pengguna/detail/id/' . $this->uri->segment(4));
            } else {
                if (!empty($_FILES['userfile']['name'])) {
                    $config['upload_path'] = './uploads/';
                    $config['allowed_types'] = '*';
                    $config['max_size'] = '1000';
                    $config['max_width'] = '3000';
                    $config['max_height'] = '4000';

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload()) {
                        $this->session->set_flashdata('notifikasi', '<p>Terjadi Kesalahan:</p><ul>Upload Foto Gagal, Pastikan ukuran maksimal 300 x 400px dan tidak lebih dari 100KB.</ul></p>');
                        $this->session->set_flashdata('status', 'form-message error');
                        redirect('pengguna/detail/id/' . $this->uri->segment(4));
                    } else {
                        $this->pengguna->change_foto();
                    }
                }

                if (!empty($_POST['user_password'])) {
                    $this->pengguna->change_password();
                }

                $this->pengguna->edit_pengguna($this->uri->segment(4));
                $this->session->set_flashdata('notifikasi', '<p>Pesan Berhasil</p><ul><li><b>Pengguna Telah berhasil diedit!</b> </li> </ul></p>');
                $this->session->set_flashdata('status', 'form-message correct');
                redirect('pengguna/detail/id/' . $this->uri->segment(4));
            }
        }
        $data['fungsi'] = $this->pengguna->cmb_fungsi();
        $data['pengguna'] = $this->pengguna->detail_pengguna($this->uri->segment(4));
        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val'] = $skin_val;
        if ($skin_val != "") {
            $this->load->view('skins/' . $skin_val . '/pengguna/detail', $data);
        } else {
            $this->load->view('pengguna/detail', $data);
        }
        
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */