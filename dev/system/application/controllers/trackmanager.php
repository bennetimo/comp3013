<?php

class TrackManager extends Controller {

	function TrackManager()
	{
		parent::Controller();
		$this->load->static_model("Track");
	}

	function index()
	{
		echo "TrackManager Controller...";
	}

	function play($trackid, $albumid)
	{
		$userid = $this->session->userdata('userid');

		if($userid === FALSE) {
			set_status_header(400);
			return;
		}
		try{
			$track = Track::load($trackid, $albumid, $userid);
		}
		catch(Exception $e){
			echo $e->getMessage();
		}

		if($track == NULL){
			set_status_header(400);
			return;
		}

		$src = $track->getSrc();
		$bought = $track->getBoughtTime();
		//echo "SRC=$src, BOUGHT=$bought\n\n";

		if(empty($src)|| empty($bought)) {
			set_status_header(400);
			return;

		}
		if(preg_match('/^(http)(s)?/', $src)){
			header("Location: $src");
		}
		else {
			header("Content-Type: audio/mpeg");
			header('Content-length: ' . filesize($src));

			print file_get_contents($src);
		}
	}

	function search($page=0, $display = 26)
	{
		$searchBy = $_POST["search_by"];
		$term = $_POST["search_term"];
		$userid = $this->session->userdata('userid');
		$tracks = array();

		try{
			if ($searchBy == "name") {
				$returned = Track::searchTrackName($term, $userid, $page*$display, $display);
			}
			else if ($searchBy == "genre") {
				$returned = Track::searchByGenre($term, $userid, $page*$display, $display);
			}
			else if($searchBy == "artist"){
				$returned = Track::searchByArtist($term, $userid, $page*$display, $display);
			}
			else if ($searchBy == "playlist"){
				$this->load->static_model("Playlist");
				
				$returned = Playlist::searchByName($term, $userid, $page*$display, $display);
			}
			else {
				echo json_encode(array("error" => "The search criteria is not recognized"));
				return;
			}
		}
		catch(Exception $e) {
			echo json_encode(array("error" => $e->getMessage()));
			return;
		}
		
		$tracks = $returned['tracks'];
		$num_rows = $returned['rows'];
		
		if($num_rows > $display){
			$num_pages = ceil($num_rows/$display);
		}else{
			$num_pages = 1;
		}
		
		$newTracks = array();
		
		foreach ($tracks as $track) {

			$newTracks[] = $track->toArray();
		}

		$result = array("tracks" => $newTracks, "cur_page" => $page, "num_pages" => $num_pages);
		echo json_encode($result);
	}

	function getUserCollection($page=0, $display = 26)
	{
		$userid = $this->session->userdata('userid');
		$result_tracks = array();

		if(! $userid) {
			echo json_encode(array("error" => "User must be logged in to access her playlist."));
			return;
		}

		try{
			$returned = Track::getUserCollection($userid, $page*$display, $display);
		}
		catch(Exception $e) {
			echo json_encode(array("error" => "User must be logged in to access her playlist."));
			return;
		}

		$tracks = $returned['tracks'];
    	$num_rows = $returned['rows'];
    
	    if($num_rows > $display){
	      $num_pages = ceil($num_rows/$display);
	    }else{
	      $num_pages = 1;
	    }
	    
	    $newTracks = array();
	    
	    foreach ($tracks as $track) {
	
	      $newTracks[] = $track->toArray();
	    }
	
	    $result = array("tracks" => $newTracks, "cur_page" => $page, "num_pages" => $num_pages);
	    
	    echo json_encode($result); 
	}
}

/* End of file main.php */
/* Location: ./system/application/controllers/main.php */