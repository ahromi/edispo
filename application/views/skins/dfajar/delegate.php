<?php
$username = $this->session->userdata('SESSION_USERNAME');
$notif = $this->session->flashdata('notifikasi2');
if (!empty($username)) {
    $this->load->view('skins/' . $skin_val . '/tmpl/header');
    ?>

    <div class="page-content" style="font-family: Arial, Helvetica, sans-serif">
        <!-- begin PAGE TITLE ROW -->
        <div class="row">
            <div class="col-lg-12">
                <div class="portlet portlet-default">
                    <div class="portlet-heading">
                        <div class="portlet-title">
                            <h4>Pendelegasian Disposisi Berita Biasa</h4>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="horizontalFormExample" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <p>
                                Halaman ini akan membantu anda untuk mendelegasikan kemampuan disposisi kepada fungsi yang ditunjuk juga untuk menonaktifkan pendelegasiannya. 

                            </p>
                            <?php
                            if (!empty($notif)) {
                                echo "<script>alert('" . $notif . "');</script>";
                            }
                            ?>
                            <form method="post" class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Pilih Fungsi Untuk Pendelegasian </label>
                                    <div class="col-sm-9">
                                        <select id="addarticle-category" name="fungsi_kd" class="form-control">
                                            <option value="0" selected>-Pilih-</option>
                                            <?php foreach ($delegate as $val) { ?>
                                                <option value="<?= $val['fungsi_kd']; ?>"><?= $val['nama_fungsi']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <input type="submit" name="Delegasi" value="Delegasikan Disposisi" class="btn btn-sm btn-default" />
                                    </div>
                                </div>
                            </form>
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <td colspan="2">
                                            <strong>Fungsi yang saat ini yang mendapatkan disposisi!</strong> 
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (empty($delegated_fungsi[0]['nama_fungsi'])) {
                                        echo '<tr><td colspan="2">Tidak ada Fungsi yang terdelegasi untuk melakukan disposisi</td></tr>';
                                    } else {
                                        foreach ($delegated_fungsi as $val) {
                                            ?>
                                            <tr>
                                                <td><?php echo $val['nama_fungsi']; ?></td>
                                                <td><a class="btn btn-sm btn-warning" href="<?= base_url(); ?>index.php/delegate/delegate/redelegate/<?= $val['fungsi_kd']; ?>">Akhiri Pendelegasian</a></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>

                                </tbody>

                            </table>
                        </div>
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