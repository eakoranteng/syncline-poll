jQuery(document).ready(function($) {

	var syncline_yes_btn = $('.syncline-poll .yes .vote-btn'),
		syncline_no_btn = $('.syncline-poll .no .vote-btn'),
		syncline_yes_count = $('.syncline-poll .yes .count'),
		syncline_no_count = $('.syncline-poll .no .count');

	function syncline_poll_submit(feedback, callback) {
		$.post(ajaxurl, {
			action: 'syncline_poll_count',
			feedback: feedback
		}, callback());
	}

	syncline_yes_btn.click(function() {
		var count = Number(syncline_yes_count.html());
		syncline_poll_submit("yes", function(response) {
			count += 1;
			syncline_yes_count.html(count);
		});
	});
	syncline_no_btn.click(function() {
		var count = Number(syncline_no_count.html());
		syncline_poll_submit("no", function(response) {
			count += 1;
			syncline_no_count.html(count);
		});
	});
	// $.post(ajaxurl, {
	// 	action: 'syncline_poll_count',
	// 	feedback: 'no'
	// }, function(response) {
	// 	console.log(response);
	// });

});