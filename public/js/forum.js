$(".thread-delete").click(function(e) {
	e.preventDefault();
	var thread_delete = $(this);
	var thread = thread_delete.parent().parent().parent().parent();
	var href = thread_delete.attr("href");
	open_confirm_delete();
	$(".confirm-text").text("Confirm delete?");
	$(".confirm-option-cancel").off().click(function(e) {
		close_confirm_delete();
	});
	$(".confirm-option-delete").off().click(function(e) {
		close_confirm_delete();
		$.get(href, function(data) {
			thread.hide();
		});
	});
});