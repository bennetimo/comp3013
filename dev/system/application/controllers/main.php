<?php

class Main extends Controller {

	function Main()
	{
		parent::Controller();
		$this->load->static_model("User");
	}
	
	function index()
	{
		$userid = $this->session->userdata('userid');
		$playlists = null;
		
		if ($userid) {
			$this->load->static_model('Playlist');
			$playlists = Playlist::getUsersPlaylists($userid);
		}
		
		$data = array(
			'userid' => $userid,
			'playlists' => $playlists
		);
		
		$this->load->view("common/header.php", $data);
		$this->load->view("main/main_view.php", $data);
		$this->load->view("common/footer.php");
	}
}

/* End of file main.php */
/* Location: ./system/application/controllers/main.php */