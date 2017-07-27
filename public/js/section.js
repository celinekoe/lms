// Section tabs

$(".introduction-tab-header").click(function(e) {
	if ($(this).hasClass("bg-white")) {
		$(".section-tab-header").addClass("bg-white");
		$(".section-tab-header").removeClass("bg-primary");
		$(this).removeClass("bg-white");
		$(this).addClass("bg-primary");	
		$(".tab-body").hide();
		$(".introduction-tab-body").show();
	} else {
		$(this).removeClass("bg-primary");
		$(this).addClass("bg-white");
		$(".introduction-tab-body").hide();
	}
});

$(".guidelines-tab-header").click(function(e) {
	if ($(this).hasClass("bg-white")) {
		$(".section-tab-header").addClass("bg-white");
		$(".section-tab-header").removeClass("bg-primary");
		$(this).removeClass("bg-white");
		$(this).addClass("bg-primary");	
		$(".tab-body").hide();
		$(".guidelines-tab-body").show();
	} else {
		$(this).removeClass("bg-primary");
		$(this).addClass("bg-white");
		$(".guidelines-tab-body").hide();
	}
});

$(".learning-outcomes-tab-header").click(function(e) {
	if ($(this).hasClass("bg-white")) {
		$(".section-tab-header").addClass("bg-white");
		$(".section-tab-header").removeClass("bg-primary");
		$(this).removeClass("bg-white");
		$(this).addClass("bg-primary");	
		$(".tab-body").hide();
		$(".learning-outcomes-tab-body").show();
	} else {
		$(this).removeClass("bg-primary");
		$(this).addClass("bg-white");
		$(".learning-outcomes-tab-body").hide();
	}
});

$(".resources-tab-header").click(function(e) {
	if ($(this).hasClass("bg-white")) {
		$(".section-tab-header").addClass("bg-white");
		$(".section-tab-header").removeClass("bg-primary");
		$(this).removeClass("bg-white");
		$(this).addClass("bg-primary");	
		$(".tab-body").hide();
		$(".resources-tab-body").show();
	} else {
		$(this).removeClass("bg-primary");
		$(this).addClass("bg-white");
		$(".resources-tab-body").hide();
	}
});

// Section mark as complete and incomplete

var section_progress = $(".section-progress");

$(document).on('click','.complete',function(e){
	e.preventDefault();
	var href = $(this).attr("href");
	var complete = $(this);
	$.get(href, function(data) {
		complete.hide();
		complete.siblings(".incomplete").show();
		var new_section_progress = `<div class="section-progress c100 p` + data.section_progress + ` ` + `
		font-size-228em green"><div class="slice"><div class="bar"></div><div class="fill"></div></div></div>`
		$(".section-progress").replaceWith(new_section_progress);
		var new_subsection_progress = `<div class="subsection-progress c100 p` + data.subsection_progress + ` ` + `
		font-size-171em green"><div class="slice"><div class="bar"></div><div class="fill"></div></div></div>`
		$(".subsection-progress").replaceWith(new_subsection_progress);
	});
});

$(document).on('click','.incomplete',function(e){
	e.preventDefault();
	var href = $(this).attr("href");
	var incomplete = $(this);
	$.get(href, function(data) {
		incomplete.siblings(".complete").show();
		incomplete.hide();
		var new_section_progress = `<div class="section-progress c100 p` + data.section_progress + ` ` + `
		font-size-228em green"><div class="slice"><div class="bar"></div><div class="fill"></div></div></div>`
		$(".section-progress").replaceWith(new_section_progress);
		var new_subsection_progress = `<div class="subsection-progress c100 p` + data.subsection_progress + ` ` + `
		font-size-171em green"><div class="slice"><div class="bar"></div><div class="fill"></div></div></div>`
		$(".subsection-progress").replaceWith(new_subsection_progress);
	});
});


// Section download and delete

$(".section-download").click(function(e) {
	e.preventDefault();
	var section_download = $(this);
	var href = section_download.attr("href");
	open_confirm_download();
	$(".confirm-text").text("Confirm section download?");
	$(".confirm-option-cancel").off().click(function(e) {
		close_confirm_download();
	});
	$(".confirm-option-download").off().click(function(e) {
		close_confirm_download();
		$.get(href, function(data) {
			toggle_section_download(section_download);
		});
	});
});

$(".section-delete").click(function(e) {
	e.preventDefault();
	var section_delete = $(this);
	var href = section_delete.attr("href");
	open_confirm_delete();
	$(".confirm-text").text("Confirm section delete?");
	$(".confirm-option-cancel").off().click(function(e) {
		close_confirm_delete();
	});
	$(".confirm-option-delete").off().click(function(e) {
		close_confirm_delete();
		$.get(href, function(data) {
			toggle_section_delete(section_delete);
		});
	});
});

