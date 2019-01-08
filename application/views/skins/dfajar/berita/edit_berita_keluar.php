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
//print_r($berita);
//echo "</pre>";
//die();
if (!empty($username)) {
    $rad_sifat_dokumen=0;
    $arsip_kd="";
    $berita_kd="";
    $fungsi_pengirim="";
    $fungsi_kd="";
    $perihal_berita="";
    
    if(count($berita)>0){
        $rad_sifat_dokumen=isset($berita[0]['sifat_kd'])?$berita[0]['sifat_kd']:0;
        $arsip_kd=isset($berita[0]['arsip_kd'])?$berita[0]['arsip_kd']:0;
        $berita_kd=isset($berita[0]['berita_kd'])?$berita[0]['berita_kd']:0;
        $fungsi_pengirim=isset($berita[0]['nama_fungsi'])?$berita[0]['nama_fungsi']:0;
        $fungsi_kd=isset($berita[0]['fungsi_kd'])?$berita[0]['fungsi_kd']:0;
        $perihal_berita=isset($berita[0]['perihal_berita'])?$berita[0]['perihal_berita']:0;
    }
    $this->load->view('skins/' . $skin_val . '/tmpl/header');
    ?>
    <div class="page-content" style="font-family: Arial, Helvetica, sans-serif">
        <!-- begin PAGE TITLE ROW -->
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="portlet portlet-default">
                    <div class="portlet-heading">
                        <div class="portlet-title">
                            <h4>Edit Arsip Berita Keluar</h4>
                        </div>
                        <div class="portlet-widgets">
                            <a data-toggle="collapse" data-parent="#accordion" href="#editarsipberita"><i class="fa fa-chevron-down"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="editarsipberita" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <?php echo form_open_multipart('berita/edit_berita_keluar/id/' . $this->uri->segment(4), array('class' => 'form-horizontal')); ?> 
                            
                            <?php
                            if ($notif != "") {
                                ?>
                                <div class="alert alert-info alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <strong>Notification:</strong><?php echo $notif; ?>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Sifat Dokumen</label>
                                <div class="col-sm-9">
                                    <div class="radio">
                                        <label>
                                            <input name="rad_sifat_dokumen" disabled="" id="optionsRadios2" value="1" <?php echo $rad_sifat_dokumen==1?'checked=""':'';?>  type="radio">Rahasia
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input name="rad_sifat_dokumen" disabled="" id="optionsRadios1" value="2" <?php echo $rad_sifat_dokumen==2?'checked=""':'';?> type="radio">Biasa
                                        </label>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="arsip_kd">No Arsip</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-4 col-sm-3 col-xs-6">
                                            <input type="text" class="form-control" value="<?= $arsip_kd; ?>" readonly="readonly" id="arsip_kd" name="arsip_kd">
                                        </div>
                                        <div class="col-lg-7 col-md-8 col-sm-9 col-xs-6">
                                            (Otomatis)
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="berita_kd">No Dokumen *</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <input type="text" class="form-control" id="berita_kd" name="berita_kd" value="<?php echo $berita_kd; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="fungsi_pengirim">Fungsi Pengirim * <em><strong><font color="#FF0000">(ketik lalu pilih)</font></strong></em></label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-xs-8">
                                            <input id="fungsi_pengirim" type="text" name="fungsi_pengirim" placeholder="Ketik nama instansi pengirim" value="<?php echo $fungsi_pengirim;?>" class="form-control">
                                            <input id="fungsi_pengirim_kd" type="hidden" name="fungsi_pengirim_kd" class="form-control" value="<?php echo $fungsi_kd;?>">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="tgl_berita">Tanggal Berita *</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-sm-3 col-xs-6">
                                            <input type="text" class="form-control tambahberita" value="" value="<?php echo date('Y/m/d'); ?>" id="tgl_berita" name="tgl_berita">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="perihal_berita">Perihal*</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <textarea class="form-control" cols="15" rows="3" name="perihal_berita"><?php echo$perihal_berita;?></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="keterangan">File Dokumen </label>
                                <div class="col-sm-9">
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
                                            <input type="submit" name="EDIT" value="Submit" class="btn btn-default btn-sm" />
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
                            <iframe height="765px" width="100%" src="<?= base_url().'files/' . $berita[0]['arsip_kd'] . '_' . str_replace("/", "-", $berita[0]['berita_kd']) . '.pdf'; ?>"></iframe>
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
