<?php
class Album extends Model
{
  private $id;
  private $name;

  public function __construct($id = NULL, $name = NULL)
  {
    $this->id = $id;
    $this->name = $name;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getName()
  {
    return $this->name;
  }
  
  public function &toArray()
  {
  	$array = array();
  	
  	$array['id'] = $this->getId();
  	$array['name'] = $this->getName();
  	
  	return $array;
  } 
}