<?php
$cari = $this->uri->segment(4);
$note = $this->session->flashdata('notice');
$user_nama = $this->session->flashdata('user_nama');
$user_namalengkap = $this->session->flashdata('user_namalengkap');
$username = $this->session->userdata('SESSION_USERNAME');
$username = $this->session->userdata('SESSION_USERNAME');
$level_id = $this->session->userdata('SESSION_FUNGSI_KD');
$disposisi_fungsi = $this->session->userdata('SESSION_DISPOSISI_FUNGSI');
if (!empty($username)) {
    $this->load->view('tmpl/header');
    ?>

    <div id="content">
        <div id="main-content">
            <h1>Laporan & Statistik Disposisi Berita Perwakilan</h1> 
            <fieldset>
                <div id="box-right">
                    <h2>Statistik Disposisi Berita Perwakilan</h2>
                    <!-- modal content -->
                    <div style="border: 0px solid #000000; height:360px; position:absolute; background:none; width:750px; "> 

                    </div>
                    <script language="javascript">AC_FL_RunContent = 0;</script>
                    <script language="javascript">DetectFlashVer = 0;</script>
                    <script src="<?php echo base_url(); ?>charts/AC_RunActiveContent.js" language="javascript"></script>
                    <script language="JavaScript" type="text/javascript">

                        var requiredMajorVersion = 10;
                        var requiredMinorVersion = 0;
                        var requiredRevision = 45;

                    </script>
                    <table align="center"><tr><td>
                                <script language="JavaScript" type="text/javascript">

                                    if (AC_FL_RunContent == 0 || DetectFlashVer == 0) {
                                        alert("This page requires AC_RunActiveContent.js.");
                                    } else {
                                        var hasRightVersion = DetectFlashVer(requiredMajorVersion, requiredMinorVersion, requiredRevision);
                                        if (hasRightVersion) {
                                            AC_FL_RunContent(
                                                    'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,45,2',
                                                    'width', '600',
                                                    'height', '350',
                                                    'scale', 'noscale',
                                                    'salign', 'TL',
                                                    'bgcolor', '#777788',
                                                    'wmode', 'opaque',
                                                    'movie', 'charts',
                                                    'src', '../../../charts/charts',
                                                    'FlashVars', 'library_path=<?php echo base_url(); ?>charts/charts_library&xml_source=<?php echo base_url(); ?>index.php/laporan/berita/xml_disposisi_berita/',
                                                    'id', 'my_chart',
                                                    'name', 'my_chart',
                                                    'menu', 'true',
                                                    'allowFullScreen', 'true',
                                                    'allowScriptAccess', 'sameDomain',
                                                    'quality', 'high',
                                                    'align', 'middle',
                                                    'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
                                                    'play', 'true',
                                                    'devicefont', 'false'
                                                    );
                                        } else {
                                            var alternateContent = 'This content requires the Adobe Flash Player. '
                                                    + '<u><a href=http://www.macromedia.com/go/getflash/>Get Flash</a></u>.';
                                            document.write(alternateContent);
                                        }
                                    }
                                </script>
                                <noscript>
                                <P>This content requires JavaScript.</P>
                                </noscript>
                            </td></tr></table>
                    <p></p>
                    <br />

                </div>
                <div id="box-left">
                    <h2>Laporan Disposisi Berita Perwakilan</h2>
                    <?php echo form_open_multipart('laporan/berita/disposisi/'); ?> 
                    <fieldset>
                        <?php if (!empty($notif)) { ?>
                            <script language="javascript">window.alert('<?= $notif; ?>');</script>
                        <?php } ?>
                        <ul class="align-list">
                            <li>
                                <label for="addarticle-title">Tanggal</label>
                                <input type="text" class="box-small" value="<?php echo date('Y/m/d'); ?>" id="tanggal_mulai" readonly name="tanggal_mulai"> 
                                s/d <input type="text" class="box-small" value="<?php echo date('Y/m/d'); ?>" id="tanggal_akhir" readonly name="tanggal_akhir">

                            </li>
                            <li>
                                <label for="addarticle-category">Fungsi Terdisposisi Berita</label>
                                <select id="addarticle-category" name="fungsi_kd">
                                    <option value="" selected>-Pilih-</option>
                                    <?php foreach ($fungsi as $val) { ?>
                                        <option value="<?= $val['fungsi_kd']; ?>"><?= $val['nama_fungsi']; ?></option>
                                    <?php } ?>
                                </select>
                            </li>
                            <li>
                                <label for="addarticle-category">Jenis Berita</label>
                                <select id="addarticle-category" name="jenis_kd">
                                    <option value="" selected>-Pilih-</option>
                                    <?php foreach ($jenis as $val) { ?>
                                        <option value="<?= $val['jenis_kd']; ?>"><?= $val['jenis_nama']; ?></option>
                                    <?php } ?>
                                </select>
                            </li>
                            <li>
                                <label for="addarticle-category">Sifat Berita</label>
                                <select id="addarticle-category" name="sifat_kd">
                                    <option value="" selected>-Pilih-</option>
                                    <?php foreach ($sifat as $val) { ?>
                                        <option selected="selected" value="<?= $val['sifat_kd']; ?>"><?= $val['sifat_nama']; ?></option>
                                    <?php } ?>
                                </select>
                            </li>
                            <li>
                                <label for="addarticle-category">Pengirim</label>
                                <input id="tags2" class="box-medium" type="text">
                                <input type="hidden" id="perwakilan_kd" name="perwakilan_kd"> 
                            </li>
                            <li>
                                <label for="addarticle-category">Derajat Berita</label>
                                <select id="addarticle-category" name="derajat_kd">
                                    <option value="" selected>-Pilih-</option>
                                    <?php foreach ($derajat as $val) { ?>
                                        <option value="<?= $val['derajat_kd']; ?>"><?= $val['derajat_nama']; ?></option>
                                    <?php } ?>
                                </select>
                            </li> 
                            <li>
                                <label for="addarticle-category">Status Penerimaan</label>
                                <select id="addarticle-category" name="detail_terima">
                                    <option value="" selected>Semua</option> 
                                    <option value="Y">Sudah Diterima</option> 
                                    <option value="T">Belum Diterima</option> 
                                </select>
                            </li> 
                            <li>
                                <label></label>
                                <input type="submit" name="TAMBAH" value="Submit" class="green" /> </a>
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