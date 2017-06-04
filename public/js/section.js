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
