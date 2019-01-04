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
                .tr_border_bottom{border-bottom: 1px #000 solid;}
                @media print{
                    .th_head_color{background-color: gray;border: 1px solid #000;}
                }
                .th_head_color{background-color: gray;border: 1px solid #000;}
            </style>
        </head>

        <body onload="window.print();">
            <table align="center" cellpadding="1" cellspacing="0"width="92%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; ">
                <tr>
                    <td class="td_border" width="270px" align="left" style="border:0px solid #000;"><center>KONSULAT JENDERAL REPUBLIK INDONESIA<BR><strong><u>KUCHING</u></strong></center></td>
                    <td class="td_border" colspan="3"  style="border:0px solid #000;">&nbsp;</td>
                </tr>
                <tr>
                    <td class="td_border" colspan="4" align="center"  style="border:0px solid #000;font-size: 18px;"><strong>DAFTAR PENGERJAAN DISPOSISI</strong></td>
                </tr>
                <tr>
                    <td class="td_border" colspan="4" align="center"  style="border:0px solid #000;font-size: 18px;"><strong>Fungsi <?php echo $data_fungsi[0]['nama_fungsi']; ?></strong></td>
                </tr>
                <tr>
                    <td class="td_border" colspan="4" align="right"  style="border:0px solid #000;font-size: 12px;"><strong>Dicetak Tanggal <?php echo date("Y-m-d H:i:s") ?></strong></td>
                </tr>
                <tr>
                    <td colspan="4" align="center" style="border:0px solid #000;font-size: 15px;">
                        <table border="0" cellspacing="0" style="border:1px solid #000;">
                            <thead class="th_head_color">
                                <tr>
                                    <th class="tr_border_bottom" width="4%">No.</th>
                                    <th class="tr_border_bottom" width="12%">Kode Arsip</th>
                                    <th class="tr_border_bottom">No. Berita</th>
                                    <th class="tr_border_bottom">Perihal Berita</th>
                                    <th class="tr_border_bottom" width="8%">Tgl Berita</th>
                                    <th class="tr_border_bottom">Diterima</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i=0;
                                foreach ($berita as $key => $val) {
                                    $i++;
                                    ?>
                                <tr id="row" >
                                    <td class="tr_border_bottom" width="3%"><center><?= $i; ?></center></td>
                                        <td class="tr_border_bottom" width="12%"><?= $val['arsip_kd']; ?></td>
                                        <td class="tr_border_bottom" width="15%"><?= $val['berita_kd']; ?></td>
                                        <td class="tr_border_bottom"><p align="left"><?= ucfirst($val['perihal_berita']); ?></p></td>
                                        <td class="tr_border_bottom" width="7%">
                                            <?php
                                            $tgl_berita = date("Y-m-d", strtotime($val['tgl_berita']));
                                            echo $tgl_berita;
                                            ?>
                                        </td>
                                        <td class="tr_border_bottom" width="10%">
                                            <center>
                                            <?php
                                            if ($val['detail_terima'] == 'Y') {
                                                ?>
                                                Diterima
                                                <?php
                                            } else {
                                                ?> 
                                                Belum
                                            <?php } ?>
                                                </center>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td colspan="4" align="center" >
                        <br>
                            <table width="100%">
                                <tr>
                                    <td class="td_border" align="center"  style="font-size: 8px;">LEMBARAN INI HANYA DITUJUKAN KEPADA PEJABAT YANG MENDAPAT WEWENANG UNTUK ITU.<BR>SETELAH SELESAI DIGUNAKAN AGAR PADA KESEMPATAN PERTAMA DISIMPAN KEMBALI DI TEMPAT YANG AMAN.
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
