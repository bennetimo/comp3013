<?php
class Playlist extends Model
{
	private $id;
	private $name;
	private $shared;
	private $ownerid;
	// type User
	private $owner;
	// type Track
	private $tracks;

	public function __construct($id = NULL, $name = NULL, $shared = NULL, $ownerid = NULL)
	{
		self::Model();

		$this->id = $id;
		$this->name = $name;
		$this->shared = $shared;
		$this->ownerid = $ownerid;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		if($this->id == NULL){
			throw new Exception("Missing playlist ID when requesting playlist's name");
		}

		return $this->name;
	}

	public function isShared()
	{
		if($this->id == NULL){
			throw new Exception("Missing playlist ID when checking if playlist is shared");
		}

		return $this->shared;
	}

	public function &getOwner()
	{
		if($this->id == NULL){
			throw new Exception("Missing playlist ID when getting playlist's owner");
		}

		$this->load->static_model('User');

		if($this->owner == NULL) {
			$this->owner = new User($this->ownerid);
		}

		return $this->owner;
	}

	public function &getTracks($userid = NULL)
	{
		if($this->id == NULL){
			throw new Exception("Missing playlist ID when getting playlist's tracks");
		}

		if($this->tracks == NULL){

			$userid = $userid === NULL ? $this->session->userdata('userid') : $userid;
			$this->load->static_model('Track');

			$query = "SELECT a.name AS `album_name`, a.id AS `album_id`, t.*, art.id AS `artist_id`, art.name AS `artist_name`, ut.bought
    FROM `track` t, `artist` art,`album` a, `album_track` at, `playlist_track` pt
    LEFT JOIN `user_track` ut ON(ut.albumid = pt.albumid AND ut.trackid = ut.trackid AND ut.userid = ".$this->db->escape($userid).")
    WHERE pt.playlistid = ".$this->db->escape($this->id)." AND pt.albumid = a.id AND pt.trackid = t.id   
    AND t.main_artistid = art.id AND t.id = at.`trackid` AND a.id = at.`albumid` ORDER BY pt.`play_order`";

			$this->tracks = Track::getTrackList($query);
		}

		return $this->tracks;
	}

  public static function addTracks(array $trackids, array $albumids, array $play_orders, $playlistid, $userid)
  {
  	if(count($trackids) != count($play_orders) || count($trackids) != count($albumids)) {
  		throw new Exception("The number of tracks must match the number of track's albums and positions");
  	}
  	$this->db->trans_start();
  	
  	for($i = 0; $i < count($trackids); $i++) {
  		$playlistid = $this->db->escape($playlistid);
  		$albumid = $this->db->escape($albumids[$i]);
  		$trackid = $this->db->escape($trackids[$i]);
  		$play_order = $this->db->escape($play_orders[$i]);
  		
  		$this->db->query("INSERT INTO `playlist_track` (`playlistid`, `albumid`, `trackid`, `play_order`) VALUES ($playlistid, $albumid, $trackid, $play_order)");
  	}
  	
  	$this->db->trans_complete();
  	
  	return $this->db->trans_status();
  }
	/**
	 *
	 * @param Playlist's name string $pl_name
	 * @return array<Playlist>
	 */
	public static function &searchByName($pl_name, $userid = NULL)
	{
		$CI = &get_instance();
		$userid = $userid === NULL ? $CI->session->userdata('userid') : $userid;
		$result = array();

		$query = "SELECT p.*, pu.userid AS ownerid FROM `playlist` p, `playlist_user` pu WHERE p.name LIKE '%".$CI->db->escape_str($pl_name)."%'
		AND (p.shared OR pu.userid = ".$CI->db->escape($userid).") AND pu.playlistid = p.id GROUP BY p.id";

		foreach($CI->db->query($query)->result() as $p) {
			$result[] = new Playlist($p->id, $p->name, $p->shared, $p->ownerid);
		}

		return $result;
	}

}