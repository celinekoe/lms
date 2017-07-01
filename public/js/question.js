var options = document.getElementsByClassName("option");
Array.from(options).forEach(function(option) {
	option.onclick = function() {
		var hidden_options = document.getElementsByClassName("hidden_option");
		Array.from(hidden_options).forEach(function(hidden_option) {
			hidden_option.value = option.value;
		});
	};
});

var time_limit = $(".timer").attr("time-limit");
var start_time = new Date();
var end_time = new Date(start_time.getTime() + time_limit * 1000);
var interval = setInterval(function() {
	var now = new Date();
	var difference = end_time.getTime() - now.getTime();
	var hours = Math.floor(difference / (60 * 60 * 1000)).toString();
	while (hours.toString().length < 2) {
		hours = "0".concat(hours);
	}
	var minutes = Math.floor(difference % (60 * 60 * 1000) / (60 * 1000));
	while (minutes.toString().length < 2) {
		minutes = "0".concat(minutes);
	}
	var seconds = Math.floor(difference % (60 * 1000) / 1000);
	while (seconds.toString().length < 2) {
		seconds = "0".concat(seconds);
	}
	$(".timer").text("Time Limit " + hours + ":" + minutes + ":" + seconds);
	if (difference < 0) {
		clearInterval(interval);
		$(".timer").text("00:00");
	}
}, 500);