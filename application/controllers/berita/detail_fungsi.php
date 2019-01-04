<?php

class Detail_fungsi extends CI_Controller {

    function id() {
        $this->load->model('berita/beritamodel', 'berita', TRUE);
        $fungsi_kd = $this->session->userdata('SESSION_FUNGSI_KD');
        $user_kd = $this->session->userdata('SESSION_ID');
        $username = $this->session->userdata('SESSION_USERNAME');
        $data['fungsi_mendispo'] = $this->berita->fungsi_mendispo();
        $data['fungsi'] = $this->berita->pelaku_fungsi();
        $data['instruksi'] = $this->berita->isi_instruksi();
        $data['berita'] = $this->berita->detail_berita($this->uri->segment(4));
        $data['instruksi_disposisi'] = $this->berita->disposisi_instruksi($this->uri->segment(4));
        $data['fungsi_disposisi'] = $this->berita->disposisi_fungsi($this->uri->segment(4));
        $data['disposisi'] = $this->berita->get_disposisi($this->uri->segment(4));
        $data['disposed_fungsi'] = $this->berita->get_undisposisi_fungsi($this->uri->segment(4));
        $data['disposed_instruksi'] = $this->berita->get_undisposisi_instruksi($this->uri->segment(4));
        $data['diskusi'] = $this->berita->get_korespondensi($this->uri->segment(4));

        $data['pengerjaan'] = $this->berita->get_pengerjaan($this->uri->segment(4));

        $data['disposisi_lanjutan_kd'] = $this->berita->get_disposisi_lanjutan_fungsi($this->uri->segment(4), $user_kd);
        //print_r($data['disposisi_lanjutan_kd']); exit;
        $data['user_disposisi_lanjutan'] = $this->berita->get_user_disposed_lanjutan($this->uri->segment(4), $fungsi_kd);
        if (!empty($data['disposisi_lanjutan_kd'][0]['disposisi_lanjutan_kd'])) {
            $data['instruksi_disposed_lanjutan'] = $this->berita->get_instruksi_disposed_lanjutan($this->uri->segment(4), $data['disposisi_lanjutan_kd'][0]['disposisi_lanjutan_kd']);
            $data['detail_terima_lanjutan'] = $this->berita->get_detail_disposisi_fungsi_lanjutan($data['disposisi_lanjutan_kd'][0]['disposisi_lanjutan_kd'], $user_kd);
            //echo "asdasd"; exit;
        }
        //$data['instruksi_disposed_lanjutan'] = $this->berita->get_instruksi_disposed_lanjutan($this->uri->segment(4), $data['disposisi_lanjutan_kd'][0]['disposisi_lanjutan_kd']);
        //print_r($data['instruksi_disposed_lanjutan']); exit;
        $data['detail_disposisi_lanjutan'] = $this->berita->get_detail_disposed_lanjutan($data['disposisi_lanjutan_kd'][0]['disposisi_lanjutan_kd'], $this->session->userdata('SESSION_ID'));
        //print_r($data['detail_disposisi_lanjutan']); exit;
        $data['if_lanjutan'] = $this->berita->get_if_lanjutan($fungsi_kd);
        if ($data['if_lanjutan'] >= 1) {
            $data['pelaksana_lanjutan'] = $this->berita->get_pelaksana_lanjutan($fungsi_kd);
        }
        if (!empty($data['disposisi'][0]['disposisi_kd'])) {
            $data['detail_terima'] = $this->berita->get_detail_disposisi_fungsi_lanjutan($data['disposisi_lanjutan_kd'][0]['disposisi_lanjutan_kd'], $user_kd);
            //print_r($data['disposisi'][0]['disposisi_kd']); exit;
            $data['korespondensi'] = $this->berita->get_korespondensi_disposisi_fungsi($data['disposisi'][0]['disposisi_kd']);
        }

        session_start();
        $_SESSION['sifat']=$data['berita'][0]['sifat_kd'];
        
        if (!empty($_POST['TERIMA'])) {
            $this->berita->update_status_korenspondensi_lanjutan($data['disposisi_lanjutan_kd'][0]['disposisi_lanjutan_kd'], $this->session->userdata('SESSION_ID'));
            $this->session->set_flashdata('notice', 'Berhasil Menerima Penerusan Disposisi!');
            redirect('berita/detail_fungsi/id/' . $this->uri->segment(4));
        } elseif (!empty($_POST['POSTING_KORESPONDENSI'])) {
            $this->berita->insert_korespondensi($this->uri->segment(4));
            $notice = "Korespondensi Pengerjaan Disposisi Berhasil dikirim!";
            $this->session->set_flashdata('notice', $notice);
            redirect('berita/detail_fungsi/id/' . $this->uri->segment(4));
        } elseif (!empty($_POST['PENGERJAAN_DISPOSISI'])) {
            $detail_disposisi_kd = $this->berita->get_detail_disposisi_fungsi_lanjutan($data['disposisi'][0]['disposisi_kd'], $user_kd);
            $this->berita->update_pengerjaan_lanjutan($detail_disposisi_kd[0]['disposisi_lanjutan_detail_kd']);
            $this->berita->insert_korespondensi($this->uri->segment(4));
            $notice = "Status Pengerjaan Disposisi Berhasil diubah!";
            $this->session->set_flashdata('notice', $notice);
            redirect('berita/detail_fungsi/id/' . $this->uri->segment(4));
        } elseif (!empty($_POST['PENGERJAAN_DISPOSISI_LANJUTAN'])) {
            $detail_disposisi_kd = $this->berita->get_detail_disposisi_fungsi_lanjutan($data['disposisi'][0]['disposisi_kd'], $user_kd);
//            echo "<pre>";
//            echo $this->session->userdata('SESSION_FUNGSI_KD');
//print_r($data['disposisi']);
//echo "<pre>";
//            die();
            $fungsi_kd=$this->session->userdata('SESSION_FUNGSI_KD');
            $note_pengerjaan='Sudah dikerjakan oleh :'.$username;
            $this->berita->update_pengerjaan_lanjutan_all($data['disposisi_lanjutan_kd'][0]['disposisi_lanjutan_kd'],$note_pengerjaan);
            $this->berita->insert_korespondensi($this->uri->segment(4));
            //update pengerjaan parent
            $this->berita->update_pengerjaan_by_disposisi_kd_fungsi_kd($data['disposisi'][0]['disposisi_kd'],$note_pengerjaan,$fungsi_kd);
            
            $notice = "Status Pengerjaan Disposisi Berhasil diubah!";
            $this->session->set_flashdata('notice', $notice);
            redirect('berita/detail_fungsi/id/' . $this->uri->segment(4));
        } else {
            //skins chooser
            $skin_val = $this->config->item('skin');
            $data['skin_val'] = $skin_val;
            if ($skin_val != "") {
//                echo "<pre>";
//                print_r($data);
//                echo "</pre>";
//                die();
                $this->load->view('skins/' . $skin_val . '/berita/detail_fungsi', $data);
            } else {
                $this->load->view('berita/detail_fungsi', $data);
            }
        }
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */