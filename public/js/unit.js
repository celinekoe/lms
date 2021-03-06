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

function toggle_unit_download(unit_download) {

	unit_download.hide();
	unit_download.siblings(".unit-delete").show();

	$(".sections-download").hide();
	$(".sections-delete").show();
	$(".section-download").hide();
	$(".section-delete").show();

}

function toggle_unit_delete(unit_delete) {

	unit_delete.siblings(".unit-download").show();
	unit_delete.hide();

	$(".sections-download").show();
	$(".sections-delete").hide();
	$(".section-download").show();
	$(".section-delete").hide();

}

function toggle_sections_download(sections_download) {

	sections_download.hide();
	sections_download.siblings(".sections-delete").show();

	var is_unit_downloaded = $(".unit-info-is-downloaded").length && 
		$(".assignments-is-downloaded").length;
	if (is_unit_downloaded) {
		$(".unit-download").hide();
		$(".unit-delete").show();
	}

	$(".section-download").hide();
	$(".section-delete").show();

}

function toggle_sections_delete(sections_delete) {

	sections_delete.siblings(".sections-download").show();
	sections_delete.hide();

	$(".unit-download").show();
	$(".unit-delete").hide();

	$(".section-download").show();
	$(".section-delete").hide();

}

function toggle_section_download(section_download) {

	section_download.hide();
	section_download.siblings(".section-delete").show();

	var is_sections_downloaded = true;
	$(".section-download").each(function() {
		if ($(this).is(":visible")) {
			is_sections_downloaded = false;
		}
	})
	if (is_sections_downloaded) {
		$(".sections-download").hide();
		$(".sections-delete").show();
	}

	var is_unit_downloaded = $(".unit-info-is-downloaded").length && 
		$(".assignments-is-downloaded").length && is_sections_downloaded;

	if (is_unit_downloaded) {
		$(".unit-download").hide();
		$(".unit-delete").show();
	}

}

function toggle_section_delete(section_delete) {
	
	section_delete.siblings(".section-download").show();
	section_delete.hide();

	$(".sections-download").show();
	$(".sections-delete").hide();

	$(".unit-download").show();
	$(".unit-delete").hide();

}