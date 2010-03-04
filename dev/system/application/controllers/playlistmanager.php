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
		$tracks = Playlist::load($playlistid)->getTracks();
		$newTracks = array();

		foreach ($tracks as $track) {
			$newTracks[] = $track->toArray();
		}

		echo json_encode($newTracks);
	}
}