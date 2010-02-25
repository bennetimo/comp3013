<?php

class Register extends Controller {

	function Register()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$this->load->view("common/header.php");
		$this->load->view("register/register_view.php");
		$this->load->view("common/footer.php");
	}
}

/* End of file main.php */
/* Location: ./system/application/controllers/main.php */