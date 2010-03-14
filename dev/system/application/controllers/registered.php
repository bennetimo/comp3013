<?php

class Registered extends Controller {

	function Registered()
	{
		parent::Controller();
		$this->load->static_model("User");
	}
	
	function index()
	{
		$userid = $this->session->userdata('userid');
		$playlists = null;
		$user = null;
		
		if ($userid) {
			$this->load->static_model('Playlist');
			$playlists = Playlist::getUsersPlaylists($userid);
			$user = new User($userid);
		}
		
		$data = array(
			'userid' => $userid,
		  	'user' => $user,
			'playlists' => $playlists,
			'page_title' => "Congratulations!"
		);
		
		$this->load->view("common/header.php", $data);
		$this->load->view("register/register_confirmation_view.php");
		$this->load->view("common/footer.php");
	}
}