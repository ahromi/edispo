<?php
$username = $this->session->userdata('SESSION_USERNAME');
$level_id = $this->session->userdata('SESSION_FUNGSI_KD');
//echo "<pre>";
//print_r($fungsi_disposisi);
//echo "</pre>";
if (!empty($username)) {
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>&nbsp;</title>
            <style>
                .td_border { border:1px solid #000; padding:2px; }
                .th_border { border:1px solid #000; }
            </style>
        </head>

        <body onload="window.print();">
            <table align="center" cellpadding="1" cellspacing="0"width="92%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; ">
                <tr>
                    <td class="td_border" width="40%" align="left" style="border:0px solid #000;"><center>KONSULAT JENDERAL REPUBLIK INDONESIA<BR><strong><u>KUCHING</u></strong></center></td>
                    <td class="td_border" colspan="3"  style="border:0px solid #000;">&nbsp;</td>
                </tr>
                <tr>
                    <td class="td_border" colspan="4" align="center"  style="border:0px solid #000;font-size: 18px;"><strong>LEMBARAN DISPOSISI</strong></td>
                </tr>
                <tr>
                    <td class="td_border"  colspan="4" align="center"  style="border:0px solid #000;font-size: 15px;">
                        <strong>
                            <u>
                                <?php echo strtoupper($berita[0]['jenis_nama']); ?>
                                <?php echo strtoupper($berita[0]['sifat_nama']); ?>
                            </u>
                        </strong>
                    </td>
                </tr>
                <tr>
                    <td class="td_border" colspan="4">
                        <table cellpadding="1" cellspacing="0"width="100%" style="">
                            <tr>
                                <td colspan="2" style="font-size: 18px;" class="td_border" >
                                    <center><strong>PERHATIKAN KEAMANAN INFORMASI</strong></center>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="td_border" >
                                    <table width="100%">

                                        <tr>
                                            <td width="13%">
                                                Nomor Berita
                                            </td>
                                            <td width="1%">
                                                :
                                            </td>
                                            <td width="55%">
                                                <?= $berita[0]['berita_kd']; ?>
                                            </td>
                                            <td class="td_border" rowspan="2" width="31%">
                                                <table width="100%">
                                                    <tr>
                                                        <td width="45%">
                                                            Nomor Agenda
                                                        </td>
                                                        <td width="2%">:</td>
                                                        <td width="50%"><?= $this->uri->segment(4); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="45%">
                                                            Tanggal
                                                        </td>
                                                        <td width="2%">:</td>
                                                        <td width="50%"><?= $berita[0]['tgl_berita']; ?></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="13%">
                                                Asal
                                            </td>
                                            <td width="1%">
                                                :
                                            </td>
                                            <td width="55%">
                                                <?php
                                                $jabatan_pengirim="";
                                                if($berita[0]['jabatan_pengirim'] !=""){
                                                    $jabatan_pengirim=$berita[0]['jabatan_pengirim'] . ' - ';
                                                }
                                                ?>
                                                <?= $jabatan_pengirim.$berita[0]['perwakilan_nama']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="13%">
                                                Perihal
                                            </td>
                                            <td width="1%">
                                                :
                                            </td>
                                            <td width="55%" colspan="2">
                                                <?= $berita[0]['perihal_berita']; ?>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td width="35%" class="td_border" valign="top">
                                    <table cellpadding="0" cellspacing="0" width="100%" style="padding-right:20px;padding-left: 5px;">
                                        <tr>
                                            <td colspan="3" height="30px">DISPOSISI KEPADA :</td>
                                        </tr>
                                        <?php
                                        if ($berita[0]['status_disposisi'] == 'Y') {
                                            $no_fungsi = 1;
                                            foreach ($fungsi_disposisi as $key) {
                                                ?>
                                                <tr>
                                                    <td class="td_border" width="90%"><?= $no_fungsi . ". " . $key['nama_fungsi']; ?></td>
                                                    <td class="td_border" width="10%" align="center">
                                                        <?php
                                                        if ($key['detail_perhatian'] == 'Y') {
                                                            echo '<strong>&radic;</strong>&nbsp;<strong>&radic;</strong>';
                                                        } else {
                                                            echo '<strong>&radic;</strong>';
                                                        }
                                                        ?>

                                                    </td>
                                                </tr>
                                                <?php
                                                $no_fungsi++;
                                            }
                                            ?>
                                            <?php
                                        } else {
                                            $no_fungsi = 1;
                                            foreach ($fungsi as $key) {
                                                ?>
                                                <tr>
                                                    <td class="td_border" width="90%"><?= $no_fungsi . '. ' . $key['nama_fungsi']; ?></td>
                                                    <td class="td_border" width="10%">&nbsp;</td>
                                                </tr>
                                                <?php
                                                $no_fungsi++;
                                            }
                                            ?>
    <?php } ?>
                                    </table>

                                    <table cellpadding="0" cellspacing="0" width="100%" style="padding-right:20px;padding-left: 5px;">
                                        <tr>
                                            <td colspan="3" height="30px">ISI INSTRUKSI :</td>
                                        </tr>
                                        <?php
                                        $i = 0;
                                        if ($berita[0]['status_disposisi'] == 'Y') {
                                            $row_centang = 0;
                                            foreach ($instruksi_disposisi as $key) {
                                                ?>
                                                <tr>
                                                    <td class="td_border" width="80%"><?= $key['instruksi_nama']; ?></td>
                                                    <td class="td_border" align="center">
                                                        <?php
                                                        if ($key['instruksi_perhatian'] == 'Y') {
                                                            echo '<strong>&radic;</strong>&nbsp;<strong>&radic;</strong>';
                                                        } else {
                                                            echo '<strong>&radic;</strong>';
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <?php
                                        } else {
                                            foreach ($disposed_instruksi as $key) {
                                                ?>
                                                <tr>
                                                    <td class="td_border" width="90%"><?= $key['instruksi_nama']; ?></td>
                                                    <td class="td_border" width="10%">&nbsp;</td>
                                                </tr>
                                            <?php } ?>
    <?php } ?>
                                    </table>
                                </td>
                                <td width="65%" class="td_border" valign="top" >
                                    <table style="padding-right:20px;padding-left: 5px;"  width="100%" height="100%">
                                        <tr>
                                            <td colspan="3" height="28px">INFORMASI / CATATAN :</td>
                                        </tr>
                                        <tr>
                                            <td class="td_border" height="627px" valign="bottom" align="right">
                                                Kuching, ................2019&nbsp;&nbsp;&nbsp;
                                                <br><br></br>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" align="center" >
                        <br>
                            <table width="100%">
                            <tr>
                                <td class="td_border" align="center"  style="font-size: 8px;">LEMBARAN INI DAN BERITA TERLAMPIR HANYA DITUJUKAN KEPADA ALAMAT DAN PEJABAT YANG MENDAPAT WEWENANG UNTUK ITU.<BR>SETELAH SELESAI DIGUNAKAN AGAR PADA KESEMPATAN PERTAMA DISIMPAN KEMBALI DI TEMPAT YANG AMAN.
                                </td>
                            </tr>
                        </table>
                        
                    </td>
                </tr>
            </table>
        </body>
    </html>
    <?php
} else {
    redirect('');
}
?>
