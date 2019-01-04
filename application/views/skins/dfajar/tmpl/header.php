<?php
header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . 'GMT');
header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-chec=0");
header("Pragma: no-cache");
header("Expires:Mon. 26 Jul 1997 05:00:00 GMT");

if(session_id() == '') {
    session_start();
}
$SESSION_HOME_STAFF = $_SESSION['SESSION_HOME_STAFF'];
if(!isset($SESSION_HOME_STAFF)){
    redirect('logout');
}

?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Responsive HTML 5 e-disposisi KJRI KUCHING">
        <meta name="author" content="Monkey D. Fajar">
        <link rel="shortcut icon" href="<?= base_url(); ?>resources/images/internet.ico" />

        <title>E-Disposisi - <?php echo $this->session->userdata('nama_perwakilan'); ?></title>

        <!-- PACE LOAD BAR PLUGIN - This creates the subtle load bar effect at the top of the page. -->
        <link href="<?= base_url(); ?>resources/skins/dfajar/vendor/pace/pace.css" rel="stylesheet">
        <script src="<?= base_url(); ?>resources/skins/dfajar/vendor/pace/pace.js"></script>

        <!-- GLOBAL STYLES - Include these on every page. -->
        <link href="<?= base_url(); ?>resources/skins/dfajar/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= base_url(); ?>resources/skins/dfajar/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url(); ?>resources/skins/dfajar/vendor/bootstrap/css/bootcomplete.css">

        <!-- PAGE LEVEL PLUGIN STYLES -->

        <!-- THEME STYLES - Include these on every page. -->
        <link href="<?= base_url(); ?>resources/skins/dfajar/dist/css/style.css" rel="stylesheet">
        <link href="<?= base_url(); ?>resources/skins/dfajar/dist/css/plugins.css" rel="stylesheet">
        <link href="<?= base_url(); ?>resources/skins/dfajar/vendor/messenger/messenger.css" rel="stylesheet">
        <link href="<?= base_url(); ?>resources/skins/dfajar/vendor/messenger/messenger-theme-flat.css" rel="stylesheet">
        <link href="<?= base_url(); ?>resources/skins/dfajar/vendor/morris/morris.css" rel="stylesheet">
        <link href="<?= base_url(); ?>resources/skins/dfajar/vendor/datatables/datatables.css" rel="stylesheet">

        <!--[if lt IE 9]>
          <script src="<?= base_url(); ?>resources/skins/dfajar/ie/html5shiv.js"></script>
          <script src="<?= base_url(); ?>resources/skins/dfajar/ie/respond.min.js"></script>
        <![endif]-->

    </head>

    <body oncontextmenu="return false;">
        <?php
        if ($this->session->userdata('SESSION_KOORDINATOR') == 'Y') {
            $url_add = "";
            //untuk jumlah notif berita yang harus didisposisi
            $jml_undispo = "SELECT count(*) as jml FROM (`tbl_berita`) JOIN `tbl_jenis_berita` ON `tbl_berita`.`jenis_kd`= `tbl_jenis_berita`.`jenis_kd` JOIN `tbl_sifat` ON `tbl_berita`.`sifat_kd`= `tbl_sifat`.`sifat_kd` JOIN `tbl_perwakilan` ON `tbl_perwakilan`.`perwakilan_kd`= `tbl_berita`.`perwakilan_kd` JOIN `tbl_derajat` ON `tbl_derajat`.`derajat_kd`= `tbl_berita`.`derajat_kd` WHERE `tbl_berita`.`status_disposisi` = 'T' and `tbl_berita`.`berita_disposisikan` = 'Y' and tbl_berita.berita_fungsi_disposisi='" . $this->session->userdata('SESSION_FUNGSI_KD') . "' ORDER BY `tbl_berita`.`arsip_kd` desc";
            $val_jml_undispo = $this->db->query($jml_undispo);
            $jml_undispo = $val_jml_undispo->result_array();

            //untuk detail berita yang harus didisposisi				
            $detail_undispo = "SELECT * FROM (`tbl_berita`) JOIN `tbl_jenis_berita` ON `tbl_berita`.`jenis_kd`= `tbl_jenis_berita`.`jenis_kd` JOIN `tbl_sifat` ON `tbl_berita`.`sifat_kd`= `tbl_sifat`.`sifat_kd` JOIN `tbl_perwakilan` ON `tbl_perwakilan`.`perwakilan_kd`= `tbl_berita`.`perwakilan_kd` JOIN `tbl_derajat` ON `tbl_derajat`.`derajat_kd`= `tbl_berita`.`derajat_kd` WHERE `tbl_berita`.`status_disposisi` = 'T' and `tbl_berita`.`berita_disposisikan` = 'Y' and tbl_berita.berita_fungsi_disposisi='" . $this->session->userdata('SESSION_FUNGSI_KD') . "' ORDER BY `tbl_berita`.`arsip_kd` desc limit 5";
            $val_detail_undispo = $this->db->query($detail_undispo);
            $detail_undispo = $val_detail_undispo->result_array();
            //}
            //else{
            //untuk jumlah notif berita yang harus diterima
            $jml_terima = "SELECT count(*) as jml FROM (`tbl_berita`) JOIN `tbl_jenis_berita` ON `tbl_berita`.`jenis_kd`= `tbl_jenis_berita`.`jenis_kd` JOIN `tbl_sifat` ON `tbl_berita`.`sifat_kd`= `tbl_sifat`.`sifat_kd` JOIN `tbl_perwakilan` ON `tbl_perwakilan`.`perwakilan_kd`= `tbl_berita`.`perwakilan_kd` JOIN `tbl_derajat` ON `tbl_derajat`.`derajat_kd`= `tbl_berita`.`derajat_kd` JOIN `tbl_disposisi` ON `tbl_disposisi`.`arsip_kd`=`tbl_berita`.`arsip_kd` JOIN `tbl_disposisi_detail` ON `tbl_disposisi_detail`.`disposisi_kd`=`tbl_disposisi`.`disposisi_kd` WHERE `tbl_disposisi_detail`.`detail_terima` = 'T' and `tbl_berita`.`berita_disposisikan` = 'Y'  and `tbl_disposisi_detail`.`detail_fungsi_kd` = '" . $this->session->userdata('SESSION_FUNGSI_KD') . "' ORDER BY `tbl_berita`.`arsip_kd` desc";
            $val_jml_terima = $this->db->query($jml_terima);
            $jml_terima = $val_jml_terima->result_array();

            //untuk detail notif berita yang harus diterima
            $detail_terima = "SELECT * FROM (`tbl_berita`) JOIN `tbl_jenis_berita` ON `tbl_berita`.`jenis_kd`= `tbl_jenis_berita`.`jenis_kd` JOIN `tbl_sifat` ON `tbl_berita`.`sifat_kd`= `tbl_sifat`.`sifat_kd` JOIN `tbl_perwakilan` ON `tbl_perwakilan`.`perwakilan_kd`= `tbl_berita`.`perwakilan_kd` JOIN `tbl_derajat` ON `tbl_derajat`.`derajat_kd`= `tbl_berita`.`derajat_kd` JOIN `tbl_disposisi` ON `tbl_disposisi`.`arsip_kd`=`tbl_berita`.`arsip_kd` JOIN `tbl_disposisi_detail` ON `tbl_disposisi_detail`.`disposisi_kd`=`tbl_disposisi`.`disposisi_kd` WHERE `tbl_disposisi_detail`.`detail_terima` = 'T' and `tbl_berita`.`berita_disposisikan` = 'Y' and   `tbl_disposisi_detail`.`detail_fungsi_kd` = '" . $this->session->userdata('SESSION_FUNGSI_KD') . "' ORDER BY `tbl_berita`.`arsip_kd` desc limit 5";
            $val_detail_terima = $this->db->query($detail_terima);
            $detail_terima = $val_detail_terima->result_array();
            $notif_total = $jml_undispo[0]['jml'] + $jml_terima[0]['jml'];
        } else {
            $url_add = "_fungsi";
            //untuk jumlah notif berita yang harus didisposisi
            //untuk jumlah notif berita yang harus diterima
            $jml_terima = "SELECT count(*) as jml FROM (`tbl_berita`) JOIN `tbl_jenis_berita` ON `tbl_berita`.`jenis_kd`= `tbl_jenis_berita`.`jenis_kd` JOIN `tbl_sifat` ON `tbl_berita`.`sifat_kd`= `tbl_sifat`.`sifat_kd` JOIN `tbl_perwakilan` ON `tbl_perwakilan`.`perwakilan_kd`= `tbl_berita`.`perwakilan_kd` JOIN `tbl_derajat` ON `tbl_derajat`.`derajat_kd`= `tbl_berita`.`derajat_kd` JOIN `tbl_disposisi_lanjutan` ON `tbl_disposisi_lanjutan`.`arsip_kd`=`tbl_berita`.`arsip_kd` JOIN `tbl_disposisi_lanjutan_detail` ON `tbl_disposisi_lanjutan_detail`.`disposisi_lanjutan_kd`=`tbl_disposisi_lanjutan`.`disposisi_lanjutan_kd` WHERE `tbl_disposisi_lanjutan_detail`.`detail_terima` = 'T' and `tbl_berita`.`berita_disposisikan` = 'Y'  and `tbl_disposisi_lanjutan_detail`.`detail_user_kd` = '" . $this->session->userdata('SESSION_ID') . "' ORDER BY `tbl_berita`.`arsip_kd` desc";
//				echo $jml_terima; exit;
            $val_jml_terima = $this->db->query($jml_terima);
            $jml_terima = $val_jml_terima->result_array();

            //untuk detail notif berita yang harus diterima
            $detail_terima = "SELECT * FROM (`tbl_berita`) JOIN `tbl_jenis_berita` ON `tbl_berita`.`jenis_kd`= `tbl_jenis_berita`.`jenis_kd` JOIN `tbl_sifat` ON `tbl_berita`.`sifat_kd`= `tbl_sifat`.`sifat_kd` JOIN `tbl_perwakilan` ON `tbl_perwakilan`.`perwakilan_kd`= `tbl_berita`.`perwakilan_kd` JOIN `tbl_derajat` ON `tbl_derajat`.`derajat_kd`= `tbl_berita`.`derajat_kd` JOIN `tbl_disposisi_lanjutan` ON `tbl_disposisi_lanjutan`.`arsip_kd`=`tbl_berita`.`arsip_kd` JOIN `tbl_disposisi_lanjutan_detail` ON `tbl_disposisi_lanjutan_detail`.`disposisi_lanjutan_kd`=`tbl_disposisi_lanjutan`.`disposisi_lanjutan_kd` WHERE `tbl_disposisi_lanjutan_detail`.`detail_terima` = 'T' and `tbl_berita`.`berita_disposisikan` = 'Y' and `tbl_disposisi_lanjutan_detail`.`detail_user_kd` = '" . $this->session->userdata('SESSION_ID') . "' ORDER BY `tbl_berita`.`arsip_kd` desc limit 5";
//				echo $detail_terima; exit;
            $val_detail_terima = $this->db->query($detail_terima);
            $detail_terima = $val_detail_terima->result_array();
            //}
            //$val=$this->db->query($sql2);
            //$val2=$val->result_array();
            $notif_total = $jml_terima[0]['jml'];
        }


        //get current installed version
        $update_sql = "select * from tbl_version  order by version_id desc limit 0,1";
        $val_update = $this->db->query($update_sql);
        $update = $val_update->result_array();
        ?>
        <div id="wrapper">

            <!-- begin TOP NAVIGATION -->
            <nav class="navbar-top" role="navigation">

                <!-- begin BRAND HEADING -->
                <div class="navbar-header">

                    <div class="navbar-brand">
                        <a href="<?= base_url(); ?>index.php/home">
                            <img width="150px" src="<?= base_url(); ?>resources/skins/dfajar/EDISPOSISI_LOGO_crop_white.png" class="img-responsive" alt="">
                        </a>
                        <span class="nama_pwk_header" style="margin-bottom: 0px;height: 30px;float:right;margin-top:5px;color:white;">
                            &nbsp;|&nbsp;<?php echo $this->session->userdata('nama_perwakilan'); ?>
                        </span>
                    </div>
                </div>
                <!-- end BRAND HEADING -->

                <div class="nav-top">

                    <!-- begin MESSAGES/ALERTS/TASKS/USER ACTIONS DROPDOWNS -->
                    <ul class="nav navbar-right">

                        <!-- begin MESSAGES DROPDOWN -->
                        <li class="dropdown">
                            <a href="#" class="messages-link dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                <span class="number"><?php echo $jml_terima[0]['jml']; ?></span> <i class="fa fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-scroll dropdown-messages">

                                <!-- Messages Dropdown Heading -->
                                <li class="dropdown-header">
                                    <i class="fa fa-envelope"></i> <?php echo $jml_terima[0]['jml']; ?> Berita Belum Diterima
                                </li>

                                <!-- Messages Dropdown Body - This is contained within a SlimScroll fixed height box. You can change the height using the SlimScroll jQuery features. -->
                                <li id="messageScroll">
                                    <ul class="list-unstyled">
                                        <?php
                                        if (count($detail_terima) > 0) {
                                            foreach ($detail_terima as $row_detail_terima) {
                                                ?>
                                                <li>
                                                    <a href="<?php echo base_url() . 'index.php/berita/detail' . $url_add . '/id/' . $row_detail_terima['arsip_kd']; ?>">
                                                        <div class="row">
                                                            <div class="col-xs-2">
                                                                <div class="alert-icon <?php echo $row_detail_terima['sifat_kd'] == 1 ? "red" : "green"; ?> pull-left">
                                                                    <i class="fa fa-file-text"></i>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-10">
                                                                <p> 
                                                                    <strong><?php echo $row_detail_terima['perwakilan_nama']; ?></strong>: <?php echo word_limiter($row_detail_terima['perihal_berita'], 10) . '...'; ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>

                                    </ul>
                                </li>

                                <!-- Messages Dropdown Footer -->
                                <li class="dropdown-footer">
                                    <a href="<?php echo base_url() . 'index.php/berita/berita' . $url_add . '/index'; ?>">Tampilkan semua berita</a>
                                </li>

                            </ul>
                            <!-- /.dropdown-menu -->
                        </li>
                        <!-- /.dropdown -->
                        <!-- end MESSAGES DROPDOWN -->

                        <?php
                        if ($this->session->userdata('SESSION_KOORDINATOR') == 'Y') {
                            ?>
                            <!-- begin Undispo DROPDOWN -->
                            <li class="dropdown">
                                <a href="#" class="alerts-link dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-bell"></i> 
                                    <span class="number"><?php echo $jml_undispo[0]['jml']; ?></span><i class="fa fa-caret-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-scroll dropdown-alerts">

                                    <!-- Alerts Dropdown Heading -->
                                    <li class="dropdown-header">
                                        <i class="fa fa-bell"></i> <?php echo $jml_undispo[0]['jml'] . ' Berita menunggu disposisi'; ?>
                                    </li>

                                    <!-- Alerts Dropdown Body - This is contained within a SlimScroll fixed height box. You can change the height using the SlimScroll jQuery features. -->
                                    <li id="alertScroll">
                                        <ul class="list-unstyled">
                                            <?php
                                            foreach ($detail_undispo as $rowundispo) {
                                                ?>
                                                <li>
                                                    <a href="<?php echo base_url() . 'index.php/berita/detail/id/' . $rowundispo['arsip_kd']; ?>">

                                                        <div class="row">
                                                            <div class="col-xs-2">

                                                                <div class="alert-icon <?php echo $rowundispo['sifat_kd'] == 1 ? "red" : "green"; ?> pull-left">
                                                                    <i class="fa fa-file-text"></i>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-10">
                                                                <p> 
                                                                    <strong><?php echo $rowundispo['perwakilan_nama']; ?></strong>: <?php echo word_limiter($rowundispo['perihal_berita'], 10) . '...'; ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                            ?>

                                        </ul>
                                    </li>

                                    <!-- Alerts Dropdown Footer -->
                                    <li class="dropdown-footer">
                                        <a href="<?php echo base_url() . 'index.php/berita/berita_fungsi/undisposed'; ?>">Tampilkan semua berita</a>
                                    </li>

                                </ul>
                                <!-- /.dropdown-menu -->
                            </li>
                            <!-- /.dropdown -->
                            <!-- end Undispo DROPDOWN -->
                            <?php
                        }
                        ?>

                        <!-- begin USER ACTIONS DROPDOWN -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i>  <i class="fa fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li>
                                    <a href="<?= base_url(); ?>index.php/pengguna/paswd/index">
                                        <i class="fa fa-key"></i> Change Password
                                    </a>
                                </li>
                                <li>
                                    <a class="logout_open" href="#logout">
                                        <i class="fa fa-sign-out"></i> Logout
                                        <strong><?php echo $this->session->userdata('SESSION_NAMALENGKAP'); ?></strong>
                                    </a>
                                </li>
                            </ul>
                            <!-- /.dropdown-menu -->
                        </li>
                        <!-- /.dropdown -->
                        <!-- end USER ACTIONS DROPDOWN -->

                    </ul>
                    <!-- /.nav -->
                    <!-- end MESSAGES/ALERTS/TASKS/USER ACTIONS DROPDOWNS -->

                </div>
                <!-- /.nav-top -->
            </nav>
            <!-- /.navbar-top -->
            <!-- end TOP NAVIGATION -->

            <!-- begin MAIN PAGE CONTENT -->
            <div id="page-wrapper" class="collapsed">
                <!--Tool bar menu-->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <?php
//                            print_r($this->session->userdata); 
                            $puskom_custom = array(2, 3,67);
                            $session_fungsi_kd = $this->session->userdata('SESSION_FUNGSI_KD');
                            $session_home_staff = $this->session->userdata('SESSION_HOME_STAFF');
                            ?>
                            <div class="col-xs-12">
                                <a href="<?php echo base_url(); ?>index.php/home" class="btn btn-sm btn-default btn-margin"><i class="fa fa-home fa-2x"></i></a>
                                <?php if ($this->session->userdata('SESSION_FUNGSI_KD') == 2 || $this->session->userdata('SESSION_FUNGSI_INPUT') == 'Y') { ?>
                                    <a title="Tambah Berita" href="<?= base_url(); ?>index.php/berita/tambah_berita/index" class="btn btn-sm btn-warning btn-margin"><i class="fa fa-edit fa-2x"></i></a>
                                    <a title="Tambah Berita Keluar" href="<?= base_url(); ?>index.php/berita/tambah_berita_keluar/index" class="btn btn-sm btn-warning btn-margin"><i class="fa fa-external-link fa-2x"></i></a>
                                <?php } if ($this->session->userdata('SESSION_FUNGSI_KD') == 2 && $session_home_staff == 'Y') { ?>
                                    <a title="Cetak Surat Pengantar" href="<?= base_url(); ?>index.php/berita/suratpengantar/index" class="btn btn-sm btn-white btn-margin"><i class="fa fa-print fa-2x"></i></a>
                                <?php } ?>
                                <?php
                                if ($this->session->userdata('SESSION_FUNGSI_KD') == 2) {
                                    $url = "";
                                } elseif ($this->session->userdata('SESSION_FUNGSI_KD') == 1) {
                                    $url = "_dubes";
                                } elseif ($this->session->userdata('SESSION_KOORDINATOR') == 'T') {
                                    $url = "_lanjutan";
                                } else {
                                    $url = "_fungsi";
                                }
                                ?>
                                <?php if ($this->session->userdata('SESSION_KOORDINATOR') == 'Y') { ?>
                                    <a title="Daftar Berita" href="<?= base_url(); ?>index.php/berita/berita<?= $url; ?>/index" class="btn btn-sm btn-success btn-margin"><i class="fa fa-envelope fa-2x"></i></a>
                                <?php } else {
                                    ?>
                                    <a title="Daftar Berita" href="<?= base_url(); ?>index.php/berita/berita<?= $url; ?>/index" class="btn btn-sm btn-success btn-margin"><i class="fa fa-envelope fa-2x"></i></a>
                                <?php } ?>
                                <a title="Cari Berita" href="<?= base_url(); ?>index.php/berita/cari/index<?= $url; ?>" class="btn btn-sm btn-info btn-margin"><i class="fa fa-search fa-2x"></i></a>
                                <a title="Ganti Password" href="<?= base_url(); ?>index.php/pengguna/paswd/index" class="btn btn-sm btn-danger btn-margin"><i class="fa fa-key fa-2x"></i></a>
                                <?php
                                if ($this->session->userdata('SESSION_FUNGSI_KD') == 2 && $session_home_staff == 'Y') {
                                    ?>
                                    <a title="Instruksi Disposisi" href="<?= base_url(); ?>index.php/instruksi/instruksi/index" class="btn btn-sm btn-white btn-margin"><i class="fa fa-list fa-2x"></i></a>
                                <?php } if (in_array($session_fungsi_kd, $puskom_custom)) { ?>
                                    <a title="Pengirim" href="<?= base_url(); ?>index.php/perwakilan/perwakilan/index" class="btn btn-sm btn-white btn-margin"><i class="fa fa-flag fa-2x"></i></a>
                                <?php } if ($this->session->userdata('SESSION_FUNGSI_KD') == 2 && $session_home_staff == 'Y') { ?>
                                    <a title = "Jenis Dokumen" href = "<?= base_url(); ?>index.php/jenisberita/jenisberita/index" class = "btn btn-sm btn-white btn-margin"><i class = "fa fa-list-alt fa-2x"></i></a>
                                    <a title = "Derajat Dokumen" href = "<?= base_url(); ?>index.php/derajat/derajat/index" class = "btn btn-sm btn-white btn-margin"><i class = "fa fa-gear fa-2x"></i></a>
                                    <a title = "Fungsi" href = "<?= base_url(); ?>index.php/fungsi/fungsi/index" class = "btn btn-sm btn-white btn-margin"><i class = "fa fa-users fa-2x"></i></a>
                                    <a title = "Pengguna" href = "<?= base_url(); ?>index.php/pengguna/pengguna/index" class = "btn btn-sm btn-white btn-margin"><i class = "fa fa-user fa-2x"></i></a>
                                    <a title = "Settingan Awal" href = "<?= base_url(); ?>index.php/install/install/index" class = "btn btn-sm btn-white btn-margin"><i class = "fa fa-gears fa-2x"></i></a>
                                <?php } if ($this->session->userdata('SESSION_FUNGSI_KD') == 1 || $this->session->userdata('SESSION_FUNGSI_KD') == 2) {
                                    ?> 
                                    <a title="Delegasi Disposisi" href="<?= base_url(); ?>index.php/delegate/delegate/index" class="btn btn-sm btn-white btn-margin"><i class="fa fa-refresh fa-2x"></i></a>
                                    <?php } ?>
<!--<a class="btn btn-sm btn-white btn-margin"><i class="fa fa-bar-chart fa-2x"></i></a>-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--Tool bar menu end-->