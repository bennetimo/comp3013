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

		$track = Track::load($trackid, $albumid, $userid);

		if($track == NULL){
			set_status_header(400);
			return;
		}

		$src = $track->getSrc(); 

		header("Content-Type: audio/mpeg");
		header('Content-length: ' . filesize($src));

		echo file_get_contents($src);
	}

	function search()
	{
		$searchBy = $_POST["search_by"];
		$term = $_POST["search_term"];
		$userid = $this->session->userdata('userid');
		$tracks = array();

		try{
			if ($searchBy == "name") {
				$tracks = Track::searchTrackName($term, $userid);
			}
			else if ($searchBy == "genre") {
				$tracks = Track::searchByGenre($term, $userid);
			}
			else if($searchBy == "artist"){
				$tracks = Track::searchByArtist($term, $userid);
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
		$newTracks = array();

		foreach ($tracks as $track) {

			$newTracks[] = $track->toArray();
		}

		echo json_encode($newTracks);
	}
}

/* End of file main.php */
/* Location: ./system/application/controllers/main.php */