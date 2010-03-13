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
		var table = '<li id="' + i  + '" class="' + style + '"><table><tr><td class="results_item handle">::</td><td class="results_item track_name">'
      + data[i].name  + '</td><td class="results_item genres">' + genres + '</td><td class="results_item album_name">'
      + data[i].album.name + '</td><td class="results_item artists">' + artists + '</td>';
		if(options && options['playlist']) {
      table += '<td><a href="#" class="results_item pl_remove" title="Remove from Playlist">X</a></td>';
    }
		table += '</tr></table></li>';
			
		this.append(table);
	}
};

function setError(error_message)
{
  var error_box = $("#error_box");
  var default_error_msg = "An error occured. Please try again later";
  
  if(error_message === false){
    error_box.animate({      
      height: '0px'
    });
  }
  else if(typeof error_message != "string" ){
    error_message = default_error_msg;
  }
  
  error_box.html(error_message).animate({      
    height: '30px'
  }).delay(30000).animate({      
    height: '0px'
  });
  
}