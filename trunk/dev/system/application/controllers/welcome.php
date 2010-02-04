<?php

class Welcome extends Controller {

	function Welcome()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$this->load->model('Track');
		//$this->load->view('welcome_message');
		
		foreach(Track::search("track 1") as $t){
			echo $t->getName()."<br>";
		}
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */