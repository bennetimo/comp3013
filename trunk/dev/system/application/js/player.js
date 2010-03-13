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
  
  this.playTrack = function(trackid, albumid){
    
    if(!this.playerObj){
      setError("The Flash Player is not ready yet. Try again shortly");
      return;
    }
    
    var src = window.site_url + '/trackmanager/get_src/' + trackid + '/' + albumid;
    src = 'http://www.longtailvideo.com/jw/upload/bunny.mp3';
    this.playerObj.sendEvent('LOAD', src);
    this.playerObj.sendEvent('PLAY');
  };
  
  this.embedPlayer();

};

function playerReady(thePlayer) { 
  alert("player ready");
  player.playerObj = window.document[player.playerid]; 
  player.playerObj.addModelListener("STATE", "stateListener");
}


function stateListener(stateObj){
  currentState = stateObj.newstate; 
  previousState = stateObj.oldstate;

  //alert(currentState +" - "+ previousState);
}