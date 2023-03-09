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
}
