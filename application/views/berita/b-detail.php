<? 
$cari=$this->uri->segment(4);
$note=$this->session->flashdata('notice');
$user_nama=$this->session->flashdata('user_nama');
$user_namalengkap=$this->session->flashdata('user_namalengkap');
$username=$this->session->userdata('SESSION_USERNAME');	
$level_id=$this->session->userdata('SESSION_FUNGSI_KD');	
$user_menerima_disposisi=$this->session->userdata('SESSION_MENERIMA_DISPOSISI');
$disposisi_fungsi=$this->session->userdata('SESSION_DISPOSISI_FUNGSI');	
if (!empty($username)) {
$this->load->view('tmpl/header');
?>
    <script type="text/javascript">
	<? if(!empty($note)){ ?>
      window.onload = function (){
				alert('<?=$note;?>');  
      };
	 		<? } ?>
     </script>
    
    					<div id="content">
                        <div id="main-content">
                            <h1>ARSIP BERITA <?=$berita[0]['berita_kd'];?></h1>
								<?php echo form_open_multipart('berita/detail/id/'.$this->uri->segment(4));?> 
                          <fieldset>
                            <div id="box-right">
                            <h2>Isi Berita </h2>
                                    <!-- modal content -->
                                    <div id="basic-modal-content">
                                        <h3>Isi Dokumen</h3>
                                     </div>
 								 
 								 <center><a href="#" onclick="window.open ('<?=base_url();?>index.php/berita/berita/show/<? echo $berita[0]['berita_file']; ?>','mywindow','resizable=1,fullscreen=1,location=0');">  
                            
                            <img alt="" src="<?=base_url();?>resources/images/Document-Preview-icon.png">
                            </br>[KILIK DISINI] </a></center>
                            <p></p>
                            <!-- jika dia adalah pemegang disposisi -->
                            <?php  //if($berita[0]['berita_disposisikan']=='Y' && (($berita[0]['berita_fungsi_disposisi']==$level_id && $user_menerima_disposisi=='Y' ) || $berita[0]['berita_fungsi_disposisi']=='1' || $berita[0]['berita_fungsi_disposisi']=='2'  )) {
								?>
                            <?php if ($berita[0]['berita_disposisikan']=='Y' && (($user_menerima_disposisi=='Y') || $berita[0]['berita_fungsi_disposisi']=='1' || $berita[0]['berita_fungsi_disposisi']=='2'  )) {
								?>
              <?php if (($berita[0]['berita_disposisikan']=='Y' && $berita[0]['berita_fungsi_disposisi']==$level_id && $user_menerima_disposisi=='Y') ||
($level_id=='1' || $level_id=='2')) { ?>                    
			  <?php if (($berita[0]['berita_fungsi_disposisi']==$level_id || $level_id=='2') && $disposisi_fungsi=='Y' && $berita[0]['status_disposisi']=='T') { ?> 
         <h2 style="margin-bottom:-1px;">Lakukan aksi ?</h2>
 		<center>
        <br />
 
        	<input type="radio" name="aksi" id="aksiDispo" checked="checked" value="dispo" /><strong>Disposisi</strong>
            <input type="radio" name="aksi" value="alihkan" /><strong>Alihkan Disposisi</strong>
<br />
<i>Dengan mengalihkan disposisi, <br /> maka dokumen akan ditujukan bagi pendisposisi terpilih!</i>
<br />
        </center>
        <? } ?>
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
 <? } ?>    
<div id="disposisi_panel"> 
						<?  if (($berita[0]['berita_fungsi_disposisi']==$level_id || $level_id=='2') && $disposisi_fungsi=='Y') { 
                                    $this->load->view('berita/fungsi_disposisi');	
                            }
                            else
                            { 
                                if ($berita[0]['status_disposisi']=='Y') {
									if (!empty($detail_terima[0]['detail_fungsi_kd'])) {
										if($detail_terima[0]['detail_fungsi_kd']!=$level_id) {
											echo "<h2>Status Disposisi</h2>
													<center>Berita tidak didisposisikan kepada Anda!</center>";
										 } else {
											$this->load->view('berita/fungsi_terima');
		
										 }
									} else {
											$this->load->view('berita/fungsi_terima');
										
									}
								}
                             } ?>
</div>
                            <br />

<!--                                <div id="mydiv"></div>-->                            
                            <? } else { ?> 
								<h3>Dokumen Ini Belum Didisposisi!</h3>
							<? } ?>
</div>

<div id="box-left">
<h2>Berkas Asli Disposisi Keppri</h2>
       <ul class="align-list">   
        <li>
        <label for="addarticle-title">Berkas Disposisi Asli</label>
        <input type="file" name="berkas_disposisi" id="file1" class="box-medium" /> 
    	</li> 
   		<li>
		   	<label></label>
   			<input type="button" value="Upload" id="upload" name="upload" class="green" >
        </li>
    </ul>
 <div id="lihat_berkas">
 <?php if (!empty($berita[0]['berita_berkas_disposisi'])){ ?> 
 <center>
 <a href="#" onclick="window.open ('<?=base_url();?>index.php/berita/berita/show/<? echo $berita[0]['berita_berkas_disposisi']; ?>','mywindow','resizable=1,fullscreen=1,location=0');">LIHAT BERKAS</a>
 </center>	
 <?php	 } ?>
  </div>
<h2>Detail Arsip Dokumen</h2>
                                    <ul class="align-list">
                                        <li>
                                            <label for="addarticle-title">No Arsip</label>
                                            <input type="text" value="<?=$berita[0]['arsip_kd'];?>" readonly="readonly" id="addarticle-title" name="arsip_kd" class="box-medium" /> 
                                        </li>
                                        <li>
                                            <label for="addarticle-title">No Dokumen</label>
                                            <input type="text" readonly="readonly" value="<?=$berita[0]['berita_kd'];?>" id="addarticle-title" name="berita_kd" class="box-medium" />
                                        </li>
                                        <li>
                                            <label for="addarticle-category">Jenis Dokumen</label>
                                             <input type="text" readonly="readonly" value="<?=$berita[0]['jenis_nama'];?>" id="addarticle-title" name="berita_kd" class="box-medium" />
                                        </li>
                                        <li>
                                            <label for="addarticle-category">Sifat Dokumen</label>
                                            <input type="text" readonly="readonly" value="<?=$berita[0]['sifat_nama'];?>" id="addarticle-title" name="berita_kd" class="box-medium" />
                                        </li>
                                        <li>
                                            <label for="addarticle-category">Instansi Pengirim</label>
                                            <input type="text" readonly="readonly" value="<?=$berita[0]['perwakilan_nama'];?>" id="addarticle-title" name="berita_kd" class="box-medium" />
                                        </li>
                                        <li>
                                            <label for="addarticle-category">Derajat Dokumen</label>
                                            <input type="text" readonly="readonly" value="<?=$berita[0]['derajat_nama'];?>" id="addarticle-title" name="berita_kd" class="box-medium" />
                                        </li>
                                        <li>
                                            <label for="addarticle-title">Tanggal Dokumen</label>
                                            <input type="text" readonly="readonly" value="<?=$berita[0]['tgl_berita'];?>" id="addarticle-title" name="berita_kd" class="box-medium" />
                                        </li>

                                        <li>
                                            <label for="addarticle-content">Perihal</label>
                                            <textarea readonly="readonly" cols="15" rows="3" name="perihal_berita"><?=$berita[0]['perihal_berita'];?></textarea>
                                        </li>
                                        <li>
                                            <label for="addarticle-content">Keterangan</label>
                                            <textarea readonly="readonly" cols="15" rows="5" name="keterangan"><?=$berita[0]['keterangan'];?></textarea>
                                        </li>
                                        <li>
                                            <label></label>
                                                    <input type="button" value="Kembali" onClick="history.back(1);" class="green" >
<br />

                                         </li>
                                        <li>
                                   </ul>
                                </fieldset>
                            </form>
	                        </div>
                        </div>
					
  <?php $this->load->view('tmpl/footer'); ?>
  <?php 
  } 
  else
  {
  redirect ('');
  }
  ?>