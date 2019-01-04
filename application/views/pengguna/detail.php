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

            <h2>Detail Pengguna</h2>

            <?php echo form_open_multipart('pengguna/detail/id/' . $this->uri->segment(4)); ?> 
            <fieldset>
                <div><?= $notif; ?></div>
                <ul class="align-list">
                    <li>
                        <label for="addarticle-title">Nama Lengkap</label>
                        <input type="text" value="<?= $pengguna[0]['user_namalengkap']; ?>" id="addarticle-title" name="user_namalengkap" class="box-medium" />
                    </li>
                    <li>
                        <label for="addarticle-category">Pejabat Fungsi</label>
                        <select id="addarticle-category" name="fungsi_kd">
                            <option value="<?= $pengguna[0]['fungsi_kd']; ?>" selected><?= $pengguna[0]['nama_fungsi']; ?></option>
                            <? foreach($fungsi as $val) { ?>
                            <option value="<?= $val['fungsi_kd']; ?>"><?= $val['nama_fungsi']; ?></option>
                            <? }?>
                        </select>
                    </li>
                    <li>
                        <label for="addarticle-category">Merupakan Koord. Fungsi / Fungsi Mandiri ?</label>
                        <select id="addarticle-category" name="koordinator_fungsi">
                            <option value="<?= $pengguna[0]['koordinator_fungsi']; ?>" selected>
                                <?php if ($pengguna[0]['koordinator_fungsi'] == 'Y') {
                                    echo "YA";
                                } else {
                                    echo "TIDAK";
                                } ?></option>
                            <option value="Y">YA</option>
                            <option value="T">TIDAK</option>
                        </select>
                    </li>
                    <li>
                        <label for="addarticle-title">Nama User</label>
                        <input type="text" id="addarticle-title" name="user_nama" value="<?= $pengguna[0]['user_nama']; ?>" class="box-small" />
                    </li>
                    <li>
                        <label for="addarticle-content">Password</label>
                        <input type="password" id="addarticle-title" name="user_password" class="box-small" /> (kosongkan jika tidak diubah)
                    </li>
                    <label for="addarticle-image">Gambar Profil</label>
                    <input type="file" id="addarticle-image" name="userfile"/>(kosongkan jika tidak diubah)
                    </li>
                    <li>
                        <label for="addarticle-category">Dapat Menerima Disposisi ?</label>
                        <select id="addarticle-category" name="user_menerima_disposisi">

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
                    </li>
                    <li>
                        <label for="addarticle-category">Status</label>
                        <select id="addarticle-category" name="user_status">

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
                    </li>
                    <li>
                        <label for="addarticle-content">Email</label>
                        <input type="text" id="addarticle-title" name="user_email" class="box-medium" value="<?= $pengguna[0]['user_email']; ?>" />
                    </li>
                    <li>
                        <label for="addarticle-content">Notifikasi Email</label>
                        <input type="radio" id="addarticle-title" name="user_notifikasi_email" value="1" <?php if ($pengguna[0]['user_notifikasi_email'] == 1) { ?> checked <?php } ?> class="box-medium" /> YA (email wajib diisi)
                        <input type="radio" id="addarticle-title" name="user_notifikasi_email" value="0" <?php if ($pengguna[0]['user_notifikasi_email'] == 0) { ?> checked <?php } ?> class="box-medium" /> TIDAK 
                    </li>                                       
                    <li>
                        <label></label>
                        <input type="submit" name="EDIT" value="Submit" class="green" /><br />

                        <a href="<?= base_url(); ?>index.php/pengguna/pengguna" onclick="history.back(1)">Kembali</a>
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