<?php 		
echo $before_widget;
echo $before_title . $title . $after_title;	
?>

<?php 
	if (!empty($options)) {
?>
<table class="syncline-poll widget">
	<tr class="vote">
		<td class="yes">
			<button class="vote-btn">
				<span class="dashicons dashicons-thumbs-up"></span>
			</button>
		</td>
		<td class="no">
			<button class="vote-btn">
				<span class="dashicons dashicons-thumbs-down"></span>
			</button>
		</td>
	</tr>
	<tr class="hidden feedback">
		<td>
			<h4>Thank You</h4>
		</td>
	</tr>
	<tr class="hidden progress">
		<td class="yes">
			<progress value="<?php echo $syncline_poll_yes; ?>" max="100"></progress> <span class="percent"><?php echo $syncline_poll_yes; ?></span>%
		</td>
		<td class="no">
			<progress value="<?php echo $syncline_poll_no; ?>" max="100"></progress> <span class="percent"><?php echo $syncline_poll_no; ?></span>%
		</td>
	</tr>
</table>

<?php } ?>

<?php
echo $after_widget; 
?>
