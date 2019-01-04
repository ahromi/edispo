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
                            <h4>Detail Pengguna</h4>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="horizontalFormExample" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <div><?= $notif; ?></div>
                            <?php echo form_open_multipart('pengguna/detail/id/' . $this->uri->segment(4),'class="form-horizontal"'); ?> 
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">Nama Lengkap</label>
                                <div class="col-sm-8">
                                    <input type="text" value="<?= $pengguna[0]['user_namalengkap']; ?>" id="addarticle-title" name="user_namalengkap"  class="form-control"placeholder="Nama Fungsi">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-4 control-label">Pejabat Fungsi</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="addarticle-category" name="fungsi_kd">
                                        <option value="<?= $pengguna[0]['fungsi_kd']; ?>" selected><?= $pengguna[0]['nama_fungsi']; ?></option>
                                        <?php foreach ($fungsi as $val) { ?>
                                            <option value="<?= $val['fungsi_kd']; ?>"><?= $val['nama_fungsi']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-4 control-label">Nama User</label>
                                <div class="col-sm-8">
                                    <input type="text" id="addarticle-title" name="user_nama" value="<?= $pengguna[0]['user_nama']; ?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-4 control-label">Password</label>
                                <div class="col-sm-8">
                                    <input type="password" id="addarticle-title" name="user_password" class="form-control" />(kosongkan jika tidak diubah)
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-4 control-label">Gambar Profil</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="file" id="addarticle-image" name="userfile"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-4 control-label">Merupakan Koord. Fungsi / Fungsi Mandiri ?</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="addarticle-category" name="koordinator_fungsi">
                                        <option value="<?= $pengguna[0]['koordinator_fungsi']; ?>" selected>
                                            <?php
                                            if ($pengguna[0]['koordinator_fungsi'] == 'Y') {
                                                echo "YA";
                                            } else {
                                                echo "TIDAK";
                                            }
                                            ?></option>
                                        <option value="Y">Ya</option>
                                        <option value="T">Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-4 control-label">Dapat Menerima Disposisi ?</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="addarticle-category" name="user_menerima_disposisi">
                                        <option value="<?= $pengguna[0]['user_menerima_disposisi']; ?>">							
                                            <?php
                                            if ($pengguna[0]['user_menerima_disposisi'] == "Y") {
                                                echo "Ya";
                                            } else {
                                                echo "Tidak";
                                            }
                                            ?></option> 
                                        <option value="Y">Ya</option>
                                        <option value="T">Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-4 control-label">Status</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="addarticle-category" name="user_status">
                                        <option value="<?= $pengguna[0]['user_status']; ?>">							
                                            <?php
                                            if ($pengguna[0]['user_status'] == "Y") {
                                                echo "Aktif";
                                            } else {
                                                echo "Tidak Aktif";
                                            }
                                            ?></option> 
                                        <option value="Y">Aktif</option>
                                        <option value="T">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-4 control-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="text" id="addarticle-title" name="user_email" value="<?= $pengguna[0]['user_email']; ?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-4 control-label">Notifikasi Email</label>
                                <div class="col-sm-8">
                                    <input type="radio" id="addarticle-title" name="user_notifikasi_email" value="1" <?php if ($pengguna[0]['user_notifikasi_email'] == 1) { ?> checked <?php } ?> class="box-medium" /> YA (email wajib diisi)
                                    <input type="radio" id="addarticle-title" name="user_notifikasi_email" value="0" <?php if ($pengguna[0]['user_notifikasi_email'] == 0) { ?> checked <?php } ?> class="box-medium" /> TIDAK 
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <input type="submit" name="EDIT" value="Submit" class="btn btn-sm btn-default" />
                                </div>
                            </div>
                            </form>
                            <a class="btn btn-sm btn-success" href="<?= base_url(); ?>index.php/pengguna/pengguna" onclick="history.back(1)">Kembali</a>
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