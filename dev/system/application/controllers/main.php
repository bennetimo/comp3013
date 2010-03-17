<?php

class Main extends Controller {

	function Main()
	{
		parent::Controller();
		$this->load->static_model("User");
		$this->load->static_model("Track");
		$this->load->static_model("Artist");
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
		
		$records = Track::getUserGenres($userid);
		
		$data = array(
			'userid' => $userid,
		  'user' => $user,
			'playlists' => $playlists,
			'page_title' => "Welcome.",
			'dark' => TRUE,
			'records' => $records
		);
		
		$this->load->view("common/header.php", $data);
		$this->load->view("main/main_view.php");
		$this->load->view("common/footer.php");
	}
	
	function account(){
		$userid = $this->session->userdata('userid');
		
		if($userid == null){
			echo json_encode(array("error" => "You have to be logged in to view your account!"));
			return;
		}
		
		$this->load->static_model('Playlist');
		$playlists = Playlist::getUsersPlaylists($userid);
		$user = new User($userid);
		$first_name = $user->getFName();
		$last_name = $user->getLName();
		$joined = $user->getJoined();
		$email = $user->getEmail();
		$credit = $user->getCredit();
		
		$data = array(
			'userid' => $userid,
			'user' => $user,
			'first_name' => $first_name,
			'last_name' => $last_name,
			'email' => $email,
			'joined' => $joined,
			'credit' => $credit,
			'page_title' => "My Account",
			'playlists' => $playlists
		);
		
		$this->load->view("common/header.php", $data);
		$this->load->view("account/account_view.php", $data);
		$this->load->view("common/footer.php");
	}
	
	function loggedIn(){
		$userid = $this->session->userdata('userid');
		
		if($userid == null){
			echo json_encode(array("error" => "You have to be logged in to view your account!"));
			return;
		}else{
			echo json_encode(array("yes" => ""));
			return;
		}
	}
	
	function topUp(){
		$userid = $this->session->userdata('userid');
		
		if($userid == null){
			redirect("/main");
		}
		
		$this->load->static_model('Playlist');
		$playlists = Playlist::getUsersPlaylists($userid);
		$user = new User($userid);
		$first_name = $user->getFName();
		$last_name = $user->getLName();
		$joined = $user->getJoined();
		$email = $user->getEmail();
		$credit = $user->getCredit();

		$data = array(
			'userid' => $userid,
			'user' => $user,
			'first_name' => $first_name,
			'last_name' => $last_name,
			'email' => $email,
			'joined' => $joined,
			'credit' => $credit,
			'page_title' => "Add Money",
			'playlists' => $playlists
		);
		
		$this->load->view("common/header.php", $data);
		$this->load->view("account/topup_view.php", $data);
		$this->load->view("common/footer.php");
	}
}

/* End of file main.php */
/* Location: ./system/application/controllers/main.php */