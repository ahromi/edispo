<?php

class Berita extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    function index() {
        $this->load->model('laporan/laporanmodel', 'laporan', TRUE);
        $this->load->model('berita/beritamodel', 'berita', TRUE);
        $data['jenis'] = $this->berita->cmb_jenis();
        $data['sifat'] = $this->berita->cmb_sifat();
        $data['perwakilan'] = $this->berita->cmb_perwakilan();
        $data['derajat'] = $this->berita->cmb_derajat();

        if (isset($_POST['TAMBAH'])) {
            $dispo = $this->laporan->get_data_berita();
            ///	print_r ($dispo);
            //exit;
            //echo "te";
            //$this->load->library('pdftable_1.95/lib/pdftable',TRUE);
            $header = array('NO ARSIP', 'NO BERITA', 'PERIHAL', 'PENGIRIM', 'DISPOSISI', 'STATUS', 'TANGGAL');
            //data

            $content = "
        	<!-- 1.table -->
        	<table border=1 align=right>
        	<tr bgcolor=#eeeeee repeat=1>
				<td align=center width=15 border=1111 >No. Arsip</td>
				<td align=center width=15 border=1111 >No. Berita</td>
				<td align=center width=60 border=1111 >Perihal</td>
				<!-- <td align=center width=60 border=1111 >Pengirim</td> -->
				<td align=center width=30 border=1111 >Disposisi</td>
				<td align=left width=60 border=1111 >Fungsi:Status</td>
				<td align=center border=1111 >Korespondensi</td>
			</tr>";

            foreach ($dispo as $val) {
                if ($val['berita_disposisikan'] == 'Y') {
                    $dispokan = 'Ya';
                } else {
                    $dispokan = 'Tidak';
                }
                if ($val['status_disposisi'] == 'Y') {
                    $disposisi = 'Sudah';
                } else {
                    $disposisi = 'Belum';
                }
                
                $x=$val['arsip_kd'];
                
                $kolom_status="";
                $kolom_korespondensi="";

                $fungsi_status = $this->laporan->get_data_fungsi_terdispo($x);
                
                foreach ($fungsi_status as $fs) {
                    if ($fs['detail_perhatian'] == 'Y'){
                       $fungsi="<b>".$fs['nama_fungsi']."</b>";
                    }else{
                       $fungsi=$fs['nama_fungsi'];  
                    }
                    if ($fs['detail_terima'] == 'Y') {
                        $status = 'Sudah dibaca';
                    } else {
                        $status = 'Belum dibaca';
                    }
                    if ($fs['berita_status_pengerjaan'] == 'Y') {
                        $status = 'Sudah dikerjakan';
                    }
                    $kolom_status.="".$fungsi.":<i>".$status ."</i><br>";
                    $kolom_korespondensi.="".$fs['detail_korespondensi']."</i><br>";
                }




                $content.="	
                        <tr >
				<td align=center border=1111 >" . $val['arsip_kd'] . "</td>
				<td align=center border=1111 >" . $val['berita_kd'] . "</td>
				<td align=center border=1111 >" . $val['perihal_berita'] . "</td>
				<!-- <td align=center border=1111 >" . $val['perwakilan_nama'] . "</td> -->
				<td align=center border=1111 align=center >" . $val['catatan'] . "</td>
				<td align=center border=1111 align=center >" .$kolom_status. "</td>
				<td align=center border=1111 align=center >" .$kolom_korespondensi. "</td>
			</tr>";
            }
            $content.="	
				</table>
        	";

            define('FPDF_FONTPATH', APPPATH . 'libraries/pdftable_1.95/font/');
            //include(APPPATH.'libraries/pdftable_1.95/lib/pdftable.inc.php');
            include(APPPATH . 'libraries/pdftable_1.95/lib/pdf.inc.php');
            //$this->load->view('laporan/tes');
            //$p = new PDFTable();	
            $p = new PDF();
            $p->set_var($this->session->userdata('nama_perwakilan'), $this->session->userdata('SESSION_NAMALENGKAP'));
            //print_r($p);
            // I set margins out of class
            $p->AddFont('vni_times');
            $p->AddFont('vni_times', 'B');
            $p->AddFont('vni_times', 'I');
            $p->AddFont('vni_times', 'BI');

            $p->SetMargins(20, 20, 20);
            $p->AddPage('L');
            $p->defaultFontFamily = 'arial';
            $p->defaultFontStyle = '';
            $p->defaultFontSize = 10;


            $p->setStyle('title');
            $p->text(0, 'LAPORAN DISPOSISI BERITA MASUK', 0, 'C');
            $p->setfont('arial', '', 10);
            $p->text(0, "Per tanggal " . $_POST['tanggal_mulai'] . " s/d " . $_POST['tanggal_akhir'], 0, 'C');

            $p->SetFont($p->defaultFontFamily, $p->defaultFontStyle, $p->defaultFontSize);
            //$p->Header();
            $p->htmltable($content);
            //$p->output('asdasd.pdf','D');	
            $p->output();
        } else {
            $this->load->view('laporan/berita', $data);
        }
    }

    function xml_berita() {
        $this->load->model('laporan/laporanmodel', 'laporan', TRUE);
        $data['statistik'] = $this->laporan->getStatistikBerita();
        $this->load->view('laporan/sample', $data);
    }

    function disposisi() {
        $this->load->model('laporan/laporanmodel', 'laporan', TRUE);
        $this->load->model('berita/beritamodel', 'berita', TRUE);
        $data['fungsi'] = $this->berita->cmb_fungsi();
        $data['jenis'] = $this->berita->cmb_jenis();
        $data['sifat'] = $this->berita->cmb_sifat();
        $data['perwakilan'] = $this->berita->cmb_perwakilan();
        $data['derajat'] = $this->berita->cmb_derajat();

        if (isset($_POST['TAMBAH'])) {
            $dispo = $this->laporan->get_data_berita_disposisi();
            $header = array('NO ARSIP', 'NO BERITA', 'PERIHAL', 'PENGIRIM', 'DISPOSISI', 'STATUS', 'TANGGAL');
            //data

            $content = "
        	<!-- 1.table -->
        	<table border=1 align=right>
        	<tr bgcolor=#eeeeee repeat=1>
				<td align=center width=20 border=1111 >No. Arsip</td>
				<td align=center width=25 border=1111 >No. Berita</td>
				<td align=center border=1111 >Perihal</td>
				<td align=center width=60 border=1111 >Pengirim</td>
				<td align=center width=40 border=1111 >Pelaku Fungsi</td>
 				<td align=center width=15 border=1111 >Penerimaan</td>
				<td align=center width=20 border=1111 >Tanggal</td>
			</tr>";
            foreach ($dispo as $val) {

                if ($val['berita_disposisikan'] == 'Y') {
                    $dispokan = 'Ya';
                } else {
                    $dispokan = 'Tidak';
                }
                if ($val['detail_terima'] == 'Y') {
                    $disposisi = 'Sudah';
                } else {
                    $disposisi = 'Belum';
                }

                $content.="	
        	<tr >
				<td align=center border=1111 >" . $val['arsip_kd'] . "</td>
				<td align=center border=1111 >" . $val['berita_kd'] . "</td>
				<td align=center border=1111 >" . $val['perihal_berita'] . "</td>
				<td align=center border=1111 >" . $val['perwakilan_nama'] . "</td>
				<td align=center border=1111 >" . $val['nama_fungsi'] . "</td>
 				<td align=center border=1111 align=center >" . $disposisi . "</td>
				<td align=center border=1111 align=center >" . $val['tgl_berita'] . "</td>
			</tr>";
            }
            $content.="	
				</table>
        	";

            define('FPDF_FONTPATH', APPPATH . 'libraries/pdftable_1.95/font/');
            //include(APPPATH.'libraries/pdftable_1.95/lib/pdftable.inc.php');
            include(APPPATH . 'libraries/pdftable_1.95/lib/pdf.inc.php');
            //$this->load->view('laporan/tes');
            //$p = new PDFTable();	
            $p = new PDF();
            $p->set_var($this->session->userdata('nama_perwakilan'), $this->session->userdata('SESSION_NAMALENGKAP'));
            //print_r($p);
            // I set margins out of class
            $p->AddFont('vni_times');
            $p->AddFont('vni_times', 'B');
            $p->AddFont('vni_times', 'I');
            $p->AddFont('vni_times', 'BI');

            $p->SetMargins(20, 20, 20);
            $p->AddPage('L');
            $p->defaultFontFamily = 'times';
            $p->defaultFontStyle = '';
            $p->defaultFontSize = 12;


            $p->setStyle('title');
            $p->text(0, 'LAPORAN BERITA MASUK PERWAKILAN', 0, 'C');
            $p->setfont('vni_times', '', 12);
            $p->text(0, "Per tanggal " . $_POST['tanggal_mulai'] . " s/d " . $_POST['tanggal_akhir'], 0, 'C');

            $p->SetFont($p->defaultFontFamily, $p->defaultFontStyle, $p->defaultFontSize);
            //$p->Header();
            $p->htmltable($content);
            //$p->output('asdasd.pdf','D');	
            $p->output();
        } else {
            $this->load->view('laporan/disposisi_berita', $data);
        }
    }

    function xml_disposisi_berita() {
        $this->load->model('laporan/laporanmodel', 'laporan', TRUE);
        $data['statistik'] = $this->laporan->getStatistikDisposisiBerita();
        $this->load->view('laporan/stat_disposisi', $data);
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */