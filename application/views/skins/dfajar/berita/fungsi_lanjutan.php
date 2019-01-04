<?php if ($if_lanjutan > 0) { ?>
    <table width="100%">
        <tr>
            <td>
                Lakukan Disposisi Lanjutan bagi Pelaksana Fungsi?
            </td>
        </tr>
        <tr>
            <td>
                <input type="radio" name="lanjutDispo"  value="YA"  /><strong>YA</strong>
                <input type="radio" name="lanjutDispo"  checked="checked" value="TIDAK" /><strong>TIDAK</strong>
            </td>
        </tr>
        <tr style="display:none;" id="lanjutDispoPanel1">
            <td>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="50%" align="center">Pelaksana Fungsi:</th>
                            <th width="50%" align="center">Isi Instruksi:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding:0px">
                                <table class="table table-striped">
                                    <?php foreach ($pelaksana_lanjutan as $key) { ?>
                                        <tr>
                                            <td id="td" ><input type="checkbox" name="user_kd[]" value="<?= $key['user_kd']; ?>" /> <?= ucfirst($key['user_namalengkap']); ?> </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </td>
                            <td style="padding:0px">
                                <table class="table table-striped">
                                    <?php foreach ($instruksi as $key) { ?>
                                        <tr>
                                            <td id="td" >
                                                <input type="checkbox" name="instruksi_kd[]" value="<?= $key['instruksi_kd']; ?>" /> <?= $key['instruksi_nama']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

    <div class="row" id="lanjutDispoPanel2" style="display:none;">
        <div class="col-xs-12">
            Catatan Disposisi kepada Pelaksana Fungsi:<br />
            <textarea name="disposisi_lanjutan_catatan" class="form-control" placeholder=""></textarea><br />
        </div>
    </div>
<?php } ?>
