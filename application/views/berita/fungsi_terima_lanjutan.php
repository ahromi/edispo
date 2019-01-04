<?
$user_menerima_disposisi = $this->session->userdata('SESSION_MENERIMA_DISPOSISI');
$disposisi_fungsi = $this->session->userdata('SESSION_DISPOSISI_FUNGSI');
$level_id = $this->session->userdata('SESSION_FUNGSI_KD');
?>
<h2 style="margin-bottom:-1px;">Disposisi Dokumen</h2>
<table>
    <tr>
        <td>
            <table id="">
                <tr>
                    <th>Pemegang Fungsi Terdisposisi!</th>
                </tr>
                <tr>
                    <td id="td" >
                        <ul style="list-style:square;">
                                <? foreach ($fungsi_disposisi as $key) { ?>
                                <li><?
                                    if ($key['fungsi_kd'] == $level_id) {
                                        echo "<b><i>" . $key['nama_fungsi'] . "</i></b>";
                                    } else {
                                        echo $key['nama_fungsi'];
                                    }
                                    ?></li>
<? } ?>
                        </ul>
                    </td>
                </tr>
            </table>
        </td>
        <td>
            <table id="">
                <tr>
                    <th>Isi Instruksi Disposisi!</th>
                </tr>
                <tr>
                    <td id="td" >
                        <ul style="list-style:square;">
<? foreach ($instruksi_disposisi as $key) { ?>
                                <li><?= $key['instruksi_nama']; ?></li>
<? } ?>
                        </ul>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <table>

                <tr> <th colspan="2">
                        Korespondensi
                    </th>
                </tr>
                <tr>
                    <td id="td" colspan="2">
<?php
$tb = 0;
foreach ($korespondensi as $key) {
    $tb++;
    if ($key['detail_terima'] == 'Y') {
        $status = 'Sudah Menerima pada ' . $key['detail_waktu'];
    } else {
        $status = 'Belum Menerima';
    }
    echo "<b>" . $key['nama_fungsi'] . "</b> : <em>Status (<strong>$status</strong>) </em><br><i>" . word_limiter($key['detail_korespondensi'], 20, ' .... <a style="cursor:pointer;" onclick="doIt(\'#lengkap' . $tb . '\');"> selengkapnya</a>') . "</i>";
    ?> 
                            <br><br />
                            <div id="lengkap<?= $tb; ?>" style="display:none; width:auto; height:auto;">
                                <font color="#000000" size="+1"><?= $key['detail_korespondensi']; ?></font>
                            </div>
    <? }
?>
                    </td>
                </tr>                                            
                <tr>
                    <td id="td" colspan="2"> 
                                        <?php
                                        //print_r($detail_terima);
                                        if (!empty($detail_terima_lanjutan[0]['detail_terima'])) {
                                            ?>
                    <tr><th colspan="2" style="font-size:14px;" >Penerusan Disposisi kepada Pelaksana Fungsi</th></tr>
                    <tr><td>
                            <table>
                                <tr>
                                    <th>Pelaksana Fungsi Terdisposisi!</th>
                                </tr>
                                <tr>
                                    <td id="td" >
                                        <ul style="list-style:square;">
    <? foreach ($user_disposisi_lanjutan as $key) { ?>
                                                <li><?
        if ($key['user_kd'] == $level_id) {
            echo "<b><i>" . $key['user_nama'] . "</i></b>";
        } else {
            echo $key['user_nama'];
        }
        ?></li>
                                            <? } ?>
                                        </ul>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table>
                                <tr>
                                    <th>Isi Penerusan Instruksi Disposisi!</th>
                                </tr>
                                <tr>
                                    <td id="td" >
                                        <ul style="list-style:square;">
                <?php foreach ($instruksi_disposed_lanjutan as $key) { ?>
                                                <li><?= $key['instruksi_nama']; ?></li>
                <? } ?>
                                        </ul>
                                    </td>
                                </tr>
                            </table>
                        </td></tr>
            </td>
        </tr>
        <tr>
            <td id="td" colspan=2">
                <b>Catatan :</b><br>
    <?php
    if (!empty($disposisi[0]['catatan'])) {
        echo "<b>" .$disposisi[0]['nama_fungsi']. ": </b>";
        echo word_limiter($disposisi[0]['catatan'], 30, '<a style="cursor:pointer;" onclick="doIt(\'#lengkapx\');"> selengkapnya</a>');
    }
    if (!empty($disposisi_lanjutan_kd[0]['disposisi_lanjutan_catatan'])) {
    echo "<br>";
    echo "<b>Korfung: </b>";
    echo $disposisi_lanjutan_kd[0]['disposisi_lanjutan_catatan'];
    }
    ?>
            </td>
        </tr>   
        <tr>
            <td colspan="2" style="text-align:left;">
    <?php if ($detail_disposisi_lanjutan[0]['detail_terima'] == 'T') { ?>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <b>Korespondensi : </b><br />

                        <textarea name="korespondensi_detail" style="width:95%; background-color:#FFFFD5" rows="6"></textarea>
                        <br>
                        <input type="submit" name="TERIMA" value="TERIMA DISPOSISI">

                    </form>
    <?php
    } else {
        echo "<b>Korespondensi : </b><br />";
        echo "<b> " . $detail_disposisi_lanjutan[0]['user_nama'] . "</b> <i>&quot; " . $detail_disposisi_lanjutan[0]['detail_korespondensi'] . " &quot;  pada " . $detail_disposisi_lanjutan[0]['detail_waktu'] . "<br>";
    }
    ?>
            </td>
        </tr>
<? } ?>   
</table>
</td>
</tr>
</table>

<?php if ($detail_terima_lanjutan[0]['detail_terima'] == 'Y') {
    $this->load->view('berita/fungsi_pengerjaan');
} ?>
