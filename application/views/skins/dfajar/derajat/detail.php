<?php
$cari = $this->uri->segment(4);
$notif = $this->session->flashdata('notifikasi');
$notif2 = $this->session->flashdata('notifikasi2');
$derajat_nama = $this->session->flashdata('derajat_nama');
$derajat_kd = $this->session->flashdata('derajat_kd');
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
                            <h4>Detail Derajat Berita</h4>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="horizontalFormExample" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    &nbsp;&nbsp;
                                    <div><?= $notif; ?></div>
                                    <?php echo form_open_multipart('derajat/detail/id/' . $this->uri->segment(4),'class="form-horizontal"'); ?> 
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Kode Derajat  Berita</label>
                                        <div class="col-sm-8">
                                            <input type="text" value="<?= $derajat[0]['derajat_kd']; ?>" id="derajat_kd" name="derajat_kd" class="form-control"placeholder="Derajat  Berita">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-4 control-label">Nama Derajat Berita</label>
                                        <div class="col-sm-8">
                                            <input value="<?= $derajat[0]['derajat_nama']; ?>" id="derajat_nama" name="derajat_nama" type="text" class="form-control" placeholder="Nama Derajat Berita">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-4 col-sm-8">
                                            <input type="submit" name="EDIT" value="Submit" class="btn btn-sm btn-default" />
                                            <input type="submit" value="Clear all" class="btn btn-sm btn-danger" onClick="this.form.reset();" />
                                        </div>
                                    </div>
                                    </form>
                                    <center><b><?= $notif2; ?></b></center>
                                </div>
                            </div>
                            <a href="<?= base_url(); ?>index.php/derajat/derajat" onclick="history.back(1)" class="btn btn-sm btn-success">Kembali</a>
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