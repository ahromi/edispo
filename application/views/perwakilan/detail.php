<?php
$cari = $this->uri->segment(4);
$notif = $this->session->flashdata('notifikasi');
$notif2 = $this->session->flashdata('notifikasi2');
$perwakilan_nama = $this->session->flashdata('perwakilan_nama');
$perwakilan_kd = $this->session->flashdata('perwakilan_kd');
$username = $this->session->userdata('SESSION_USERNAME');
if (!empty($username)) {
    $this->load->view('tmpl/header');
    ?>					<div id="content">
        <div id="main-content">

            <h2>Detail Perwakilan</h2>

            <?php echo form_open_multipart('perwakilan/detail/id/' . $this->uri->segment(4)); ?> 
            <fieldset>
                <div><?= $notif; ?></div>
                <ul class="align-list">
                    <li>
                        <label for="addarticle-title">Nama Perwakilan</label>
                        <input type="text" value="<?= $perwakilan[0]['perwakilan_nama']; ?>" id="addarticle-title" name="perwakilan_nama" class="box-medium" />
                    </li>
                    <li>
                        <label></label>
                        <input type="submit" name="EDIT" value="Submit" class="green" /><br />

                        <a href="<?= base_url(); ?>index.php/perwakilan/perwakilan" onclick="history.back(1)">Kembali</a>
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