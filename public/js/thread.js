var edit_form = 
`
<form action="" method="POST" class="edit-form">
    <div class="form-group">
        <textarea type="text" class="form-control" name="body"></textarea>
        <div class="help-block display-none"></div>   
    </div>
    <div>
        <input type="submit" class="submit btn btn-default pull-right" value="Submit"> 
        <div class="clear"></div>
    </div>
    <input type="hidden" name="_token" id="csrf-token" value=""ß>
</form>
`;

$(".thread-delete").off().click(function(e) {
	var thread_delete = $(this);
	var post = thread_delete.parent().parent().parent().parent();
	var href = thread_delete.attr("href");
	open_confirm_delete();
	$(".confirm-text").text("Confirm thread delete?");
	$(".confirm-option-cancel").off().click(function(e) {
		close_confirm_delete();
	});
	$(".confirm-option-delete").off().click(function(e) {
		close_confirm_delete();
		$.get(href, function(data) {
			window.location = $(".back").attr("href");
		});
	});
});

$(".post-edit").off().click(function(e) {
	var post_edit = $(this);
	var post_body = post_edit.parent().parent().parent().siblings(".post-body");
	var post_body_text = post_body.text();
	post_body.text("");
	post_body.append(edit_form);
	post_body.find("form").attr("action", post_edit.attr("href"));
	post_body.find(":input[name=body]").val(post_body_text);
	post_body.find(":input[name=_token]").val($('meta[name="csrf-token"]').attr('content'));
});

$(".post-delete").off().click(function(e) {
	var post_delete = $(this);
	var post = post_delete.parent().parent().parent().parent();

	var href = post_delete.attr("href");
	open_confirm_delete();
	$(".confirm-text").text("Confirm post delete?");
	$(".confirm-option-cancel").off().click(function(e) {
		close_confirm_delete();
	});
	$(".confirm-option-delete").off().click(function(e) {
		close_confirm_delete();
		$.get(href, function(data) {
			post.hide();
		});
	});
});

$(document).off().on('click', '.submit', function(e) {
	e.preventDefault();
	var post_form = $(this).parent().parent();
	var href = post_form.attr("action");
	open_confirm_submit();
	$(".confirm-text").text("Confirm submit?");
	$(".confirm-option-cancel").off().click(function(e) {
		close_confirm_submit();
	});
	$(".confirm-option-submit").off().click(function(e) {
		close_confirm_submit();
		$.post(href, post_form.serialize(), function(data) {
			window.location = window.location.href;
		})
		.fail(function(data) {
			var errors = data.responseJSON;
			if (errors.body) {
				var body = post_form.find(":input[name=body]");
				body.parent().addClass("has-error");
				body.siblings(".help-block").show();
				body.siblings(".help-block").text(errors.body[0]);
			}
		});
	});
});

$(":input").change(function(e) {
	var input = $(this);
	input.parent().removeClass("has-error");
	input.siblings(".help-block").hide();
});