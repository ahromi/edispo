<div id="footer" class="radius-bottom"><?=date('Y');?> &copy; <a
	href="javascript:if(confirm('asas'))e'" class="afooter-link">E-Disposisi</a>
by <a href="javascript:if(confirm('a')'" class="afooter-link">Pusat
Komunikasi - Kementerian Luar Negeri</a></div>
</div>
</div>
</div>
<div class="push"></div>
<!--[if lte IE 8]><script src="excanvas.min.js" tppabs="http://pixelcave.com/demo/turboadmin/<?=base_url();?>/resources/js/excanvas.min.js"></script><![endif]-->
<script
	src="<?=base_url();?>resources/js/jquery-1.7.2.js"></script>
<script src="<?=base_url();?>resources/js/jquery.validate.js"></script>
 <script
	src="<?=base_url();?>resources/js/jquery.upload-1.0.2.js"></script>
<script
	src="<?=base_url();?>resources/js/jquery.flot.min.js"></script>  
<script
	src='<?=base_url();?>resources/js/jquery.ui.core.js'></script>
<script
	src='<?=base_url();?>resources/js/jquery.ui.widget.js'></script>
<script
	src='<?=base_url();?>resources/js/jquery.ui.position.js'></script>
<script
	src='<?=base_url();?>resources/js/jquery.ui.datepicker.js'></script>
<script
	src='<?=base_url();?>resources/js/jquery.ui.autocomplete.js'></script>
<script
	src='<?=base_url();?>resources/js/jquery.simplemodal.js'></script>
<script
	type="text/javascript"
	src="<?=base_url();?>resources/js/pdfobject/pdfobject.js"></script>
<script
	src='<?=base_url();?>resources/js/basic.js'></script>
<script
	src="<?=base_url();?>resources/js/page.js"></script>
<script
	src="<?=base_url();?>resources/js/chosen.jquery.js"></script>
<?php
  $ver_name = $this->session->userdata('ver_name');
?>
<script language="JavaScript" type="text/javascript"> 

	$(function() {
  	$("#tgl_akhir").datepicker({ dateFormat: "yy-mm-dd" }).val()
	$("#tgl_mulai").datepicker({ dateFormat: "yy-mm-dd" }).val()
 		jQuery(".chosen").chosen();
// 		$.ajax({
//				 url:"//updates.kemlu.go.id/edispopwk/check.php?ver=<?php echo $ver_name;?>",
//				 dataType: 'jsonp', // Notice! JSONP <-- P (lowercase)
//				 success:function(json){
//					 // do stuff with json (in this case an array)
//					// alert(json[0]);
//					 if (json[0]==1){
//					 	  $( "#update" ).append( $( "<h2>Update Terbaru!</h2> <p style='font-size:11px;'> Versi Baru <b>"+json[1]+"</b><br>Tanggal Rilis : <strong>"+json[3]+"</strong><br>Pengembang versi :<strong> "+json[5]+"</strong><br>Link Download <br> <strong><a href='"+json[4]+"'>"+json[4]+"</a></strong><br></p>" ) );
//						  $("#new_update").show();
//					 } else {
//					 	  $( "#update" ).append( $( "<h2>Update Terbaru!</h2> <p style='font-size:11px;'>Versi E-Disposisi Anda telah ter-Up-to-date!</p>" ) );
//					 }              
//				 },
//				 error:function(){
//					 alert("Error");
//				 },
//			});

 		
         $('#upload').click(function() {
            $('#file1').upload('<?php echo base_url();?>index.php/berita/detail/upload/<?php echo $this->uri->segment(4); ?>', function(res) {
				out = eval('(' + res + ')'); 
				//$(out.msg).insertAfter('#file1');
				alert(out.msg);
				$('#lihat_berkas').html('<center><a href="#" onclick="window.open (\'<?=base_url();?>index.php/berita/berita/show/'+out.filename+'\',\'mywindow\',\'resizable=1,fullscreen=1,location=0\');">LIHAT BERKAS</a></center>'); 

            }, 'html');
			$('#file1').val('');
							
        });
		
		//$("#tgl_berita").datepicker();
		$( "#tgl_berita" ).datepicker({ dateFormat: "yy/mm/dd" });
		$( "#tanggal_mulai" ).datepicker({ dateFormat: "yy/mm/dd" });
		$( "#tanggal_akhir" ).datepicker({ dateFormat: "yy/mm/dd" });
		function log( message ) {
			$( "#perwakilan_kd" ).val(message);
		}

		$( "#tags" ).autocomplete({
			source: "autocomplete/",
			minLength: 2,
			select: function( event, ui ) {
				log(ui.item.id);
			}
		});
		
		$( "#tags2" ).autocomplete({
			source: "../../berita/tambah_berita/autocomplete/",
			minLength: 2,
			select: function( event, ui ) {
				log(ui.item.id);
			}
		});
	});


function doIt(id){
		$(id).modal();
	}
function lookup(inputString) {
        if(inputString.length == 0) {
            $('#suggestions').hide();
        } else {
            $.post("<?=base_url();?>index.php/berita/tambah_berita/autocomplete/", {queryString: ""+inputString+""}, function(data){
                if(data.length >0) {
                    $('#suggestions').show();
                    $('#autoSuggestionsList').html(data);
                }
            });
        }
    }
    
    function fill(thisValue,id) {
        $('#id_input').val(thisValue);
        $('#perwakilan_kd').val(id);
        setTimeout("$('#suggestions').hide();", 200);
    }  
	
	function getVal(i){
		$('#valFungsi').val(i);
	}

	function insert(inputString) {
			if(inputString.length == 0) {
				alert ('Isi Nama Pengirim !');
				return false;
			} else {
				$.post("<?=base_url();?>index.php/berita/tambah_berita/tambah_pengirim/", {queryString: ""+inputString+""}, function(data){
					alert(data);
				});
			}
		}	   
 
	$(document).ready(function() {
	
 		
		$('#aksiDispo').attr('checked', 'checked');
	
		$('input:radio[name="aksi"]').change(
			function(){
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
			function(){
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

		$('#ALIHKAN_DISPO').click(function(){
			i = $('#valFungsi').val();
 			$.post("<?=base_url();?>index.php/berita/detail/alihkan/<?php echo $this->uri->segment(4);?>", {queryString: ""+i+""}, function(data){
					var obj = eval('(' + data + ')');
					if (obj.status=='Berhasil'){
						alert(obj.isi);	
						<?php
						if ($this->session->userdata('SESSION_FUNGSI_KD')==1 || $this->session->userdata('SESSION_FUNGSI_KD')==2){ ?>
						window.location.href="<?php echo base_url()."index.php/berita/berita/index"; ?>";
						<?php } ?>
						window.location.href="<?php echo base_url()."index.php/berita/berita_fungsi/index"; ?>";					
							}else {
						alert(obj.status);	
					}
				});
		});	
 		
	});
    </script>


</body>
</html>
