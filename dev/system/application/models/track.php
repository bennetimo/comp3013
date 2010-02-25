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



	public function Track($trackid = NULL, $name = NULL, $duration = NULL, $cost = NULL, $src = NULL)
	{
		// Call the Model constructor
		parent::Model();

		$this->setId($trackid);
		$this->setName($name);
	}

	public function getId()
	{
		return $this->trackid;
	}

	public function getName()
	{
	if($this->trackid == NULL){
      throw new Exception("Missing track ID when requesting track's name");
    }
    
    return $this->name;
	}

	public function setArtist(&$artist)
	{
		$this->artist = $artist;
	}

	public function &getArtist()
	{
		if($this->trackid == NULL){
			throw new Exception("Missing track ID when requesting track's artist");
		}
		return $this->artist;
	}

	public function setAlbum(&$album)
	{
		$this->album = $album;
	}

	public function getAlbum()
	{
		if($this->trackid == NULL){
			throw new Exception("Missing track ID when requesting track's album");
		}

		return $this->album;
	}

	public function getCost()
	{
		if($this->trackid == NULL){
			throw new Exception("Missing track ID when requesting track's cost");
		}

		return $this->cost;
	}

	public function getSrc()
	{
		if($this->trackid == NULL){
			throw new Exception("Missing track ID when requesting track's src");
		}

		return $this->src;
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
	/**
	 * Returns all the Artist(s)
	 * that feature in this track
	 */
	public function &getFeatArtists()
	{
		if($this->trackid == NULL){
			throw new Exception("Missing track ID when requesting track's videos");
		}

		if($this->feat_artists == NULL){
			$query = "SELECT a.id, a.name, at.role FROM `artist` a, `artist_track` at WHERE at.trackid =  ".$this->db->escape($this->trackid)."
		AND at.artistid = a.id";

			$result = $this->db->query($query)->result();
			$this->feat_artists = array();

			foreach ($result as $artist) {
				$this->feat_artists[] = new Artist($artist->id, $artist->name, $artist->role);
			}
		}

		return $this->feat_artists;
	}
	/**
	 *
	 * @param string $genre
	 * @return array of Track
	 */
	static function &searchByGenre($genre)
	{
		$CI = &get_instance();

		$query = "SELECT a.name AS `album_name`, a.id AS `album_id`, t.*, art.id AS `artist_id`, art.name AS `artist_name`
    FROM `album_track` at, `track` t, `artist` art,`album` a, `track_genre` tg, `genre` g 
    WHERE t.main_artistid = art.id AND g.name LIKE '".$CI->db->escape_str($genre)."%' 
    AND t.id = at.`trackid` AND a.id = at.`albumid` AND g.id = tg.genreid AND t.id = tg.trackid 
    ORDER BY t.`name`";

		return self::search($query);
	}
	/**
	 *
	 * @param string $track_name
	 * @return array of Track
	 */
	static function &searchTrackName($track_name)
	{
		$CI = &get_instance();
			
		$query = "SELECT a.name AS `album_name`, a.id AS `album_id`, t.*, art.id AS `artist_id`, art.name AS `artist_name`
		FROM `album_track` at, `track` t, `artist` art,`album` a 
		WHERE t.main_artistid = art.id AND t.name LIKE '".$CI->db->escape_str($track_name)."%' 
		AND t.id = at.`trackid` AND a.id = at.`albumid` 
		ORDER BY t.`name`";

		return self::search($query);
	}

	static function &search($query)
	{
		$CI = &get_instance();
		$CI->load->static_model('Artist');
		$CI->load->static_model('Album');

		$result = $CI->db->query($query)->result();

		$tracks = array();

		foreach ($result as $row)
		{
			$track = new Track($row->id, $row->name, $row->duration, $row->cost, $row->src);
			$artist = new Artist($row->artist_id, $row->artist_name);
			$album = new Album($row->album_id, $row->album_name);

			$track->setArtist($artist);
			$track->setAlbum($album);

			$tracks[] = $track;

		}

		return $tracks;
	}
}