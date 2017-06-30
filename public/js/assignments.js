$(".glyphicon-chevron-down").click(function(e) {
	e.preventDefault();
	$(this).parent().parent().parent().parent().find(".assignment-files").toggle();
});