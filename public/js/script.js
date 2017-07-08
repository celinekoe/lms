$(".reset").off().click(function(e) {
	var reset = $(this);
	var href = reset.attr("href");
	open_confirm_reset();
	$(".confirm-text").text("Confirm user reset?");
	$(".confirm-option-cancel").off().click(function(e) {
		close_confirm_reset();
	});
	$(".confirm-option-reset").off().click(function(e) {
		close_confirm_reset();
		$.get(href, function(data) {
			window.location = window.location.href;
		});
	});	
})

$(".sidebar-open").click(function(e) {
	$(".sidebar-container").toggle();
});

$(".sidebar-close").click(function(e) {
	$(".sidebar-container").toggle();
});

$(".sidebar-overlay").click(function(e) {
	$(".sidebar-container").toggle();
});