<?php

class Edit_berita_keluar extends CI_Controller {

    function id() {
        $this->load->model('berita/beritakeluarmodel', 'beritakeluar', TRUE);
        $this->load->model('detailberita/detailberitamodel','detailberita',TRUE);
        if (!empty($_POST['EDIT'])) {
            $note = "";
            if (empty($_POST['berita_kd']) || empty($_POST['tgl_berita']) || empty($_POST['perihal_berita'])) {
                if (empty($_POST['berita_kd']) && empty($_POST['tgl_berita']) && empty($_POST['perihal_berita'])) {
                    $this->session->set_flashdata('notifikasi', '<p>Terjadi Beberapa Kesalahan:</p><ul><li><b>No Berita </b> Harus diisi</li> <li><b>Tanggal berita</b>  Harus diisi</li><li><b>Perihal berita</b>  Harus diisi</li></p>');
                    $this->session->set_flashdata('status', 'form-message error');
                } else {
                    if (empty($_POST['berita_kd'])) {
                        $note = $note . '<li><b>No Berita </b>  Harus diisi</li> ';
                    }
                    if (empty($_POST['tgl_berita'])) {
                        $note = $note . '<li><b>Tanggal berita </b>  Harus diisi</li>  ';
                    }
                    if (empty($_POST['perihal_berita'])) {
                        $note = $note . '<li><b>Perihal berita </b>  Harus diisi</li>  ';
                    }
                    $this->session->set_flashdata('berita_kd', $_POST['berita_kd']);
                    $this->session->set_flashdata('perihal_berita', $_POST['perihal_berita']);
                    $this->session->set_flashdata('tgl_berita', $_POST['tgl_berita']);

                    $this->session->set_flashdata('notifikasi', '<p>Terjadi Kesalahan:</p><ul>' . $note . '</ul></p>');
                }
                redirect('berita/edit_berita/edit/' . $this->uri->segment(4));
            } else {
                $kd_berita = str_replace(' ', '_', $_POST['berita_kd']);
                $kd_berita = str_replace('/', '-', $kd_berita);
                if (!empty($_FILES['userfile']['name'])) {
                    $config['upload_path'] = './files/';
                    //$config['allowed_types'] = '*';
                    $config['allowed_types'] = 'pdf';
                    $config['overwrite'] = 'FALSE';
                    $config['file_name'] = $this->uri->segment(4) . "_" . $kd_berita;
                    $this->load->library('upload', $config);


                    if (!$this->upload->do_upload()) {
                        $this->session->set_flashdata('notifikasi', '<p>Terjadi Kesalahan:</p><ul>Upload File Gagal, check kembali nama, ukuran dan tipe file.</ul></p>');
                        $this->session->set_flashdata('status', 'form-message error');
                        redirect('berita/edit_berita_keluar/id/' . $this->uri->segment(4));
                    }
                    $this->beritakeluar->update_file($this->uri->segment(4) . "_" . $kd_berita . ".pdf");
                }

                $this->beritakeluar->edit_berita($this->uri->segment(4));
                
                $this->session->set_flashdata('notifikasi', '<strong>Pesan Berhasil</strong> berita Telah berhasil diedit.');
                $this->session->set_flashdata('status', 'form-message correct');
                redirect('berita/edit_berita_keluar/id/' . $this->uri->segment(4));
            }
        }
        $data['berita'] = $this->beritakeluar->detail_berita($this->uri->segment(4));
        $data['detailberita']=  $this->detailberita->detail_berita($this->uri->segment(4));
        
        session_start();
        $_SESSION['sifat']=$data['berita'][0]['sifat_kd'];
        
        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val'] = $skin_val;
        if ($skin_val != "") {
            $this->load->view('skins/' . $skin_val . '/berita/edit_berita_keluar', $data);
        } else {
            $this->load->view('berita/edit_berita', $data);
        }
        
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
