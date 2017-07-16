$(".unit-open").click(function(e) {
	e.preventDefault();
	$(this).parent().parent().siblings(".unit-files").toggle();
});

$(".assignments-open").click(function(e) {
	e.preventDefault();
	$(this).parent().parent().siblings(".assignments-files").toggle();
});

$(".sections-open").click(function(e) {
	e.preventDefault();
	$(this).parent().parent().siblings(".sections-files").toggle();
});

$(".unit-download").off().click(function(e) {
	e.preventDefault();
	var unit_download = $(this);
	var href = unit_download.attr("href");
	open_confirm_download();
	$(".confirm-text").text("Confirm unit download?");
	$(".confirm-option-cancel").off().click(function(e) {
		e.preventDefault();
		close_confirm_download();
	});
	$(".confirm-option-download").off().click(function(e) {
		e.preventDefault();
		close_confirm_download();
		$.get(href, function(data) {
			toggle_unit_download(unit_download);
		});
	});
});

$(".unit-delete").off().click(function(e) {
	e.preventDefault();
	var unit_delete = $(this);
	var href = unit_delete.attr("href");
	open_confirm_delete();
	$(".confirm-text").text("Confirm unit delete?");
	$(".confirm-option-cancel").off().click(function(e) {
		e.preventDefault();
		close_confirm_delete();
	});
	$(".confirm-option-delete").off().click(function(e) {
		e.preventDefault();
		close_confirm_delete();
		$.get(href, function(data) {
			toggle_unit_delete(unit_delete);
		});
	});
});

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
		console.log(href);
		$.get(href, function(data) {
			toggle_unit_info_delete(unit_info_delete);
		});
	});
});

