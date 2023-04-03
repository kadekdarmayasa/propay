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
    $this->db->bind(':class_id', $class_id, PDO::PARAM_INT);
    $this->db->execute();

    return $this->db->single();
  }

  public function getClassByName($class_name)
  {
    $query = "SELECT * FROM " . $this->table . " WHERE class_name=:class_name";

    $this->db->query($query);
    $this->db->bind(':class_name', $class_name, PDO::PARAM_STR);
    $this->db->execute();

    return $this->db->single();
  }

  public function addClass($data)
  {
    $class_name = htmlspecialchars($data['class_name']);
    $major_name =  htmlspecialchars($data['major_name']);

    $query = "INSERT INTO " . $this->table . " VALUES (null, :class_name, :major_name)";

    $this->db->query($query);
    $this->db->bind(':class_name', $class_name, PDO::PARAM_STR);
    $this->db->bind(':major_name', $major_name, PDO::PARAM_STR);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function deleteClass($class_id)
  {
    $query = "DELETE FROM " . $this->table . " WHERE class_id=:class_id";

    $this->db->query($query);
    $this->db->bind(':class_id', $class_id, PDO::PARAM_INT);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function updateClass($data)
  {
    $class_id = htmlspecialchars($data['class_id']);
    $class_name = htmlspecialchars($data['class_name']);
    $major_name = htmlspecialchars($data['major_name']);

    $query = "UPDATE " . $this->table . " SET class_name = :class_name, major_name = :major_name WHERE class_id = :class_id";

    $this->db->query($query);
    $this->db->bind(':class_id', $class_id, PDO::PARAM_INT);
    $this->db->bind(':class_name', $class_name, PDO::PARAM_STR);
    $this->db->bind(':major_name', $major_name, PDO::PARAM_STR);
    $this->db->execute();

    return [
      'row_count' => $this->db->rowCount(),
      'class_id' => $class_id
    ];
  }

  public function getClassByAny($keyword)
  {
    $query = 'SELECT * FROM ' . $this->table . ' WHERE class_name LIKE :keyword OR major_name LIKE :keyword';

    $this->db->query($query);
    $this->db->bind(':keyword', "%$keyword%");
    $this->db->execute();

    return $this->db->resultSet();
  }

  public function getClassWithLimit($start_data, $total_data_per_page, $keyword = null)
  {
    if ($keyword != null) {
      $query = "SELECT * FROM " . $this->table . " WHERE class_name LIKE :keyword OR major_name LIKE :keyword LIMIT :start_data, :total_data_per_page";

      $this->db->query($query);
      $this->db->bind(':keyword', "%$keyword%");
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
}
