
var searchForm = $("#search_form");
var searchResultsContainer = $("#search_results_container");
var playlistsList = $("#playlists_list");
var loginForm = $("#login_form");
var loginError = $("#error_box");
var playlistAddForm = $('#playlist_add_form');
var musicBrowser = $('#music_browser');

$(document).ready(function() {
    
    window.idToTrack = [];
    
    $("#music_browser_form select").change(function(){
    	
    	var display = 26;
    	var type = $(this).attr('id');
    	var genreid = $("#music_browser_form select[id=genre] option:selected").val();
    	var artistid = $("#music_browser_form select[id=artist] option:selected").val();
    	var albumid = $("#music_browser_form select[id=album] option:selected").val();
    	
    	$.ajax({
            url: site_url + "/main/musicBrowser/"+type+"/"+0+"/"+display+"/"+genreid+"/"+artistid+"/"+albumid,
            async: false,
            type: "get",
            dataType: "json",
            
            success: function(data) {
                if(!data.error){
                	 searchResultsContainer.setResults(data);
                	 
                	 var htmlString;
                	 
                	 if(data['artists']){
                		 htmlString = "";
                		 htmlString += '<option value="all" selected>All (' + data['artists'].length + ')</option>';
                		 for(var i in data['artists']){
                			 htmlString += '<option value="' + data['artists'][i].id + '">' + data['artists'][i].name + '</option>';
                		 }
                		
                		 $("#music_browser_form select[id=artist]").html(htmlString);	 
                	 }
                	 if(data['albums']){
                		 htmlString = "";
                		 htmlString += '<option value="all" selected>All (' + data['albums'].length + ')</option>';
                		 for(var i in data['albums']){
                			 htmlString += '<option value="' + data['albums'][i].id + '">' + data['albums'][i].name + '</option>';
                		 }
                		
                		 $("#music_browser_form select[id=album]").html(htmlString);	 
                	 } 	 
                }
                else{ setError(data.error); }
        	}
        });
    });
    
    loginForm.submit(function() {
        var submit = false;
        
        $.ajax({
            url: site_url + "/usermanager/validate_login_form",
            async: false,
            type: "post",
            dataType: "json",
            data: loginForm.serialize(),
            
            success: function(data) {
                if (data.isValid) {
                    submit = true;
                }
                setError(!data.isValid);
            }
        });
        
        return submit;
    });
    
    searchForm.submit(function(e){e.preventDefault(); onSearchSubmit(0)});
    
    /*
     * Make the playlist list droppable so that I can drop (i.e. add) new
     * tracks to them
     */
    makePlaylistDroppable(playlistsList);
    
    $('#playlist_add_link').click(function(e) {
        e.preventDefault();
        playlistAddForm.slideToggle();
    });
    
    $('#show_search_options').click(function(e) {
        e.preventDefault();
        musicBrowser.slideToggle();
    });
    
    /*
     * Add new Playlist
     */
    playlistAddForm.submit(function(e) {
        
        e.preventDefault();// prevents the form from submitting
        var playlist_name = $('#playlist_new_input').val();
        var shared = $('#pl_shared').attr('checked') ? 1 : 0;
        
        $.ajax({
            url: site_url + "/playlistmanager/add_playlist/",
            async: true,
            dataType: 'json',
            type: 'post',
            data: {
                'playlist_name': playlist_name,
                'shared': shared
            },
            success: function(data) {
                if (data.error === false) {
                
                    var data = {
                        playlistid: data.playlistid,
                        playlist_name: playlist_name,
                        shared: shared,
                        className: ''
                    };
                    
                    appendPlaylist(data);
                    
                    // important: make the newly added pl droppable
                    makePlaylistDroppable(playlistsList);
                }
                setError(data.error);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                setError(true);
            }
        });
        
        return false;
    });
    
    window.player = new Player("ply");
    window.player.embedPlayer();
});

//end of document.ready

function onSearchSubmit(pageNumber)
{
	$.ajax({
		url: site_url + "/trackmanager/search/"+pageNumber,
		async: true,
		type: "post",
		dataType: "json",
		data: searchForm.serialize(),

		success: function(data)
		{
	    	if (!data['error'] || data['error'] === false) {
	    		
	    	  if($('input[name=search_by]:checked').val() == "playlist"){
	    	    setTracksListHeaderDisplay(false, false);
	    	    searchResultsContainer.setPlResults(data);
	    	  }
	    	  else {
	    		  searchResultsContainer.setResults(data);	    		
  	    		searchResultsContainer.find("tr").draggable({
  	    			revert : true,
  	    			revertDuration : 0,
  	    			handle : ".handle",
  	    			opacity : 0.6,
  	    			helper : "clone"
  	    		});
  	    		
  	    		setTracksListHeaderDisplay(true);
                setMusicBrowserDisplay(false);
  	    	}
	    	}
	    	setError(data.error);
		},
		
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			setError(true);
		}
	});

	return false;
}


