<?php
$cari = $this->uri->segment(4);
$notif = $this->session->flashdata('notifikasi');
$notif2 = $this->session->flashdata('notifikasi2');
$user_nama = $this->session->flashdata('user_nama');
$user_namalengkap = $this->session->flashdata('user_namalengkap');
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
                            <h4>Kelola Pengguna</h4>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="horizontalFormExample" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    &nbsp;&nbsp;
                                    <?php if (!empty($cari)) { ?> <a href="<?= base_url(); ?>index.php/pengguna/pengguna/">Tampilkan Semua</a> <?php } ?>
                                    <form action="" method="post" id="search-form" name="search-form" class="fright pos-rel">
                                        <input type="text" id="search-articles" name="key" value="username | nama lengkap | jabatan fungsi" onFocus="this.value = '';" class="search-con" />
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
                                                <th>Username</th>
                                                <th>Nama Lengkap</th>
                                                <th>Jabatan Fungsi</th>
                                                <th>Koordinator</th>
                                                <th>Email / Notif</th>
                                                <th>Terima Dispo</th>
                                                <th>Status Aktif</th>
                                                <th>Detail</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            foreach ($pengguna as $key => $val) {
                                                $i++;
                                                ?>
                                                <tr>
                                                    <td><?= $opset + $key + 1; ?></td>
                                                    <td><a href="javascript: void(0)"><?= $val['user_nama']; ?></a></td>
                                                    <td><a href="javascript: void(0)" class="agreen"><?= $val['user_namalengkap']; ?></a></td>
                                                    <td><?php echo $val['nama_fungsi']; ?></td>
                                                    <td><?php
                                                        if ($val['koordinator_fungsi'] == 'Y') {
                                                            echo 'YA';
                                                        } else {
                                                            echo "TIDAK";
                                                        }
                                                        ?></td>
                                                    <td><?= $val['user_email']; ?> / <?php
                                                        if ($val['user_notifikasi_email'] == 1) {
                                                            echo "Ya";
                                                        } else {
                                                            echo "Tidak";
                                                        }
                                                        ?></td>
                                                    <td><?= $val['user_menerima_disposisi']; ?></td>
                                                    <td><?= $val['user_status']; ?></td>
                                                    <td><a href="<?= base_url(); ?>index.php/pengguna/detail/id/<?= $val['user_kd']; ?>" class="tiptip-top" title="Detail"><img src="<?= base_url(); ?>resources/images/icon_view.png" alt="Detail" /></a></td>
                                                    <td><a href="<?= base_url(); ?>index.php/pengguna/delete/id/<?= $val['user_kd']; ?>" class="tiptip-top" title="Delete"><img src="<?= base_url(); ?>resources/images/icon_bad.png" alt="delete" /></a></td>
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
                                                <h4>Tambah Pengguna Baru</h4>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div id="horizontalFormExample" class="panel-collapse collapse in">
                                            <div class="portlet-body">
                                                <div><?= $notif; ?></div>
                                                <?php echo form_open_multipart('pengguna/pengguna', 'class="form-horizontal"'); ?> 
                                                <div class="form-group">
                                                    <label for="inputEmail3" class="col-sm-4 control-label">Nama Lengkap</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" value="<?= $user_namalengkap; ?>" id="addarticle-title" name="user_namalengkap"  class="form-control"placeholder="Nama Fungsi">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputPassword3" class="col-sm-4 control-label">Pejabat Fungsi</label>
                                                    <div class="col-sm-8">
                                                        <select id="addarticle-category" name="fungsi_kd">
                                                            <option value="0" selected>Choose</option>
                                                            <?php foreach ($fungsi as $val) { ?>
                                                                <option value="<?= $val['fungsi_kd']; ?>"><?= $val['nama_fungsi']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputPassword3" class="col-sm-4 control-label">Nama User</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="addarticle-title" name="user_nama" value="<?= $user_nama; ?>" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputPassword3" class="col-sm-4 control-label">Password</label>
                                                    <div class="col-sm-8">
                                                        <input type="password" id="addarticle-title" name="user_password" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputPassword3" class="col-sm-4 control-label">Gambar Profil</label>
                                                    <div class="col-sm-8">
                                                        <input type="file" id="addarticle-image" name="userfile"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputPassword3" class="col-sm-4 control-label">Merupakan Koord. Fungsi / Fungsi Mandiri ?</label>
                                                    <div class="col-sm-8">
                                                        <select id="addarticle-category" name="koordinator_fungsi">
                                                            <option value="Y">Ya</option>
                                                            <option value="T">Tidak</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputPassword3" class="col-sm-4 control-label">Dapat Menerima Disposisi ?</label>
                                                    <div class="col-sm-8">
                                                        <select id="addarticle-category" name="user_menerima_disposisi">
                                                            <option value="Y">Ya</option>
                                                            <option value="T">Tidak</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputPassword3" class="col-sm-4 control-label">Status</label>
                                                    <div class="col-sm-8">
                                                        <select id="addarticle-category" name="user_status">
                                                            <option value="Y">Aktif</option>
                                                            <option value="T">Tidak Aktif</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputPassword3" class="col-sm-4 control-label">Email</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="addarticle-title" name="user_email" class="box-medium" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputPassword3" class="col-sm-4 control-label">Notifikasi Email</label>
                                                    <div class="col-sm-8">
                                                        <input type="radio" id="addarticle-title" name="user_notifikasi_email" value="1"  class="box-medium" /> YA (email wajib diisi)
                                                        <input type="radio" id="addarticle-title" name="user_notifikasi_email" value="0" checked class="box-medium" /> TIDAK 
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