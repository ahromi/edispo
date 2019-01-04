                                    <?php if ($if_lanjutan>0){ ?>
                                    <tr> 
                                    	<th style="font-size:14px;">
                                            Lakukan Disposisi Lanjutan bagi Pelaksana Fungsi?<br />                                        </th>
                                    </tr>
                                    <tr><td >
                                    <input type="radio" name="lanjutDispo"  value="YA" /><strong>YA</strong>
                                    <input type="radio" name="lanjutDispo"  checked="checked" value="TIDAK" /><strong>TIDAK</strong>

                                    </td></tr>

                                    <tr>
                                    <td id="lanjutDispoPanel1" style="display:none;" >
                            	<table id="tabel" >
                                    <tr>
                                        <th>Pelaksana Fungsi:</th>
                                    </tr>
                                    <? foreach($pelaksana_lanjutan as $key) { ?>
                                    <tr>
                                        <td id="td" ><input type="checkbox" name="user_kd[]" value="<?=$key['user_kd'];?>" /> <?=ucfirst($key['user_namalengkap']);?> </td>
                                    </tr>
                                    <? } ?>
								</table>
                            	<table id="tabel2" >
                                    <tr>
                                        <th>Isi Instruksi:</th>
                                    </tr>
                                        <tr>
                                        <td id="td" >
                                       <ul style="list-style:none;">
                                    <? foreach($instruksi as $key) { ?>
                                            <li>
                                             <input type="checkbox" name="instruksi_kd[]" value="<?=$key['instruksi_kd'];?>" /> <?=$key['instruksi_nama'];?>
                                            </li>
                                    <? } ?>
                                    	</ul>
                                        </td>
                                    </tr>
                                </table>                                      
                                         </td>
                                    </tr>
                                    <tr  id="lanjutDispoPanel2" style="display:none;"><td style="text-align:left;">
Catatan Disposisi kepada Pelaksana Fungsi:<br />
                                                                    <textarea name="disposisi_lanjutan_catatan" class="box-large" placeholder=""></textarea><br />

                                    </td></tr>
                                    <?php } ?>
