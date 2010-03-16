$.fn.setPlResults = function(data) {
  var HTML = '<h4>Playlists Search Result</h4><table class="search_results_table">';
  var t;
  
  for (i in data) {
      
      t = '<tr id ="${row}" class="'+(i%2 == 0 ? 'even' : 'odd')+'"><td><a href="javascript:loadPlaylist(${playlistid})">${playlist_name}</a></td><td>By ${username}</td>';
      t += '<td>';
      if( ! data[i].in_user_playlists){
        t += '<a class="pl_button" title="Import playlist" href="javascript:importPlaylist(${playlistid}, ${row})"><img src="'+base_url+'/system/application/images/button_add_to_playlist.png"/></a>';
      }else{
        t += '<a title="Remove playlist" href="javascript:removePlaylist(${playlistid}, ${row})" class="ui-playlist-delete-button pl_button"></a>';
      }
      t +='</td></tr>';
      
      HTML += $.template(t).apply({row: i, playlistid: data[i].id, playlist_name: data[i].name, username: data[i].user_name});
  }
  
  this.html(HTML);
};
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
		var price = "&pound;" + (data[i].cost/100).toFixed(2);
		
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
		t += '<tr id="${rowId}" class="${rowStyle}"><td class="handle">::</td><td class="track_name"><div>${trackName}</div></td>';
		t += '<td class="track_button_cell"><a href="javascript:player.playTrack(${trackId}, ${albumId})" class="track_button"><img src="${baseUrl}/system/application/images/${buttonSrc}.png" border="0"></a></td><td class="track_price"><div>${price}</div></td><td class="track_genres"><div>${genres}</div></td><td class="album_name"><div>${albumName}</div></td>';
		t += '<td class="track_artists"><div>${artists}</div></td>';
		t += (options && options['playlist']) ? '<td class="track_delete"><a href="#"  class="ui-playlist-delete-button" title="Delete From Playlist"></a></td>' : '';
		t += '</tr>';
		
		var tData = {
			rowId: i,
			rowStyle: rowStyle,
			trackName: data[i].name,
			trackId: data[i].id,
			albumId: data[i].album.id,
			genres: genres,
			albumName: data[i].album.name,
			artists: artists,
			buttonSrc: data[i].bought_time === null ? "button_buy" : "button_play",
			price: price,
			baseUrl: base_url
		};
		
		if (options && options["playlist"]) {
			this.find("#search_results_body").append($.template(t).apply(tData));
		}
		else {
			this.find("#" + sortId).append($.template(t).apply(tData));
		}
	}
};

function setNotification(message){
	setError(message, true);
}

function setError(error_message, notification) {
	if(notification){
		var wait = 3000;
	}else{
		var wait = 15000;
	}
	
	var error_box = $("#error_box");
	
	if(notification){
		error_box.addClass("error_box_green");
	}
	
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
		}).delay(wait).animate( {
			height: '0px'
		}, 250, function() {
			$(this).html('');
			error_box.removeClass("error_box_green");
		});
		
		var offset = error_box.offset();
		
		$('html, body').animate({
			scrollTop: offset.top - 20
		}, 'slow');
	}
	
	
}
