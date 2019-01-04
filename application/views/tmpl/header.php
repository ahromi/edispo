<?php
header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . 'GMT');
header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-chec=0");
header("Pragma: no-cache");
header("Expires:Mon. 26 Jul 1997 05:00:00 GMT");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>E-Disposisi - <?php echo $this->session->userdata('nama_perwakilan'); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="keywords" content="turboadmin, admin, template, theme, panel, clean, professional, widgets, jquery, plugins" />
        <link rel="shortcut icon" href="<?= base_url(); ?>resources/images/internet.ico" />
        <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>resources/css/style-<?php echo $this->session->userdata('warna_latar'); ?>.css"  />
        <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>resources/css/jquery-ui-1.8.11.custom.css"   />
        <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>resources/css/jquery.fullcalendar.css"  />
        <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>resources/css/jquery.fullcalendar.print.css"  media="print" />
        <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>resources/css/jquery.tiptip.css"  />
        <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>resources/css/jquery.wysiwyg.css" />
        <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>resources/css/jquery.uniform.css"  />
        <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>resources/css/jquery.apprise.css"   />
        <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>resources/css/jquery.datatables.css" />
        <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>resources/css/chosen.css" />
        <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>resources/css/calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
        <link type='text/css' rel='stylesheet' href="<?= base_url(); ?>resources/css/basic.css" media='screen' /> </LINK>
        <SCRIPT type="text/javascript" src="<?= base_url(); ?>resources/js/calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
    </head>    
    <body>

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
        <div id="container">
            <div id="adminbar-outer" class="radius-bottom">
                <div id="adminbar" class="radius-bottom">
                    <a href="javascript: void(0)"  id="logo">    
                        <div id="txtpwk">&nbsp;&nbsp;<?php echo $this->session->userdata('nama_perwakilan'); ?></div></a>

                    <div id="details">
                        <a href="javascript: void(0)" class="avatar">
                            <img src="<?= base_url(); ?>uploads/<?= $this->session->userdata('SESSION_FOTO'); ?>" alt="avatar" width="36" height="36" />
                        </a>
                        <div class="tcenter">
                            <strong><?= $this->session->userdata('SESSION_NAMALENGKAP'); ?></strong><br>
                            (<?php
                            if ($this->session->userdata('SESSION_KOORDINATOR') == 'Y') { // donothing 
                            }
                            ?> <?php echo $this->session->userdata('SESSION_FUNGSI'); ?> ) 

                        </div>
                    </div>
                    <div id="widgets">
                        <ul id="widget-menu">
                            <!-- INI UNTUK NOTIFIKASI MELAKUKAN DISPOSISI --> 
                            <li>
                                <a href="javascript: void(0)" class="w-link"><img src="<?= base_url(); ?>resources/images/w-icon-pm.png" alt="Pm" /><span><?= $notif_total; ?></span></a>
                                <div class="widget">
                                    <div class="w-top"></div>
                                    <div class="w-content">
                                        <ul id="w-tabs-pm" class="widget-sub-nav">
                                            <li class="active"><a href="#w-tabs-pm-inbox" class="nav4">Terima (<?= $jml_terima[0]['jml']; ?>)</a></li>
                                            <?php if ($this->session->userdata('SESSION_KOORDINATOR') == 'Y') { ?>
                                                <li class="active"><a href="#w-tabs-pm-inbox" class="nav4">Disposisi (<?= $jml_undispo[0]['jml']; ?>)</a></li>
<?php } ?>
                                        </ul>
                                        <div id="w-tabs-pm-inbox">
                                                <?php if (!empty($detail_terima)) { ?>
                                                <div class="pm-message pm-new clearfix" style="background:#D5EAFF;">
    <?php foreach ($detail_terima as $key) { ?>
                                                        <img alt="avatar" src="<?= base_url(); ?>resources/images/m-newsletter.png">
                                                        <p class="pm-info"><a href="<?= base_url(); ?>index.php/berita/detail<?php echo $url_add; ?>/id/<?= $key['arsip_kd']; ?>"><strong><?= $key['arsip_kd']; ?></strong></a> &nbsp; <?= $key['tgl_diarsipkan']; ?></p>
                                                        <p class="pm-msg"><a class="agreen" href="<?= base_url(); ?>index.php/berita/detail<?php echo $url_add; ?>/id/<?= $key['arsip_kd']; ?>"><? echo word_limiter($key['perihal_berita'],10); ?></a></p>
                                                <?php } ?>
                                                </div>
                                            <?php } else { ?> 
                                                <div class="msg-info mar-none">Tidak ada Arsip Menunggu Penerimaan!</div>
                                        <?php } ?>
                                        </div>
                                            <?php if ($this->session->userdata('SESSION_KOORDINATOR') == 'Y') { ?>
                                            <div id="w-tabs-pm-inbox">
                                                    <?php if (!empty($detail_undispo)) { ?>
                                                    <div class="pm-message pm-new clearfix" style="background:#FFD7C4;">
        <?php foreach ($detail_undispo as $key) { ?>
                                                            <img alt="avatar" src="<?= base_url(); ?>resources/images/icon_write.png">
                                                            <p class="pm-info"><a href="<?= base_url(); ?>index.php/berita<?php echo $url_add; ?>/detail/id/<?= $key['arsip_kd']; ?>"><strong><?= $key['arsip_kd']; ?></strong></a> &nbsp; <?= $key['tgl_diarsipkan']; ?></p>
                                                            <p class="pm-msg"><a class="agreen" href="<?= base_url(); ?>index.php/berita/detail<?php echo $url_add; ?>/id/<?= $key['arsip_kd']; ?>"><? echo word_limiter($key['perihal_berita'],10); ?></a></p>
                                                    <?php } ?>
                                                    </div>
                                                <?php } else { ?> 
                                                    <div class="msg-info mar-none">Tidak ada Arsip Menunggu Disposisi!</div>
                                            <?php } ?>
                                            </div>
<?php } ?>

                                    </div>
                                    <div class="w-bottom"></div>
                                </div>
                            </li>

                            <li>
                                <a href="javascript: void(0)" class="w-link"><img src="<?= base_url(); ?>resources/images/w-icon-custom.png"  alt="Custom" /></a>
                                <div class="widget">
                                    <div class="w-top"></div>
                                    <div class="w-content">
                                        <h2>Pertolongan!</h2>
                                        <p>Menu Utama : Terdapat di bawah logo E-disposisi. Klik masing-masing menu untuk fungsi masing-masing.</p>
                                        <h2>Pertanyaan &amp; saran</h2>
                                        <p>Pertanyaan dan saran :  kontak Petugas Komunikasi Perwakilan</p>
                                    </div>
                                    <div class="w-bottom"></div>
                                </div>
                            </li>
