var option_html = 
`
<div class="option radio bg-white margin-top-0 margin-bottom-7 padding-10">
    <label class="option-option"><input type="radio" name="option_id" value="" class="option-option"></label>
</div>
`;

var selected_option_html = 
`
<div class="option radio bg-white margin-top-0 margin-bottom-7 padding-10">
    <label class="option-option"><input type="radio" name="option_id" value="" checked class="option-option"></label>
</div>
`;

var timer_html =
`
	<input type="hidden" name="time_limit_remaining">
`

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

// Navigation

$(".previous").click(function(e) {
	e.preventDefault();
	var previous_href = $(".previous-form").attr("action");
	var question_href = $(".previous-form").attr("href");
	$(".previous-form").append(timer_html);
	$("input[name=time_limit_remaining]").val(difference/1000);
	$("input[name=hidden_option_id]").val($("input[name=option_id]:checked").val());
	$.post(previous_href, $(".previous-form").serialize(), function(data) {		
		window.location = question_href;
	});
});

$(".next").click(function(e) {
	e.preventDefault();
	var next_href = $(".next-form").attr("action");
	var question_href = $(".next-form").attr("href");
	$(".next-form").append(timer_html);
	$("input[name=time_limit_remaining]").val(difference/1000);
	$("input[name=hidden_option_id]").val($("input[name=option_id]:checked").val());
	$.post(next_href, $(".next-form").serialize(), function(data) {
		window.location = question_href;
	});
});

$(".finish").click(function(e) {
	e.preventDefault();
	var finish_href = $(".finish-form").attr("action");
	var submit_href = $(".finish-form").attr("href");
	$(".finish-form").append(timer_html);
	$("input[name=time_limit_remaining]").val(difference/1000);
	$("input[name=hidden_option_id]").val($("input[name=option_id]:checked").val());
	$.post(finish_href, $(".finish-form").serialize(), function(data) {
		window.location = submit_href;
	});
});