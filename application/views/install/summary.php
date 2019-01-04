<script type="text/javascript">
$(document).ready(function(){
		$('#login').click(function(){
			$.post('<?php echo base_url(); ?>index.php/install/install/finish/', function(data) {
				alert ('Setting berhasil diselesaikan, menuju halaman login!');
				window.location.replace("<?php echo base_url();?>index.php");
			});
		});
});			

</script>	
                          <h2>Kesimpulan : </br>Instalasi & Setting Aplikasi E-Disposisi <?php echo $setting[0]['nama_perwakilan']; ?></h2>
                          <h6 align="center">Instalasi dan setting aplikasi E-disposisi untuk Perwakilan RI (<?php echo $setting[0]['nama_perwakilan']; ?>) telah selesai.</br>
                          Untuk merubah setting aplikasi dapat dilakukan menggunakan akun Petugas Komunikasi Perwakilan.                          
                          <br>
                          Setelah ini anda dapat login ke halaman depan aplikasi E-disposisi menggunakan alamat <?php echo base_url()?> </h6>
                          
                           
                           <div style="width:100%; text-align:center;">
                           	<form>
                           		<input type="button" value="< Kembali" id="back" class="red" >
                           		<input type="button" value="Selesai & Login" id="login" class="green" >
                           	</form>
                           </div>
 </ul>
                          
							
 