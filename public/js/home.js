$(".glyphicon-chevron-down").click(function(e) {
	e.preventDefault();
	if ($(this).parent().parent().hasClass("margin-bottom-10")) {
		$(this).parent().parent().removeClass("margin-bottom-10");
		$(this).parent().parent().addClass("margin-bottom-2");	
	} else {
		$(this).parent().parent().removeClass("margin-bottom-2");
		$(this).parent().parent().addClass("margin-bottom-10");
	}
	$(this).parent().parent().parent().parent().find(".unit-tabs").toggle();
});