$(".assignments-download").click(function(e) {
	e.preventDefault();
	var assignments_download = $(this);
	var href = assignments_download.attr("href");
	open_confirm_download();
	$(".confirm-text").text("Confirm assignments download?");
	$(".confirm-option-cancel").off().click(function(e) {
		e.preventDefault();
		close_confirm_download();
	});
	$(".confirm-option-download").off().click(function(e) {
		e.preventDefault();
		close_confirm_download();
		$.get(href, function(data) {
			toggle_assignments_download(assignments_download);
		});
	});
});

$(".assignments-delete").click(function(e) {
	e.preventDefault();
	var assignments_delete = $(this);
	var href = assignments_delete.attr("href");
	open_confirm_delete();
	$(".confirm-text").text("Confirm assignments delete?");
	$(".confirm-option-cancel").off().click(function(e) {
		e.preventDefault();
		close_confirm_delete();
	});
	$(".confirm-option-delete").off().click(function(e) {
		e.preventDefault();
		close_confirm_delete();
		$.get(href, function(data) {
			toggle_assignments_delete(assignments_delete);
		});
	});
});

$(".assignment-download").click(function(e) {
	e.preventDefault();
	var assignment_download = $(this);
	var href = assignment_download.attr("href");
	open_confirm_download();
	$(".confirm-text").text("Confirm assignment download?");
	$(".confirm-option-cancel").off().click(function(e) {
		e.preventDefault();
		close_confirm_download();
	});
	$(".confirm-option-download").off().click(function(e) {
		e.preventDefault();
		close_confirm_download();
		$.get(href, function(data) {
			toggle_assignment_download(assignment_download);
		});
	});
});

$(".assignment-delete").click(function(e) {
	e.preventDefault();
	var assignment_delete = $(this);
	var href = assignment_delete.attr("href");
	open_confirm_delete();
	$(".confirm-text").text("Confirm assignment delete?");
	$(".confirm-option-cancel").off().click(function(e) {
		e.preventDefault();
		close_confirm_delete();
	});
	$(".confirm-option-delete").off().click(function(e) {
		e.preventDefault();
		close_confirm_delete();
		$.get(href, function(data) {
			toggle_assignment_delete(assignment_delete);
		});
	});
});

$(".file-download").click(function(e) {
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

$(".file-delete").click(function(e) {
	e.preventDefault();
	var file_delete = $(this);
	var href = file_delete.attr("href");
	open_confirm_delete();
	$(".confirm-text").text("Confirm file delete?");
	$(".confirm-option-cancel").off().click(function(e) {
		e.preventDefault();
		close_confirm_download();
	});
	$(".confirm-option-delete").off().click(function(e) {
		e.preventDefault();
		close_confirm_download();
		$.get(href, function(data) {
			toggle_file_delete(file_delete);
		});
	});
});

// Toggle assignments download/delete

function toggle_assignments_download(assignments_download) {
	assignments_download.hide();
	assignments_download.siblings(".assignments-delete").show();
	$(".assignment-download").hide();
	$(".assignment-delete").show();
	$(".file-download").hide();
	$(".file-delete").show();
}

function toggle_assignments_delete(assignments_delete) {
	assignments_delete.siblings(".assignments-download").show();
	assignments_delete.hide();
	$(".assignment-download").show();
	$(".assignment-delete").hide();
	$(".file-download").show();
	$(".file-delete").hide();
}

// Toggle assignment download/delete

function toggle_assignment_download(assignment_download) {

	assignment_download.hide();
	assignment_download.siblings(".assignment-delete").show();
	assignment_download.parent().parent().parent().parent().find(".file-download").hide();
	assignment_download.parent().parent().parent().parent().find(".file-delete").show();
	
	var is_assignments_downloaded = true;
	$(".assignment-download").each(function() {
		if ($(this).is(":visible")) {
			is_assignments_downloaded = false;
		}
	});
	if (is_assignments_downloaded) {
		$(".assignments-download").hide();
		$(".assignments-delete").show();
	}
}

function toggle_assignment_delete(assignment_delete) {

	assignment_delete.siblings(".assignment-download").show();
	assignment_delete.hide();
	assignment_delete.parent().parent().parent().parent().find(".file-download").show();
	assignment_delete.parent().parent().parent().parent().find(".file-delete").hide();
	
	var is_assignments_downloaded = true;
	$(".assignment-download").each(function() {
		if ($(this).is(":visible")) {
			is_assignments_downloaded = false;
		}
	});
	if (!is_assignments_downloaded) {
		$(".assignments-download").show();
		$(".assignments-delete").hide();
	}
}

// Toggle file download/delete

function toggle_file_download(file_download) {

	file_download.hide();
	file_download.siblings(".file-delete").show();

	var assignment_download = file_download.parent().parent().parent().parent().parent().find(".assignment-download");
	var file_downloads = file_download.parent().parent().parent().parent().find(".file-download");

	var is_assignment_downloaded = true;
	file_downloads.each(function() {
		if ($(this).is(":visible")) {
			is_assignment_downloaded = false;
		}
	});
	if (is_assignment_downloaded) {
		assignment_download.hide();
		assignment_download.siblings(".assignment-delete").show();
	}

	var is_assignments_downloaded = true;
	$(".assignment-download").each(function() {
		if ($(this).is(":visible")) {
			is_assignments_downloaded = false;
		}
	});
	if (is_assignments_downloaded) {
		$(".assignments-download").hide();
		$(".assignments-delete").show();
	}
}

function toggle_file_delete(file_delete) {
	
	file_delete.siblings(".file-download").show();
	file_delete.hide();

	var file_download = file_delete.siblings(".file-download");
	var assignment_download = file_download.parent().parent().parent().parent().parent().find(".assignment-download");
	var file_downloads = file_download.parent().parent().parent().parent().find(".file-download");

	var is_assignment_downloaded = true;
	file_downloads.each(function() {
		if ($(this).is(":visible")) {
			is_assignment_downloaded = false;
		}
	});
	if (!is_assignment_downloaded) {
		assignment_download.show();
		assignment_download.siblings(".assignment-delete").hide();
	}
	
	is_assignments_downloaded = true;
	$(".assignment-download").each(function() {
		if ($(this).is(":visible")) {
			is_assignments_downloaded = false;
		}
	});
	if (!is_assignments_downloaded) {
		$(".assignments-download").show();
		$(".assignments-delete").hide();
	}
}

$(".glyphicon-chevron-down").click(function(e) {
	e.preventDefault();
	console.log();
	$(this).parent().parent().parent().parent().find(".assignment-files").toggle();
});