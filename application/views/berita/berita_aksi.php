                            <?php if ($berita[0]['berita_disposisikan']=='Y' && (($berita[0]['berita_fungsi_disposisi']==$level_id && $user_menerima_disposisi==$level_id ) || $berita[0]['berita_fungsi_disposisi']=='1' || $berita[0]['berita_fungsi_disposisi']=='2')) {
								?>
              <?php //if (($berita[0]['berita_disposisikan']=='Y' && $berita[0]['berita_fungsi_disposisi']==$level_id && $user_menerima_disposisi=='Y') || ($level_id=='1' || $level_id=='2')) { ?>                    
                                
            <h2 style="margin-bottom:-1px;">Lakukan aksi ?</h2>
 		<center>
        <br />
 
        	<input type="radio" name="aksi" id="aksiDispo" checked="checked" value="dispo" /><strong>Disposisi</strong>
            <input type="radio" name="aksi" value="alihkan" /><strong>Alihkan Disposisi</strong>
<br />
<i>Dengan mengalihkan disposisi, <br /> maka dokumen akan ditujukan bagi pendisposisi terpilih!</i>
<br />
        </center>
        <? // } ?>
<div id="alihkan_panel" align="center" style="display:none;">
	<h2>Alihkan disposisi ke Fungsi ?</h2>
    <?php foreach($fungsi_mendispo as $val) 
	{?> 
    <input type="radio" name="fungsi" value="<?php echo $val['fungsi_kd']; ?>" onclick="getVal(this.value);"  id="fungsi_alihkan" /><?php echo strtoupper($val['nama_fungsi']); ?><br />	
	<?php }?>
    <input type="hidden" id="valFungsi" />
    <input type="button" name="ALIHKAN_DISPO" value="ALIHKAN" id="ALIHKAN_DISPO" class="red"  />
    <br /><br />
 </div>        
<div id="disposisi_panel">
 									<? if ($disposisi_fungsi=='Y') { 
                                            $this->load->view('berita/fungsi_disposisi');	}
                                        else
                                        { 
                                             	$this->load->view('berita/fungsi_terima');
                                         } ?>
                            <? } else { ?> 
								<h3>Berita Ini Tidak Didisposisi!</h3>
							<? } ?>
</div>
                            <br />