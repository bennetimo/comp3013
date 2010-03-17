var Player = function(playerid) {
  this.playerid = playerid;
  this.playerObj = null;

  this.embedPlayer = function() {

    var flashvars = {
      //file : "http://www.longtailvideo.com/jw/upload/bunny.mp3",
      autostart : "false",
      backcolor : '000000',
      frontcolor : 'FFFFFF',
      lightcolor : '000000'
    };
    var params = {
      allowfullscreen : "true",
      wmode : "opaque",
      allowscriptaccess : "always"
    };
    var attributes = {
      id : playerid,
      name : playerid
    };

    swfobject.embedSWF(base_url+'/system/application/jwplayer/player.swf',
        'media_container', '470', '24', '9', false, flashvars, params,
        attributes);
  };
  
  this.setNowPlaying = function(){
    var info = window.idToTrack[this.currentTrack].full_info;
    var notif = $('#ms-notification');
    notif.html('<img border="0" src="'+base_url+'/system/application/images/button_play.png"/> <strong>'+info.name+'</strong> by <strong>'+info.main_artist.name+'</strong>');
    notif.show();
    notif.animate({backgroundColor:"#8fcb41"}, 500, "swing", function(){
      
      notif.animate({backgroundColor:"#000"}, 500, "swing", function(){notif.css('background-color', 'transparent')});
      });
  };
  
  this.currentTrack = false;
  
  this.playTrack = function(track_index){
    try{
      var trackid = window.idToTrack[track_index].trackId;
      var albumid = window.idToTrack[track_index].albumId;
      this.currentTrack = track_index;
    }
    catch(e){
     setError(true); 
    }
	  //Check if the user has already bought the track
    var player = this;
    $.ajax({
  		url: site_url + "/accountmanager/ownstrack/" + trackid + "/" + albumid +"",
  		async: false,
  		type: "post",
  		dataType: "json",
  		
  		success: function(data)
  		{
  			if(data['yes']){
  				//The user has the rights to play this track
  				player.actuallyPlayTrack(trackid, albumid);
  				return;
  			}else if(data['no']){
  				//Have the user acquire rights to this track, debiting their account
  				buyTrack(trackid, albumid, track_index);
  			}
  			//Otherwise, display any errors
	    	setError(data.error);
  		},
  		
  		error: function(XMLHttpRequest, textStatus, errorThrown) {
  			setError(true);
  		}
  	});
  };
  		  	
  this.actuallyPlayTrack = function(trackid, albumid){   
    if(!this.playerObj){
      setError("The Flash Player is not ready yet. Try again shortly");
      return;
    }
    
    var src = window.site_url + '/trackmanager/play/' + trackid + '/' + albumid + '/.mp3';
    //src = 'http://www.longtailvideo.com/jw/upload/bunny.mp3';
    //alert(src)
    this.playerObj.add;
    this.playerObj.sendEvent('LOAD', src);
    this.playerObj.sendEvent('PLAY');
  };
  
  this.playPlaylist = function(playlistid) {
    if(!this.playerObj){
      setError("The Flash Player is not ready yet. Try again shortly");
      return;
    }
    
    var src = window.site_url + '/playlistmanager/getXMLPlaylist/' +playlistid + '/.xml';
    //alert(src)
    this.playerObj.add;
    this.playerObj.sendEvent('LOAD', src);
    this.playerObj.sendEvent('PLAY');
  };
  
  this.embedPlayer();

};

function playerReady(thePlayer) {
  player.playerObj = window.document[player.playerid]; 
  player.playerObj.addModelListener("STATE", "_stateListener");
}


function _stateListener(stateObj){
  currentState = stateObj.newstate; 
  previousState = stateObj.oldstate;

  //alert(previousState +" -> "+ currentState);
  if(previousState == 'BUFFERING' && currentState == 'PLAYING'){  
    player.setNowPlaying();
  }
  else if(previousState == 'BUFFERING' && currentState == 'IDLE'){  
    // We cannot play track
    //player.setNowPlaying();
    $('#ms-notification').hide();
    // space it out in time to avoid colliding with other concurrent notifications
    setTimeout('setError("Sorry, the track is not available at the moment")', 3500);
  }
}