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
            <h2>Kelola Fungsi</h2>
            <div class="simple-con tleft">
                &nbsp;&nbsp;
                <?php if (!empty($cari)) { ?> <a href="<?= base_url(); ?>index.php/fungsi/fungsi/">Tampilkan Semua</a> <?php } ?>
                <form action="" method="post" id="search-form" name="search-form" class="fright pos-rel">
                    <input type="text" id="search-articles" name="key" value="nama fungsi" onFocus="this.value = '';" class="search-con" />
                    <input type="submit" value="CARI" id="search-btn" name="CARI" class="grey search-con" />
                </form>

            </div>
            <center><b><?= $notif2; ?></b></center>
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <!-- <th>Kode Jenis  Berita</th> -->
                        <th>Nama Fungsi</th>
                        <th>Status Aktif</th>
                        <th>Kemampuan Disposisi</th>
                        <th>Kemampuan Tambah Berita</th>
                        <th>Urutan</th>
                        <th>Detail</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($fungsi as $key => $val) {
                        $i++;
                        ?>
                        <tr>
                            <td><?= $opset + $key + 1; ?></td>
                           <!-- <td><a href="javascript: void(0)"><?= $val['jenis_kd']; ?></a></td>-->
                            <td><a href="javascript: void(0)" class="agreen"><?= $val['nama_fungsi']; ?></a></td>
                            <td><a href="javascript: void(0)" class="agreen"><?php
                                    if ($val['status_fungsi'] == 'Y') {
                                        echo "Aktif";
                                    } else {
                                        echo "Tidak Aktif";
                                    }
                                    ?></a></td>
                            <td><a href="javascript: void(0)" class="agreen"><?php
                                    if ($val['disposisi_fungsi'] == 'Y') {
                                        echo "Ya";
                                    } else {
                                        echo "Tidak";
                                    }
                                    ?></a></td>
                            <td><a href="javascript: void(0)" class="agreen"><?php
                            if ($val['fungsi_input'] == 'Y') {
                                echo "Ya";
                            } else {
                                echo "Tidak";
                            }
                            ?></a></td>
                            <td><?php echo $val['fungsi_urut']; ?></a></td>
                            <td><a href="<?= base_url(); ?>index.php/fungsi/detail/id/<?= $val['fungsi_kd']; ?>" class="tiptip-top" title="Detail"><img src="<?= base_url(); ?>resources/images/icon_view.png" alt="Detail" /></a></td>
                            <td>
                        <?php if ($val['fungsi_kd'] == 1 || $val['fungsi_kd'] == 2) { ?>

                        <?php } else { ?> 
                                    <a href="<?= base_url(); ?>index.php/fungsi/delete/id/<?= $val['fungsi_kd']; ?>" class="tiptip-top" title="Delete"><img src="<?= base_url(); ?>resources/images/icon_bad.png" alt="delete" /></a>
                <?php } ?>
                            </td>
                        </tr>
    <?php }
    ?>
                </tbody>
            </table>
    <?php echo $this->pagination->create_links(); ?>

            <h2>Tambah Fungsi Baru</h2>

    <?php echo form_open_multipart('fungsi/fungsi'); ?> 
            <fieldset>
                <div><?= $notif; ?></div>
                <ul class="align-list">
                    <li>
                        <label for="addarticle-title">Nama Fungsi</label>
                        <input type="text" value="<?= $jenis_nama; ?>" id="addarticle-title" name="nama_fungsi" class="box-medium" />
                    </li>
                    <li>
                        <label for="addarticle-title">Status Aktif</label>
                        <select id="addarticle-category" name="status_fungsi">
                            <option value="Y" selected="selected">Aktif</option>
                            <option value="T">Tidak Aktif</option>
                        </select>
                    </li>
                    <li>
                        <label for="addarticle-title">Kemampuan Melakukan Disposisi</label>
                        <select id="addarticle-category" name="disposisi_fungsi">
                            <option value="Y" selected="selected">Ya</option>
                            <option value="T">Tidak</option>
                        </select>
                    </li>
                    <li>
                        <label for="addarticle-title">Kemampuan Menambahkan Arsip</label>
                        <select id="addarticle-category" name="fungsi_input">
                            <option value="Y" >Ya</option>
                            <option value="T" selected="selected">Tidak</option>
                        </select>
                    </li>
                    <li>
                        <label for="addarticle-title">Urutan Lembar Dispo</label>
                        <select id="addarticle-category" name="fungsi_urut">
    <?php
    for ($i = 1; $i <= $jml; $i++) {
        ?><option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
    <?php } ?>

                        </select>
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