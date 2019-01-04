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
                            <h4>Kelola Jenis  Berita</h4>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="horizontalFormExample" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    &nbsp;&nbsp;
                                    <?php if (!empty($cari)) { ?> <a href="<?= base_url(); ?>index.php/jenisberita/jenisberita/">Tampilkan Semua</a> <?php } ?>
                                        <form action="" method="post" id="search-form" name="search-form" class="fright pos-rel">
                                            <input type="text" id="search-articles" name="key" value="nama jenisberita" onFocus="this.value = '';" class="search-con" />
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
                            <!-- <th>Kode Jenis  Berita</th> -->
                                                    <th>Jenis  Berita</th>
                                                    <th>Detail</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 0;
                                                foreach ($jenisberita as $key => $val) {
                                                    $i++;
                                                    ?>
                                                    <tr>
                                                        <td><?= $opset + $key + 1; ?></td>
                                                       <!-- <td><a href="javascript: void(0)"><?= $val['jenis_kd']; ?></a></td>-->
                                                        <td><a href="javascript: void(0)" class="agreen"><?= $val['jenis_nama']; ?></a></td>
                                                        <td><a href="<?= base_url(); ?>index.php/jenisberita/detail/id/<?= $val['jenis_kd']; ?>" class="tiptip-top" title="Detail"><img src="<?= base_url(); ?>resources/images/icon_view.png" alt="Detail" /></a></td>
                                                        <td><a href="<?= base_url(); ?>index.php/jenisberita/delete/id/<?= $val['jenis_kd']; ?>" class="tiptip-top" title="Delete"><img src="<?= base_url(); ?>resources/images/icon_bad.png" alt="delete" /></a></td>
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
                                                    <h4>Tambah Jenis  Berita Baru</h4>
                                                </div>
                                                <div class="portlet-widgets">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#horizontalFormExample"><i class="fa fa-chevron-down"></i></a>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div id="horizontalFormExample" class="panel-collapse collapse in">
                                                <div class="portlet-body">
                                                    <div><?= $notif; ?></div>
                                                    <?php echo form_open_multipart('jenisberita/jenisberita'); ?> 
                                                    <fieldset>
                                                        <div class="form-group">
                                                            <label for="inputPassword3" class="col-sm-3 control-label">Nama Jenis  Berita</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" value="<?= $jenis_nama; ?>" id="addarticle-title" name="jenis_nama" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-sm-9 col-sm-offset-3">
                                                                <input type="submit" name="TAMBAH" value="Submit" class="btn btn-sm btn-default" />
                                                                <input type="submit" value="Clear all" class="btn btn-sm btn-danger" onClick="this.form.reset();" />
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
        </div>
        <?php $this->load->view('skins/' . $skin_val . '/tmpl/footer'); ?>
        <?php
    } else {
        redirect('');
    }
    ?>