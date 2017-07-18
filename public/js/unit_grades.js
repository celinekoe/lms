$(".unit-chevron").click(function(e) {
	e.preventDefault();
	console.log($(this).parent().parent().parent());
	$(this).parent().parent().parent().find(".unit-body").toggle();
});

$(".gradeable-chevron").click(function(e) {
	e.preventDefault();
	$(this).parent().parent().parent().find(".gradeable-body").toggle();
});