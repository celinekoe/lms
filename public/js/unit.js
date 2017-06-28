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
			$(".section-download").show();
			$(".section-delete").hide();
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
