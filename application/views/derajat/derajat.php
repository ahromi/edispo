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
            <h2>Kelola Derajat Berita</h2>
            <div class="simple-con tleft">
                &nbsp;&nbsp;
                <?php if (!empty($cari)) { ?> <a href="<?= base_url(); ?>index.php/derajat/derajat/">Tampilkan Semua</a> <?php } ?>
                <form action="" method="post" id="search-form" name="search-form" class="fright pos-rel">
                    <input type="text" id="search-articles" name="key" value="nama derajat" onFocus="this.value = '';" class="search-con" />
                    <input type="submit" value="CARI" id="search-btn" name="CARI" class="grey search-con" />
                </form>

            </div>
            <center><b><?= $notif2; ?></b></center>
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kode Derajat Berita</th>
                        <th>Nama Derajat Berita</th>
                        <th>Detail</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0;
                    foreach ($derajat as $key => $val) {
                        $i++;
                        ?>
                        <tr>
                            <td><?= $opset + $key + 1; ?></td>
                            <td><a href="javascript: void(0)"><?= $val['derajat_kd']; ?></a></td>
                            <td><a href="javascript: void(0)" class="agreen"><?= $val['derajat_nama']; ?></a></td>
                            <td><a href="<?= base_url(); ?>index.php/derajat/detail/id/<?= $val['derajat_kd']; ?>" class="tiptip-top" title="Detail"><img src="<?= base_url(); ?>resources/images/icon_view.png" alt="Detail" /></a></td>
                            <td><a href="<?= base_url(); ?>index.php/derajat/delete/id/<?= $val['derajat_kd']; ?>" class="tiptip-top" title="Delete"><img src="<?= base_url(); ?>resources/images/icon_bad.png" alt="delete" /></a></td>
                        </tr>
    <?php }
    ?>
                </tbody>
            </table>
    <?php echo $this->pagination->create_links(); ?>

            <h2>Tambah Derajat Berita Baru</h2>

    <?php echo form_open_multipart('derajat/derajat'); ?> 
            <fieldset>
                <div><?= $notif; ?></div>
                <ul class="align-list">
                    <li>
                        <label for="addarticle-title">Kode Derajat Berita</label>
                        <input type="text" value="<?= $derajat_kd; ?>" id="addarticle-title" name="derajat_kd" class="box-medium" />
                    </li>
                    <li>
                        <label for="addarticle-title">Nama Derajat Berita</label>
                        <input type="text" value="<?= $derajat_nama; ?>" id="addarticle-title" name="derajat_nama" class="box-medium" />
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