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
	$(".confirm-option-cancel").off().click(function(e) {
		e.preventDefault();
		close_confirm_submit();
	});
	$(".confirm-option-submit").off().click(function(e) {
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
	$(".confirm-option-cancel").off().click(function(e) {
		e.preventDefault();
		close_confirm_cancel_submit();
	});
	$(".confirm-option-cancel-submit").off().click(function(e) {
		e.preventDefault();
		close_confirm_cancel_submit();
		$.get(href, function(data) {
			window.location.reload();
		});
	});
})

$(".file-download").click(function(e) {
	e.preventDefault();
	var file_download = $(this);
	var href = file_download.attr("href");
	open_confirm_download();
	$(".confirm-text").text("Confirm file download?");
	$(".confirm-option-cancel").off().click(function(e) {
		e.preventDefault();
		close_confirm_download();
	});
	$(".confirm-option-download").off().click(function(e) {
		e.preventDefault();
		close_confirm_download();
		$.get(href, function(data) {
			toggle_file_download(file_download);
		});
	});
});

$(".file-delete").click(function(e) {
	e.preventDefault();
	var file_delete = $(this);
	var href = file_delete.attr("href");
	open_confirm_delete();
	$(".confirm-text").text("Confirm file delete?");
	$(".confirm-option-cancel").off().click(function(e) {
		e.preventDefault();
		close_confirm_delete();
	});
	$(".confirm-option-delete").off().click(function(e) {
		e.preventDefault();
		close_confirm_delete();
		$.get(href, function(data) {
			toggle_file_delete(file_delete);
		});
	});
});

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

function toggle_file_download(file_download) {
	file_download.hide();
	file_download.siblings(".file-delete").show();
}

function toggle_file_delete(file_delete) {	
	file_delete.siblings(".file-download").show();
	file_delete.hide();
}