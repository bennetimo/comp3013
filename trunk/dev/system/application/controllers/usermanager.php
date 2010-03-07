<?php

class UserManager extends Controller {

	function UserManager()
	{
		parent::Controller();
		$this->load->static_model('User');
		$this->load->helper('email');
	}
	
	function index()
	{
		echo "UserManager Controller...";
	}
	
	function validate_register_form()
	{
		$fname = $_POST['reg_first_name'];
		$lname = $_POST['reg_last_name'];
		$email = $_POST['reg_email'];
		$password = $_POST['reg_password'];
		
		if (strlen($fname) < 2 || strlen($lname) < 2) {
			echo json_encode(array('error' => "Please enter your real name."));
			return;
		}
		
		if (!valid_email($email)) {
			echo json_encode(array('error' => "Please enter a real email."));
			return;
		}
		
		if (User::emailExists($email)) {
			echo json_encode(array('error' => "Email already exists!"));
			return;
		}
		
		if (strlen(trim($password)) < 6) {
			echo json_encode(array('error' => "Password must be at least 6 characters long."));
			return;
		}
		
		else {
			echo json_encode(array());
			return;
		}
	}
	
	function register()
	{
		$fname = $_POST['reg_first_name'];
		$lname = $_POST['reg_last_name'];
		$email = $_POST['reg_email'];
		$password = $_POST['reg_password'];
		
		if (strlen($fname) < 2 || strlen($lname) < 2 || !valid_email($email) || User::emailExists($email) || strlen(trim($password)) < 6) {
			throw new Exception("Error when registering new user.");
		}
		
		User::add($email, md5($password), $fname, $lname);
		redirect('/registered');
	}
	
	function validate_login_form()
	{		
		$email = $_POST['login_email'];
		$password = $_POST['login_password'];
		
		if (!User::loginIsValid($email, md5($password))) {
			echo json_encode(array('isValid' => false, 'error' => "Login invalid."));
		}
		else {
			echo json_encode(array('isValid' => true, 'error' => ""));
		}
		
		return;
	}
	
	function login()
	{
		$email = $_POST['login_email'];
		$password = $_POST['login_password'];
		$id = User::getIdByEmail($email);
			
		if (!User::loginIsValid($email, md5($password))) {
			throw new Exception("Error when loggin in user.");
		}
		
		if(!User::accountIsActivated($id)){
			echo "Your account has not yet been activated. Click 
			the link in the confirmation email which was sent to your email account when you registered";
			return;
		}
		
		$this->session->set_userdata('userid', $id);
		
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