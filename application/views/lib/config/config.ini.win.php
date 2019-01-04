; <?php exit; ?> DO NOT REMOVE THIS LINE
[general]
 allowcache = true
 path.pdf = "C:\xampp\htdocs\e-disposisi\files\"
 path.swf = "C:\xampp\htdocs\e-disposisi\flexpaper\php\docs\"
 
[external commands]
 cmd.conversion.singledoc = "\"C:\Program Files\SWFTools\pdf2swf.exe\" {path.pdf}{pdffile} -o {path.swf}{pdffile}.swf -f -T 9 -t -s storeallcharacters"
 cmd.conversion.splitpages = "\"C:\Program Files\SWFTools\pdf2swf.exe\" {path.pdf}{pdffile} -o {path.swf}{pdffile}%.swf -f -T 9 -t -s storeallcharacters -s linknameurl"
 cmd.searching.extracttext = "\"C:\Program Files\SWFTools\swfstrings.exe\" {path.swf}{swffile}"
