// $(".file-download").click(function(e) {
// 	e.preventDefault();
// 	var file_download = $(this);
// 	var href = file_download.attr("href");
// 	open_confirm_download();
// 	$(".confirm-text").text("Confirm file download?");
// 	$(".confirm-option-cancel").click(function(e) {
// 		e.preventDefault();
// 		close_confirm_download();
// 	});
// 	$(".confirm-option-download").click(function(e) {
// 		e.preventDefault();
// 		close_confirm_download();
// 		$.get(href, function(data) {
// 			file_download.hide();
// 			file_download.siblings(".file-delete").show();
// 		});
// 	});
// });

// $(".file-delete").click(function(e) {
// 	e.preventDefault();
// 	var file_delete = $(this);
// 	var href = file_delete.attr("href");
// 	open_confirm_delete();
// 	$(".confirm-text").text("Confirm file delete?");
// 	$(".confirm-option-cancel").click(function(e) {
// 		e.preventDefault();
// 		close_confirm_download();
// 	});
// 	$(".confirm-option-delete").click(function(e) {
// 		e.preventDefault();
// 		close_confirm_download();
// 		$.get(href, function(data) {
// 			file_delete.siblings(".file-download").show();
// 			file_delete.hide();
// 		});
// 	});
// });

function open_confirm_download() {
	$(".confirm-container").show();
	$(".confirm-download").show();
	$(".confirm-delete").hide();
}

function open_confirm_delete() {
	$(".confirm-container").show();
	$(".confirm-download").hide();
	$(".confirm-delete").show();
}

function close_confirm_download() {
	$(".confirm-container").hide();
}

function close_confirm_delete() {
	$(".confirm-container").hide();
}

function open_confirm_submit() {
	$(".confirm-container").show();
	$(".confirm-submit").show();
	$(".confirm-cancel-submit").hide();
}

function open_confirm_cancel_submit() {
	$(".confirm-container").show();
	$(".confirm-submit").hide();
	$(".confirm-cancel-submit").show();
}

function close_confirm_submit() {
	$(".confirm-container").hide();
}

function close_confirm_cancel_submit() {
	$(".confirm-container").hide();
}