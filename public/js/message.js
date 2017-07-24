let message_html =
`
	<div class="bg-white border-radius-10 margin-left-auto margin-right-10 max-width-80p padding-10">
        <div class="body"></div>
        <div class="flex">
            <div class="margin-left-auto small">{{ $message->formatted_time }}</div>    
        </div>
    </div>
`;

$(".message_send").off().click(function(e) {
	alert("test");
	let message_send = $(this);
	let message_href = message_send.attr("href");
	$.post(message_href, message_form.serialize(), function(data) {		
		let message_body = $("[input='body']").val();
		// reset message body
		$("[input='body']").val("");
	});
	
});