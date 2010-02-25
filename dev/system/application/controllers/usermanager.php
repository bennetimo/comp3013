<?php

class UserManager extends Controller {

	function UserManager()
	{
		parent::Controller();	
	}
	
	function index()
	{
		echo "UserManager Controller...";
	}
	
	function register()
	{
		print_r($_POST);
	}
	
	function login()
	{
		print_r($_POST);
	}
}

/* End of file main.php */
/* Location: ./system/application/controllers/main.php */