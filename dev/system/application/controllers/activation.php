<?php

class Activation extends Controller {

	function Activation()
	{
		parent::Controller();
		$this->load->static_model("User");
	}
	
	function index()
	{
		$this->load->view("common/header.php");
		$this->load->view("main/main_view.php");
		$this->load->view("common/footer.php");
	}
	
	function activate($userID, $code){
		if (!User::markAsActivated($userID, $code)) {
			echo "Your account could not be activated";
			return;
		}else{
			redirect("/activated");
		}
		
	}
}