<?php
$flag="";
if (isset($detail_terima[0]['berita_status_pengerjaan'])) {
    if ($detail_terima[0]['berita_status_pengerjaan'] != 'Y') {
        $flag = "belum";
    }
} else {
    $flag = "belum";
}

if ($flag == "belum") {
    ?>
    <table class="table table-striped">
        <tbody>
            <?php echo form_open_multipart('berita/detail_fungsi/id/' . $this->uri->segment(4)); ?>
            <tr>
                <td>
                    <strong>Korespondensi Penjelasan Pengerjaan Disposisi :</strong>
                </td>
            </tr>
            <tr>
                <td>
                    <textarea class="form-control" rows="3" name="korespondensi_komentar"></textarea>
                </td>
            </tr>
            <tr>
                <td align="right">
                    <input type="submit" name="PENGERJAAN_DISPOSISI" class="btn btn-blue" value="Sudah Dilakukan">
                </td>
            </tr>
            </form>
        </tbody>
    </table>
    <?php

}


