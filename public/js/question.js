var options = document.getElementsByClassName("option");
Array.from(options).forEach(function(option) {
	option.onclick = function() {
		var hidden_options = document.getElementsByClassName("hidden_option");
		Array.from(hidden_options).forEach(function(hidden_option) {
			hidden_option.value = option.value;
		});
	};
});
