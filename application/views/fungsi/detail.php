<?php
$cari = $this->uri->segment(4);
$notif = $this->session->flashdata('notifikasi');
$notif2 = $this->session->flashdata('notifikasi2');
$jenis_nama = $this->session->flashdata('jenis_nama');
$jenis_kd = $this->session->flashdata('jenis_kd');
$username = $this->session->userdata('SESSION_USERNAME');
if (!empty($username)) {
    $this->load->view('tmpl/header');
    ?>					<div id="content">
        <div id="main-content">

            <h2>Detail Fungsi</h2>

            <?php echo form_open_multipart('fungsi/detail/id/' . $this->uri->segment(4)); ?> 
            <fieldset>
                <div><?= $notif; ?></div>
                <ul class="align-list">
                    <li>
                        <label for="addarticle-title">Nama Fungsi</label>
                        <input type="text" value="<?= $fungsi[0]['nama_fungsi']; ?>" id="addarticle-title" name="nama_fungsi" class="box-medium" />
                    </li>
                    <li>
                        <label for="addarticle-title">Status Aktif</label>
                        <select id="addarticle-category" name="status_fungsi">
                            <?php if ($fungsi[0]['status_fungsi'] == 'Y') {
                                ?>
                                <option value="Y" selected="selected" >Aktif</option>
                            <?php } else { ?>
                                <option value="T" selected="selected">Tidak Aktif</option>
                            <?php } ?>
                            <option value="Y" >Aktif</option>
                            <option value="T">Tidak Aktif</option>
                        </select>
                    </li>
                    <li>
                        <label for="addarticle-title">Kemampuan Melakukan Disposisi</label>
                        <select id="addarticle-category" name="disposisi_fungsi">
                            <?php if ($fungsi[0]['disposisi_fungsi'] == 'Y') { ?>
                                <option value="Y" selected="selected" >Ya</option>
                            <?php } else { ?>
                                <option value="T" selected="selected">Tidak</option>
                            <?php } ?>
                            <option value="Y">Ya</option>
                            <option value="T">Tidak</option>
                        </select>
                    </li>
                    <li>
                        <label for="addarticle-title">Kemampuan Menambahkan Arsip</label>
                        <select id="addarticle-category" name="fungsi_input">
                            <?php if ($fungsi[0]['fungsi_input'] == 'Y') { ?>
                                <option value="Y" selected="selected" >Ya</option>
                            <?php } else { ?>
                                <option value="T" selected="selected">Tidak</option>
                            <?php } ?>
                            <option value="Y" >Ya</option>
                            <option value="T">Tidak</option>
                        </select>
                    </li>
                    <li>
                        <label for="addarticle-title">Urutan Lembar Dispo</label>
                        <select id="addarticle-category" name="fungsi_urut">
                            <option selected="selected" value="<?php echo $fungsi[0]['fungsi_urut']; ?>" ><?php echo $fungsi[0]['fungsi_urut']; ?></option>
                            <?php
                            for ($i = 1; $i <= $jml; $i++) {
                                ?><option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
                            <?php } ?>

                        </select>
                    </li>
                    <li>
                        <label></label>
                        <input type="submit" name="EDIT" value="Submit" class="green" /><br />

                        <a href="<?= base_url(); ?>index.php/fungsi/fungsi" onclick="history.back(1)">Kembali</a>
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