<?php

class Detail extends CI_Controller {

    function id() {
        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val'] = $skin_val;
//        echo "<pre>";
//print_r($this->session->userdata);
//echo "</pre>";
        $this->load->model('berita/beritamodel', 'berita', TRUE);
        $fungsi_kd = $this->session->userdata('SESSION_FUNGSI_KD');
        $user_kd = $this->session->userdata('SESSION_ID');
        $arsip_kd=$this->uri->segment(4);
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
//        echo $arsip_kd;
//        exit;
        $data['disposisi_lanjutan_kd'] = $this->berita->get_disposisi_lanjutan_by_fungsi_kd($this->uri->segment(4), $fungsi_kd);
        //print_r($data['disposisi_lanjutan_kd']); exit;
        $data['user_disposisi_lanjutan'] = $this->berita->get_user_disposed_lanjutan($this->uri->segment(4), $fungsi_kd);
        if (!empty($data['disposisi_lanjutan_kd'][0]['disposisi_lanjutan_kd'])) {
            $data['instruksi_disposed_lanjutan'] = $this->berita->get_instruksi_disposed_lanjutan($this->uri->segment(4), $data['disposisi_lanjutan_kd'][0]['disposisi_lanjutan_kd']);
            //$data['detail_terima_lanjutan'] = $this->berita->get_detail_disposisi_fungsi_lanjutan($data['disposisi_lanjutan_kd'][0]['disposisi_lanjutan_kd'],$user_kd);
            //echo "asdasd"; exit;
        }
        
//        echo "test:";print_r($data['disposisi_lanjutan_kd']);die();

        session_start();
        $_SESSION['sifat']=$data['berita'][0]['sifat_kd'];
        
        $data['if_lanjutan'] = $this->berita->get_if_lanjutan($fungsi_kd);
        if ($data['if_lanjutan'] >= 1) {
            $data['pelaksana_lanjutan'] = $this->berita->get_pelaksana_lanjutan($fungsi_kd);
        }

        if (!empty($data['disposisi'][0]['disposisi_kd'])) {
            $data['detail_terima'] = $this->berita->get_detail_disposisi_fungsi($data['disposisi'][0]['disposisi_kd'], $fungsi_kd);
            $data['korespondensi'] = $this->berita->get_korespondensi_disposisi_fungsi($data['disposisi'][0]['disposisi_kd']);
        }

        if (!empty($_POST['upload'])) {
            $this->upload();
            redirect('berita/detail/id/' . $this->uri->segment(4), 'refresh');
        }

        if (!empty($_POST['DISPOSISI'])) {
//            print_r($_POST);die();
            
            if(!isset($_POST['instruksi_kd'])){
                $this->session->set_flashdata('notice', 'Anda belum menentukan Pemegang Fungsi dan Isi Instruksi!');
                redirect('berita/detail/id/' . $this->uri->segment(4));
            }else{
                if(!isset($_POST['detail_perhatian'])){
                    $detail_perhatian=array();
                }else{
                    $detail_perhatian = $_POST['detail_perhatian'];
                }
                if(!isset($_POST['instruksi_perhatian'])){
                    $instruksi_perhatian=array();
                }else{
                    $instruksi_perhatian = $_POST['instruksi_perhatian'];
                }
            }
            $fungsi_kd = $_POST['fungsi_kd'];
            $instruksi_kd = $_POST['instruksi_kd'];
            
            //insert tbl_disposisi
            $this->berita->insert_disposisi_fungsi();
            //select last inputed disposisi
            $row = $this->berita->get_last_disposisi();
            //insert disposisi detail
            $this->berita->insert_detail_disposisi($row[0]['disposisi_kd'], $fungsi_kd, $this->uri->segment(4), $data['berita'][0]['jenis_nama'], $data['berita'][0]['derajat_nama'], $data['berita'][0]['perwakilan_nama'], $data['berita'][0]['perihal_berita'], $row[0]['catatan'], $detail_perhatian);
            $this->berita->insert_disposisi_instruksi($this->uri->segment(4), $instruksi_kd, $instruksi_perhatian);
            $this->berita->update_status_disposisi_berita($this->uri->segment(4));
            $this->session->set_flashdata('notice', 'Anda Telah berhasil Melakukan Disposisi!');
            redirect('berita/detail/id/' . $this->uri->segment(4));
        } elseif (!empty($_POST['TAMBAH_FUNGSI'])) {
            $fungsi_kd = $_POST['fungsi_kd'];
            $detail_perhatian = $_POST['detail_perhatian'];
            $row = $this->berita->get_disposisi_by_id($data['disposisi'][0]['disposisi_kd']);
            //insert tbl_disposisi
            $this->berita->insert_detail_disposisi($data['disposisi'][0]['disposisi_kd'], $fungsi_kd, $this->uri->segment(4), $data['berita'][0]['jenis_nama'], $data['berita'][0]['derajat_nama'], $data['berita'][0]['perwakilan_nama'], $data['berita'][0]['perihal_berita'], $row[0]['catatan'], $detail_perhatian);
            $this->session->set_flashdata('notice', 'Penambahan Disposisi Kepada Fungsi Telah Berhasil!');
            redirect('berita/detail/id/' . $this->uri->segment(4));
        } elseif (!empty($_POST['TAMBAH_INSTRUKSI'])) {
            $instruksi_kd = $_POST['instruksi_kd'];
            $instruksi_perhatian = $_POST['instruksi_perhatian'];
            //insert tbl_disposisi
            $this->berita->insert_disposisi_instruksi($this->uri->segment(4), $instruksi_kd, $instruksi_perhatian);
            $this->session->set_flashdata('notice', 'Penambahan Instruksi Disposisi Telah Berhasil!');
            redirect('berita/detail/id/' . $this->uri->segment(4));
        } elseif (!empty($_POST['BATAL_DISPOSISI'])) {
            //dapatkan kode disposisi dan lakukan delete detail disposisi 
            $this->berita->del_detail_disposisi($data['disposisi'][0]['disposisi_kd']);
            //delete disposisinya
            $this->berita->del_disposisi($data['disposisi'][0]['disposisi_kd']);
            //delete instruksi disposisinya
            $this->berita->del_disposisi_instruksi($this->uri->segment(4));
            //update status berita
            $this->berita->update_status_batal_disposisi($this->uri->segment(4));

            $this->session->set_flashdata('notice', 'Pembatalan Disposisi Telah Berhasil!');
            redirect('berita/detail/id/' . $this->uri->segment(4));
        } elseif (!empty($_POST['TERIMA_DISPOSISI'])) {
//            print_r($_POST);die();
            $user_kd = $_POST['user_kd'];
            $instruksi_kd = $_POST['instruksi_kd'];
            $detail_disposisi_kd = $this->berita->get_detail_disposisi_fungsi($data['disposisi'][0]['disposisi_kd'], $fungsi_kd);
            $this->berita->update_terima_disposisi($detail_disposisi_kd[0]['disposisi_detail_kd']);
            if ($_POST['lanjutDispo'] == 'YA') {
                $this->berita->do_disposisi_lanjutan();
                $disposisi_lanjutan_kd = $this->berita->get_last_disposisi_lanjutan();
                $this->berita->insert_disposisi_lanjutan_fungsi($disposisi_lanjutan_kd[0]['disposisi_lanjutan_kd'], $user_kd, $data['berita'][0]['arsip_kd'], $data['berita'][0]['perwakilan_nama'], $data['berita'][0]['perihal_berita'], $_POST['disposisi_lanjutan_catatan'], $data['berita'][0]['derajat_nama']);
                $this->berita->insert_disposisi_lanjutan_instruksi($disposisi_lanjutan_kd[0]['disposisi_lanjutan_kd'], $instruksi_kd);
                $notice = "Penerimaan Disposisi dan Penerusan Disposisi kepada Pelaksana Fungsi Berhasil!";
            } else {
                $notice = "Penerimaan Disposisi Berhasil!";
            }
            //insert komentar
            if($_POST ['korespondensi_komentar']!="" || $_POST['korespondensi'] !=""){
                //insert komentar
                $this->berita->insert_korespondensi($this->uri->segment(4));
            }else{
                $this->berita->insert_korespondensi_lanjutan($this->uri->segment(4));
            }

            $this->session->set_flashdata('notice', $notice);
            redirect('berita/detail/id/' . $this->uri->segment(4));
        } elseif (!empty($_POST['POSTING_KORESPONDENSI'])) {
            $this->berita->insert_korespondensi($this->uri->segment(4));
            $notice = "Korespondensi Pengerjaan Disposisi Berhasil dikirim!";

            $this->session->set_flashdata('notice', $notice);
            redirect('berita/detail/id/' . $this->uri->segment(4));
        } elseif (!empty($_POST['PENGERJAAN_DISPOSISI'])) {
            $detail_disposisi_kd = $this->berita->get_detail_disposisi_fungsi($data['disposisi'][0]['disposisi_kd'], $fungsi_kd);
            $this->berita->update_pengerjaan($detail_disposisi_kd[0]['disposisi_detail_kd']);
            
            //otomatis mengupdate disposisi lanjutan di bawahnya jika ada
            $arsip_kd=$this->uri->segment(4);
            $disposisi_lanjutan_kd=  $this->berita->get_disposisi_lanjutan_by_arsip_kd($arsip_kd);
            foreach($disposisi_lanjutan_kd as $row){
                $this->berita->update_pengerjaan_lanjutan_by_disposisi_lanjutan_kd($row['disposisi_lanjutan_kd']);
            }
            
            //insert komentar
            if($_POST ['korespondensi_komentar']!="" || $_POST['korespondensi'] !=""){
                //insert komentar
                $this->berita->insert_korespondensi($this->uri->segment(4));
            }else{
                $this->berita->insert_korespondensi_lanjutan($this->uri->segment(4));
            }
            
            $notice = "Status Pengerjaan Disposisi Berhasil diubah!";
            $this->session->set_flashdata('notice', $notice);
            redirect('berita/detail/id/' . $this->uri->segment(4));
        } else {
            if ($skin_val != "") {
                $this->load->view('skins/' . $skin_val . '/berita/detail', $data);
            } else {
                $this->load->view('berita/detail', $data);
            }
        }
    }

