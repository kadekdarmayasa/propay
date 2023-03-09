<?php
class Class_Model
{
  private $table = "tb_class";
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getAllClasses()
  {
    $query = "SELECT * FROM " . $this->table;

    $this->db->query($query);
    $this->db->execute();

    return $this->db->resultSet();
  }

  public function getClassByName($class_name)
  {
    $query = "SELECT * FROM " . $this->table . " WHERE class_name=:class_name";

    $this->db->query($query);
    $this->db->bind('class_name', $class_name);
    $this->db->execute();

    return $this->db->single();
  }

  public function addClass($class_name, $major_id)
  {
    $query = "INSERT INTO " . $this->table . " VALUES (null, :class_name, :major_id)";

    $this->db->query($query);
    $this->db->bind('class_name', $class_name);
    $this->db->bind('major_id', $major_id);
    $this->db->execute();

    return $this->db->rowCount();
  }
}
