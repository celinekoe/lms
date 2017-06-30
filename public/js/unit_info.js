$(".file-download").click(function(e) {
	e.preventDefault();
	var file_download = $(this);
	var href = file_download.attr("href");
	open_confirm_download();
	$(".confirm-text").text("Confirm file download?");
	$(".confirm-option-cancel").click(function(e) {
		e.preventDefault();
		close_confirm_download();
	});
	$(".confirm-option-download").click(function(e) {
		e.preventDefault();
		close_confirm_download();
		$.get(href, function(data) {
			file_download.hide();
			file_download.siblings(".file-delete").show();
		});
	});
});

$(".file-delete").click(function(e) {
	e.preventDefault();
	var file_delete = $(this);
	var href = file_delete.attr("href");
	open_confirm_delete();
	$(".confirm-text").text("Confirm file delete?");
	$(".confirm-option-cancel").click(function(e) {
		e.preventDefault();
		close_confirm_download();
	});
	$(".confirm-option-delete").click(function(e) {
		e.preventDefault();
		close_confirm_download();
		$.get(href, function(data) {
			file_delete.siblings(".file-download").show();
			file_delete.hide();
		});
	});
});