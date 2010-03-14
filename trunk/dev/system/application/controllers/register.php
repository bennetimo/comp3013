<?php

class Register extends Controller {

	function Register()
	{
		parent::Controller();	
		$this->load->static_model("User");
	}
	
	function index()
	{
		$userid = $this->session->userdata('userid');
		$this->load->static_model('Playlist');
		$playlists = Playlist::getUsersPlaylists($userid);
		
		$data = array(
			'userid' => $userid,
		  	'user' => $userid ? new User($userid) : NULL,
			'playlists' => $playlists,
			'page_title' => "Register"
		);
		
		$this->load->view("common/header.php", $data);
		$this->load->view("register/register_view.php");
		$this->load->view("common/footer.php");
	}
}

/* End of file main.php */
/* Location: ./system/application/controllers/main.php */