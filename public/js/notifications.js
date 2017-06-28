$(".notifications-delete").click(function(e) {
	e.preventDefault();
	var notifications_delete = $(this);
	var href = notifications_delete.attr("href");
	$.get(href, function(data) {
		notifications_delete.siblings(".notifications").remove();	
	});
});

$(".notification-delete").click(function(e) {
	e.preventDefault();
	var notification_delete = $(this);
	var href = notification_delete.attr("href");
	$.get(href, function(data) {
		notification_delete.parent().parent().parent().remove();	
	});
});