<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tambah_berita_keluar extends CI_Controller {

    function index() {
        $this->load->model('berita/beritakeluarmodel', 'beritakeluar', TRUE);
        $this->load->model('detailberita/detailberitamodel', 'detailberita', TRUE);
        $query = $this->db->get('tbl_perwakilan');
        $data['pengirim'] = $query->result_array();
//        echo "<pre>";
//        print_r($_POST);
//        echo "</pre>";
//        die();

        if (!empty($_POST['rad_sifat_dokumen'])) {
            if ($_POST['rad_sifat_dokumen'] == 1) {
                $kd_jenis_berita = 'R';
            } else {
                $kd_jenis_berita = 'B';
            }
        } else {
            $kd_jenis_berita = 'R';
        }
        
        //generate kode arsip
        $jml = $this->beritakeluar->jml_berita_tahun_ini("K".$kd_jenis_berita);
        if ($jml[0]['jml'] == 0) {
            $kode_jadi = "K" . $kd_jenis_berita . "-" . date('y') . "-0001";
        } else {
//                $kode_arsip = $this->berita->code_generator();
//                $div = explode("-", $kode_arsip[0]['arsip_kd']);
//                $str = $div[2];
//                $kode_jadi = (int) $str + 1;
            $kode_jadi = $jml[0]['jml'] + 1;

            switch (strlen($kode_jadi)) {
                case 1:
                    $kode_jadi = "K".$kd_jenis_berita."-" . date('y') . "-000" . $kode_jadi;
                    break;
                case 2:
                    $kode_jadi = "K".$kd_jenis_berita."-" . date('y') . "-00" . $kode_jadi;
                    break;
                case 3:
                    $kode_jadi = "K".$kd_jenis_berita."-" . date('y') . "-0" . $kode_jadi;
                    break;
                case 4:
                    $kode_jadi = "K".$kd_jenis_berita."-" . date('y') . "-" . $kode_jadi;
                    break;
            }
        }
        //end generate kode arsip

        if (!empty($_POST['TAMBAH'])) {
            $note = "";
            $note_error = "";
            if (empty($_POST['berita_kd']) || empty($_POST['tgl_berita']) || empty($_POST['perihal_berita']) || empty($_POST['fungsi_pengirim_kd'])) {
                if (empty($_POST['berita_kd']) && empty($_POST['fungsi_pengirim_kd']) && empty($_POST['tgl_berita']) && empty($_POST['perihal_berita'])) {
                    $this->session->set_flashdata('notifikasi', '<p>Terjadi Beberapa Kesalahan:</p><ul><li><b>No Berita </b> Harus diisi</li> <li><b>Jenis Berita </b> Harus diisi</li> <li><b>Pengirim Berita </b> Harus diisi</li> <b>Tanggal berita</b>  Harus diisi</li><li><b>Perihal berita</b>  Harus diisi</li></p>');
                    $this->session->set_flashdata('status', 'form-message error');
                } else {
                    if (empty($_POST['berita_kd'])) {
                        $note_error = $note_error . '<br> No Berita Harus diisi';
                    }
                    if (empty($_POST['fungsi_pengirim_kd'])) {
                        $note_error = $note_error . '<br> Fungsi Pengirim berita Harus diisi';
                    }
                    if (empty($_POST['tgl_berita'])) {
                        $note_error = $note_error . '<br> Tanggal berita Harus diisi';
                    }
                    if (empty($_POST['perihal_berita'])) {
                        $note_error = $note_error . '<br> Perihal berita Harus diisi';
                    }
                    $this->session->set_flashdata('berita_kd', $_POST['berita_kd']);
                    $this->session->set_flashdata('arsip_kd',$_POST['arsip_kd']);
                    $this->session->set_flashdata('fungsi_pengirim',$_POST['fungsi_pengirim']);
                    $this->session->set_flashdata('jenis_kd', $_POST['jenis_kd']);
                    $this->session->set_flashdata('perihal_berita', $_POST['perihal_berita']);
                    $this->session->set_flashdata('tgl_berita', $_POST['tgl_berita']);
                    $this->session->set_flashdata('rad_sifat_dokumen',$_POST['rad_sifat_dokumen']);
                    $this->session->set_flashdata('notifikasi_error', 'Terjadi Kesalahan: ' . $note_error);
                }
                redirect('berita/tambah_berita_keluar/index' . $this->uri->segment(4));
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
                        redirect('berita/tambah_berita_keluar/index');
                    }
//                    echo $this->upload->display_errors();
//                    echo phpinfo();
                }
                $_POST['berita_kd'] = str_replace(' ', '_', $_POST['berita_kd']);
                $this->beritakeluar->tambah_berita($kode_jadi, $kd_berita);
                //save to detail berita for other perwakilan purpose
                $pwk_code_arr = $_POST['pwk_code'];
                foreach ($pwk_code_arr as $row) {
                    $this->detailberita->tambah_detailberita($kode_jadi, $row);
                }

                $this->session->set_flashdata('notifikasi', 'Berita Telah berhasil Ditambah! No Arsip Baru : ' . $kode_jadi);
                $this->session->set_flashdata('status', 'form-message correct');
//                redirect('berita/tambah_berita/index');
                redirect('berita/edit_berita_keluar/id/' . $kode_jadi);
            }
        }
        $data['kode'] = $kode_jadi;
        $data['berita_kd'] = $kd_jenis_berita . '-0000/KUCHING/' . date('ymd');
//        echo '<pre>';
//print_r($data);
//echo '</pre>';
//die();
//die('ss');
        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val'] = $skin_val;
        if ($skin_val != "") {
            $this->load->view('skins/' . $skin_val . '/berita/tambah_berita_keluar', $data);
        } else {
            $this->load->view('berita/tambah_berita', $data);
        }
    }

    function calclastrow(){
        //generate kode arsip
        $num_jenis_berita = $this->uri->segment(4);
        $kd_jenis_berita=$num_jenis_berita==1?"R":"B";
        $this->load->model('berita/beritakeluarmodel', 'beritakeluar', TRUE);
        $jml = $this->beritakeluar->jml_berita_tahun_ini("K".$kd_jenis_berita);
        if ($jml[0]['jml'] == 0) {
            $kode_jadi = "K" . $kd_jenis_berita . "-" . date('y') . "-0001";
        } else {
//                $kode_arsip = $this->berita->code_generator();
//                $div = explode("-", $kode_arsip[0]['arsip_kd']);
//                $str = $div[2];
//                $kode_jadi = (int) $str + 1;
            $kode_jadi = $jml[0]['jml'] + 1;

            switch (strlen($kode_jadi)) {
                case 1:
                    $kode_jadi = "K".$kd_jenis_berita."-" . date('y') . "-000" . $kode_jadi;
                    break;
                case 2:
                    $kode_jadi = "K".$kd_jenis_berita."-" . date('y') . "-00" . $kode_jadi;
                    break;
                case 3:
                    $kode_jadi = "K".$kd_jenis_berita."-" . date('y') . "-0" . $kode_jadi;
                    break;
                case 4:
                    $kode_jadi = "K".$kd_jenis_berita."-" . date('y') . "-" . $kode_jadi;
                    break;
            }
        }
        echo $kode_jadi;
        //end generate kode arsip
    }
    function autocomplete() {
        $this->load->model('fungsi/fungsimodel', 'fungsi', TRUE);
        $query = $this->fungsi->search_data_fungsi($_GET['query']);
        //search di fungsi di kbri saja
//        echo "<pre>";
//        print_r($query);
//        echo "</pre>";
//        die();
        $query_final = array();
        foreach ($query as $key => $valarr) {
            $query_final[$key] = array(
                'id' => $valarr['fungsi_kd'],
                'label' => ucwords(strtolower($valarr['nama_fungsi'])),
                'value' => ucwords(strtolower($valarr['nama_fungsi']))
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
