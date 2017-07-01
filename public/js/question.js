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

$(".next").click(function(e) {
	e.preventDefault();
	var href = $(".next-form").attr("action");
	console.log($("input[name=option_id]:checked").val());
	$("input[name=hidden_option_id]").val($("input[name=option_id]:checked").val());
	$.post(href, $(".next-form").serialize(), function(data) {
		change_question(data);
		toggle_navigation(data);
	});
});

$(".previous").click(function(e) {
	e.preventDefault();
	var href = $(".previous-form").attr("action");
	$("input[name=hidden_option_id]").val($("input[name=option_id]:checked").val());
	$.post(href, $(".previous-form").serialize(), function(data) {
		change_question(data);
		toggle_navigation(data);
	});
});

$(document).on('click', '.summary', function(e) {
	e.preventDefault();
	var post_form = $(this).parent().parent();
	var href = post_form.attr("action");
	open_confirm_submit();
	$(".confirm-text").text("Confirm submit?");
	$(".confirm-option-cancel").off().click(function(e) {
		close_confirm_submit();
	});
	$(".confirm-option-submit").off().click(function(e) {
		close_confirm_submit();
		$.post(href, post_form.serialize(), function(data) {
			window.location = window.location.href;
		})
		.fail(function(data) {
			var errors = data.responseJSON;
			if (errors.body) {
				var body = post_form.find(":input[name=body]");
				body.parent().addClass("has-error");
				body.siblings(".help-block").show();
				body.siblings(".help-block").text(errors.body[0]);
			}
		});
	});
});

// $(document).on('click', '.submit', function(e) {
// 	e.preventDefault();
// 	var post_form = $(this).parent().parent();
// 	var href = post_form.attr("action");
// 	open_confirm_submit();
// 	$(".confirm-text").text("Confirm submit?");
// 	$(".confirm-option-cancel").off().click(function(e) {
// 		close_confirm_submit();
// 	});
// 	$(".confirm-option-submit").off().click(function(e) {
// 		close_confirm_submit();
// 		$.post(href, post_form.serialize(), function(data) {
// 			window.location = window.location.href;
// 		})
// 		.fail(function(data) {
// 			var errors = data.responseJSON;
// 			if (errors.body) {
// 				var body = post_form.find(":input[name=body]");
// 				body.parent().addClass("has-error");
// 				body.siblings(".help-block").show();
// 				body.siblings(".help-block").text(errors.body[0]);
// 			}
// 		});
// 	});
// });

function change_question(data) {
	$(".current-question-no").text(data.question.question_no);
	$("input[name=current_question_no]").val($(".current-question-no").text());
	$(".question-question").text(data.question.question);
	$(".option").remove();
	data.options.forEach(function(option_data) {
		if (data.question.option_id == option_data.id) {
			$(".options").append(selected_option_html);	
		} else {
			$(".options").append(option_html);
		}
		$("label.option-option").last().append(option_data.option);
		$("input.option-option").last().val(option_data.id);
	});
}

function toggle_navigation(data) {
	if (data.question.has_previous) {
		$(".previous-form").show();
	} else {
		$(".previous-form").hide();
	}
	if (data.question.has_next) {
		$(".next-form").show();
		$(".submit-form").hide();
	} else {
		$(".next-form").hide();
		$(".submit-form").show();
	}
}

// Timer

var time_limit = $(".timer").attr("time-limit");
var start_time = new Date();
var end_time = new Date(start_time.getTime() + time_limit * 1000);
var interval = setInterval(function() {
	var now = new Date();
	var difference = end_time.getTime() - now.getTime();
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
	$(".timer").text("Time Limit " + hours + ":" + minutes + ":" + seconds);
	if (difference < 0) {
		clearInterval(interval);
		$(".timer").text("00:00");
	}
}, 500);