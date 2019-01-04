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
            <h2>Kelola Jenis  Berita</h2>
            <div class="simple-con tleft">
                &nbsp;&nbsp;
                <? if (!empty($cari)) { ?> <a href="<?= base_url(); ?>index.php/jenisberita/jenisberita/">Tampilkan Semua</a> <? } ?>
                <form action="" method="post" id="search-form" name="search-form" class="fright pos-rel">
                    <input type="text" id="search-articles" name="key" value="nama jenisberita" onFocus="this.value = '';" class="search-con" />
                    <input type="submit" value="CARI" id="search-btn" name="CARI" class="grey search-con" />
                </form>

            </div>
            <center><b><?= $notif2; ?></b></center>
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <!-- <th>Kode Jenis  Berita</th> -->
                        <th>Jenis  Berita</th>
                        <th>Detail</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0;
                    foreach ($jenisberita as $key => $val) {
                        $i++;
                        ?>
                        <tr>
                            <td><?= $opset + $key + 1; ?></td>
                           <!-- <td><a href="javascript: void(0)"><?= $val['jenis_kd']; ?></a></td>-->
                            <td><a href="javascript: void(0)" class="agreen"><?= $val['jenis_nama']; ?></a></td>
                            <td><a href="<?= base_url(); ?>index.php/jenisberita/detail/id/<?= $val['jenis_kd']; ?>" class="tiptip-top" title="Detail"><img src="<?= base_url(); ?>resources/images/icon_view.png" alt="Detail" /></a></td>
                            <td><a href="<?= base_url(); ?>index.php/jenisberita/delete/id/<?= $val['jenis_kd']; ?>" class="tiptip-top" title="Delete"><img src="<?= base_url(); ?>resources/images/icon_bad.png" alt="delete" /></a></td>
                        </tr>
    <?php }
    ?>
                </tbody>
            </table>
    <?php echo $this->pagination->create_links(); ?>

            <h2>Tambah Jenis  Berita Baru</h2>

    <?php echo form_open_multipart('jenisberita/jenisberita'); ?> 
            <fieldset>
                <div><?= $notif; ?></div>
                <ul class="align-list">
                    <li>
                        <label for="addarticle-title">Nama Jenis  Berita</label>
                        <input type="text" value="<?= $jenis_nama; ?>" id="addarticle-title" name="jenis_nama" class="box-medium" />
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