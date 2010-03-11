$.fn.setResults = function(data, options) {

	this.html("");
	window.idToTrack = [];

	for (i in data) {
		var style = i % 2 == 0 ? "even" : "odd";

		var genres = "";
		var artists = data[i].main_artist.name;

		for (key in data[i].genres) {
			genres += data[i].genres[key].name + ", ";
		}

		for (key in data[i].feat_artists) {
			artists += ", " + data[i].feat_aritst[key].name;
		}

		window.idToTrack[i] = {
			"trackId" : data[i].id,
			"albumId" : data[i].album.id,
			"trackPosition" : parseInt(i) + 1
		};

		genres = genres.substring(0, genres.length - 2);

		this
				.append('<li id="'
						+ i
						+ '" class="'
						+ style
						+ '"><table><tr><td class="results_item handle">::</td><td class="results_item track_name">'
						+ data[i].name
						+ '</td><td class="results_item genres">' + genres
						+ '</td><td class="results_item album_name">'
						+ data[i].album.name
						+ '</td><td class="results_item artists">' + artists
						+ '</td></tr></table></li>');
	}
};