<?php

class AccountManager extends Controller {

	function AccountManager()
	{
		parent::Controller();
		$this->load->static_model('User');
		$this->load->static_model('Track');
	}
	
	function index()
	{
		echo "account manager controller...";
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
	
	public function buyTrack($trackid, $albumid){
		$userid = $this->session->userdata('userid');
		$result = array("error" => FALSE);

		if (!$userid) {
			$result["error"] = "You must login!";
			echo json_encode($result);
		}
		
		$user = new User($userid);
		$track = Track::loadTrack($trackid);
		
		if($user->getCredit() < $track->getCost()){
			//The user can't afford the track!
			$result["error"] = "You have insufficient funds to buy the track as it costs &pound;".sprintf("%01.2f", ($track->getCost()/100)).", please top up your account";
			echo json_encode($result);
		}else{
			//Buy the rights to the track
			if($user->aquireRightsToTrack($trackid, $albumid)){
				//The track was bought successfully
				$result["bought"] = TRUE;
			}else{
				$result["error"] = "Sorry, there was a problem buying the track. Please try again later";
			}
			echo json_encode($result);
		}
	}
	
	//Returns 'yes' if the user owns the rights to the track, or 'no' otherwise
	public function ownsTrack($trackid, $albumid){
		$userid = $this->session->userdata('userid');
		$result = array("error" => FALSE);
		
		if (!$userid) {
			$result["error"] = "You must login!";
			echo json_encode($result);
		}
		
		$user = new User($userid);
		
		if($user->hasRightsToTrack($trackid, $albumid)){
			$result["yes"] = TRUE;
		}else{
			$result["no"] = TRUE;
		}
		echo json_encode($result);
	}
}