function appendPlaylist(data) {
    
    var t = '<tr id="${playlistid}"class="${className}"><td><a href="#pl${playlistid}" onclick="loadPlaylist(\'${playlistid}\')">${playlist_name}</a></td>';
    t += '<td class="playlist_play"><a onclick="player.playPlaylist(\'${playlistid}\')" href="#pl${playlistid}"><img src="' + base_url + '/system/application/images/button_play.png" /></td>';
    t += '<td class="playlist_is_shared' + (data.shared ? ' shared' : '') + '"></td>';
    t += '<td class="playlist_delete"><a href="javascript:void(0)" class="ui-playlist-delete-button" onclick="removePlaylist(\'${playlistid}\')"></a></tr>';
    
    playlistsList.append($.template(t).apply(data));
}

function makePlaylistDroppable(playlistsList) {
    
    playlistsList.find('tr[class!=read-only]').droppable({
        hoverClass: 'ui-playlist-hovered',
        tolerance: 'pointer',
        
        drop: function(event, ui) {
            onDrop(this, event, ui);
        }
    });
}

function onDrop(el, event, ui) {
    
    var listItemId = ui.draggable.attr('id');
    var playlistId = $(el).attr('id');
    var trackInfo = idToTrack[listItemId];
    
    $.ajax({
        url: site_url + "/playlistmanager/add_track/",
        async: true,
        dataType: 'json',
        type: 'post',
        data: {
            'playlistid': playlistId,
            'trackid': trackInfo.trackId,
            'albumid': trackInfo.albumId
        },
        
        success: function(data) {
            if (data.error === false) {
                setNotification("The track was added to your playlist");
            }
            setError(data.error);
        },
        
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            setError(true);
        }
    });
}

function updatePlaylistBinding(playlistid) {
    
    // bind the X cross to remove track from playlist
    $(".ui-playlist-delete-button").click(function(event) {
        event.preventDefault();
        var trackRow = $(this).parents('tr');
        var trackInfo = idToTrack[trackRow.attr('id')];
        
        $.ajax({
            url: site_url + "/playlistmanager/remove_track/",
            async: true,
            dataType: 'json',
            type: 'post',
            data: {
                'playlistid': playlistid,
                'trackid': trackInfo.trackId,
                'albumid': trackInfo.albumId
            },
            
            success: function(data) {
                
                if (data.error === false) {
                    // delete row in table corresponding to the deleted track
                    trackRow.remove();
                    redrawTable(searchResultsContainer.find("#search_results_body"));
                }
                setError(data.error);
            },
            
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                setError(true);
            }
            
        });
        
    });
}

function loadUserCollection() {
    
    $.ajax({
        url: site_url + "/trackmanager/getUserCollection",
        async: true,
        dataType: "json",
        
        success: function(data) {
            setError(data.error);
            setMusicBrowserDisplay(true);
            
            if (!data['error']) {
                searchResultsContainer.setResults(data);
                searchResultsContainer.find("tr").draggable({
                    revert: true,
                    revertDuration: 0,
                    handle: ".handle",
                    opacity: 0.6,
                    helper: "clone"
                });
            }
        }
    });
}

function loadMyAccount() {
    $.ajax({
        url: site_url + "/main/loggedin",
        async: true,
        dataType: "json",
        
        success: function(data) {
            if (data['error']) {
            	setError(data.error);
            }
            else{
            	window.location = site_url + "/main/account";
            }
        },
    	error: function(XMLHttpRequest, textStatus, errorThrown) {
            setError(true);
        }
    });
}

