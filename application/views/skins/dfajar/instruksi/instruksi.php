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
                            <h4>Kelola Instruksi  Disposisi</h4>
                        </div>
                        <div class="portlet-widgets">
                            <a data-toggle="collapse" data-parent="#accordion" href="#horizontalFormExample"><i class="fa fa-chevron-down"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="horizontalFormExample" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <?php if (!empty($notif2)) { ?> <script languange="javascript">window.alert(<?php echo $notif2; ?>);</script><?php } ?>
                            <?php if (!empty($cari)) { ?> <a href="<?= base_url(); ?>index.php/instruksi/instruksi/">Tampilkan Semua</a> <?php } ?>
                            <form action="" method="post" id="search-form" name="search-form" class="fright pos-rel">
                                <input type="text" id="search-articles" name="key" value="nama instruksi" onFocus="this.value = '';" class="search-con" />
                                <button style="display: none;" type="submit" disabled="" class="btn btn-default btn-sm" id="btn_loading"><i class='fa fa-circle-o-notch fa-spin'></i> Submitting ..</button>
                                <input type="submit" value="CARI" id="search-btn" name="CARI" class="btn btn-sm btn-default" />
                            </form>

                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <table class="table table-responsive">
                                        <thead>
                                            <tr>
                                                <th>No.</th> 
                                                <th>Nama Instruksi</th>
                                                <th>Status</th>
                                                <th>Detail</th>
                                                <th>Ubah Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            foreach ($instruksi as $key => $val) {
                                                $i++;
                                                ?>
                                                <tr>
                                                    <td><?= $opset + $key + 1; ?></td>
                                                   <!-- <td><a href="javascript: void(0)"><?= $val['instruksi_kd']; ?></a></td>-->
                                                    <td><a href="javascript: void(0)" class="agreen"><?= $val['instruksi_nama']; ?></a></td>
                                                    <td><?= $val['instruksi_status']; ?></td>
                                                    <td><a href="<?= base_url(); ?>index.php/instruksi/detail/id/<?= $val['instruksi_kd']; ?>" class="tiptip-top" title="Detail"><img src="<?= base_url(); ?>resources/images/icon_view.png" alt="Detail" /></a></td>
                                                    <td><a href="<?= base_url(); ?>index.php/instruksi/status/id/<?= $val['instruksi_kd']; ?>/<?php echo $val['instruksi_status']; ?>" class="tiptip-top" title="Ubah Status"><img src="<?= base_url(); ?>resources/images/<?php echo $val['instruksi_status']; ?>.png" alt="change status" /></a></td>
                                                </tr>
                                            <?php }
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php echo $this->pagination->create_links(); ?>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="portlet portlet-default">
                                        <div class="portlet-heading">
                                            <div class="portlet-title">
                                                <h4>Tambah Instruksi Baru</h4>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="portlet-body">
                                            <?php echo form_open_multipart('instruksi/instruksi'); ?> 
                                            <fieldset>
                                                <div><?= $notif; ?></div>
                                                <div class="form-group">
                                                    <label for="inputEmail3" class="col-sm-4 control-label">Nama Instruksi</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" value="<?= $instruksi_nama; ?>" id="addarticle-title" name="instruksi_nama" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-8 col-sm-offset-4">
                                                        <input type="submit" name="TAMBAH" value="Submit" class="btn-default btn btn-sm btn2" />
                                                        <input type="submit" value="Clear all" class="btn-danger btn btn-sm" onClick="this.form.reset();" />
                                                    </div>
                                                </div>
                                            </fieldset>
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
    
    <?php $this->load->view('skins/' . $skin_val . '/tmpl/footer'); ?>
    <?php
} else {
    redirect('');
}
?>