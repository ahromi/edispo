<?php
//echo "<pre>";
//print_r($arr_penerimaan);
//echo "</pre>";
//die();
$max_arr = count($data_statistics_bar);
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
                            <div class="row">
                                <?php
                                $css_col_lg = "col-lg-3 col-md-3 col-sm-3 col-xs-6";
                                $css_graph = "col-lg-6 col-md-6 col-sm-6 col-xs-12";
                                if ($disposisi_fungsi == 'Y') {
                                    $css_col_lg = "col-lg-2 col-md-2 col-sm-2 col-xs-6";
                                    ?>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="circle-tile">
                                            <a href="<?php echo base_url() . 'index.php/berita/berita_fungsi/undisposed'; ?>">
                                                <div class="circle-tile-heading dark-blue">
                                                    <i class="fa fa-book fa-fw fa-3x"></i>
                                                </div>
                                            </a>
                                            <div class="circle-tile-content dark-blue">
                                                <div class="circle-tile-description text-faded">
                                                    Menunggu <br>Disposisi
                                                </div>
                                                <div class="circle-tile-number text-faded">
                                                    <?php echo isset($undisposed[0]['jumlah']) ? $undisposed[0]['jumlah'] : 0; ?>
                                                </div>
                                                <a href="<?php echo base_url() . 'index.php/berita/berita_fungsi/undisposed'; ?>" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>


                                <div class="<?php echo $css_col_lg; ?>">
                                    <div class="circle-tile">
                                        <a href="<?php echo base_url() . 'index.php/berita/berita/diterima'; ?>">
                                            <div class="circle-tile-heading orange">
                                                <i class="fa fa-edit fa-fw fa-3x"></i>
                                            </div>
                                        </a>
                                        <div class="circle-tile-content orange">
                                            <div class="circle-tile-description text-faded">
                                                Status <br>Penerimaan
                                            </div>
                                            <div class="circle-tile-number text-faded">
                                                <?php
                                                echo $arr_penerimaan['Y'] . '/' . ($arr_penerimaan['T'] + $arr_penerimaan['Y'])
                                                ?>
                                            </div>
                                            <a href="<?php echo base_url() . 'index.php/berita/berita/diterima'; ?>" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="<?php echo $css_col_lg; ?>">
                                    <div class="circle-tile">
                                        <a href="<?php echo base_url() . 'index.php/berita/berita/dikerjakan'; ?>">
                                            <div class="circle-tile-heading green">
                                                <i class="fa fa-check fa-fw fa-3x"></i>
                                            </div>
                                        </a>
                                        <div class="circle-tile-content green">
                                            <div class="circle-tile-description text-faded">
                                                Status <br>Pengerjaan
                                            </div>
                                            <div class="circle-tile-number text-faded">
                                                <?php
                                                echo $arr_pengerjaan['Y'] . '/' . ($arr_pengerjaan['T'] + $arr_pengerjaan['Y'])
                                                ?>
                                            </div>
                                            <a href="<?php echo base_url() . 'index.php/berita/berita/dikerjakan'; ?>" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="<?php echo $css_col_lg; ?>">
                                    <div class="circle-tile">
                                        <a href="<?php echo base_url() . 'index.php/berita/berita/pendingbulanlalu'; ?>">
                                            <div class="circle-tile-heading red">
                                                <i class="fa fa-exclamation fa-fw fa-3x"></i>
                                            </div>
                                        </a>
                                        <div class="circle-tile-content red">
                                            <div class="circle-tile-description text-faded">
                                                Total <br>Pending
                                            </div>
                                            <div class="circle-tile-number text-faded">
                                                <?php echo isset($arr_pendingan) ? $arr_pendingan : 0; ?>
                                            </div>
                                            <a href="<?php echo base_url() . 'index.php/berita/berita/pendingbulanlalu'; ?>" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="<?php echo $css_col_lg; ?>">
                                    <div class="circle-tile">
                                        <a href="<?php echo base_url() . 'index.php/berita/berita/keluar'; ?>">
                                            <div class="circle-tile-heading blue">
                                                <i class="fa fa-external-link fa-fw fa-3x"></i>
                                            </div>
                                        </a>
                                        <div class="circle-tile-content blue">
                                            <div class="circle-tile-description text-faded">
                                                Berita <br>Keluar
                                            </div>
                                            <div class="circle-tile-number text-faded">
                                                <?php echo $berita_keluar; ?>
                                            </div>
                                            <a href="<?php echo base_url() . 'index.php/berita/berita/keluar'; ?>" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <h2 class="text-center">Statistik Penerimaan dan Pengerjaan Berita Bulan <?php echo date("M Y"); ?></h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="<?php echo $css_graph; ?>">
                                    <div id="chartperformancefungsi" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
                                </div>
                                <div class="<?php echo $css_graph; ?>">
                                    <div id="chartperformancefungsiother" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
                                </div>
                                <br>
                            </div>
                            <br><br>
                            <div class="row">
                                <div class="<?php echo $css_graph; ?>">
                                    <div id="chartkawattoppengirimfungsi" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
                                </div>
                                <div class="<?php echo $css_graph; ?>">
                                    <div id="chartkawatmasukfungsi" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
                                </div>
                            </div>

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

                    //Easy Pie Charts
                    $(function () {
                        $('#easy-pie-1, #easy-pie-2, #easy-pie-3, #easy-pie-4').easyPieChart({
                            barColor: "rgba(255,255,255,.5)",
                            trackColor: "rgba(255,255,255,.5)",
                            scaleColor: "rgba(255,255,255,.5)",
                            lineWidth: 20,
                            animate: 1500,
                            size: 120,
                            onStep: function (from, to, percent) {
                                $(this.el).find('.percent').text(Math.round(percent));
                            }
                        });

                    });

                    function uncheck_sebelah(z, y, x) {
                        var oCheckbox = document.getElementById(y + "_" + x);

                        if (z.checked == true)
                        {
                            //do nothing
                        } else
                        {
                            oCheckbox.checked = false;
                        }
                    }

                    function check_sebelah(z, y, x)
                    {
                        var oCheckbox = document.getElementById(y + "_" + x);

                        if (z.checked == true)
                        {
                            oCheckbox.checked = true;
                        } else
                        {
                            oCheckbox.checked = false;
                        }
                    }
                    function doIt(id) {
                        $(id).modal();
                    }

                    if (typeof $('input:submit.btn') === "object" && $('input:submit.btn').length !== 0) {
                        $('input:submit.btn').on('click', function () {
                            var $this = $(this);
                            var value_awal = $this.attr('value');
                            $this.attr('style', 'display:none');
                            $this.after('<input type="submit" name="disabled_loading_button" value="Wait.." disabled class="btn btn-default btn-sm" />');
                            //                        $this.attr('value', "Wait..");
                            setTimeout(function () {
                                //                            $this.attr('value', value_awal);
                                $this.removeAttr('style');
                            }, 10000);
                        });
                    }

                    if (typeof $('#tgl_berita.tambahberita') === "object" && $('#tgl_berita.tambahberita').length !== 0) {
                        $('#tgl_berita.tambahberita').datepicker("setValue", '01/10/2014');
                        $("#tgl_berita.tambahberita").datepicker("update", new Date());
                    }

                    if (typeof $('#note_id_flag_gptn') === "object" && $('#note_id_flag_gptn').length !== 0) {
                        $(function () {
                            console.log('sssssss');
                            Messenger.options = {
                                extraClasses: 'messenger-fixed messenger-on-top messenger-on-right',
                                theme: 'flat'
                            }

                            Messenger().post({
                                message: $("#note_id_flag_gptn").val(),
                                id: "Only-one-message",
                                type: 'success',
                                showCloseButton: true
                            });
                        });
                    }

                    if (typeof $('#chartperformancefungsi') === "object" && $('#chartperformancefungsi').length !== 0) {
                        window.onload = function () {
                            var chart = new CanvasJS.Chart("chartperformancefungsi",
                                    {
                                        title: {
    //                                            text: "Statistik Penerimaan dan Pengerjaan Berita"
                                        },
                                        data: [
                                            {
                                                type: "stackedBar100",
                                                indexLabel: "{y}",
                                                indexLabelFontColor: "white",
                                                showInLegend: true,
                                                name: "Belum Diterima",
                                                color: "#e74c3c",
                                                click: onClick,
                                                dataPoints: [
    <?php
    foreach ($arr_statistic_fungsi_split[0] as $val_fungsi_kd) {
        if (isset($data_statistics_bar[$val_fungsi_kd]['terima_T'])) {
            echo '{y: ' . $data_statistics_bar[$val_fungsi_kd]['terima_T'] . ', label: "' . $data_statistics_bar[$val_fungsi_kd]['nama_fungsi'] . '",link:"'. base_url() . 'index.php/berita/detildashboard/belumditerima/'.$val_fungsi_kd.'"},';
        }
    }
    ?>
                                                ]
                                            },
                                            {
                                                type: "stackedBar100",
                                                indexLabel: "{y}",
                                                indexLabelFontColor: "white",
                                                showInLegend: true,
                                                name: "Diterima",
                                                color: "#f39c12",
                                                click: onClick,
                                                dataPoints: [
    <?php
    foreach ($arr_statistic_fungsi_split[0] as $val_fungsi_kd) {
        if (isset($data_statistics_bar[$val_fungsi_kd]['terima_Y'])) {
            echo '{y: ' . $data_statistics_bar[$val_fungsi_kd]['terima_Y'] . ', label: "' . $data_statistics_bar[$val_fungsi_kd]['nama_fungsi'] . '",link:"'. base_url() . 'index.php/berita/detildashboard/diterima/'.$val_fungsi_kd.'"},';
        }
    }
    ?>
                                                ]
                                            },
                                            {
                                                type: "stackedBar100",
                                                indexLabel: "{y}",
                                                indexLabelFontColor: "white",
                                                showInLegend: true,
                                                name: "Dikerjakan",
                                                color: "#16a085",
                                                click: onClick,
                                                dataPoints: [
    <?php
    foreach ($arr_statistic_fungsi_split[0] as $val_fungsi_kd) {
        if (isset($data_statistics_bar[$val_fungsi_kd]['dikerjakan'])) {
            echo '{y: ' . $data_statistics_bar[$val_fungsi_kd]['dikerjakan'] . ', label: "' . $data_statistics_bar[$val_fungsi_kd]['nama_fungsi'] . '",link:"'. base_url() . 'index.php/berita/detildashboard/dikerjakan/'.$val_fungsi_kd.'"},';
        }
    }
    ?>
                                                ]
                                            }
                                        ]
                                    });
                            chart.render();
                            

                            var chartother = new CanvasJS.Chart("chartperformancefungsiother",
                                    {
                                        title: {
    //                                            text: "Statistik Penerimaan dan Pengerjaan Berita"
                                        },
                                        data: [
                                            {
                                                type: "stackedBar100",
                                                indexLabel: "{y}",
                                                indexLabelFontColor: "white",
                                                showInLegend: true,
                                                name: "Belum Diterima",
                                                color: "#e74c3c",
                                                click: onClick,
                                                dataPoints: [
    <?php
    foreach ($arr_statistic_fungsi_split[1] as $val_fungsi_kd) {
        if (isset($data_statistics_bar[$val_fungsi_kd]['terima_T'])) {
            echo '{y: ' . $data_statistics_bar[$val_fungsi_kd]['terima_T'] . ', label: "' . $data_statistics_bar[$val_fungsi_kd]['nama_fungsi'] . '", link:"'. base_url() . 'index.php/berita/detildashboard/belumditerima/'.$val_fungsi_kd.'"},';
        }
    }
    ?>
                                                ]
                                            },
                                            {
                                                type: "stackedBar100",
                                                indexLabel: "{y}",
                                                indexLabelFontColor: "white",
                                                showInLegend: true,
                                                name: "Diterima",
                                                color: "#f39c12",
                                                click: onClick,
                                                dataPoints: [
    <?php
    foreach ($arr_statistic_fungsi_split[1] as $val_fungsi_kd) {
        if (isset($data_statistics_bar[$val_fungsi_kd]['terima_T'])) {
            echo '{y: ' . $data_statistics_bar[$val_fungsi_kd]['terima_Y'] . ', label: "' . $data_statistics_bar[$val_fungsi_kd]['nama_fungsi'] . '", link:"'. base_url() . 'index.php/berita/detildashboard/diterima/'.$val_fungsi_kd.'"},';
        }
    }
    ?>
                                                ]
                                            },
                                            {
                                                type: "stackedBar100",
                                                indexLabel: "{y}",
                                                indexLabelFontColor: "white",
                                                showInLegend: true,
                                                name: "Dikerjakan",
                                                color: "#16a085",
                                                click: onClick,
                                                dataPoints: [
    <?php
    foreach ($arr_statistic_fungsi_split[1] as $val_fungsi_kd) {
        if (isset($data_statistics_bar[$val_fungsi_kd]['dikerjakan'])) {
            echo '{y: ' . $data_statistics_bar[$val_fungsi_kd]['dikerjakan'] . ', label: "' . $data_statistics_bar[$val_fungsi_kd]['nama_fungsi'] . '", link:"'. base_url() . 'index.php/berita/detildashboard/dikerjakan/'.$val_fungsi_kd.'"},';
        }
    }
    ?>
                                                ]
                                            }
                                        ]
                                    });
                            chartother.render();
                            function onClick(e) {
                                window.open(e.dataPoint.link,'_self');  
                            }

    <?php
    if (count($data_statistic_doughnut) > 0) {
        ?>
                                var chart2 = new CanvasJS.Chart("chartkawattoppengirimfungsi",
                                        {
                                            title: {
                                                text: "Top Instansi Pengirim Berita"
                                            },
                                            data: [
                                                {
                                                    type: "doughnut",
                                                    dataPoints: [
        <?php
        foreach ($data_statistic_doughnut as $row_statistic_doughnut) {
            echo '{y: ' . $row_statistic_doughnut['jml'] . ', indexLabel: "' . $row_statistic_doughnut['perwakilan_nama'] . ' ({y}) "},';
        }
        ?>
                                                    ]
                                                }
                                            ]
                                        });

                                chart2.render();
        <?php
    }
    ?>

    <?php
    if (count($data_statistic_terdispo) > 0) {
        ?>
                                var chart3 = new CanvasJS.Chart("chartkawatmasukfungsi",
                                        {
                                            title: {
                                                text: "Fungsi Terdisposisi"
                                            },
                                            data: [
                                                {
                                                    type: "pie",
                                                    toolTipContent: "{y}",
                                                    dataPoints: [
        <?php
        foreach ($data_statistic_terdispo as $row_statistic_terdispo) {
            echo '{y: ' . $row_statistic_terdispo['jml'] . ', indexLabel: "' . $row_statistic_terdispo['nama_fungsi'] . ' #percent %"},';
        }
        ?>
                                                    ]
                                                }
                                            ]
                                        });

                                chart3.render();
        <?php
    }
    ?>
                        }
                    }
    </script>
    </body>

    </html>

    <!--End special footer for dashboard home-->
    <?php
} else {
    redirect('');
}
?>