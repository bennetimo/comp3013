<?php
class Artist extends Model
{
	private $id;
	private $name;
	private $role;

	public function __construct($id = NULL, $name = NULL, $role = NULL)
	{
		$this->id = $id;
		$this->name = $name;
		$this->role = $role;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->name;
	}
	
	public function getRole()
	{
		return $this->role;
	}
}