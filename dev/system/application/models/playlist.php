<?php
class Playlist extends Model
{
	private $id;
	private $name;
	private $shared;
	private $ownerid;
	// is this playlist in the user playlists collection
	private $in_user_playlists = FALSE;
	// type User
	private $owner;
	// type Track
	private $tracks;

	public function __construct($id = NULL, $name = NULL, $shared = NULL, $ownerid = NULL, $in_user_playlists = FALSE)
	{
		parent::Model();

		$this->id = $id;
		$this->name = $name;
		$this->shared = $shared;
		$this->ownerid = $ownerid;
		$this->in_user_playlists = $in_user_playlists;
	}

	public function getId()
	{
		return $this->id;
	}

	public function isInUserPlaylists()
	{
		return$this->in_user_playlists;
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

	public function getOwnerId()
	{
		if($this->id == NULL){
			throw new Exception("Missing playlist ID when getting playlist's owner");
		}

		return $this->ownerid;
	}

	public function &getTracks($userid)
	{
		if($this->id == NULL){
			throw new Exception("Missing playlist ID when getting playlist's tracks");
		}

		if($this->tracks == NULL){
			$this->load->static_model('Track');

			$query = "SELECT a.name AS `album_name`, a.id AS `album_id`, t.*, art.id AS `artist_id`, art.name AS `artist_name`, ut.bought
    FROM `track` t, `artist` art,`album` a, `album_track` at, `playlist_track` pt
    LEFT JOIN `user_track` ut ON(ut.trackid = pt.trackid AND ut.userid = ".$this->db->escape($userid).")
    WHERE pt.playlistid = ".$this->db->escape($this->id)." AND pt.albumid = a.id AND pt.trackid = t.id   
    AND t.main_artistid = art.id AND t.id = at.`trackid` AND a.id = at.`albumid` ORDER BY pt.`play_order`";

			$this->tracks = Track::getTrackList($query);
		}

		return $this->tracks;
	}

	public static function load($playlistid)
	{
		$CI =& get_instance();
		$playlistid = $CI->db->escape($playlistid);

		$query = "SELECT pl.* FROM playlist pl WHERE pl.id = $playlistid LIMIT 1";
		$result = $CI->db->query($query)->result();

		return count($result) ? new Playlist($result[0]->id, $result[0]->name, $result[0]->shared, $result[0]->ownerid) : NULL;
	}
	/**
	 * This method let you re-arrange the order of tracks in the given playlist
	 *
	 * @param array $trackids
	 * @param array $albumids
	 * @param array $play_orders
	 * @param string/int $playlistid
	 * @param string/int $userid
	 */
	public static function updateTracks($trackId, $albumId, $nextTrackId, $nextAlbumId, $playlistId)
	{
		$CI =& get_instance();
		$CI->db->trans_start();

		//$CI->db->trans_start();

		$result = $CI->db->query("SELECT `play_order` AS old_position FROM `playlist_track` WHERE `playlistid` = ? AND `trackid` = ? AND `albumid` = ?", array($playlistId, $trackId, $albumId))->result();
		$old_position = $result[0]->old_position;

		if ($nextTrackId == NULL || $nextAlbumId == NULL) {
			$result = $CI->db->query("SELECT MAX(`play_order`) AS new_position FROM `playlist_track` WHERE `playlistid` = ?", array($playlistId))->result();
		}
		else {
			$result = $CI->db->query("SELECT (`play_order` - 1) AS new_position FROM `playlist_track` WHERE `playlistid` = ? AND `trackid` = ? AND `albumid` = ?", array($playlistId, $nextTrackId, $nextAlbumId))->result();
		}

		$new_position = $result[0]->new_position == 0 ? 1 : $result[0]->new_position;

		if ($old_position > $new_position) {
			$CI->db->query("UPDATE `playlist_track` SET `play_order` = play_order + 1 WHERE `playlistid` = ? AND `play_order` >=  ? AND `play_order` < ?", array($playlistId, $new_position, $old_position));
		}
		else {
			$CI->db->query("UPDATE `playlist_track` SET `play_order` = play_order - 1 WHERE `playlistid` = ? AND `play_order` <= ? AND `play_order` > ?", array($playlistId, $new_position, $old_position));
		}

		$CI->db->query("UPDATE `playlist_track` SET `play_order` = ? WHERE `playlistid` = ? AND `albumid` = ? AND `trackid` = ?", array($new_position, $playlistId, $albumId, $trackId));

		return TRUE;//$CI->db->trans_status();
	}

	public static function addTracks(array $trackids, array $albumids, array $play_orders, $playlistid)
	{
		if(count($trackids) != count($albumids)) {
			throw new Exception("The number of tracks must match the number of track's albums");
		}
		$CI =& get_instance();

		$CI->db->trans_start();
			
		for($i = 0; $i < count($trackids); $i++) {
			$playlistid = $CI->db->escape($playlistid);
			$albumid = $CI->db->escape($albumids[$i]);
			$trackid = $CI->db->escape($trackids[$i]);

			if(empty($play_orders)){
				//add it to the end
				$result = $CI->db->query("SELECT (MAX(`play_order`) + 1) AS `play_order` FROM `playlist_track` WHERE `playlistid` = $playlistid")->result();
				$play_order = $result[0]->play_order ? $result[0]->play_order : 1;
			}
			else{
				$play_order = isset($play_orders[$i]) ? $play_orders[$i] : 1;
			}
			$CI->db->query("INSERT IGNORE INTO `playlist_track` (`playlistid`, `albumid`, `trackid`, `play_order`) VALUES ($playlistid, $albumid, $trackid, $play_order)");
		}
			
		$CI->db->trans_complete();
			
		return $CI->db->trans_status();
	}

	public static function removeTracks(array $trackids, array $albumids, $playlistid)
	{
		if(count($trackids) != count($albumids)) {
			throw new Exception("The number of tracks must match the number of track's albums");
		}
		$CI =& get_instance();
		$CI->db->trans_start();
			
		for($i = 0; $i < count($trackids); $i++) {
			$CI->db->query("DELETE FROM `playlist_track` WHERE `playlistid` = ?  AND `albumid` = ? AND `trackid` = ?", array($playlistid, $albumids[$i], $trackids[$i]));
		}
			
		$CI->db->trans_complete();
			
		return $CI->db->trans_status();
	}

	public static function addPlaylist($name, $ownerid, $is_shared)
	{
		$CI =& get_instance();
		//$CI->db->trans_start();

		// add playlist
		$CI->db->query("INSERT INTO `playlist` (`name`, `ownerid`, `shared`) VALUES (?, ?, ?)", array($name, $ownerid, $is_shared));
		$playlistid = $CI->db->insert_id();
		// add user -> playlist relation
		//$CI->db->query("INSERT INTO `playlist_user` (`playlistid`, `userid`) VALUES (?, ?)", array($playlistid, $userid));
		//$CI->db->trans_complete();
			
		return new Playlist($playlistid, $name, $is_shared, $userid);
			
	}

	public static function removePlaylist($playlistid, $userid)
	{
		$CI =& get_instance();
		//$CI->db->trans_start();

		$result = $CI->db->query("SELECT `ownerid` FROM `playlist` WHERE `id` = ?", array($playlistid))->result();

		if( ! count($result)) {
			throw new Exception("Playlist $playlistid not found");
		}

		$CI->db->query("DELETE FROM `playlist` WHERE `id` = ? AND `ownerid`", array($playlistid, $userid));
		$CI->db->query("DELETE FROM `playlist_user` WHERE `playlistid` = ?", array($playlistid));

		if($userid == $result[0]->ownerid) {
			$CI->db->query("DELETE FROM `playlist_track` WHERE `playlistid` = ?", array($playlistid));
		}

		return TRUE; //$CI->db->trans_status();
	}

	public function remove()
	{
		return self::removePlaylist($this->id, $this->userid);
	}

	public function toArray($withTracks = TRUE)
	{
		$array = array();
		$array['id'] = $this->getId();
		$array['name'] = $this->getName();
		$array['user_name'] = $this->getOwner()->getFName();
		$array['user_id'] = $this->getOwner()->getId();
		$array['in_user_playlists'] = $this->isInUserPlaylists();

		if ($withTracks) {
			// TODO.
		}

		return $array;
	}

	/**
	 *
	 * @param Playlist's name string $pl_name
	 * @return array<Playlist>
	 */
	public static function &searchByName($pl_name, $userid)
	{
		$CI = &get_instance();
		$result = array();

		$query = "SELECT p.*, pu.userid AS `userid`, u.id AS in_user_playlists FROM `playlist` p, `playlist_user` pu LEFT JOIN `user` u ON (pu.userid = u.id)
		WHERE p.name LIKE '%".$CI->db->escape_str($pl_name)."%'	AND (p.shared OR pu.userid = ".$CI->db->escape($userid).") AND pu.playlistid = p.id GROUP BY p.id";

		foreach($CI->db->query($query)->result() as $p) {
			$result[] = new Playlist($p->id, $p->name, $p->shared, $p->userid, $p->in_user_playlists != NULL);
		}

		return $result;
	}

	public static function &getUsersPlaylists($userid)
	{
		$CI = &get_instance();
		$result = array();

		$userid = $CI->db->escape($userid);

		$query = "SELECT p.*, pu.userid AS userid FROM `playlist` p , `playlist_user` pu  WHERE
     (p.ownerid = $userid OR pu.userid = $userid)  GROUP BY p.id";

		foreach($CI->db->query($query)->result() as $p) {
			$result[] = new Playlist($p->id, $p->name, $p->shared, $p->ownerid);
		}

		return $result;
	}
}