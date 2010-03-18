<?php

class Main extends Controller {

	function Main()
	{
		parent::Controller();
		$this->load->static_model("User");
		$this->load->static_model("Track");
		$this->load->static_model("Artist");
	}
	
	function musicBrowser($type = "all", $page=0, $display = 26, $genreid, $artistid, $albumid){
		$result = array("tracks" => NULL);
		$userid = $this->session->userdata('userid');
		
		$genreid = $genreid == "all" ? NULL : $genreid;
		$artistid = $artistid == "all" ? NULL : $artistid;
		$albumid = $albumid == "all" ? NULL : $albumid;
		
		
		if ( ! $userid) {
			echo json_encode(array("error" => "You have to be logged in to view your music collection"));
			return;
		}
		try{
			if($type == "genre"){
				$mb_artists = Track::getUserArtists($userid, $genreid);
				$mb_albums = Track::getUserAlbums($userid, $genreid, $artistid);
				$result['artists'] = $mb_artists;
				$result['albums'] = $mb_albums;
			}
			if($type == "artist"){
				$mb_albums = Track::getUserAlbums($userid, $genreid, $artistid);
				$result['albums'] = $mb_albums;
			}
			
			$returned = Track::getUserCollection($userid, $page*$display, $display, $genreid, $artistid, $albumid);
		}
		catch(Exception $e){
			echo json_encode(array("error" => $e->getMessage()));
			return;
		}
		foreach($returned['tracks'] as $track){
			$result['tracks'][] = $track->toArray();
		}
		
	    $num_rows = $returned['rows'];
		
		if($num_rows > $display){
			$num_pages = ceil($num_rows/$display);
		}else{
			$num_pages = 1;
		}
		$result['num_pages'] = $num_pages;
		$result['cur_page'] = $page;
		
		echo json_encode($result);
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
		
		if($this->input->post("music_browser")){
			$mb_genres = Track::getUserGenres($userid);
			$mb_artists = Track::getUserArtists($userid);
			$mb_albums = Track::getUserAlbums($userid);
		}else{
			$mb_genres = Track::getUserGenres($userid);
			$mb_artists = Track::getUserArtists($userid);
			$mb_albums = Track::getUserAlbums($userid);
		}
		
		$data = array(
			'userid' => $userid,
		  	'user' => $user,
			'playlists' => $playlists,
			'page_title' => "Welcome.",
			'dark' => TRUE,
			'mb_genres' => $mb_genres,
			'mb_artists' => $mb_artists,
			'mb_albums' => $mb_albums
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