<?php

class Registered extends Controller {

	function Registered()
	{
		parent::Controller();
	}
	
	function index()
	{
		$this->load->view("common/header.php");
		$this->load->view("register/register_confirmation_view.php");
		$this->load->view("common/footer.php");
	}
}