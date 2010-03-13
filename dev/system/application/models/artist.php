<?php
class Artist extends Model
{
	private $artistid;
	private $name;
	private $role;

	public function __construct($id = NULL, $name = NULL, $role = NULL)
	{
		$this->artistid = $id;
		$this->name = $name;
		$this->role = $role;

		parent::Model();
	}

	public function getId()
	{
		return $this->artistid;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getRole()
	{
		return $this->role;
	}
	
	public function &toArray()
	{
		$array = array();
		
		$array['name'] = $this->getName();
		$array['id'] = $this->getId();
		$array['role'] = $this->getRole();
		
		return $array;
	}
	
	/**
	 * get the tracks where this
	 * artist is the main
	 * @return array of Track
	 */
	public function getTracks()
	{
		if($this->artistid == NULL){
			throw new Exception("Missing track ID when requesting artist' track");
		}

		//find the track id
		$query = "SELECT trackid FROM artist_track WHERE artistid = ".$this->db->escape($this->artistid);

		$tids = $this->db->query($query)->result();
		
		if(count($tids) > 0){
			$track_ids = "";
			foreach ($tids as $tid) {
				$track_ids .= $tid->trackid.",";
			}
			//remove the last comma
			$track_ids = substr($track_ids, 0, -1);

			$query = "SELECT a.`year`, a.name AS `album_name`, a.id AS `album_id`, t.*, art.id AS `artist_id`, art.name AS `artist_name`
    FROM `album_track` at, `track` t, `artist` art,`album` a, `track_genre` tg, `genre` g
     
    WHERE t.main_artistid = art.id AND t.id in ($track_ids) 
    AND t.id = at.`trackid` AND a.id = at.`albumid` AND g.id = tg.genreid AND t.id = tg.trackid 
    ORDER BY a.`year`";

			return Track::getTrackList($query);
		}
		
		return array();
	}
	
	public static function getNumberOfArtists(){
		$CI = &get_instance();
		$queryString = "SELECT COUNT(`id`) AS 'count' FROM `artist`";
		$query = $CI->db->query($queryString);
		
		return $query->first_row()->count;
	}
}