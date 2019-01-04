<?php 
$nama_perwakilan = $this->session->userdata('nama_perwakilan');
$nama_singkat_perwakilan = $this->session->userdata('nama_singkat_perwakilan');
$ver_name = $this->session->userdata('ver_name');
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Comments removed from the demo! -->
        <!-- Code is compressed and code style is altered! -->
        <title>XE-Disposisi - <?php echo $nama_perwakilan; ?> - Login</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="author" content="pixelcave" />
        <meta name="description" content="TurboAdmin is a clean, professional and full of features admin template! Created by pixelcave" />
        <meta name="keywords" content="turboadmin, admin, template, theme, panel, clean, professional, widgets, jquery, plugins" />
    	<link rel="shortcut icon" href="<?=base_url();?>resources/images/internet.ico" />
        <link type="text/css" rel="stylesheet" href="<?=base_url();?>resources/css/style-<?php echo $this->session->userdata('warna_latar'); ?>.css"  />
        <link type="text/css" rel="stylesheet" href="<?=base_url();?>resources/css/jquery.uniform.css" />
    </head>
    <body>
        <div id="login-container-outer" class="radius">
            <div id="login-container" class="radius">
                <div id="login-header" class="radius-top">
                    <a href="login.php.htm" >
                        <img src="<?=base_url();?>resources/images/login_logo.png"  />
                    </a>                    
                </div>
                <div id="login-content">
                <ul><? echo $notifikasi1; ?><? echo $notifikasi2;?><? echo $notifikasi3;?> </ul>
                    <form method="post" id="wl-form" name="wl-form">
                        <label for="wl-username">Nama Pengguna </label>
                        <input type="text" id="wl-username" name="username" value="<?=$username;?>" />
                        <label for="wl-password">Kata Sandi</label>
                        <input type="password" id="wl-password" name="password" value="" />
                        <label for="wl-remember"> </label>
                        <input type="checkbox" id="wl-remember" name="wl-remember" />
                        <input type="submit" value="Enter" id="wl-btn" name="SUBMIT" class="fright" />
                    </form>
                    <form action="javascript: void(0)" method="post" id="wr-form" name="wr-form" class="dis-none">
                        <p>Aplikasi E-disposisi <?php echo $nama_singkat_perwakilan; ?> merupakan sebuah perangkat lunak berbasis web untuk melakukan <strong>pendistribusian disposisi</strong> secara elektronis dari pemberi disposisi (Kepala Perwakilan) kepada masing-masing fungsi di <?php echo $nama_singkat_perwakilan; ?>.</p>
                        <p><strong><em>Pertanyaan dan saran kontak Ka.Unitkom Perwakilan.</em></strong></p>
                       
                    </form>
                </div>
                <div id="login-extra" class="radius-bottom">
                    <a id="a-reminder" href="javascript: void(0)" class="afooter-link">E-Disposisi <?php echo  $nama_singkat_perwakilan; ?> Ver. <?php echo $ver_name; ?> - <?php echo $nama_perwakilan; ?></a>
                    <a id="a-login" href="javascript: void(0)" class="afooter-link dis-none">Dibuat oleh Pusat Komunikasi - Kemlu RI</a>
                </div>
            </div>
        </div>
        <script src="<?=base_url();?>resources/js/jquery.min.js" ></script>
        <script src="<?=base_url();?>resources/js/jquery.uniform.js" ></script>
		<script>
            $(function(){
            $("select").uniform();
            $("input:checkbox").uniform();
            $("input:radio").uniform();
            $("input:file").uniform();
            $('#a-reminder').click(function(){
            $('#wl-form').slideUp( 300, function(){
            $('#wr-form').slideDown( 300, function(){
            $('#a-reminder').hide( 1, function(){
            $('#a-login').show();
            $('#wr-email').focus();
            });
            });
            });
            });
            $('#a-login').click(function(){
            $('#wr-form').slideUp( 300, function(){
            $('#wl-form').slideDown( 300, function(){
            $('#a-login').hide( 1, function(){
            $('#a-reminder').show();
            });
            });
            });
            });

            });
        </script>
     </body>
</html>