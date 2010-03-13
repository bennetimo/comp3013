
$.fn.setResults = function(data, options) {
	
	// clears any contents from the tracks containter
	if (options && options["playlist"]) {
		this.html('<table class="search_results_table"><tbody id="search_results_body"></tbody></table>');
	}
	else {
		this.html('');
	}
	
	// empty array mapping row ids to track info
	window.idToTrack = [];
	var styles = ["even", "odd"];
	var sortKey = "main_artist";
	
	if (options && options['sortby']) {
		sortKey = options['sortby'];
	}
	
	var thisSortBy = null;
	var newSort = false;
	var sortId = '';

	for (i in data) {
		
		if (!options || !options["playlist"]) {
			if (thisSortBy == data[i][sortKey].name) {
				newSort = false;
			}
			else {
				thisSortBy = data[i][sortKey].name;
				sortId = 'table' + i;
				this.append('<div class="group_info">' + data[i][sortKey].name + '</div>');
				this.append('<table id="'+sortId+'" class="search_results_table"></table>');
				newSort = true;
			}
		}
		
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
		t += '<tr id="${rowId}" class="${rowStyle}"><td class="handle">::</td><td><div class="track_name">${trackName}</div></td>';
		t += '<td><a href="#" class="track_button ${buttonStyle}"></a></td><td><div class="track_genres">${genres}</div></td><td><div class="album_name">${albumName}</div></td>';
		t += '<td><div class="track_artists">${artists}</div></td>';
		t += (options && options['playlist']) ? '<td><a href="#" class="pl_remove" title="Delete From Playlist">X</a></td>' : '';
		t += '</tr>';
		
		var tData = {
			rowId: i,
			rowStyle: rowStyle,
			trackName: data[i].name,
			genres: genres,
			albumName: data[i].album.name,
			artists: artists,
			buttonStyle: data[i].bought_time === null ? "buy_track" : "play_track"
		};
		
		if (options && options["playlist"]) {
			this.find("#search_results_body").append($.template(t).apply(tData));
		}
		else {
			this.find("#" + sortId).append($.template(t).apply(tData));
		}
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
