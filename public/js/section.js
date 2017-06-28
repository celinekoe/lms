// Section tabs

$(".introduction-tab-header").click(function(e) {
	if ($(this).hasClass("bg-white")) {
		$(".section-tab-header").addClass("bg-white");
		$(".section-tab-header").removeClass("bg-primary");
		console.log($(".section-tab-header"));
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
		console.log($(".section-tab-header"));
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
	var href = $(this).attr("href");
	$.get(href, function(data) {
		$(".section-download").hide();
		$(".section-delete").show();
		$(".subsection-download").hide();
		$(".subsection-delete").show();
		$(".individual-download").hide();
		$(".individual-delete").show();
	});
});

$(".section-delete").click(function(e) {
	e.preventDefault();
	var href = $(this).attr("href");
	$.get(href, function(data) {
		$(".section-download").show();
		$(".section-delete").hide();
		$(".subsection-download").show();
		$(".subsection-delete").hide();
		$(".individual-download").show();
		$(".individual-delete").hide();
	});
});

$(".subsection-download").click(function(e) {
	e.preventDefault();
	var href = $(this).attr("href");
	var subsection_download = $(this);
	$.get(href, function(data) {
		subsection_download.hide();
		subsection_download.siblings(".subsection-delete").show();
		subsection_download.parent().parent().parent().siblings(".subsection-files").find(".individual-download").hide();
		subsection_download.parent().parent().parent().siblings(".subsection-files").find(".individual-delete").show();
	});
});

$(".subsection-delete").click(function(e) {
	e.preventDefault();
	var href = $(this).attr("href");
	var subsection_delete = $(this);
	$.get(href, function(data) {
		subsection_delete.siblings(".subsection-download").show();
		subsection_delete.hide();
		subsection_delete.parent().parent().parent().siblings(".subsection-files").find(".individual-download").show();
		subsection_delete.parent().parent().parent().siblings(".subsection-files").find(".individual-delete").hide();
	});
});

$(".individual-download").click(function(e) {
	e.preventDefault();
	var href = $(this).attr("href");
	console.log(href);
	var individual_download = $(this);
	$.get(href, function(data) {
		individual_download.hide();
		individual_download.siblings(".individual-delete").show();
	});
});

$(".individual-delete").click(function(e) {
	e.preventDefault();
	var href = $(this).attr("href");
	var individual_delete = $(this);
	$.get(href, function(data) {
		individual_delete.siblings(".individual-download").show();
		individual_delete.hide();
	});
});

// Toggle section

$(".glyphicon-chevron-down").click(function(e) {
	e.preventDefault();
	$(this).parent().parent().parent().siblings(".subsection-files").toggle();
	$(this).parent().parent().parent().siblings(".subsection-quizzes").toggle();
});