<?php
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
                        <ul style="list-style:none;">
                            <?php foreach ($fungsi_disposisi as $key) { ?>
                                <li><?php if ($key['fungsi_kd'] == $level_id) {
                                ?>
                                        <img src="<?php echo base_url() ?>resources/images/Check-icon.png">&nbsp;
                                        <?php
                                        if ($key['detail_perhatian'] == 'Y') {
                                            echo "<img src='" . base_url() . "resources/images/Check-icon.png'>";
                                        }
                                        ?>
                                        <?php
                                        echo "<b><i>" . $key['nama_fungsi'] . "</i></b>";
                                    } else {
                                        ?> 
                                        <img src="<?php echo base_url() ?>resources/images/Check-icon.png">&nbsp;
                                        <?php
                                        if ($key['detail_perhatian'] == 'Y') {
                                            echo "<img src='" . base_url() . "resources/images/Check-icon.png'>";
                                        }
                                        ?>
                                        <?php
                                        echo $key['nama_fungsi'];
                                    }
                                    ?></li>
<?php } ?>
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
                        <ul style="list-style:none;">
<?php foreach ($instruksi_disposisi as $key) { ?>
                                <li>
                                    <img src="<?php echo base_url() ?>resources/images/Check-icon.png">&nbsp;
                                    <?php
                                    if ($key['instruksi_perhatian'] == 'Y') {
                                        echo "<img src='" . base_url() . "resources/images/Check-icon.png'>";
                                    }
                                    ?>
                                <?= $key['instruksi_nama']; ?></li>
<?php } ?>
                        </ul>
                    </td>
                </tr>
            </table>

    <tr> <th colspan="2">
            <strong> Tanggal Disposisi</strong> <br /><?php
            $newdate = date("d-m-Y h:i:s", strtotime($berita[0]['tgl_disposisi']));
            echo $newdate;
            ?> 
        </th>
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
                            $test = $key['detail_korespondensi'];
                            if ($key['detail_terima'] == 'Y') {
                                $status = 'Sudah Menerima pada ' . $key['detail_waktu'];
                            } else {
                                $status = 'Belum Menerima';
                            }
                            echo "<b>" . $key['nama_fungsi'] . "</b> : <em>Status (<strong>$status</strong>) </em><br><i>" . word_limiter($test, 20, ' .... <a style="cursor:pointer;" onclick="doIt(\'#lengkap' . $tb . '\');"> selengkapnya</a>') . "</i>";
                            ?> 
                            <br><br />
                            <div id="lengkap<?= $tb; ?>" style="display:none; width:auto; height:auto;">
                                <font color="#000000" size="+1"><?php echo $key['detail_korespondensi']; ?></font>
                            </div>
                            <?php }
                        ?>
                    </td>
                </tr>                                            
                <tr>
                    <td id="td" colspan="2"> 
                        Catatan : <br />
                        <b><em><?php
                                if (!empty($disposisi[0]['catatan'])) {
                                    echo "<b>" . $disposisi[0]['nama_fungsi'] . ": </b>";
                                    echo word_limiter($disposisi[0]['catatan'], 30, '<a style="cursor:pointer;" onclick="doIt(\'#lengkapx\');"> selengkapnya</a>');
                                }
                                ?></em></b>
                        <div id="lengkapx" style="display:none; width:auto; height:auto;">
                            <font color="#000000" size="+1"><?= $disposisi[0]['catatan']; ?></font>
                        </div>                                                        <br />
                        <a href="<?= base_url(); ?>index.php/berita/berita/doc_catatan/<?= $this->uri->segment(4); ?>">[ Jadikan sbg Draft Berita Balasan ]</a><br />
                        <?php
                        if (!empty($detail_terima[0]['detail_terima'])) {
                            if ($detail_terima[0]['detail_terima'] == 'T') {
                                ?>

        <?php if (($berita[0]['berita_disposisikan'] == 'Y' && $user_menerima_disposisi == 'Y') || ($level_id == '1' || $level_id == '2')) { ?>

                                    Korespondensi  :
                                    <i>*optional</i><br />
                                    <form method="post">
                                        <input type="hidden" name="fungsi_kd" value="<?= $level_id; ?>" />
                                        <input type="hidden" name="arsip_kd" value="<?= $this->uri->segment(4); ?>" />
                                        <textarea name="korespondensi" class="box-large"></textarea><br />
                                        <?php $this->load->view('berita/fungsi_lanjutan'); ?>
                                        <tr><td><input type="submit" id="TERIMA_DISPOSISI"  name="TERIMA_DISPOSISI" value="Terima Disposisi" class="green" style="float:left;" /></td></tr>
                                <?php } ?>
                                </form>
                            <?php } else {
                                if (!empty($detail_terima[0]['detail_korespondensi'])) {
                                    echo "<br> <b><i>" . word_limiter($detail_terima[0]['detail_korespondensi'], 30, '<a style="cursor:pointer;" onclick="doIt(\'#lengkap\');"> selengkapnya</a>') . "</i></b>";
                                    ?>
                                    <div id="lengkap" style="display:none; width:auto; height:auto;">
                                        <font color="#000000" size="+1"><?= $detail_terima[0]['detail_korespondensi']; ?></font>
                                    </div>
                                    <br />
                                    <a href="<?= base_url(); ?>index.php/berita/berita/doc_respon/<?= $this->uri->segment(4); ?>/<?= $detail_terima[0]['disposisi_detail_kd']; ?>">[ Jadikan sbg Draft Berita Balasan ]</a><br /> 
                                    <br /> <?php } ?>
                        <center><b><i><font color='blue'>Disposisi Berita Ini telah anda terima!</font></i></b>
                            <img src="<?= base_url(); ?>resources/images/approve.png" />
                        </center>
                        <center><a  onclick="window.open('<?= base_url(); ?>index.php/berita/cetak/id/<?= $berita[0]['arsip_kd']; ?>', 'mywindow', 'menubar=yes, width=800');" href="#" class="tiptip-top" title="Print Disposisi"><img src="<?= base_url(); ?>resources/images/print-icon.png" alt="print" /></a></center>
                        <br />         										

                        <?php
                        $this->load->view('berita/fungsi_pengerjaan');
                        if ($if_lanjutan > 0) {
                            ?>
                            <tr><th colspan="2" style="font-size:14px;" >Penerusan Disposisi kepada Pelaksana Fungsi</th></tr>
                            <tr><td>
                                    <table id="">
                                        <tr>
                                            <th>Pelaksana Fungsi Terdisposisi!</th>
                                        </tr>
                                        <tr>
                                            <td id="td" >
                                                <ul style="list-style:square;">
                                                        <?php foreach ($user_disposisi_lanjutan as $key) { ?>
                                                        <li><?php
                                                            if ($key['user_kd'] == $level_id) {
                                                                echo "<b><i>" . $key['user_namalengkap'] . "</i></b>";
                                                            } else {
                                                                echo $key['user_namalengkap'];
                                                            }
                                                            ?> 
                                                            <?php
                                                            if ($key['detail_terima'] == 'Y') {
                                                                echo " pada " . $key['detail_waktu'] . "<br>&quot;" . $key['detail_korespondensi'] . "&quot;";
                                                            }
                                                            ?>
                                                        </li>
            <?php } ?>
                                                </ul>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table id="">
                                        <tr>
                                            <th>Isi Penerusan Instruksi Disposisi!</th>
                                        </tr>
                                        <tr>
                                            <td id="td" >
                                                <ul style="list-style:square;">
                                                    <?php
                                                    if (empty($instruksi_disposed_lanjutan)) {
//do nothing
                                                    } else {
                                                        foreach ($instruksi_disposed_lanjutan as $key) {
                                                            ?>
                                                            <li><?= $key['instruksi_nama']; ?></li>
                <?php }
            } ?>
                                                </ul>
                                            </td>
                                        </tr>

                                    </table>
                                </td></tr><tr>
                                <td id="td" colspan=2">
                                    <b>Catatan :</b><br>
                                    <?php
                                    if (empty($disposisi_lanjutan_kd[0]['disposisi_lanjutan_catatan'])) {
//do nothing
                                    } else {
                                        echo $disposisi_lanjutan_kd[0]['disposisi_lanjutan_catatan'];
                                    }
                                    ?>
                                </td>
                            </tr> 
                            <?php
                        }
                    }
                    ?>
            </td>
        </tr>

<?php } ?>   


</table>
</td>
</tr>
</table>
