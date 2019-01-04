<?php
$cari = $this->uri->segment(4);
$notif = $this->session->flashdata('notifikasi');
$notif_error = $this->session->flashdata('notifikasi_error');
$notif2 = $this->session->flashdata('notifikasi2');
$user_nama = $this->session->flashdata('user_nama');
$user_namalengkap = $this->session->flashdata('user_namalengkap');
$username = $this->session->userdata('SESSION_USERNAME');
$rad_sifat_dokumen = $this->session->flashdata('rad_sifat_dokumen');
$arsip_kd=$this->session->flashdata('arsip_kd');
$berita_kd=$this->session->flashdata('berita_kd');
$fungsi_pengirim=$this->session->flashdata('fungsi_pengirim');
$perihal_berita=$this->session->flashdata('perihal_berita');

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
                            <h4>Tambah Berita Keluar</h4>
                        </div>
                        <div class="portlet-widgets">
                            <a data-toggle="collapse" data-parent="#accordion" href="#horizontalFormExample"><i class="fa fa-chevron-down"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="horizontalFormExample" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <?php echo form_open_multipart('berita/tambah_berita_keluar' . $this->uri->segment(4), array('class' => 'form-horizontal')); ?> 
                            <?php
                            if ($notif_error != "") {
                                ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <strong>Notification:</strong><br><?php echo $notif_error; ?>
                                </div>
                                <?php
                            }
                            if ($notif != "") {
                                ?>
                                <div class="alert alert-info alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <strong>Notification:</strong><br><?php echo $notif; ?>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Sifat Dokumen</label>
                                <div class="col-sm-10">
                                    
                                    <div class="radio">
                                        <label>
                                            <input name="rad_sifat_dokumen" id="optionsRadios2" value="1" <?php echo $rad_sifat_dokumen=="1"?'checked=""':"";?>  type="radio">Rahasia
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input name="rad_sifat_dokumen" id="optionsRadios1" value="2" <?php echo $rad_sifat_dokumen=="2"?'checked=""':"";?> type="radio">Biasa
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="arsip_kd">No Arsip</label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-sm-3 col-xs-6">
                                            <input type="text" class="form-control" value="<?= $arsip_kd; ?>" readonly="readonly" id="arsip_kd" name="arsip_kd">
                                        </div>
                                        <div class="col-lg-9 col-md-8 col-sm-9 col-xs-6">
                                            (Otomatis)
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="berita_kd">No Dokumen *</label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-xs-7">
                                            <input type="text" class="form-control" id="berita_kd" name="berita_kd" value="<?php echo $berita_kd; ?>">
                                        </div>
                                        <div class="col-xs-5">
                                            (yang tertera pada dokumen)
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="fungsi_pengirim">Fungsi Pengirim * <em><strong><font color="#FF0000">(ketik lalu pilih)</font></strong></em></label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-xs-8">
                                            <input id="fungsi_pengirim" value="<?php echo $fungsi_pengirim;?>" type="text" name="fungsi_pengirim" placeholder="Ketik nama instansi pengirim" class="form-control">
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
                                            <textarea class="form-control" cols="15" rows="3" name="perihal_berita"><?php echo $perihal_berita;?></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>

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
  