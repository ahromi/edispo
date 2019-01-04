<?php
$cari = $this->uri->segment(4);
$notif = $this->session->flashdata('notifikasi');
$notif2 = $this->session->flashdata('notifikasi2');
$level_id = $this->session->userdata('SESSION_FUNGSI_KD');
if (isset($_POST['CARI'])) {
    $arsip = $_POST['arsip_kd'];
    $berita_kd = $_POST['berita_kd'];
    $date1 = $_POST['tgl_mulai'];
    $date2 = $_POST['tgl_akhir'];
    $perihal = $_POST['perihal_berita'];
} else {
    $arsip = "";
    $berita_kd = "";
    $date1 = "";
    $date2 = "";
    $perihal = "";
}

$user_nama = $this->session->flashdata('user_nama');
$user_namalengkap = $this->session->flashdata('user_namalengkap');
$username = $this->session->userdata('SESSION_USERNAME');
if (!empty($username)) {
    $this->load->view('tmpl/header');
    ?>
    <?php if (!empty($notif)) { ?>
        <script language="javascript">window.alert('<?= $notif; ?>');</script>
            <?php } ?>

    <div id="content">
        <div id="main-content">
            <h2>Import Data SIMBRA</h2>
    <?php echo form_open_multipart('import/import/index'); ?>                         
            <fieldset>
                <ul class="align-list">
                    <li>
                        <label for="addarticle-title">File Export Simbra </label>
                        <input type="file" id="addarticle-image" name="userfile"/>
                        <input type="submit" name="UPLOAD" value="Upload" class="green" /><br />
                    </li>
                    <li>
                </ul>
            </fieldset>
            </form>
    <?php if (!empty($_POST['UPLOAD'])) { ?>
                <center><h3 style="background-color:#B7F2BF;">Berhasil menemukan <?php echo (count($csvData)); ?> data !</h3></center>
        <?php echo form_open_multipart('import/import/index', 'id="importForm"'); ?>                         
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>No. Dokumen</th>
                            <th>Perihal </th>
                            <th>Tanggal Dokumen</th>
                            <th>Derajat</th>
                            <th>Pengirim</th>
                            <th>Jabatan Pengirim</th>
                            <th>Disposisikan ?</th>
                            <th>Pelaksana Disposisi</th>
                            <th>Upload</th>
                        </tr>
                    </thead>
                    <tbody>
        <?php foreach ($csvData as $field) { ?>
                            <tr id="row">
                                <td width="3%"><?php echo $field['ID']; ?></td>
                                <td width="9%"><?php echo $field['KD_BERITA']; ?> 
                                    <input type="hidden"  value="<?php echo $field['KD_BERITA']; ?>" name="kd_berita[]" /></td>
                                <td width="20%" align="left" style="text-align:left;"><?php echo $field['PERIHAL_BERITA']; ?>
                                    <input type="hidden" value="<?php echo $field['PERIHAL_BERITA']; ?>" name="perihal_berita[]" /></td>
                                <td width="20%" align="left" style="text-align:left;"><?php echo $field['TANGGAL']; ?>
                                    <input type="hidden" value="<?php echo $field['TANGGAL']; ?>" name="tanggal[]" /></td>
                                <td width="10%">
                                    <input type="hidden" value="<?php echo $field['DERAJAT']; ?>" name="derajat[]" />
                                    <?php
                                    if ($field['DERAJAT'] == '000') {
                                        echo 'BIASA';
                                    }
                                    if ($field['DERAJAT'] == '111') {
                                        echo 'SEGERA';
                                    }
                                    if ($field['DERAJAT'] == '222') {
                                        echo 'SANGAT SEGERA';
                                    }
                                    if ($field['DERAJAT'] == '333') {
                                        echo 'KILAT';
                                    }
                                    ?></td>
                                <td width="5%">
                                    <select name="pengirim[]" style="width:200px; text-align:left;" required class="chosen" >
                                        <option selected="selected" validate="required:true">Pilih...</option>
            <?php foreach ($pengirim as $val_pengirim) { ?> 
                                            <option value="<?php echo $val_pengirim['perwakilan_kd']; ?>"><?php echo $val_pengirim['perwakilan_nama']; ?></option>
            <?php } ?>
                                    </select></td>
                                <td width="15%" align="left"><input name="jabatan[]" type="text" required style="width:150px;"/></td>
                                <td width="9%"><select required name="dispo[]" style="width:100px; text-align:left;" class="chosen">
                                        <option selected="selected">Ya</option>
                                        <option>Tidak</option>
                                    </select></td>
                                <td width="10%"><select required name="pendispo[]"  style="width:200px; text-align:left;" class="chosen" >
            <?php foreach ($pendispo as $val_pendispo) { ?> 
                                            <option selected="selected" value="<?php echo $val_pendispo['fungsi_kd']; ?>"><?php echo $val_pendispo['nama_fungsi']; ?></option>
            <?php } ?>
                                    </select></td>
                                <td width="3%"><input type="file" required name="userfiles[]" /></td>

                            </tr>
        <?php } ?>
                        <tr>
                            <td colspan="10"><input type="submit" value="SUBMIT" name="SUBMIT" /></td>
                        </tr>
                    </tbody>
                </table>
                <form>
                    <script language="javascript">
                        $("#importForm").validate();
                    </script>
    <?php } ?>                         
        </div>
    </div>
    <?php $this->load->view('tmpl/footer'); ?>
    <?php
} else {
    redirect('');
}
?>