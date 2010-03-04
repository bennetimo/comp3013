
$.fn.setResults = function(data)
{
	this.html("");
	
	for (i in data) {
		var style = i % 2 == 0 ? "results_event" : "rsults_odd";
		this.append('<tr class="' + style + '"><td>' + data[i].name + '</td></tr>');
	}
};