let message_html_is_edit =
`
	<div class="message flex margin-bottom-10">
		<div class="bg-white border-radius-10 margin-left-auto margin-right-10 max-width-80p padding-10">
            <div class="message-delete-container">
                <div class="flex margin-bottom-4">
                    <div class="message-delete glyphicon glyphicon-remove margin-left-auto"></div>
                </div>
            </div>
            <div class="message-body"></div>
            <div class="flex">
                <div class="message-formatted-time margin-left-auto small"></div>    
            </div>
        </div>
	</div>
`;

let message_html_is_not_edit =
`
	<div class="message flex margin-bottom-10">
		<div class="bg-white border-radius-10 margin-left-auto margin-right-10 max-width-80p padding-10">
            <div class="message-delete-container display-none">
                <div class="flex margin-bottom-4">
                    <div class="message-delete glyphicon glyphicon-remove margin-left-auto"></div>
                </div>
            </div>
            <div class="message-body"></div>
            <div class="flex">
                <div class="message-formatted-time margin-left-auto small"></div>    
            </div>
        </div>
	</div>
`;

$(".message-send").off().click(function(e) {
	let message_send = $(this);
	let message_href = message_send.attr("href");
	let message_form = $(".message-form");
	$.post(message_href, message_form.serialize(), function(data) {		
		let message_edit = $(".message-edit");
		let message_body = $("textarea[name=message_body]");
		if (message_edit.hasClass("is-edit")) {
			$(".messages").append(message_html_is_edit);
		} else {
			$(".messages").append(message_html_is_not_edit);
		}
		let message_delete_href = message_href.substring(0, message_href.indexOf("/message/") + 9) + data.id + "/delete";
		$(".message-delete:last").attr("attr", message_delete_href);
		$(".message-body:last").text(data.body);
		$(".message-formatted-time:last").text(data.formatted_time);
		message_body.val("");
	});	
});

$(".message-edit").off().click(function(e) {
	$(".message-edit").toggleClass("is-edit");
	$(".message-delete-container").toggle();
});

$('body').on('click', '.message-delete', function() {
    let message_delete = $(this);
	let message_href = message_delete.attr("href");
	$.get(message_href, function(data) {		
		let message_group = message_delete.parent().parent().parent().parent().parent();
		console.log(message_group);
		let message = message_delete.parent().parent().parent().parent();
		delete_message(message);
	});	
});