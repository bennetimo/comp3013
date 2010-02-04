<?php
class Track extends Model
{

	private $track_id;
	private $duration;
	private $cost;
	private $src;
	private $name;
	// type Artist
	private $artist;
	// type Album
	private $album;



	public function Track($track_id = NULL, $name = NULL)
	{
		// Call the Model constructor
		parent::Model();
		
		$this->setId($track_id);
		$this->setName($name);
	}

	public function setId($track_id)
	{
		$this->track_id = $track_id;
	}

	public function getId()
  {
    return $this->track_id;
  }
	
	public function setName($name)
	{
		$this->name = $name;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setArtist(&$artist)
	{
		$this->artist = $artist;
	}

	public function &getArtist()
	{
		return $this->artist;
	}

	public function setAlbum(&$album)
	{
		$this->album = $album;
	}

	public function getAlbumName()
	{
		return $this->album_name;
	}

	static function &search($search_term)
	{		
		$CI = &get_instance(); 
		$CI->load->static_model('Artist');
		$CI->load->static_model('Album');
		
		$query = $CI->db->query("SELECT a.name AS `album_name`, a.id AS `album_id`, t.*, art.id AS `artist_id`, art.name AS `artist_name` FROM `album_track` at, `track` t, `artist` art,`album` a WHERE t.main_artist_id = art.id AND t.name LIKE '".$CI->db->escape_str($search_term)."%' AND t.id = at.`trackid` AND a.id = at.`albumid");

		$tracks = array();

		foreach ($query->result() as $row)
		{
			$track = new Track($row->id, $row->name);
      $artist = new Artist($row->artist_id, $row->artist_name);
      $album = new Album($row->album_id, $row->album_name);
      
      $track->setArtist($artist);
			$track->setAlbum($album);
			
			$tracks[] = $track;

		}

		return $tracks;
	}
}