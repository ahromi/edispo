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

            <h2>Detail Jenis Berita</h2>

            <?php echo form_open_multipart('jenisberita/detail/id/' . $this->uri->segment(4)); ?> 
            <fieldset>
                <div><?= $notif; ?></div>
                <ul class="align-list">
                    <li>
                        <label for="addarticle-title">Jenis Berita</label>
                        <input type="text" value="<?= $jenisberita[0]['jenis_nama']; ?>" id="addarticle-title" name="jenis_nama" class="box-medium" />
                    </li>
                    <li>
                        <label></label>
                        <input type="submit" name="EDIT" value="Submit" class="green" /><br />

                        <a href="<?= base_url(); ?>index.php/jenisberita/jenisberita" onclick="history.back(1)">Kembali</a>
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