<?php

class Welcome extends Controller {

	function Welcome()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$this->load->static_model('Track');
		//$this->load->view('welcome_message');
		
		foreach(Track::search("track 1") as $t){
			echo $t->getName().", artist: ".$t->getArtist()->getName().", album: ".$t->getAlbum()->getName().", genres: ";
			print_r($t->getGenres()).", videos: ".print_r($t->getVideos())."<br />";
		}
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */