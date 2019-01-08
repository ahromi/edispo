<?php
$cari = $this->uri->segment(4);
$notif = $this->session->flashdata('notifikasi');
$notif2 = $this->session->flashdata('notifikasi2');
$user_nama = $this->session->flashdata('user_nama');
$user_namalengkap = $this->session->flashdata('user_namalengkap');
$username = $this->session->userdata('SESSION_USERNAME');
$level_id = $this->session->userdata('SESSION_FUNGSI_KD');
$halaman_value = 0;
$val_cekbox = array();
foreach ($detailberita as $row) {
    $halaman_value = $row['halaman'];
    $val_cekbox[] = $row['pwk_code'];
}
//echo "<pre>";
//print_r($berita);
//echo "</pre>";
//die();
if (!empty($username)) {
    $rad_sifat_dokumen = 0;
    $arsip_kd = "";
    $berita_kd = "";
    $fungsi_pengirim = "";
    $fungsi_kd = "";
    $perihal_berita = "";
    $tgl_berita = "";

    if (count($berita) > 0) {
        $rad_sifat_dokumen = isset($berita[0]['sifat_kd']) ? $berita[0]['sifat_kd'] : 0;
        $arsip_kd = isset($berita[0]['arsip_kd']) ? $berita[0]['arsip_kd'] : 0;
        $berita_kd = isset($berita[0]['berita_kd']) ? $berita[0]['berita_kd'] : 0;
        $fungsi_pengirim = isset($berita[0]['nama_fungsi']) ? $berita[0]['nama_fungsi'] : 0;
        $fungsi_kd = isset($berita[0]['fungsi_kd']) ? $berita[0]['fungsi_kd'] : 0;
        $tgl_berita = isset($berita[0]['tgl_berita']) ? $berita[0]['tgl_berita'] : 0;
        $perihal_berita = isset($berita[0]['perihal_berita']) ? $berita[0]['perihal_berita'] : 0;
    }
    $this->load->view('skins/' . $skin_val . '/tmpl/header');
    ?>
    <div class="page-content" style="font-family: Arial, Helvetica, sans-serif">
        <!-- begin PAGE TITLE ROW -->
        <div class="row">
            <div class="col-xs-12">
                <div class="portlet portlet-default">
                    <div class="portlet-heading">
                        <div class="portlet-title">
                            <h4>Arsip Berita Keluar</h4>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="editarsipberita" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                    <div class="portlet portlet-default">
                                        <div class="portlet-heading">
                                            <div class="portlet-title">
                                                <h4>Informasi Arsip</h4>
                                            </div>
                                            <div class="portlet-widgets">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#editarsipberita"><i class="fa fa-chevron-down"></i></a>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div id="editarsipberita" class="panel-collapse collapse in">
                                            <div class="portlet-body">
                                                <?php
                                                if ($notif != "") {
                                                    ?>
                                                    <div class="alert alert-info alert-dismissable">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                        <strong>Notification:</strong><?php echo $notif; ?>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <tbody>
                                                                    <tr>
                                                                        <td colspan="2" style="padding:0px">
                                                                            <table class="table table-striped">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <strong>Sifat Dokumen</strong>
                                                                                        </td>
                                                                                        <td>: <?php echo $rad_sifat_dokumen == 1 ? "Rahasia" : "Biasa"; ?>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <strong>No Arsip</strong>
                                                                                        </td>
                                                                                        <td>
                                                                                            : 
                                                                                            <?php echo $arsip_kd; ?>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <strong>No Dokumen</strong>
                                                                                        </td>
                                                                                        <td>
                                                                                            : 
                                                                                            <?php echo $berita_kd; ?>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <strong>Fungsi Pengirim</strong>
                                                                                        </td>
                                                                                        <td>
                                                                                            : 
                                                                                            <?php echo $fungsi_pengirim; ?>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <strong>Tanggal Berita</strong>
                                                                                        </td>
                                                                                        <td>
                                                                                            : 
                                                                                            <?php echo $tgl_berita; ?>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <strong>Perihal</strong>
                                                                                        </td>
                                                                                        <td>
                                                                                            : 
                                                                                            <?php echo $perihal_berita; ?>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                    <div class="portlet portlet-default">
                                        <div class="portlet-heading">
                                            <div class="portlet-title">
                                                <h4>Preview</h4>
                                            </div>
                                            <div class="portlet-widgets">
                                                <!--<a data-toggle="collapse" data-parent="#accordion" href="#previeweditarsipberita"><i class="fa fa-chevron-down"></i></a>-->
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div id="previeweditarsipberita" class="panel-collapse collapse in">
                                            <div class="portlet-body">
                                                <iframe height="765px" width="100%" src="<?= base_url().'files/' . $berita[0]['arsip_kd'] . '_' . str_replace("/", "-", $berita[0]['berita_kd']) . '.pdf'; ?>"></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-footer">
                            <input type="button" value="Kembali" onClick="history.back(1);" class="btn btn-primary" >
                        </div>
                    </div>
                </div>
            </div>


            <!-- /.row -->
            <!-- end PAGE TITLE ROW -->

        </div>
    </div>
    <?php $this->load->view('skins/' . $skin_val . '/tmpl/footer'); ?>
    <?php
} else {
    redirect('');
}
?>
