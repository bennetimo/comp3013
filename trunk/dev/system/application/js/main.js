
var searchForm = $("#search_form");
var searchResultsList = $("#search_results_body");
var playlistsList = $("#playlists_list");
var loginForm = $("#login_form");
var loginError = $("#error_box");

$(document).ready(function() {

// global variable mapping tracks list-items to their track/album ids
window.idToTrack = [];

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
			}
			setError(data.isValid);
		}
	});
	
	return submit;
});

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
			
			searchResultsList.find("tr").draggable({
				revert : true,
				revertDuration : 0,
				handle : ".handle",
				opacity : 0.6,
				helper : "clone"
			});
		},
		
		error: function(err) 
		{
			alert(err);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) { setError(true); }
	});

	return false;
});

/*
 * Make the playlist list droppable
 * so that I can drop (i.e. add) new tracks to them
 */
playlistsList.find('li').droppable({
  drop: function(event, ui){onDrop(this, event, ui);}
});

var add_pl_form = $('#add_pl_form');

$('#add_pl').click(function(e){
  e.preventDefault();
  add_pl_form.slideToggle();

});
/*
 * Add new Playlist
 */
add_pl_form.submit(function(e){
  e.preventDefault();//prevents the form from submitting
  var playlist_name = $('#pl_name').val();
  var shared = $('#pl_shared').attr('checked') ? 1 : 0;
  
  $.ajax({
    url: base_url + "/playlistmanager/add_playlist/",
    async: true,
    dataType: 'json',
    type: 'post',
    data: {'playlist_name': playlist_name, 'shared': shared},
    success: function(data)
    {
        if(data.error === false){
          
          var data = {
              playlistid : data.playlistid,
              playlist_name : playlist_name
          };
          
          var t = '<li id="${playlistid}"><a href="#pl${playlistid}" onclick="loadPlaylist(\'${playlistid}\')">${playlist_name}</a>';
              t+= shared ? ' *' : '';
              t+= ' (<a href="javascript:void(0)" onclick="removePlaylist(${playlistid})">remove</a>)</li>';
          var li = playlistsList.find('li:last');
          
          if(li.length == 0){
           li =  playlistsList;
          }
          
          li.append($.template(t).apply(data));      
        }
        setError(data.error);
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) { setError(true); }
  });

return false;
  
});

//end of document.ready
});

function onDrop(el, event, ui)
{
  var listItemId = ui.draggable.attr('id');
  var playlistId = $(el).attr('id');
  var trackInfo = idToTrack[listItemId];
  
  $.ajax({
    url: base_url + "/playlistmanager/add_track/",
    async: true,
    dataType: 'json',
    type: 'post',
    data: {'playlistid': playlistId, 'trackid': trackInfo.trackId, 'albumid': trackInfo.albumId},
    success: function(data)
    {
        if(data.error === false){
          alert("success");
        }
        setError(data.error);
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) { setError(true); }
  
  });
}

function updatePlaylistBinding(playlistid)
{
  /*
   * bind the X cross to
   * remove track from playlist
   */
  $(".pl_remove").click(
      function(event){
        event.preventDefault();
        var trackRow = $(this).parents('tr');
        var trackInfo = idToTrack[trackRow.attr('id')];
                
        $.ajax({
          url: base_url + "/playlistmanager/remove_track/",
          async: true,
          dataType: 'json',
          type: 'post',
          data: {'playlistid': playlistid, 'trackid': trackInfo.trackId, 'albumid': trackInfo.albumId},
          success: function(data)
          {
              if(data.error === false){
                /*
                 * delete row in table corresponding to the
                 * deleted track
                 */
                trackRow.remove();
                redrawTable(searchResultsList);
              }
              setError(data.error);
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) { setError(true); }
        
        });
        
      }
  ); 
}

function loadPlaylist(playlistid)
{
  var playlistid = playlistid;
  $.ajax({
    url: base_url + "/playlistmanager/get_tracks/" + playlistid,
    async: true,
    dataType: "json",
    
    success: function(data)
    {
      var startTrackPosition = null;
      var endTrackPosition = null;
      
      searchResultsList.setResults(data, {'playlist': true});
      updatePlaylistBinding(playlistid);
      setError(data['error']);
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
                    
          redrawTable(searchResultsList);
          
          $.ajax({
            url: base_url + "/playlistmanager/update_tracks/",
            data: {'trackid': trackId, 'albumid': albumId, 'next_trackid': nextTrackId == null ? "" : nextTrackId, 'next_albumid': nextAlbumId == null ? "" : nextAlbumId, 'playlistid': playlistid},
            dataType: 'json',
            type: 'POST',
            
            success: function(data) {
              setError(data.error);
            },
            
            error: function(XMLHttpRequest, textStatus, errorThrown) { setError(true); }
          });
        }
      });
    }
  });
}
function removePlaylist(playlistid)
{
  var playlistid = playlistid;
  $.ajax({
    url: base_url + "/playlistmanager/remove_playlist/" + playlistid,
    async: true,
    dataType: "json",
    
    success: function(data)
    {
      setError(data.error);
      
      if(!data.error){
        playlistsList.find("#"+playlistid).hide();
      }
    }
  });
}

function redrawTable(searchResultsList)
{
  searchResultsList.find('tr').each(function(i){
    var className = i % 2 == 0 ? "even" : "odd";
    $(this).attr("class", className);
  });
}