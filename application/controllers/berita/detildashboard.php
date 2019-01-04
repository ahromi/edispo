<?php

class Detildashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }
    
    function belumditerima() {
        if($this->session->userdata('SESSION_FUNGSI_KD') > 3){
            redirect('restricted');
        }
        $this->load->model('berita/beritamodel', 'berita', TRUE);
        $this->load->model('fungsi/fungsimodel', 'fungsi', TRUE);
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

        $fungsi_kd=$this->uri->segment(4);
        $this->load->library('pagination');
        $config['uri_segment'] = 5;
        $config['base_url'] = base_url() . 'index.php/berita/detildashboard/belumditerima/'.$fungsi_kd;
        
        $data_fungsi=array();
        $data_fungsi=  $this->fungsi->detail_fungsi($fungsi_kd);
        $bulan_now = date("Ym");
        $data['data_fungsi']=$data_fungsi;

        
        $offset = $this->uri->segment(5);

        if (empty($offset)) {
            $offset = 0;
            $data['opset'] = $offset;
        } else {
            $data['opset'] = $offset;
        }
        $jum_all_record = $this->berita->detail_dashboard_penerimaan_count($fungsi_kd, $bulan_now,"T","");
        $jum_all_record_count=0;
        if(count($jum_all_record)>0){
            $jum_all_record_count= $jum_all_record[0]['jml'];
        }
        $config['total_rows'] = $jum_all_record_count;
        $config['per_page'] = '10';
        $this->pagination->initialize($config);
        $koordinator_fungsi = $this->session->userdata('SESSION_KOORDINATOR');
//        echo $data['opset'];die();
        if ($koordinator_fungsi == 'Y') {
            $data['berita'] = $this->berita->detail_dashboard_penerimaan($fungsi_kd, $bulan_now,"T","",$config['per_page'], $data['opset']);
//            $data_pengerjaan = $this->berita->dashboard_pengerjaan($detail_fungsi_kd, $bulan_now);
//            $data_pendingan = $this->berita->dashboard_pendingan($detail_fungsi_kd, $bulan_now);
        }
        $data['title_table'] = "Daftar Berita";

        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val'] = $skin_val;
        if ($skin_val != "") {
            $this->load->view('skins/' . $skin_val . '/berita/detildashboardbelumditerima', $data);
        } else {
            $this->load->view('berita/berita', $data);
        }
    }
    
    function diterima() {
        if($this->session->userdata('SESSION_FUNGSI_KD') > 3){
            redirect('restricted');
        }
        $this->load->model('berita/beritamodel', 'berita', TRUE);
        $this->load->model('fungsi/fungsimodel', 'fungsi', TRUE);
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

        $fungsi_kd=$this->uri->segment(4);
        $this->load->library('pagination');
        $config['uri_segment'] = 5;
        $config['base_url'] = base_url() . 'index.php/berita/detildashboard/diterima/'.$fungsi_kd;
        
        $data_fungsi=array();
        $data_fungsi=  $this->fungsi->detail_fungsi($fungsi_kd);
        $bulan_now = date("Ym");
        $data['data_fungsi']=$data_fungsi;

        $offset = $this->uri->segment(5);

        if (empty($offset)) {
            $offset = 0;
            $data['opset'] = $offset;
        } else {
            $data['opset'] = $offset;
        }
        $jum_all_record = $this->berita->detail_dashboard_penerimaan_count($fungsi_kd, $bulan_now,"Y","T");
//        print_r($jum_all_record);die();
        $jum_all_record_count=0;
        if(count($jum_all_record)>0){
            $jum_all_record_count= $jum_all_record[0]['jml'];
        }
        $config['total_rows'] = $jum_all_record_count;
        $config['per_page'] = '10';
        $this->pagination->initialize($config);
        $koordinator_fungsi = $this->session->userdata('SESSION_KOORDINATOR');
        
        if ($koordinator_fungsi == 'Y') {
            $data['berita'] = $this->berita->detail_dashboard_penerimaan($fungsi_kd, $bulan_now,"Y","T",$config['per_page'], $data['opset']);
//            $data_pengerjaan = $this->berita->dashboard_pengerjaan($detail_fungsi_kd, $bulan_now);
//            $data_pendingan = $this->berita->dashboard_pendingan($detail_fungsi_kd, $bulan_now);
        }
        $data['title_table'] = "Daftar Berita";

        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val'] = $skin_val;
        if ($skin_val != "") {
            $this->load->view('skins/' . $skin_val . '/berita/detildashboardditerima', $data);
        } else {
            $this->load->view('berita/berita', $data);
        }
    }
    
    function dikerjakan() {
        if($this->session->userdata('SESSION_FUNGSI_KD') > 3){
            redirect('restricted');
        }
        $this->load->model('berita/beritamodel', 'berita', TRUE);
        $this->load->model('fungsi/fungsimodel', 'fungsi', TRUE);
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

        $fungsi_kd=$this->uri->segment(4);
        $this->load->library('pagination');
        $config['uri_segment'] = 5;
        $config['base_url'] = base_url() . 'index.php/berita/detildashboard/dikerjakan/'.$fungsi_kd;
        
        $data_fungsi=array();
        $data_fungsi=  $this->fungsi->detail_fungsi($fungsi_kd);
        $bulan_now = date("Ym");
        $data['data_fungsi']=$data_fungsi;

        $offset = $this->uri->segment(5);

        if (empty($offset)) {
            $offset = 0;
            $data['opset'] = $offset;
        } else {
            $data['opset'] = $offset;
        }
        $jum_all_record = $this->berita->detail_dashboard_pengerjaan_count($fungsi_kd, $bulan_now,"Y");
        $jum_all_record_count=0;
        if(count($jum_all_record)>0){
            $jum_all_record_count= $jum_all_record[0]['jml'];
        }
        $config['total_rows'] = $jum_all_record_count;
        $config['per_page'] = '10';
        $this->pagination->initialize($config);
        $koordinator_fungsi = $this->session->userdata('SESSION_KOORDINATOR');
        
        if ($koordinator_fungsi == 'Y') {
            $data['berita'] = $this->berita->detail_dashboard_pengerjaan($fungsi_kd, $bulan_now,"Y",$config['per_page'],$data['opset']);
        }
        $data['title_table'] = "Daftar Berita";

        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val'] = $skin_val;
        if ($skin_val != "") {
            $this->load->view('skins/' . $skin_val . '/berita/detildashboarddikerjakan', $data);
        } else {
            $this->load->view('berita/berita', $data);
        }
    }
    
    public function cetakbelumditerima() {
        if($this->session->userdata('SESSION_FUNGSI_KD') > 3){
            redirect('restricted');
        }
        $this->load->model('berita/beritamodel', 'berita', TRUE);
        $this->load->model('fungsi/fungsimodel', 'fungsi', TRUE);
        
        $fungsi_kd = $this->uri->segment(4);
        $data_fungsi=array();
        $data_fungsi=  $this->fungsi->detail_fungsi($fungsi_kd);
        $bulan_now = date("Ym");
        $data['data_fungsi']=$data_fungsi;
        $jum_all_record = $this->berita->detail_dashboard_penerimaan_count($fungsi_kd, $bulan_now,"T");
        if(count($jum_all_record)>0){
            $jum_all_record_count= $jum_all_record[0]['jml'];
        }
        $data['berita'] = $this->berita->detail_dashboard_penerimaan($fungsi_kd, $bulan_now,"T",$jum_all_record_count,0);
        
//        echo '<pre>';
//        print_r($data['instruksi_disposisi']);
//        echo '</pre>';
        
        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val'] = $skin_val;
        if ($skin_val != "") {
            $this->load->view('skins/' . $skin_val . '/berita/cetakdaftarberita', $data);
        } else {
            $this->load->view('berita/print', $data);
        }

        
    }
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */