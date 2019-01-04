<? 
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
                            <p align="justify">Halaman Ini Masih dalam Pengembangan.</p>
                            
                            </div>
  
                      </div>
					</div>
  <? $this->load->view('tmpl/footer'); ?>
  <? 
  } else
  {
  redirect ('');
  }
  ?>