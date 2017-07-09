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

$(".unit-download").click(function(e) {
	e.preventDefault();
	var unit_download = $(this);
	var href = unit_download.attr("href");
	open_confirm_download();
	$(".confirm-text").text("Confirm unit download?");
	$(".confirm-option-cancel").click(function(e) {
		e.preventDefault();
		close_confirm_download();
	});
	$(".confirm-option-download").click(function(e) {
		e.preventDefault();
		close_confirm_download();
		$.get(href, function(data) {
			toggle_unit_download(unit_download);
		});
	});
});

$(".unit-delete").click(function(e) {
	e.preventDefault();
	var unit_delete = $(this);
	var href = unit_delete.attr("href");
	open_confirm_delete();
	$(".confirm-text").text("Confirm unit delete?");
	$(".confirm-option-cancel").click(function(e) {
		e.preventDefault();
		close_confirm_delete();
	});
	$(".confirm-option-delete").click(function(e) {
		e.preventDefault();
		close_confirm_delete();
		$.get(href, function(data) {
			toggle_unit_delete(unit_delete);
		});
	});
});

$(".unit-info-download").click(function(e) {
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

$(".unit-info-delete").click(function(e) {
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

$(".section-download").click(function(e) {
	e.preventDefault();
	var section_download = $(this);
	var href = section_download.attr("href");
	open_confirm_download();
	$(".confirm-text").text("Confirm section download?");
	$(".confirm-option-cancel").click(function(e) {
		e.preventDefault();
		close_confirm_download();
	});
	$(".confirm-option-download").click(function(e) {
		e.preventDefault();
		close_confirm_download();
		$.get(href, function(data) {
			section_download.hide();
			section_download.siblings(".section-delete").show();
			var is_unit_downloaded = true;
			$(".section_download").each(function() {
				if ($(this).is(":visible")) {
					is_unit_downloaded = false;
				}
			})
			if (is_unit_downloaded) {
				$(".unit-download").hide();
				$(".unit-delete").show();
			}
		});
	});
});

$(".section-delete").click(function(e) {
	e.preventDefault();
	var section_delete = $(this);
	var href = section_delete.attr("href");
	open_confirm_delete();
	$(".confirm-text").text("Confirm section delete?");
	$(".confirm-option-cancel").click(function(e) {
		e.preventDefault();
		close_confirm_delete();
	});
	$(".confirm-option-delete").click(function(e) {
		e.preventDefault();
		close_confirm_delete();
		$.get(href, function(data) {
			section_delete.siblings(".section-download").show();
			section_delete.hide();
			var is_unit_deleted = true;
			$(".section-delete").each(function() {
				if ($(this).is(":visible")) {
					is_unit_deleted = false;
				}
			})
			if (is_unit_deleted) {
				$(".unit-download").show();
				$(".unit-delete").hide();
			}
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

	toggle_unit_downloaded();

}

function toggle_unit_info_delete(unit_info_delete) {

	unit_info_delete.siblings(".unit-info-download").show();
	unit_info_delete.hide();

	toggle_unit_deleted();

}

// Toggle assignments download/delete

function toggle_assignments_download(assignments_download) {
	assignments_download.hide();
	assignments_download.siblings(".assignments-delete").show();
}

function toggle_assignments_delete(assignments_delete) {
	assignments_delete.siblings(".assignments-download").show();
	assignments_delete.hide();
}

// Toggle sections download/delete

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

// Other helper functions

function toggle_unit_downloaded()
{
	var is_unit_downloaded = $(".unit-info-delete").length && 
		$(".assignments-delete").length && $(".sections-delete").length;

	if (is_unit_downloaded) {
		$(".unit-download").hide();
		$(".unit-delete").show();
	}
}

function toggle_unit_deleted()
{
	$(".unit-download").show();
	$(".unit-delete").hide();
}