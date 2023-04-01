<?php
class Staff_Model
{
  private $table = "staff";
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getStaffByUsername($username)
  {
    $query = 'SELECT * FROM ' . $this->table . ' WHERE username = :username';

    $this->db->query($query);
    $this->db->bind(':username', $username, PDO::PARAM_STR);
    $this->db->execute();

    return $this->db->single();
  }

  public function getStaffById($staff_id)
  {
    $query = 'SELECT * FROM ' . $this->table . ' WHERE staff_id = :staff_id';

    $this->db->query($query);
    $this->db->bind(':staff_id', $staff_id, PDO::PARAM_INT);
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
    $password = password_hash($data['staff-password'], PASSWORD_BCRYPT);
    $staff_level = htmlspecialchars($data['staff-level']);
    $staff_name = htmlspecialchars($data['staff-name']);
    $date_of_birth = htmlspecialchars($data['date-of-birth']);
    $religion = htmlspecialchars($data['religion']);
    $address = htmlspecialchars($data['address']);

    $query = "INSERT INTO " . $this->table . " VALUES(null, :username, :password, :staff_level, :staff_name, :date_of_birth, :religion, :address)";

    $this->db->query($query);
    $this->db->bind(':username', $username, PDO::PARAM_STR);
    $this->db->bind(':password', $password, PDO::PARAM_STR);
    $this->db->bind(':staff_level', $staff_level, PDO::PARAM_STR);
    $this->db->bind(':staff_name', $staff_name, PDO::PARAM_STR);
    $this->db->bind(':date_of_birth', $date_of_birth, PDO::PARAM_STR);
    $this->db->bind(':religion', $religion, PDO::PARAM_STR);
    $this->db->bind(':address', $address, PDO::PARAM_STR);
    $this->db->execute();

    return [
      'row_count' => $this->db->rowCount(),
      'last_id' => $this->db->lastInsertedId()
    ];
  }

  public function deleteStaff($staff_id)
  {
    $query = "DELETE FROM " . $this->table . " WHERE staff_id=:staff_id";

    $this->db->query($query);
    $this->db->bind(':staff_id', $staff_id, PDO::PARAM_INT);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function updateProfile($data)
  {
    $staff_id = htmlspecialchars($data['staff_id']);
    $username = htmlspecialchars($data['username']);
    $staff_name = htmlspecialchars($data['staff-name']);
    $date_of_birth = htmlspecialchars($data['date-of-birth']);
    $religion = htmlspecialchars($data['religion']);
    $address = htmlspecialchars($data['address']);

    $query = "UPDATE " . $this->table . " SET username = :username, staff_name=:staff_name, date_of_birth=:date_of_birth, religion=:religion, address=:address WHERE
    staff_id=:staff_id";

    $this->db->query($query);
    $this->db->bind(':staff_id', $staff_id, PDO::PARAM_INT);
    $this->db->bind(':username', $username, PDO::PARAM_STR);
    $this->db->bind(':staff_name', $staff_name, PDO::PARAM_STR);
    $this->db->bind(':date_of_birth', $date_of_birth, PDO::PARAM_STR);
    $this->db->bind(':religion', $religion, PDO::PARAM_STR);
    $this->db->bind(':address', $address, PDO::PARAM_STR);
    $this->db->execute();

    return [
      'row_count' => $this->db->rowCount(),
      'last_id' => $staff_id
    ];
  }

  public function updateStaff($data)
  {
    $staff_id = htmlspecialchars($data['staff_id']);
    $username = htmlspecialchars($data['username']);
    $staff_level = htmlspecialchars($data['staff-level']);
    $staff_name = htmlspecialchars($data['staff-name']);
    $date_of_birth = htmlspecialchars($data['date-of-birth']);
    $religion = htmlspecialchars($data['religion']);
    $address = htmlspecialchars($data['address']);

    $query = "UPDATE " . $this->table . " SET username=:username staff_level=:staff_level, staff_name=:staff_name, date_of_birth=:date_of_birth, religion=:religion, address=:address WHERE
    staff_id=:staff_id";

    $this->db->query($query);
    $this->db->bind(':staff_id', $staff_id, PDO::PARAM_INT);
    $this->db->bind(':username', $username, PDO::PARAM_INT);
    $this->db->bind(':staff_level', $staff_level, PDO::PARAM_STR);
    $this->db->bind(':staff_name', $staff_name, PDO::PARAM_STR);
    $this->db->bind(':date_of_birth', $date_of_birth, PDO::PARAM_STR);
    $this->db->bind(':religion', $religion, PDO::PARAM_STR);
    $this->db->bind(':address', $address, PDO::PARAM_STR);
    $this->db->execute();

    return [
      'row_count' => $this->db->rowCount(),
      'last_id' => $staff_id
    ];
  }

  public function getStaffByAny($keyword)
  {
    $query = 'SELECT * FROM ' . $this->table . ' WHERE username LIKE :keyword OR staff_name LIKE :keyword OR staff_level LIKE :keyword';

    $this->db->query($query);
    $this->db->bind(':keyword', "%$keyword%");
    $this->db->execute();

    return $this->db->resultSet();
  }

  public function getStaffWithLimit($start_data, $total_data_per_page, $keyword = null)
  {
    if ($keyword != null) {
      $query = "SELECT * FROM " . $this->table . " WHERE username LIKE :keyword OR staff_name LIKE :keyword OR staff_level LIKE :keyword LIMIT :start_data, :total_data_per_page";

      $this->db->query($query);
      $this->db->bind(':keyword', "%$keyword%", PDO::PARAM_STR);
      $this->db->bind(':start_data', $start_data, PDO::PARAM_INT);
      $this->db->bind(':total_data_per_page', $total_data_per_page, PDO::PARAM_INT);
    } else {
      $query = "SELECT * FROM " . $this->table . " LIMIT :start_data, :total_data_per_page";

      $this->db->query($query);
      $this->db->bind(':start_data', $start_data, PDO::PARAM_INT);
      $this->db->bind(':total_data_per_page', $total_data_per_page, PDO::PARAM_INT);
    }

    $this->db->execute();
    return $this->db->resultSet();
  }

  public function updatePassword($staff_id, $password)
  {
    $password = password_hash($password, PASSWORD_BCRYPT);

    $query = "UPDATE " . $this->table . " SET password=:password WHERE staff_id=:staff_id";

    $this->db->query($query);
    $this->db->bind(':staff_id', $staff_id, PDO::PARAM_INT);
    $this->db->bind(':password', $password, PDO::PARAM_STR);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function getStaffByName($name)
  {
    $query = "SELECT * FROM " . $this->table . " WHERE staff_name=:staff_name";

    $this->db->query($query);
    $this->db->bind(':staff_name', $name, PDO::PARAM_STR);
    $this->db->execute();

    return $this->db->single();
  }
}
