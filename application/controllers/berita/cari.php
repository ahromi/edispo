<?php

class Cari extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    function index() {
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
        $config['base_url'] = base_url() . 'index.php/berita/cari/index';

        $data = array();
        $this->load->model('berita/beritamodel', 'berita', TRUE);
        if (!empty($_POST['CARI'])) {
            $key1 = $_POST['arsip_kd'];
            $key2 = $_POST['berita_kd'];
            $key3 = $_POST['perihal_berita'];
            $key4 = $_POST['tgl_mulai'];
            $key5 = $_POST['tgl_akhir'];

            $this->session->set_userdata('key1', $key1);
            $this->session->set_userdata('key2', $key2);
            $this->session->set_userdata('key3', $key3);
            $this->session->set_userdata('key4', $key4);
            $this->session->set_userdata('key5', $key5);

            $this->db->order_by("tgl_berita", "desc");
            $this->db->select('*');
            $this->db->from('tbl_berita');
            $this->db->join('tbl_jenis_berita', 'tbl_berita.jenis_kd= tbl_jenis_berita.jenis_kd');
            $this->db->join('tbl_sifat', 'tbl_berita.sifat_kd= tbl_sifat.sifat_kd');
            $this->db->join('tbl_perwakilan', 'tbl_perwakilan.perwakilan_kd= tbl_berita.perwakilan_kd');
            $this->db->join('tbl_derajat', 'tbl_derajat.derajat_kd= tbl_berita.derajat_kd');
            if (!empty($key4) && !empty($key5)) {
                $where = "tbl_berita.tgl_berita between CAST('$key4' as DATETIME) and CAST('$key5' as DATETIME)";
                $this->db->where($where);
            }
            $this->db->like('tbl_berita.arsip_kd', $key1);
            $this->db->like('tbl_berita.berita_kd', $key2);
            $this->db->like('tbl_berita.perihal_berita', $key3);
            if ($this->session->userdata('SESSION_HOME_STAFF') == 'T') {
                $this->db->where('tbl_berita.sifat_kd', 2);
            }
            $query = $this->db->count_all_results();

            $config['total_rows'] = $query;
            $config['per_page'] = 10;
            $this->pagination->initialize($config);

            $offset = 0;

//            tanpa paging
            $data['berita'] = $this->berita->search_data_berita_paging($key1, $key2, $key3, $key4, $key5);
            $data['opset'] = $offset;
//            if (empty($offset)) {
//                $offset = 0;
//                $data['opset'] = $offset;
//                $data['berita'] = $this->berita->search_data_berita_paging($key1, $key2, $key3, $key4, $key5, $config['per_page'], $offset);
//            } else {
//                $data['opset'] = $offset;
//                $data['berita'] = $this->berita->search_data_berita_paging($key1, $key2, $key3, $key4, $key5, $config['per_page'], $offset);
//            }
            $this->session->set_flashdata('arsip', $_POST['arsip_kd']);
//            echo $config['per_page'];echo "|".$offset;die();
        }

//        echo "<pre>";
//print_r($data);
//echo "</pre>";
//die();
        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val'] = $skin_val;
        if ($skin_val != "") {
            $this->load->view('skins/' . $skin_val . '/berita/cari', $data);
        } else {
            $this->load->view('berita/cari', $data);
        }
    }

    function index_fungsi() {
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
        $config['base_url'] = base_url() . 'index.php/berita/cari/index_fungsi';

        $data = array();
        $this->load->model('berita/beritamodel', 'berita', TRUE);
        if (!empty($_POST['CARI'])) {
            $key1 = $_POST['arsip_kd'];
            $key2 = $_POST['berita_kd'];
            $key3 = $_POST['perihal_berita'];
            $key4 = $_POST['tgl_mulai'];
            $key5 = $_POST['tgl_akhir'];

            $this->session->set_userdata('key1', $key1);
            $this->session->set_userdata('key2', $key2);
            $this->session->set_userdata('key3', $key3);
            $this->session->set_userdata('key4', $key4);
            $this->session->set_userdata('key5', $key5);

            $this->db->order_by("tbl_berita.tgl_berita", "desc");
            $this->db->select('*');
            $this->db->from('tbl_berita');
            $this->db->join('tbl_jenis_berita', 'tbl_berita.jenis_kd= tbl_jenis_berita.jenis_kd');
            $this->db->join('tbl_sifat', 'tbl_berita.sifat_kd= tbl_sifat.sifat_kd');
            $this->db->join('tbl_perwakilan', 'tbl_perwakilan.perwakilan_kd= tbl_berita.perwakilan_kd');
            $this->db->join('tbl_derajat', 'tbl_derajat.derajat_kd= tbl_berita.derajat_kd');
            $this->db->where('tbl_berita.berita_disposisikan', 'Y');
            if (!empty($key4) && !empty($key5)) {
                $where = "tbl_berita.tgl_berita between CAST('$key4' as DATETIME) and CAST('$key5' as DATETIME)";
                $this->db->where($where);
            }
            $this->db->like('tbl_berita.arsip_kd', $key1);
            $this->db->like('tbl_berita.berita_kd', $key2);
            $this->db->like('tbl_berita.perihal_berita', $key3);
            $query = $this->db->count_all_results();

            $config['total_rows'] = $query;
            $config['per_page'] = '10';
            $this->pagination->initialize($config);

            $offset = $this->uri->segment(4);

            if (empty($offset)) {
                $offset = 0;
                $data['opset'] = $offset;
            } else {
                $data['opset'] = $offset;
            }

            $this->session->set_flashdata('arsip', $_POST['arsip_kd']);

            if ($this->session->userdata('SESSION_DISPOSISI_FUNGSI') == 'Y') {
                $data['berita'] = $this->berita->search_data_berita_pendispo($key1, $key2, $key3, $key4, $key5, $config['per_page'], $offset);
            } else {
                $data['berita'] = $this->berita->search_data_berita_fungsi($key1, $key2, $key3, $key4, $key5, $config['per_page'], $offset);
            }
        }



        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val'] = $skin_val;
        if ($skin_val != "") {
            $this->load->view('skins/' . $skin_val . '/berita/cari', $data);
        } else {
            $this->load->view('berita/cari', $data);
        }
    }

    function index_lanjutan() {
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
        $config['base_url'] = base_url() . 'index.php/berita/cari/index_lanjutan';

        $data = array();
        $this->load->model('berita/beritamodel', 'berita', TRUE);
        if (!empty($_POST['CARI'])) {
            $key1 = $_POST['arsip_kd'];
            $key2 = $_POST['berita_kd'];
            $key3 = $_POST['perihal_berita'];
            $key4 = $_POST['tgl_mulai'];
            $key5 = $_POST['tgl_akhir'];

            $this->session->set_userdata('key1', $key1);
            $this->session->set_userdata('key2', $key2);
            $this->session->set_userdata('key3', $key3);
            $this->session->set_userdata('key4', $key4);
            $this->session->set_userdata('key5', $key5);

            $this->db->order_by("tbl_berita.tgl_berita", "desc");
            $this->db->select('*');
            $this->db->from('tbl_berita');
            $this->db->join('tbl_jenis_berita', 'tbl_berita.jenis_kd= tbl_jenis_berita.jenis_kd');
            $this->db->join('tbl_sifat', 'tbl_berita.sifat_kd= tbl_sifat.sifat_kd');
            $this->db->join('tbl_perwakilan', 'tbl_perwakilan.perwakilan_kd= tbl_berita.perwakilan_kd');
            $this->db->join('tbl_derajat', 'tbl_derajat.derajat_kd= tbl_berita.derajat_kd');
            $this->db->where('tbl_berita.berita_disposisikan', 'Y');
            if (!empty($key4) && !empty($key5)) {
                $where = "tbl_berita.tgl_berita between CAST('$key4' as DATETIME) and CAST('$key5' as DATETIME)";
                $this->db->where($where);
            }
            $this->db->like('tbl_berita.arsip_kd', $key1);
            $this->db->like('tbl_berita.berita_kd', $key2);
            $this->db->like('tbl_berita.perihal_berita', $key3);
            $query = $this->db->count_all_results();

            $config['total_rows'] = $query;
            $config['per_page'] = '10';
            $this->pagination->initialize($config);

            $offset = $this->uri->segment(4);

            if (empty($offset)) {
                $offset = 0;
                $data['opset'] = $offset;
            } else {
                $data['opset'] = $offset;
            }

            $this->session->set_flashdata('arsip', $_POST['arsip_kd']);
            
            $data['berita'] = $this->berita->search_data_berita_fungsi_lanjutan($key1, $key2, $key3, $key4, $key5, $config['per_page'], $offset);
        }

        

        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val'] = $skin_val;
        if ($skin_val != "") {
            $this->load->view('skins/' . $skin_val . '/berita/cari', $data);
        } else {
            $this->load->view('berita/cari', $data);
        }
    }

    function index_dubes() {
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
        $config['base_url'] = base_url() . 'index.php/berita/cari/index_dubes';

        $data = array();
        $this->load->model('berita/beritamodel', 'berita', TRUE);
        if (!empty($_POST['CARI'])) {
            $key1 = $_POST['arsip_kd'];
            $key2 = $_POST['berita_kd'];
            $key3 = $_POST['perihal_berita'];
            $key4 = $_POST['tgl_mulai'];
            $key5 = $_POST['tgl_akhir'];

            $this->session->set_userdata('key1', $key1);
            $this->session->set_userdata('key2', $key2);
            $this->session->set_userdata('key3', $key3);
            $this->session->set_userdata('key4', $key4);
            $this->session->set_userdata('key5', $key5);

            $this->db->order_by("tbl_berita.tgl_berita", "desc");
            $this->db->select('*');
            $this->db->from('tbl_berita');
            $this->db->join('tbl_jenis_berita', 'tbl_berita.jenis_kd= tbl_jenis_berita.jenis_kd');
            $this->db->join('tbl_sifat', 'tbl_berita.sifat_kd= tbl_sifat.sifat_kd');
            $this->db->join('tbl_perwakilan', 'tbl_perwakilan.perwakilan_kd= tbl_berita.perwakilan_kd');
            $this->db->join('tbl_derajat', 'tbl_derajat.derajat_kd= tbl_berita.derajat_kd');
            $this->db->where('tbl_berita.berita_disposisikan', 'Y');
            if (!empty($key4) && !empty($key5)) {
                $where = "tbl_berita.tgl_berita between CAST('$key4' as DATETIME) and CAST('$key5' as DATETIME)";
                $this->db->where($where);
            }
            $this->db->like('tbl_berita.arsip_kd', $key1);
            $this->db->like('tbl_berita.berita_kd', $key2);
            $this->db->like('tbl_berita.perihal_berita', $key3);
            $query = $this->db->count_all_results();

            $config['total_rows'] = $query;
            $config['per_page'] = '10';
            $this->pagination->initialize($config);

            $offset = $this->uri->segment(4);

            if (empty($offset)) {
                $offset = 0;
                $data['opset'] = $offset;
                $data['berita'] = $this->berita->search_data_berita_dubes($key1, $key2, $key3, $key4, $key5, $config['per_page'], $offset);
            } else {
                $data['opset'] = $offset;
                $data['berita'] = $this->berita->search_data_berita_dubes($key1, $key2, $key3, $key4, $key5, $config['per_page'], $offset);
            }

            $this->session->set_flashdata('arsip', $_POST['arsip_kd']);
        }

        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val'] = $skin_val;
        if ($skin_val != "") {
            $this->load->view('skins/' . $skin_val . '/berita/cari', $data);
        } else {
            $this->load->view('berita/cari', $data);
        }
    }

}

/* End of file welcome.php */
    /* Location: ./system/application/controllers/welcome.php */    