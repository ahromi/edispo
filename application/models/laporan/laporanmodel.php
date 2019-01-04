<?php

class Laporanmodel extends CI_Model {

    function __construct() {
        //Memanggil Constructor Model
        parent::__construct();
    }

    function get_count_data() {
        $this->db->order_by("user_kd", "desc");
        $this->db->select('*');
        $this->db->from('tbl_user');
        $this->db->join('tbl_fungsi', 'tbl_user.fungsi_kd= tbl_fungsi.fungsi_kd');
        $query = $this->db->count_all_results();
        return $query->result_array();
    }

    /* BACKUP
      function get_data_berita()
      {
      $this->db->order_by("arsip_kd", "desc");
      $this->db->select('*,tbl_berita.tgl_diarsipkan as detail_terima'); //this is for faking view berita
      $this->db->from('tbl_berita');
      $this->db->join('tbl_jenis_berita', 'tbl_berita.jenis_kd= tbl_jenis_berita.jenis_kd');
      $this->db->join('tbl_sifat', 'tbl_berita.sifat_kd= tbl_sifat.sifat_kd');
      $this->db->join('tbl_perwakilan', 'tbl_perwakilan.perwakilan_kd= tbl_berita.perwakilan_kd');
      $this->db->join('tbl_derajat', 'tbl_derajat.derajat_kd= tbl_berita.derajat_kd');
      if (!empty($_POST['jenis_kd'])){ $this->db->where('tbl_jenis_berita.jenis_kd',$_POST['jenis_kd']);	}
      if (!empty($_POST['sifat_kd'])){	$this->db->where('tbl_sifat.sifat_kd',$_POST['sifat_kd']);}
      if (!empty($_POST['perwakilan_kd'])){ $this->db->where('tbl_perwakilan.perwakilan_kd',$_POST['perwakilan_kd']);	}
      if (!empty($_POST['derajat_kd'])){	$this->db->where('tbl_derajat.derajat_kd',$_POST['derajat_kd']);}
      if (!empty($_POST['berita_disposisikan'])){ $this->db->where('tbl_berita.berita_disposisikan',$_POST['berita_disposisikan']); }
      if (!empty($_POST['tanggal_mulai']) && !empty($_POST['tanggal_akhir'])){
      $where="tbl_berita.tgl_berita between '".$_POST['tanggal_mulai']."' AND '".$_POST['tanggal_akhir']."'";
      $this->db->where($where);
      }
      $query = $this->db->get();
      return $query->result_array();
      }
     */

