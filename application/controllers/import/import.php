<?php

class Import extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    function index() {
        $data = '';
        $this->load->model('import/importmodel', 'import', TRUE);

        if (!empty($_POST['UPLOAD'])) {
            $this->load->library('csvreader');
            $this->load->helper('form');
            $this->load->helper('file');
            //Configure
            //set the path where the files uploaded will be copied. NOTE if using linux, set the folder to permission 777
            $config['upload_path'] = 'application/views/simbra/';
            $config['overwrite'] = 'TRUE';
            //$config['allowed_types'] = 'txt';
            //load the upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->set_allowed_types('*');
            $this->upload->do_upload('userfile');

            $query1 = $this->db->get('tbl_perwakilan');
            $data['pengirim'] = $query1->result_array();

            $query2 = $this->db->get_where('tbl_fungsi', array('disposisi_fungsi' => 'Y'));
            $data['pendispo'] = $query2->result_array();
            $data['nama'] = $_FILES['userfile']['name'];
            //$test = $data['file_path'].$data['file_name'];

            $data['csvData'] = $this->csvreader->parse_file('./application/views/simbra/' . $_FILES['userfile']['name']);

            //$string = read_file('./application/views/simbra/'.$_FILES['userfile']['name']);
            //$data['nama'] = base_url().'application/views/simbra/'.$_FILES['userfile']['name'];
            //if ($string=="FALSE")
            //{
            // $data['nama'] = 'Unable to read the file';
            //}
            //else
            //{
            // $data['nama'] = $string;
            //}
        } elseif (!empty($_POST['SUBMIT'])) {
            //$this->load->library('MY_Upload');
            //$data['csvData'] = $_POST;
            //print_r ($_FILES);  exit;
            $i = -1;
            //print_r ($_FILES); exot;
            $namafiles = array();
            foreach ($_FILES as $userfiles) {

                foreach ($userfiles['tmp_name'] as $file) {
                    $i++;
                    //echo ($file)."<br>";

                    $kd_berita = str_replace(' ', '_', $_POST['kd_berita'][$i]);
                    $kd_berita = str_replace('/', '-', $kd_berita);
                    $this->load->model('import/importmodel', 'import');
                    $jml = $this->import->jml_berita_tahun_ini();
                    if ($jml[0]['jml'] == 0) {
                        $kode_jadi = "A-" . date('y') . "-00001";
                    } else {
                        $kode_arsip = $this->import->code_generator_simbra();
                        $div = explode("-", $kode_arsip[0]['arsip_kd']);
                        $str = $div[2];
                        $kode_jadi = (int) $str + 1;

                        switch (strlen($kode_jadi)) {
                            case 1:
                                $kode_jadi = "A-" . date('y') . "-0000" . $kode_jadi;
                                break;
                            case 2:
                                $kode_jadi = "A-" . date('y') . "-000" . $kode_jadi;
                                break;
                            case 3:
                                $kode_jadi = "A-" . date('y') . "-00" . $kode_jadi;
                                break;
                            case 4:
                                $kode_jadi = "A-" . date('y') . "-0" . $kode_jadi;
                                break;
                            case 5:
                                $kode_jadi = "A-" . date('y') . "-" . $kode_jadi;
                                break;
                        }
                    }

                    array_push($namafiles, $kode_jadi . "_" . $kd_berita);
                    $this->import->tambah_berita_simbra($kode_jadi, $kd_berita, $_POST['perihal_berita'][$i], $_POST['tanggal'][$i], $_POST['pengirim'][$i], $_POST['jabatan'][$i], $_POST['dispo'][$i], $_POST['pendispo'][$i], $_POST['derajat'][$i]);
                }
            }

            if (count($namafiles)) {
                //if (!empty($_FILES['userfiles']['name'][$i])){
                $config['upload_path'] = '/var/www/files/';
                //$config['allowed_types'] = '*';
                $config['allowed_types'] = 'pdf';
                //$config['max_size']	= '100';
                //$config['max_width']  = '300';
                //$config['max_height']  = '400';
                $config['file_name'] = $namafiles;
                $this->load->library('upload', $config);
                $this->upload->do_multi_upload("userfiles");
            }
            $this->session->set_flashdata('notifikasi', 'Berita Telah berhasil Ditambah!');
            $this->session->set_flashdata('status', 'form-message correct');
            redirect('import/import/index');
        }

        $this->load->view('import/import', $data);
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */