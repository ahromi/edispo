<?php
$cari = $this->uri->segment(4);
$notif = $this->session->flashdata('notifikasi');
$notif2 = $this->session->flashdata('notifikasi2');
$instruksi_nama = $this->session->flashdata('instruksi_nama');
$instruksi_kd = $this->session->flashdata('instruksi_kd');
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
                            <h4>Detail Instruksi</h4>
                        </div>
                        <div class="portlet-widgets">
                            <a data-toggle="collapse" data-parent="#accordion" href="#horizontalFormExample"><i class="fa fa-chevron-down"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="horizontalFormExample" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <div><?= $notif; ?></div>
                            <?php echo form_open_multipart('instruksi/detail/id/' . $this->uri->segment(4)); ?> 
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Instruksi</label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?= $instruksi[0]['instruksi_nama']; ?>" id="addarticle-title" name="instruksi_nama" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <input type="submit" name="EDIT" value="Submit" class="btn btn-sm btn-default" />
                                </div>
                            </div>
                            <a class="btn btn-sm btn-green" href="<?= base_url(); ?>index.php/instruksi/instruksi" onclick="history.back(1)">Kembali</a>

                            </form>

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