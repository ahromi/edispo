<?php
$cari = $this->uri->segment(4);
$note = $this->session->flashdata('notice');
$user_nama = $this->session->flashdata('user_nama');
$user_namalengkap = $this->session->flashdata('user_namalengkap');
$username = $this->session->userdata('SESSION_USERNAME');
$level_id = $this->session->userdata('SESSION_FUNGSI_KD');
$user_menerima_disposisi = $this->session->userdata('SESSION_MENERIMA_DISPOSISI');
$disposisi_fungsi = $this->session->userdata('SESSION_DISPOSISI_FUNGSI');
if (!empty($username)) {
    $this->load->view('skins/' . $skin_val . '/tmpl/header');
    if (!empty($note)) {
        echo '<input id="note_id_flag_gptn" name="note_id_flag_gptn" type="hidden" value="' . $note . '"></input>';
    }
    ?>


    <div class="page-content" style="font-family: Arial, Helvetica, sans-serif">
        <!-- begin PAGE TITLE ROW -->
        <div class="row">
            <div class="col-xs-12">
                <div class="portlet portlet-default">
                    <div class="portlet-heading">
                        <div class="portlet-title">
                            <h4>ARSIP BERITA <?= $berita[0]['berita_kd']; ?></h4>
                        </div>
                        <div class="portlet-widgets">
                            <?php
//                            if ($berita[0]['sifat_nama'] == "BIASA") {
                            if ($berita[0]['sifat_nama'] == "xxx") {
                                ?>
                                <a title="Cetak Berita" target="_blank" href="<?php echo base_url() . '/index.php/berita/berita/showpdf/' . $berita[0]['berita_file']; ?>"><i class="fa fa-print"></i></a>
                                <span class="divider"></span>
                                <?php
                            }
                            ?>

                            <a data-toggle="collapse" data-parent="#accordion" href="#detaildisposisiparent"><i class="fa fa-chevron-down"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="detaildisposisiparent" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <div class="row">
                                <!--Left kolom-->
                                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">

                                    <!--Kolom Detail arsip dokumen-->
                                    <div class="portlet portlet-default">
                                        <div class="portlet-heading">
                                            <div class="portlet-title">
                                                <h4>Detail Arsip Dokumen</h4>
                                            </div>
                                            <div class="portlet-widgets">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#berkas3"><i class="fa fa-chevron-down"></i></a>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div id="berkas3" class="panel-collapse collapse in">
                                            <div class="portlet-body">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="2" style="padding:0px">
                                                                    <table class="table table-striped">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>
                                                                                    <strong>Tanggal Disposisi</strong>
                                                                                </td>
                                                                                <td>
                                                                                    : 
                                                                                    <?php
                                                                                    $newdate = date("d-m-Y h:i:s", strtotime($berita[0]['tgl_disposisi']));
                                                                                    echo $newdate;
                                                                                    ?>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <strong>Nomor Berita</strong>
                                                                                </td>
                                                                                <td>
                                                                                    : 
                                                                                    <?php echo $berita[0]['berita_kd']; ?>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <strong>Perihal</strong>
                                                                                </td>
                                                                                <td>
                                                                                    : 
                                                                                    <?php echo $berita[0]['perihal_berita']; ?>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th width="50%" align="center">Disposisi Kepada:</th>
                                                                <th width="50%" align="center">Isi Instruksi:</th>
                                                            </tr>
                                                        </tbody>
                                                        <tbody>
                                                            <tr>
                                                                <td style="padding:0px">
                                                                    <table class="table table-striped">
                                                                        <tbody>
                                                                            <?php foreach ($fungsi_disposisi as $key) { ?>
                                                                                <tr>
                                                                                    <?php
                                                                                    if ($key['fungsi_kd'] == $level_id) {
                                                                                        if ($key['detail_perhatian'] == 'Y') {
                                                                                            echo "<td><strong>&radic;</strong>&nbsp;<strong>&radic;</strong></td>";
                                                                                        } else {
                                                                                            echo "<td><strong>&radic;</strong></td>";
                                                                                        }
                                                                                    } else {
                                                                                        if ($key['detail_perhatian'] == 'Y') {
                                                                                            echo "<td><strong>&radic;</strong>&nbsp;<strong>&radic;</strong></td>";
                                                                                        } else {
                                                                                            echo "<td><strong>&radic;</strong></td>";
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                    <td><?php echo $key['nama_fungsi']; ?></td>
                                                                                </tr>
                                                                            <?php } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                                <td style="padding:0px">
                                                                    <table class="table table-striped">
                                                                        <tbody>
                                                                            <?php foreach ($instruksi_disposisi as $key) { ?>
                                                                                <tr>
                                                                                    <?php
                                                                                    if ($key['instruksi_perhatian'] == 'Y') {
                                                                                        echo "<td><strong>&radic;</strong>&nbsp;<strong>&radic;</strong></td>";
                                                                                    } else {
                                                                                        echo "<td><strong>&radic;</strong></td>";
                                                                                    }
                                                                                    ?>
                                                                                    <td><?php echo $key['instruksi_nama']; ?></td>
                                                                                </tr>
                                                                            <?php } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <strong>Catatan :</strong> <br><span style="color: red;"><?= $disposisi[0]['catatan']; ?></span>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            if (!empty($detail_terima[0]['detail_terima'])) {
                                                                if ($detail_terima[0]['detail_terima'] != 'T') {
                                                                    ?>
                                                                    <tr>
                                                                        <td colspan="2" align="right">
                                                                            <a onclick="window.open('<?= base_url(); ?>index.php/berita/cetak/id/<?= $berita[0]['arsip_kd']; ?>', 'mywindow', 'menubar=yes, width=800');" class="btn btn-blue"><i class="fa fa-print"></i>Cetak Disposisi</a>
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                            <tr>
                                                                <th colspan="2">Pengerjaan Disposisi Oleh Masing-masing Fungsi:</th>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" style="padding:0px;">
                                                                    <table class="table table-bordered" style="margin-bottom:0px !important;">
                                                                        <?php
                                                                        $val_arr_pengerjaan = array();
                                                                        foreach ($pengerjaan as $key) {
                                                                            $val_arr_pengerjaan[$key['nama_fungsi']] = $key;
                                                                        }
                                                                        $tb = 0;
                                                                        foreach ($korespondensi as $key) {
                                                                            $tb++;
                                                                            if ($key['detail_terima'] == 'Y') {
                                                                                $status = '<a class="btn btn-xs btn-green"><i class="fa fa-arrow-circle-right"></i> Sudah Menerima</a>';
                                                                            } else {
                                                                                $status = '<a class="btn btn-xs btn-red"><i class="fa fa-warning"></i> Belum Menerima</a>';
                                                                            }
                                                                            if (isset($val_arr_pengerjaan[$key['nama_fungsi']]) && $val_arr_pengerjaan[$key['nama_fungsi']]['berita_status_pengerjaan'] == 'Y') {
                                                                                $status_pengerjaan = '<a class="btn btn-xs btn-green"><i class="fa fa-arrow-circle-right"></i> Sudah dilaksanakan</a>';
                                                                            } else {
                                                                                $status_pengerjaan = '<a class="btn btn-xs btn-red"><i class="fa fa-warning"></i> Belum dilaksanakan</a>';
                                                                            }
                                                                            ?>
                                                                            <tr>
                                                                                <td width="10%"><?php echo $key['nama_fungsi']; ?></td>
                                                                                <td width="10%"><?php echo $status; ?></td>
                                                                                <td width="10%"><?php echo $status_pengerjaan; ?></td>
                                                                            </tr>
                                                                        <?php }
                                                                        ?>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th colspan="2">Korespondensi</th>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <?php
                                                                    $arr_staff_kore = array();
                                                                    if (count($detail_disposisi_lanjutan) > 0) {
                                                                        foreach ($detail_disposisi_lanjutan as $row) {
                                                                            $arr_staff_kore[$row['fungsi_kd']][] = $row;
                                                                        }
                                                                    }
                                                                    $cek_koresponden = "";
                                                                    foreach ($korespondensi as $key) {
                                                                        if ($key['detail_korespondensi'] != "") {
                                                                            $cek_koresponden = $key['detail_korespondensi'];
                                                                            ?>
                                                                            <div class="row" style="width:99%;">
                                                                                <div class="col-lg-12">
                                                                                    <div class="media">
                                                                                        <a class="pull-left" href="#">
                                                                                            <img class="media-object img-circle" src="<?php echo base_url(); ?>/uploads/avatar.jpg" alt="">
                                                                                        </a>
                                                                                        <div class="media-body">
                                                                                            <h4 class="media-heading"><?php echo $key['nama_fungsi']; ?>
                                                                                                <span class="small pull-right"><?php echo $key['detail_waktu']; ?></span>
                                                                                            </h4>
                                                                                            <p><?php echo $key['detail_korespondensi']; ?></p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <hr>
                                                                            <?php
                                                                            if (isset($arr_staff_kore[$key['fungsi_kd']]) && count($arr_staff_kore[$key['fungsi_kd']]) > 0) {
                                                                                foreach ($arr_staff_kore[$key['fungsi_kd']] as $row_sub => $val) {
                                                                                    ?>
                                                                                    <div class="row" style="width:99%;">
                                                                                        <div class="col-lg-10 col-lg-offset-2">
                                                                                            <div class="media">
                                                                                                <a class="pull-left" href="#">
                                                                                                    <img class="media-object img-circle" src="<?php echo base_url(); ?>/uploads/avatar.jpg" alt="">
                                                                                                </a>
                                                                                                <div class="media-body">
                                                                                                    <h4 class="media-heading"><?php echo $val['user_namalengkap']; ?>
                                                                                                        <span class="small pull-right"><?php echo $val['detail_waktu']; ?></span>
                                                                                                    </h4>
                                                                                                    <p><?php echo $val['detail_korespondensi']; ?></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <hr>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                    if ($cek_koresponden == "") {
                                                                        ?>
                                                            <center>Belum ada</center>
                                                            <?php
                                                        }
                                                        ?>
                                                        </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <!--Untuk Detil Penerimaan lanjutan-->
                                                <?php
                                                if ($berita[0]['berita_disposisikan'] == 'Y' && (($user_menerima_disposisi == 'Y') || $berita[0]['berita_fungsi_disposisi'] == '1' || $berita[0]['berita_fungsi_disposisi'] == '2' )) {
                                                    if ($berita[0]['status_disposisi'] == 'Y') {
                                                        if (!empty($detail_terima[0]['detail_fungsi_kd'])) {
                                                            if ($detail_terima[0]['detail_fungsi_kd'] != $level_id) {
                                                                echo "<h2>Status Disposisi</h2>
                            <center>Berita tidak didisposisikan kepada Anda!</center>";
                                                            } else {
                                                                $this->load->view('skins/' . $skin_val . '/berita/fungsi_terima');
                                                            }
                                                        } else {
                                                            $this->load->view('skins/' . $skin_val . '/berita/fungsi_terima_lanjutan');
                                                        }
                                                    }
                                                } else {
                                                    echo '<h3>Dokumen Ini Belum Didisposisi!</h3>';
                                                }
                                                ?>

                                            </div>
                                        </div>
                                    </div>
                                    <!--End Kolom detail arsip dokkumen-->

                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="portlet portlet-default">
                                                <div class="portlet-heading">
                                                    <div class="portlet-title">
                                                        <h4>Tampilan Berita</h4>
                                                    </div>
                                                    <div class="portlet-widgets">
                                                        <!--<a data-toggle="collapse" data-parent="#accordion" href="#detaildisposisipreview"><i class="fa fa-chevron-down" onclick="loadiframe('<?= base_url(); ?>index.php/berita/berita/show/<?php echo $berita[0]['berita_file']; ?>')"></i></a>-->
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div id="detaildisposisipreview" class="panel-collapse collapse">
                                                    <div class="portlet-body">
                                                        <iframe id="iframe_detail" height="765px" width="100%" src="<?= base_url(); ?>resources/viewerjs/#./files/<?php echo $berita[0]['berita_file']; ?>"></iframe>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-footer">
                            <!--<input type="button" value="Kembali" onClick="history.back(1);" class="btn btn-primary" >-->
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