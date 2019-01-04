<?php
$cari = $this->uri->segment(4);
$notif = $this->session->flashdata('notifikasi');
$notif2 = $this->session->flashdata('notifikasi2');
$perwakilan_nama = $this->session->flashdata('perwakilan_nama');
$perwakilan_kd = $this->session->flashdata('perwakilan_kd');
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
                            <h4>Detail Perwakilan</h4>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="horizontalFormExample" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <?= $notif; ?>
                            <?php echo form_open_multipart('perwakilan/detail/id/' . $this->uri->segment(4)); ?> 
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 control-label">Nama Perwakilan</label>
                                <div class="col-sm-9">
                                    <input type="text" value="<?= $perwakilan[0]['perwakilan_nama']; ?>" id="addarticle-title" name="perwakilan_nama" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <input type="submit" name="EDIT" value="Submit" class="btn btn-sm btn-default" />
                                </div>
                            </div>
                            </form>
                            <a class="btn btn-sm btn-success" href="<?= base_url(); ?>index.php/perwakilan/perwakilan" onclick="history.back(1)">Kembali</a>
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