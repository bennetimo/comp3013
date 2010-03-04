<?php 

class User extends Model
{
	private $id;
	private $email;
	private $fname;
	private $lname;
	private $joined;
	
	public function __construct($id)
	{
		parent::Model();
		$this->load($id);
	}
	
	private function load($id)
	{
		$queryString = "SELECT * FROM `user` WHERE `id` = ".$this->db->escape($id);
		$query = $this->db->query($queryString);
		
		if ($query->num_rows() != 1) {
			throw new Exception("User does not exist.");
		}
		
		$result = $query->first_row();		
		$this->id = $id;
		$this->email = $result->email;
		$this->fname = $result->fname;
		$this->lname = $result->lname;
		$this->joined = $result->joined;
	}
	
	public static function add($email, $password, $fname, $lname)
	{
		$CI = &get_instance();
		$queryString = "
			INSERT INTO `user` (`email`, `password`, `fname`, `lname`)
			VALUES (".$CI->db->escape($email).", ".$CI->db->escape($password).", ".$CI->db->escape($fname).", ".$CI->db->escape($lname).")
		";
		$query = $CI->db->query($queryString);
	}
	
	public static function emailExists($email)
	{
		$CI = &get_instance();
		$queryString = "SELECT * FROM `user` WHERE `email` = ".$CI->db->escape($email);
		$query = $CI->db->query($queryString);
		
		return $query->num_rows() > 0;
	}
	
	public static function loginIsValid($email, $password)
	{
		$CI = &get_instance();
		$queryString = "SELECT * FROM `user` WHERE `email` = ".$CI->db->escape($email)." AND `password` = ".$CI->db->escape($password);
		$query = $CI->db->query($queryString);
		
		return $query->num_rows() > 0;
	}
	
	public static function getIdByEmail($email)
	{
		$CI = &get_instance();
		$queryString = "SELECT `id` FROM `user` WHERE `email` = ".$CI->db->escape($email);
		$query = $CI->db->query($queryString);
		
		if ($query->num_rows() < 1) {
			throw new Exception("User with email $email does not exist.");
		}
		
		return $query->first_row()->id;
	}
	
	public function getEmail()
	{
		return $this->email;
	}
	
	public function getFName()
	{
		return $this->fname;
	}
	
	public function getLName()
	{
		return $this->lname;
	}
	
	public function getJoined()
	{
		return $this->joined;
	}
}