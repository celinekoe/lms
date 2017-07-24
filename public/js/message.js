let message_html =
`
	<div class="message flex margin-bottom-10">
		<div class="bg-white border-radius-10 margin-left-auto margin-right-10 max-width-80p padding-10">
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
		let message_body = $("textarea[name=message_body]");
		$(".messages").append(message_html);
		$(".message-body:last").text(data.body);
		$(".message-formatted-time:last").text(data.formatted_time);
		message_body.val("");
	});	
});