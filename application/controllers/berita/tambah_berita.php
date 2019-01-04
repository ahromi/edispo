<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tambah_berita extends CI_Controller {

    function index() {
        $this->load->model('berita/beritamodel', 'berita', TRUE);
        $this->load->model('detailberita/detailberitamodel','detailberita',TRUE);
        $query = $this->db->get('tbl_perwakilan');
        $data['pengirim'] = $query->result_array();
//        echo "<pre>";
//        print_r($this->session->userdata);
//        echo "</pre>";
        if ($this->session->userdata('SESSION_HOME_STAFF') == 'Y') {
            $jml = $this->berita->jml_berita_tahun_ini("R");
            if ($jml[0]['jml'] == 0) {
                $kode_jadi = "R-" . date('y') . "-0001";
            } else {
//                $kode_arsip = $this->berita->code_generator();
//                $div = explode("-", $kode_arsip[0]['arsip_kd']);
//                $str = $div[2];
//                $kode_jadi = (int) $str + 1;
                $kode_jadi = $jml[0]['jml'] + 1;
                switch (strlen($kode_jadi)) {
                    case 1:
                        $kode_jadi = "R-" . date('y') . "-000" . $kode_jadi;
                        break;
                    case 2:
                        $kode_jadi = "R-" . date('y') . "-00" . $kode_jadi;
                        break;
                    case 3:
                        $kode_jadi = "R-" . date('y') . "-0" . $kode_jadi;
                        break;
                    case 4:
                        $kode_jadi = "R-" . date('y') . "-" . $kode_jadi;
                        break;
                }
            }
        } else {
            $jml = $this->berita->jml_berita_tahun_ini("B");
            if ($jml[0]['jml'] == 0) {
                $kode_jadi = "B-" . date('y') . "-0001";
            } else {
//                $kode_arsip = $this->berita->code_generator();
//                $div = explode("-", $kode_arsip[0]['arsip_kd']);
//                $str = $div[2];
//                $kode_jadi = (int) $str + 1;
                $kode_jadi = $jml[0]['jml'] + 1;

                switch (strlen($kode_jadi)) {
                    case 1:
                        $kode_jadi = "B-" . date('y') . "-000" . $kode_jadi;
                        break;
                    case 2:
                        $kode_jadi = "B-" . date('y') . "-00" . $kode_jadi;
                        break;
                    case 3:
                        $kode_jadi = "B-" . date('y') . "-0" . $kode_jadi;
                        break;
                    case 4:
                        $kode_jadi = "B-" . date('y') . "-" . $kode_jadi;
                        break;
                }
            }
        }

        if (!empty($_POST['TAMBAH'])) {
            $note = "";
            if (empty($_POST['berita_kd']) || $_POST['jenis_kd'] == "0" || empty($_POST['perwakilan_kd']) || empty($_POST['derajat_kd']) || empty($_POST['tgl_berita']) || empty($_POST['perihal_berita'])) {
                if (empty($_POST['berita_kd']) && $_POST['jenis_kd'] == "0" && empty($_POST['perwakilan_kd']) && empty($_POST['derajat_kd']) && empty($_POST['tgl_berita']) && empty($_POST['perihal_berita'])) {
                    $this->session->set_flashdata('notifikasi', '<p>Terjadi Beberapa Kesalahan:</p><ul><li><b>No Berita </b> Harus diisi</li> <li><b>Jenis Berita </b> Harus diisi</li> <li><b>Pengirim Berita </b> Harus diisi</li> <li><b>Derajat berita</b>  Harus diisi</li><li><b>Tanggal berita</b>  Harus diisi</li><li><b>Perihal berita</b>  Harus diisi</li></p>');
                    $this->session->set_flashdata('status', 'form-message error');
                } else {
                    if (empty($_POST['berita_kd'])) {
                        $note = $note . '\n No Berita Harus diisi';
                    }
                    if (empty($_POST['jenis_kd'])) {
                        $note = $note . '\n Jenis berita Harus diisi';
                    }
                    if (empty($_POST['perwakilan_kd'])) {
                        $note = $note . '\n Pengirim berita Harus diisi';
                    }
                    if (empty($_POST['derajat_berita'])) {
                        $note = $note . '\n Derajat berita Harus diisi';
                    }
                    if (empty($_POST['tgl_berita'])) {
                        $note = $note . '\n Tanggal berita Harus diisi';
                    }
                    if (empty($_POST['perihal_berita'])) {
                        $note = $note . '\n Perihal berita Harus diisi';
                    }
                    
                    if (empty($_POST['berita_fungsi_disposisi'])) {
                        $note = $note . '\n Disposisi berita oleh Harus diisi';
                    }
                    $this->session->set_flashdata('berita_kd', $_POST['berita_kd']);
                    $this->session->set_flashdata('jenis_kd', $_POST['jenis_kd']);
                    $this->session->set_flashdata('perwakilan_kd', $_POST['perwakilan_kd']);
                    $this->session->set_flashdata('derajat_kd', $_POST['derajat_kd']);
                    $this->session->set_flashdata('perihal_berita', $_POST['perihal_berita']);
                    $this->session->set_flashdata('tgl_berita', $_POST['tgl_berita']);

                    $this->session->set_flashdata('notifikasi', 'Terjadi Kesalahan: ' . $note);
                }
                redirect('berita/tambah_berita/index' . $this->uri->segment(4));
            } else {

                if (!empty($_FILES['userfile']['name'])) {
                    $kd_berita = str_replace(' ', '_', $_POST['berita_kd']);
                    $kd_berita = str_replace('.', '_', $kd_berita);
                    $kd_berita = str_replace('/', '-', $kd_berita);
                    $config['upload_path'] = './files/';
                    $config['allowed_types'] = 'pdf';
                    $config['file_name'] = $kode_jadi . "_" . $kd_berita;
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload()) {

                        $this->session->set_flashdata('notifikasi', 'Upload gagal!');
                        $this->session->set_flashdata('status', 'form-message error');
                        redirect('berita/tambah_berita/index');
                    }
//                    echo $this->upload->display_errors();
//                    echo phpinfo();
                }
                $_POST['berita_kd'] = str_replace(' ', '_', $_POST['berita_kd']);
                $this->berita->tambah_berita($kode_jadi, $kd_berita);
                //save to detail berita for other perwakilan purpose
                $pwk_code_arr=$_POST['pwk_code'];
                foreach($pwk_code_arr as $row){
                    $this->detailberita->tambah_detailberita($kode_jadi,$row);
                }
                
                $this->session->set_flashdata('notifikasi', 'Berita Telah berhasil Ditambah! No Arsip Baru : ' . $kode_jadi);
                $this->session->set_flashdata('status', 'form-message correct');
//                redirect('berita/tambah_berita/index');
                redirect('berita/edit_berita/id/' . $kode_jadi);
            }
        }
        $data['jenis'] = $this->berita->cmb_jenis();
        $data['sifat'] = $this->berita->cmb_sifat();
        $data['perwakilan'] = $this->berita->cmb_perwakilan();
        $data['derajat'] = $this->berita->cmb_derajat();
        $data['pendispo'] = $this->berita->get_pendispo();
        $data['kode'] = $kode_jadi;
        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val'] = $skin_val;
        if ($skin_val != "") {
            $this->load->view('skins/' . $skin_val . '/berita/tambah_berita', $data);
        } else {
            $this->load->view('berita/tambah_berita', $data);
        }
    }

    function autocomplete() {
        $this->load->model('berita/beritamodel', 'berita', TRUE);
        $query = $this->berita->list_perwakilan($_GET['query']);
//        echo "<pre>";
//        print_r($query);
//        echo "</pre>";
        $query_final=array();
        foreach($query as $key => $valarr){
            $query_final[$key]=array(
                'id'=>$valarr['id'],
                'label'=> ucwords(strtolower($valarr['label'])),
                'value'=> ucwords(strtolower($valarr['value']))
            );
        }
        echo json_encode($query_final);
    }

    function tambah_pengirim() {
        $this->load->model('berita/beritamodel', 'berita', TRUE);
        $query = $this->berita->insert_pengirim();
        echo "Penambahan Berhasil";
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
