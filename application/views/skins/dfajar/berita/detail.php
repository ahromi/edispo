<?php
$cari = $this->uri->segment(4);
$note = $this->session->flashdata('notice');
$user_nama = $this->session->flashdata('user_nama');
$user_namalengkap = $this->session->flashdata('user_namalengkap');
$username = $this->session->userdata('SESSION_USERNAME');
$level_id = $this->session->userdata('SESSION_FUNGSI_KD');
$user_menerima_disposisi = $this->session->userdata('SESSION_MENERIMA_DISPOSISI');
$disposisi_fungsi = $this->session->userdata('SESSION_DISPOSISI_FUNGSI');
$koordinator_fungsi = $this->session->userdata('SESSION_KOORDINATOR');
if (!empty($username)) {
    $this->load->view('skins/' . $skin_val . '/tmpl/header');

    if (!empty($note)) {
        echo '<input id="note_id_flag_gptn" name="note_id_flag_gptn" type="hidden" value="' . $note . '"></input>';
    }
    ?>

    <div class="page-content" style="font-family: Arial, Helvetica, sans-serif">
        <!-- begin PAGE TITLE ROW -->
        <div class="row">
            <div class="col-xs-12">
                <div class="portlet portlet-default">
                    <div class="portlet-heading">
                        <div class="portlet-title">
                            <h4>ARSIP BERITA <?= $berita[0]['arsip_kd']; ?></h4>
                        </div>
                        <div class="portlet-widgets">
                            <?php
                            if ($berita[0]['sifat_kd'] == "x") {
                                ?>
                                <a title="Cetak Berita" target="_blank" href="<?php echo base_url() . '/index.php/berita/berita/showpdf/' . $berita[0]['berita_file']; ?>"><i class="fa fa-print"></i></a>
                                <span class="divider"></span>
                                <?php
                            }
                            ?>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="detaildisposisiparent" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="portlet portlet-default">
                                                <div class="portlet-heading">
                                                    <div class="portlet-title">
                                                        <h4>Disposisi Dokumen</h4>
                                                    </div>
                                                    <div class="portlet-widgets">
                                                        <!--<a data-toggle="collapse" data-parent="#accordion" href="#detaildisposisipenerimaandispo"><i class="fa fa-chevron-down" onclick="loadiframe('<?= base_url(); ?>index.php/berita/berita/show/<?php echo $berita[0]['berita_file']; ?>')"></i></a>-->
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div id="detaildisposisipenerimaandispo" class="panel-collapse collapse in">
                                                    <div class="portlet-body">
                                                        <div class="row">
                                                            <div class="col-lg-12">

                                                                <!-- jika dia adalah pemegang disposisi -->
                                                                <?php //if($berita[0]['berita_disposisikan']=='Y' && (($berita[0]['berita_fungsi_disposisi']==$level_id && $user_menerima_disposisi=='Y' ) || $berita[0]['berita_fungsi_disposisi']=='1' || $berita[0]['berita_fungsi_disposisi']=='2'  )) {
                                                                ?>
                                                                <?php if ($berita[0]['berita_disposisikan'] == 'Y' && (($user_menerima_disposisi == 'Y') || $berita[0]['berita_fungsi_disposisi'] == '1' || $berita[0]['berita_fungsi_disposisi'] == '2' )) {
                                                                    ?>
                                                                    <?php
                                                                    if (($berita[0]['berita_disposisikan'] == 'Y' && $berita[0]['berita_fungsi_disposisi'] == $level_id && $user_menerima_disposisi == 'Y') ||
                                                                            ($level_id == '1' || $level_id == '2')) {
                                                                        ?>                    
                                                                        <div id="alihkan_panel" align="center" style="display:none;">
                                                                            <h2>Alihkan disposisi ke Fungsi ?</h2>
                                                                            <?php foreach ($fungsi_mendispo as $val) {
                                                                                ?> 
                                                                                <input type="radio" name="fungsi" value="<?php echo $val['fungsi_kd']; ?>" onclick="getVal(this.value);"  id="fungsi_alihkan" /><?php echo strtoupper($val['nama_fungsi']); ?><br />	
                                                                            <?php } ?>
                                                                            <input type="hidden" id="valFungsi" />
                                                                            <input type="button" name="ALIHKAN_DISPO" value="ALIHKAN" id="ALIHKAN_DISPO" class="red"  />
                                                                            <br /><br />
                                                                        </div>    
                                                                    <?php } ?>    
                                                                    <div id="disposisi_panel"> 
                                                                        <?php
                                                                        // jika berita nya sama dengan fungsi atau Level ID = 2 (Komunikasi) dan Login sebagai Pendispo atau Level ID =1 ( Dubes )
                                                                        if ((($berita[0]['berita_fungsi_disposisi'] == $level_id || $level_id == '2') && $disposisi_fungsi == 'Y') || $level_id == '1') {
                                                                            //echo $level_id; exit;   
                                                                            //Jika dubes
                                                                            if ($level_id == '1') {
                                                                                $this->load->view('skins/' . $skin_val . '/berita/fungsi_disposisi');
                                                                            }
                                                                            // Jika tidak sama dengan Dubes dan Status Disposisi = Y ( Sudah didispo )
                                                                            else if ($level_id != '1' and $berita[0]['status_disposisi'] == 'Y') {

                                                                                //Jika Login sebagai pendispo (Y) dan Koordinasi Fungsi (Y)
                                                                                if ($disposisi_fungsi == 'Y' && $koordinator_fungsi == 'Y') {
                                                                                    ?>
                                                                                    <div class="panel-group" id="accordion">
                                                                                        <div class="panel panel-primary">
                                                                                            <div class="panel-heading panel-primary">
                                                                                                <h4 class="panel-title">
                                                                                                    <a data-toggle="collapse" data-parent="#accordion_1" href="#collapseOne">
                                                                                                        Fungsi Pemberi Disposisi
                                                                                                    </a>
                                                                                                </h4>
                                                                                            </div>
                                                                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                                                                <div class="panel-body" style="padding:0px !important">
                                                                                                    <?php $this->load->view('skins/' . $skin_val . '/berita/fungsi_disposisi'); ?>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="panel panel-primary">
                                                                                            <div class="panel-heading">
                                                                                                <h4 class="panel-title">
                                                                                                    <a data-toggle="collapse" data-parent="#accordion_2" href="#collapseTwo">
                                                                                                        Fungsi Penerimaan
                                                                                                    </a>
                                                                                                </h4>
                                                                                            </div>
                                                                                            <div id="collapseTwo" class="panel-collapse collapse">
                                                                                                <div class="panel-body" style="padding:0px !important">
                                                                                                    <?php $this->load->view('skins/' . $skin_val . '/berita/fungsi_terima'); ?>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <?php
                                                                                } else {
                                                                                    //Jika bukan Pendispo fungsi dan bukan koordinator fungsi

                                                                                    $this->load->view('skins/' . $skin_val . '/berita/fungsi_terima');
                                                                                }
                                                                            } else {
                                                                                //jika bukan dubes dan belum didispo dan inherit dari if sebelumnya ( pendispo fungsi )
                                                                                $this->load->view('skins/' . $skin_val . '/berita/fungsi_disposisi');
                                                                            }
                                                                        } else {
//                                                                            Jika bukan dubes dan sudah didispo
                                                                            if ($berita[0]['status_disposisi'] == 'Y') {
                                                                                if (!empty($detail_terima[0]['detail_fungsi_kd'])) {
                                                                                    if ($detail_terima[0]['detail_fungsi_kd'] != $level_id) {
                                                                                        echo "<h2>Status Disposisi</h2>
													<center>Berita tidak didisposisikan kepada Anda!</center>";
                                                                                    } else {
                                                                                        $this->load->view('skins/' . $skin_val . '/berita/fungsi_terima');
                                                                                    }
                                                                                } else {
                                                                                    $this->load->view('skins/' . $skin_val . '/berita/fungsi_terima');
                                                                                }
                                                                            }else{
                                                                                 echo '<h3>Dokumen Ini Belum Didisposisi!</h3>';
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                    <br />

                                                                    <!--                                <div id="mydiv"></div>-->                            
                                                                <?php } else { ?> 
                                                                    <h3>Dokumen Ini Belum Didisposisi!</h3>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="portlet portlet-default">
                                                <div class="portlet-heading">
                                                    <div class="portlet-title">
                                                        <h4>Tampilan Berita</h4>
                                                    </div>
                                                    <div class="portlet-widgets">
    <!--                                                        <span class="label default"><i>Klik tombol panah di samping untuk membuka dokumen >>></i></span>
                                                        <span class="divider"></span>
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#detaildisposisipreview"><i class="fa fa-chevron-down" onclick="loadiframe('<?= base_url(); ?>index.php/berita/berita/show/<?php echo $berita[0]['berita_file']; ?>')"></i></a>-->
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div id="detaildisposisipreview" class="panel-collapse">
                                                    <div class="portlet-body">
                                                        <iframe id="iframe_detail" height="765px" width="100%" src="<?= base_url(); ?>files/<?php echo $berita[0]['berita_file']; ?>"></iframe>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="portlet-footer">
                        <!--<input type="button" value="Kembali" onClick="history.back(1);" class="btn btn-primary" >-->
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