<?php 		
	echo $before_widget;
	echo $before_title . $title . $after_title;	
?>

<table class="syncline-poll-widget">
	<tr>
		<td>
			<img width="60px" src="<?php echo $sp_plugin_url . '/images/yes.png'; ?>">
			<p><span class="points"><?php echo $syncline_poll_yes; ?> votes</span></p>
		</td>
		<td>
			<img width="60px" src="<?php echo $sp_plugin_url . '/images/no.png'; ?>">
			<p><span class="points"><?php echo $syncline_poll_no; ?> votes</span></p>
		</td>
	</tr>
</table>

<?php
	echo $after_widget; 
?>
