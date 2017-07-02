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