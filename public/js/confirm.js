function open_confirm_start() {
	$(".confirm-container").show();
	$(".confirm-start").show();
	$(".confirm-retry").hide();
}

function close_confirm_start() {
	$(".confirm-container").hide();
}

function open_confirm_retry() {
	$(".confirm-container").show();
	$(".confirm-start").hide();
	$(".confirm-retry").show();
}

function close_confirm_retry() {
	$(".confirm-container").hide();
}

function open_confirm_download() {
	$(".confirm-container").show();
	$(".confirm-download").show();
	$(".confirm-delete").hide();
}

function close_confirm_download() {
	$(".confirm-container").hide();
}

function open_confirm_delete() {
	$(".confirm-container").show();
	$(".confirm-download").hide();
	$(".confirm-delete").show();
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