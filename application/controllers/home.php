<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index() {
        $skin_val = $this->config->item('skin');
        $this->load->model('berita/beritamodel', 'berita', TRUE);
        $this->load->model('berita/beritakeluarmodel', 'beritakeluar', TRUE);
        $this->load->model('fungsi/fungsimodel', 'fungsi', TRUE);
        $berita_fungsi_disposisi=$this->session->userdata('SESSION_FUNGSI_KD');
        $data_undisposed = $this->berita->get_count_undisposed($berita_fungsi_disposisi);
        $data['undisposed'] = $data_undisposed;
        
//        $data_session=  $this->session->userdata;
//        echo "<pre>";
//        print_r($data_session);
//        echo "</pre>";
//        die();
        //cek penerimaan berita fungsi koordinator
        $data_session = $this->session->userdata;
        $user_kd=$data_session['SESSION_ID'];
        $koordinator_fungsi = $this->session->userdata('SESSION_KOORDINATOR');
        $detail_fungsi_kd = $data_session['SESSION_FUNGSI_KD'];
        $bulan_now = date("Ym");
        
        //doughnut statistic
        $data_statistic_doughnut = $this->berita->statistic_beritamasuk($bulan_now);
        $data['data_statistic_doughnut']=$data_statistic_doughnut;
        //end doughnut statistic

        $arr_penerimaan = array('Y' => 0, 'T' => 0);
        $arr_pengerjaan = array('Y' => 0, 'T' => 0);
        $arr_pendingan = 0;
        if ($koordinator_fungsi == 'Y') {
            $data_penerimaan = $this->berita->dashboard_penerimaan($detail_fungsi_kd, $bulan_now);
            $data_pengerjaan = $this->berita->dashboard_pengerjaan($detail_fungsi_kd, $bulan_now);
            $data_pendingan = $this->berita->dashboard_pendingan($detail_fungsi_kd, $bulan_now);
        }else{
            $data_penerimaan = $this->berita->dashboard_penerimaan_lanjutan($user_kd, $bulan_now);
            $data_pengerjaan = $this->berita->dashboard_pengerjaan_lanjutan($user_kd, $bulan_now);
            $data_pendingan = $this->berita->dashboard_pendingan_lanjutan($detail_fungsi_kd, $bulan_now);
        }
        $arr_statistics = array();
        $data_statistic_bar = $this->berita->statistic_penerimaan($bulan_now);
        $data_statistic_bar_pengerjaan = $this->berita->statistic_pengerjaan($bulan_now);
        $data_statistic_terdispo = $this->berita->statistic_terdispo($bulan_now);
        $data['data_statistic_terdispo']=$data_statistic_terdispo;
        $data_fungsi_all = $this->fungsi->get_data_fungsi_all(30,0);
        foreach ($data_fungsi_all as $row_fungsi) {
            $arr_statistics[$row_fungsi['fungsi_kd']] = array(
                'nama_fungsi' => $row_fungsi['nama_fungsi'],
                'terima_Y' => 0,
                'terima_T' => 0,
                'dikerjakan' => 0
            );
        }
        
        foreach($data_statistic_bar_pengerjaan as $row_dikerjakan){
            $arr_statistics_sisa[$row_dikerjakan['detail_fungsi_kd']]= $row_dikerjakan['jml'];
        }

        foreach ($data_statistic_bar as $row_statistic_bar) {
            $arr_statistics[$row_statistic_bar['detail_fungsi_kd']]['nama_fungsi'] = $row_statistic_bar['nama_fungsi'];
            if ($row_statistic_bar['detail_terima'] == 'Y') {
                $pengurang=isset($arr_statistics_sisa[$row_statistic_bar['detail_fungsi_kd']])?$arr_statistics_sisa[$row_statistic_bar['detail_fungsi_kd']]:0;
                $arr_statistics[$row_statistic_bar['detail_fungsi_kd']]['terima_Y'] = $row_statistic_bar['jml']-$pengurang;
            } else {
                $arr_statistics[$row_statistic_bar['detail_fungsi_kd']]['terima_T'] = $row_statistic_bar['jml'];
            }
        }

//        echo "<pre>";
//        print_r($data_statistic_bar);
//        echo "</pre>";
//        die();
        
        foreach ($data_statistic_bar_pengerjaan as $row_statistic_bar_pengerjaan) {
            $arr_statistics[$row_statistic_bar_pengerjaan['detail_fungsi_kd']]['dikerjakan'] = $row_statistic_bar_pengerjaan['jml'];
        }
        
        $rox_x=0;
        $arr_statistics_split=array();
        foreach($arr_statistics as $key=>$row_split_statistic){
            $arr_statistics_split[$key]=$row_split_statistic;
            $rox_x++;
        }
        
        $arr_statistic_fungsi_split[0]=array(45,42,2,34,33,32,31,30);
        $arr_statistic_fungsi_split[1]=array(37,41,40,39,38,43,35);
        
        $data['arr_statistic_fungsi_split']=$arr_statistic_fungsi_split;
        $data['data_statistics_bar'] = $arr_statistics_split;
        

        
        foreach ($data_penerimaan as $row_penerimaan) {
            if ($row_penerimaan['detail_terima'] == 'Y') {
                $arr_penerimaan['Y'] = $row_penerimaan['jml'];
            } else {
                $arr_penerimaan['T'] = $row_penerimaan['jml'];
            }
        }

        foreach ($data_pengerjaan as $row_pengerjaan) {
            if ($row_pengerjaan['berita_status_pengerjaan'] == 'Y') {
                $arr_pengerjaan['Y'] = $row_pengerjaan['jml'];
            } else {
                $arr_pengerjaan['T'] = $row_pengerjaan['jml'];
            }
        }
        $arr_pendingan = isset($data_pendingan[0]['jml'])?$data_pendingan[0]['jml']:0;

        $data['arr_penerimaan'] = $arr_penerimaan;
        $data['arr_pengerjaan'] = $arr_pengerjaan;
        $data['arr_pendingan'] = $arr_pendingan;

        //data berita keluar
//        allow only dubes, kom dan setpim
        if($detail_fungsi_kd <4){
            $detail_fungsi_kd=0;
        }
        $data_berita_keluar=  $this->beritakeluar->jml_berita_keluar($detail_fungsi_kd,$bulan_now);
        $data['berita_keluar']=$data_berita_keluar[0]['jml'];

        if ($skin_val != "") {
            if($this->session->userdata('SESSION_FUNGSI_KD') == 1 || $this->session->userdata('SESSION_FUNGSI_KD')==2 || $this->session->userdata('SESSION_FUNGSI_KD')==3){
                $this->load->view('skins/' . $skin_val . '/welcome_message_dubes', $data);
            }else{
                $this->load->view('skins/' . $skin_val . '/welcome_message', $data);
            }
            
        } else {
            $this->load->view('welcome_message');
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */