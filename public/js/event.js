var date_html = 
`
	<div class="date" width-100p>
		<div class="flex-align-center-justify-between">
    		<div class="form-group width-49p padding-right-5">
	    		<label for="date_start">Date Start</label>
	    		<input type="date" class="date-start form-control" name="date_start" value="{{ $data['event']->date_start }}">	
	    	</div>
    	</div>
    	<div class="flex-align-center-justify-between">
	    	<div class="form-group width-49p padding-left-5">
	    		<label for="date_end">Date End</label>
	    		<input type="date" class="date-end form-control" name="date_end" value="{{ $data['event']->date_end }}"> 		
	    	</div>
    	</div>
	</div>
`;

var date_time_html = 
`
	<div class="date-time width-100p">
		<div class="flex-align-center-justify-between">
    		<div class="form-group width-49p padding-right-5">
	    		<label for="date_start">Date Start</label>
	    		<input type="date" class="date-start form-control" name="date_start" value="{{ $data['event']->date_start }}">	
	    	</div>
	    	<div class="form-group width-49p">
	    		<label for="time_start">Time Start</label>
	    		<select class="time form-control" name="time_start">
	    		</select>
	    	</div>
	    </div>
	    <div class="flex-align-center-justify-between">
	    	<div class="form-group width-49p padding-left-5">
	    		<label for="date_end">Date End</label>
	    		<input type="date" class="date-end form-control" name="date_end" value="{{ $data['event']->date_end }}"> 		
	    	</div>
	    	<div class="form-group width-49p">
	    		<label for="time_end">Time End</label>
	    		<select class="time form-control" name="time_end">
	    		</select>
	    	</div>
    	</div>
	</div>
`

var time_options_html = 
`
	<option value="00:00">00:00</option>
	<option value="00:30">00:30</option>
    <option value="01:00">01:00</option>
	<option value="01:30">01:30</option>
    <option value="02:00">02:00</option>
	<option value="02:30">02:30</option>
    <option value="03:00">03:00</option>
	<option value="03:30">03:30</option>
    <option value="04:00">04:00</option>
	<option value="04:30">04:30</option>
    <option value="05:00">05:00</option>
	<option value="05:30">05:30</option>
    <option value="06:00">06:00</option>
	<option value="06:30">06:30</option>
    <option value="07:00">07:00</option>
	<option value="07:30">07:30</option>
    <option value="08:00">08:00</option>
	<option value="08:30">08:30</option>
    <option value="09:00">09:00</option>
	<option value="09:30">09:30</option>
    <option value="10:00">010:00</option>
	<option value="10:30">010:30</option>
	<option value="11:00">011:00</option>
	<option value="11:30">011:30</option>
	<option value="12:00">012:00</option>
	<option value="12:30">012:30</option>
	<option value="13:00">013:00</option>
	<option value="13:30">013:30</option>
	<option value="14:00">014:00</option>
	<option value="14:30">014:30</option>
	<option value="15:00">015:00</option>
	<option value="15:30">015:30</option>
	<option value="16:00">016:00</option>
	<option value="16:30">016:30</option>
	<option value="17:00">017:00</option>
	<option value="17:30">017:30</option>
	<option value="18:00">018:00</option>
	<option value="18:30">018:30</option>
	<option value="19:00">019:00</option>
	<option value="19:30">019:30</option>
	<option value="20:00">020:00</option>
	<option value="20:30">020:30</option>
	<option value="21:00">021:00</option>
	<option value="21:30">021:30</option>
	<option value="22:00">022:00</option>
	<option value="22:30">022:30</option>
	<option value="23:00">023:00</option>
	<option value="23:30">023:30</option>
`

$(".event-delete").off().click(function(e) {
	var event_delete = $(this);
	var delete_href = event_delete.attr("action");
	var calendar_href = event_delete.attr("href");
	open_confirm_delete();
	$(".confirm-text").text("Confirm event delete?");
	$(".confirm-option-cancel").off().click(function(e) {
		close_confirm_delete();
	});
	$(".confirm-option-delete").off().click(function(e) {
		close_confirm_delete();
		var data = {
	        "_token": $('#token').val()
	    };
		$.ajax({
			url: delete_href,
			method: 'DELETE',
			data: data,
		})
		.done(function(data) {
			window.location = calendar_href;
		});
	});
});

$(".all-day").off().click(function(e) {
	// change all day button to not all day button
	if ($(this).is(':checked')) // unchecked, on click triggers after checked
	{
		var date_start = $(".date-start").val();
		var date_end = $(".date-end").val();
		$(".date-time").remove();
		$(".description").parent().before(date_html);
		$(".date-start").val(date_start);
		$(".date-end").val(date_end);
	}
	else // checked, on click triggers after unchecked
	{
		var date_start = $(".date-start").val();
		var date_end = $(".date-end").val();
		$(".date").remove();
		$(".description").parent().before(date_time_html);
		$(".date-start").val(date_start);
		$(".date-end").val(date_end);
		var time = $(".date-time").find(".time");
		time.append(time_options_html);
	}
});

$(".submit").off().click(function(e) {
	e.preventDefault();
	var submit_href = $(".submit-form").attr("action");
	var edit_href = $(".submit-form").attr("href");
	$.post(submit_href, $(".submit-form").serialize(), function(data) {
		window.location = edit_href;
	});
});