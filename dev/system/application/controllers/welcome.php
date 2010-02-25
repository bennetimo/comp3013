<?php

class Welcome extends Controller {

	function __constructor()
	{
		parent::Controller();	
	}
	
	function tim()
	{
		
	}
	
	function index()
	{
		$this->load->static_model('Track');
		//$this->load->view('welcome_message');
		
		$search_res = Track::searchByGenre("opera");
		
		//$data = array('search_res' => $search_res);
		//$this->load->view('search', $data);
		$t = $search_res[0];
		print_r($t->getArtist()->getTracks());
		/*foreach( as $t){
			echo $t->getName().", artist: ".$t->getArtist()->getName().", album: ".$t->getAlbum()->getName().", genres: ";
			print_r($t->getGenres());
			echo ", videos: ";
			print_r($t->getVideos())."<br />";
		}*/
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */