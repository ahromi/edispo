<?php
$cari = $this->uri->segment(4);
$notif = $this->session->flashdata('notifikasi');
$notif2 = $this->session->flashdata('notifikasi2');
$derajat_nama = $this->session->flashdata('derajat_nama');
$derajat_kd = $this->session->flashdata('derajat_kd');
$username = $this->session->userdata('SESSION_USERNAME');
if (!empty($username)) {
    $this->load->view('tmpl/header');
    ?>					<div id="content">
        <div id="main-content">

            <h2>Detail Derajat Berita</h2>

            <?php echo form_open_multipart('derajat/detail/id/' . $this->uri->segment(4)); ?> 
            <fieldset>
                <div><?= $notif; ?></div>
                <ul class="align-list">
                    <li>
                        <label for="addarticle-title">Kode Derajat Berita</label>
                        <input type="text" value="<?= $derajat[0]['derajat_kd']; ?>" id="addarticle-title" name="derajat_kd" class="box-medium" />
                    </li>
                    <li>
                        <label for="addarticle-title">Nama Derajat Berita</label>
                        <input type="text" value="<?= $derajat[0]['derajat_nama']; ?>" id="addarticle-title" name="derajat_nama" class="box-medium" />
                    </li>
                    <li>
                        <label></label>
                        <input type="submit" name="EDIT" value="Submit" class="green" /><br />

                        <a href="<?= base_url(); ?>index.php/derajat/derajat" onclick="history.back(1)">Kembali</a>
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