var user_file = document.querySelector(".user_file");
var hidden_file_name = document.querySelector(".file_name");
var hidden_file_type = document.querySelector(".file_type");
var hidden_file_extension = document.querySelector(".file_extension");
user_file.onchange = function(e) {
	console.log(user_file.value);
	var file_url = user_file.value;
	var file_extension = file_url.substring(file_url.lastIndexOf("."));
	var file_name = file_url.substring(file_url.lastIndexOf("\\") + 1, file_url.lastIndexOf("."));
	if (file_extension == ".docx") {
		var file_type = "document"; 
	} else {
		var file_type = "misc";
	}
	hidden_file_name.value = file_name;
	hidden_file_extension.value = file_extension;
	hidden_file_type.value = file_type;
}
