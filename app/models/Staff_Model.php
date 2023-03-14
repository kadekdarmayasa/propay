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

  public function addStaff($data)
  {
    $username = htmlspecialchars($data['username']);
    $password = password_hash($data['password'], PASSWORD_BCRYPT);
    $staff_level = htmlspecialchars($data['staff-level']);
    $staff_name = htmlspecialchars($data['staff-name']);
    $date_of_birth = htmlspecialchars($data['date-of-birth']);
    $religion = htmlspecialchars($data['religion']);
    $address = htmlspecialchars($data['address']);

    $query = "INSERT INTO tb_staff VALUES(null, :username, :password, :staff_level, :staff_name, :date_of_birth, :religion, :address)";

    $this->db->query($query);
    $this->db->bind(':username', $username);
    $this->db->bind(':password', $password);
    $this->db->bind(':staff_level', $staff_level);
    $this->db->bind(':staff_name', $staff_name);
    $this->db->bind(':date_of_birth', $date_of_birth);
    $this->db->bind(':religion', $religion);
    $this->db->bind(':address', $address);

    $this->db->execute();
    return $this->db->rowCount();
  }
}
