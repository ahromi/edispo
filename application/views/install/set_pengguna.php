<script type="text/javascript">
$(document).ready(function(){
	
    $.fn.clearForm = function() {
        return this.each(function() {
          var type = this.type, tag = this.tagName.toLowerCase();
          if (tag == 'form')
            return $(':input',this).clearForm();
          if (type == 'text' || type == 'password' || tag == 'textarea')
            this.value = '';
          else if (type == 'checkbox' || type == 'radio')
            this.checked = false;
          else if (tag == 'select')
            this.selectedIndex = -1;
        });
      };

  	
	$("#form_pengguna").validate({
				submitHandler:function(form) {
				tambah_pengguna();
			}
	});		

	$('#submit').click(function(){
		$('#inner-content').load("<?php echo base_url();?>index.php/install/install/summary/");
		return false;
		//alert('asdasd');
	});
		
	$('#back').click(function(){
		$('#inner-content').load("<?php echo base_url();?>index.php/install/install/set_pk/");
		return false;

	});
	
});

function tambah_pengguna(){
		$.post('<?php echo base_url(); ?>index.php/install/install/addPengguna/',
				$('#form_pengguna').serialize(),
				function(data){
					if (data=='redundant_true'){
						alert('Data yang anda masukkan sudah ada!');
						$('#user_namalengkap').val('');
						$('#user_namalengkap').focus();
						return false;
					}else if (data=='redundant_koord'){
						alert('Koordinator fungsi sudah ada!');
						$('#user_namalengkap').val('');
						$('#user_namalengkap').focus();						
						return false;
					}else{
						alert('Data berhasil ditambah!');	
					}
				})
				.success( function(){				
					$('#dataGrid').load("<?php echo base_url();?>index.php/install/install/userGrid/");
					$('#form_pengguna').clearForm();					
					return false;
				})
				.error( function(){
					alert('Data gagal ditambah!');
					return false;
			});
}

function delPengguna(id){
	$.post('<?php echo base_url(); ?>index.php/install/install/delUser/',
			{ kd : id })
			.success( function(){
				$('#dataGrid').load('<?php echo base_url(); ?>index.php/install/install/userGrid/');
				alert('Data berhasil dihapus!');
			})
			.error( function(){
				alert('Data gagal dihapus!');
			});
}

</script>	
                         <h2>Langkah 5 dari 5 : <br>Setting Pengguna Aplikasi</h2>
							<form method="post" id="form_pengguna" novalidate="novalidate"> 
                                <fieldset>
                                    <ul class="align-list">
                                    <h3><b>Daftar Pengguna Aplikasi</b></h3>
										<div id="dataGrid">
										<table width="100%" cellpadding=0px >
											<tr>
												<th>No.<th style="text-align:left;">Username</th><th style="text-align:left;">Nama Lengkap</th><th style="text-align:left;">Jabatan</th><th style="text-align:left;">Koord. Fungsi</th><th>Opsi</th>
											</tr>
											<?php $i=0; foreach($pengguna as $val) { $i++ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td style="text-align:left;"><?php echo $val['user_nama']; ?></td>
												<td style="text-align:left;"><?php echo $val['user_namalengkap']; ?></td>
												<td style="text-align:left;"><?php echo $val['nama_fungsi']; ?></td>
												<td style="text-align:left;"><?php echo $val['koordinator_fungsi']; ?></td>
												<td ><a style="cursor:pointer;" onClick="delPengguna(<?php echo $val['user_kd']; ?>);"><img src="<?php echo base_url(); ?>resources/images/icon_bad.png"></a></td>
											</tr>
											<?php } ?>
										</table>
										</div>
											<h3><b>Formulir Pengguna Aplikasi</b></h3>
											<div id="form_pengguna">
										<li>
                                            <label for="addarticle-title">Nama Lengkap *</label>
                                            <input type="text" value="" id="user_namalengkap" name="user_namalengkap" class="required" minlength="6" />
                                        </li>										
										<li>
                                            <label for="addarticle-title">Username *</label>
                                            <input type="text" value="" id="user_nama" name="user_nama" class="required" minlength="6" />
                                        </li>										
										<li>
                                            <label for="addarticle-title">Password *</label>
                                            <input type="password" value="" id="user_password" name="user_password" class="required" minlength="6" />
                                        </li>										
										<li>
                                            <label for="addarticle-title">Fungsi/Jabatan *</label>
                                            <select name="fungsi_kd" class="required" >
                                            	<option value="" selected>--Pilih--</option>
                                            	<?php foreach($fungsi as $val) { ?>
                                            		<option value="<?php echo $val['fungsi_kd']; ?>"><?php echo $val['nama_fungsi']; ?></option>
                                            <?php } ?>
                                            </select>
                                        </li>
										<li>
                                            <label for="addarticle-title">Koord. Fungsi ??</label>
                                            <input type="radio" name="koord" value="Y" checked="checked" />YA
                                            <input type="radio" name="koord" value="T" />TIDAK 
											<div style=" padding:2px; text-align:center; background-color:#FFE1C4; margin-left:10px;border:1px  solid #F90;">(<strong>SET TIDAK </strong>: Jika Ybs dapat menerima dispo dari koordinator fungsi <br /> 
                               <strong>SET YA </strong>: Jika Ybs dapat mendispo ke pelaksana fungsi dibawahnya atau merupakan fungsi mandiri/ATASE)</div>
                                        </li>
                                       <li>
 										<li>
                                            <label for="addarticle-title">Email *</label>
                                            <input type="text" value="" id="user_email" name="user_email" class="required email" minlength="6" />
                                        </li>										
 										<li>
                                            <label for="addarticle-title">Aktifkan Notifikasi Email? </label>
                                            <input type="radio" name="user_notifikasi_email" id="user_notifikasi_email" value="1" checked> YA.
                                            <input type="radio" name="user_notifikasi_email" id="user_notifikasi_email" value="0"> TIDAK.
                                        </li>										
                                       <li>
                                       <label for="addarticle-title">  </label>
                                       		<input type="submit" id="tambah" value="Tambah" />
                                       </li> 
                                            <li>&nbsp;</li>
                                            <label></label>
                                            <input type="button" id="back" value="< Mundur" class="red" />
                                            <input type="button" name="submit" value="Lanjut >" id="submit" class="green" />
                                        </li>
                                        <li>
                                   </ul>
                                </fieldset>
                            </form>
 