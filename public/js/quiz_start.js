$(".start").click(function(e) {
	e.preventDefault();
	var start_href = $(".start-form").attr("action");
	var question_href = $(".start-form").attr("href");
	open_confirm_start();
	$(".confirm-text").text("Confirm start?");
	$(".confirm-option-cancel").off().click(function(e) {
		close_confirm_start();
	});
	$(".confirm-option-start").off().click(function(e) {
		close_confirm_start();
		$.post(start_href, $(".start-form").serialize(), function(data) {
			window.location = question_href;
		});
	});
});

$(".retry").click(function(e) {
	e.preventDefault();
	var retry_href = $(".retry-form").attr("action");
	var question_href = $(".retry-form").attr("href");
	open_confirm_retry();
	$(".confirm-text").text("Confirm retry?");
	$(".confirm-option-cancel").off().click(function(e) {
		close_confirm_retry();
	});
	$(".confirm-option-retry").off().click(function(e) {
		close_confirm_retry();
		$.post(retry_href, $(".retry-form").serialize(), function(data) {
			window.location = question_href;
		});
	});
});