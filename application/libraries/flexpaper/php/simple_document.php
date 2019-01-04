<?php
require_once("lib/config.php");
require_once("lib/common.php"); 
$configManager = new Config();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">	
    <head> 
        <title>FlexPaper</title>         
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
        <style type="text/css" media="screen"> 
			html, body	{ height:100%; }
			body { margin:0; padding:0; overflow:auto; }   
			#flashContent { display:none; }
        </style> 
		
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/flexpaper_flash.js"></script>
    </head> 
    <body> 
	    <?php 
			// Setting current document from parameter or defaulting to 'Paper.pdf'
		
			//$doc = "A-12-00001_B-00001.PDF";
			if(isset($_GET["doc"]))
			$doc = $_GET["doc"];
			
			$pdfFilePath = $configManager->getConfig('path.pdf') . $doc;
			$swfFilePath = $configManager->getConfig('path.swf');
		?> 
    	<div>
	        <p id="viewerPlaceHolder" style="width:100%;height:768px;display:block">Document loading..</p>
			<?php if(validPdfParams($pdfFilePath,$doc,null) && is_dir($swfFilePath) ){ ?>
	        	<script type="text/javascript"> 
				var doc = '<?php print $doc; ?>';
			
				var fp = new FlexPaperViewer(	
						 'FlexPaperViewer',
						 'viewerPlaceHolder', { config : {
						 SwfFile : escape('services/view.php?doc='+doc),
						 Scale : 0.6, 
						 ZoomTransition : 'easeOut',
						 ZoomTime : 0.5,
						 ZoomInterval : 0.2,
						 FitPageOnLoad : true,
						 FitWidthOnLoad : false,
						 FullScreenAsMaxWindow : false,
						 ProgressiveLoading : false,
						 MinZoomSize : 0.2,
						 MaxZoomSize : 5,
						 SearchMatchAll : false,
						 InitViewMode : 'Portrait',
						 
						 ViewModeToolsVisible : true,
						 ZoomToolsVisible : true,
						 NavToolsVisible : true,
						 CursorToolsVisible : true,
						 SearchToolsVisible : true,
  						
  						 localeChain: 'en_US'
						 }});
						 
				function onDocumentLoadedError(errMessage){
					$('#viewerPlaceHolder').html("Error displaying document. Make sure the conversion tool is installed and that correct user permissions are applied to the SWF Path directory <?php $configManager->getDocUrl() ?>");
				}
	        </script> 
		<?php }else{ ?>
			<script type="text/javascript">
				$('#viewerPlaceHolder').html('Cannot read pdf file path, please check your configuration (in php/lib/config/)');
			</script>
		<?php } ?>
        </div>

   </body> 
</html> 