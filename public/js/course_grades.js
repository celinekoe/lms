$(".glyphicon-chevron-down").click(function(e) {
	e.preventDefault();
	$(this).parent().parent().siblings(".unit-grades").toggle();
});