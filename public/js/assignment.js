var video_extensions = [".mp4"]
var document_extensions = [".doc", ".docx", ".pdf", ".ppt", ".pptx"];

$(".file-input").change(function(e) {
	var file_name_and_extension = $(this).prop('files')[0].name;
	var file_name = file_name_and_extension.substring(0, file_name_and_extension.lastIndexOf("."));
	var file_extension = file_name_and_extension.substring(file_name_and_extension.lastIndexOf("."))
	var file_type = fileType(file_extension).value;
	var file_size = $(this).prop('files')[0].size;
	$(".file-name").val(file_name);
	$(".file-extension").val(file_extension); 
	$(".file-type").val(file_type);
	$(".file-size").val(file_size);
	$(".submit-form").show();
});

$(".submit").click(function(e) {
	e.preventDefault();
	var submit = $(this);
	var href = submit.attr("action");
	open_confirm_submit();
	$(".confirm-text").text("Confirm submit?");
	$(".confirm-option-cancel").click(function(e) {
		e.preventDefault();
		close_confirm_submit();
	});
	$(".confirm-option-submit").click(function(e) {
		e.preventDefault();
		close_confirm_submit();
		$.post(href, $(".submit-form").serialize(), function(data) {
			window.location = window.location.href;
		});
	});
});

$(".cancel-submit").click(function(e) {
	e.preventDefault();
	var cancel_submit = $(this);
	var href = cancel_submit.attr("href");
	open_confirm_cancel_submit();
	$(".confirm-text").text("Cancel submit?");
	$(".confirm-option-cancel").click(function(e) {
		e.preventDefault();
		close_confirm_cancel_submit();
	});
	$(".confirm-option-cancel-submit").click(function(e) {
		e.preventDefault();
		close_confirm_cancel_submit();
		$.get(href, function(data) {
			window.location.reload();
		});
	});
})

function fileType(file_extension) {
	var file_type = new Object();
	if (video_extensions.includes(file_extension)) {
		file_type.value = "video";
	}
	if (document_extensions.includes(file_extension)) {
		file_type.value = "document"; 
	} else {
		file_type.value = "misc";
	}
	return file_type;
}

function open_confirm_submit() {
	$(".confirm-container").show();
	$(".confirm-submit").show();
	$(".confirm-cancel-submit").hide();
}

function open_confirm_cancel_submit() {
	$(".confirm-container").show();
	$(".confirm-submit").hide();
	$(".confirm-cancel-submit").show();
}

function close_confirm_submit() {
	$(".confirm-container").hide();
}

function close_confirm_cancel_submit() {
	$(".confirm-container").hide();
}