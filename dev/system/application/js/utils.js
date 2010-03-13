
$.fn.setResults = function(data, options) {
	
	// clear any contents of the results container
	this.html("");
	// empty array mapping row ids to track info
	window.idToTrack = [];
	var styles = ["even", "odd"];

	for (i in data) {
		var rowStyle = styles[i % 2];
		var genres = data[i].genres.length > 0 ? data[i].genres[0].name : "";
		var artists = data[i].main_artist.name;
		
		for (var j = 1; j < data[i].genres.length; j++) {
			genres += ", " + data[i].genres[j].name;
		}
		
		for (var j = 0; j < data[i].feat_artists.length; j++) {
			artists += ", " + data[i].feat_artists[j].name;
		}
		
		window.idToTrack[i] = {
			"trackId" : data[i].id,
			"albumId" : data[i].album.id
		};
		
		var t = '';
		t += '<tr id="${rowId}" class="${rowStyle}"><td class="handle">::</td><td class="track_name">${trackName}</td>';
		t += '<td class="track_genres">${genres}</td><td class="album_name"><div>${albumName}</div></td>';
		t += '<td class="track_artists">${artists}</td>';
		t += (options && options['playlist']) ? '<td><a href="#" class="pl_remove" title="Delete From Playlist">X</a></td>' : '';
		t += '</tr>';
		
		var tData = {
			rowId: i,
			rowStyle: rowStyle,
			trackName: data[i].name,
			genres: genres,
			albumName: data[i].album.name,
			artists: artists
		};
		
		this.append($.template(t).apply(tData));
	}
};

function setError(error_message) {
	
	var error_box = $("#error_box");
	var default_error_msg = "An error occured. Please try again later.";

	if (error_message === false || typeof error_message == "undefined") {
		error_box.animate({
			height: '0px'
		});
	}
	else {
		if (typeof error_message != "string") {
			error_message = default_error_msg;
		}

		error_box.html(error_message).animate({
			height: '35px'
		}).delay(30000).animate( {
			height: '0px'
		}, 250, function() {
			$(this).html('');
		});
		
		var offset = error_box.offset();
		
		$('html, body').animate({
			scrollTop: offset.top - 20
		}, 'slow');
	}
}
