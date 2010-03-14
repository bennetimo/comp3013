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
      allowscriptaccess : "always",
      type: "mp3"
    };
    var attributes = {
      id : playerid,
      name : playerid
    };

    swfobject.embedSWF(base_url+'/system/application/jwplayer/player.swf',
        'media_container', '470', '24', '9', false, flashvars, params,
        attributes);
  };
  
  this.playTrack = function(trackid, albumid){
	  //Check if the user has already bought the track
  	$.ajax({
  		url: site_url + "/accountmanager/ownstrack/" + trackid + "/" + albumid +"",
  		async: false,
  		type: "post",
  		dataType: "json",
  		data: searchForm.serialize(),

  		success: function(data)
  		{
  			if(data['yes']){
  				//The user has the rights to play this track
  				actuallyPlayTrack(trackid, albumid);
  				return;
  			}else if(data['no']){
  				//Have the user acquire rights to this track, debiting their account
  				buyTrack(trackid, albumid);
  			}
  			//Otherwise, display any errors
	    	setError(data.error);
  		},
  		
  		error: function(XMLHttpRequest, textStatus, errorThrown) {
  			setError(true);
  		}
  	});
  };
  		  	
  actuallyPlayTrack = function(trackid, albumid){   
    if(!this.playerObj){
      setError("The Flash Player is not ready yet. Try again shortly");
      return;
    }
    
    var src = window.site_url + '/trackmanager/play/' + trackid + '/' + albumid + '/.mp3';
    //src = 'http://www.longtailvideo.com/jw/upload/bunny.mp3';
    
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
    alert(src)
    this.playerObj.add;
    this.playerObj.sendEvent('LOAD', src);
    this.playerObj.sendEvent('PLAY');
  };
  
  this.embedPlayer();

};

function playerReady(thePlayer) {
  player.playerObj = window.document[player.playerid]; 
  player.playerObj.addModelListener("STATE", "stateListener");
}


function stateListener(stateObj){
  currentState = stateObj.newstate; 
  previousState = stateObj.oldstate;

  //alert(currentState +" - "+ previousState);
}