function loadPlaylist(playlistid, pageNumber) {
    
    var playlistid = playlistid;
    
    $.ajax({
        url: site_url + "/playlistmanager/get_tracks/" + playlistid + "/" +pageNumber,
        async: true,
        dataType: "json",
        
        success: function(data) {
            
            var startTrackPosition = null;
            var endTrackPosition = null;
            
            searchResultsContainer.setResults(data, {
                'playlist': true
            });
            
            setTracksListHeaderDisplay(true, true);
            setMusicBrowserDisplay(false);
            
            updatePlaylistBinding(playlistid);
            setError(data['error']);
            
            if (!data.read_only) {
                searchResultsContainer.find("#search_results_body").sortable({
                
                    stop: function(event, ui) {
                        var trackId = idToTrack[ui.item.attr("id")].trackId;
                        var albumId = idToTrack[ui.item.attr("id")].albumId;
                        var nextTrackId = null;
                        var nextAlbumId = null;
                        
                        if (ui.item.next().length > 0) {
                            nextTrackId = idToTrack[ui.item.next().attr("id")].trackId;
                            nextAlbumId = idToTrack[ui.item.next().attr("id")].albumId;
                        }
                        
                        redrawTable(searchResultsContainer.find("#search_results_body"));
                        
                        $.ajax({
                            url: site_url +
                            "/playlistmanager/update_tracks/",
                            data: {
                                'trackid': trackId,
                                'albumid': albumId,
                                'next_trackid': nextTrackId == null ? "" : nextTrackId,
                                'next_albumid': nextAlbumId == null ? "" : nextAlbumId,
                                'playlistid': playlistid
                            },
                            dataType: 'json',
                            type: 'POST',
                            
                            success: function(data) {
                                setError(data.error);
                            },
                            
                            error: function(XMLHttpRequest, textStatus, errorThrown) {
                                setError(true);
                            }
                        });
                    }
                });
            }
        }
    });
}

function removePlaylist(playlistid, rowid) {
    
    var playlistid = playlistid;
    
    $.ajax({
        url : site_url + "/playlistmanager/remove_playlist/" + playlistid,
        async : true,
        dataType : "json",

        success : function(data) {
          setError(data.error);

          if (!data.error) {
            playlistsList.find("#" + playlistid).hide();
            setNotification('The playlist was succesfully removed');
            var t = '<a title="Import playlist" href="javascript:importPlaylist(${playlistid}, ${row})" class="ui-playlist-import-button"></a>';

            searchResultsContainer.find('#' + rowid).find(".pl_button").html(
                $.template(t).apply({
                  playlistid : playlistid,
                  row : rowid
                }));
          }
        }
      });
}

function redrawTable(searchResultsList) {
    
    searchResultsList.find('tr').each(function(i) {
        
        var className = i % 2 == 0 ? "even" : "odd";
        $(this).attr("class", className);
    });
}

buyTrack = function(trackid, albumid, row_index) {
    
    // Check if the user has already bought the track
    $.ajax({
        url: site_url + "/accountmanager/buytrack/" + trackid + "/" +
        albumid,
        async: false,
        type: "post",
        dataType: "json",
        
        success: function(data) {
            if (data['bought']) {
                setNotification("Great! The track is yours and will play shortly...");
                // Giacomo/David should add the correct way to refesh
                //DONE
                setButtonPlaying(row_index);
                player.actuallyPlayTrack(trackid, albumid);
            }
            // Otherwise, display any errors
            setError(data.error);
        },
        
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            setError(true);
        }
    });
};

function setTracksListHeaderDisplay(show, playlist) {

    if (show) {
        $(".hideable").hide();
        $(".tracks_list_header").show();
    }
    else {
        $(".tracks_list_header").hide();
        $(".hideable").show();
    }
    
    if (show && playlist) {
        $("#track_delete_cell").show();
    }
    else {
        $("#track_delete_cell").hide();
    }
}

function setMusicBrowserDisplay(show) {
    
    if (show) {
        $("#music_browser_box").show();
    }
    else {
        $("#music_browser_box").hide();
    }
}

function importPlaylist(playlistid, rowid) {

    $.ajax({
        url: site_url + "/playlistmanager/import/" + playlistid,
        async: true,
        type: "post",
        dataType: "json",
        
        success: function(data) {
            
            if (!data.error) {
                var pl = data.imported_pl;
                var info = {
                    playlistid: pl.id,
                    playlist_name: pl.name,
                    shared: true,
                    className: pl.is_owner ? '' : 'read-only'
                };
                
                setNotification('Wicked! You can now play "' + pl.name+'"');
                appendPlaylist(info);
                var t = '<a title="Remove playlist" href="javascript:removePlaylist(${playlistid}, ${row})" class="ui-playlist-delete-button"></a>';
                
                searchResultsContainer.find('#' + rowid).find(".pl_button").html($.template(t).apply({
                    playlistid: playlistid,
                    row: rowid
                }));
                
                //makePlDroppable(playlistsList);
            }
            
            setError(data.error);
        },
        
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            setError(true);
        }
    });
}

function setButtonPlaying(rowId, play) {

    if (play) {
        $("#search_results_container").find("#" + rowId).find(".track_button").find("img").attr("src", base_url +
        "/system/application/images/button_play_now.png").attr("href", "javascript:player.playTrack('"+rowId+"')");
    }
    else {
        $("#search_results_container").find("#" + rowId).find(".track_button").find("img").attr("src", base_url + "/system/application/images/button_play.png").attr("href", "javascript:player.playTrack('"+rowId+"')");
    }
}
