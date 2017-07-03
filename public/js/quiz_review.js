var timer_html =
`
	<input type="hidden" name="time_limit_remaining">
`;

// Timer

var time_limit_remaining = $(".timer").attr("time-limit-remaining");
var start_time = new Date();
var end_time = new Date(start_time.getTime() + time_limit_remaining * 1000);
var difference;
var interval = setInterval(function() {
	var now = new Date();
	difference = end_time.getTime() - now.getTime();
	var hours = Math.floor(difference / (60 * 60 * 1000)).toString();
	while (hours.toString().length < 2) {
		hours = "0".concat(hours);
	}
	var minutes = Math.floor(difference % (60 * 60 * 1000) / (60 * 1000));
	while (minutes.toString().length < 2) {
		minutes = "0".concat(minutes);
	}
	var seconds = Math.floor(difference % (60 * 1000) / 1000);
	while (seconds.toString().length < 2) {
		seconds = "0".concat(seconds);
	}
	$(".timer").text("Time Limit Remaining " + hours + ":" + minutes + ":" + seconds);
	if (difference < 0) {
		clearInterval(interval);
		$(".timer").text("Time Limit 00:00");
	}
}, 100);

$(".question").click(function(e) {
	e.preventDefault();
	var save_href = $(".save-form").attr("action");
	var question_href = $(this).attr("href");
	$(".save-form").append(timer_html);
	$("input[name=time_limit_remaining]").val(difference/1000);
	$.post(save_href, $(".save-form").serialize(), function(data) {	
		window.location = question_href;
	});
});

$(".submit").click(function(e) {
	e.preventDefault();
	var submit_href = $(".submit-form").attr("action");
	var end_href = $(".submit-form").attr("href");
	open_confirm_submit();
	$(".confirm-text").text("Confirm submit?");
	$(".confirm-option-cancel").off().click(function(e) {
		close_confirm_submit();
	});
	$(".confirm-option-submit").off().click(function(e) {
		close_confirm_submit();
		$.post(submit_href, $(".submit-form").serialize(), function(data) {
			window.location = end_href;
		});
	});
});