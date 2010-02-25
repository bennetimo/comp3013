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
		$this->session->set_userdata('userid', 1);
		redirect('/main');
	}
	
	function logout()
	{
		$this->session->sess_destroy();
		redirect('/main');
	}
}

/* End of file main.php */
/* Location: ./system/application/controllers/main.php */