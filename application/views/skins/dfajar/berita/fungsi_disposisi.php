<?php
$level_id = $this->session->userdata('SESSION_FUNGSI_KD');
$disposisi_fungsi = $this->session->userdata('SESSION_DISPOSISI_FUNGSI');

$cek_fungsi_respon = ''
?>
<?php echo form_open_multipart('berita/detail/id/' . $this->uri->segment(4)); ?>
<?php
//echo "<pre>";
//print_r($fungsi);
//echo "</pre>";
//echo "disposed========";
//echo "<pre>";
//print_r($instruksi_disposisi);
//echo "</pre>";




// jika sudah disiposisi
if ($berita[0]['status_disposisi'] == 'Y') {
    ?>
    <div class="table-responsive">
        <table class="table">
            <tbody>
                <tr>
                    <td colspan="2" style="padding:0px">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>
                                        <strong>Tanggal Disposisi</strong>
                                    </td>
                                    <td>
                                        : 
                                        <?php
                                        $newdate = date("Y-m-d h:i:s", strtotime($berita[0]['tgl_disposisi']));
                                        echo $newdate;
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>Nomor Berita</strong>
                                    </td>
                                    <td>
                                        : 
                                        <?php echo $berita[0]['berita_kd']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>Perihal</strong>
                                    </td>
                                    <td>
                                        : 
                                        <?php echo $berita[0]['perihal_berita']; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <th width="50%" align="center">Disposisi Kepada:</th>
                    <th width="50%" align="center">Isi Instruksi:</th>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td style="padding:0px">
                        <table class="table table-striped">
                            <tbody>
                                <?php
                                $var_arr_disposed = array();
                                foreach ($fungsi_disposisi as $terdispo) {
                                    $var_arr_disposed[$terdispo['fungsi_kd']] = $terdispo;
                                }
                                $i = 0;
                                $x = 0;
                                $jml_fungsi=count($fungsi);
                                foreach ($fungsi as $key) {
                                    $i++;
                                    $x++;
                                    $fungsi_kd_pembanding = isset($var_arr_disposed[$key['fungsi_kd']]) ? $var_arr_disposed[$key['fungsi_kd']]['fungsi_kd'] : "-";
                                    $cek_detail_perhatian = isset($var_arr_disposed[$key['fungsi_kd']]) ? $var_arr_disposed[$key['fungsi_kd']]['detail_perhatian'] : "-";
                                    ?>
                                    <tr style="height:40px !important;">
                                        <?php if ($key['fungsi_kd'] != 1) { //dutabesar tidak didispo     ?>
                                            <td width="60px"> 
                                                <input <?php echo $cek_detail_perhatian == "Y" ? " checked disabled " : ""; ?> type="checkbox" onClick="uncheck_sebelah(this, 'detail_perhatian',<?php echo $x; ?>);"   id="fungsi_kd_<?php echo $x; ?>"  name="fungsi_kd[]" value="<?= $key['fungsi_kd']; ?>" /> 
                                                <input <?php echo $key['fungsi_kd'] == $fungsi_kd_pembanding ? " checked disabled " : ""; ?> style="margin-left:12px !important;" type="checkbox" onClick="check_sebelah(this, 'fungsi_kd',<?php echo $x; ?>);" id="detail_perhatian_<?php echo $x; ?>" title="Pelaksana" name="detail_perhatian[]" value="<?= $key['fungsi_kd']; ?>" />		                                        
                                                
                                            </td>
                                            <td>
                                                <?= $key['nama_fungsi']; ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($key['fungsi_kd'] == $fungsi_kd_pembanding) {
                                                    if ($berita[0]['berita_fungsi_disposisi'] == $level_id) {
                                                        ?>
                                                        <a onclick = "if (!confirm('Anda Yakin Melakukan Penghapusan data?'))
                                                                                        return false;" href="<?= base_url(); ?>index.php/berita/detail/delfungsi/<?= $this->uri->segment(4); ?>/<?= $var_arr_disposed[$key['fungsi_kd']]['disposisi_detail_kd']; ?>" >
                                                            <img src="<?= base_url(); ?>resources/images/icon_bad.png" /></a>  <?php
                                                    }
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </td>
                    <td style="padding:0px">
                        <table class="table table-striped">
                            <tbody>
                                <?php
                                $var_terdispo = array();
                                foreach ($instruksi_disposisi as $var_dispo) {
                                    $var_terdispo[$var_dispo['instruksi_nama']] = $var_dispo;
                                }
                                $i = 0;
                                $x = 0;
                                foreach ($instruksi as $key) {
                                    $instruksi_nama_pembanding = isset($var_terdispo[$key['instruksi_nama']]) ? $var_terdispo[$key['instruksi_nama']]['instruksi_nama'] : "-";
                                    $instruksi_perhatian_pembanding = isset($var_terdispo[$key['instruksi_nama']]) ? $var_terdispo[$key['instruksi_nama']]['instruksi_perhatian'] : "-";

                                    $i++;
                                    $x++;
                                    ?>
                                    <tr style="height:40px !important;">
                                        <td width="60px">
                                            <input <?php echo $key['instruksi_nama'] == $instruksi_nama_pembanding ? " checked disabled " : ""; ?> style="margin-left:12px !important;" type="checkbox" onClick="check_sebelah(this, 'instruksi_kd',<?php echo $x; ?>);" id="instruksi_perhatian_<?php echo $x; ?>" title="Pelaksana" name="instruksi_perhatian[]" value="<?= $key['instruksi_kd']; ?>" />
                                            <?php
                                            $cek_perhatian_right = "";
                                            if ($key['instruksi_nama'] == $instruksi_nama_pembanding && $instruksi_perhatian_pembanding == "Y") {
                                                $cek_perhatian_right = " checked disabled ";
                                            } else {
//                                                 echo $instruksi_perhatian_pembanding;die('ssssssssssss');
                                                if ($key['instruksi_nama'] == $instruksi_nama_pembanding && $instruksi_perhatian_pembanding == "T") {
                                                    $cek_perhatian_right = " disabled ";
                                                }
                                            }
                                            ?>
                                            <input <?php echo $cek_perhatian_right; ?> type="checkbox"  onClick="uncheck_sebelah(this, 'instruksi_perhatian',<?php echo $x; ?>);" id="instruksi_kd_<?php echo $x; ?>" name="instruksi_kd[]" value="<?= $key['instruksi_kd']; ?>" />
                                        </td>
                                        <td>
                                            <?= $key['instruksi_nama']; ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($key['instruksi_nama'] == $instruksi_nama_pembanding) {
                                                if ($berita[0]['berita_fungsi_disposisi'] == $level_id) {
                                                    ?>
                                                    <a onclick = "if (!confirm('Anda Yakin Melakukan Penghapusan data?'))
                                                                                return false;" href="<?= base_url(); ?>index.php/berita/detail/delfungsi/<?= $this->uri->segment(4); ?>/<?= $var_terdispo[$key['instruksi_nama']]['disposisi_instruksi_kd']; ?>" >
                                                        <img src="<?= base_url(); ?>resources/images/icon_bad.png" /></a>  <?php
                                                }
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                $kotak_sisa=$jml_fungsi-count($instruksi);
                                for($x=0;$x<$kotak_sisa;$x++){
                                    echo '<tr style="height:40px !important;"><td colspan="3">&nbsp;</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td width="50%" align="center">
                        <input type="submit" name="TAMBAH_FUNGSI" value="Tambahkan Fungsi" class="btn btn-blue btn-sm" />
                    </td>
                    <td width="50%" align="center">
                        <input type="submit" name="TAMBAH_INSTRUKSI" value="Tambahkan Instruksi" class="btn btn-blue btn-sm" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <strong>Catatan :</strong> <br>
                        <textarea readonly="" style="margin-top: 5px;color: red;width: 100% !important;border: 0px;"><?= $disposisi[0]['catatan']; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?php
                        if (($berita[0]['berita_fungsi_disposisi'] == $level_id && $disposisi_fungsi == 'Y') || $level_id == '1') {
                            ?> 
                            <input type="submit" onclick = "if (!confirm('Anda Yakin Melakukan Pembatalan Disposisi?'))
                                                return false;"  name="BATAL_DISPOSISI" value="Batalkan Disposisi Ini" class="btn btn-danger" style="float:right;" />
                                   <?php
                               }
                               ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


    <?php
} else {
    //jika belum di disposisi  
    ?> 
    <div class="table-responsive">
        <table class="table">
            <tbody>
                <tr>
                    <td colspan="2" style="padding:0px">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td  width="150px">
                                        <strong>Tanggal Disposisi</strong>
                                    </td>
                                    <td>
                                        : 
                                        <?php
                                        $newdate = date("Y-m-d h:i:s", strtotime($berita[0]['tgl_disposisi']));
                                        echo $newdate;
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>Nomor Berita</strong>
                                    </td>
                                    <td>
                                        : 
                                        <?php echo $berita[0]['berita_kd']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>Perihal</strong>
                                    </td>
                                    <td>
                                        : <?php echo $berita[0]['perihal_berita']; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <th width="50%" align="center">Disposisi Kepada:</th>
                    <th width="50%" align="center">Isi Instruksi:</th>
                </tr>
            </tbody>
            <tbody>
                <tr>
            <input type="hidden" value="<?= $berita[0]['arsip_kd']; ?>" name="arsip_kd"/> 
            <td style="padding:0px">
                <table class="table table-striped">
                    <?php
                    $x = 0;
                    $jml_fungsi=count($fungsi);
                    foreach ($fungsi as $key) {
                        $x++;
                        ?>
                        <tr style="height:40px !important;">
                            <td id="td" >
                                <input type="checkbox" onClick="check_sebelah(this, 'fungsi_kd',<?php echo $x; ?>);" id="detail_perhatian_<?php echo $x; ?>" title="Pelaksana" name="detail_perhatian[]" value="<?= $key['fungsi_kd']; ?>" />
                                <input type="checkbox" onClick="uncheck_sebelah(this, 'detail_perhatian',<?php echo $x; ?>);" id="fungsi_kd_<?php echo $x; ?>" title="Pendukung" name="fungsi_kd[]" value="<?= $key['fungsi_kd']; ?>" />
                                <?= $key['nama_fungsi']; ?> </td>
                        </tr>
                    <?php } ?>
                </table>
            </td>
            <td style="padding:0px">
                <table class="table table-striped">

                    <?php
                    $x = 0;
                    foreach ($instruksi as $key) {
                        $x++;
                        ?>
                        <tr style="height:40px !important;">
                            <td>
                                <input type="checkbox" onClick="check_sebelah(this, 'instruksi_kd',<?php echo $x; ?>);" id="instruksi_perhatian_<?php echo $x; ?>" title="Pelaksana" name="instruksi_perhatian[]" value="<?= $key['instruksi_kd']; ?>" />
                                <input type="checkbox"  onClick="uncheck_sebelah(this, 'instruksi_perhatian',<?php echo $x; ?>);" id="instruksi_kd_<?php echo $x; ?>" name="instruksi_kd[]" value="<?= $key['instruksi_kd']; ?>" />
                                <?= $key['instruksi_nama']; ?>
                            </td>
                        </tr>
                    <?php } 
                    
                    $kotak_sisa=$jml_fungsi-count($instruksi);
                    for($x=0;$x<$kotak_sisa;$x++){
                        echo '<tr style="height:40px !important;"><td>&nbsp;</td></tr>';
                    }
                    ?>

                </table>
            </td>
            </tr>
            <tr>
                <td colspan="2">
                    Catatan : <br>
                    <textarea name="catatan" class="form-control"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Kirim Notifikasi ke email ? 
                    <label class="radio-inline">
                        <input type="radio" name="notif" value="Yes" checked> Ya 
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="notif" value="T"> Tidak 
                    </label>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="right">
                    <input type="submit" name="DISPOSISI" value="Disposisikan" class="btn btn-red"/>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    </p>
<?php } ?>
</form>

<script languange="javascript">
    function uncheck_sebelah(z, y, x) {
        var oCheckbox = document.getElementById(y + "_" + x);

        if (z.checked == true)
        {
            //do nothing
        } else
        {
            oCheckbox.checked = false;
        }
    }

    function check_sebelah(z, y, x)
    {
        var oCheckbox = document.getElementById(y + "_" + x);

        if (z.checked == true)
        {
            oCheckbox.checked = true;
        } else
        {
            oCheckbox.checked = false;
        }
    }

</script>
