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
                            <h4>Kelola Derajat Berita</h4>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="horizontalFormExample" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    &nbsp;&nbsp;
                                    <?php if (!empty($cari)) { ?> <a href="<?= base_url(); ?>index.php/derajat/derajat/">Tampilkan Semua</a> <?php } ?>
                                    <form action="" method="post" id="search-form" name="search-form" class="fright pos-rel">
                                        <input type="text" id="search-articles" name="key" value="nama derajat" onFocus="this.value = '';" class="search-con" />
                                        <input type="submit" value="CARI" id="search-btn" name="CARI" class="btn btn-sm btn-default" />
                                    </form>
                                    <center><b><?= $notif2; ?></b></center>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <table class="table table-responsive">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Kode Derajat Berita</th>
                                                <th>Nama Derajat Berita</th>
                                                <th>Detail</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            foreach ($derajat as $key => $val) {
                                                $i++;
                                                ?>
                                                <tr>
                                                    <td><?= $opset + $key + 1; ?></td>
                                                    <td><a href="javascript: void(0)"><?= $val['derajat_kd']; ?></a></td>
                                                    <td><a href="javascript: void(0)" class="agreen"><?= $val['derajat_nama']; ?></a></td>
                                                    <td><a href="<?= base_url(); ?>index.php/derajat/detail/id/<?= $val['derajat_kd']; ?>" class="tiptip-top" title="Detail"><img src="<?= base_url(); ?>resources/images/icon_view.png" alt="Detail" /></a></td>
                                                    <td><a href="<?= base_url(); ?>index.php/derajat/delete/id/<?= $val['derajat_kd']; ?>" class="tiptip-top" title="Delete"><img src="<?= base_url(); ?>resources/images/icon_bad.png" alt="delete" /></a></td>
                                                </tr>
                                            <?php }
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php echo $this->pagination->create_links(); ?>
                                </div>
                                <div class="col-xs-6">
                                    <div class="portlet portlet-default">
                                        <div class="portlet-heading">
                                            <div class="portlet-title">
                                                <h4>Tambah Derajat Berita Baru</h4>
                                            </div>
                                            <div class="portlet-widgets">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#horizontalFormExample"><i class="fa fa-chevron-down"></i></a>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div id="horizontalFormExample" class="panel-collapse collapse in">
                                            <div class="portlet-body">
                                                <div><?= $notif; ?></div>
                                                <?php echo form_open_multipart('derajat/derajat','class="form-horizontal"'); ?> 
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-4 control-label">Kode Derajat  Berita</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" value="<?= $derajat_kd; ?>" id="derajat_kd" name="derajat_kd" class="form-control"placeholder="Derajat  Berita">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputPassword3" class="col-sm-4 control-label">Nama Derajat Berita</label>
                                                        <div class="col-sm-8">
                                                            <input value="<?= $derajat_nama; ?>" id="derajat_nama" name="derajat_nama" type="text" class="form-control" placeholder="Nama Derajat Berita">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-4 col-sm-8">
                                                            <input type="submit" name="TAMBAH" value="Submit" class="btn btn-sm btn-default" />
                                                            <input type="submit" value="Clear all" class="btn btn-sm btn-danger" onClick="this.form.reset();" />
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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