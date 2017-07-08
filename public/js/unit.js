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
			unit_download.hide();
			unit_download.siblings(".unit-delete").show();
			$(".sections-download").hide();
			$(".sections-delete").show();
			$(".section-download").hide();
			$(".section-delete").show();
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
			unit_delete.siblings(".unit-download").show();
			unit_delete.hide();
			$(".sections-download").hide();
			$(".sections-delete").show();
			$(".section-download").show();
			$(".section-delete").hide();
		});
	});
});

$(".sections-download").click(function(e) {
	e.preventDefault();
	var sections_download = $(this);
	var href = sections_download.attr("href");
	open_confirm_download();
	$(".confirm-text").text("Confirm sections download?");
	$(".confirm-option-cancel").click(function(e) {
		e.preventDefault();
		close_confirm_download();
	});
	$(".confirm-option-download").click(function(e) {
		e.preventDefault();
		close_confirm_download();
		$.get(href, function(data) {
			toggle_sections_download(sections_download);
		});
	});
});

$(".sections-delete").click(function(e) {
	e.preventDefault();
	var sections_delete = $(this);
	var href = sections_delete.attr("href");
	open_confirm_delete();
	$(".confirm-text").text("Confirm sections delete?");
	$(".confirm-option-cancel").click(function(e) {
		e.preventDefault();
		close_confirm_delete();
	});
	$(".confirm-option-delete").click(function(e) {
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