$(".assignments-download").off().click(function(e) {
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

$(".assignment-delete").off().click(function(e) {
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

$(".sections-download").off().click(function(e) {
	e.preventDefault();
	var sections_download = $(this);
	var href = sections_download.attr("href");
	open_confirm_download();
	$(".confirm-text").text("Confirm sections download?");
	$(".confirm-option-cancel").off().click(function(e) {
		e.preventDefault();
		close_confirm_download();
	});
	$(".confirm-option-download").off().click(function(e) {
		e.preventDefault();
		close_confirm_download();
		$.get(href, function(data) {
			toggle_sections_download(sections_download);
		});
	});
});

$(".sections-delete").off().click(function(e) {
	e.preventDefault();
	var sections_delete = $(this);
	var href = sections_delete.attr("href");
	open_confirm_delete();
	$(".confirm-text").text("Confirm sections delete?");
	$(".confirm-option-cancel").off().click(function(e) {
		e.preventDefault();
		close_confirm_delete();
	});
	$(".confirm-option-delete").off().click(function(e) {
		e.preventDefault();
		close_confirm_delete();
		$.get(href, function(data) {
			toggle_sections_delete(sections_delete);
		});
	});
});

$(".section-download").off().click(function(e) {
	e.preventDefault();
	var section_download = $(this);
	var href = section_download.attr("href");
	open_confirm_download();
	$(".confirm-text").text("Confirm section download?");
	$(".confirm-option-cancel").off().click(function(e) {
		e.preventDefault();
		close_confirm_download();
	});
	$(".confirm-option-download").off().click(function(e) {
		e.preventDefault();
		close_confirm_download();
		$.get(href, function(data) {
			toggle_section_download(section_download);
		});
	});
});

$(".section-delete").off().click(function(e) {
	e.preventDefault();
	var section_delete = $(this);
	var href = section_delete.attr("href");
	open_confirm_delete();
	$(".confirm-text").text("Confirm section delete?");
	$(".confirm-option-cancel").off().click(function(e) {
		e.preventDefault();
		close_confirm_delete();
	});
	$(".confirm-option-delete").off().click(function(e) {
		e.preventDefault();
		close_confirm_delete();
		$.get(href, function(data) {
			toggle_section_delete(section_delete);
		});
	});
});


// Toggle unit download/delete

function toggle_unit_download(unit_download)
{
	unit_download.hide();
	unit_download.siblings(".unit-delete").show();
	$(".unit-info-download").hide();
	$(".unit-info-delete").show();
	$(".sections-download").hide();
	$(".sections-delete").show();
	$(".section-download").hide();
	$(".section-delete").show();
	$(".assignments-download").hide();
	$(".assignments-delete").show();
	$(".assignment-download").hide();
	$(".assignment-delete").show();
}

function toggle_unit_delete(unit_delete)
{
	unit_delete.siblings(".unit-download").show();
	unit_delete.hide();
	$(".unit-info-download").show();
	$(".unit-info-delete").hide();
	$(".sections-download").show();
	$(".sections-delete").hide();
	$(".section-download").show();
	$(".section-delete").hide();
	$(".assignments-download").show();
	$(".assignments-delete").hide();
	$(".assignment-download").show();
	$(".assignment-delete").hide();
}

// Toggle unit info download/delete

function toggle_unit_info_download(unit_info_download) {

	unit_info_download.hide();
	unit_info_download.siblings(".unit-info-delete").show();

	var unit_download = unit_info_download.parent().parent().parent().parent().find(".unit-download");
	toggle_unit_downloaded(unit_download);

}

function toggle_unit_info_delete(unit_info_delete) {

	unit_info_delete.siblings(".unit-info-download").show();
	unit_info_delete.hide();

	var unit_delete = unit_info_delete.parent().parent().parent().parent().find(".unit-delete");
	toggle_unit_deleted(unit_delete);

}

function toggle_unit_downloaded(unit_download)
{
	unit_download.siblings(".unit-delete").show();

	var unit_info_download = unit_download.parent().parent().parent().find(".unit-info-download");
	var assignments_download = unit_download.parent().parent().parent().find(".assignments-download");
	var sections_download = unit_download.parent().parent().parent().find(".sections-download");

	var is_unit_downloaded = !(unit_info_download.is(":visible") ||  
		assignments_download.is(":visible") || sections_download.is(":visible"));

	if (is_unit_downloaded) {
		unit_download.hide();
	}
}

function toggle_unit_deleted(unit_delete)
{
	unit_delete.siblings(".unit-download").show();

	var unit_info_delete = unit_delete.parent().parent().parent().find(".unit-info-delete");
	var assignments_delete = unit_delete.parent().parent().parent().find(".assignments-delete");
	var sections_delete = unit_delete.parent().parent().parent().find(".sections-delete");

	var is_unit_deleted = !(unit_info_delete.is(":visible") ||  
		assignments_delete.is(":visible") || sections_delete.is(":visible"));

	alert(is_unit_deleted);

	if (is_unit_deleted) {
		unit_delete.hide();
	}
}


// Toggle assignments download/delete

function toggle_assignments_download(assignments_download) {

	assignments_download.hide();
	assignments_download.siblings(".assignments-delete").show();

	var unit_download = assignments_download.parent().parent().parent().parent().parent().find(".unit-download");
	toggle_unit_downloaded(unit_download);

	var assignment_downloads = assignments_download.parent().parent().parent().find(".assignment-download");
	var assignment_deletes = assignments_download.parent().parent().parent().find(".assignment-delete");
	assignment_downloads.hide();
	assignment_deletes.show();

}

function toggle_assignments_delete(assignments_delete) {

	assignments_delete.siblings(".assignments-download").show();
	assignments_delete.hide();

	var unit_delete = assignments_delete.parent().parent().parent().parent().parent().find(".unit-delete");
	toggle_unit_deleted(unit_delete);

	var assignment_downloads = assignments_delete.parent().parent().parent().find(".assignment-download");
	var assignment_deletes = assignments_delete.parent().parent().parent().find(".assignment-delete");
	assignment_downloads.show();
	assignment_deletes.hide();

}

// Toggle assignment download/delete

function toggle_assignment_download(assignment_download) {

	assignment_download.hide();
	assignment_download.siblings(".assignment-delete").show();

	toggle_assignments_downloaded(assignment_download);

	var unit_download = assignment_download.parent().parent().parent().parent().parent().parent().find(".unit-download");	
	toggle_unit_downloaded(unit_download);

}

function toggle_assignment_delete(assignment_delete) {

	assignment_delete.siblings(".assignment-download").show();
	assignment_delete.hide();

	toggle_assignments_deleted(assignment_delete);

	var unit_delete = assignment_delete.parent().parent().parent().parent().parent().parent().find(".unit-delete");
	toggle_unit_deleted(unit_delete);
}


function toggle_assignments_downloaded(assignment_download)
{
	var assignments_download = assignment_download.parent().parent().parent().parent().find(".assignments-download");
	var assignment_downloads = assignment_download.parent().parent().parent().find(".assignment-download");

	var is_assignments_downloaded = true;
	assignment_downloads.each(function() {
		if ($(this).is(":visible")) {
			is_assignments_downloaded = false;
		}
	});

	if (is_assignments_downloaded) {
		assignments_download.hide();
		assignments_download.siblings(".assignments-delete").show();
	}
}

function toggle_assignments_deleted(assignment_delete)
{
	assignment_delete.parent().parent().parent().parent().find(".assignments-download").show();
	assignment_delete.parent().parent().parent().parent().find(".assignments-delete").hide();
}

// Toggle sections download/delete

function toggle_sections_download(sections_download) {

	sections_download.hide();
	sections_download.siblings(".sections-delete").show();

	var unit_download = sections_download.parent().parent().parent().parent().parent().find(".unit-download");
	toggle_unit_downloaded(unit_download);

	var section_downloads = sections_download.parent().parent().parent().find(".section-download");
	var section_deletes = sections_download.parent().parent().parent().find(".section-delete");
	section_downloads.hide();
	section_deletes.show();

}

function toggle_sections_delete(sections_delete) {

	sections_delete.siblings(".sections-download").show();
	sections_delete.hide();

	var unit_delete = sections_delete.parent().parent().parent().parent().parent().find(".unit-delete");
	toggle_unit_deleted(unit_delete);

	var section_downloads = sections_delete.parent().parent().parent().find(".section-download");
	var section_deletes = sections_delete.parent().parent().parent().find(".section-delete");
	section_downloads.show();
	section_deletes.hide();

}

// Toggle section download/delete

function toggle_section_download(section_download) {

	section_download.hide();
	section_download.siblings(".section-delete").show();

	toggle_sections_downloaded(section_download);

	var unit_download = section_download.parent().parent().parent().parent().parent().parent().find(".unit-download");
	toggle_unit_downloaded(unit_download);

}

function toggle_section_delete(section_delete) {

	section_delete.siblings(".section-download").show();
	section_delete.hide();

	toggle_sections_deleted(section_delete);

	var unit_delete = section_delete.parent().parent().parent().parent().parent().parent().find(".unit-delete");
	toggle_unit_deleted(unit_delete);

}

function toggle_sections_downloaded(section_download)
{
	var sections_download = section_download.parent().parent().parent().parent().find(".sections-download");
	sections_download.siblings(".sections-delete").show();

	var section_downloads = section_download.parent().parent().parent().find(".section-download");

	var is_sections_downloaded = true;
	section_downloads.each(function() {
		if ($(this).is(":visible")) {
			is_sections_downloaded = false;
		}
	});

	if (is_sections_downloaded) {
		sections_download.hide();
	}
}

function toggle_sections_deleted(section_delete)
{
	var sections_delete = section_delete.parent().parent().parent().parent().find(".sections-delete");
	sections_delete.siblings(".sections-download").show();

	var section_deletes = section_delete.parent().parent().parent().find(".section-delete");

	var is_sections_deleted = true;
	section_deletes.each(function() {
		if ($(this).is(":visible")) {
			is_sections_deleted = false;
		}
	});

	if (is_sections_deleted) {
		sections_delete.hide();
	}
}