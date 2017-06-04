var section_progress = document.querySelector(".section-progress");

$(document).on('click','complete',function(e){
	e.preventDefault();
});

$(document).on('click','incomplete',function(e){
	e.preventDefault();
});

$(document).on('click', '.complete', function(e){
	console.log('complete');
	e.preventDefault();
	var href = $(this).attr("href");
	new_href = href.substring(0, href.lastIndexOf("/")) + '/incomplete';
	var complete = $(this);
	$.get(href, function(data) {
		var new_complete = `<span class="complete glyphicon glyphicon-check margin-right-10" 
		href="` + new_href + `"></span>`;
		complete.replaceWith(new_complete);
		var new_section_progress = `<div class="section-progress c100 p` + data.section_progress + ` ` + `
		font-size-228em green"><div class="slice"><div class="bar"></div><div class="fill"></div></div></div>`
		$(".section-progress").replaceWith(new_section_progress);
	});
});

$(document).on('click','.incomplete',function(e){
	console.log('incomplete');
	e.preventDefault();
	var href = $(this).attr("href");
	new_href = href.substring(0, href.lastIndexOf("/")) + '/complete';
	var incomplete = $(this);
	$.get(href, function(data) {
		var new_incomplete = `<span class="incomplete glyphicon glyphicon-unchecked margin-right-10" 
		href="` + new_href + `"></span>`;
		incomplete.replaceWith(new_incomplete);
		var new_section_progress = `<div class="section-progress c100 p` + data.section_progress + ` ` + `
		font-size-228em green"><div class="slice"><div class="bar"></div><div class="fill"></div></div></div>`
		$(".section-progress").replaceWith(new_section_progress);
	});
});

var downloads = document.getElementsByClassName("download");
Array.from(downloads).forEach(function(download) {
	download.onclick = function(e) {
		e.preventDefault();
		var href = download.getAttribute("href");
		$.get(href, function(data) {
			var new_download = `<span class="download glyphicon glyphicon-remove-circle margin-top-4" 
			href="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/subsection/'.
			$subsection->id.'/file/'.$file->id.'/delete') }}"></span>`;
			download.outerHTML = new_download;
		});
	};
});