<?php if ($this->session->userdata('SESSION_FUNGSI_KD') == 2) { ?> 
                                <li>
                                    <a href="javascript: void(0)" class="w-link"><img src="<?= base_url(); ?>resources/images/sync-icon.png"  alt="Custom" />
                                        <span id="new_update" style="display:none;font-size:9px;">New</span></a>
                                    <div class="widget">
                                        <div class="w-top"></div>
                                        <div class="w-content">
                                            <div id="update" style="background-color:#C0FAC5"></div>
                                            <h2>Versi Terinstal Saat ini : </h2>
                                            <p>E-disposisi Perwakilan versi <b><?php $ver = $update[0]['version_name'];
    echo $update[0]['version_name'];
    ?></b>
                                                <br>Pengembang versi :<strong> <?php echo $update[0]['version_author']; ?></strong>
                                                <br>Rilis versi : <strong><?php echo $update[0]['version_release']; ?></strong></p>
                                        </div>
                                        <div class="w-bottom"></div>
                                    </div>
                                </li>
                                <br>
<?php } ?>

                        </ul>
                    </div>
                </div>
            </div>			
            <div id="panel-outer" class="radius">
                <div id="panel" class="radius">
<?php if ($this->uri->segment(2) != 'install') { ?>      
                        <ul id="main-menu" class="radius-top clearfix">
                            <li>
                                <a href="<?= base_url(); ?>index.php/home/"  >
                                    <img src="<?= base_url(); ?>resources/images/m-dashboard.png"  alt="Dashboard" />
                                    <span>Halaman Depan</span>
                                </a>
                            </li>
    <?php if ($this->session->userdata('SESSION_FUNGSI_KD') == 2 || $this->session->userdata('SESSION_FUNGSI_INPUT') == 'Y') { ?>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/berita/tambah_berita/index">
                                        <img src="<?= base_url(); ?>resources/images/m-articles.png" alt="Tambah Berita" />
                                        <span>Tambah Dokumen</span>
                                    </a>
                                </li>
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
                                <li>
                                    <a href="<?= base_url(); ?>index.php/berita/berita<?= $url; ?>/index" >
                                        <img src="<?= base_url(); ?>resources/images/Document-icon.png" alt="Articles" />
                                        <span>Dokumen</span>
                                        <span class="submenu-arrow"></span>
                                    </a>
                                    <ul class="main-menu-hover radius-bottom">
        <?php if ($this->session->userdata('SESSION_FUNGSI_KD') == 2 && $this->session->userdata('SESSION_HOME_STAFF') == 'Y') { ?>  
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/berita/berita/inputed" >
                                                    <span>Yang Diinput Saya</span>
                                                </a>
                                            </li>
        <?php } ?>
        <?php if ($this->session->userdata('SESSION_FUNGSI_KD') == 1) { ?>  
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/berita/berita<?= $url; ?>/biasa" >
                                                    <span>Berita Biasa</span>
                                                </a>
                                            </li>
        <?php } ?>
                                        <li>
                                            <a href="<?= base_url(); ?>index.php/berita/berita<?= $url; ?>/today" >
                                                <span>Hari Ini</span>
                                            </a>
                                        </li>
        <?php if ($this->session->userdata('SESSION_DISPOSISI_FUNGSI') == 'Y' || $this->session->userdata('SESSION_FUNGSI_KD') == 2) { ?> 
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/berita/berita<?= $url; ?>/undisposed" >
                                                    <span>Menunggu Disposisi</span>
                                                </a>
                                            </li>
                                        <?php
                                        }
                                        if ($this->session->userdata('SESSION_FUNGSI_KD') != 1) {
                                            ?> 
                                            <!--  <li>
                                                 <a href="<?= base_url(); ?>index.php/berita/berita<?= $url; ?>/unrecieved" >
                                                     <span>Menunggu Penerimaan</span>
                                                 </a>
                                             </li>
                                            -->
                                <?php } ?>
                                    </ul>
                                </li>
    <?php } else { ?>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/berita/berita<?= $url; ?>/index" >
                                        <img src="<?= base_url(); ?>resources/images/Document-icon.png" alt="Articles" />
                                        <span>Dokumen</span>
                                        <span class="submenu-arrow"></span>
                                    </a>
                                    <ul class="main-menu-hover radius-bottom">
        <?php if ($this->session->userdata('SESSION_FUNGSI_KD') == 2 && $this->session->userdata('SESSION_HOME_STAFF') == 'Y') { ?>  
                                            <li>
                                                <a href="<?= base_url(); ?>index.php/berita/berita_lanjutan/inputed" >
                                                    <span>Yang Diinput Saya</span>
                                                </a>
                                            </li>
        <?php } ?>
                                        <li>
                                            <a href="<?= base_url(); ?>index.php/berita/berita<?= $url; ?>/unrecieved" >
                                                <span>Menunggu Penerimaan</span>
                                            </a>
                                        </li>
        <?php if ($this->session->userdata('SESSION_FUNGSI_KD') != 1) { ?> 
                                            <!--  <li>
                                                 <a href="<?= base_url(); ?>index.php/berita/berita<?= $url; ?>/unrecieved" >
                                                     <span>Menunggu Penerimaan</span>
                                                 </a>
                                             </li>
                                            -->
                                <?php } ?>
                                    </ul>
                                </li>

    <?php } ?>
                            <li>
                                <a href="<?= base_url(); ?>index.php/berita/cari/index<?= $url; ?>" >
                                    <img src="<?= base_url(); ?>resources/images/Document-Preview-icon.png"  alt="Files" />
                                    <span>Pencarian Dokumen</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url(); ?>index.php/pengguna/paswd/index">
                                    <img src="<?= base_url(); ?>resources/images/key.png" alt="Password" />
                                    <span>Ubah Password</span>
                                </a>
                            </li>
    <?php if ($this->session->userdata('SESSION_FUNGSI_KD') == 2 && $this->session->userdata('SESSION_HOME_STAFF') == 'Y') { ?>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/instruksi/instruksi/index">
                                        <img src="<?= base_url(); ?>resources/images/Lessons_Icon_Color_Border.png" alt="instruksi" />
                                        <span>Instruksi Disposisi</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/perwakilan/perwakilan/index" >
                                        <img src="<?= base_url(); ?>resources/images/Indonesia-Flag-icon.png" alt="Pengirim" />
                                        <span>Pengirim</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/jenisberita/jenisberita/index">
                                        <img src="<?= base_url(); ?>resources/images/File-Types-txt-icon.png" alt="Jenis Berita" />
                                        <span>Jenis Dokumen</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/derajat/derajat/index">
                                        <img src="<?= base_url(); ?>resources/images/m-settings.png" alt="derajat" />
                                        <span>Derajat Dokumen</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/fungsi/fungsi/index" >
                                        <img src="<?= base_url(); ?>resources/images/M7.gif" alt="Fungsi" />
                                        <span>Fungsi</span>
                                        <span class="submenu-arrow"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/pengguna/pengguna/index" >
                                        <img src="<?= base_url(); ?>resources/images/m-users.png" alt="Users" />
                                        <span>Pengguna</span>
                                        <span class="submenu-arrow"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>index.php/install/install/index" >
                                        <img src="<?= base_url(); ?>resources/images/settings-icon.png" alt="Setting" />
                                        <span>Settingan Awal</span>
                                        <span class="submenu-arrow"></span>
                                    </a>
                                </li>
    <?php } ?>
    <?php if ($this->session->userdata('SESSION_FUNGSI_KD') == 1 || $this->session->userdata('SESSION_FUNGSI_KD') == 2) { ?> 
                                <li>
                                    <a href="#" >
                                        <img src="<?= base_url(); ?>resources/images/reports-icon.png" alt="Report" />
                                        <span>Laporan & Statisik</span>
                                        <span class="submenu-arrow"></span>
                                    </a>
                                    <ul class="main-menu-hover radius-bottom">
                                        <li>
                                            <a href="<?= base_url(); ?>index.php/laporan/berita/" >
                                                <span>Dokumen</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url(); ?>index.php/laporan/berita/disposisi" >
                                                <span>Disposisi Dokumen</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>   
                                <li>
                                    <a href="<?= base_url(); ?>index.php/delegate/delegate/index" >
                                        <img src="<?= base_url(); ?>resources/images/M7.png" alt="Report" />
                                        <span>Delegasi Disposisi</span>
                                        <span class="submenu-arrow"></span>
                                    </a>
                                </li>
    <?php } ?>
    <?php if ($this->session->userdata('SESSION_FUNGSI_KD') == 2) { ?> 

                                <li>
                                    <a href="<?= base_url(); ?>index.php/import/import/index" >
                                        <img src="<?= base_url(); ?>resources/images/download.png" alt="Report" />
                                        <span>Import Simbra</span>
                                        <span class="submenu-arrow"></span>
                                    </a>
                                </li>

    <?php } ?>
                            <li>
                                <a href="<?= base_url(); ?>index.php/logout/">
                                    <img src="<?= base_url(); ?>resources/images/logout.png" alt="Logout" />
                                    <span>Logout</span>
                                    <span class="submenu-arrow"></span>
                                </a>
                            </li>
                        </ul>
<?php } else { ?>
                        <ul id="main-menu" class="radius-top clearfix">
                            <li>
                                <a href="<?= base_url(); ?>index.php/welcome/" >
                                    <span>Pengaturan <br>Profil Perwakilan</span><span>Langkah 1</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url(); ?>index.php/welcome/" >
                                    <span>Pengaturan Langkah 2</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url(); ?>index.php/welcome/" >
                                    <span>Langkah 3</span>
                                </a>
                            </li>
                        </ul>

<?php } ?>