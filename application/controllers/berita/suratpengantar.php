<?php

class Suratpengantar extends CI_Controller {

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
        
        $arr_pwk = array(
            'CHG' => 'Chicago',
            'HST' => 'Houston',
            'SFC' => 'San Francisco'
        );

        $this->load->library('pagination');
        $config['uri_segment'] = 4;
        $config['base_url'] = base_url() . 'index.php/berita/suratpengantar/index';

        $data = array();
        $this->load->model('suratpengantar/suratpengantarmodel', 'suratpengantar', TRUE);
        $active_tab = 1;
        if (!empty($_POST['CARI'])) {
            $active_tab = 2;
            $key1 = $_POST['arsip_kd'];
            $key2 = $_POST['berita_kd'];
            $key3 = $_POST['perihal_berita'];
            $key4 = $_POST['tgl_mulai'];
            $key5 = $_POST['tgl_akhir'];
            $data['suratpengantar'] = $this->suratpengantar->search_data_suratpengantar($key1, $key2, $key3, $key4, $key5);
            $data['arr_pwk']=$arr_pwk;
            
        }

        $data_avail_sp = $this->suratpengantar->get_available_print();
        $data['data_avail_sp'] = $data_avail_sp;
        $data['active_tab'] = $active_tab;
//        echo "<pre>";
//print_r($data['suratpengantar']);
//echo "</pre>";
//die();
        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val'] = $skin_val;
        if ($skin_val != "") {
            $this->load->view('skins/' . $skin_val . '/berita/suratpengantar', $data);
        } else {
            $this->load->view('berita/cari', $data);
        }
    }

    function cetak() {
//        $date_session=$this->session->userdata;
//        echo '<pre>';
//        print_r($date_session);
//        echo '</pre>';
//        die();
        $pwk_code = $this->uri->segment(4);
        $this->load->library('Pdf');

        //model
        $this->load->model('suratpengantar/suratpengantarmodel', 'suratpengantar', TRUE);
        $this->load->model('cetaksp/cetakspmodel', 'cetaksp', TRUE);

        $pdf = new Pdf('P', 'mm', 'letter', true, 'UTF-8', false);
        $pdf->SetTitle('Surat Pengantar');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetAutoPageBreak(true);
        $pdf->SetAuthor('Pusat Komunikasi KJRI Kuching');
        $pdf->SetDisplayMode('real', 'default');

        //available sp number
        $arr_roman = array(
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII'
        );
        $arr_pwk = array(
            'CHG' => 'Chicago',
            'HST' => 'Houston',
            'SFC' => 'San Francisco'
        );
        $arr_bulan = array(
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        );
        $pwk_code = $this->uri->segment(4);
        $cek_kawat = $this->suratpengantar->get_available_print($pwk_code);
        
        if (count($cek_kawat)>0) {
            $last_number = $this->suratpengantar->get_last_number($pwk_code);
            if ($last_number[0]['jml'] == 0) {
                $new_number = "01";
                $new_number_num = $last_number[0]['jml'] + 1;
            } else {
//                $kode_arsip = $this->berita->code_generator();
//                $div = explode("-", $kode_arsip[0]['arsip_kd']);
//                $str = $div[2];
//                $kode_jadi = (int) $str + 1;
                $new_number = $last_number[0]['jml'] + 1;
                $new_number_num = $last_number[0]['jml'] + 1;

                switch (strlen($new_number)) {
                    case 1:
                        $new_number = "0" . $new_number;
                        break;
                }
            }
            $sp_number_jadi = $new_number . "/" . "SP" . "/" . "WSH-" . $pwk_code . "/" . $arr_roman[date('n')] . "/" . date("y");
        } else {
            $pdf->AddPage();
            $header_kbri = "PERHATIAN<BR>Surat pengantar tidak dapat dicetak<br>- Cek Apakah Surat Pengantar sudah dicetak sebelumnya?<br>- Cek di Archive";
            $pdf->writeHTMLCell(190, '', '', '', $header_kbri, 1, 1, 0, FALSE, 'C', true);
            $pdf->Output('My-File-Name.pdf', 'I');
            die();
        }

        //insert sp number
        $this->cetaksp->tambah(array('sp_number' => $sp_number_jadi));
        $data_sp_id = $this->cetaksp->get_by_sp_number($sp_number_jadi);
        if (count($data_sp_id) > 0) {
            $sp_id=$data_sp_id[0]['sp_id'];
        } else {
            $pdf->AddPage();
            $header_kbri = "PERHATIAN<BR>Surat pengantar tidak dapat dicetak<br>Gagal menyimpan nomor surat pengantar";
            $pdf->writeHTMLCell(190, '', '', '', $header_kbri, 1, 1, 0, FALSE, 'C', true);
            $pdf->Output('My-File-Name.pdf', 'I');
            die();
        }
        //update to claim by spid
        $this->suratpengantar->update_available_print($pwk_code,$sp_id);
        //load all unclaim berita and set sp id
        $data_all_unclaim=$this->suratpengantar->get_list_unclaim($pwk_code,$sp_id);
        if(count($data_all_unclaim>0)){
            $data_row="";
            $n=1;
            foreach ($data_all_unclaim as $row_unclaim){
                $data_row.="<tr>";
                $data_row.='<td width="30" align="center" style="vertical-align: middle;">'.$n.'</td>
        <td width="250" align="left">&nbsp;'.$row_unclaim['berita_kd'].'</td>
        <td width="120" align="center">'.$row_unclaim['halaman'].'</td>
        <td width="140" align="left">&nbsp;'.$row_unclaim['keterangan'].'</td>';
                $data_row.="</tr>";
                $n++;
            }
        }else{
            $pdf->AddPage();
            $header_kbri = "PERHATIAN<BR>Surat pengantar tidak dapat dicetak<br>Tidak ada berita";
            $pdf->writeHTMLCell(190, '', '', '', $header_kbri, 1, 1, 0, FALSE, 'C', true);
            $pdf->Output('My-File-Name.pdf', 'I');
            die();
        }
//        echo '<pre>';
//        print_r($data_row);
//        echo '</pre>';
//        die();
        $pdf->AddPage();
        $header_kbri = "KONSULAT JENDERAL REPUBLIK INDONESIA<BR>KUCHING<br>FUNGSI KOMUNIKASI";
        $pdf->writeHTMLCell(90, '', '', '', $header_kbri, 0, 1, 0, FALSE, 'C', true);
        $header_penerima = "Kepada Yth.<br>Kepala Perwakilan R.I.<br>di<br>" . $arr_pwk[$pwk_code] . "<br>U.p. : Kepala Kanselerai";
        $pdf->writeHTMLCell(90, 100, 150, '', $header_penerima, 0, 1, 0, FALSE, 'L', true);
        $nomor_surat = "<strong><u>SURAT PENGANTAR</u><br>No. : " . $sp_number_jadi . "</strong>";
        $pdf->writeHTMLCell(190, 13, 10, 59, $nomor_surat, 0, 1, 0, FALSE, 'C', true);
        //table
        $tbl = <<<EOD
<table cellspacing="0" cellpadding="1" border="1">
    <tr style="vertical-align: middle;">
        <td width="30" align="center" style="vertical-align: middle;">NO.</td>
        <td width="250" align="center">BERITA YANG DIKIRIM</td>
        <td width="120" align="center">JUMLAH HALAMAN</td>
        <td width="140" align="center">KETERANGAN</td>
    </tr>
                $data_row
</table>
                
EOD;

        $pdf->writeHTML($tbl, true, false, false, false, '');
        $petugas = "Kuching, " . date("d") . " " . $arr_bulan[date('n')] . " " . date('Y') . "<br>Petugas Komunikasi<br><br><br><br>" . ucwords($this->session->userdata('SESSION_NAMALENGKAP'));
        $pdf->writeHTMLCell(90, '', 120, '', $petugas, 0, 1, 0, FALSE, 'C', true);
        $footer_left_a = '<table border="0" width="600">'
                . '<tr><td width="100">Diterima Oleh<br></td><td width="10">:</td><td></td></tr>'
                . '<tr><td>Tgl/jam</td><td>:</td><td></td></tr>'
                . '<tr><td>NB</td><td width="10">:</td><td width="300">Mohon SP yang telah ditandatangani dikirim<br>kembali ke KJRI Kuching <u><strong>melalui sarana VPN</strong></u></td></tr>'
                . '</table>';
        $pdf->writeHTMLCell(600, '', '', '', $footer_left_a, 0, 0, 0, FALSE, 'L', false);
        $pdf->Output('My-File-Name.pdf', 'I');
    }

    function cetakarsip() {
//        $date_session=$this->session->userdata;
//        echo '<pre>';
//        print_r($date_session);
//        echo '</pre>';
//        die();
        $pwk_code = $this->uri->segment(4);
        $this->load->library('Pdf');

        //model
        $this->load->model('suratpengantar/suratpengantarmodel', 'suratpengantar', TRUE);
        $this->load->model('cetaksp/cetakspmodel', 'cetaksp', TRUE);

        $pdf = new Pdf('P', 'mm', 'letter', true, 'UTF-8', false);
        $pdf->SetTitle('Surat Pengantar');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetAutoPageBreak(true);
        $pdf->SetAuthor('Pusat Komunikasi KJRI Kuching');
        $pdf->SetDisplayMode('real', 'default');

        //available sp number
        $arr_roman = array(
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII'
        );
        $arr_pwk = array(
            'CHG' => 'Chicago',
            'HST' => 'Houston',
            'SFC' => 'San Francisco'
        );
        $arr_bulan = array(
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        );
        $pwk_code = $this->uri->segment(4);
        $sp_id = $this->uri->segment(5);
        
        $data_all_unclaim=$this->suratpengantar->get_list_unclaim($pwk_code,$sp_id);
        if(count($data_all_unclaim>0)){
            $data_row="";
            $n=1;
            foreach ($data_all_unclaim as $row_unclaim){
                $sp_number_jadi=$row_unclaim['sp_number'];
                $data_row.="<tr>";
                $data_row.='<td width="30" align="center" style="vertical-align: middle;">'.$n.'</td>
        <td width="250" align="left">&nbsp;'.$row_unclaim['berita_kd'].'</td>
        <td width="120" align="center">'.$row_unclaim['halaman'].'</td>
        <td width="140" align="left">&nbsp;'.$row_unclaim['keterangan'].'</td>';
                $data_row.="</tr>";
                $n++;
            }
        }else{
            $pdf->AddPage();
            $header_kbri = "PERHATIAN<BR>Surat pengantar tidak dapat dicetak<br>Tidak ada berita";
            $pdf->writeHTMLCell(190, '', '', '', $header_kbri, 1, 1, 0, FALSE, 'C', true);
            $pdf->Output('My-File-Name.pdf', 'I');
            die();
        }
//        echo '<pre>';
//        print_r($data_row);
//        echo '</pre>';
//        die();
        $pdf->AddPage();
        $header_kbri = "KONSULAT JENDERAL REPUBLIK INDONESIA<BR>KUCHING<br>FUNGSI KOMUNIKASI";
        $pdf->writeHTMLCell(90, '', '', '', $header_kbri, 0, 1, 0, FALSE, 'C', true);
        $header_penerima = "Kepada Yth.<br>Kepala Perwakilan R.I.<br>di<br>" . $arr_pwk[$pwk_code] . "<br>U.p. : Kepala Kanselerai";
        $pdf->writeHTMLCell(90, 100, 150, '', $header_penerima, 0, 1, 0, FALSE, 'L', true);
        $nomor_surat = "<strong><u>SURAT PENGANTAR</u><br>No. : " . $sp_number_jadi . "</strong>";
        $pdf->writeHTMLCell(190, 13, 10, 59, $nomor_surat, 0, 1, 0, FALSE, 'C', true);
        //table
        $tbl = <<<EOD
<table cellspacing="0" cellpadding="1" border="1">
    <tr style="vertical-align: middle;">
        <td width="30" align="center" style="vertical-align: middle;">NO.</td>
        <td width="250" align="center">BERITA YANG DIKIRIM</td>
        <td width="120" align="center">JUMLAH HALAMAN</td>
        <td width="140" align="center">KETERANGAN</td>
    </tr>
                $data_row
</table>
                
EOD;

        $pdf->writeHTML($tbl, true, false, false, false, '');
        $petugas = "Kuching, " . date("d") . " " . $arr_bulan[date('m')] . " " . date('Y') . "<br>Petugas Komunikasi<br><br><br><br>" . ucwords($this->session->userdata('SESSION_NAMALENGKAP'));
        $pdf->writeHTMLCell(90, '', 120, '', $petugas, 0, 1, 0, FALSE, 'C', true);
        $footer_left_a = '<table border="0" width="600">'
                . '<tr><td width="100">Diterima Oleh<br></td><td width="10">:</td><td></td></tr>'
                . '<tr><td>Tgl/jam</td><td>:</td><td></td></tr>'
                . '<tr><td>NB</td><td width="10">:</td><td width="300">Mohon SP yang telah ditandatangani dikirim<br>kembali ke KJRI Kuching <u><strong>melalui sarana VPN</strong></u></td></tr>'
                . '</table>';
        $pdf->writeHTMLCell(600, '', '', '', $footer_left_a, 0, 0, 0, FALSE, 'L', false);
        $pdf->Output('My-File-Name.pdf', 'I');
    }
}

/* End of file welcome.php */
    /* Location: ./system/application/controllers/welcome.php */    