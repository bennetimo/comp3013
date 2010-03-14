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

	function get_user_playlists()
	{
		$userid = $this->session->userdata('userid');

		if (!$userid) {
			throw new Exception("User must be logged in to access her playlist.");
		}

		$playlists = Playlist::getUsersPlaylists($userid);
		$newPlaylists = array();

		foreach ($playlists as $playlist) {
			$newPlaylists[] = $playlist->toArray(FALSE);
		}

		echo json_encode($newPlaylists);
	}

	function get_tracks($playlistid)
	{
		try{
			$tracks = Playlist::load($playlistid)->getTracks();
		}
		catch(Exception $e) {
			echo json_encode(array("error" => $e->getMessage()));
			return;
		}
			
		$newTracks = array();

		foreach ($tracks as $track) {
			$newTracks[] = $track->toArray();
		}

		echo json_encode($newTracks);
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
}