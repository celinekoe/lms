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

// Navigation

$(".link").off().click(function(e) {
	e.preventDefault();
	var link_form = $(this).parent();
	var link_href = link_form.attr("action");
	var question_href = link_form.attr("href");
	link_form.append(timer_html);
	$("input[name=time_limit_remaining]").val(difference/1000);
	$("input[name=hidden_option_id]").val($("input[name=option_id]:checked").val());
	$.post(link_href, link_form.serialize(), function(data) {		
		window.location = question_href;
	});
});

$(".previous").off().click(function(e) {
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

$(".next").off().click(function(e) {
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

$(".review").off().click(function(e) {
	e.preventDefault();
	var review_href = $(".review-form").attr("action");
	var submit_href = $(".review-form").attr("href");
	$(".review-form").append(timer_html);
	$("input[name=time_limit_remaining]").val(difference/1000);
	$("input[name=hidden_option_id]").val($("input[name=option_id]:checked").val());
	$.post(review_href, $(".review-form").serialize(), function(data) {
		window.location = submit_href;
	});
});

$(".submit").off().click(function(e) {
	e.preventDefault();
	var submit_href = $(".submit-form").attr("action");
	var summary_href = $(".submit-form").attr("href");
	open_confirm_submit();
	$(".confirm-text").text("Confirm submit?");
	$(".confirm-option-cancel").off().click(function(e) {
		close_confirm_submit();
	});
	$(".confirm-option-submit").off().click(function(e) {
		close_confirm_submit();
		$.post(submit_href, $(".submit-form").serialize(), function(data) {
			window.location = summary_href;
		});
	});
});