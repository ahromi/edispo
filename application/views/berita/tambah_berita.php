<?php
$cari = $this->uri->segment(4);
$notif = $this->session->flashdata('notifikasi');
$notif2 = $this->session->flashdata('notifikasi2');
$user_nama = $this->session->flashdata('user_nama');
$user_namalengkap = $this->session->flashdata('user_namalengkap');
$username = $this->session->userdata('SESSION_USERNAME');
if (!empty($username)) {
    $this->load->view('tmpl/header');
    ?>
    <div id="content">
        <div id="main-content">

            <h2>Tambah Dokumen</h2>

            <?php echo form_open_multipart('berita/tambah_berita' . $this->uri->segment(4)); ?> 
            <fieldset>
                <?php if (!empty($notif)) { ?>
                    <script language="javascript">window.alert('<?= $notif; ?>');</script>
                <?php } ?>
                <ul class="align-list">
                    <li>
                        <label for="addarticle-title">No Arsip</label>
                        <input type="text"  value="<?= $kode; ?>" readonly="readonly" id="addarticle-title" name="arsip_kd" class="box-small" /> (otomatis)
                    </li>
                    <li>
                        <label for="addarticle-category">Jenis Dokumen *</label>
                        <select id="addarticle-category" name="jenis_kd">
                            <?php foreach ($jenis as $val) { ?>
                                <option <?php if ($val['jenis_nama'] == '-') {
                            echo "selected";
                        } ?>  value="<?= $val['jenis_kd']; ?>"> <?php if ($val['jenis_nama'] == '-') {
                            echo "-Pilih-";
                        } else {
                            echo $val['jenis_nama'];
                        } ?></option>
    <?php } ?>
                        </select>
                    </li>
                    <li>
                        <label for="addarticle-title">No Dokumen *</label>
                        <input type="text" value="" id="addarticle-title" name="berita_kd" class="box-small" />
                        (yang tertera pada dokumen)</li>
                    <li>
                        <label for="addarticle-category">Sifat Dokumen</label>
                        <select id="addarticle-category" name="sifat_kd">
    <?php foreach ($sifat as $val) { ?>
                                <option selected="selected"  value="<?= $val['sifat_kd']; ?>"><?= $val['sifat_nama']; ?></option>
    <?php } ?>
                        </select>
                    </li>
                    <li>
                        <label for="addarticle-category">Instansi Pengirim * <em><strong><font color="#FF0000">(ketik lalu pilih)</font></strong></em></label>
                        <input id="tags" style="width:320px;">                                           
                        <input type="hidden" id="perwakilan_kd" name="perwakilan_kd"> 
                        <A href="#" name="window" id="window">Tambah Baru</a>

                        <div id="input_pengirim" style="display:none;">
                            <h3>Isi Form Untuk Menambah!</h3>
                            <strong> Instansi Pengirim /Perwakilan :</strong> <br />
                            <input type="text" name="text" id="text" size="15" /> 
                            <input type="button" name="submit" value="tambah" onclick="insert(document.getElementById('text').value);" />
                        </div>


                    </li>
                    <li>
                        <label for="addarticle-category">Jabatan Pengirim</label>
                        <input type="text" value="" id="addarticle-title" name="jabatan_pengirim" class="box-medium" />
                    </li>
                    <li>
                        <label for="addarticle-category">Derajat Berita</label>
                        <select id="addarticle-category" name="derajat_kd">
    <?php foreach ($derajat as $val) {
        if ($val['derajat_nama'] == '-') {
            ?>  
                                    <option selected="selected" value="<?= $val['derajat_kd']; ?>"><?= $val['derajat_nama']; ?></option>
        <?php } ?>
                                <option value="<?= $val['derajat_kd']; ?>"><?= $val['derajat_nama']; ?></option>
    <?php } ?>
                        </select>
                    </li>
                    <li>
                        <label for="addarticle-title">Tanggal Berita *</label>
                        <input type="text" class="box-small" value="<? echo date('Y/m/d');?>" id="tgl_berita" readonly name="tgl_berita">

                    </li>
                    <li>
                        <label for="addarticle-content">Perihal*</label>
                        <textarea cols="15" rows="3" name="perihal_berita"></textarea>
                    </li>
                    <li>
                        <label for="addarticle-content">Keterangan</label>
                        <textarea cols="15" rows="2" name="keterangan"></textarea>
                    </li>
                    <li>
                        <label for="addarticle-category">Disposisikan Dokumen ?</label>
                        <select id="addarticle-category" name="berita_disposisikan">
                            <option value="T" selected>TIDAK</option>
                            <option value="Y" >YA</option>
                        </select>
                    </li>
                    <li>
                        <label for="addarticle-category">Disposisi Oleh </label>
    <?php foreach ($pendispo as $val) { ?>
                            <input type="radio" name="berita_fungsi_disposisi" value="<?php echo $val['fungsi_kd']; ?>" selected><?php echo $val['nama_fungsi']; ?></option>
    <?php } ?>
                    </li>
                    <li>
                        <label for="addarticle-image">File Dokumen </label>
                        <input type="file" id="addarticle-image" name="userfile"/>
                    </li>
                    <li>
                        <label></label>
                        <input type="submit" name="TAMBAH" value="Submit" class="green" /><br />

                        <a href="<?= base_url(); ?>index.php/Berita/Berita" onclick="history.back(1)">Kembali</a>
                    </li>
                    <li>
                </ul>
            </fieldset>
            </form>
        </div>
    </div>
    <?php $this->load->view('tmpl/footer'); ?>
    <?php
} else {
    redirect('');
}
?>
  