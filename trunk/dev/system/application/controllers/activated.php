<?php

class Activated extends Controller {

	function Activated()
	{
		parent::Controller();
	}
	
	function index()
	{
		$this->load->view("common/header.php");
		$this->load->view("register/activation_confirmation_view.php");
		$this->load->view("common/footer.php");
	}
}