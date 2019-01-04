<?php 
$level_id=$this->session->userdata('SESSION_FUNGSI_KD');
$disposisi_fungsi=$this->session->userdata('SESSION_DISPOSISI_FUNGSI');	

$cek_fungsi_respon=''?>
                            <h2 style="margin-bottom:-1px;">Disposisi Dokumen</h2>
                            <? if ($berita[0]['status_disposisi']=='Y') { ?>
                            	<table id="tabel">
                                    <tr>
                                        <th>Pemegang Fungsi Terdisposisi!</th>
                                    </tr>
                                    <tr>
                                        <td id="td" >
                                        <ul style="list-style:square;">
                                    <? foreach($fungsi_disposisi as $key) { 
										if ($key['fungsi_kd']==2) { $cek_fungsi_respon='Y'; } 
									?>
										<li><?=$key['nama_fungsi'];?> 
                                    <?php  if ($berita[0]['berita_fungsi_disposisi']==$level_id) { ?>
                                            <a onclick = "if (!confirm('Anda Yakin Melakukan Penghapusan data?')) return false;" href="<?=base_url();?>index.php/berita/detail/delfungsi/<?=$this->uri->segment(4);?>/<?=$key['disposisi_detail_kd'];?>" >
                                            <img src="<?=base_url();?>resources/images/icon_bad.png" /></a>  <?php } ?>
                                            </li>
                                    <? } ?>
                                    	</ul>
                                    	</td>
                                    </tr>
                                    <tr>
                                        <th>Isi Instruksi Disposisi!</th>
                                    </tr>
                                    <tr>
                                        <td id="td" >
                                        <ul style="list-style:square;">
                                    <? foreach($instruksi_disposisi as $key) { ?>
										<li><?=$key['instruksi_nama'];?>
                                        <?php  if ($berita[0]['berita_fungsi_disposisi']==$level_id) { ?>  
                                         <a onclick = "if (!confirm('Anda Yakin Melakukan Penghapusan data?')) return false;" href="<?=base_url();?>index.php/berita/detail/delins/<?=$this->uri->segment(4);?>/<?=$key['disposisi_instruksi_kd']?>/" > <img src="<?=base_url();?>resources/images/icon_bad.png" /></a>
                                         <?php } ?>
                                         </li>
                                    <? } ?>
                                    	</ul>
                                    	</td>
                                    </tr>
                                </table>
                                <table id="tabel2">
                                	<tr>
                                    	<th colspan="3">Penambahan Disposisi Bagi Pemegang Fungsi</th>
                                    </tr>
	                    <form method="post"> 
                                    <tr>
									<?php $i=0;
                                    foreach($disposed_fungsi as $key) { $i++; ?>
	                                       <?php if ($key['fungsi_kd']!=1){ //dutabesar tidak didispo ?>
		                                        <td id="td" >
		                                        <input type="checkbox" name="fungsi_kd[]" value="<?=$key['fungsi_kd'];?>" /> <?=$key['nama_fungsi'];?> </td>
	                                       <?php } ?> 
                                       <? if ($i%3==0) { ?> </tr> <tr> <? } ?>
                                    <? } ?>
                                            </tr>
                                    <tr>
                                    	<td align="right" colspan="3"><input type="submit" name="TAMBAH_FUNGSI" value="Tambahkan Fungsi Terpilih" class="blue" style="float:right;" /></td>
                                    </tr>
                                </table>                             
</form>

<form method="post">
                                <table id="tabel2" style="margin-top:-9px;">
                                	<tr>
                                    	<th colspan="3">Penambahan Disposisi Instruksi </th>
                                    </tr>
                                    <tr>
											<? $i=0;
											foreach($disposed_instruksi as $key) { $i++; ?>
                                                <td id="td" ><input type="checkbox" name="instruksi_kd[]" value="<?=$key['instruksi_kd'];?>" /> <?=$key['instruksi_nama'];?> </td>
	                                            <? if ($i%3==0) { ?> </tr><tr> <? } ?>
                                            <? } ?>
                                            </tr>
                                    <tr>
                                    	<td align="right" colspan="3"><input type="submit" name="TAMBAH_INSTRUKSI" value="Tambahkan Instruksi Terpilih" class="blue" style="float:right;" /></td>
                                    </tr>
                                </table>                             
</form>

<table>
                                    <tr> <th>
                                          <strong> Tanggal Disposisi</strong> <br /><?php 
										   $newdate=date("d-m-Y h:i:s", strtotime($berita[0]['tgl_disposisi']));
										   echo $newdate; ?><br />
                                           <strong>Catatan</strong>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td id="td"> 
                                            <b><em><? echo word_limiter($disposisi[0]['catatan'],30,'<a style="cursor:pointer;" onclick="doIt(\'#tesss\');"> selengkapnya</a>'); ?>
                                                </em></b>
                                            <br /><br />
                                            <div id="tesss" style="display:none; width:auto; height:auto;">
												<font color="#000000" size="+1"><?=$disposisi[0]['catatan'];?></font>
                                            </div>
                                    </td>
                                    </tr>
                                     <tr> 
                                    <th>
                                        Korespondensi
                                      </th>
                                    </tr>
                                    <tr>
                                    <td id="td">
                                    <?
									$tb=0;
									foreach($korespondensi as $key) { $tb++; 
									if ($key['detail_terima']=='Y') { $status='Sudah Menerima pada '.$key['detail_waktu']; } else { $status='Belum Menerima';  }
										echo "<b>".$key['nama_fungsi']."</b> : <em>Status (<strong>$status</strong>) </em><br><i>".word_limiter($key['detail_korespondensi'],20,' .... <a style="cursor:pointer;" onclick="doIt(\'#lengkap'.$tb.'\');"> selengkapnya</a>')."</i>";?> 
                                        <br><br />
                                        <div id="lengkap<?=$tb;?>" style="display:none; width:auto; height:auto;">
                                            <font color="#000000" size="+1"><?=$key['detail_korespondensi'];?></font>
                                        </div>
										<?
									} ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td id="td">
                                       <?php
                                       if (($berita[0]['berita_fungsi_disposisi']==$level_id && $disposisi_fungsi=='Y') || $level_id=='1' ){
									    ?> 
                                        <form method="post">
                                            <input type="submit" onclick = "if (!confirm('Anda Yakin Melakukan Pembatalan Disposisi?')) return false;"  name="BATAL_DISPOSISI" value="Batalkan Disposisi Ini" class="red" style="float:right;" /></form>
                                        </td>
                                    </tr> <?php } else {  
									
									if($detail_terima[0]['detail_terima']=='T') {  ?>
										Korespondensi  :
                                                        <i>*optional </i><br />
                                                        <form method="post">
                                                            <input type="hidden" name="fungsi_kd" value="<?=$level_id;?>" />
                                                            <textarea name="korespondensi" class="box-large"></textarea><br />
                                                            <input type="submit"  name="TERIMA_DISPOSISI" value="Terima Disposisi" class="green" style="float:left;" />
                                              <?php } else { ?>
                                   <center><b><i><font color='blue'>Disposisi Berita Ini telah anda terima!</font></i></b>
                                           <img src="<?=base_url();?>resources/images/approve.png" />
                                   </center>
                                                        
                                              <?php } ?>              
                                                        </form>
										<?php } ?>

										
								 <tr> 
                                    <th>
                                        Pengerjaan Disposisi Oleh Masing-masing Fungsi: 
                                      </th>
                                    </tr>
                                    <tr>
                                    <td id="td">
                                    <?
									$tb=0;
									foreach($pengerjaan as $key) { $tb++; 
									if ($key['berita_status_pengerjaan']=='Y') { $status='<font color="green">Sudah dilaksanakan.</font>'; } else { $status='<font color="red">Belum dilaksanakan.</font>';  }
										echo "<b>".$key['nama_fungsi']."</b> : <em>Status (<strong>$status</strong>) </em><br>";
										
									} ?>
                                        </td>
                                    </tr> 
							</table>
 
                            </p>
                            <? } else { //jika sudah di disposisi ?> 
                            	<table id="tabel">
                                    <tr>
                                        <th>Pemegang Fungsi!</th>
                                    </tr>
                                    <? foreach($fungsi as $key) { ?>
                                    <tr>
                                        <td id="td" ><input type="checkbox" name="fungsi_kd[]" value="<?=$key['fungsi_kd'];?>" /> <?=$key['nama_fungsi'];?> </td>
                                    </tr>
                                    <? } ?>
								</table>
                            	<table id="tabel2">
                                    <tr>
                                        <th>Isi Instruksi</th>
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
                                <table>
                                    <tr>
                                        <td id="td"> 
                                            Catatan : 
                                            <textarea name="catatan" style="height:250px; margin:0px 0px 0px 0px; width:83%;"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td id="td" style="padding-top:17px;padding-bottom:17px;" >
                                            Kirim Notifikasi ke email ? <input type="radio" name="notif" value="Yes" checked> Ya <input type="radio" name="notif" value="T"> Tidak <input type="submit" name="DISPOSISI" value="Disposisikan" class="red" style="float:right;" />
                                        </td>
                                    </tr>
                                </table>                      
                            </form>
                            </p>
 							<? } ?>