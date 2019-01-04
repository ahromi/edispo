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
                            <h4>Detail Fungsi</h4>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="horizontalFormExample" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <div><?= $notif; ?></div>
                            <?php echo form_open_multipart('fungsi/detail/id/' . $this->uri->segment(4), 'class="form-horizontal"'); ?> 
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">Nama Fungsi</label>
                                <div class="col-sm-8">
                                    <input type="text" value="<?= $fungsi[0]['nama_fungsi']; ?>" id="addarticle-title" name="nama_fungsi"  class="form-control"placeholder="Nama Fungsi">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-4 control-label">Status Aktif</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="addarticle-category" name="status_fungsi">
                                        <?php if ($fungsi[0]['status_fungsi'] == 'Y') {
                                            ?>
                                            <option value="Y" selected="selected" >Aktif</option>
                                        <?php } else { ?>
                                            <option value="T" selected="selected">Tidak Aktif</option>
                                        <?php } ?>
                                        <option value="Y" >Aktif</option>
                                        <option value="T">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-4 control-label">Kemampuan Melakukan Disposisi</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="addarticle-category" name="disposisi_fungsi">
                                        <?php if ($fungsi[0]['disposisi_fungsi'] == 'Y') { ?>
                                            <option value="Y" selected="selected" >Ya</option>
                                        <?php } else { ?>
                                            <option value="T" selected="selected">Tidak</option>
                                        <?php } ?>
                                        <option value="Y">Ya</option>
                                        <option value="T">Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-4 control-label">Kemampuan Menambahkan Arsip</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="addarticle-category" name="fungsi_input">
                                        <?php if ($fungsi[0]['fungsi_input'] == 'Y') { ?>
                                            <option value="Y" selected="selected" >Ya</option>
                                        <?php } else { ?>
                                            <option value="T" selected="selected">Tidak</option>
                                        <?php } ?>
                                        <option value="Y" >Ya</option>
                                        <option value="T">Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-4 control-label">Urutan Lembar Dispo</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="addarticle-category" name="fungsi_urut">
                                        <option selected="selected" value="<?php echo $fungsi[0]['fungsi_urut']; ?>" ><?php echo $fungsi[0]['fungsi_urut']; ?></option>
                                        <?php
                                        for ($i = 1; $i <= $jml; $i++) {
                                            ?><option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <input type="submit" name="EDIT" value="Submit" class="btn btn-sm btn-default" />
                                    <input type="submit" value="Clear all" class="btn btn-sm btn-danger" onClick="this.form.reset();" />
                                </div>
                            </div>
                            </form>
                            <a class="btn btn-sm btn-success" href="<?= base_url(); ?>index.php/fungsi/fungsi" onclick="history.back(1)">Kembali</a>
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