<?php
$username = $this->session->userdata('SESSION_USERNAME');
$notif = $this->session->flashdata('notifikasi2');
if (!empty($username)) {
    $this->load->view('tmpl/header');
    ?>
    <script language="javascript">

    </script>
    <div id="content">
        <div id="main-content">
            <h2>Pendelegasian Disposisi Berita Biasa</h2>
            <div class="simple-con tleft" style="font-size:12px; padding-left:20px; padding-right:20px;"> 
                Halaman ini akan membantu anda untuk mendelegasikan kemampuan disposisi kepada fungsi yang ditunjuk juga untuk menonaktifkan pendelegasiannya. 
                <form method="post">
                    <fieldset>
                        <div><?php if (!empty($notif)) {
        echo "<script>alert('" . $notif . "');</script>";
    } ?>  </div>
                        <ul class="align-list">
                            <li>
                                <label for="addarticle-title">Pilih Fungsi Untuk Pendelegasian </label>
                                <select id="addarticle-category" name="fungsi_kd">
                                    <option value="0" selected>-Pilih-</option>
                                    <?php foreach ($delegate as $val) { ?>
                                        <option value="<?= $val['fungsi_kd']; ?>"><?= $val['nama_fungsi']; ?></option>
    <?php } ?>
                                </select>
                            </li>
                            <li>
                                <label></label>
                                <input type="submit" name="Delegasi" value="Delegasikan Disposisi" class="green" />
                                <input type="submit" value="Clear all" class="red	" onClick="this.form.reset();" />
                            </li>
                        </ul>

                        <ul class="align-list">
                            <li>
                                <br>
                                <strong>Fungsi yang saat ini yang mendapatkan disposisi!</strong> 
                                <?php
                                if (empty($delegated_fungsi[0]['nama_fungsi'])) {
                                    echo "<br><i>Tidak ada Fungsi yang terdelegasi untuk melakukan disposisi</i>";
                                } else {
                                    foreach ($delegated_fungsi as $val) {
                                        ?>
                                    <li><?php echo $val['nama_fungsi']; ?><br>
                                        <a href="<?= base_url(); ?>index.php/delegate/delegate/redelegate/<?= $val['fungsi_kd']; ?>">Akhiri Pendelegasian</a></li>
                                <?php
                                }
                            }
                            ?>

                            </li>

                        </ul>
                    </fieldset>

                </form>

            </div>

        </div>
    </div>
    <?php $this->load->view('tmpl/footer'); ?>
    <?php
} else {
    redirect('');
}
?>