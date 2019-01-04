<?php 
$cari=$this->uri->segment(4);
$notif=$this->session->flashdata('notifikasi');
$notif2=$this->session->flashdata('notifikasi2');
$instruksi_nama=$this->session->flashdata('instruksi_nama');
$instruksi_kd=$this->session->flashdata('instruksi_kd');
$username=$this->session->userdata('SESSION_USERNAME');	
if (!empty($username)) {
$this->load->view('tmpl/header');
?>					<div id="content">
                        <div id="main-content">
                            
                            <h2>Detail Instruksi</h2>
                            
								<?php echo form_open_multipart('instruksi/detail/id/'.$this->uri->segment(4));?> 
                          <fieldset>
                                <div><?=$notif;?></div>
                                    <ul class="align-list">
                                        <li>
                                            <label for="addarticle-title">Instruksi</label>
                                            <input type="text" value="<?=$instruksi[0]['instruksi_nama'];?>" id="addarticle-title" name="instruksi_nama" class="box-medium" />
                                        </li>
                                        <li>
                                            <label></label>
                                            <input type="submit" name="EDIT" value="Submit" class="green" /><br />

                                           <a href="<?=base_url();?>index.php/instruksi/instruksi" onclick="history.back(1)">Kembali</a>
                                        </li>
                                        <li>
                                   </ul>
                                </fieldset>
                            </form>
                        </div>
					</div>
  <?php $this->load->view('tmpl/footer'); ?>
  <?php 
  } else
  {
  redirect ('');
  }
  ?>