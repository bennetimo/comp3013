<?php

class Activation extends Controller {

	function Activation()
	{
		parent::Controller();
		$this->load->static_model("User");
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
		$this->load->view("main/main_view.php");
		$this->load->view("common/footer.php");
	}
	
	function activate($userID, $code){
		if (!User::markAsActivated($userID, $code)) {
			echo "Your account could not be activated";
			return;
		}else{
			redirect("/activated");
		}
		
	}
}