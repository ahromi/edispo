<?php
$cari = $this->uri->segment(4);
$notif = $this->session->flashdata('notifikasi');
$notif2 = $this->session->flashdata('notifikasi2');
$user_nama = $this->session->flashdata('user_nama');
$user_namalengkap = $this->session->flashdata('user_namalengkap');
$username = $this->session->userdata('SESSION_USERNAME');
$level_id = $this->session->userdata('SESSION_FUNGSI_KD');
if (!empty($username)) {
    $this->load->view('skins/' . $skin_val . '/tmpl/header');
    if ($this->session->userdata('SESSION_FUNGSI_KD') == 2 || $this->session->userdata('SESSION_FUNGSI_KD') == 1) {
        $title = "";
    } else {
        $title = " yang Terdisposisi kepada Anda";
    }
    ?>

    <div class="page-content" style="font-family: Arial, Helvetica, sans-serif">
        <!-- begin PAGE TITLE ROW -->
        <div class="row">
            <div class="col-lg-12">
                <div class="portlet portlet-default">
                    <div class="portlet-heading">
                        <div class="portlet-title">
                            <h4>Arsip Berita</h4>
                        </div>
                        <div class="portlet-widgets">
                            <a data-toggle="collapse" data-parent="#accordion" href="#horizontalFormExample"><i class="fa fa-chevron-down"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="horizontalFormExample" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <!--Untuk tombol berita-->
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

                            <ul class="nav nav-pills" role="tablist">
                                <li role="presentation" class="active">
                                    <?php if ($this->session->userdata('SESSION_KOORDINATOR') == 'Y') { ?>
                                        <a style="width: 200px;" title="Daftar Berita" href="<?= base_url(); ?>index.php/berita/berita<?= $url; ?>/index" class="btn btn-sm btn-success btn-margin btn-block">Daftar Berita</a>
                                    <?php } else {
                                        ?>
                                        <a style="width: 200px;" title="Daftar Berita" href="<?= base_url(); ?>index.php/berita/berita<?= $url; ?>/index" class="btn btn-sm btn-success btn-margin btn-block">Daftar Berita</a>
                                    <?php } ?>
                                </li>
                                <?php
                                if ($this->session->userdata('SESSION_KOORDINATOR') == 'Y') {
                                    if ($this->session->userdata('SESSION_FUNGSI_KD') == 2 && $this->session->userdata('SESSION_HOME_STAFF') == 'Y') {
                                        echo '<li role="presentation" class="active"><a style="width: 200px;"  href="' . base_url() . 'index.php/berita/berita/inputed" class="btn btn-info btn-sm">Diinput Saya</a></li>';
                                    }
                                    if ($this->session->userdata('SESSION_FUNGSI_KD') == 1) {
                                        echo '<li role="presentation" class="active"><a style="width: 200px;"  href="' . base_url() . 'index.php/berita/berita' . $url . '/biasa" class="btn btn-info btn-sm">Berita Biasa</a></li>';
                                    }
                                    if ($this->session->userdata('SESSION_DISPOSISI_FUNGSI') == 'Y') {
                                        echo '<li role="presentation" class="active"><a style="width: 200px;"  href="' . base_url() . 'index.php/berita/berita' . $url . '/undisposed" class="btn btn-info btn-sm">Menunggu Disposisi</a></li>';
                                    }
                                    echo '<li role="presentation" class="active"><a style="width: 200px;"  href="' . base_url() . 'index.php/berita/berita' . $url . '/today" class="btn btn-info btn-sm">Hari ini</a></li>';
                                } else {
                                    if ($this->session->userdata('SESSION_FUNGSI_KD') == 2 && $this->session->userdata('SESSION_HOME_STAFF') == 'Y') {
                                        echo '<li role="presentation" class="active"><a style="width: 200px;"  href="' . base_url() . 'index.php/berita/berita_lanjutan/inputed" class="btn btn-info btn-sm">Diinput Saya</a></li>';
                                    }
                                    echo '<li role="presentation" class="active"><a style="width: 200px;"  href="' . base_url() . 'index.php/berita/berita' . $url . '/unrecieved" class="btn btn-info btn-sm">Menunggu Penerimaan</a></li>';
                                }
                                ?>
                            </ul>

                            <?php
                            if ($notif2 != "") {
                                ?>
                                <div class="alert alert-info alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <strong>Notification:</strong><?php echo $notif2; ?>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="portlet portlet-green">
                                <div class="portlet-heading">
                                    <div class="portlet-title">
                                        <h4><?php echo $title_table; ?></h4>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="portlet-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Kode Arsip</th>
                                                    <th>No. Berita</th>                                        
                                                    <?php if ($this->uri->segment(2) == 'berita_fungsi') { ?>                                       
                                                        <th>Penerima</th>
                                                    <?php } ?>
                                                    <th>Perihal Berita</th>
                                                    <th>Tgl Berita</th>
                                                    <th>Tgl Arsip</th>
                                                    <th>Pengirim</th>
                                                    <th>Penerimaan</th>
                                                    <th>Print</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 0;
                                                if (empty($berita)) {
                                                    ?>
                                                    <tr id="row"><td colspan="9" align="center">Belum ada berita masuk HARI INI.</td></tr>
                                                    <?php
                                                } else {
                                                    foreach ($berita as $key => $val) {
                                                        $i++;
                                                        ?>
                                                        <tr id="row">
                                                            <td width="3%"><?= $opset + $key + 1; ?></td>
                                                            <td width="10%"><a href="<?= base_url(); ?>index.php/berita/detail/id/<?= $val['arsip_kd']; ?>"><?= $val['arsip_kd']; ?></a></td>
                                                            <td width="10%"><a href="<?= base_url(); ?>index.php/berita/detail/id/<?= $val['arsip_kd']; ?>" class="agreen"><?= $val['berita_kd']; ?></a></td>
                                                            <?php if ($this->uri->segment(2) == 'berita_fungsi') { ?> 
                                                                <td width="10%"><p align="left"><?= $val['nama_fungsi']; ?></p></td>
                                                            <?php } ?>
                                                            <td><p align="left"><?= $val['perihal_berita']; ?></p></td>
                                                            <td width="8%">
                                                                <?php
                                                                $tgl_berita = date("d-m-Y", strtotime($val['tgl_berita']));
                                                                echo $tgl_berita;
                                                                ?>
                                                            </td>
                                                            <td width="8%">
                                                                <?php
                                                                $tgl_diarsipkan = date("d-m-Y", strtotime($val['tgl_diarsipkan']));
                                                                echo $tgl_diarsipkan;
                                                                ?>
                                                            </td>
                                                            <td width="15%"><?= $val['perwakilan_nama']; ?></td>
                                                            <?php
                                                            if ($val['detail_terima'] == 'Y') {
                                                                ?><td width="5%"><img src="<?= base_url(); ?>resources/images/sudah.png" width="70" height="25" /></td><?php } else {
                                                                ?><td width="5%"><img src="<?= base_url(); ?>resources/images/menunggu.png" width="70" height="25"  /></td> 
                                                                    <?php
                                                                }
                                                                ?>
                                                            <td width="50"><a  onclick="window.open('<?= base_url(); ?>index.php/berita/cetak/id/<?= $val['arsip_kd']; ?>', 'mywindow', 'menubar=yes, width=800, height=600');" href="#" class="tiptip-top" title="Print Disposisi"><img src="<?= base_url(); ?>resources/images/print-icon.png" alt="print" /></a></td>


                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="portlet-footer">
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                    <?php echo $this->pagination->create_links(); ?>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('skins/' . $skin_val . '/tmpl/footer'); ?>
    <?php
} else {
    redirect('');
}
?>