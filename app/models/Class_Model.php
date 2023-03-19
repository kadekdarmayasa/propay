<?php
class Class_Model
{
  private $table = "class";
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

  public function getClassById($class_id)
  {
    $query = "SELECT * FROM " . $this->table . " WHERE class_id=:class_id";

    $this->db->query($query);
    $this->db->bind('class_id', $class_id);
    $this->db->execute();

    return $this->db->single();
  }

  public function getClassByName($class_name)
  {
    $query = "SELECT * FROM " . $this->table . " WHERE class_name=:class_name";

    $this->db->query($query);
    $this->db->bind('class_name', $class_name);
    $this->db->execute();

    return $this->db->single();
  }

  public function addClass($class_name, $major_name)
  {
    $query = "INSERT INTO " . $this->table . " VALUES (null, :class_name, :major_name)";

    $this->db->query($query);
    $this->db->bind('class_name', $class_name);
    $this->db->bind('major_name', $major_name);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function deleteClass($class_id)
  {
    $query = "DELETE FROM " . $this->table . " WHERE class_id=:class_id";

    $this->db->query($query);
    $this->db->bind('class_id', $class_id);
    $this->db->execute();

    return $this->db->rowCount();
  }
}
