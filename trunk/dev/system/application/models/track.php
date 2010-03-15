<?php
class Track extends Model
{
	private $trackid;
	private $duration;
	private $cost;
	private $src;
	private $name;
	private $bought_time;
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



	public function __construct($trackid = NULL, $name = NULL, $duration = NULL, $cost = NULL, $src = NULL, $bought_time = NULL)
	{
		// Call the Model constructor
		parent::Model();

		$this->trackid = $trackid;
		$this->name = $name;
		$this->duration = $duration;
		$this->cost = $cost;
		$this->src = $src;
		$this->bought_time = $bought_time;

	}

	public function getBoughtTime()
	{
		if($this->trackid == NULL){
			throw new Exception("Missing track ID when requesting track's duration");
		}

		return $this->bought_time;
	}

	public function getId()
	{
		return $this->trackid;
	}

	public function getDuration()
	{
		if($this->trackid == NULL){
			throw new Exception("Missing track ID when requesting track's duration");
		}

		return $this->duration;
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
				$this->genres[] = array('id' =>$genre->genre_id, 'name' =>$genre->name);
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
	 * that feature in this track EXCEPT the main artist
	 */
	public function &getFeatArtists()
	{
		if($this->trackid == NULL){
			throw new Exception("Missing track ID when requesting track's videos");
		}

		if($this->feat_artists == NULL){
			$query = "SELECT a.id, a.name, at.role FROM `artist` a, `artist_track` at WHERE at.trackid =  ".$this->db->escape($this->trackid)."
		AND at.artistid = a.id AND at.artistid != ".$this->db->escape($this->artist->getId());

			$result = $this->db->query($query)->result();
			$this->feat_artists = array();

			foreach ($result as $artist) {
				$this->feat_artists[] = new Artist($artist->id, $artist->name, $artist->role);
			}
		}

		return $this->feat_artists;
	}

	public function &toArray()
	{
		$array = array();
		$array['name'] = $this->getName();
		$array['id'] = $this->getId();
		$array['cost'] = $this->getCost();
		$array['duration'] = $this->getDuration();
		$array['src'] = $this->getSrc();
		$array['bought_time'] = $this->getBoughtTime();
		// complex types
		$array['genres'] = $this->getGenres();
		$array['album'] = $this->getAlbum()->toArray();
		$array['main_artist'] = $this->getArtist()->toArray();

		$array['feat_artists'] = array();
		foreach($this->getFeatArtists() as $art) {
			$array['feat_artists'][] = $art->toArray();
		}

		return $array;
	}
	/**
	 *
	 * @param string $genre
	 * @return array of Track
	 */
	static function &searchByGenre($genre, $userid = NULL)
	{
		$CI = &get_instance();

		$query = "SELECT a.name AS `album_name`, a.id AS `album_id`, t.id, t.name, t.duration, t.cost, art.id AS `artist_id`, art.name AS `artist_name`, ut.bought
    FROM `track` t, `artist` art,`album` a, `track_genre` tg, `genre` g,`album_track` at 
    LEFT JOIN `user_track` ut ON(ut.trackid = at.trackid AND ut.userid = ".$CI->db->escape($userid).") 
    WHERE t.main_artistid = art.id AND g.name LIKE '".$CI->db->escape_str($genre)."%' 
    AND t.id = at.`trackid` AND a.id = at.`albumid` AND g.id = tg.genreid AND t.id = tg.trackid 
    ORDER BY g.`name`, art.name, a.name";

		return self::getTrackList($query);
	}

	/**
	 * NOTE: it only search in the main artist
	 * @param string $artist
	 * @return array of Track
	 */
	static function &searchByArtist($artist, $userid = NULL)
	{
		$CI = &get_instance();

		$query = "SELECT a.`name` AS `album_name`, a.id AS `album_id`, t.id, t.name, t.duration, t.cost, art.id AS `artist_id`, art.name AS `artist_name`, ut.bought
    FROM `track` t, `artist` art,`album` a, `album_track` at 
    LEFT JOIN `user_track` ut ON(ut.trackid = at.trackid AND ut.userid = ".$CI->db->escape($userid).") 
    WHERE t.main_artistid = art.id AND art.name LIKE '".$CI->db->escape_str($artist)."%' 
    AND t.id = at.`trackid` AND a.id = at.`albumid`
    ORDER BY art.`name`, a.`name`";

		return self::getTrackList($query);
	}

	/**
	 *
	 * @param string $track_name
	 * @return array of Tracks
	 */
	static function &searchTrackName($track_name, $userid = NULL)
	{
		$CI = &get_instance();
			
		$query = "SELECT a.name AS `album_name`, a.id AS `album_id`, t.id, t.name, t.duration, t.cost, art.id AS `artist_id`, art.name AS `artist_name`, ut.bought
		FROM `track` t, `artist` art,`album` a, `album_track` at
		LEFT JOIN `user_track` ut ON(ut.trackid = at.trackid AND ut.userid = ".$CI->db->escape($userid).")
		WHERE t.main_artistid = art.id AND t.name LIKE '".$CI->db->escape_str($track_name)."%' 
		AND t.id = at.`trackid` AND a.id = at.`albumid` 
		ORDER BY t.`name`, a.name";

		return self::getTrackList($query);
	}

	public static function &getUserCollection($userid)
	{
		$CI = &get_instance();

		$query = "SELECT a.name AS `album_name`, a.id AS `album_id`, t.id, t.name, t.duration, t.cost, art.id AS `artist_id`, art.name AS `artist_name`,  1 AS bought
    FROM `track` t, `artist` art,`album` a, `album_track` at 
    WHERE t.id IN (SELECT ut.`trackid` FROM `user_track` ut WHERE ut.`userid` = ".$CI->db->escape($userid).") AND
    t.main_artistid = art.id
    AND t.id = at.`trackid` AND a.id = at.`albumid` 
    ORDER BY t.`name`, art.name, a.name";

		return self::getTrackList($query);
	}

	static function &getTrackList($query, $includeAll = TRUE)
	{
		$CI = &get_instance();
		$CI->load->static_model('Artist');
		$CI->load->static_model('Album');

		$result = $CI->db->query($query)->result();

		$tracks = array();

		foreach ($result as $row)	{
			$track = new Track($row->id, $row->name, $row->duration, $row->cost, isset($row->src) ? $row->src : NULL, $row->bought);

			if($includeAll){
				$artist = new Artist($row->artist_id, $row->artist_name);
				$album = new Album($row->album_id, $row->album_name);

				$track->setArtist($artist);
				$track->setAlbum($album);
			}
			$tracks[] = $track;

		}

		return $tracks;
	}

	public static function load($trackid, $albumid, $userid){

		$CI =& get_instance();
		$trackid = $CI->db->escape($trackid);
		$albumid = $CI->db->escape($albumid);
		$userid = $CI->db->escape($userid);

		$query = "SELECT t.*, ut.bought
    FROM `track` t, `album` a, `album_track` at
    LEFT JOIN `user_track` ut ON(ut.albumid = at.albumid AND ut.trackid = at.trackid AND ut.userid = $userid)
    WHERE t.id = $trackid AND a.id = $albumid
    AND t.id = at.`trackid` AND a.id = at.`albumid`";
		 
		$track = self::getTrackList($query, FALSE);

		return count($track) > 0 ? $track[0] : NULL;

	}

	public static function &loadTrack($trackid){
		$CI =& get_instance();
		$queryString = "SELECT `name`, `cost`, `src`, `main_artistid`, `duration` FROM `track` WHERE `id` = ".$CI->db->escape($trackid);
		$query = $CI->db->query($queryString);

		if ($query->num_rows() < 1) {
			throw new Exception("Could not load track object with id: $trackid");
		}else{
			$name = $query->first_row()->name;
			$cost = $query->first_row()->cost;
			$src = $query->first_row()->src;
			$main_artistid = $query->first_row()->main_artistid;
			$duration = $query->first_row()->duration;
				
			$track = new Track($trackid, $name, $duration, $cost, $src);
			return $track;
		}
	}

	public static function getNumberOfTracks(){
		$CI = &get_instance();
		$queryString = "SELECT COUNT(`id`) AS 'count' FROM `track`";
		$query = $CI->db->query($queryString);

		return $query->first_row()->count;
	}
}