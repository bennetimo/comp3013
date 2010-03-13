<?php

class TrackManager extends Controller {

	function TrackManager()
	{
		parent::Controller();
	}
	
	function index()
	{
		echo "TrackManager Controller...";
	}
	
	function search()
	{
		$searchBy = $_POST["search_by"];
		$term = $_POST["search_term"];
		$userid = $this->session->userdata('userid');
		$tracks = array();
		
		$this->load->static_model("Track");
		
		if ($searchBy == "name") {
			$tracks = Track::searchTrackName($term, $userid);
		}
		else if ($searchBy == "genre") {
			$tracks = Track::searchByGenre($term, $userid);
		}
		else {
			echo json_encode(array("error" => TRUE));
		}
		
		$newTracks = array();
		
		foreach ($tracks as $track) {
			
			$newTracks[] = $track->toArray();
		}
		
		echo json_encode($newTracks);
	}
}

/* End of file main.php */
/* Location: ./system/application/controllers/main.php */