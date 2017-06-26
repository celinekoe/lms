// Mark complete and incomplete

$(document).on('click','.complete',function(e){
	e.preventDefault();
	var href = $(this).attr("href");
	var complete = $(this);
	$.get(href, function() {
		complete.hide();
		complete.siblings(".incomplete").show();
	});
});

$(document).on('click','.incomplete',function(e){
	e.preventDefault();
	var href = $(this).attr("href");
	var incomplete = $(this);
	$.get(href, function() {
		incomplete.siblings(".complete").show();
		incomplete.hide();
	});
});


// Download and delete

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