<?php
$user_menerima_disposisi = $this->session->userdata('SESSION_MENERIMA_DISPOSISI');
$disposisi_fungsi = $this->session->userdata('SESSION_DISPOSISI_FUNGSI');
$level_id = $this->session->userdata('SESSION_FUNGSI_KD');
//print_r($fungsi_disposisi);die();
?>
<?php echo form_open_multipart('berita/detail/id/' . $this->uri->segment(4)); ?>
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
                    $cek_koresponden = "";
                    if (count($diskusi) > 0) {
                        foreach ($diskusi as $key) {
                            $cek_koresponden = $key['korespondensi_komentar'];
                            ?>
                            <div class="row" style="width:99%;">
                                <div class="col-lg-12">
                                    <div class="media">
                                        <a class="pull-left" href="#">
                                            <img class="media-object img-circle" src="<?php echo base_url(); ?>/uploads/avatar.jpg" alt="">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading"><?php echo $key['user_nama']; ?>
                                                <span class="small pull-right"><?php echo $key['korespondensi_datetime']; ?></span>
                                            </h4>
                                            <p><?php echo $key['korespondensi_komentar']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <hr style="margin-top:3px;margin-bottom: 3px;">
                            <?php
                        }
                    } else {
                        echo '<center>Belum ada</center>';
                    }
                    ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<?php if (!empty($detail_terima[0]['detail_terima'])) { ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="">
                <table class="table table-bordered table-hover" style="margin-bottom:0px !important">
                    <tbody>
                        <?php
                        if ($detail_terima[0]['detail_terima'] == 'T') {
                            ?>
                            <tr>
                                <td colspan="3">
                                    <?php if (($berita[0]['berita_disposisikan'] == 'Y' && $user_menerima_disposisi == 'Y') || ($level_id == '1' || $level_id == '2')) { ?>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                Korespondensi  : *optional 
                                                <input type="hidden" name="fungsi_kd" value="<?= $level_id; ?>" />
                                                <input type="hidden" name="arsip_kd" value="<?= $this->uri->segment(4); ?>" />
                                                <textarea name="korespondensi" class="form-control"></textarea>

                                            </div>
                                        </div>

                                        <?php
                                    }
                                    ?>

                                </td> 
                            </tr>
                            <tr>
                                <td colspan="3" >
                                    <?php $this->load->view('skins/' . $skin_val . '/berita/fungsi_lanjutan'); ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" >
                                    <input type="submit" id="TERIMA_DISPOSISI"  name="TERIMA_DISPOSISI" value="Terima Disposisi" class="btn btn-blue btn-sm" style="float:right;" />
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php }; ?>

<div class="row">
    <div class="col-xs-12">
        <?php
        if (!empty($detail_terima[0]['detail_terima'])) {
            if ($detail_terima[0]['detail_terima'] != 'T') {
                if ($if_lanjutan > 0 && count($user_disposisi_lanjutan) > 0) {
                    ?>
                    <table class="table table-bordered" style="margin-bottom: 0px !important;">
                        <thead>
                            <tr>
                                <th colspan="2">Penerusan Disposisi kepada Pelaksana Fungsi:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <strong>Disposisi lanjutan kepada:</strong>
                                </td>
                                <td>
                                    <strong>Isi instruksi lanjutan:</strong>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:0px;">
                                    <table class="table table-striped">
                                        <tbody>
                                            <?php
                                            foreach ($user_disposisi_lanjutan as $key) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php
                                                        if ($key['user_kd'] == $level_id) {
                                                            echo "<b><i>" . $key['user_namalengkap'] . "</i></b>";
                                                        } else {
                                                            echo $key['user_namalengkap'];
                                                        }
                                                        ?> 
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                </td>
                                <td style="padding:0px;">
                                    <table class="table table-striped">
                                        <tbody>
                                            <?php
                                            if (!empty($instruksi_disposed_lanjutan)) {
                                                foreach ($instruksi_disposed_lanjutan as $key) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $key['instruksi_nama']; ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <b>Catatan :</b><br>
                                    <?php
                                    if (empty($disposisi_lanjutan_kd[0]['disposisi_lanjutan_catatan'])) {
//do nothing
                                    } else {
                                        echo $disposisi_lanjutan_kd[0]['disposisi_lanjutan_catatan'];
                                    }
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <?php
                }
                ?>
                <table class="table table-bordered">
                    <tr>
                        <td colspan="3" style="padding:0px;">
                            <?php $this->load->view('skins/' . $skin_val . '/berita/fungsi_pengerjaan'); ?>
                        </td>
                    </tr>
                </table>
                <?php
            }
            ?>
        <?php } ?>   
    </div>
</div>
</form>