<?
$username=$this->session->userdata('SESSION_USERNAME');	
$level_id=$this->session->userdata('SESSION_FUNGSI_KD');	
if (!empty($username)) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mode Baca Berita</title>
<script type="text/javascript" src="<?=base_url();?>resources/js/pdfobject/pdfobject.js"></script>
</head>
<body>
      <script type="text/javascript">
      window.onload = function (){
        var success = new PDFObject({ url: "<?=base_url();?>files/<?=$berita[0]['berita_file'];?>" }).embed("mydiv");
      };
    </script> 
<div id="mydiv" style="width:100%;height:768px;"></div>
</div>                           
</body>
</html>
  <? 
  } else
  {
  redirect ('');
  }
  ?>