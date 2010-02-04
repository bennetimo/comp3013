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
}