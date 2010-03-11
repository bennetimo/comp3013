// global variable mapping tracks list-items to their track/album ids
window.idToTrack = [];

var loginForm = $("#login_form");
var loginError = $("#login_error");

loginForm.submit(function()
{
	var submit = false;

	$.ajax({
		url: base_url + "/usermanager/validate_login_form",
		async: false,
		type: "post",
		dataType: "json",
		data: loginForm.serialize(),

		success: function(data)
		{
			if (data.isValid) {
				submit = true;
				loginError.hide();
				loginError.html("");
			}
			else {
				loginError.html(data.error);
				loginError.show();
			}
		}
	});
	
	return submit;
});

var searchForm = $('#search_form');
var searchResultsList = $("#search_results_list");
var playlistsList = $("#playlists_list");

searchForm.submit(function()
{
	$.ajax({
		url: base_url + "/trackmanager/search",
		async: true,
		type: "post",
		dataType: "json",
		data: searchForm.serialize(),

		success: function(data)
		{
			searchResultsList.setResults(data);
			
			searchResultsList.find("li").draggable({
				revert : true,
				revertDuration : 0,
				handle : ".handle",
				opacity : 0.4,
				helper : "clone"
			});
		}
	});

	return false;
});

function loadPlaylist(playlistid)
{
	$.ajax({
		url: base_url + "/playlistmanager/get_tracks/" + playlistid,
		async: true,
		dataType: "json",

		success: function(data)
		{
			var startTrackPosition = null;
			var endTrackPosition = null;
			
			searchResultsList.setResults(data);
			searchResultsList.sortable({
				
				stop: function(event, ui) {
					var trackId = idToTrack[ui.item.attr("id")].trackId;
					var albumId = idToTrack[ui.item.attr("id")].albumId;
					var nextTrackId = null;
					var nextAlbumId = null;
					
					if (ui.item.next().length > 0) {
						nextTrackId = idToTrack[ui.item.next().attr("id")].trackId;
						nextAlbumId = idToTrack[ui.item.next().attr("id")].albumId;
					}
										
					searchResultsList.find('li').each(function(i){
						var className = i % 2 == 0 ? "even" : "odd";
						$(this).attr("class", className);
					});
					
					
//					alert(trackId + ", " + albumId + " : " + nextTrackId + ", " + nextAlbumId);
					
					$.ajax({
						url: base_url + "/playlistmanager/update_tracks/",
						data: {'trackid': trackId, 'albumid': albumId, 'next_trackid': nextTrackId == null ? "" : nextTrackId, 'next_albumid': nextAlbumId == null ? "" : nextAlbumId, 'playlistid': playlistid},
						dataType: 'json',
						type: 'POST',
						
						success: function(data) {
							if (data.error) {
								alert("pica!");
							}
						}
					});
				}
			});
		}
	});
}

playlistsList.find("li").droppable({
	
	drop: function(event, ui) {
		var listItemId = ui.draggable.attr("id");
		idToTrack[listItemId].trackId;
		idToTrack[listItemId].albumId;
	}
});