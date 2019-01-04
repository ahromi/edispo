<!DOCTYPE html>
<html>
    <head>
    <title>E-Disposisi - Perwakilan Republik Indonesia</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="keywords" content="turboadmin, admin, template, theme, panel, clean, professional, widgets, jquery, plugins" />
    <link rel="shortcut icon" href="<?=base_url();?>resources/images/internet.ico" />
	<script src="<?=base_url();?>resources/js/jquery-1.7.1.min.js" ></script>
	<script src="<?=base_url();?>resources/js/jquery.validate.js" ></script>
    <link type="text/css" rel="stylesheet" href="<?=base_url();?>resources/css/style-green.css" /> 
	<script type="text/javascript">
	$(document).ready(function(){
		$('#inner-content').load("<?php echo base_url();?>index.php/install/install/profil_kbri/");
		 
		$('#step1').click(function (){
			$('#inner-content').load("<?php echo base_url();?>index.php/install/install/profil_kbri/");
		});
		$('#step2').click(function (){
			$('#inner-content').load("<?php echo base_url();?>index.php/install/install/set_keppri_pk/");
		});
		$('#step3').click(function (){
			$('#inner-content').load("<?php echo base_url();?>index.php/install/install/set_keppri/");
		});
		$('#step4').click(function (){
			$('#inner-content').load("<?php echo base_url();?>index.php/install/install/set_pk/");
		});
		$('#step5').click(function (){
			$('#inner-content').load("<?php echo base_url();?>index.php/install/install/set_pengguna/");
		});
		/*$('#step6').click(function (){
			$('#inner-content').load("<?php echo base_url();?>index.php/install/install/set_pengguna/");
		}); */
		$('#step6').click(function (){
			$('#inner-content').load("<?php echo base_url();?>index.php/install/install/summary/");
		});
	 
	});
</script>	  
</head>    
<body>
<div id="dialog" style="display:none;" title="Basic dialog">
	<p>This is the default dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the 'x' icon.</p>
</div>
		<div id="container" style="width:50%;" >
			<div id="adminbar-outer" class="radius-bottom">
    <div id="adminbar" class="radius-bottom">
        <a href="javascript: void(0)"  id="logo"></a>
     </div>
</div>			
<div id="panel-outer" class="radius">
				<div id="panel" class="radius">
                    <ul id="main-menu" class="radius-top clearfix">
                        <li>
                            <a id="step1" alt="Pengaturan Profil Perwakilan" >                            
                            	<img alt="Pengaturan Profil Perwakilan" src="<?=base_url();?>resources/images/pwk.png">
                            <span>Langkah 1</br>Profil Perwakilan</span>
                            </a>
                        </li>
                        <li>
                            <a id="step2" >
								<img alt="Daftar Fungsi" src="<?=base_url();?>resources/images/fungsi.png">
                                <span>Langkah 2</br>Daftar Fungsi</span>
                            </a>
                        </li>
                        <li>
                            <a id="step3" >
                                <img alt="Pengaturan Akun Kepri" src="<?=base_url();?>resources/images/keppri.png">
                                <span>Langkah 3</br>Akun Keppri</span>
                            </a>
                        </li>
                       <li>
                            <a id="step4" >
                                <img alt="Pengaturan Akun PK" src="<?=base_url();?>resources/images/pk.png">
                                <span>Langkah 4</br>Akun PK</span>
                            </a>
                        </li>
                       <li>
                            <a id="step5" >
                                 <img alt="Pengaturan Akun Pengguna" src="<?=base_url();?>resources/images/pengguna.png">
                                <span>Langkah 5</br>Akun Pengguna</span>
                            </a>
                        </li>
                       <li>
    <!--                       <li>
                            <a id="step6" >
                                 <img alt="Pengaturan Akun Pengguna" src="<?=base_url();?>resources/images/pengguna.png">
                                <span>Langkah 6</br>Akun Pengguna</span>
                            </a>
                        </li>
                       <li>
-->                            <a id="step6" >
                                 <img alt="Pengaturan Akun Kepri" src="<?=base_url();?>resources/images/summary.png">
                                <span>Kesimpulan</span>
                            </a>
                        </li>
</ul>
