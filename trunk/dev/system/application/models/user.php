<?php 

class User extends Model
{
	private $id;
	private $email;
	private $fname;
	private $lname;
	private $joined;
	private $credit;
	
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
		
		//Get the users available credit
		$queryString = "SELECT credit from `user_account` WHERE `userid` = ".$this->db->escape($id);
		$query = $this->db->query($queryString);
		$result = $query->first_row();	
		
		if ($query->num_rows() != 1) {
			$this->credit = 0;
		}else{
			$this->credit = $result->credit;
		}
	}
	
	public static function add($email, $password, $fname, $lname)
	{
		$CI = &get_instance();
		$queryString = "
			INSERT INTO `user` (`email`, `password`, `fname`, `lname`)
			VALUES (".$CI->db->escape($email).", ".$CI->db->escape($password).", ".$CI->db->escape($fname).", ".$CI->db->escape($lname).")
		";
		$query = $CI->db->query($queryString);
		
		//Create a unique activiation code
		$a = md5(uniqid(rand(), true));
		//Get the user id created for the last insert
		$userID = $CI->db->insert_id();
		$queryString = "INSERT INTO `user_verification` (userid, code) VALUES (".$CI->db->escape($userID).", ".$CI->db->escape($a).")";
		$query = $CI->db->query($queryString);		
		
		//Prepare an email to send to the newly registered user
		$body = "Thank you for registering with Musique! You are moments away from accessing a huge collection of quality streaming music.";
		$body .= "To activate your account just click on the link below:\n\n";
		$body .= site_url('activation');
		$body .= "/activate/$userID/$a";
		$body .= "\n\nThanks, \nThe Musique Team";
		
		$config = Array(
					  'protocol' => 'smtp',
					  'smtp_host' => 'ssl://smtp.googlemail.com',
					  'smtp_port' => '465',
					  'smtp_user' => 'musique.service@googlemail.com',
					  'smtp_pass' => 'musiquestore'
					);
		$CI->load->library('email', $config);
		$CI->email->set_newline("\r\n");
		$CI->email->from("register@musique.com", "Musique");
		$CI->email->to($email);
		$CI->email->subject("Registration Confirmation");
		$CI->email->message($body);
		$CI->email->send();
		
		if (!$CI->email->send()){
		  show_error($CI->email->print_debugger());
		}
	}
	
	public function addCredit($ammount){
		$queryString = "UPDATE `user_account` SET `credit` = `credit` + ".$this->db->escape($ammount) ." 
		WHERE `userid` = ".$this->db->escape($this->id);
		
		$query = $this->db->query($queryString);
		
		if ($this->db->affected_rows() == 0) {
			//The user does not have an entry yet in the accounts table, create one
			$queryString = "INSERT INTO `user_account` (`userid`, `credit`) VALUES 
			(".$this->db->escape($this->id) .", ".$this->db->escape($ammount).")";
		
			$query = $this->db->query($queryString);
			
			if ($this->db->affected_rows() == 0) {
				throw new Exception("Could not add money to account with user id $this->id");
			}
		}
	
		$this->credit = $this->credit + $ammount;
	}
	
	public static function markAsActivated($userID, $code){
		$CI = &get_instance();
		$queryString = "UPDATE `user_verification` SET `code` = NULL WHERE `userid` = ".$CI->db->escape($userID) ." AND `code` = ".$CI->db->escape($code);
		$query = $CI->db->query($queryString);
		
		return $CI->db->affected_rows() == 1;
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
	
	public static function accountIsActivated($userID){
		$CI = &get_instance();
		$queryString = "SELECT * from `user_verification` WHERE `userid` = ".$CI->db->escape($userID)." AND `code` is NULL";
		$query = $CI->db->query($queryString);
		
		return $query->num_rows() == 1;
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
	
	public static function getNumberOfUsers(){
		$CI = &get_instance();
		$queryString = "SELECT COUNT(`id`) AS 'count' FROM `user`";
		$query = $CI->db->query($queryString);
		
		return $query->first_row()->count;
	}
	
	public function getNumberOfPurchasedTracks(){
		$CI = &get_instance();
		$queryString = "SELECT COUNT(`trackid`) AS 'count' FROM `user_track` WHERE `userid` = ".$CI->db->escape($this->id);
		$query = $CI->db->query($queryString);
		
		return $query->first_row()->count;
	}
	
	public function getNumberOfPlaylists(){
		$CI = &get_instance();
		$queryString = "SELECT COUNT(`playlistid`) AS 'count' FROM `playlist_user` WHERE `userid` = ".$CI->db->escape($this->id);
		$query = $CI->db->query($queryString);
		
		return $query->first_row()->count;
	}
	
	public function getNumberOfSharedPlaylists(){
		$CI = &get_instance();
		$queryString = "SELECT count(`shared`) AS 'count' FROM `playlist` WHERE `id` IN(SELECT `playlistid` FROM `playlist_user` WHERE `userid` = ".$CI->db->escape($this->id) .")";
		$query = $CI->db->query($queryString);
		
		return $query->first_row()->count;
	}
	
	public function updateEmail($email){
		$CI = &get_instance();
		$queryString = "UPDATE `user` SET  `email` = ".$CI->db->escape($email) ." WHERE `id` = ".$CI->db->escape($this->id) .")";
		$query = $CI->db->query($queryString);
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
	
	public function getCredit()
	{
		return $this->credit;
	}
}