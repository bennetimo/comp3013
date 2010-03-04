
$.fn.setResults = function(data)
{
	this.html("");
	
	for (i in data) {
		var style = i % 2 == 0 ? "results_event" : "rsults_odd";
		
		var genres = "";
		var artists = data[i].main_artist.name;
		
		for (key in data[i].genres) {
			genres += data[i].genres[key].name + ", ";
		}
		
		for (key in data[i].feat_artists) {
			artists += ", " + data[i].feat_aritst[key].name;
		}
		
		genres = genres.substring(0, genres.length - 2);
		this.append('<tr class="' + style + '"><td>' + data[i].name + '</td><td>' + genres + '</td><td>' + data[i].album.name + '</td><td>' + artists + '</td></tr>');
	}
};