<?php
$cari = $this->uri->segment(4);
$notif = $this->session->flashdata('notifikasi');
$notif2 = $this->session->flashdata('notifikasi2');
$user_nama = $this->session->flashdata('user_nama');
$user_namalengkap = $this->session->flashdata('user_namalengkap');
$username = $this->session->userdata('SESSION_USERNAME');
//echo '<pre>';
//print_r($this->session->userdata);
//echo '</pre>';
if (!empty($username)) {
    $this->load->view('skins/' . $skin_val . '/tmpl/header');
    ?>
    <div class="page-content" style="font-family: Arial, Helvetica, sans-serif">
        <!-- begin PAGE TITLE ROW -->
        <div class="row">
            <div class="col-lg-12">
                <div class="portlet portlet-default">
                    <div class="portlet-heading">
                        <div class="portlet-title">
                            <h4>Tambah Berita</h4>
                        </div>
                        <div class="portlet-widgets">
                            <a data-toggle="collapse" data-parent="#accordion" href="#horizontalFormExample"><i class="fa fa-chevron-down"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="horizontalFormExample" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <?php echo form_open_multipart('berita/tambah_berita' . $this->uri->segment(4), array('class' => 'form-horizontal')); ?> 
                            <?php if (!empty($notif)) { ?>
                                <script language="javascript">window.alert('<?= $notif; ?>');</script>
                            <?php } ?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="arsip_kd">No Arsip</label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-sm-3 col-xs-6">
                                            <input type="text" class="form-control"value="<?= $kode; ?>" readonly="readonly" id="arsip_kd" name="arsip_kd">
                                        </div>
                                        <div class="col-lg-9 col-md-8 col-sm-9 col-xs-6">
                                            (Otomatis)
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="jenis_kd">Jenis Dokumen *</label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-sm-3 col-xs-6">
                                            <select class="form-control" id="jenis_kd" name="jenis_kd">
                                                <?php foreach ($jenis as $val) { ?>
                                                    <option <?php
                                                    if ($val['jenis_nama'] == '-') {
                                                        echo "selected";
                                                    }
                                                    ?>  value="<?= $val['jenis_kd']; ?>"> <?php
                                                            if ($val['jenis_nama'] == '-') {
                                                                echo "-Pilih-";
                                                            } else {
                                                                echo $val['jenis_nama'];
                                                            }
                                                            ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="berita_kd">No Dokumen *</label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-xs-7">
                                            <input type="text" class="form-control"value="" id="berita_kd" name="berita_kd">
                                        </div>
                                        <div class="col-xs-5">
                                            (yang tertera pada dokumen)
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="sifat_kd">Sifat Dokumen</label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-sm-3 col-xs-6">
                                            <select class="form-control" id="sifat_kd" name="sifat_kd">
                                                <?php foreach ($sifat as $val) { ?>
                                                    <option selected="selected"  value="<?= $val['sifat_kd']; ?>"><?= $val['sifat_nama']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="perwakilan">Instansi Pengirim * <em><strong><font color="#FF0000">(ketik lalu pilih)</font></strong></em></label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-xs-8">
                                            <input id="instansi_pengirim" type="text" name="perwakilan" placeholder="Ketik nama instansi pengirim" class="form-control">
                                        </div>
                                        <div class="col-xs-4">
                                            <!--<a href="#" data-toggle="modal" data-target="#tambahInstansiBaru" class="btn btn-link">Tambah Instansi</a>-->
                                            <!-- Flex Modal -->
                                            <div class="modal modal-flex fade" id="tambahInstansiBaru" tabindex="-1" role="dialog" aria-labelledby="flexModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="flexModalLabel">Tambah Instansi Baru</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Nama Instansi</label>
                                                                <input type="text" class="form-control" id="nama_instansi_new_text" placeholder="Masukan nama instansi">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-green" onclick="insert(document.getElementById('nama_instansi_new_text').value);">Tambah</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="jabatan_pengirim">Jabatan Pengirim</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="" name="jabatan_pengirim" id="jabatan_pengirim">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="derajat_kd">Derajat Berita</label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-sm-3 col-xs-6">
                                            <select id="derajat_kd" name="derajat_kd" class="form-control">
                                                <?php
                                                foreach ($derajat as $val) {
                                                    if ($val['derajat_nama'] == '-') {
                                                        ?>  
                                                        <option selected="selected" value="<?= $val['derajat_kd']; ?>"><?= $val['derajat_nama']; ?></option>
                                                    <?php } ?>
                                                    <option value="<?= $val['derajat_kd']; ?>"><?= $val['derajat_nama']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="tgl_berita">Tanggal Berita *</label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-sm-3 col-xs-6">
                                            <input type="text" class="form-control tambahberita" value="" value="<?php echo date('Y/m/d'); ?>" id="tgl_berita" name="tgl_berita">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="perihal_berita">Perihal*</label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <textarea class="form-control" cols="15" rows="3" name="perihal_berita"></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="keterangan">Keterangan</label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <textarea class="form-control" cols="15" rows="2" name="keterangan"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="berita_disposisikan">Disposisikan Dokumen ?</label>
                                <div class="col-sm-10">
                                    <select class="control-label" id="addarticle-category" name="berita_disposisikan">
                                        <option value="T" selected>TIDAK</option>
                                        <option value="Y" >YA</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="berita_fungsi_disposisi">Disposisi Oleh </label>
                                <div class="col-sm-10">
                                    <?php foreach ($pendispo as $val) { ?>
                                        <input type="radio" name="berita_fungsi_disposisi" value="<?php echo $val['fungsi_kd']; ?>" selected><?php echo $val['nama_fungsi']; ?></option>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php
                            if ($this->session->userdata('SESSION_HOME_STAFF') == "Y") {
                                ?>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Perwakilan CC</label>
                                    <div class="col-sm-10">
                                        <label class="checkbox-inline">
                                            <input name="pwk_code[]" type="checkbox" value="CHG">Chicago
                                        </label>
                                        <label class="checkbox-inline">
                                            <input name="pwk_code[]" type="checkbox" value="HST">Houston
                                        </label>
                                        <label class="checkbox-inline">
                                            <input name="pwk_code[]" type="checkbox" value="SFC">San Francisco
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="arsip_kd">Halaman</label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 col-sm-3 col-xs-6">
                                                <input type="text" class="form-control" value="" id="halaman" name="halaman">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="keterangan">File Dokumen </label>
                                <div class="col-sm-10">
                                    <input type="file" id="userfile" name="userfile"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-xs-5 text-left">
                                            <a href="<?php echo base_url(); ?>index.php/home" class="btn btn-link">Kembali</a>
                                        </div>
                                        <div class="col-xs-5">
                                            <input type="submit" name="TAMBAH" value="Submit" class="btn btn-default btn-sm" />
                                        </div>

                                    </div>

                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.col-lg-12 -->
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
  