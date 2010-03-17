<?php
class Video extends Model
{
	private $id;
	private $name;
	private $trackid;
	private $src;

	public function __construct($id = NULL, $name = NULL, $trackid = NULL, $src = NULL)
	{
		$this->id = $id;
		$this->name = $name;
		$this->trackid = $trackid;
		$this->src = $src;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getTrackId()
	{
		return $this->trackid;
	}
	
	public function getSrc()
	{
		return $this->src;
	}
  
	public function &toArray()
	{
		$array = array();
		
		$array['src']  = $this->getSrc();
		$array['name'] = $this->getName();
		$array['id']   = $this->getId();
		
		return $array;
	}
	
	public static function &getVideosByTrack($trackid)
	{
		$CI = &get_instance();
		 
		$query = "SELECT `id`, `name`, `trackid`, `src` FROM `video` WHERE `trackid` = ".$CI->db->escape($trackid);
		
		$result = $CI->db->query($query)->result();
		$videos = array();
		
		foreach($result as $video) {
		  $videos[] = new Video($video->id, $video->name, $video->trackid, $video->src);			
		}
		
		return $videos;
	}
}