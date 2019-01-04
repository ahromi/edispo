<script type="text/javascript">
$(document).ready(function(){
		$("#frm_pwk").validate({
			submitHandler:function(form) {
			SubmitForm();
		}
		});

});			

SubmitForm = function(){
	 $.post( '<?php echo base_url(); ?>index.php/install/install/submit/',
		$('#frm_pwk').serialize(),
		function(data){
			//alert(data);
				$('#inner-content').load("<?php echo base_url();?>index.php/install/install/set_keppri_pk/");
	});
	return false;
}
</script>	
                          <h2>Langkah 1 dari 5 : <br>Instalasi & Setting Aplikasi E-Disposisi Perwakilan RI</h2>
							<form method="post" id="frm_pwk" novalidate="novalidate"> 
                                <fieldset>
                                    <ul class="align-list">
                                        <li>
                                            <label for="addarticle-title">Nama Perwakilan *</label>
                                            <input type="text"  id="nama_perwakilan" value="<?php echo $setting[0]['nama_perwakilan'];?>" name="nama_perwakilan" class="required" minlength="10" />
                                        </li>
                                        <li>
                                            <label for="addarticle-title">Singkatan Nama Perwakilan *</label>
                                            <input type="text" id="nama_singkat_perwakilan"  value="<?php echo $setting[0]['nama_singkat_perwakilan'];?>" name="nama_singkat_perwakilan" class="required" minlength="10" />
                                        </li>
	                                        <li>
                                            <label for="addarticle-title">Nama Jabatan Kepala Perwakilan *</label>
                                            <input type="text" value="<?php echo $setting[0]['nama_jabatan_kepala_perwakilan'];?>" id="nama_jabatan_kepala_perwakilan" name="nama_jabatan_kepala_perwakilan" class="required" minlength="10"/>
                                        </li>
                                        <li>
                                            <label for="addarticle-title">Alamat Perwakilan *</label>
                                            <textarea id="alamat_perwakilan" name="alamat_perwakilan" class="required" minlength="10"><?php echo $setting[0]['alamat_perwakilan'];?></textarea>
                                        </li>
                                        <li>
                                            <label for="addarticle-title">Email Administrator * <br>(wajib email Kemlu)</label>
                                            <input type="text" id="email_administrator" name="email_administrator"  class="required email"  value="<?php echo $setting[0]['email_administrator'];?>"  />
                                        </li>
                                       <li>
                                            <label for="addarticle-title">Password Email Administrator *</label>
                                            <input type="password" id="email_administrator_password" name="email_administrator_password"  class="required"  value="<?php echo $setting[0]['email_administrator_password'];?>"  />
                                        </li>
                                        <li>
                                            <label for="addarticle-title" >Warna Latar *</label>
                                            <input type="radio" value="blue" id="warna_latar" <?php if ($setting[0]['warna_latar']=='blue') { echo "checked='checked'"; } ?> name="warna_latar" > blue
                                            <input type="radio" value="green" id="warna_latar" name="warna_latar" <?php if ($setting[0]['warna_latar']=='green') { echo "checked='checked'"; } ?> > green
                                            <input type="radio" value="brown" id="warna_latar" name="warna_latar" <?php if ($setting[0]['warna_latar']=='brown') { echo "checked='checked'"; } ?>  > brown
                                            <input type="radio" value="purple" id="warna_latar" <?php if ($setting[0]['warna_latar']=='purple') { echo "checked='checked'"; } ?> name="warna_latar" > pink
                                            <input type="radio" value="grey" id="warna_latar" name="warna_latar" <?php if ($setting[0]['warna_latar']=='grey') { echo "checked='checked'"; } ?> > grey
                                         </li>
                                       <li>
                                            <label></label>
                                            <input type="submit" name="submit" value="Lanjut > " id="submit" class="green" />
                                         
                                        </li>
                                        <li>
                                   </ul>
                                </fieldset>
                            </form>
 