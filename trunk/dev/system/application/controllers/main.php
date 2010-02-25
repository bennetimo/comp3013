<?php

class Main extends Controller {

	function Main()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$this->load->view("common/header.php");
		$this->load->view("main/main.php");
		$this->load->view("common/footer.php");
	}
}

/* End of file main.php */
/* Location: ./system/application/controllers/main.php */