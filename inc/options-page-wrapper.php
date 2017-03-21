<div class="wrap">

	<div id="icon-options-general" class="icon32"></div>
	<h1><?php esc_attr_e( 'Syncline Polls Plugin', 'wp_admin_style' ); ?></h1>

	<div id="poststuff">

		<div id="post-body" class="metabox-holder columns-2">

			<!-- main content -->
			<div id="post-body-content">

				<div class="meta-box-sortables ui-sortable">

					<div class="postbox">

						<div class="handlediv" title="Click to toggle"><br></div>
						<!-- Toggle -->

						<h2 class="hndle"><span><?php esc_attr_e( 'Create A Poll', 'wp_admin_style' ); ?></span>
						</h2>

						<div class="inside">

							<form name="syncline_poll_form" method="post" action="">
								<table class="form-table">
									<tr>
										<td>
											<label for="syncline_poll_name">Poll Name</label>
										</td>
										<td>
											<input type="text" name="syncline_poll_name" id="syncline_poll_name" class="large-text" value="" />
										</td>
										<td>
											<input class="button-primary" type="submit" name="syncline_poll_submit" value="Save" />
										</td>
									</tr>
								</table>

							</form>

						</div>
						<!-- .inside -->

					</div>
					<!-- .postbox -->

					<div class="postbox">

						<div class="handlediv" title="Click to toggle"><br></div>
						<!-- Toggle -->

						<h2 class="hndle"><span><?php esc_attr_e( 'Polls', 'wp_admin_style' ); ?></span>
						</h2>

						<div class="inside">
							<p>Below are your public polls</p>

							<ul class="syncline-polls">

								<?php for( $i = 0; $i < 5; $i++ ): ?>
									<li>
										<table class="form-table">
											<caption>Poll Name</caption>
											<tr>
												<td scope="row">
													<img width="60px" src="<?php echo $plugin_url . '/images/yes.png'; ?>">
													<p><span class="points">100 votes</span></p>
												</td>
												<td>
													<img width="60px" src="<?php echo $plugin_url . '/images/no.png'; ?>">
													<p><span class="points">75 votes</span></p>
												</td>
											</tr>
										</table>								
									</li>								
								<?php endfor; ?>

							</ul>
						</div>
						<!-- .inside -->

					</div>
					<!-- .postbox -->

				</div>
				<!-- .meta-box-sortables .ui-sortable -->

			</div>
			<!-- post-body-content -->

			<!-- sidebar -->
			<div id="postbox-container-1" class="postbox-container">

				<div class="meta-box-sortables">

					<div class="postbox">

						<div class="handlediv" title="Click to toggle"><br></div>
						<!-- Toggle -->

						<h2 class="hndle"><span><?php esc_attr_e(
							'About the plugin', 'wp_admin_style'
							); ?></span></h2>

							<div class="inside">
								<p>Run polls on your WordPress posts and pages.</p>
								<p>Syncline Polls uses shortcodes. To display a poll, copy the shortcode below and paste into your post or page.</p>
							</div>
							<!-- .inside -->

						</div>
						<!-- .postbox -->

					</div>
					<!-- .meta-box-sortables -->

				</div>
				<!-- #postbox-container-1 .postbox-container -->

			</div>
			<!-- #post-body .metabox-holder .columns-2 -->

			<br class="clear">
		</div>
		<!-- #poststuff -->

</div> <!-- .wrap -->