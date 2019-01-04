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
                            <h4>Kelola Fungsi</h4>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="horizontalFormExample" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    &nbsp;&nbsp;
                                    <?php if (!empty($cari)) { ?> <a href="<?= base_url(); ?>index.php/fungsi/fungsi/">Tampilkan Semua</a> <?php } ?>
                                    <form action="" method="post" id="search-form" name="search-form" class="fright pos-rel">
                                        <input type="text" id="search-articles" name="key" value="nama fungsi" onFocus="this.value = '';" class="search-con" />
                                        <input type="submit" value="CARI" id="search-btn" name="CARI" class="btn btn-sm btn-default" />
                                    </form>
                                    <center><b><?= $notif2; ?></b></center>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <table class="table table-responsive">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <!-- <th>Kode Jenis  Berita</th> -->
                                                <th>Nama Fungsi</th>
                                                <th>Status Aktif</th>
                                                <th>Kemampuan Disposisi</th>
                                                <th>Kemampuan Tambah Berita</th>
                                                <th>Urutan</th>
                                                <th>Detail</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            foreach ($fungsi as $key => $val) {
                                                $i++;
                                                ?>
                                                <tr>
                                                    <td><?= $opset + $key + 1; ?></td>
                                                   <!-- <td><a href="javascript: void(0)"><?= $val['jenis_kd']; ?></a></td>-->
                                                    <td><a href="javascript: void(0)" class="agreen"><?= $val['nama_fungsi']; ?></a></td>
                                                    <td><a href="javascript: void(0)" class="agreen"><?php
                                                            if ($val['status_fungsi'] == 'Y') {
                                                                echo "Aktif";
                                                            } else {
                                                                echo "Tidak Aktif";
                                                            }
                                                            ?></a></td>
                                                    <td><a href="javascript: void(0)" class="agreen"><?php
                                                            if ($val['disposisi_fungsi'] == 'Y') {
                                                                echo "Ya";
                                                            } else {
                                                                echo "Tidak";
                                                            }
                                                            ?></a></td>
                                                    <td><a href="javascript: void(0)" class="agreen"><?php
                                                            if ($val['fungsi_input'] == 'Y') {
                                                                echo "Ya";
                                                            } else {
                                                                echo "Tidak";
                                                            }
                                                            ?></a></td>
                                                    <td><?php echo $val['fungsi_urut']; ?></a></td>
                                                    <td><a href="<?= base_url(); ?>index.php/fungsi/detail/id/<?= $val['fungsi_kd']; ?>" class="tiptip-top" title="Detail"><img src="<?= base_url(); ?>resources/images/icon_view.png" alt="Detail" /></a></td>
                                                    <td>
                                                        <?php if ($val['fungsi_kd'] == 1 || $val['fungsi_kd'] == 2) { ?>

                                                        <?php } else { ?> 
                                                            <a href="<?= base_url(); ?>index.php/fungsi/delete/id/<?= $val['fungsi_kd']; ?>" class="tiptip-top" title="Delete"><img src="<?= base_url(); ?>resources/images/icon_bad.png" alt="delete" /></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php }
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php echo $this->pagination->create_links(); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="portlet portlet-default">
                                        <div class="portlet-heading">
                                            <div class="portlet-title">
                                                <h4>Tambah Fungsi Baru</h4>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div id="horizontalFormExample" class="panel-collapse collapse in">
                                            <div class="portlet-body">
                                                <div><?= $notif; ?></div>
                                                <?php echo form_open_multipart('fungsi/fungsi', 'class="form-horizontal"'); ?> 
                                                <div class="form-group">
                                                    <label for="inputEmail3" class="col-sm-4 control-label">Nama Fungsi</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" value="<?= $jenis_nama; ?>" id="addarticle-title" name="nama_fungsi"  class="form-control"placeholder="Nama Fungsi">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputPassword3" class="col-sm-4 control-label">Status Aktif</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="addarticle-category" name="status_fungsi">
                                                            <option value="Y" selected="selected">Aktif</option>
                                                            <option value="T">Tidak Aktif</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputPassword3" class="col-sm-4 control-label">Kemampuan Melakukan Disposisi</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="addarticle-category" name="disposisi_fungsi">
                                                            <option value="Y" selected="selected">Ya</option>
                                                            <option value="T">Tidak</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputPassword3" class="col-sm-4 control-label">Kemampuan Menambahkan Arsip</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="addarticle-category" name="fungsi_input">
                                                            <option value="Y" >Ya</option>
                                                            <option value="T" selected="selected">Tidak</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputPassword3" class="col-sm-4 control-label">Urutan Lembar Dispo</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="addarticle-category" name="fungsi_urut">
                                                            <?php
                                                            for ($i = 1; $i <= $jml; $i++) {
                                                                ?><option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
                                                            <?php } ?>

                                                        </select>
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