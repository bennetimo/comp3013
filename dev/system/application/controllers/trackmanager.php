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

		try{
			if ($searchBy == "name") {
				$tracks = Track::searchTrackName($term, $userid);
			}
			else if ($searchBy == "genre") {
				$tracks = Track::searchByGenre($term, $userid);
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