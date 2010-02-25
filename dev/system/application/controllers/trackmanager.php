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
		print_r($_POST);
	}
}

/* End of file main.php */
/* Location: ./system/application/controllers/main.php */