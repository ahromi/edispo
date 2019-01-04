<script type="text/javascript">
$(document).ready(function(){
		$("#frm_keppri").validate({
			submitHandler:function(form) {
			SubmitForm();
		}
		});

		$('#back').click(function(){
			$('#inner-content').load('<?php echo base_url(); ?>index.php/install/install/set_keppri_pk/');
			return false;
		});

		
});			


SubmitForm = function(){
	 $.post( '<?php echo base_url(); ?>index.php/install/install/set_keppri_submit/',
		$('#frm_keppri').serialize(),
		function(data){
				$('#inner-content').load("<?php echo base_url();?>index.php/install/install/set_pk/");
	});
	return false;
}
</script>	
                          <h2>Langkah 3 dari 5 : <br>Setting Akun Kepala Perwakilan</h2>
							<form method="post" id="frm_keppri" novalidate="novalidate"> 
                                <fieldset>
                                    <ul class="align-list">
										<li>
                                            <label for="addarticle-title">Nama Lengkap *</label>
                                            <input type="text" value="<?php echo $keppri[0]['user_namalengkap']; ?>" id="user_namalengkap" name="user_namalengkap" class="required" minlength="6" />
                                        </li>										
										<li>
                                            <label for="addarticle-title">Username *</label>
                                            <input type="text" value="<?php echo $keppri[0]['user_nama']; ?>" id="user_nama" name="user_nama" class="required" minlength="6" />
                                        </li>										
										<li>
                                            <label for="addarticle-title">Password *</label>
                                            <input type="password" value="" id="user_password" name="user_password" class="required" minlength="6" />
                                        </li>										
										<li>
                                            <label for="addarticle-title">Fungsi/Jabatan *</label>
                                            <select name="fungsi_kd" class="required" >
                                            		<option value="1" selected="selected">Kepala Perwakilan</option>
                                            </select>
                                        </li>
											</div>										
                                       <li>
                                            <label></label>
                                            <input type="submit" id="back" value="< Mundur" class="red" />
                                            <input type="submit" name="submit" value="Lanjut >" id="tambah" class="green" />
                                        </li>
                                        <li>
                                   </ul>
                                </fieldset>
                            </form>
 