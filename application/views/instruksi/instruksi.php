<?php
$cari = $this->uri->segment(4);
$notif = $this->session->flashdata('notifikasi');
$notif2 = $this->session->flashdata('notifikasi2');
$instruksi_nama = $this->session->flashdata('instruksi_nama');
$instruksi_kd = $this->session->flashdata('instruksi_kd');
$username = $this->session->userdata('SESSION_USERNAME');
if (!empty($username)) {
    $this->load->view('tmpl/header');
    ?>					<div id="content">
        <div id="main-content">
            <h2>Kelola Instruksi  Disposisi</h2>
            <div class="simple-con tleft">
                &nbsp;&nbsp;
                <?php if (!empty($cari)) { ?> <a href="<?= base_url(); ?>index.php/instruksi/instruksi/">Tampilkan Semua</a> <?php } ?>
                    <form action="" method="post" id="search-form" name="search-form" class="fright pos-rel">
                        <input type="text" id="search-articles" name="key" value="nama instruksi" onFocus="this.value = '';" class="search-con" />
                        <input type="submit" value="CARI" id="search-btn" name="CARI" class="grey search-con" />
                    </form>

                </div>
                <?php if (!empty($notif2)) { ?> <script languange="javascript">window.alert(<?php echo $notif2; ?>);</script><?php } ?>
                <table>
                    <thead>
                        <tr>
                            <th>No.</th> 
                            <th>Nama Instruksi</th>
                            <th>Status</th>
                            <th>Detail</th>
                            <th>Ubah Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($instruksi as $key => $val) {
                            $i++;
                            ?>
                            <tr>
                                <td><?= $opset + $key + 1; ?></td>
                               <!-- <td><a href="javascript: void(0)"><?= $val['instruksi_kd']; ?></a></td>-->
                                <td><a href="javascript: void(0)" class="agreen"><?= $val['instruksi_nama']; ?></a></td>
                                <td><?php echo $val['instruksi_status']; ?></td>
                                <td><a href="<?= base_url(); ?>index.php/instruksi/detail/id/<?= $val['instruksi_kd']; ?>" class="tiptip-top" title="Detail"><img src="<?= base_url(); ?>resources/images/icon_view.png" alt="Detail" /></a></td>
                                <td><a href="<?= base_url(); ?>index.php/instruksi/status/id/<?= $val['instruksi_kd']; ?>/<? echo $val['instruksi_status']; ?>" class="tiptip-top" title="Delete"><img src="<?= base_url(); ?>resources/images/<?php echo $val['instruksi_status']; ?>.png" alt="change status" /></a></td>
                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
        <?php echo $this->pagination->create_links(); ?>

                <h2>Tambah Instruksi Baru</h2>

        <?php echo form_open_multipart('instruksi/instruksi'); ?> 
                <fieldset>
                    <div><?= $notif; ?></div>
                    <ul class="align-list">
                        <li>
                            <label for="addarticle-title">Nama Instruksi</label>
                            <input type="text" value="<?= $instruksi_nama; ?>" id="addarticle-title" name="instruksi_nama" class="box-medium" />
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