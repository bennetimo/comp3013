<?php

class AccountManager extends Controller {

	function AccountManager()
	{
		parent::Controller();
		$this->load->static_model('User');
	}
	
	public function addCredit($ammount){
		$userid = $this->session->userdata('userid');
		
		if($userid == null){
			redirect("/main");
			return;
		}
		
		$user = new User($userid);
		$user->addCredit($ammount);
		redirect('/main/topup');
	}
}