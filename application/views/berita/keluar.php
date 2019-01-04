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
        $title = " Yang Terdisposisi Kepada Anda";
    }

    if ($this->uri->segment(3) == 'inputed') {
        $title = "<i>Yang Anda Inputkan</i>";
    }
    ?>
    <div class="page-content" style="font-family: Arial, Helvetica, sans-serif">
        <!-- begin PAGE TITLE ROW -->
        <div class="row">
            <div class="col-lg-12">
                <div class="portlet portlet-default">
                    <div class="portlet-heading">
                        <div class="portlet-title">
                            <h4>Berita Berita</h4>
                        </div>
                        <div class="portlet-widgets">

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
                                        <a style="width: 200px;" title="Daftar Berita" href="<?= base_url(); ?>index.php/berita/berita<?= $url; ?>/index" class="btn btn-sm btn-success btn-margin btn-block">Berita Masuk</a>
                                    <?php } else {
                                        ?>
                                        <a style="width: 200px;" title="Daftar Berita" href="<?= base_url(); ?>index.php/berita/berita<?= $url; ?>/index" class="btn btn-sm btn-success btn-margin btn-block">Berita Masuk</a>
                                    <?php } ?>
                                </li>
                                <?php
                                if ($this->session->userdata('SESSION_KOORDINATOR') == 'Y') {
                                    if ($this->session->userdata('SESSION_DISPOSISI_FUNGSI') == 'Y') {
                                        echo '<li role="presentation" class="active"><a style="width: 150px;"  href="' . base_url() . 'index.php/berita/berita' . $url . '/undisposed" class="btn btn-info btn-sm">Menunggu Disposisi</a></li>';
                                    }
                                    if ($this->session->userdata('SESSION_FUNGSI_KD') == 2 && $this->session->userdata('SESSION_HOME_STAFF') == 'Y') {
                                        echo '<li role="presentation" class="active"><a style="width: 150px;"  href="' . base_url() . 'index.php/berita/berita/inputed" class="btn btn-info btn-sm">Diinput Saya</a></li>';
                                    }
                                    echo '<li role="presentation" class="active"><a style="width: 150px;"  href="' . base_url() . 'index.php/berita/berita' . $url . '/today" class="btn btn-info btn-sm">Hari ini</a></li>';
                                    if ($this->session->userdata('SESSION_FUNGSI_KD') == 1) {
                                        echo '<li role="presentation" class="active"><a style="width: 150px;"  href="' . base_url() . 'index.php/berita/berita' . $url . '/biasa" class="btn btn-info btn-sm">Berita Biasa</a></li>';
                                    }
                                } else {
                                    if ($this->session->userdata('SESSION_FUNGSI_KD') == 2 && $this->session->userdata('SESSION_HOME_STAFF') == 'Y') {
                                        echo '<li role="presentation" class="active"><a style="width: 150px;"  href="' . base_url() . 'index.php/berita/berita_lanjutan/inputed" class="btn btn-info btn-sm">Diinput Saya</a></li>';
                                    }
                                    echo '<li role="presentation" class="active"><a style="width: 150px;"  href="' . base_url() . 'index.php/berita/berita' . $url . '/unrecieved" class="btn btn-info btn-sm">Menunggu Penerimaan</a></li>';
                                }
                                echo '<li role="presentation" class="active"><a style="width: 150px;"  href="' . base_url() . 'index.php/berita/berita/dikerjakan" class="btn btn-info btn-sm">Sudah Dikerjakan</a></li>';
                                echo '<li role="presentation" class="active"><a style="width: 150px;"  href="' . base_url() . 'index.php/berita/berita/pendingbulanlalu" class="btn btn-info btn-sm">Pending Bulan Lalu</a></li>';
                                echo '<li role="presentation" class="active"><a style="width: 150px;"  href="' . base_url() . 'index.php/berita/berita/keluar" class="btn btn-info btn-sm">Berita Keluar</a></li>';
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
                            <div class="portlet portlet-red">
                                <div class="portlet-heading">
                                    <div class="portlet-title">
                                        <h4>Berita Keluar Rahasia</h4>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="portlet-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="berita_keluar_rahasia">
                                            <thead>
                                                <tr>
                                                    <th width="3%">No.</th>
                                                    <th width="12%">Kode Arsip</th>
                                                    <th>No. Berita</th>
                                                    <th>Perihal Berita</th>
                                                    <th width="8%">Tgl Berita</th>
                                                    <th>Instansi Pengirim</th>
                                                    <?php
                                                    if ($level_id == '2') {
                                                        $colspan = 7;
                                                        ?>
                                                        <th>
                                                            Edit
                                                        </th>
                                                    <?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 0;
                                                
                                                   
                                                if (!empty($berita_keluar_rahasia)) {
                                                    foreach ($berita_keluar_rahasia as $key => $val) {
                                                        $i++;
                                                        ?>
                                                        <tr id="row">
                                                            <td width="3%"><?= $key + 1; ?></td>
                                                            <td width="12%"><a href="<?= base_url(); ?>index.php/berita/view_berita_keluar/id/<?= $val['arsip_kd']; ?>"><?= $val['arsip_kd']; ?></a></td>
                                                            <td width="15%"><a href="<?= base_url(); ?>index.php/berita/view_berita_keluar/id/<?= $val['arsip_kd']; ?>" class="agreen"><?= $val['berita_kd']; ?></a></td>
                                                            <td><p align="left"><?= ucfirst($val['perihal_berita']); ?></p></td>
                                                            <td width="7%">
                                                                <?php
                                                                $tgl_berita = date("d-m-Y", strtotime($val['tgl_berita']));
                                                                echo $tgl_berita;
                                                                ?>
                                                            </td>
                                                            <td width="15%"><?= $val['nama_fungsi']; ?></td>
                                                            <?php
                                                            if ($level_id == '2') {
                                                                ?>
                                                                <td><a href="<?= base_url(); ?>index.php/berita/edit_berita_keluar/id/<?= $val['arsip_kd']; ?>" class="tiptip-top" title="Edit Berita Keluar"><img src="<?= base_url(); ?>resources/images/icon_edit.png" alt="edit" /></a></td>
                                                                <?php }
                                                            ?>

                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>

                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                            </div>

                            <div class="portlet portlet-green">
                                <div class="portlet-heading">
                                    <div class="portlet-title">
                                        <h4>Berita Keluar Biasa</h4>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="portlet-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="berita_keluar_biasa">
                                            <thead>
                                                <tr>
                                                    <th width="3%">No.</th>
                                                    <th width="12%">Kode Arsip</th>
                                                    <th>No. Berita</th>
                                                    <th>Perihal Berita</th>
                                                    <th width="8%">Tgl Berita</th>
                                                    <th>Instansi Pengirim</th>
                                                    <?php
                                                    if ($level_id == '2') {
                                                        $colspan = 8;
                                                        ?>
                                                        <th>
                                                            Edit
                                                        </th>
                                                    <?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 0;
                                                if (!empty($berita_keluar_biasa)) {
                                                    foreach ($berita_keluar_biasa as $key => $val) {
                                                        $i++;
                                                        ?>
                                                        <tr id="row">
                                                            <td width="3%"><?= $key + 1; ?></td>
                                                            <td width="12%"><a href="<?= base_url(); ?>index.php/berita/view_berita_keluar/id/<?= $val['arsip_kd']; ?>"><?= $val['arsip_kd']; ?></a></td>
                                                            <td width="15%"><a href="<?= base_url(); ?>index.php/berita/view_berita_keluar/id/<?= $val['arsip_kd']; ?>" class="agreen"><?= $val['berita_kd']; ?></a></td>
                                                            <td><p align="left"><?= ucfirst($val['perihal_berita']); ?></p></td>
                                                            <td width="7%">
                                                                <?php
                                                                $tgl_berita = date("d-m-Y", strtotime($val['tgl_berita']));
                                                                echo $tgl_berita;
                                                                ?>
                                                            </td>
                                                            <td width="15%"><?= $val['nama_fungsi']; ?></td>
                                                            <?php
                                                            if ($level_id == '2') {
                                                                ?>
                                                                <td><a href="<?= base_url(); ?>index.php/berita/edit_berita_keluar/id/<?= $val['arsip_kd']; ?>" class="tiptip-top" title="Edit Berita Keluar"><img src="<?= base_url(); ?>resources/images/icon_edit.png" alt="edit" /></a></td>
                                                                <?php }
                                                            ?>

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