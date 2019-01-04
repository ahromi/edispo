<?php
$cari = $this->uri->segment(4);
$notif = $this->session->flashdata('notifikasi');
$notif2 = $this->session->flashdata('notifikasi2');
$user_nama = $this->session->flashdata('user_nama');
$user_namalengkap = $this->session->flashdata('user_namalengkap');
$username = $this->session->userdata('SESSION_USERNAME');
$level_id = $this->session->userdata('SESSION_FUNGSI_KD');
if (!empty($username)) {
    $this->load->view('skins/' . $skin_val . '/tmpl/header');
    if ($this->session->userdata('SESSION_FUNGSI_KD') == 2 || $this->session->userdata('SESSION_FUNGSI_KD') == 1) {
        $title = "";
    } else {
        $title = " Yang Terdisposisi Kepada Anda";
    }

    if ($this->uri->segment(3) == 'inputed') {
        $title = "<i>Yang Anda Inputkan</i>";
    }
    ?>
    <div class="page-content" style="font-family: Arial, Helvetica, sans-serif">
        <!-- begin PAGE TITLE ROW -->
        <div class="row">
            <div class="col-lg-12">
                <div class="portlet portlet-default">
                    <div class="portlet-heading">
                        <div class="portlet-title">
                            <h4>Detail Dashboard Berita Fungsi <?php echo $data_fungsi[0]['nama_fungsi']; ?></h4>
                        </div>
                        <div class="portlet-widgets">

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="horizontalFormExample" class="panel-collapse collapse in">
                        <div class="portlet-body">

                            <div class="btn-group btn-group-justified">
                                <a class="btn btn-red" >Belum Diterima</a>
                                <a href="<?php echo base_url() . 'index.php/berita/detildashboard/diterima/' . $data_fungsi[0]['fungsi_kd']; ?>" class="btn btn-orange" role="button">Diterima</a>
                                <a href="<?php echo base_url() . 'index.php/berita/detildashboard/dikerjakan/' . $data_fungsi[0]['fungsi_kd']; ?>" class="btn btn-green" role="button">Dikerjakan</a>
                            </div>
                            <?php
                            if ($notif2 != "") {
                                ?>
                                <div class="alert alert-info alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <strong>Notification:</strong><?php echo $notif2; ?>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="portlet portlet-red">
                                <div class="portlet-heading">
                                    <div class="portlet-title">
                                        <center><h4>Daftar Berita Fungsi <?php echo $data_fungsi[0]['nama_fungsi']; ?> yang Belum Diterima</h4></center>
                                    </div>
                                    <div class="portlet-widgets">
                                        <a onclick="window.open('<?= base_url(); ?>index.php/berita/detildashboard/cetakbelumditerima/<?php echo $data_fungsi[0]['fungsi_kd'];?>', 'mywindow', 'menubar=yes, width=800, height=600');" href="#" class="tiptip-top" title="Print Daftar Berita"><i class="fa fa-print"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="portlet-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th width="3%">No.</th>
                                                    <th width="12%">Kode Arsip</th>
                                                    <th>No. Berita</th>
                                                    <th>Perihal Berita</th>
                                                    <th width="8%">Tgl Berita</th>
                                                    <th>Instansi Pengirim</th>
                                                    <th>Diterima</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 0;
                                                if (empty($berita)) {
                                                    ?>
                                                    <tr id="row"><td colspan="9" align="center">Belum ada berita.</td></tr>
                                                    <?php
                                                } else {
                                                    foreach ($berita as $key => $val) {
                                                        $i++;
                                                        ?>
                                                        <tr id="row">
                                                            <td width="3%"><?= $opset + $key + 1; ?></td>
                                                            <td width="12%"><a href="<?= base_url(); ?>index.php/berita/detail/id/<?= $val['arsip_kd']; ?>"><?= $val['arsip_kd']; ?></a></td>
                                                            <td width="15%"><a href="<?= base_url(); ?>index.php/berita/detail/id/<?= $val['arsip_kd']; ?>" class="agreen"><?= $val['berita_kd']; ?></a></td>
                                                            <td><p align="left"><?= ucfirst($val['perihal_berita']); ?></p></td>
                                                            <td width="7%">
                                                                <?php
                                                                $tgl_berita = date("Y-m-d", strtotime($val['tgl_berita']));
                                                                echo $tgl_berita;
                                                                ?>
                                                            </td>
                                                            <td width="15%"><?= $val['perwakilan_nama']; ?></td>
                                                            <td width="10%">
                                                                <?php
                                                                if ($val['detail_terima'] == 'Y') {
                                                                    ?>
                                                                    <a class="btn btn-xs btn-orange"><i class="fa fa-check"></i> Diterima</a>
                                                                    <?php
                                                                } else {
                                                                    ?> 
                                                                    <a class="btn btn-xs btn-red"><i class="fa fa-clock-o"></i> Belum</a>
                                                                <?php } ?>
                                                            </td>
                                                            

                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="7" align="center">
                                                        <?php echo $this->pagination->create_links(); ?>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>

                                    </div>
                                </div>
                            </div>


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