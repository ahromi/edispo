<? 
$cari=$this->uri->segment(4);
$notif=$this->session->flashdata('notifikasi');
$notif2=$this->session->flashdata('notifikasi2');
$user_nama=$this->session->flashdata('user_nama');
$user_namalengkap=$this->session->flashdata('user_namalengkap');
$username=$this->session->userdata('SESSION_USERNAME');	
$level_id=$this->session->userdata('SESSION_FUNGSI_KD');	
if (!empty($username)) {
$this->load->view('tmpl/header');
	if ($this->session->userdata('SESSION_FUNGSI_KD')==2 || $this->session->userdata('SESSION_FUNGSI_KD')==1 ){ $title="";
	} else { $title=" Yang Terdisposisi Kepada Anda"; } 
	
	if ($this->uri->segment(3)=='inputed'){
		$title = "<i>Yang Anda Inputkan</i>";	
		
	}
	?>
    
    
					<div id="content">
                        <div id="main-content">
                            <h2>Arsip Berita<?=$title;?></h2>
                            <center><b><?=$notif2;?></b></center>
                            <table>
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode Arsip</th>
                                        <th>No. Berita</th>
                                        <th>Perihal Berita</th>
                                        <th>Tgl Berita</th>
                                        <th>Instansi Pengirim</th>
                                        <th>Disposisi</th>
                                        <? if ($level_id=='2'){ ?>
                                        <th>Perubahan</th>
                                        <th>Print</th>
                                        <? } elseif($this->uri->segment(3)=='inputed') { ?>
                                        <th>Perubahan</th>
										<? } elseif ($level_id=='1') { //do nothing ?>  
                                        <? } else { ?>
                                        <th>Penerimaan</th>
                                        <? } ?>
                                     </tr>
                                </thead>
                                <tbody>
                                <?	$i=0;
								if (empty($berita)){ ?>
									<tr id="row"><td colspan="9" align="center">Belum ada berita.</td></tr>
								<? } else {
									foreach ($berita as $key=>$val) { $i++; ?>
                                    <tr id="row">
                                        <td width="3%"><?=$opset+$key+1;?></td>
                                        <td width="12%"><a href="javascript: void(0)"><?=$val['arsip_kd'];?></a></td>
                                        <td width="15%"><a href="javascript: void(0)" class="agreen"><?=$val['berita_kd'];?></a></td>
                                        <td><p align="left"><?=$val['perihal_berita'];?></p></td>
                                        <td width="7%"><?=$val['tgl_berita'];?></td>
                                        <td width="15%"><?=$val['perwakilan_nama'];?></td>
                                         <td width="10%">
										 <? 
										 if ($val['berita_disposisikan']=='Y') {
										 	if($val['status_disposisi']=='Y') { ?> <img src="<?=base_url();?>resources/images/sudah.png" width="70" height="25" /> <? } else { ?> <img src="<?=base_url();?>resources/images/menunggu.png" width="70" height="25" /> <?  } 
										 } else { ?> 
                                             <img src="<?=base_url();?>resources/images/tidak.png" width="70" height="25" />
										 <? } ?>
                                             </td>
										<?php if ($this->uri->segment(3)=='inputed'){ ?>
										 	<td width="50"><a href="<?=base_url();?>index.php/berita/edit_berita/id/<?=$val['arsip_kd'];?>" class="tiptip-top" title="Edit Berita"><img src="<?=base_url();?>resources/images/icon_edit.png" alt="edit" /></a></td>
 										<? 
										 }  else  {  if ($val['detail_terima']=='Y') {
											  ?> <td> <img src="<?=base_url();?>resources/images/sudah.png" width="70" height="25" /> <? 
											  } else { ?> <td>  <img src="<?=base_url();?>resources/images/menunggu.png" width="70" height="25" /> <? } 
										}?></td>
 				  <? } ?>
          <? } ?>
                                 </tbody>
                            </table>
                            <?php echo $this->pagination->create_links(); ?>
                            
                        </div>
					</div>
  <? $this->load->view('tmpl/footer'); ?>
  <? 
  } else
  {
  redirect ('');
  }
  ?>