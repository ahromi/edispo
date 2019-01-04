<?php 
if (isset($detail_terima[0]['berita_status_pengerjaan'])){
if ($detail_terima[0]['berita_status_pengerjaan'] == 'Y') {
	$stat = "<font color='green'>SUDAH</font>";
} else {
	$stat = "<font color='red'>BELUM</font>";
}
}else {
	$stat = "<font color='red'>BELUM</font>";
}
?>
<h2>Status Pengerjaan Disposisi : <?php echo $stat; ?> </h2>
<form method="post">
	<table>
	<?php if ($stat != "<font color='green'>SUDAH</font>") { ?>
	<tr>
			<td>Korespondensi Penjelasan Pengerjaan Disposisi : <br> <textarea
					rows="3" name="korespondensi_komentar" cols="25"></textarea> <br> <input
				type="submit" name="PENGERJAAN_DISPOSISI" value="Sudah Dilakukan"></td>
		</tr>
	<?php } ?>
</table>
</form>