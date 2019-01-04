<?php
$cari = $this->uri->segment(4);
$notif = $this->session->flashdata('notifikasi');
$notif2 = $this->session->flashdata('notifikasi2');
$level_id = $this->session->userdata('SESSION_FUNGSI_KD');
if (isset($_POST['CARI'])) {
    $arsip = $_POST['arsip_kd'];
    $berita_kd = $_POST['berita_kd'];
    $date1 = $_POST['tgl_mulai'];
    $date2 = $_POST['tgl_akhir'];
    $perihal = $_POST['perihal_berita'];
} else {
    $arsip = $this->session->userdata('key1');
    $berita_kd = $this->session->userdata('key2');
    $perihal = $this->session->userdata('key3');
    $date1 = $this->session->userdata('key4');
    $date2 = $this->session->userdata('key5');
    
}

$user_nama = $this->session->flashdata('user_nama');
$user_namalengkap = $this->session->flashdata('user_namalengkap');
$username = $this->session->userdata('SESSION_USERNAME');

if (!empty($username)) {
    $this->load->view('skins/' . $skin_val . '/tmpl/header');
    ?>

    <div class="page-content" style="font-family: Arial, Helvetica, sans-serif">
        <!-- begin PAGE TITLE ROW -->
        <div class="row">
            <div class="col-lg-12">
                <div class="portlet portlet-default">
                    <div class="portlet-heading">
                        <div class="portlet-title">
                            <h4>Pencarian Arsip Dokumen</h4>
                        </div>
                        <div class="portlet-widgets">
                            <a data-toggle="collapse" data-parent="#accordion" href="#horizontalFormExample"><i class="fa fa-chevron-down"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="horizontalFormExample" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <?php
                            if (isset($notif2) && $notif2 != "") {
                                ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <strong>Alert:</strong> <?php echo $notif2; ?>
                                </div>
                                <?php
                            }
                            ?>

                            <form name="cari" method="post" class="form-horizontal">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">No Arsip</label>
                                    <div class="col-sm-7">
                                        <input type="text" value="<?= $arsip; ?>" id="addarticle-title" name="arsip_kd" class="box-small" /> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">No Dokumen</label>
                                    <div class="col-sm-7">
                                        <input type="text" value="<?= $berita_kd; ?>" id="addarticle-title" name="berita_kd" class="box-medium" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Dokumen</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="box-small" value="<?= $date1; ?>"  readonly name="tgl_mulai" id="tgl_mulai"> 
                                        - 
                                        <input type="text" value="<?= $date2; ?>" class="box-small"  readonly name="tgl_akhir" id="tgl_akhir">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Perihal</label>
                                    <div class="col-sm-7">
                                        <input type="text" value="<?= $perihal; ?>" id="addarticle-title" name="perihal_berita" class="box-medium"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button style="display: none;" type="submit" disabled="" class="btn btn-sm btn-info" id="btn_loading"><i class='fa fa-circle-o-notch fa-spin'></i> Submitting ..</button>
                                        <input type="submit" name="CARI" value="Cari" class="btn btn-sm btn-info" />
                                    </div>
                                </div>
                            </form>

                            <?php
                            if (!empty($berita)) {
                                ?>
                                <div class="table-responsive">
                                    <table id="cari_table" class="table">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Kode Arsip</th>
                                                <th>No. Dokumen</th>
                                                <th>Perihal Dokumen</th>
                                                <th>Tgl Dokumen</th>
                                                <th>Pengirim</th>
                                                <?php if ($level_id == '2') { ?>
                                                    <th>Perubahan</th>
                                                    <th>Print</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            if (empty($berita)) {
                                                ?>
                                                <tr id="row"><td colspan="8" align="center">Dokumen tidak Ditemukan!.</td></tr>
                                                <?php
                                            } else {
                                                $i=$opset;
                                                foreach ($berita as $key => $val) {
                                                    $i++;
                                                    ?>
                                                    <tr id="row">
                                                        <td width="3%"><?= $i; ?></td>
                                                        <td width="12%"><a target="_blank" href="<?= base_url(); ?>index.php/berita/detail/id/<?= $val['arsip_kd']; ?>"><?= $val['arsip_kd']; ?></a></td>
                                                        <td width="10%"><a target="_blank" href="<?= base_url(); ?>index.php/berita/detail/id/<?= $val['arsip_kd']; ?>" class="agreen"><?= $val['berita_kd']; ?></a></td>
                                                        <td><p align="left"><?= $val['perihal_berita']; ?></p></td>
                                                        <td width="7%"><?= $val['tgl_berita']; ?></td>
                                                        <td width="15%"><?= $val['perwakilan_nama']; ?></td>
                                                        <?php if ($level_id == '2') { ?>
                                                            <td width="50"><a href="<?= base_url(); ?>index.php/berita/edit_berita/id/<?= $val['arsip_kd']; ?>" class="tiptip-top" title="Edit Berita"><img src="<?= base_url(); ?>resources/images/icon_edit.png" alt="edit" /></a></td>
                                                            <td width="50"><a  onclick="window.open('<?= base_url(); ?>index.php/berita/cetak/id/<?= $val['arsip_kd']; ?>', 'mywindow', 'menubar=yes, width=800');" href="#" class="tiptip-top" title="Print Disposisi"><img src="<?= base_url(); ?>resources/images/print-icon.png" alt="print" /></a></td>
                                                        <?php } ?>

                                                    </tr>
                                                <?php } ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('skins/' . $skin_val . '/tmpl/footer'); ?>
    <?php
} else {
    redirect('');
}
?>