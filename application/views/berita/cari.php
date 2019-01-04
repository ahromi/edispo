<?php 
$cari=$this->uri->segment(4);
$notif=$this->session->flashdata('notifikasi');
$notif2=$this->session->flashdata('notifikasi2');
$level_id=$this->session->userdata('SESSION_FUNGSI_KD');	
if(isset($_POST['CARI'])){
$arsip=$_POST['arsip_kd'];
$berita_kd=$_POST['berita_kd'];
$date1=$_POST['tgl_mulai'];
$date2=$_POST['tgl_akhir'];
$perihal=$_POST['perihal_berita'];
} else {
$arsip=""; $berita_kd=""; $date1=""; $date2="";	$perihal="";	
}

$user_nama=$this->session->flashdata('user_nama');
$user_namalengkap=$this->session->flashdata('user_namalengkap');
$username=$this->session->userdata('SESSION_USERNAME');	
if (!empty($username)) {
$this->load->view('tmpl/header');
?>
<div id="content">
    <div id="main-content">
        <h2>Pencarian Arsip Dokumen</h2>
        <form name="cari" method="post">
            <fieldset>
                <ul class="align-list">
                    <li>
                        <label for="addarticle-title">No Arsip</label>
                        <input type="text" value="<?= $arsip; ?>" id="addarticle-title" name="arsip_kd" class="box-small" /> 
                    </li>
                    <li>
                        <label for="addarticle-title">No Dokumen</label>
                        <input type="text" value="<?= $berita_kd; ?>" id="addarticle-title" name="berita_kd" class="box-medium" />
                    </li>
                    <li>
                        <label for="addarticle-title">Tanggal Dokumen</label>
                        <input type="text" class="box-small" value="<?= $date1; ?>"  readonly name="tgl_mulai" id="tgl_mulai"> 
                        - 
                        <input type="text" value="<?= $date2; ?>" class="box-small"  readonly name="tgl_akhir" id="tgl_akhir">
                    </li>
                    <li>
                        <label for="addarticle-category">Perihal</label>
                        <input type="text" value="<?= $perihal; ?>" id="addarticle-title" name="perihal_berita" class="box-medium"/>
                    </li>
                    <li>
                        <label></label>
                        <input type="submit" name="CARI" value="Cari" class="green" /><br />
                    </li>
                    <li>
                </ul>
            </fieldset>
        </form>
        <?php
            if(!empty($_POST['CARI'])) {            
        ?>
        <center><b><?= $notif2; ?></b></center>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kode Arsip</th>
                    <th>No. Dokumen</th>
                    <th>Perihal Dokumen</th>
                    <th>Tgl Dokumen</th>
                    <th>Pengirim</th>
                    <?php if ($level_id=='2'){ ?>
                    <th>Perubahan</th>
                    <th>Print</th>
                    <?php } ?>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                <?php	$i=0;
                if (empty($berita)){ ?>
                <tr id="row"><td colspan="8" align="center">Dokumen tidak Ditemukan!.</td></tr>
                <?php } else {

                foreach ($berita as $key=>$val) { $i++; ?>
                <tr id="row">
                    <td width="3%"><?= $key + 1; ?></td>
                    <td width="12%"><a href="javascript: void(0)"><?= $val['arsip_kd']; ?></a></td>
                    <td width="10%"><a href="javascript: void(0)" class="agreen"><?= $val['berita_kd']; ?></a></td>
                    <td><p align="left"><?= $val['perihal_berita']; ?></p></td>
                    <td width="7%"><?= $val['tgl_berita']; ?></td>
                    <td width="15%"><?= $val['perwakilan_nama']; ?></td>
                    <?php if ($level_id=='2'){ ?>
                    <td width="50"><a href="<?= base_url(); ?>index.php/berita/edit_berita/id/<?= $val['arsip_kd']; ?>" class="tiptip-top" title="Edit Berita"><img src="<?= base_url(); ?>resources/images/icon_edit.png" alt="edit" /></a></td>
                    <td width="50"><a  onclick="window.open('<?= base_url(); ?>index.php/berita/cetak/id/<?= $val['arsip_kd']; ?>', 'mywindow', 'menubar=yes, width=800');" href="#" class="tiptip-top" title="Print Disposisi"><img src="<?= base_url(); ?>resources/images/print-icon.png" alt="print" /></a></td>
                    <?php } ?>
                    <td width="50"><a href="<?= base_url(); ?>index.php/berita/detail/id/<?= $val['arsip_kd']; ?>" class="tiptip-top" title="Detail"><img src="<?= base_url(); ?>resources/images/icon_view.png" alt="Detail" /></a></td>
                </tr>
                <?php } ?>
                <?php } ?>
            </tbody>
        </table>
        <?php } ?>                         
    </div>
</div>
<?php $this->load->view('tmpl/footer'); ?>
<?php 
} else
{
redirect ('');
}
?>