; <?php exit; ?> DO NOT REMOVE THIS LINE
[general]
 allowcache = false
 path.pdf = "/var/www/files/"
 path.swf = "/var/www/publish/"
 
[external commands]
 cmd.conversion.singledoc 	= "/usr/local/bin/pdf2swf {path.pdf}{pdffile} -o {path.swf}{pdffile}.swf -f -T 9 -t -s storeallcharacters"
 cmd.conversion.splitpages 	= "/usr/local/bin/pdf2swf {path.pdf}{pdffile} -o {path.swf}{pdffile}%.swf -f -T 9 -t -s storeallcharacters -s linknameurl"
 cmd.searching.extracttext = "/usr/bin/swfstrings {path.swf}{swffile}"
