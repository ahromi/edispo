<?php
$user_menerima_disposisi = $this->session->userdata('SESSION_MENERIMA_DISPOSISI');
$disposisi_fungsi = $this->session->userdata('SESSION_DISPOSISI_FUNGSI');
$level_id = $this->session->userdata('SESSION_FUNGSI_KD');
?>

<?php
if (!empty($detail_terima_lanjutan[0]['detail_terima'])) {
//    echo "<pre>";
//    print_r($user_disposisi_lanjutan);
//    echo "</pre>";
    ?>
    <?php
    if (count($user_disposisi_lanjutan) > 0) {
        ?>
        <table class="table table-bordered" style="margin-bottom: 0px !important;">
            <thead>
                <tr>
                    <th colspan="2">Penerusan Disposisi kepada Pelaksana Fungsi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>Disposisi lanjutan kepada:</strong>
                    </td>
                    <td>
                        <strong>Isi instruksi lanjutan:</strong>
                    </td>
                </tr>
                <tr>
                    <td style="padding:0px;">
                        <table class="table table-striped">
                            <tbody>
                                <?php
                                foreach ($user_disposisi_lanjutan as $key) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php
                                            if ($key['user_kd'] == $level_id) {
                                                echo "<b><i>" . $key['user_namalengkap'] . "</i></b>";
                                            } else {
                                                echo $key['user_namalengkap'];
                                            }
                                            ?> 
                                        </td>
                                        <td></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>

                    </td>
                    <td style="padding:0px;">
                        <table class="table table-striped">
                            <tbody>
                                <?php
                                if (!empty($instruksi_disposed_lanjutan)) {
                                    foreach ($instruksi_disposed_lanjutan as $key) {
                                        ?>
                                        <tr>
                                            <td><?php echo $key['instruksi_nama']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
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
            </tbody>
        </table>
        <?php
    }
    if ($detail_disposisi_lanjutan[0]['detail_terima'] == 'T') {
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <table class="table table-bordered">
                <tr>
                    <td>
                        <b>Korespondensi : </b><br />
                        <textarea name="korespondensi_detail" class="form-control"></textarea>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <input type="submit" name="TERIMA" value="TERIMA DISPOSISI" class="btn btn-sm btn-blue">
                    </td>
                </tr>
            </table>
        </form>
        <?php
    }
    ?>
<?php }
?>

<?php
if ($detail_terima_lanjutan[0]['detail_terima'] == 'Y' && $detail_terima_lanjutan[0]['berita_status_pengerjaan'] != 'Y') {
    $this->load->view('skins/' . $skin_val . '/berita/fungsi_pengerjaan_lanjutan');
}
?>
