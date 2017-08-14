let message_group_is_edit_html =
`
<div class="message-group" date="">
    <div class="flex-align-center-justify-center">
        <div class="message-group-date bg-white border-radius-10 margin-bottom-10 padding-10"></div>
    </div>
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
</div>
`;

let message_group_is_not_edit_html =
`
<div class="message-group" date="">
    <div class="flex-align-center-justify-center">
        <div class="message-group-date bg-white border-radius-10 margin-bottom-10 padding-10"></div>
    </div>
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
</div>
`;

let message_is_edit_html =
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

let message_is_not_edit_html =
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
		let message_formatted_date = data.message.formatted_date;
		let message_group = $(`.message-group[date='${message_formatted_date}']:visible`);
		let message_edit = $(".message-edit");
		if (message_group.length !== 0) {
			if (message_edit.hasClass("is-edit")) {
				message_group.append(message_is_edit_html);
			} else {
				message_group.append(message_is_not_edit_html);
			}
		} else {
			if (message_edit.hasClass("is-edit")) {
				$(".messages").append(message_group_is_edit_html);
				$(".message-group").attr("date", message_formatted_date);
				$(".message-group").find(".message-group-date").text(message_formatted_date);
			} else {
				$(".messages").append(message_group_is_not_edit_html);
				$(".message-group").attr("date", message_formatted_date);
				$(".message-group").find(".message-group-date").text(message_formatted_date);
			}
		}
		let message_delete_href = message_href.substring(0, message_href.indexOf("/message/") + 9) + data.message.id + "/delete";
		$(".message-delete:last").attr("href", message_delete_href);
		$(".message-body:last").text(data.message.body);
		$(".message-formatted-time:last").text(data.message.formatted_time);
		let message_body = $("textarea[name=message_body]");
		message_body.val("");
	});	
});

$(".message-edit").off().click(function(e) {
	$(".message-edit").toggleClass("is-edit");
	$(".message-delete-container").toggle();
});

$('body').off().on('click', '.message-delete', function(e) {
    let message_delete = $(this);
	let message_href = message_delete.attr("href");
	$.get(message_href, function(data) {	
		let message_group = message_delete.parent().parent().parent().parent().parent();
		let message = message_delete.parent().parent().parent().parent();
		message.hide();
		let message_group_messages = message_group.find(".message:visible");
		if (message_group_messages.length == 0) {
			message_group.hide();
		}
	});	
});