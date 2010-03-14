<?php

class Activated extends Controller {

	function Activated()
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
			'page_title' => "Welcome."
		);
		
		$this->load->view("common/header.php", $data);
		$this->load->view("register/activation_confirmation_view.php");
		$this->load->view("common/footer.php");
	}
}