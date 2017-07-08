$(".unit-info-download").off().click(function(e) {
	e.preventDefault();
	var unit_info_download = $(this);
	var href = unit_info_download.attr("href");
	open_confirm_download();
	$(".confirm-text").text("Confirm unit info download?");
	$(".confirm-option-cancel").off().click(function(e) {
		e.preventDefault();
		close_confirm_download();
	});
	$(".confirm-option-download").off().click(function(e) {
		e.preventDefault();
		close_confirm_download();
		$.get(href, function(data) {
			toggle_unit_info_download(unit_info_download);
		});
	});
});

$(".unit-info-delete").off().click(function(e) {
	e.preventDefault();
	var unit_info_delete = $(this);
	var href = unit_info_delete.attr("href");
	open_confirm_delete();
	$(".confirm-text").text("Confirm unit info delete?");
	$(".confirm-option-cancel").off().click(function(e) {
		e.preventDefault();
		close_confirm_delete();
	});
	$(".confirm-option-delete").off().click(function(e) {
		e.preventDefault();
		close_confirm_delete();
		$.get(href, function(data) {
			toggle_unit_info_delete(unit_info_delete);
		});
	});
});

$(".file-download").off().click(function(e) {
	e.preventDefault();
	var file_download = $(this);
	var href = file_download.attr("href");
	open_confirm_download();
	$(".confirm-text").text("Confirm file download?");
	$(".confirm-option-cancel").off().click(function(e) {
		e.preventDefault();
		close_confirm_download();
	});
	$(".confirm-option-download").off().click(function(e) {
		e.preventDefault();
		close_confirm_download();
		$.get(href, function(data) {
			toggle_file_download(file_download);
		});
	});
});

$(".file-delete").off().click(function(e) {
	e.preventDefault();
	var file_delete = $(this);
	var href = file_delete.attr("href");
	open_confirm_delete();
	$(".confirm-text").text("Confirm file delete?");
	$(".confirm-option-cancel").off().click(function(e) {
		e.preventDefault();
		close_confirm_delete();
	});
	$(".confirm-option-delete").off().click(function(e) {
		e.preventDefault();
		close_confirm_delete();
		$.get(href, function(data) {
			toggle_file_delete(file_delete);
		});
	});
});

// Toggle unit info download/delete

function toggle_unit_info_download(unit_info_download) {
	unit_info_download.hide();
	unit_info_download.siblings(".unit-info-delete").show();
	$(".file-download").hide();
	$(".file-delete").show();
}

function toggle_unit_info_delete(unit_info_delete) {
	unit_info_delete.siblings(".unit-info-download").show();
	unit_info_delete.hide();
	$(".file-download").show();
	$(".file-delete").hide();
}

// Toggle file download/delete

function toggle_file_download(file_download) {

	file_download.hide();
	file_download.siblings(".file-delete").show();

	is_unit_info_downloaded = true;
	$(".file-download").each(function() {
		if ($(this).is(":visible")) {
			is_unit_info_downloaded = false;
		}
	});
	if (is_unit_info_downloaded) {
		$(".unit-info-download").hide();
		$(".unit-info-delete").show();
	}
}

function toggle_file_delete(file_delete) {
	
	file_delete.siblings(".file-download").show();
	file_delete.hide();
	
	is_unit_info_downloaded = true;
	$(".file-download").each(function() {
		if ($(this).is(":visible")) {
			is_unit_info_downloaded = false;
		}
	});
	if (!is_unit_info_downloaded) {
		$(".unit-info-download").show();
		$(".unit-info-delete").hide();
	}
}