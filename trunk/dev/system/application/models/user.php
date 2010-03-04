<?php 

class User extends Model
{
	private $id;
	private $email;
	private $fname;
	private $lname;
	private $joined;
	
	public function __construct($id) {
		parent::Model();
		$this->load($id);
	}
	
	private function load($id) {
		
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
	
	public static function emailExists($email) {
		
		$CI = &get_instance();
		$queryString = "SELECT * FROM `user` WHERE `email` = ".$CI->db->escape($email);
		$query = $CI->db->query($queryString);
		
		return $query->num_rows() > 0;
	}
	
	public static function loginIsValid($email, $password) {

		$CI = &get_instance();
		$password = md5($password);
		$queryString = "SELECT * FROM `user` WHERE `email` = ".$CI->db->escape($email)." AND `password` = ".$CI->db->escape($password);
		$query = $CI->db->query($queryString);
		
		return $query->num_rows() > 0;
	}
	
	public function getEmail() {
		return $this->email;
	}
	
	public function getFName() {
		return $this->fname;
	}
	
	public function getLName() {
		return $this->lname;
	}
	
	public function getJoined() {
		return $this->joined;
	}
}