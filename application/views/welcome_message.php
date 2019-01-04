<?php
$username=$this->session->userdata('SESSION_USERNAME');	
if (!empty($username)) {
$this->load->view('tmpl/header');
?>
<script language="javascript">

</script>
					<div id="content">
                       <div id="main-content">
                            <h2>Aplikasi E-Disposisi</h2>
                            <div class="simple-con tleft" style="font-size:12px; padding-left:20px; padding-right:20px;">
                            <p><strong>Selamat Datang, <?php $this->session->userdata('SESSION_NAMALENGKAP');?></strong></p>
                            Anda berada Di halaman depan aplikasi E-disposisi. Saat ini user level anda adalah <strong><?php $this->session->userdata('SESSION_FUNGSI');?></strong>.
                            <p align="justify">Aplikasi E-disposisi <?php $this->session->userdata('nama_singkat_perwakilan');?> merupakan sebuah perangkat lunak berbasis web untuk melakukan <strong>pendistribusian disposisi</strong> secara elektronis dari pemberi disposisi (Kepala Perwakilan) kepada masing-masing fungsi di <?php echo $this->session->userdata('nama_singkat_perwakilan');?>. Aplikasi ini diharapkan dapat <strong>mempermudah proses disposisi dan penyampaian nya kepada penerima disposisi</strong>. Selain itu karena sifatnya elektronis, Aplikasi ini juga diharapkan dapat <strong>mengefisiensikan penggunaan kertas dan keefektifan pekerjaan</strong>.</p>
                            <p>
                            Adapun beberapa hak akses yang anda dapatkan pada aplikasi e-disposisi ini diantaranya :
                            <ol>
                            	<?php if ($this->session->userdata('SESSION_FUNGSI_KD')==2){ ?>
                                        <li>Menambah Berita</li>
                                        <li>Melakukan Pengelolaan Berita</li>
                                        <li>Melakukan Pencarian Berita</li>
                                        <li>Melakukan Disposisi Berita</li>
                                        <li>Melakukan Penerimaan Disposisi Berita</li>
                                        <li>Melakukan Pengelolaan Pengguna</li>
                                <?php } elseif ($this->session->userdata('SESSION_FUNGSI_KD')==1) { ?>
                                        <li>Melihat Seluruh Berita </li>
                                        <li>Melihat Detail Berita </li>
                                        <li>Melakukan Pencarian Berita</li>
                                        <li>Melakukan Disposisi Berita</li>
                                 <?php } else { ?> 
                                        <li>Melihat Berita yang terdisposisi untuk Anda</li>
                                        <li>Melihat Detail Berita yang terdisposisi untuk Anda</li>
                                        <li>Melakukan Pencarian Berita</li>
                                        <li>Melakukan Penerimaan Disposisi Berita</li>
                                 <?php } ?>
                            </ol>
                            </p>
                            <p>Demikian, agar aplikasi ini dapat bermanfaat bagi penggunanya.<br />
							   Selamat Bekerja,<br />
                               tks et salam.</p>
                            </div>
  
                      </div>
					</div>
  <?php $this->load->view('tmpl/footer'); ?>
  <?php 
  } else
  {
  redirect ('');
  }
  ?>