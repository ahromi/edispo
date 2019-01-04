<?php
//echo "<pre>";
//print_r($suratpengantar);
//echo "</pre>";
//die();
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
                            <h4>Cetak Surat Pengantar</h4>
                        </div>
                        <div class="portlet-widgets">
                            <a data-toggle="collapse" data-parent="#accordion" href="#horizontalFormExample"><i class="fa fa-chevron-down"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="horizontalFormExample" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <ul id="myTab" class="nav nav-tabs">
                                <li class="<?php echo $active_tab == 1 ? "active" : ""; ?>"><a href="#aprint" data-toggle="tab">Available to Print</a>
                                </li>
                                <li class="<?php echo $active_tab == 2 ? "active" : ""; ?>"><a href="#printarch" data-toggle="tab">Archive</a>
                                </li>
                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <div class="tab-pane fade <?php echo $active_tab == 1 ? "active in" : ""; ?>" id="aprint">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-green">
                                            <thead>
                                                <tr>
                                                    <th>PWK Code</th>
                                                    <th>Total Kawat</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <form name="cari" method="post" class="form-horizontal">
                                                <?php
                                                $i = 0;
                                                if (empty($data_avail_sp)) {
                                                    ?>
                                                    <tr id="row"><td colspan="3" align="center">Dokumen tidak Ditemukan!.</td></tr>
                                                    <?php
                                                } else {
                                                    foreach ($data_avail_sp as $key => $val) {
                                                        ?>
                                                        <tr id="row">
                                                            <td ><?= $val['pwk_code']; ?></td>
                                                            <td ><?= $val['jml']; ?></td>
                                                            <td >
                                                                <a href="<?php echo base_url(); ?>index.php/berita/suratpengantar/cetak/<?= $val['pwk_code']; ?>" class="tiptip-top" title="Print Surat Pengantar" target="_blank" class="btn btn-sm btn-white btn-margin"><i class="fa fa-print fa-2x"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>
                                            </form>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade <?php echo $active_tab == 2 ? "active in" : ""; ?>" id="printarch">
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
                                    if (!empty($suratpengantar)) {
                                        ?>
                                        <div class="table-responsive">
                                            <table id="cari_table" class="table">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Nomor Surat Pengantar</th>
                                                        <th>Perwakilan</th>
                                                        <th>Jumlah Dokumen</th>
                                                        <th>Tgl Surat</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 0;
                                                    if (empty($suratpengantar)) {
                                                        ?>
                                                        <tr id="row"><td colspan="7" align="center">Dokumen tidak Ditemukan!.</td></tr>
                                                        <?php
                                                    } else {
                                                        foreach ($suratpengantar as $key => $val) {
                                                            $i++;
                                                            ?>
                                                            <tr id="row">
                                                                <td width="3%"><?= $i; ?></td>
                                                                <td width="20%"><?php echo $val['sp_number'];?></td>
                                                                <td width="10%"><?php echo $arr_pwk[$val['pwk_code']];?></td>
                                                                <td width="20%"><?= $val['jml']; ?></td>
                                                                <td width="30%"><?= $val['print_date']; ?></td>
                                                                <td>
                                                                    <a href="<?php echo base_url(); ?>index.php/berita/suratpengantar/cetakarsip/<?= $val['pwk_code']."/".$val['sp_id']; ?>" class="tiptip-top" title="Print Surat Pengantar" target="_blank" class="btn btn-sm btn-white btn-margin"><i class="fa fa-print fa-2x"></i></a>
                                                                </td>
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