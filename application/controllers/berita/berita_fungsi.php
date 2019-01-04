<?php

class Berita_fungsi extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
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
        $config['base_url'] = base_url() . 'index.php/berita/berita_fungsi/index';

        $this->db->order_by("tbl_berita.arsip_kd", "desc");
        $this->db->select('*');
        $this->db->from('tbl_berita');
        $this->db->join('tbl_jenis_berita', 'tbl_berita.jenis_kd= tbl_jenis_berita.jenis_kd');
        $this->db->join('tbl_sifat', 'tbl_berita.sifat_kd= tbl_sifat.sifat_kd');
        $this->db->join('tbl_perwakilan', 'tbl_perwakilan.perwakilan_kd= tbl_berita.perwakilan_kd');
        $this->db->join('tbl_derajat', 'tbl_derajat.derajat_kd= tbl_berita.derajat_kd');
        $this->db->join('tbl_disposisi', 'tbl_disposisi.arsip_kd=tbl_berita.arsip_kd');
        $this->db->join('tbl_disposisi_detail', 'tbl_disposisi_detail.disposisi_kd=tbl_disposisi.disposisi_kd');
        $this->db->where('tbl_disposisi_detail.detail_fungsi_kd', $this->session->userdata('SESSION_FUNGSI_KD'));

        $query = $this->db->count_all_results();

        $config['total_rows'] = $query;
        $config['per_page'] = '20';
        $this->pagination->initialize($config);

        $offset = $this->uri->segment(4);

        if (empty($offset)) {
            $offset = 0;
            $data['opset'] = $offset;
            $data['berita'] = $this->berita->get_data_berita_fungsi($config['per_page'], $offset);
            if ($this->session->userdata('SESSION_FUNGSI_KD') == 3 || $this->session->userdata('SESSION_FUNGSI_KD') == 30) {
                $data['biasa'] = $this->berita->get_data_berita_dcm($config['per_page'], $offset);
            }
            
        } else {
            $data['opset'] = $offset;
            $data['berita'] = $this->berita->get_data_berita_fungsi($config['per_page'], $offset);
            if ($this->session->userdata('SESSION_FUNGSI_KD') == 3 || $this->session->userdata('SESSION_FUNGSI_KD') == 30) {
                $data['biasa'] = $this->berita->get_data_berita_dcm($config['per_page'], $offset);
            }
            
        }
        $data['title_table']="Berita Fungsi";
        
        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val'] = $skin_val;
        if ($skin_val != "") {
            $this->load->view('skins/' . $skin_val . '/berita/berita', $data);
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
        $config['base_url'] = base_url() . 'index.php/berita/berita_fungsi/berita_today';
        //$config['base_url'] = base_url().'index.php/berita/berita_fungsi/berita_today';

        $this->db->order_by("berita_kd", "desc");
        $this->db->select('*');
        $this->db->from('tbl_berita');
        $this->db->join('tbl_jenis_berita', 'tbl_berita.jenis_kd= tbl_jenis_berita.jenis_kd');
        $this->db->join('tbl_sifat', 'tbl_berita.sifat_kd= tbl_sifat.sifat_kd');
        $this->db->join('tbl_disposisi', 'tbl_disposisi.arsip_kd=tbl_berita.arsip_kd');
        $this->db->join('tbl_disposisi_detail', 'tbl_disposisi_detail.disposisi_kd=tbl_disposisi.disposisi_kd');
        $where = "tbl_berita.tgl_diarsipkan = '" . date('Y-m-d' . "'");
        $this->db->where($where);
        $this->db->where('tbl_disposisi_detail.detail_fungsi_kd', $this->session->userdata('SESSION_FUNGSI_KD'));
        //$this->db->where('tbl_disposisi_detail.detail_fungsi_kd',$this->session->userdata('SESSION_FUNGSI_KD'));
        $query = $this->db->count_all_results();
        $config['total_rows'] = $query;
        $config['per_page'] = '20';
        $this->pagination->initialize($config);

        $offset = $this->uri->segment(4);

        if (empty($offset)) {
            $offset = 0;
            $data['opset'] = $offset;
            $data['berita'] = $this->berita->get_data_berita_fungsi_today($config['per_page'], $offset);

            
        } else {
            $data['opset'] = $offset;
            $data['berita'] = $this->berita->get_data_berita_fungsi_today($config['per_page'], $offset);
            
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
        $config['base_url'] = base_url() . 'index.php/berita/berita_fungsi/undisposed';

        $this->db->select('*');
        $this->db->from('tbl_berita');
        $this->db->join('tbl_jenis_berita', 'tbl_berita.jenis_kd= tbl_jenis_berita.jenis_kd');
        $this->db->join('tbl_sifat', 'tbl_berita.sifat_kd= tbl_sifat.sifat_kd');
        $this->db->join('tbl_perwakilan', 'tbl_perwakilan.perwakilan_kd= tbl_berita.perwakilan_kd');
        $this->db->join('tbl_derajat', 'tbl_derajat.derajat_kd= tbl_berita.derajat_kd');
        $this->db->join('tbl_fungsi', 'tbl_fungsi.fungsi_kd=tbl_berita.berita_fungsi_disposisi');
        //$this->db->join('tbl_disposisi', 'tbl_disposisi.arsip_kd=tbl_berita.arsip_kd');
        //$this->db->join('tbl_disposisi_detail', 'tbl_disposisi_detail.disposisi_kd=tbl_disposisi.disposisi_kd');
        //$this->db->where($where);
        $this->db->order_by('tbl_berita.arsip_kd', 'desc');
        $this->db->where('tbl_berita.berita_fungsi_disposisi', $this->session->userdata('SESSION_FUNGSI_KD'));
        $this->db->where('tbl_berita.berita_disposisikan', 'Y');
        $this->db->where('tbl_berita.status_disposisi', 'T');
        //$this->db->where('tbl_disposisi_detail.detail_fungsi_kd',$this->session->userdata('SESSION_LEVEL_KD'));
        $query = $this->db->count_all_results();

        $config['total_rows'] = $query;
        $config['per_page'] = '20';
        $this->pagination->initialize($config);

        $offset = $this->uri->segment(4);

        if (empty($offset)) {
            $offset = 0;
            $data['opset'] = $offset;
            $data['berita'] = $this->berita->get_data_berita_fungsi_undisposisi($config['per_page'], $offset);

        } else {
            $data['opset'] = $offset;
            $data['berita'] = $this->berita->get_data_berita_fungsi_undisposisi($config['per_page'], $offset);
            
        }
        $data['title_table'] = "Berita Menunggu Disposisi";
        
        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val'] = $skin_val;
        if ($skin_val != "") {
            $this->load->view('skins/' . $skin_val . '/berita/berita_undisposed', $data);
        } else {
            $this->load->view('berita/berita_undisposed', $data);
        }
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */