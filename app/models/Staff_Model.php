<?php
class Staff_Model
{
  private $table = "tb_staff";
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getStaffByUsername($username)
  {
    $query = 'SELECT * FROM ' . $this->table . ' WHERE username = :username';

    $this->db->query($query);
    $this->db->bind(':username', $username);
    $this->db->execute();

    return $this->db->single();
  }

  public function getAllStaff()
  {
    $query = 'SELECT * FROM ' . $this->table;

    $this->db->query($query);
    $this->db->execute();

    return $this->db->resultSet();
  }
}
