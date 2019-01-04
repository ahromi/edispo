<?php
$cari = $this->uri->segment(4);
$notif = $this->session->flashdata('notifikasi');
$notif2 = $this->session->flashdata('notifikasi2');
$jenis_nama = $this->session->flashdata('jenis_nama');
$jenis_kd = $this->session->flashdata('jenis_kd');
$username = $this->session->userdata('SESSION_USERNAME');
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
                            <h4>Detail Jenis Berita</h4>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="horizontalFormExample" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    &nbsp;&nbsp;
                                    <?php echo form_open_multipart('jenisberita/detail/id/' . $this->uri->segment(4)); ?> 
                                    <fieldset>
                                        <div><?= $notif; ?></div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label">Jenis Berita</label>
                                            <div class="col-sm-9">
                                                <input type="text" value="<?= $jenisberita[0]['jenis_nama']; ?>" id="addarticle-title" name="jenis_nama" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-9 col-sm-offset-3">
                                                <input type="submit" name="EDIT" value="Submit" class="btn btn-sm btn-default" />
                                                <input type="submit" value="Clear all" class="btn btn-sm btn-danger" onClick="this.form.reset();" />
                                            </div>
                                        </div>
                                        
                                    </fieldset>
                                    </form>
                                    <center><b><?= $notif2; ?></b></center>
                                </div>
                            </div>
                            <a href="<?= base_url(); ?>index.php/jenisberita/jenisberita" onclick="history.back(1)" class="btn btn-sm btn-success">Kembali</a>
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