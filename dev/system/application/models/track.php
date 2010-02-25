<?php
class Track extends Model
{

	private $trackid;
	private $duration;
	private $cost;
	private $src;
	private $name;
	// type Artist
	private $artist;
	// type array<Artist>
	private $feat_artists;
	// type Album
	private $album;
	// type Video
	private $videos;
	// type array<string>
	private $genres;



	public function Track($trackid = NULL, $name = NULL)
	{
		// Call the Model constructor
		parent::Model();

		$this->setId($trackid);
		$this->setName($name);
	}

	public function setId($trackid)
	{
		$this->trackid = $trackid;
	}

	public function getId()
	{
		return $this->trackid;
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

	public function getAlbum()
	{
		return $this->album;
	}

	public function getGenres()
	{
		if($this->trackid == NULL){
			throw new Exception("Missing track ID when requesting track's genres");
		}
		if($this->genres == NULL){
			$query = "SELECT g.`name`, g.`id` AS genre_id FROM `genre` g, `track_genre` tg
		  WHERE tg.`trackid` = ".$this->db->escape($this->trackid)." AND tg.`genreid` = g.`id`";

			$result = $this->db->query($query)->result();

			$this->genres = array();

			foreach ($result as $genre) {
				/*
				 * using an associative array
				 * ID -> NAME to display the genre name and
				 * have a link with the genre's id
				 */
				$this->genres[$genre->genre_id] = $genre->name;
			}
		}

		return $this->genres;
	}

	public function &getVideos()
	{
		if($this->trackid == NULL){
			throw new Exception("Missing track ID when requesting track's videos");
		}
		if($this->videos == NULL) {
			$this->load->static_model('Video');

			$this->videos = Video::getVideosByTrack($this->trackid);
		}
		
		return $this->videos;
	}

	static function &search($search_term)
	{
		$CI = &get_instance();
		$CI->load->static_model('Artist');
		$CI->load->static_model('Album');
	
		$query = "SELECT a.name AS `album_name`, a.id AS `album_id`, t.*, art.id AS `artist_id`, art.name AS `artist_name`
		FROM `album_track` at, `track` t, `artist` art,`album` a 
		WHERE t.main_artist_id = art.id AND t.name LIKE '".$CI->db->escape_str($search_term)."%' 
		AND t.id = at.`trackid` AND a.id = at.`albumid` 
		ORDER BY `album_name`";

		$result = $CI->db->query($query)->result();

		$tracks = array();

		foreach ($result as $row)
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