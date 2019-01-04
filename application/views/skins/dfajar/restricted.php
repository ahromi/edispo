<?php
//echo "<pre>";
//print_r($arr_pendingan);
//echo "</pre>";

$username = $this->session->userdata('SESSION_USERNAME');
$koordinator_fungsi = $this->session->userdata('SESSION_KOORDINATOR');
$disposisi_fungsi = $this->session->userdata('SESSION_DISPOSISI_FUNGSI');
if (!empty($username)) {
    $this->load->view('skins/dfajar/tmpl/header');
    ?>
    <!-- /.page-content -->
    <div class="page-content">
        <!-- begin PAGE TITLE ROW -->
        <div class="row" style="font-family: Arial, Helvetica, sans-serif">
            <div class="col-xs-12">
                <div class="portlet portlet-default">
                    <div class="portlet-heading">
                        <div class="portlet-title">
                            <h4>Dashboard Berita</h4>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="defaultPortlet" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <center>Restricted Access</center>
                        </div>
                    </div>
                    <div class="portlet-footer">
                        <center>2019 &COPY; e-Disposisi by Pusat Komunikasi - KJRI Kuching Versi <?php echo $this->session->userdata('ver_name'); ?></center>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <!-- end PAGE TITLE ROW -->
    </div>
    <!-- /.page-content -->



    <!--Special footer for dashboard home-->
    </div>
    <!-- /#page-wrapper -->
    <!-- end MAIN PAGE CONTENT -->

    </div>
    <!-- /#wrapper -->

    <!-- GLOBAL SCRIPTS -->
    <script src="<?= base_url(); ?>resources/skins/dfajar/vendor/jquery/jqueryv1.10.2.min.js"></script>
    <script src="<?= base_url(); ?>resources/skins/dfajar/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>resources/skins/dfajar/vendor/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url(); ?>resources/skins/dfajar/vendor/popupoverlay/jquery.popupoverlay.js"></script>
    <script src="<?= base_url(); ?>resources/skins/dfajar/vendor/popupoverlay/defaults.js"></script>
    <!--Bootstrap auto complete-->
    <script src="<?= base_url(); ?>resources/skins/dfajar/vendor/bootstrap/js/jquery.bootcomplete.js"></script>
    <!-- Logout Notification Box -->
    <div id="logout">
        <div class="logout-message">
            <img class="img-circle img-logout" src="<?= base_url() . 'uploads/' . $this->session->userdata('SESSION_FOTO'); ?>" alt="">
            <h3>
                <i class="fa fa-sign-out text-green"></i> Ready to go?
            </h3>
            <p>Select "Logout" below if you are ready<br> to end your current session.</p>
            <ul class="list-inline">
                <li>
                    <a href="<?= base_url(); ?>index.php/logout" class="btn btn-green">
                        <strong>Logout</strong>
                    </a>
                </li>
                <li>
                    <button class="logout_close btn btn-green">Cancel</button>
                </li>
            </ul>
        </div>
    </div>

    <!--button untuk loading notification-->

    <!--end button untuk loading notification-->

    <!-- /#logout -->
    <!-- Logout Notification jQuery -->
    <script src="<?= base_url(); ?>resources/skins/dfajar/vendor/popupoverlay/logout.js"></script>
    <!-- HISRC Retina Images -->
    <script src="<?= base_url(); ?>resources/skins/dfajar/vendor/hisrc/hisrc.js"></script>

    <!-- PAGE LEVEL PLUGIN SCRIPTS -->
    <script src="<?= base_url(); ?>resources/skins/dfajar/vendor/bootstrap-datepicker/bootstrap-datepicker.js"></script>
    <script src="<?= base_url(); ?>resources/skins/dfajar/vendor/messenger/messenger.min.js"></script>
    <script src="<?= base_url(); ?>resources/skins/dfajar/vendor/messenger/messenger-theme-flat.js"></script>
    <script src="<?= base_url(); ?>resources/skins/dfajar/vendor/easypiechart/jquery.easypiechart.min.js"></script>
    <!-- Morris Charts -->
    <script src="<?= base_url(); ?>resources/skins/dfajar/vendor/morris/raphael-2.1.0.min.js"></script>
    <script src="<?= base_url(); ?>resources/skins/dfajar/vendor/morris/morris.js"></script>

    <script src="<?= base_url(); ?>resources/skins/dfajar/vendor/canvasjs/canvasjs.min.js"></script>

    <!-- THEME SCRIPTS -->
    <script src="<?= base_url(); ?>resources/skins/dfajar/dist/js/flex.js"></script>

    <script type="text/javascript">
        if (typeof $('#instansi_pengirim') === "object" && $('#instansi_pengirim').length !== 0) {
            $('#instansi_pengirim').bootcomplete({
                url: '<?= base_url(); ?>index.php/berita/tambah_berita/autocomplete'
            });
        }

        if (typeof $('#instansi_pengirim') === "object" && $('#instansi_pengirim').length !== 0) {
            $('#tgl_berita').datepicker({
                format: 'yyyy/mm/dd',
                autoclose: true,
                todayHighlight: true
            });
        }
        if (typeof $('#tgl_mulai') === "object" && $('#tgl_mulai').length !== 0) {
            $('#tgl_mulai').datepicker({
                format: 'yyyy/mm/dd',
                autoclose: true,
                todayHighlight: true
            });
        }
        if (typeof $('#tgl_akhir') === "object" && $('#tgl_akhir').length !== 0) {
            $('#tgl_akhir').datepicker({
                format: 'yyyy/mm/dd',
                autoclose: true,
                todayHighlight: true
            });
        }
        function loadiframe(srcnya) {
            var iframe = $("#iframe_detail");
            iframe.attr("src", srcnya);
        }

        function insert(inputString) {
            if (inputString.length == 0) {
                alert('Isi Nama Pengirim !');
                return false;
            } else {
                $.post("<?= base_url(); ?>index.php/berita/tambah_berita/tambah_pengirim/", {queryString: "" + inputString + ""}, function (data) {
                    alert(data);
                });
            }
        }

        $(document).ready(function () {

            $('#aksiDispo').attr('checked', 'checked');

            $('input:radio[name="aksi"]').change(
                    function () {
                        if ($(this).is(':checked') && $(this).val() == 'alihkan') {
                            //alert ('alihkan');
                            $('#disposisi_panel').slideUp();
                            $('#alihkan_panel').slideDown();
                        }
                        if ($(this).is(':checked') && $(this).val() == 'dispo') {
                            //alert ('dispo');
                            $('#alihkan_panel').slideUp();
                            $('#disposisi_panel').slideDown();
                        }
                    });

            $('input:radio[name="lanjutDispo"]').change(
                    function () {
                        if ($(this).is(':checked') && $(this).val() == 'YA') {
                            //alert ('alihkan');
                            $('#lanjutDispoPanel1').slideDown();
                            $('#lanjutDispoPanel2').slideDown();
                            $('#TERIMA_DISPOSISI').val('Terima dan Lanjutkan Disposisi');

                        }
                        if ($(this).is(':checked') && $(this).val() == 'TIDAK') {
                            //alert ('dispo');
                            $('#lanjutDispoPanel1').slideUp();
                            $('#lanjutDispoPanel2').slideUp();
                            $('#TERIMA_DISPOSISI').val('Terima Disposisi');
                        }
                    });

            $('#ALIHKAN_DISPO').click(function () {
                i = $('#valFungsi').val();
                $.post("<?= base_url(); ?>index.php/berita/detail/alihkan/<?php echo $this->uri->segment(4); ?>", {queryString: "" + i + ""}, function (data) {
                                var obj = eval('(' + data + ')');
                                if (obj.status == 'Berhasil') {
                                    alert(obj.isi);
    <?php if ($this->session->userdata('SESSION_FUNGSI_KD') == 1 || $this->session->userdata('SESSION_FUNGSI_KD') == 2) { ?>
                                        window.location.href = "<?php echo base_url() . "index.php/berita/berita/index"; ?>";
    <?php } ?>
                                    window.location.href = "<?php echo base_url() . "index.php/berita/berita_fungsi/index"; ?>";
                                } else {
                                    alert(obj.status);
                                }
                            });
                        });

                    });


    </script>
    </body>

    </html>

    <!--End special footer for dashboard home-->
    <?php
} else {
    redirect('');
}
?>