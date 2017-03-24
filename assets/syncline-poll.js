jQuery(document).ready(function($) {

	function syncline_poll_submit(feedback) {
		$('.syncline-poll .vote').slideUp('slow');
		$.post(ajaxurl, {
			action: 'syncline_poll_count',
			feedback: feedback,
		}, function(response) {
			$('.syncline-poll .feedback, .syncline-poll .progress').slideDown('slow');
			var data = JSON.parse(response);
			console.log(data.yes);
			$(".syncline-poll .yes progress").val(data.yes);
			$(".syncline-poll .yes .percent").html(data.yes);
			$(".syncline-poll .no progress").val(data.no);
			$(".syncline-poll .no .percent").html(data.no);
		});
	}

	$('.syncline-poll .yes .vote-btn').click(function() {
		syncline_poll_submit("yes");
	});
	$('.syncline-poll .no .vote-btn').click(function() {
		syncline_poll_submit("no");
	});

});
