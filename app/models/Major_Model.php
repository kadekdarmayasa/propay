<?php
class Major_Model
{
  private $table = "tb_major";
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getAllMajor()
  {
    $query = "SELECT * FROM " . $this->table;

    $this->db->query($query);
    $this->db->execute();

    return $this->db->resultSet();
  }

  public function getMajorById($major_id)
  {
    $query = "SELECT * FROM " . $this->table . " WHERE major_id=:major_id";

    $this->db->query($query);
    $this->db->bind('major_id', $major_id);
    $this->db->execute();

    return $this->db->single();
  }
}
