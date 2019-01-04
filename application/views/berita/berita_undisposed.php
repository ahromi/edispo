<?php
$cari = $this->uri->segment(4);
$notif = $this->session->flashdata('notifikasi');
$notif2 = $this->session->flashdata('notifikasi2');
$user_nama = $this->session->flashdata('user_nama');
$user_namalengkap = $this->session->flashdata('user_namalengkap');
$username = $this->session->userdata('SESSION_USERNAME');
$level_id = $this->session->userdata('SESSION_FUNGSI_KD');
if (!empty($username)) {
    $this->load->view('tmpl/header');
    if ($this->session->userdata('SESSION_FUNGSI_KD') == 2 || $this->session->userdata('SESSION_FUNGSI_KD') == 1) {
        $title = "";
    } else {
        $title = " yang Terdisposisi kepada Anda";
    }
    ?>
    <div id="content">
        <div id="main-content">
            <h2>Arsip Berita MENUNGGU DISPOSISI</h2>
            <center><b><?= $notif2; ?></b></center>
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kode Arsip</th>
                        <th>No. Berita</th>
                        <th>Perihal Berita</th>
                        <th>Tgl Berita</th>
                        <th>Instansi Pengirim</th>
    <?php if ($level_id == '2') { ?>
                            <th>Perubahan</th>
    <?php } ?>
                        <th>Disposisi</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0;
                    if (empty($berita)) {
                        ?>
                        <tr id="row"><td colspan="8" align="center">Tidak ada data!</td></tr>
    <?php } else {
        foreach ($berita as $key => $val) {
            $i++;
            ?>
                            <tr id="row">
                                <td width="3%"><?= $opset + $key + 1; ?></td>
                                <td width="12%"><a href="javascript: void(0)"><?= $val['arsip_kd']; ?></a></td>
                                <td width="10%"><a href="javascript: void(0)" class="agreen"><?= $val['berita_kd']; ?></a></td>
                                <td><p align="left"><?= $val['perihal_berita']; ?></p></td>
                                <td width="7%"><?= $val['tgl_berita']; ?></td>
                                <td width="15%"><?= $val['perwakilan_nama']; ?></td>
            <?php if ($level_id == '2') { ?>
                                    <td width="50"><a href="<?= base_url(); ?>index.php/berita/edit_berita/id/<?= $val['arsip_kd']; ?>" class="tiptip-top" title="Edit Berita"><img src="<?= base_url(); ?>resources/images/icon_edit.png" alt="edit" /></a></td>
                            <?php } ?>
                                <td width="2%">
                            <?php if ($val['status_disposisi'] == 'Y') { ?> <img src="<?= base_url(); ?>resources/images/sudah.png" width="70" height="25" /> <?php } else { ?> <img src="<?= base_url(); ?>resources/images/menunggu.png" width="70" height="25" /> <?php } ?> 

                                </td>
                                <td  width="10%" ><a href="<?= base_url(); ?>index.php/berita/detail/id/<?= $val['arsip_kd']; ?>" class="tiptip-top" title="Detail"><img src="<?= base_url(); ?>resources/images/icon_view.png" alt="Detail" /></a></td>
                            </tr>
        <?php } ?>
    <?php } ?>
                </tbody>
            </table>
    <?php echo $this->pagination->create_links(); ?>
        </div>
    </div>
    <?php $this->load->view('tmpl/footer'); ?>
    <?php
} else {
    redirect('');
}
?>