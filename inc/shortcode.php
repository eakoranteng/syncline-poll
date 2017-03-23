<table class="form-table syncline-poll">
	<caption><?php echo $syncline_poll_name; ?></caption>
	<tr>
		<td class="yes">
			<button class="vote-btn">
				<span class="dashicons dashicons-thumbs-up"></span>
			</button>
			<p>
				<span class="points">
					<span class="count"><?php echo $syncline_poll_yes; ?></span> votes
				</span>
			</p>
		</td>
		<td class="no">
			<button class="vote-btn">
				<span class="dashicons dashicons-thumbs-down"></span>
			</button>
			<p>
				<span class="points">
					<span class="count"><?php echo $syncline_poll_no; ?></span> votes
				</span>
			</p>
		</td>
	</tr>
</table>