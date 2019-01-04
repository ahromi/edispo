<?php  
header ("Content-Type:text/xml");  
?>  
<chart>

	<chart_data>
		<row>
			<null/>
			<?php foreach($statistik as $val){ ?>
				<string><?php echo $val['month'];?></string>
			<?php } ?>
		</row>
		<row>
			<string></string>
			<?php foreach($statistik as $val){ ?>
				<number><?php echo $val['jml'];?></number>
			<?php } ?>
		</row>
	</chart_data>
	<chart_grid_h thickness='0' />
	<chart_label shadow='low' color='000000' alpha='65' size='10' position='inside' as_percentage='false' />
	<chart_pref select='false' drag='true' rotation_x='60' min_x='20' max_x='90' />
	<chart_rect x='160' y='40' width='200' height='200' positive_alpha='0' />
	<chart_transition type='spin' delay='0' duration='1' order='category' />
	<chart_type>3d pie</chart_type>

	<draw>
		<rect bevel='bg' layer='background' x='0' y='0' width='600' height='350' fill_color='4c5577' line_thickness='0' />
		<text shadow='low' color='0' alpha='20' size='40' x='0' y='260' width='500' height='50' v_align='middle'>Statistik Berita <?php echo date('Y');?></text>
		<rect shadow='low' layer='background' x='-50' y='50' width='540' height='200' rotation='-5' fill_alpha='0' line_thickness='80' line_alpha='5' line_color='0' />
	</draw>
	<filter>
		<shadow id='low' distance='2' angle='45' color='0' alpha='50' blurX='4' blurY='4' />
		<bevel id='bg' angle='180' blurX='100' blurY='100' distance='50' highlightAlpha='0' shadowAlpha='15' type='inner' />
		<bevel id='bevel1' angle='45' blurX='5' blurY='5' distance='1' highlightAlpha='25' highlightColor='ffffff' shadowAlpha='50' type='inner' />
	</filter>
	
	<legend bevel='bevel1' transition='dissolve' delay='0' duration='1' x='0' y='45' width='50' height='210' margin='10' fill_color='0' fill_alpha='20' line_color='000000' line_alpha='0' line_thickness='0' layout='horizontal' bullet='circle' size='12' color='ffffff' alpha='85' />

 	<series_explode>
		<number>25</number>
		<number>35</number>
	</series_explode>

</chart>