    function delfungsi() {
        $this->load->model('berita/beritamodel', 'berita', TRUE);
        $this->berita->delete_detail_disposisi_fungsi($this->uri->segment(5));
        $this->session->set_flashdata('notice', 'Anda Telah berhasil Menghapus Disposisi Pelaksana Fungsi !');
        redirect('berita/detail/id/' . $this->uri->segment(4));
    }

    function delins() {
        $this->load->model('berita/beritamodel', 'berita', TRUE);
        $this->berita->delete_disposisi_instruksi($this->uri->segment(5));
        $this->session->set_flashdata('notice', 'Anda Telah berhasil Menghapus Disposisi Instruksi !');
        redirect('berita/detail/id/' . $this->uri->segment(4));
    }

    function alihkan() {
        $this->load->model('berita/beritamodel', 'berita', TRUE);
        $this->berita->alihkan_disposisi($this->uri->segment(4));
        $data['status'] = "Berhasil";
        $data['isi'] = "Berhasil melakukan pengalihan disposisi, \nBerita ini akan diteruskan kepada Fungsi yang anda pilih!";
        echo json_encode($data);
    }

    function upload() {
        $this->load->model('berita/beritamodel', 'berita', TRUE);
        $this->load->library('flexpaper/php/lib/config');

        $filename = $this->uri->segment(4) . "_aslidispo.pdf";
        if (move_uploaded_file($_FILES['berkas_disposisi']['tmp_name'], '/var/www/files/' . $filename)) {
            $this->berita->update_berkas_dispo($this->uri->segment(4), $filename);
            $data = array('msg' => 'Berhasil', 'filename' => $filename);
        } else {
            $data = array('msg' => 'Failed to save');
            redirect('berita/detail/id/' . $this->uri->segment(4), 'refresh');
        }
        echo json_encode($data);
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */