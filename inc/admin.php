<?php 

function print_perval($perval) {
	if (is_nan($perval)) {
		echo '0';
	} else {
		echo $perval;
	}
}

?>

<div class="wrap">

	<div id="icon-options-general" class="icon32"></div>
	<h1>Syncline Poll</h1>

	<div id="poststuff">
		<div id="post-body" class="metabox-holder columns-2">

			<!-- main admin page -->
			<div id="post-body-content">
				<div class="meta-box-sortables ui-sortable">
					<div class="postbox">
						<div class="handlediv" title="Click to toggle"><br></div>
						<h2 class="hndle"><span>Run A Poll</span>
						</h2>

						<div class="inside">
							<form name="syncline_poll_form" method="post" action="">
								<table class="form-table">
									<tr>
										<td>
											<label for="syncline_poll_name"><?php echo $syncline_poll_label; ?></label>
										</td>
										<td>
											<input type="text" name="syncline_poll_name" id="syncline_poll_name" class="large-text" value="" />
										</td>
										<td>
											<input class="button-primary" type="submit" name="syncline_poll_submit" value="<?php echo $syncline_submit_btn; ?>" />
										</td>
									</tr>
								</table>
							</form>
							<?php if (!empty($options)) { ?>
							<em><strong>Please Note:</strong> Changing your current poll will <strong>reset</strong> your current count to <strong>0</strong>.</em>
							<?php } ?>

							<?php if (!empty($options)) { ?>
							<div class="syncline-poll admin">
								<h2>Current Poll</h2>
								<table class="form-table">
									<caption><?php echo $syncline_poll_name; ?></caption>
									<tr>
										<td class="yes">
											<span class="dashicons dashicons-thumbs-up"></span>
											<p>
												<span class="points">
													<span class="count">
														<?php echo $syncline_poll_yes; ?></span> votes
													</span>
												</p>
											</td>
											<td class="no">
												<span class="dashicons dashicons-thumbs-down"></span>
												<p>
													<span class="points">
														<span class="count"><?php echo $syncline_poll_no; ?></span> votes
													</span>
												</p>
											</td>
										</tr>
										<tr>
											<td class="yes">
												<progress value="<?php print_perval($syncline_poll_yes_percent); ?>" max="100"></progress> <span><?php print_perval($syncline_poll_yes_percent); ?></span>%
											</td>
											<td class="no">
												<progress value="<?php print_perval($syncline_poll_no_percent); ?>" max="100"></progress> 
												<span><?php print_perval($syncline_poll_no_percent); ?></span>%
											</td>
										</tr>
									</table>
								</div>
								<h3>Total Votes: <?php echo $syncline_poll_count; ?></h3>
								<?php } ?>
								
							</div>
						</div>
					</div>
				</div>

				<!-- sidebar -->
				<div id="postbox-container-1" class="postbox-container">
					<div class="meta-box-sortables">
						<div class="postbox">
							<div class="handlediv" title="Click to toggle"><br></div>
							<h2 class="hndle"><span>About Plugin</span></h2>
							<div class="inside">
								<p>Run a poll on your WordPress posts and pages.</p>
								<p>Flexible and allows you to change your poll anytime.<br> <strong>Please note:</strong> Changing your current poll will <strong>reset</strong> your current count to 0.
								</p>
							</div>
						</div>
						<div class="postbox">
							<div class="handlediv" title="Click to toggle"><br></div>
							<h2 class="hndle"><span>Usage</span></h2>
							<div class="inside">
								<p>Syncline Poll uses shortcodes and widgets. To display a poll, copy the shortcode below and paste into your post or page.</p>
								<p><code>[syncline-poll]</code></p>
								<p>To use as a widget, go to <br><em>Appearance > Widgets</em> <br>and set your Syncline Poll to any column</p>
							</div>
						</div>
					</div>
				</div>

			</div>
			<br class="clear">
		</div>

	</div>