<?php
class Track extends Model {

	private $track_id;
	private $duration;
	private $cost;
	private $src;
	private $name;
	private $artist_name;
	private $album_name;



	public function Track()
	{
		// Call the Model constructor
		parent::Model();


	}

	public function setId($track_id)
	{
		$this->track_id = $track_id;
	}

	public function getId($track_id)
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

	public function setArtistName($artist_name)
	{
		$this->artist_name = $artist_name;
	}

	public function getArtistName($artist_name)
	{
		return $this->artist_name;
	}

	public function setAlbumName($album_name)
	{
		$this->album_name = $album_name;
	}

	public function getAlbumName()
	{
		return $this->album_name;
	}

	function &search($search_term)
	{
		$query = $this->db->query("SELECT a.name AS `album_name`, t.*, art.name AS `artist_name` FROM `album_track` at, `track` t, `artist` art,`album` a WHERE t.main_artist_id = art.id AND t.name LIKE '".$this->db->escape_str($search_term)."%' AND t.id = at.`trackid` AND a.id = at.`albumid");

		$tracks = array();

		foreach ($query->result() as $row)
		{
			$track = new Track();

			$track->setId($row->id);
			$track->setName($row->name);
			$track->setAlbumName($row->album_name);
			$track->setArtistName($row->artist_name);

			$tracks[] = $track;

		}

		return $tracks;
	}
}