$(".subsection-download").click(function(e) {
	e.preventStopPropagation();
	var subsection_download = $(this);
	var href = subsection_download.attr("href");
	open_confirm_download();
	$(".confirm-text").text("Confirm subsection download?");
	$(".confirm-option-cancel").off().click(function(e) {
		close_confirm_download();
	});
	$(".confirm-option-download").off().click(function(e) {
		close_confirm_download();
		$.get(href, function(data) {
			toggle_subsection_download(subsection_download);
		});
	});
});

$(".subsection-delete").click(function(e) {
	e.preventStopPropagation();
	var href = $(this).attr("href");
	var subsection_delete = $(this);
	open_confirm_delete();
	$(".confirm-text").text("Confirm subsection delete?");
	$(".confirm-option-cancel").off().click(function(e) {
		close_confirm_delete();
	});
	$(".confirm-option-delete").off().click(function(e) {
		close_confirm_delete();
		$.get(href, function(data) {
			toggle_subsection_delete(subsection_delete);
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
		close_confirm_download();
	});
	$(".confirm-option-download").off().click(function(e) {
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
		close_confirm_delete();
	});
	$(".confirm-option-delete").off().click(function(e) {
		close_confirm_delete();
		$.get(href, function(data) {
			toggle_file_delete(file_delete);
		});
	});
});

// Toggle section

$(".glyphicon-chevron-down").off().click(function(e) {
	$(this).parent().parent().parent().find(".subsection-files").toggle();
	$(this).parent().parent().parent().find(".subsection-quizzes").toggle();
});

$(".subsection").off().click(function(e) {
	$(this).parent().find(".subsection-files").toggle();
	$(this).parent().find(".subsection-quizzes").toggle();
});

// Toggle section download/delete

function toggle_section_download(section_download) {
	$(".section-download").hide();
	$(".section-delete").show();
	$(".subsection-download").hide();
	$(".subsection-delete").show();
	$(".file-download").hide();
	$(".file-delete").show();
}

function toggle_section_delete(section_delete) {
	$(".section-download").show();
	$(".section-delete").hide();
	$(".subsection-download").show();
	$(".subsection-delete").hide();
	$(".file-download").show();
	$(".file-delete").hide();
}

// Toggle subsection download/delete

function toggle_subsection_download(subsection_download) {
	subsection_download.hide();
	subsection_download.siblings(".subsection-delete").show();
	subsection_download.parent().parent().parent().siblings(".subsection-files").find(".file-download").hide();
	subsection_download.parent().parent().parent().siblings(".subsection-files").find(".file-delete").show();
	is_section_downloaded = true;
	$(".subsection-download").each(function() {
		if ($(this).is(":visible")) {
			is_section_downloaded = false;
		}
	});
	if (is_section_downloaded) {
		$(".section-download").hide();
		$(".section-delete").show();
	}
}

function toggle_subsection_delete(subsection_delete) {
	subsection_delete.siblings(".subsection-download").show();
	subsection_delete.hide();
	subsection_delete.parent().parent().parent().siblings(".subsection-files").find(".file-download").show();
	subsection_delete.parent().parent().parent().siblings(".subsection-files").find(".file-delete").hide();
	is_section_downloaded = true;
	$(".subsection-download").each(function() {
		if ($(this).is(":visible")) {
			is_section_downloaded = false;
		}
	});
	if (!is_section_downloaded) {
		$(".section-download").show();
		$(".section-delete").hide();
	}
}

// Toggle file download/delete

function toggle_file_download(file_download) {
	
	file_download.hide();
	file_download.siblings(".file-delete").show();

	var subsection_download = file_download.parent().parent().parent().parent().parent().parent().find(".subsection-download");
	var file_downloads = file_download.parent().parent().parent().parent().parent().find(".file-download");
	
	var is_subsection_downloaded = true;
	file_downloads.each(function() {
		if ($(this).is(":visible")) {
			is_subsection_downloaded = false;
		}
	});
	if (is_subsection_downloaded) {
		subsection_download.hide();
		subsection_download.siblings(".subsection-delete").show();
	}

	var is_section_downloaded = true;
	$(".subsection-download").each(function() {
		if ($(this).is(":visible")) {
			is_section_downloaded = false;
		}
	});
	if (is_section_downloaded) {
		$(".section-download").hide();
		$(".section-delete").show();
	}
}

function toggle_file_delete(file_delete) {
	
	file_delete.siblings(".file-download").show();
	file_delete.hide();

	var file_download = file_delete.siblings(".file-download");
	var subsection_download = file_download.parent().parent().parent().parent().parent().parent().find(".subsection-download");
	var file_downloads = file_download.parent().parent().parent().parent().parent().find(".file-download");
	
	var is_subsection_downloaded = true;
	file_downloads.each(function() {
		if ($(this).is(":visible")) {
			is_subsection_downloaded = false;
		}
	});
	if (!is_subsection_downloaded) {
		subsection_download.show();
		subsection_download.siblings(".subsection-delete").hide();
	}

	var is_section_downloaded = true;
	$(".subsection-download").each(function() {
		if ($(this).is(":visible")) {
			is_section_downloaded = false;
		}
	});
	if (!is_section_downloaded) {
		$(".section-download").show();
		$(".section-delete").hide();
	}
}