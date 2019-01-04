
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
<script src="<?= base_url(); ?>resources/skins/dfajar/vendor/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url(); ?>resources/skins/dfajar/vendor/datatables/datatables-bs3.js"></script>
<!-- Morris Charts -->
<script src="<?= base_url(); ?>resources/skins/dfajar/vendor/morris/raphael-2.1.0.min.js"></script>
<script src="<?= base_url(); ?>resources/skins/dfajar/vendor/morris/morris.js"></script>

<script src="<?= base_url(); ?>resources/skins/dfajar/vendor/canvasjs/canvasjs.min.js"></script>

<!-- THEME SCRIPTS -->
<script src="<?= base_url(); ?>resources/skins/dfajar/dist/js/flex.js"></script>

<script type="text/javascript">
    if (typeof $('#cari_table') === "object" && $('#cari_table').length !== 0) {
        $(document).ready(function () {
            $('#cari_table').dataTable();
        });
    }
    
    if (typeof $('#berita_keluar_rahasia') === "object" && $('#berita_keluar_rahasia').length !== 0) {
        $(document).ready(function () {
            $('#berita_keluar_rahasia').dataTable();
            $('#berita_keluar_biasa').dataTable();
        });
    }

    $('input:radio[name="rad_sifat_dokumen"]').change(
            function () {
                var jenis_docs = ($('input:radio[name="rad_sifat_dokumen"]:checked').val());
                var arsip_kdsss = $('#arsip_kd').val();
                var berita_kdss = $('#berita_kd').val();
                if (jenis_docs === '1') {
                    var new_arsip_kd = arsip_kdsss.replace("B", "R");
                    var new_berita_kd = berita_kdss.replace("B", "R");
                } else {
                    var new_arsip_kd = arsip_kdsss.replace("R", "B");
                    var new_berita_kd = berita_kdss.replace("R", "B");
                }
                $.ajax({
                    type: "GET",
                    url: "<?= base_url(); ?>index.php/berita/tambah_berita_keluar/calclastrow/" + jenis_docs,
                    success: function (result)
                    {
                        $("#arsip_kd").val(result);
                    }
                });

                $("#berita_kd").val(new_berita_kd);

            });


    if (typeof $('#instansi_pengirim') === "object" && $('#instansi_pengirim').length !== 0) {
        $('#instansi_pengirim').bootcomplete({
            url: '<?= base_url(); ?>index.php/berita/tambah_berita/autocomplete'
        });
    }

    if (typeof $('#fungsi_pengirim') === "object" && $('#fungsi_pengirim').length !== 0) {
        $('#fungsi_pengirim').bootcomplete({
            url: '<?= base_url(); ?>index.php/berita/tambah_berita_keluar/autocomplete'
        });
    }

    if (typeof $('#tgl_berita') === "object" && $('#tgl_berita').length !== 0) {
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
                        }, 100000);
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

                if (typeof $('#chartpenerimaanfungsi') === "object" && $('#chartpenerimaanfungsi').length !== 0) {
                    window.onload = function () {
                        var chart = new CanvasJS.Chart("chartpenerimaanfungsi", {
                            animationEnabled: true,
                            title: {
                                text: "Statistik Pending Pengerjaan Berita",
                                horizontalAlign: "center"
                            },
                            data: [{
                                    type: "doughnut",
                                    startAngle: 60,
                                    //innerRadius: 60,
                                    indexLabelFontSize: 17,
                                    indexLabel: "{label} - #percent%",
                                    toolTipContent: "<b>{label}:</b> {y} (#percent%)",
                                    dataPoints: [
                                        {y: 0, label: "Politik"},
                                        {y: 0, label: "Ekonomi"},
                                        {y: 0, label: "Penerangan"},
                                        {y: 7, label: "Konsuler"},
                                        {y: 0, label: "Administrasi"},
                                        {y: 0, label: "Komunikasi"},
                                        {y: 0, label: "Pertahanan"},
                                        {y: 0, label: "Pendidikan"},
                                        {y: 0, label: "Perdagangan"},
                                        {y: 0, label: "Perhubungan"},
                                        {y: 6, label: "Pertanian"},
                                        {y: 6, label: "Kepolisian"},
                                        {y: 0, label: "BIN"}
                                    ]
                                }]
                        });
                        chart.render();
                    }
                }

                if (typeof $('#chartperformancefungsi') === "object" && $('#chartperformancefungsi').length !== 0) {
                    window.onload = function () {
                        var chart = new CanvasJS.Chart("chartperformancefungsi",
                                {
                                    title: {
                                        text: "Division of products Sold in Quarter."
                                    },
                                    data: [
                                        {
                                            type: "stackedBar100",
                                            indexLabel: "{y}",
                                            indexLabelFontColor: "white",
                                            showInLegend: true,
                                            name: "April",
                                            dataPoints: [
                                                {y: 600, label: "Water Filter"},
                                                {y: 400, label: "Modern Chair"},
                                                {y: 120, label: "VOIP Phone"},
                                                {y: 250, label: "Microwave"},
                                                {y: 120, label: "Water Filter"},
                                                {y: 374, label: "Expresso Machine"},
                                                {y: 350, label: "Lobby Chair"}
                                            ]
                                        },
                                        {
                                            type: "stackedBar100",
                                            indexLabel: "{y}",
                                            indexLabelFontColor: "white",
                                            showInLegend: true,
                                            name: "April",
                                            dataPoints: [
                                                {y: 400, label: "Water Filter"},
                                                {y: 500, label: "Modern Chair"},
                                                {y: 220, label: "VOIP Phone"},
                                                {y: 350, label: "Microwave"},
                                                {y: 220, label: "Water Filter"},
                                                {y: 474, label: "Expresso Machine"},
                                                {y: 450, label: "Lobby Chair"}
                                            ]
                                        },
                                        {
                                            type: "stackedBar100",
                                            indexLabel: "{y}",
                                            indexLabelFontColor: "white",
                                            showInLegend: true,
                                            name: "April",
                                            dataPoints: [
                                                {y: 300, label: "Water Filter"},
                                                {y: 610, label: "Modern Chair"},
                                                {y: 215, label: "VOIP Phone"},
                                                {y: 221, label: "Microwave"},
                                                {y: 75, label: "Water Filter"},
                                                {y: 310, label: "Expresso Machine"},
                                                {y: 340, label: "Lobby Chair"}
                                            ]
                                        }
                                    ]
                                });
                        chart.render();

                        var chart2 = new CanvasJS.Chart("chartkawatkeluarfungsi",
                                {
                                    title: {
                                        text: "Top U.S Smartphone Operating Systems By Market Share, Q3 2012"
                                    },
                                    data: [
                                        {
                                            type: "doughnut",
                                            dataPoints: [
                                                {y: 53.37, indexLabel: "Android"},
                                                {y: 35.0, indexLabel: "Apple iOS"},
                                                {y: 7, indexLabel: "Blackberry"},
                                                {y: 2, indexLabel: "Windows Phone"},
                                                {y: 5, indexLabel: "Others"}
                                            ]
                                        }
                                    ]
                                });

                        chart2.render();
                    }
                }
</script>
</body>

</html>