    function get_data_berita() {

        $this->db->order_by("tbl_berita.arsip_kd", "asc");
        $this->db->select('*,tbl_berita.tgl_diarsipkan as detail_terima'); //this is for faking view berita 
        $this->db->from('tbl_berita');
        $this->db->join('tbl_jenis_berita', 'tbl_berita.jenis_kd= tbl_jenis_berita.jenis_kd');
        $this->db->join('tbl_sifat', 'tbl_berita.sifat_kd= tbl_sifat.sifat_kd');
        $this->db->join('tbl_perwakilan', 'tbl_perwakilan.perwakilan_kd= tbl_berita.perwakilan_kd');
        $this->db->join('tbl_derajat', 'tbl_derajat.derajat_kd= tbl_berita.derajat_kd');
        $this->db->join('tbl_disposisi', 'tbl_disposisi.arsip_kd=tbl_berita.arsip_kd');
        if (!empty($_POST['jenis_kd'])) {
            $this->db->where('tbl_jenis_berita.jenis_kd', $_POST['jenis_kd']);
        }
        if (!empty($_POST['sifat_kd'])) {
            $this->db->where('tbl_sifat.sifat_kd', $_POST['sifat_kd']);
        }
        if (!empty($_POST['perwakilan_kd'])) {
            $this->db->where('tbl_perwakilan.perwakilan_kd', $_POST['perwakilan_kd']);
        }
        if (!empty($_POST['derajat_kd'])) {
            $this->db->where('tbl_derajat.derajat_kd', $_POST['derajat_kd']);
        }
        if (!empty($_POST['berita_disposisikan'])) {
            $this->db->where('tbl_berita.berita_disposisikan', $_POST['berita_disposisikan']);
        }
        if (!empty($_POST['tanggal_mulai']) && !empty($_POST['tanggal_akhir'])) {
            $where = "tbl_berita.tgl_berita between '" . $_POST['tanggal_mulai'] . "' AND '" . $_POST['tanggal_akhir'] . "'";
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_data_fungsi_terdispo($x="") {
        $this->db->order_by("tbl_fungsi.fungsi_urut", "asc");
        $this->db->select('*');
        $this->db->from('tbl_disposisi');
        $this->db->join('tbl_disposisi_detail', 'tbl_disposisi.disposisi_kd= tbl_disposisi_detail.disposisi_kd');
        $this->db->join('tbl_fungsi', 'tbl_fungsi.fungsi_kd= tbl_disposisi_detail.detail_fungsi_kd');
        $this->db->where ('arsip_kd',$x);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_data_berita_disposisi() {
        $this->db->order_by("tbl_berita.arsip_kd", "desc");
        $this->db->select('*');
        $this->db->from('tbl_berita');
        $this->db->join('tbl_jenis_berita', 'tbl_berita.jenis_kd= tbl_jenis_berita.jenis_kd');
        $this->db->join('tbl_sifat', 'tbl_berita.sifat_kd= tbl_sifat.sifat_kd');
        $this->db->join('tbl_perwakilan', 'tbl_perwakilan.perwakilan_kd= tbl_berita.perwakilan_kd');
        $this->db->join('tbl_derajat', 'tbl_derajat.derajat_kd= tbl_berita.derajat_kd');
        $this->db->join('tbl_disposisi', 'tbl_disposisi.arsip_kd=tbl_berita.arsip_kd');
        $this->db->join('tbl_disposisi_detail', 'tbl_disposisi_detail.disposisi_kd=tbl_disposisi.disposisi_kd');
        $this->db->join('tbl_fungsi', 'tbl_fungsi.fungsi_kd=tbl_disposisi_detail.detail_fungsi_kd');
        //$this->db->where('tbl_disposisi_detail.detail_fungsi_kd',$this->session->userdata('SESSION_FUNGSI_KD'));
        $this->db->where('tbl_berita.berita_disposisikan', 'Y');
        if (!empty($_POST['fungsi_kd'])) {
            $this->db->where('tbl_disposisi_detail.detail_fungsi_kd', $_POST['fungsi_kd']);
        }
        if (!empty($_POST['jenis_kd'])) {
            $this->db->where('tbl_jenis_berita.jenis_kd', $_POST['jenis_kd']);
        }
        if (!empty($_POST['sifat_kd'])) {
            $this->db->where('tbl_sifat.sifat_kd', $_POST['sifat_kd']);
        }
        if (!empty($_POST['perwakilan_kd'])) {
            $this->db->where('tbl_perwakilan.perwakilan_kd', $_POST['perwakilan_kd']);
        }
        if (!empty($_POST['derajat_kd'])) {
            $this->db->where('tbl_derajat.derajat_kd', $_POST['derajat_kd']);
        }
        if (!empty($_POST['berita_disposisikan'])) {
            $this->db->where('tbl_berita.berita_disposisikan', $_POST['berita_disposisikan']);
        }
        if (!empty($_POST['detail_terima'])) {
            $this->db->where('tbl_disposisi_detail.detail_terima', $_POST['detail_terima']);
        }
        if (!empty($_POST['tanggal_mulai']) && !empty($_POST['tanggal_akhir'])) {
            $where = "tbl_berita.tgl_berita between '" . $_POST['tanggal_mulai'] . "' AND '" . $_POST['tanggal_akhir'] . "'";
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    function getStatistikBerita() {

        $query = $this->db->query("SELECT 
										date_format(tgl_diarsipkan, '%M') as month, 
										count(*) as jml 
									FROM 
										tbl_berita
									WHERE
										tbl_berita.status_disposisi = 'Y' and
										YEAR(tgl_diarsipkan) = " . date('Y') . "
									GROUP BY 
										MONTH(tgl_diarsipkan)");
        return $query->result_array();
    }

    function getStatistikDisposisiBerita() {

        $query = $this->db->query("SELECT 
										tbl_fungsi.nama_fungsi as fungsi, 
										count(*) as jml 
									FROM 
										tbl_berita,
										tbl_fungsi,
										tbl_disposisi,
										tbl_disposisi_detail 
									WHERE
										tbl_berita.arsip_kd=tbl_disposisi.arsip_kd AND
										tbl_disposisi.disposisi_kd=tbl_disposisi_detail.disposisi_kd AND
										tbl_disposisi_detail.detail_fungsi_kd=tbl_fungsi.fungsi_kd AND
										tbl_berita.status_disposisi = 'Y' AND
										YEAR(tgl_diarsipkan) = " . date('Y') . "
									GROUP BY 
										tbl_fungsi.nama_fungsi");
        return $query->result_array();
    }

}

?>