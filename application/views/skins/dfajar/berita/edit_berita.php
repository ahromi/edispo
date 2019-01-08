<?php
$cari = $this->uri->segment(4);
$notif = $this->session->flashdata('notifikasi');
$notif2 = $this->session->flashdata('notifikasi2');
$user_nama = $this->session->flashdata('user_nama');
$user_namalengkap = $this->session->flashdata('user_namalengkap');
$username = $this->session->userdata('SESSION_USERNAME');
$level_id = $this->session->userdata('SESSION_FUNGSI_KD');
$halaman_value = 0;
$val_cekbox = array();
foreach ($detailberita as $row) {
    $halaman_value = $row['halaman'];
    $val_cekbox[] = $row['pwk_code'];
}
//echo "<pre>";
//print_r($this->session->userdata);
//echo "</pre>";
//die();
if (!empty($username)) {
    $this->load->view('skins/' . $skin_val . '/tmpl/header');
    ?>
    <div class="page-content" style="font-family: Arial, Helvetica, sans-serif">
        <!-- begin PAGE TITLE ROW -->
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="portlet portlet-default">
                    <div class="portlet-heading">
                        <div class="portlet-title">
                            <h4>Edit Arsip Berita</h4>
                        </div>
                        <div class="portlet-widgets">
                            <a data-toggle="collapse" data-parent="#accordion" href="#editarsipberita"><i class="fa fa-chevron-down"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="editarsipberita" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <?php if ($berita[0]['berita_input_fungsi'] == $level_id || $level_id <= 3) { ?>
                                <?php echo form_open_multipart('berita/edit_berita/id/' . $this->uri->segment(4), array('class' => 'form-horizontal')); ?> 
                                <?php
                                if (isset($notif) && $notif !="") {
                                    echo '<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            ' . $notif . '
                                        </div>';
                                }
                                ?>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="arsip_kd">No Arsip</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <input type="text" class="form-control"value="<?= $berita[0]['arsip_kd']; ?>" readonly="readonly" id="arsip_kd" name="arsip_kd">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="berita_kd">No Dokumen *</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-xs-10">
                                                <input type="text" class="form-control" value="<?php echo $berita[0]['berita_kd']; ?>" id="berita_kd" name="berita_kd">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="jenis_kd">Jenis Dokumen *</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <select class="form-control" id="jenis_kd" name="jenis_kd">
                                                    <option value="<?= $berita[0]['jenis_kd']; ?>" selected><?= $berita[0]['jenis_nama']; ?></option>
                                                    <?php foreach ($jenis as $val) { ?>
                                                        <option  value="<?= $val['jenis_kd']; ?>"><?= $val['jenis_nama']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="sifat_kd">Sifat Dokumen</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <select class="form-control" id="sifat_kd" name="sifat_kd">
                                                    <?php
                                                    foreach ($sifat as $val) {
                                                        if ($val['sifat_kd'] == $berita[0]['sifat_kd']) {
                                                            echo '<option selected="" value="' . $val['sifat_kd'] . '">' . $val['sifat_nama'] . '</option>';
                                                        } else {
                                                            echo '<option value="' . $val['sifat_kd'] . '">' . $val['sifat_nama'] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="perwakilan">Instansi Pengirim * <em><strong><font color="#FF0000">(ketik lalu pilih)</font></strong></em></label>
                                    <div class="col-sm-8">
                                        <input id="instansi_pengirim" value="<?= $berita[0]['perwakilan_nama']; ?>" type="text" name="perwakilan" placeholder="Ketik nama instansi pengirim" class="form-control">
                                        <input name="perwakilan_kd" type="hidden" value="<?= $berita[0]['perwakilan_kd']; ?>" id="perwakilan_kd">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="jabatan_pengirim">Jabatan Pengirim</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="<?= $berita[0]['jabatan_pengirim']; ?>" name="jabatan_pengirim" id="jabatan_pengirim">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="derajat_kd">Derajat Berita</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <select id="derajat_kd" name="derajat_kd" class="form-control">
                                                    <?php foreach ($derajat as $val) { ?>
                                                        <option value="<?= $val['derajat_kd']; ?>"><?= $val['derajat_nama']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="tgl_berita">Tanggal Berita *</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <input type="text" class="form-control" value="<?= $berita[0]['tgl_berita']; ?>" value="<?php echo date('Y/m/d'); ?>" id="tgl_berita" name="tgl_berita">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="perihal_berita">Perihal*</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <textarea class="form-control" cols="15" rows="3" name="perihal_berita"><?= $berita[0]['perihal_berita']; ?></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="keterangan">Keterangan</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <textarea class="form-control" cols="15" rows="2" name="keterangan"><?= $berita[0]['keterangan']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="berita_disposisikan">Disposisikan <br>Dokumen ?</label>
                                    <div class="col-sm-8">
                                        <select class="control-label" id="addarticle-category" name="berita_disposisikan">
                                            <option value="<?= $berita[0]['berita_disposisikan']; ?>" selected><?php
                                                if ($berita[0]['berita_disposisikan'] == 'T') {
                                                    echo "TIDAK";
                                                } else {
                                                    echo "YA";
                                                }
                                                ?></option>
                                            <option value="T" >TIDAK</option>
                                            <option value="Y" >YA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="berita_fungsi_disposisi">Disposisi Oleh </label>
                                    <div class="col-sm-8">
                                        <?php
                                        $fungsi_dispo = $berita[0]['berita_fungsi_disposisi'];
                                        foreach ($pendispo as $val) {
                                            ?>
                                            <input type="radio" <?php
                                            if ($fungsi_dispo == $val['fungsi_kd']) {
                                                echo "checked='checked'";
                                            }
                                            ?> name="berita_fungsi_disposisi" value="<?php echo $val['fungsi_kd']; ?>" selected><?php echo $val['nama_fungsi']; ?></option>
                                               <?php } ?>
                                    </div>
                                </div>
                                <?php
                                if ($this->session->userdata('SESSION_HOME_STAFF') == "Y") {
                                    ?>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Perwakilan CC</label>
                                        <div class="col-sm-8">
                                            <label class="checkbox-inline">
                                                <input name="pwk_code[]" type="checkbox" value="CHG" <?php echo in_array("CHG", $val_cekbox) ? "checked" : ""; ?>>Chicago
                                            </label>
                                            <label class="checkbox-inline">
                                                <input name="pwk_code[]" type="checkbox" value="HST" <?php echo in_array("HST", $val_cekbox) ? "checked" : ""; ?>>Houston
                                            </label>
                                            <label class="checkbox-inline">
                                                <input name="pwk_code[]" type="checkbox" value="SFC" <?php echo in_array("SFC", $val_cekbox) ? "checked" : ""; ?>>San Francisco
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="arsip_kd">Halaman</label>
                                        <div class="col-sm-8">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 col-sm-3 col-xs-6">
                                                    <input type="text" class="form-control" value="<?php echo $halaman_value; ?>" id="halaman" name="halaman">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="keterangan">File Dokumen </label>
                                    <div class="col-sm-8">
                                        <input type="file" id="userfile" name="userfile"/>(tinggalkan jika tidak di ubah!)
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-xs-4 text-right">
                                                <a href="<?= base_url(); ?>index.php/berita/berita/index" class="btn btn-link">Kembali</a>
                                            </div>
                                            <div class="col-xs-4">
                                                <input type="submit" name="EDIT" value="Submit" class="btn btn-default btn-sm" />
                                            </div>
                                            <div class="col-xs-4 text-left">
                                                <a href="<?= base_url(); ?>index.php/berita/tambah_berita/index" class="btn btn-link">Tambah Berita</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                </form>
                            <?php } else { ?>
                                <h4 align="center">Anda tidak memiliki akses untuk mengubah data!</h4>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="portlet portlet-default">
                    <div class="portlet-heading">
                        <div class="portlet-title">
                            <h4>Preview</h4>
                        </div>
                        <div class="portlet-widgets">
                            <a data-toggle="collapse" data-parent="#accordion" href="#previeweditarsipberita"><i class="fa fa-chevron-down"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="previeweditarsipberita" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <iframe height="765px" width="100%" src="<?= base_url(); ?>files/<?php echo $berita[0]['berita_file']; ?>"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <!-- end PAGE TITLE ROW -->

    </div>

    <?php $this->load->view('skins/' . $skin_val . '/tmpl/footer'); ?>
    <?php
} else {
    redirect('');
}
?>
