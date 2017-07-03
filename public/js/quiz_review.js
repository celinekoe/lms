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