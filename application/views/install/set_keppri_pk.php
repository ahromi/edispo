<script type="text/javascript">
$(document).ready(function(){
 	$('#nama_jabatan_kepala_perwakilan').focus();	
 
	$('#submit').click(function(){
		$('#inner-content').load('<?php echo base_url(); ?>index.php/install/install/set_keppri/');
		return false;
	});	
	
	$('#back').click(function(){
		$('#inner-content').load('<?php echo base_url(); ?>index.php/install/install/profil_kbri/');
		return false;
	});
	
});

function tambah_fungsi(val){
	if ($('#fungsi_nama').val() != ''){
		$.post('<?php echo base_url(); ?>index.php/install/install/addFungsi/',
				{ fungsi_nama : val },
				function(data){
					if (data=='false'){
						alert('Data yang anda masukkan sudah ada!');
						$('#fungsi_nama').val('');
						$('#fungsi_nama').focus();
						exit;	
					}
				})
				.success( function(){
					$('#daftar_fungsi').load('<?php echo base_url(); ?>index.php/install/install/refreshFungsi/');
					$('#fungsi_nama').val('');
					alert('Data berhasil ditambah!');
				})
				.error( function(){
					alert('Data gagal dihapus!');
			});
	} else { alert ('isian kosong!'); $('#fungsi_nama').focus();  }
}

function delFungsi(id){
	$.post('<?php echo base_url(); ?>index.php/install/install/delFungsi/',
			{ kd : id })
			.success( function(){
				$('#daftar_fungsi').load('<?php echo base_url(); ?>index.php/install/install/refreshFungsi/');
				alert('Data berhasil dihapus!');
			})
			.error( function(){
				alert('Data gagal dihapus!');
			});
}
</script>	
 
                        <h2>Langkah 2 dari 5 : <br>Setting Data Jabatan pada Perwakilan</h2>
							<form method="post" id="frm_keppri_pk" novalidate="novalidate"> 
                                <fieldset>
                                    <ul class="align-list">
                                           <li>
                                            <label for="addarticle-title">Setting Jabatan yang ada <br><i>misal: Fungsi Politik, Ekonomi, dll. (selain KEPPRI dan PK)*</i></label>
                                            
                                            <div id="daftar_fungsi" >
                                            <table cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                            <?php 
                                           $i=0; $k=0;
                                            foreach($fungsi as $val){ $i++; $k++;
                                            	echo "<td id='id".$val['fungsi_kd']."' style='padding:3px; border:0px; text-align:left; '>&raquo; ".$val['nama_fungsi']."</td>";
                                            	echo "<td style='padding-left:-13px; border:0px; text-align:left; '><a onClick='delFungsi(".$val['fungsi_kd'].")' style='cursor:pointer;'><img src='".base_url()."resources/images/icon_bad.png'></a></td>";                                       
                                            	if($i % 3==0){ $i=0;
                                            		echo "</tr><tr>";
                                            	}
                                            }
                                            ?>
                                            </tr>
                                            </table>
                                            </div>
                                            <input style="margin:auto;" class="box-small" type="text" id="fungsi_nama" name="fungsi_nama">
                                            <input type="button" style="cursor:pointer;" value="tambah"  onClick="tambah_fungsi(this.form.fungsi_nama.value)">
                                       <li>
                                            <label></label>
                                            <input type="submit" id="back" value="< Mundur" class="red" />
                                            <input type="submit" name="submit" value="Lanjut >" id="submit" class="green" />
                                        </li>
                                        <li>
                                   </ul>
                                </fieldset>
                            </form>
 