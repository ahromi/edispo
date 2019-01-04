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
            <h2>Kelola Pengirim</h2>
            <div class="simple-con tleft">
                &nbsp;&nbsp;
                <?php if (!empty($cari)) { ?> <a href="<?= base_url(); ?>index.php/perwakilan/perwakilan/">Tampilkan Semua</a> <?php } ?>
                <form action="" method="post" id="search-form" name="search-form" class="fright pos-rel">
                    <input type="text" id="search-articles" name="key" value="nama pengirim" onFocus="this.value = '';" class="search-con" />
                    <input type="submit" value="CARI" id="search-btn" name="CARI" class="grey search-con" />
                </form>

            </div>
            <center><b><?= $notif2; ?></b></center>
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <!-- <th>Kode Pengirim</th> -->
                        <th>Nama Pengirim</th>
                        <th>Detail</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($perwakilan as $key => $val) {
                        $i++;
                        ?>
                        <tr>
                            <td><?= $opset + $key + 1; ?></td>
                           <!-- <td><a href="javascript: void(0)"><?= $val['perwakilan_kd']; ?></a></td> -->
                            <td><a href="javascript: void(0)" class="agreen"><?= $val['perwakilan_nama']; ?></a></td>
                            <td><a href="<?= base_url(); ?>index.php/perwakilan/detail/id/<?= $val['perwakilan_kd']; ?>" class="tiptip-top" title="Detail"><img src="<?= base_url(); ?>resources/images/icon_view.png" alt="Detail" /></a></td>
                            <td><a href="<?= base_url(); ?>index.php/perwakilan/delete/id/<?= $val['perwakilan_kd']; ?>" class="tiptip-top" title="Delete"><img src="<?= base_url(); ?>resources/images/icon_bad.png" alt="delete" /></a></td>
                        </tr>
                    <?php }
                    ?>
                </tbody>
            </table>
    <?php echo $this->pagination->create_links(); ?>

            <h2>Tambah Pengirim Baru</h2>

    <?php echo form_open_multipart('perwakilan/perwakilan'); ?> 
            <fieldset>
                <div><?= $notif; ?></div>
                <ul class="align-list">
                    <li>
                        <label for="addarticle-title">Nama Pengirim</label>
                        <input type="text" value="<?= $perwakilan_nama; ?>" id="addarticle-title" name="perwakilan_nama" class="box-medium" />
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