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
			"trackid" : data[i].id,
			"albumid" : data[i].album.id
		}
		genres = genres.substring(0, genres.length - 2);
		this
				.append('<table id="'
						+ i
						+ '"><tr class="'
						+ style
						+ '"><td class="results_item handle">::</td><td class="results_item track_name">'
						+ data[i].name
						+ '</td><td class="results_item genres">' + genres
						+ '</td><td class="results_item album_name">'
						+ data[i].album.name
						+ '</td><td class="results_item artists">' + artists
						+ '</td></tr></table>');
	}
//	if (options['draggable']) {
//		this.find("table").draggable( {
//			revert : true,
//			revertDuration : 0,
//			handle : ".handle",
//			opacity : 0.4,
//			helper : "clone"
//		});
//	}
//	
//	if (options['sortable']) {
//		this.sortable( {
//			revert : false,
//			revertDuration : 0,
//			handle : ".handle",
//			opacity : 0.4,
//			helper : "clone",
//			update: typeof options['update_sortable'] == 'function' ? options['update_sortable'] : null
//		});
//	}
};