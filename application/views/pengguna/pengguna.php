<?php
$cari = $this->uri->segment(4);
$notif = $this->session->flashdata('notifikasi');
$notif2 = $this->session->flashdata('notifikasi2');
$user_nama = $this->session->flashdata('user_nama');
$user_namalengkap = $this->session->flashdata('user_namalengkap');
$username = $this->session->userdata('SESSION_USERNAME');
if (!empty($username)) {
    $this->load->view('tmpl/header');
    ?>					<div id="content">
        <div id="main-content">
            <h2>Kelola Pengguna</h2>
            <div class="simple-con tleft">
                &nbsp;&nbsp;
                <?php if (!empty($cari)) { ?> <a href="<?= base_url(); ?>index.php/pengguna/pengguna/">Tampilkan Semua</a> <?php } ?>
                <form action="" method="post" id="search-form" name="search-form" class="fright pos-rel">
                    <input type="text" id="search-articles" name="key" value="username | nama lengkap | jabatan fungsi" onFocus="this.value = '';" class="search-con" />
                    <input type="submit" value="CARI" id="search-btn" name="CARI" class="grey search-con" />
                </form>

            </div>
            <center><b><?= $notif2; ?></b></center>
            <table>
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
                    <?php $i = 0;
                    foreach ($pengguna as $key => $val) {
                        $i++;
                        ?>
                        <tr>
                            <td><?= $opset + $key + 1; ?></td>
                            <td><a href="javascript: void(0)"><?= $val['user_nama']; ?></a></td>
                            <td><a href="javascript: void(0)" class="agreen"><?= $val['user_namalengkap']; ?></a></td>
                            <td><?php echo $val['nama_fungsi']; ?></td>
                            <td><?php if ($val['koordinator_fungsi'] == 'Y') {
                            echo 'YA';
                        } else {
                            echo "TIDAK";
                        } ?></td>
                            <td><?= $val['user_email']; ?> / <?php if ($val['user_notifikasi_email'] == 1) {
                    echo "Ya";
                } else {
                    echo "Tidak";
                } ?></td>
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

            <h2>Tambah Pengguna Baru</h2>

    <?php echo form_open_multipart('pengguna/pengguna'); ?> 
            <fieldset>
                <div><?= $notif; ?></div>
                <ul class="align-list">
                    <li>
                        <label for="addarticle-title">Nama Lengkap</label>
                        <input type="text" value="<?= $user_namalengkap; ?>" id="addarticle-title" name="user_namalengkap" class="box-medium" />
                    </li>
                    <li>
                        <label for="addarticle-category">Pejabat Fungsi</label>
                        <select id="addarticle-category" name="fungsi_kd">
                            <option value="0" selected>Choose</option>
    <?php foreach ($fungsi as $val) { ?>
                                <option value="<?= $val['fungsi_kd']; ?>"><?= $val['nama_fungsi']; ?></option>
    <?php } ?>
                        </select>
                    </li>
                    <li>
                        <label for="addarticle-title">Nama User</label>
                        <input type="text" id="addarticle-title" name="user_nama" value="<?= $user_nama; ?>" class="box-small" />
                    </li>
                    <li>
                        <label for="addarticle-content">Password</label>
                        <input type="password" id="addarticle-title" name="user_password" class="box-small" />
                    </li>
                    <label for="addarticle-image">Gambar Profil</label>
                    <input type="file" id="addarticle-image" name="userfile"/>
                    </li>
                    <li>
                        <label for="addarticle-category">Merupakan Koord. Fungsi / Fungsi Mandiri ?</label>
                        <select id="addarticle-category" name="koordinator_fungsi">
                            <option value="Y">Ya</option>
                            <option value="T">Tidak</option>
                        </select>
                    </li>
                    <li>
                        <label for="addarticle-category">Dapat Menerima Disposisi ?</label>
                        <select id="addarticle-category" name="user_menerima_disposisi">
                            <option value="Y">Ya</option>
                            <option value="T">Tidak</option>
                        </select>
                    </li>
                    <li>
                        <label for="addarticle-category">Status</label>
                        <select id="addarticle-category" name="user_status">
                            <option value="Y">Aktif</option>
                            <option value="T">Tidak Aktif</option>
                        </select>
                    </li>
                    <li>
                        <label for="addarticle-content">Email</label>
                        <input type="text" id="addarticle-title" name="user_email" class="box-medium" />
                    </li>
                    <li>
                        <label for="addarticle-content">Notifikasi Email</label>
                        <input type="radio" id="addarticle-title" name="user_notifikasi_email" value="1"  class="box-medium" /> YA (email wajib diisi)
                        <input type="radio" id="addarticle-title" name="user_notifikasi_email" value="0" checked class="box-medium" /> TIDAK 
                    </li>                                       
                    <li>
                        <label></label>
                        <input type="submit" name="TAMBAH" value="Submit" class="green" />
                        <input type="submit" value="Clear all" class="red	" onClick="this.form.reset();" />
                    </li>
                    <li>
                </ul>
            </fieldset>
            </form>
        </div>
    </div>
    <?php $this->load->view('tmpl/footer'); ?>
    <?php
} else {
    redirect('');
}
?>