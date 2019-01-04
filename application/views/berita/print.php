<?
$username=$this->session->userdata('SESSION_USERNAME');
$level_id=$this->session->userdata('SESSION_FUNGSI_KD');
if (!empty($username)) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cetak Disposisi</title>
<style>
td { border:1px solid #000; padding:2px; }
th { border:1px solid #000; }
</style>
</head>

<body onload="window.print();">
<table align="center" cellpadding="1" cellspacing="0"width="92%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; ">
  <tr>
    <td width="40%" align="left" style="border:0px solid #000;" ><strong><?php echo $pwk[0]['nama_perwakilan']; ?></strong></td>
    <td colspan="3"  style="border:0px solid #000;">&nbsp;</td>
  </tr>
  <tr>
    <td height="42" colspan="4" align="center"  style="border:0px solid #000;"><strong>LEMBARAN DISPOSISI<br />
        <?php echo strtoupper($berita[0]['jenis_nama']); ?><em> </em>
        <?php echo strtoupper($berita[0]['sifat_nama']); ?>
        </strong><br/></td>
  </tr>
  <tr>
        <td colspan="4" align="center"  style="border:2px solid #000;"><strong>PERHATIKAN KEAMANAN INFORMASI<br />
  </tr>
  <tr>
    <td colspan="4">
        <table cellpadding="1" cellspacing="0"width="100%" style="">
                <tr>
                <td width="40%" height="31" style="" >No. Surat: <em><?=$berita[0]['berita_kd'];?></em></td>
                <td width="60%">Kode Arsip: <em><?=$this->uri->segment(4);?></em></td>
            </tr>
                <tr>
                <td valign="top">Pengirim:
                <em><?=$berita[0]['jabatan_pengirim'];?></em><em> -</em>
                <em><?=$berita[0]['perwakilan_nama'];?></em>
                </td>
                <td height="61" valign="top">Perihal:<br /> <em><?=$berita[0]['perihal_berita'];?></em></td>
          </tr>
        </table>
    </td>
  </tr>
  <tr>
    <td colspan="4">
    <table cellpadding="1" cellspacing="0"width="100%" style="" >
        <tr>
                <th width="40%" height="47" align="center">DISPOSISI KEPADA</th>
            <td width="30%" valign="top"><u>Tgl. Diarsipkan</u><br />
            <em><?=$berita[0]['tgl_diarsipkan'];?></em></td>
            <td width="30%" valign="top"><u>Tgl. Berita</u><br />
              <em><?=$berita[0]['tgl_berita'];?></em></td>
        </tr>
        <tr>
          <td height="47" valign="top">
                <table cellpadding="1" cellspacing="0"width="100%">
                        <? if ($berita[0]['status_disposisi']=='Y') {
                                foreach($fungsi_disposisi as $key) {?>
                                <tr>
                        <td width="80%"><?=$key['nama_fungsi'];?></td>
                        <td align="center"><strong>&radic;</strong></td>
                </tr>
                        <? } ?>
              <? } else {
                                foreach($fungsi as $key) {?>
                                <tr>
                        <td width="80%"><?=$key['nama_fungsi'];?></td>
                        <td>&nbsp;</td>
                </tr>
                        <? } ?>
                          <?  } ?>
            </table>
           <table cellpadding="1" cellspacing="0"width="100%">
                        <tr>
                        <th height="34" colspan="20" align="center">ISI INSTRUKSI</th>
                        </tr>
                        <tr>
                        <? $i=0; if ($berita[0]['status_disposisi']=='Y') {
                                foreach($instruksi_disposisi as $key) {?>
                        <tr>
                        <td width="80%"><?=$key['instruksi_nama'];?></td>
                        <td align="center"><strong>&radic;</strong></td>
                </tr>
                        <? } ?>
              <? } else {
                                foreach($disposed_instruksi as $key) {?>
                                <tr>
                        <td width="80%"><?=$key['instruksi_nama'];?></td>
                        <td>&nbsp;</td>
                </tr>
                        <? } ?>
                          <?  } ?>
            </table>
          </td>
          <td colspan="2" valign="top" align="center"><br /> <u>CATATAN</u>
          <br />
                        <? if ($berita[0]['status_disposisi']=='Y') { ?>
                <p align="center"><b><em><?=$disposisi[0]['catatan'];?></em></b></p>
                <br /> <u>TANGGAL DISPOSISI</u><br />
                                <?=$disposisi[0]['tgl_disposisi'];?></p><br>
                <br />

                <br /> <u>KORESPONDENSI</u><br />
                                <? foreach($korespondensi as $key) {
                                                echo "<p align='center'><b>".$key['nama_fungsi']."</b> : <br><i>".$key['detail_korespondensi']."</i></p><br>";
                                        } ?>
            <? } ?>

          </td>
            </tr>
        <tr>
          <td height="24" colspan="3" align="right"  valign="top"><font size="-2">E-disposisi &copy; <?php echo strtoupper($pwk[0]['nama_singkat_perwakilan']); ?> <?=date('Y');?></font></td>
            </tr>
     </table>
    </td>
  </tr>
</table>
</body>
</html>
  <?
  } else
  {
  redirect ('');
  }
  ?>
