<?php

class Main extends Controller {

	function Main()
	{
		parent::Controller();
		$this->load->static_model("User");
	}
	
	function index()
	{
		$data = array(
			'userid' => $this->session->userdata('userid'),
		);
		
		$this->load->view("common/header.php");
		$this->load->view("main/main_view.php", $data);
		$this->load->view("common/footer.php");
	}
}

/* End of file main.php */
/* Location: ./system/application/controllers/main.php */