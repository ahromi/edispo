<?php

class Berita extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    function showxxxx() {
        $this->load->model('berita/beritamodel', 'berita', TRUE);
        $user_nama = $this->session->flashdata('user_nama');
        $user_namalengkap = $this->session->flashdata('user_namalengkap');
        $username = $this->session->userdata('SESSION_USERNAME');
        $level_id = $this->session->userdata('SESSION_FUNGSI_KD');

        if (!empty($level_id)) {
            if ($level_id == 1 || $level_id == 2 || $level_id == 3) {
                $this->load->library('flexpaper/php/lib/config');
                $this->load->view('berita/simple_document');
            } else {
                $valid = $this->berita->check_dokumen($level_id, $this->uri->segment(4));
                $fungsi_kd = $this->berita->get_inputted_fungsi_byfile($this->uri->segment(4));
                if ($valid[0]['jml'] != 0 || $fungsi_kd[0]['berita_input_fungsi'] == $level_id) {
                    $this->load->library('flexpaper/php/lib/config');
                    $this->load->view('berita/simple_document');
                } else {
                    echo "Berita ini tidak dapat diakses! <br> <a href='#' onclick='history.back()'>Kembali</a>";
                }
            }
        } else {
            echo "Berita ini tidak dapat diakses! <br> <a href='#' onclick='history.back()'>Kembali</a>";
        }
    }

    function showPDFzxxxxx() {
        $this->load->model('berita/beritamodel', 'berita', TRUE);
        $username = $this->session->userdata('SESSION_USERNAME');
        $level_id = $this->session->userdata('SESSION_FUNGSI_KD');
        $valid = $this->berita->check_dokumen($level_id, $this->uri->segment(4));

        if ($valid[0]['jml'] != 0 || $level_id == 1 || $level_id == 2 || $level_id == 3) {
            $file = $this->uri->segment(4);
            $this->load->helper('download');
            $path = './files';
            $data = file_get_contents($path . '/' . $file);
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            //header('Content-Disposition: inline; filename='.basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            echo $data;
        } else {
            echo "Berita ini tidak dapat diakses! <br> <a href='#' onclick='history.back()'>Kembali</a>";
        }
    }
    
    function index() {
        $this->load->model('berita/beritamodel', 'berita', TRUE);
        $config['full_tag_open'] = '<ul class="pagination tcenter">';

        $config['first_tag_open'] = '<li class="page radius2">';
        $config['first_link'] = '<<';
        $config['first_tag_close'] = '</li>';

        $config['last_tag_open'] = '<li class="page radius2">';
        $config['last_link'] = '>>';
        $config['last_tag_close'] = '</li>';

        $config['next_tag_open'] = '<li class="page radius2">';
        $config['next_link'] = '>';
        $config['next_tag_close'] = '</li>';

        $config['prev_tag_open'] = '<li class="page radius2">';
        $config['prev_link'] = '<';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page radius2">';
        $config['cur_tag_close'] = '</li>';

        $config['num_tag_open'] = '<li class="page radius2">';
        $config['num_tag_close'] = '</li>';
        $config['full_tag_close'] = '</ul>';

        $this->load->library('pagination');
        $config['uri_segment'] = 4;
        $config['base_url'] = base_url() . 'index.php/berita/berita/index';

        $this->db->order_by("berita_kd", "desc");
        $this->db->select('*');
        $this->db->from('tbl_berita');
        $this->db->join('tbl_jenis_berita', 'tbl_berita.jenis_kd= tbl_jenis_berita.jenis_kd');
        $this->db->join('tbl_sifat', 'tbl_berita.sifat_kd= tbl_sifat.sifat_kd');
        $this->db->join('tbl_perwakilan', 'tbl_perwakilan.perwakilan_kd= tbl_berita.perwakilan_kd');
        $this->db->join('tbl_derajat', 'tbl_derajat.derajat_kd= tbl_berita.derajat_kd');
        $query = $this->db->count_all_results();

        $config['total_rows'] = $query;
        $config['per_page'] = '20';
        $this->pagination->initialize($config);

        $offset = $this->uri->segment(4);

        if (empty($offset)) {
            $offset = 0;
            $data['opset'] = $offset;
            $data['berita'] = $this->berita->get_data_berita($config['per_page'], $offset);
        } else {
            $data['opset'] = $offset;
            $data['berita'] = $this->berita->get_data_berita($config['per_page'], $offset);
        }
        $data['title_table'] = "Daftar Berita";

        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val'] = $skin_val;
        if ($skin_val != "") {
            $this->load->view('skins/' . $skin_val . '/berita/berita', $data);
        } else {
            $this->load->view('berita/berita', $data);
        }
    }

    function inputed() {
        $this->load->model('berita/beritamodel', 'berita', TRUE);
        $config['full_tag_open'] = '<ul class="pagination tcenter">';

        $config['first_tag_open'] = '<li class="page radius2">';
        $config['first_link'] = '<<';
        $config['first_tag_close'] = '</li>';

        $config['last_tag_open'] = '<li class="page radius2">';
        $config['last_link'] = '>>';
        $config['last_tag_close'] = '</li>';

        $config['next_tag_open'] = '<li class="page radius2">';
        $config['next_link'] = '>';
        $config['next_tag_close'] = '</li>';

        $config['prev_tag_open'] = '<li class="page radius2">';
        $config['prev_link'] = '<';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page radius2">';
        $config['cur_tag_close'] = '</li>';

        $config['num_tag_open'] = '<li class="page radius2">';
        $config['num_tag_close'] = '</li>';
        $config['full_tag_close'] = '</ul>';

        $this->load->library('pagination');
        $config['uri_segment'] = 4;
        $config['base_url'] = base_url() . 'index.php/berita/berita/index';

        $this->db->order_by("berita_kd", "desc");
        $this->db->select('*');
        $this->db->from('tbl_berita');
        $this->db->join('tbl_jenis_berita', 'tbl_berita.jenis_kd= tbl_jenis_berita.jenis_kd');
        $this->db->join('tbl_sifat', 'tbl_berita.sifat_kd= tbl_sifat.sifat_kd');
        $this->db->join('tbl_perwakilan', 'tbl_perwakilan.perwakilan_kd= tbl_berita.perwakilan_kd');
        $this->db->join('tbl_derajat', 'tbl_derajat.derajat_kd= tbl_berita.derajat_kd');
        $this->db->where('tbl_berita.berita_input_fungsi', $this->session->userdata('SESSION_FUNGSI_KD')); //$where = "tbl_berita.berita_input_fungsi='".$this->session->userdata('SESSION_FUNGSI_KD')."'";
        //$this->db->where($where);
        $query = $this->db->count_all_results();

        $config['total_rows'] = $query;
        $config['per_page'] = '20';
        $this->pagination->initialize($config);

        $offset = $this->uri->segment(4);

        if (empty($offset)) {
            $offset = 0;
            $data['opset'] = $offset;
            $data['berita'] = $this->berita->get_data_berita_inpputed($config['per_page'], $offset);
        } else {
            $data['opset'] = $offset;
            $data['berita'] = $this->berita->get_data_berita_inpputed($config['per_page'], $offset);
        }
        $data['title_table'] = "Berita Yang Diinput Saya";

        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val'] = $skin_val;
        if ($skin_val != "") {
            $this->load->view('skins/' . $skin_val . '/berita/berita', $data);
        } else {
            $this->load->view('berita/berita', $data);
        }
    }

    function keluar() {
        $this->load->model('berita/beritakeluarmodel', 'beritakeluar', TRUE);
        $config['full_tag_open'] = '<ul class="pagination tcenter">';

        $config['first_tag_open'] = '<li class="page radius2">';
        $config['first_link'] = '<<';
        $config['first_tag_close'] = '</li>';

        $config['last_tag_open'] = '<li class="page radius2">';
        $config['last_link'] = '>>';
        $config['last_tag_close'] = '</li>';

        $config['next_tag_open'] = '<li class="page radius2">';
        $config['next_link'] = '>';
        $config['next_tag_close'] = '</li>';

        $config['prev_tag_open'] = '<li class="page radius2">';
        $config['prev_link'] = '<';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page radius2">';
        $config['cur_tag_close'] = '</li>';

        $config['num_tag_open'] = '<li class="page radius2">';
        $config['num_tag_close'] = '</li>';
        $config['full_tag_close'] = '</ul>';

        $fungsi_kd=$this->session->userdata('SESSION_FUNGSI_KD')==2?0:$this->session->userdata('SESSION_FUNGSI_KD');
        $this->load->library('pagination');
        $config['uri_segment'] = 4;
        $config['base_url'] = base_url() . 'index.php/berita/beritakeluar/index';
        $jum_berita_arr=$this->beritakeluar->jml_berita_keluar($fungsi_kd);
        $config['total_rows'] = $jum_berita_arr[0]['jml'];
        $config['per_page'] = '20';
        $this->pagination->initialize($config);

        $offset = $this->uri->segment(4);

        //        allow only dubes, kom dan setpim
        if($fungsi_kd <4){
            $fungsi_kd="";
        }
        $data['berita_keluar_rahasia'] = $this->beritakeluar->get_berita_keluar_rahasia($fungsi_kd);
        $data['berita_keluar_biasa'] = $this->beritakeluar->get_berita_keluar_biasa($fungsi_kd);

        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val'] = $skin_val;
        if ($skin_val != "") {
            $this->load->view('skins/' . $skin_val . '/berita/keluar', $data);
        } else {
            $this->load->view('berita/berita', $data);
        }
    }
    
    function today() {
        $this->load->model('berita/beritamodel', 'berita', TRUE);
        $config['full_tag_open'] = '<ul class="pagination tcenter">';

        $config['first_tag_open'] = '<li class="page radius2">';
        $config['first_link'] = '<<';
        $config['first_tag_close'] = '</li>';

        $config['last_tag_open'] = '<li class="page radius2">';
        $config['last_link'] = '>>';
        $config['last_tag_close'] = '</li>';

        $config['next_tag_open'] = '<li class="page radius2">';
        $config['next_link'] = '>';
        $config['next_tag_close'] = '</li>';

        $config['prev_tag_open'] = '<li class="page radius2">';
        $config['prev_link'] = '<';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page radius2">';
        $config['cur_tag_close'] = '</li>';

        $config['num_tag_open'] = '<li class="page radius2">';
        $config['num_tag_close'] = '</li>';
        $config['full_tag_close'] = '</ul>';

        $this->load->library('pagination');
        $config['uri_segment'] = 4;
        $config['base_url'] = base_url() . 'index.php/berita/berita_lanjutan/today';

        $this->db->order_by("tbl_berita.arsip_kd", "desc");
        $this->db->select('*');
        $this->db->from('tbl_berita');
        $this->db->join('tbl_jenis_berita', 'tbl_berita.jenis_kd= tbl_jenis_berita.jenis_kd');
        $this->db->join('tbl_sifat', 'tbl_berita.sifat_kd= tbl_sifat.sifat_kd');
        $this->db->join('tbl_perwakilan', 'tbl_perwakilan.perwakilan_kd= tbl_berita.perwakilan_kd');
        $this->db->join('tbl_derajat', 'tbl_derajat.derajat_kd= tbl_berita.derajat_kd');
        $this->db->join('tbl_disposisi_lanjutan', 'tbl_disposisi_lanjutan.arsip_kd= tbl_berita.arsip_kd');
        $where = "tbl_berita.tgl_diarsipkan = '" . date('Y-m-d') . "'";
        $this->db->where($where);
        $query = $this->db->count_all_results();

        $config['total_rows'] = $query;
        $config['per_page'] = '10';
        $this->pagination->initialize($config);

        $offset = $this->uri->segment(4);

        if (empty($offset)) {
            $offset = 0;
            $data['opset'] = $offset;
            $data['berita'] = $this->berita->get_data_berita_today($config['per_page'], $offset);
        } else {
            $data['opset'] = $offset;
            $data['berita'] = $this->berita->get_data_berita_today($config['per_page'], $offset);
        }
        $data['title_table'] = "Berita Hari Ini";

        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val'] = $skin_val;
        if ($skin_val != "") {
            $this->load->view('skins/' . $skin_val . '/berita/berita_today', $data);
        } else {
            $this->load->view('berita/berita_today', $data);
        }
    }

    function diterima() {
        $this->load->model('berita/beritamodel', 'berita', TRUE);
        $config['full_tag_open'] = '<ul class="pagination tcenter">';

        $config['first_tag_open'] = '<li class="page radius2">';
        $config['first_link'] = '<<';
        $config['first_tag_close'] = '</li>';

        $config['last_tag_open'] = '<li class="page radius2">';
        $config['last_link'] = '>>';
        $config['last_tag_close'] = '</li>';

        $config['next_tag_open'] = '<li class="page radius2">';
        $config['next_link'] = '>';
        $config['next_tag_close'] = '</li>';

        $config['prev_tag_open'] = '<li class="page radius2">';
        $config['prev_link'] = '<';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page radius2">';
        $config['cur_tag_close'] = '</li>';

        $config['num_tag_open'] = '<li class="page radius2">';
        $config['num_tag_close'] = '</li>';
        $config['full_tag_close'] = '</ul>';

        $this->load->library('pagination');
        $config['uri_segment'] = 4;
        $config['base_url'] = base_url() . 'index.php/berita/berita/diterima';

        $koordinator_fungsi = $this->session->userdata('SESSION_KOORDINATOR');
        $detail_fungsi_kd = $this->session->userdata('SESSION_FUNGSI_KD');
        $detail_user_kd=$this->session->userdata('SESSION_ID');
        $bulan_now = date("Ym");

        $arr_penerimaan=array('Y'=>0,'T'=>0);
        if ($koordinator_fungsi == 'Y') {
            $data_penerimaan = $this->berita->dashboard_penerimaan($detail_fungsi_kd, $bulan_now);
            foreach ($data_penerimaan as $row_penerimaan) {
                if ($row_penerimaan['detail_terima'] == 'Y') {
                    $arr_penerimaan['Y'] = $row_penerimaan['jml'];
                } else {
                    $arr_penerimaan['T'] = $row_penerimaan['jml'];
                }
            }
        } else {
            
        }
        $query = $arr_penerimaan['Y'] + $arr_penerimaan['T'];

        $config['total_rows'] = $query;
        $config['per_page'] = '10';
        $this->pagination->initialize($config);

        $offset = $this->uri->segment(4);

        if (empty($offset)) {
            $offset = 0;
            $data['opset'] = $offset;
            if ($koordinator_fungsi == 'Y') {
                $data['berita'] = $this->berita->get_data_berita_diterima($config['per_page'], $offset, $detail_fungsi_kd, $bulan_now);
            } else {
                $data['berita'] = $this->berita->get_data_berita_diterima_by_user($config['per_page'], $offset, $detail_user_kd, $bulan_now);
            }
        } else {
            $data['opset'] = $offset;
            $data['berita'] = $this->berita->get_data_berita_diterima($config['per_page'], $offset, $detail_fungsi_kd, $bulan_now);
        }
        $data['title_table'] = "Berita Yang Sudah Diterima Periode " . date('M Y');

        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val'] = $skin_val;
        if ($skin_val != "") {
            $this->load->view('skins/' . $skin_val . '/berita/berita_diterima', $data);
        } else {
            $this->load->view('berita/berita_today', $data);
        }
    }
    
    function pendingbulanlalu() {
        $this->load->model('berita/beritamodel', 'berita', TRUE);
        $config['full_tag_open'] = '<ul class="pagination tcenter">';

        $config['first_tag_open'] = '<li class="page radius2">';
        $config['first_link'] = '<<';
        $config['first_tag_close'] = '</li>';

        $config['last_tag_open'] = '<li class="page radius2">';
        $config['last_link'] = '>>';
        $config['last_tag_close'] = '</li>';

        $config['next_tag_open'] = '<li class="page radius2">';
        $config['next_link'] = '>';
        $config['next_tag_close'] = '</li>';

        $config['prev_tag_open'] = '<li class="page radius2">';
        $config['prev_link'] = '<';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page radius2">';
        $config['cur_tag_close'] = '</li>';

        $config['num_tag_open'] = '<li class="page radius2">';
        $config['num_tag_close'] = '</li>';
        $config['full_tag_close'] = '</ul>';

        $this->load->library('pagination');
        $config['uri_segment'] = 4;
        $config['base_url'] = base_url() . 'index.php/berita/berita/pendingbulanlalu';

        $koordinator_fungsi = $this->session->userdata('SESSION_KOORDINATOR');
        $detail_fungsi_kd = $this->session->userdata('SESSION_FUNGSI_KD');
        $bulan_now = date("Ym");

        if ($koordinator_fungsi == 'Y') {
            $data_pendingan = $this->berita->dashboard_pendingan($detail_fungsi_kd, $bulan_now);
        } else {
            
        }
        $query = isset($data_pendingan[0]['jml'])?$data_pendingan[0]['jml']:0;

        $config['total_rows'] = $query;
        $config['per_page'] = '10';
        $this->pagination->initialize($config);

        $offset = $this->uri->segment(4);

        if (empty($offset)) {
            $offset = 0;
            $data['opset'] = $offset;
            if ($koordinator_fungsi == 'Y') {
                $data['berita'] = $this->berita->get_data_berita_pendinganbulanlalu($config['per_page'], $offset, $detail_fungsi_kd, $bulan_now);
            } else {
                
            }
        } else {
            $data['opset'] = $offset;
            $data['berita'] = $this->berita->get_data_berita_pendinganbulanlalu($config['per_page'], $offset, $detail_fungsi_kd, $bulan_now);
        }
        $data['title_table'] = "Berita Yang Belum Dikerjakan Sebelum " . date('M Y');

        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val'] = $skin_val;
        if ($skin_val != "") {
            $this->load->view('skins/' . $skin_val . '/berita/berita_diterima_pendingbulanlalu', $data);
        } else {
            $this->load->view('berita/berita_today', $data);
        }
    }

    function dikerjakan() {
        $this->load->model('berita/beritamodel', 'berita', TRUE);
        $config['full_tag_open'] = '<ul class="pagination tcenter">';

        $config['first_tag_open'] = '<li class="page radius2">';
        $config['first_link'] = '<<';
        $config['first_tag_close'] = '</li>';

        $config['last_tag_open'] = '<li class="page radius2">';
        $config['last_link'] = '>>';
        $config['last_tag_close'] = '</li>';

        $config['next_tag_open'] = '<li class="page radius2">';
        $config['next_link'] = '>';
        $config['next_tag_close'] = '</li>';

        $config['prev_tag_open'] = '<li class="page radius2">';
        $config['prev_link'] = '<';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page radius2">';
        $config['cur_tag_close'] = '</li>';

        $config['num_tag_open'] = '<li class="page radius2">';
        $config['num_tag_close'] = '</li>';
        $config['full_tag_close'] = '</ul>';

        $this->load->library('pagination');
        $config['uri_segment'] = 4;
        $config['base_url'] = base_url() . 'index.php/berita/berita/dikerjakan';

        $koordinator_fungsi = $this->session->userdata('SESSION_KOORDINATOR');
        $detail_fungsi_kd = $this->session->userdata('SESSION_FUNGSI_KD');
        $bulan_now = date("Ym");

        $arr_pengerjaan=array('Y'=>0,'T'=>0);
        if ($koordinator_fungsi == 'Y') {
            $data_pengerjaan = $this->berita->dashboard_pengerjaan($detail_fungsi_kd, $bulan_now);
            foreach ($data_pengerjaan as $row_pengerjaan) {
                if ($row_pengerjaan['berita_status_pengerjaan'] == 'Y') {
                    $arr_pengerjaan['Y'] = $row_pengerjaan['jml'];
                } else {
                    $arr_pengerjaan['T'] = $row_pengerjaan['jml'];
                }
            }
        } else {
            
        }
        $query = $arr_pengerjaan['Y'] + $arr_pengerjaan['T'];

        $config['total_rows'] = $query;
        $config['per_page'] = '10';
        $this->pagination->initialize($config);

        $offset = $this->uri->segment(4);

        if (empty($offset)) {
            $offset = 0;
            $data['opset'] = $offset;
            if ($koordinator_fungsi == 'Y') {
                $data['berita'] = $this->berita->get_data_berita_dikerjakan($config['per_page'], $offset, $detail_fungsi_kd, $bulan_now);
            } else {
                
            }
        } else {
            $data['opset'] = $offset;
            $data['berita'] = $this->berita->get_data_berita_dikerjakan($config['per_page'], $offset, $detail_fungsi_kd, $bulan_now);
        }
        $data['title_table'] = "Berita Yang Sudah Dikerjakan Periode " . date('M Y');

        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val'] = $skin_val;
        if ($skin_val != "") {
            $this->load->view('skins/' . $skin_val . '/berita/berita_dikerjakan', $data);
        } else {
            $this->load->view('berita/berita_today', $data);
        }
    }

    function unrecieved() {
        $this->load->model('berita/beritamodel', 'berita', TRUE);
        $config['full_tag_open'] = '<ul class="pagination tcenter">';

        $config['first_tag_open'] = '<li class="page radius2">';
        $config['first_link'] = '<<';
        $config['first_tag_close'] = '</li>';

        $config['last_tag_open'] = '<li class="page radius2">';
        $config['last_link'] = '>>';
        $config['last_tag_close'] = '</li>';

        $config['next_tag_open'] = '<li class="page radius2">';
        $config['next_link'] = '>';
        $config['next_tag_close'] = '</li>';

        $config['prev_tag_open'] = '<li class="page radius2">';
        $config['prev_link'] = '<';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page radius2">';
        $config['cur_tag_close'] = '</li>';

        $config['num_tag_open'] = '<li class="page radius2">';
        $config['num_tag_close'] = '</li>';
        $config['full_tag_close'] = '</ul>';

        $this->load->library('pagination');
        $config['uri_segment'] = 4;
        $config['base_url'] = base_url() . 'index.php/berita/berita_today';

        $this->db->order_by("berita_kd", "desc");
        $this->db->select('*');
        $this->db->from('tbl_berita');
        $this->db->join('tbl_jenis_berita', 'tbl_berita.jenis_kd= tbl_jenis_berita.jenis_kd');
        $this->db->join('tbl_sifat', 'tbl_berita.sifat_kd= tbl_sifat.sifat_kd');
        $this->db->join('tbl_perwakilan', 'tbl_perwakilan.perwakilan_kd= tbl_berita.perwakilan_kd');
        $this->db->join('tbl_derajat', 'tbl_derajat.derajat_kd= tbl_berita.derajat_kd');
        $this->db->join('tbl_disposisi', 'tbl_disposisi.arsip_kd= tbl_berita.arsip_kd');
        $this->db->join('tbl_disposisi_detail', 'tbl_disposisi_detail.disposisi_kd= tbl_disposisi.disposisi_kd');
        $this->db->where('tbl_berita.berita_disposisikan', 'Y');
        $this->db->where('tbl_disposisi_detail.detail_terima', 'T');
        $where = "tbl_berita.status_disposisi = 'Y' and tbl_disposisi_detail.detail_fungsi_kd='" . $this->session->userdata('SESSION_FUNGSI_KD') . "'";
        $this->db->where($where);
        $query = $this->db->count_all_results();

        $config['total_rows'] = $query;
        $config['per_page'] = '20';
        $this->pagination->initialize($config);

        $offset = $this->uri->segment(4);
        $data['title_table'] = "Berita Yang Belum Diterima";
        
        if (empty($offset)) {
            $offset = 0;
            $data['opset'] = $offset;
            $data['berita'] = $this->berita->get_data_berita_unrecieved($config['per_page'], $offset);
        } else {
            $data['opset'] = $offset;
            $data['berita'] = $this->berita->get_data_berita_undisposisi($config['per_page'], $offset);
        }
        
        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val'] = $skin_val;
        if ($skin_val != "") {
            $this->load->view('skins/' . $skin_val . '/berita/berita', $data);
        } else {
            $this->load->view('berita/berita_undisposed', $data);
        }
    }

    function undisposed() {
        $this->load->model('berita/beritamodel', 'berita', TRUE);
        $config['full_tag_open'] = '<ul class="pagination tcenter">';

        $config['first_tag_open'] = '<li class="page radius2">';
        $config['first_link'] = '<<';
        $config['first_tag_close'] = '</li>';

        $config['last_tag_open'] = '<li class="page radius2">';
        $config['last_link'] = '>>';
        $config['last_tag_close'] = '</li>';

        $config['next_tag_open'] = '<li class="page radius2">';
        $config['next_link'] = '>';
        $config['next_tag_close'] = '</li>';

        $config['prev_tag_open'] = '<li class="page radius2">';
        $config['prev_link'] = '<';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page radius2">';
        $config['cur_tag_close'] = '</li>';

        $config['num_tag_open'] = '<li class="page radius2">';
        $config['num_tag_close'] = '</li>';
        $config['full_tag_close'] = '</ul>';

        $this->load->library('pagination');
        $config['uri_segment'] = 4;
        $config['base_url'] = base_url() . 'index.php/berita/undisposed';

        $query_result = $this->berita->count_get_data_berita_dubes_undisposisi();

        $config['total_rows'] = $query_result[0]['jumlah'];
        $config['per_page'] = '20';
        $this->pagination->initialize($config);

        $offset = $this->uri->segment(4);

        if (empty($offset)) {
            $offset = 0;
            $data['opset'] = $offset;
            $data['berita'] = $this->berita->get_data_berita_undisposisi($config['per_page'], $offset);
        } else {
            $data['opset'] = $offset;
            $data['berita'] = $this->berita->get_data_berita_undisposisi($config['per_page'], $offset);
        }

        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val'] = $skin_val;
        if ($skin_val != "") {
            $this->load->view('skins/' . $skin_val . '/berita/berita_undisposed', $data);
        } else {
            $this->load->view('berita/berita_undisposed', $data);
        }
    }

    function doc_catatan() {

        $this->load->model('berita/beritamodel', 'berita', TRUE);
        $data['disposisi'] = $this->berita->get_disposisi($this->uri->segment(4));
        $data['nama_perwakilan'] = $this->session->userdata('nama_perwakilan');
        $data['nama_singkat_perwakilan'] = $this->session->userdata('nama_singkat_perwakilan');
        $data['nama_jabatan_kepala_perwakilan'] = $this->session->userdata('nama_jabatan_kepala_perwakilan');
        $data['alamat_perwakilan'] = $this->session->userdata('alamat_perwakilan');
        $data['email_administrator'] = $this->session->userdata('email_administrator');

        $data['keppri'] = $this->berita->detail_user(1);
        $data['pk'] = $this->berita->detail_user(2);

        $data['berita'] = $this->berita->detail_berita($this->uri->segment(4));
        $filename = "draft-" . date('ymd') . ".doc";
        header("Content-Type: application/xml; charset=UTF-8");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("content-disposition: attachment;filename=$filename");
        $this->load->view('berita/doc_catatan', $data);
        return; //needed so that any redirect() after this line doesn't mess up things, like it did in my particular case
    }

    function doc_respon() {
        $this->load->model('berita/beritamodel', 'berita', TRUE);
        $data['disposisi'] = $this->berita->get_disposisi($this->uri->segment(4));
        $data['nama_perwakilan'] = $this->session->userdata('nama_perwakilan');
        $data['nama_singkat_perwakilan'] = $this->session->userdata('nama_singkat_perwakilan');
        $data['nama_jabatan_kepala_perwakilan'] = $this->session->userdata('nama_jabatan_kepala_perwakilan');
        $data['alamat_perwakilan'] = $this->session->userdata('alamat_perwakilan');
        $data['email_administrator'] = $this->session->userdata('email_administrator');

        $data['keppri'] = $this->berita->detail_user(1);
        $data['pk'] = $this->berita->detail_user(2);

        $data['respon'] = $this->berita->get_respon($this->uri->segment(5));

        $data['berita'] = $this->berita->detail_berita($this->uri->segment(4));
        $filename = "draft-" . date('ymd') . ".doc";
        header("Content-Type: application/xml; charset=UTF-8");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("content-disposition: attachment;filename=$filename");
        $this->load->view('berita/doc_respon', $data);
        return; //needed so that any redirect() after this line doesn't mess up things, like it did in my particular case*/
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */