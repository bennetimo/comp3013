<?php

class Account extends Controller {

	function Account()
	{
		parent::Controller();
	}
	
	function index()
	{
		$this->load->view("common/header.php");
		$this->load->view("account/account_view.php");
		$this->load->view("common/footer.php");
	}
}