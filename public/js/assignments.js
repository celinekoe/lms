$(".glyphicon-chevron-down").click(function(e) {
	e.preventDefault();
	$(this).parent().parent().parent().parent().find(".assignment-files").toggle();
});

$(".assignment-download").click(function(e) {
	e.preventDefault();
	var href = $(this).attr("href");
	console.log(href);
	var assignment_download = $(this);
	$.get(href, function(data) {
		assignment_download.hide();
		assignment_download.siblings(".assignment-delete").show();
	});
});

$(".assignment-delete").click(function(e) {
	e.preventDefault();
	var href = $(this).attr("href");
	var assignment_delete = $(this);
	$.get(href, function(data) {
		assignment_delete.siblings(".assignment-download").show();
		assignment_delete.hide();
	});
});