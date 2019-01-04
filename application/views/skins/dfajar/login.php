<?php
$nama_perwakilan = $this->session->userdata('nama_perwakilan');
$nama_singkat_perwakilan = $this->session->userdata('nama_singkat_perwakilan');
$ver_name = $this->session->userdata('ver_name');
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Responsive HTML 5 e-disposisi KJRI Kuching">
        <meta name="author" content="Monkey D. Fajar">

        <title>E-Disposisi - <?php echo $nama_perwakilan; ?> - Login</title>

        <!-- Bootstrap Core CSS -->
        <link href="<?= base_url(); ?>resources/skins/dfajar/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="<?= base_url(); ?>resources/skins/dfajar/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?= base_url(); ?>resources/skins/dfajar/dist/css/sb-admin-2.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="<?= base_url(); ?>resources/skins/dfajar/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="<?= base_url(); ?>resources/skins/dfajar/ie/html5shiv.js"></script>
            <script src="<?= base_url(); ?>resources/skins/dfajar/ie/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

        <div class="container">
            <div class="row">
                <div style="margin-top: 15% !important;" class="col-md-4 col-md-offset-4">
                    <div class="login-banner text-center">
                        <img width="270px;" src="<?= base_url(); ?>resources/skins/dfajar/EDISPOSISI_LOGO_crop.png">
                    </div>
                    <div style="margin-top: 10% !important;" class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Please Sign In</h3>
                        </div>
                        <div class="panel-body">
                            <?php
                            $var_notif_open = '<div class="alert alert-warning alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
                            $var_notif_close = '</div>';
                            ?>
                            <?php echo $notifikasi1 != "" ? $var_notif_open . $notifikasi1 . $var_notif_close : ""; ?>
                            <?php echo $notifikasi2 != "" ? $var_notif_open . $notifikasi2 . $var_notif_close : ""; ?>
                            <?php echo $notifikasi3 != "" ? $var_notif_open . $notifikasi3 . $var_notif_close : ""; ?>

                            <form role="form" method="post" id="wl-form" name="wl-form">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Nama Pengguna" id="wl-username" name="username" value="<?= $username; ?>"  type="text" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Kata Sandi" id="wl-password" name="password" type="password" value="">
                                    </div>
                                    <!-- Change this to a button or input when using this as a form -->
                                    <button id="wl-btn" name="SUBMIT"  type="submit" class="btn btn-lg btn-primary btn-block">Login</button>
                                </fieldset>
                            </form>
                        </div>
                        <div class="panel-footer text-center">
                            E-Disposisi <?php echo $nama_singkat_perwakilan; ?> <br>Versi <?php echo $ver_name; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="<?= base_url(); ?>resources/skins/dfajar/vendor/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="<?= base_url(); ?>resources/skins/dfajar/vendor/bootstrap/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="<?= base_url(); ?>resources/skins/dfajar/vendor/metisMenu/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="<?= base_url(); ?>resources/skins/dfajar/dist/js/sb-admin-2.js"></script>

    </body>

</html>
