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

// $(document).on('click', '.complete', function(e){
// 	e.preventDefault();
// 	var href = $(this).attr("href");
// 	new_href = href.substring(0, href.lastIndexOf("/")) + '/incomplete';
// 	var complete = $(this);
// 	$.get(href, function(data) {
// 		var new_complete = `<span class="complete glyphicon glyphicon-check margin-right-10" 
// 		href="` + new_href + `"></span>`;
// 		complete.replaceWith(new_complete);
// 		var new_section_progress = `<div class="section-progress c100 p` + data.section_progress + ` ` + `
// 		font-size-171em green"><div class="slice"><div class="bar"></div><div class="fill"></div></div></div>`
// 		$(".section-progress").replaceWith(new_section_progress);
// 	});
// });

// $(document).on('click','.incomplete',function(e){
// 	e.preventDefault();
// 	var href = $(this).attr("href");
// 	new_href = href.substring(0, href.lastIndexOf("/")) + '/complete';
// 	var incomplete = $(this);
// 	$.get(href, function(data) {
// 		var new_incomplete = `<span class="incomplete glyphicon glyphicon-unchecked margin-right-10" 
// 		href="` + new_href + `"></span>`;
// 		incomplete.replaceWith(new_incomplete);
// 		var new_section_progress = `<div class="section-progress c100 p` + data.section_progress + ` ` + `
// 		font-size-171em green"><div class="slice"><div class="bar"></div><div class="fill"></div></div></div>`
// 		$(".section-progress").replaceWith(new_section_progress);
// 	});
// });


$(".introduction-tab-header").click(function(e) {
	if ($(this).hasClass("bg-white")) {
		$(this).removeClass("bg-white");
		$(this).addClass("bg-primary");	
	} else {
		$(this).removeClass("bg-primary");
		$(this).addClass("bg-white");
	}
	$(".introduction-tab-body").toggle();
});

$(".guidelines-tab-header").click(function(e) {
	if ($(this).hasClass("bg-white")) {
		$(this).removeClass("bg-white");
		$(this).addClass("bg-primary");	
	} else {
		$(this).removeClass("bg-primary");
		$(this).addClass("bg-white");
	}
	$(".guidelines-tab-body").toggle();
});

$(".learning-outcomes-tab-header").click(function(e) {
	if ($(this).hasClass("bg-white")) {
		$(this).removeClass("bg-white");
		$(this).addClass("bg-primary");	
	} else {
		$(this).removeClass("bg-primary");
		$(this).addClass("bg-white");
	}
	$(".learning-outcomes-tab-body").toggle();
});

$(".resources-tab-header").click(function(e) {
	if ($(this).hasClass("bg-white")) {
		$(this).removeClass("bg-white");
		$(this).addClass("bg-primary");	
	} else {
		$(this).removeClass("bg-primary");
		$(this).addClass("bg-white");
	}
	$(".resources-tab-body").toggle();
});

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
		subsection_download.parent().parent().parent().siblings(".file").find(".individual-download").hide();
		subsection_download.parent().parent().parent().siblings(".file").find(".individual-delete").show();
	});
});

$(".subsection-delete").click(function(e) {
	e.preventDefault();
	var href = $(this).attr("href");
	var subsection_delete = $(this);
	$.get(href, function(data) {
		subsection_delete.siblings(".subsection-download").show();
		subsection_delete.hide();
		subsection_delete.parent().parent().parent().siblings(".file").find(".individual-download").show();
		subsection_delete.parent().parent().parent().siblings(".file").find(".individual-delete").hide();
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