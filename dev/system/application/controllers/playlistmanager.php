<?php

class PlaylistManager extends Controller {

	function __construct()
	{
		parent::Controller();
		$this->load->static_model('Playlist');
	}

	function index()
	{
		echo "playlist controller...";
	}

	function import($playlistid)
	{
		$userid = $this->session->userdata('userid');
		$result = array("error" => FALSE);

		try{
			if (!$userid) {
				throw new Exception("User must be logged in to access her playlist.");
			}

			$playlist = Playlist::load($playlistid);

			if($playlist == NULL) {
				throw new Exception("Sorry, playlist not found");
			}

			$playlist->shareTo($userid);
			
			$result['imported_pl'] = $playlist->toArray();
			$result['is_owner'] = $userid == $playlist->getOwnerId();

		}
		catch(Exception $e) {
			$result['error'] = $e->getMEssage();
		}
    
		echo json_encode($result);

	}

	function get_user_playlists()
	{
		$userid = $this->session->userdata('userid');

		if (!$userid) {
			throw new Exception("User must be logged in to access her playlist.");
		}

		$playlists = Playlist::getUsersPlaylists($userid);
		$newPlaylists = array();

		foreach ($playlists as $playlist) {
			$pl = $playlist->toArray(FALSE);
			$pl['read_only'] = $userid != $playlist->getOwnerId();
			$newPlaylists[] = $pl;
		}

		echo json_encode($newPlaylists);
	}

	function get_tracks($playlistid)
	{
		try{
			$userid = $this->session->userdata('userid');
			$pl = Playlist::load($playlistid);
			$read_only = $pl->getOwnerId() != $userid;
			
			$tracks = $pl->getTracks($userid);
		}
		catch(Exception $e) {
			echo json_encode(array("error" => $e->getMessage()));
			return;
		}
			
		$newTracks = array();

		foreach ($tracks as $track) {
			$newTracks[] = $track->toArray();
		}

		echo json_encode(array("tracks" => $newTracks, "read_only" => $read_only));
	}

	function update_tracks()
	{
		$trackid = $this->input->post('trackid');
		$albumid = $this->input->post('albumid');
		$next_trackid = $this->input->post('next_trackid');
		$next_albumid = $this->input->post('next_albumid');
		$playlistid = $this->input->post('playlistid');

		$result = array("error" => FALSE);

		if ($next_trackid == "" || $next_albumid == "") {
			$next_trackid = NULL;
			$next_albumid = NULL;
		}
		try{
			if (!Playlist::updateTracks($trackid, $albumid, $next_trackid, $next_albumid, $playlistid)) {
				$result['error'] = TRUE;
			}
		}
		catch(Exception $e) {
			$result['error'] = $e->getMessage();
		}

		echo json_encode($result);
	}

	function remove_track()
	{
		$userid = $this->session->userdata('userid');
		$result = array("error" => FALSE);

		if (!$userid) {
			$result["error"] = "User must be logged in to access her playlist.";
		}
		else {
			$trackid = array($this->input->post('trackid'));
			$albumid = array($this->input->post('albumid'));
			$playlistid = $this->input->post('playlistid');

			try{
				$pl = Playlist::load($playlistid);
				if($pl->getOwnerId() != $userid){
					throw new Exception("Sorry, you are not allowed to remove tracks from a playlist you did not create");
				}
				if( ! Playlist::removeTracks($trackid, $albumid, $playlistid)) {
					$result["error"] = TRUE;
				}
			}
			catch(Exception $e) {
				$result["error"] = $e->getMessage();
			}
		}

		echo json_encode($result);
	}

	function add_playlist()
	{
		$userid = $this->session->userdata('userid');
		$result = array("error" => FALSE, "playlistid" => NULL);

		if (!$userid) {
			$result["error"] = "User must be logged in to access her playlist.";
		}
		else {
			$playlist_name = $this->input->post('playlist_name');
			$shared = $this->input->post('shared');

			try{
				$new_pl = Playlist::addPlaylist($playlist_name, $userid, $shared == 1 ? TRUE : FALSE);
				if( ! $new_pl) {
					$result["error"] = TRUE;
				}
				else{
					$result["playlistid"] = $new_pl->getId();
				}
			}
			catch(Exception $e) {
				$result["error"] = $e->getMessage();
			}
		}

		echo json_encode($result);
	}

	//	function search($term)
	//	{
	//		$userid = $this->session->userdata('userid');
	//    $result = array("error" => FALSE, "playlists" => array());
	//
	//    try{
	//    	$pls = Playlist::searchByName($term, NULL, TRUE);
	//    }
	//    catch(Exception $e){
	//    	$result["error"] = $e->getMessage();
	//    	echo json_encode($result);
	//    	return;
	//    }
	//
	//    foreach($pls as $pl) {
	//    	$result["playlists"][] = $pl->toArray();
	//    }
	//
	//    echo json_encode($result);
	//	}

	function remove_playlist($playlistid)
	{
		$userid = $this->session->userdata('userid');
		$result = array("error" => FALSE);

		if (!$userid) {
			$result["error"] = "User must be logged in to access her playlist.";
		}
		else {
			try{
				if( ! Playlist::removePlaylist($playlistid, $userid)) {
					$result["error"] = TRUE;
				}
			}
			catch(Exception $e) {
				$result["error"] = $e->getMessage();
			}
		}

		echo json_encode($result);
	}

	function add_track()
	{
		$userid = $this->session->userdata('userid');
		$result = array("error" => FALSE);

		if (!$userid) {
			$result["error"] = "User must be logged in to access her playlist.";
		}
		else {
			$trackid = array($this->input->post('trackid'));
			$albumid = array($this->input->post('albumid'));
			$playlistid = $this->input->post('playlistid');

			try{
				if( ! Playlist::addTracks($trackid, $albumid, array(), $playlistid)) {
					$result["error"] = TRUE;
				}
			}
			catch(Exception $e) {
				$result["error"] = $e->getMessage();
			}
		}

		echo json_encode($result);
	}

	function getXMLPlaylist($playlistid)
	{
		$userid = $this->session->userdata('userid');
		//header("Content-Type: application/xspf+xml");
		try{
			if($userid !== FALSE && $pl = Playlist::load($playlistid)){


				$xml ='<?xml version="1.0" encoding="UTF-8"?><playlist version="1" xmlns="http://xspf.org/ns/0/">';
				$xml.='<trackList>';

				foreach($pl->getTracks($userid) as $track) {
					$xml .= "<track><title>{$track->getName()}</title>
                  <location>".site_url("trackmanager/play/".$track->getId()."/".$track->getAlbum()->getId()."/.mp3")."</location>
                  <identifier>{$track->getId()}</identifier>
                  </track>";
				}

				$xml .= '</trackList></playlist>';

				echo $xml;

			}
			else{
				set_status_header(400);
			}
		}
		catch(Exception $e){
			set_status_header(500);
		}
	}
}