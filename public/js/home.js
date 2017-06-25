$(".glyphicon-chevron-down").click(function(e) {
	e.preventDefault();
	if ($(this).parent().hasClass("margin-bottom-10")) {
		$(this).parent().removeClass("margin-bottom-10");
		$(this).parent().addClass("margin-bottom-2");	
	} else {
		$(this).parent().removeClass("margin-bottom-2");
		$(this).parent().addClass("margin-bottom-10");
	}
	$(this).parent().parent().parent().find(".unit-tabs").toggle();
});