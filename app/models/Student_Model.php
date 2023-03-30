<?php
class Student_Model
{
  private $table = "student";
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getStudentBySIN($sin)
  {
    $query = 'SELECT * FROM ' . $this->table . ' WHERE sin = :sin';

    $this->db->query($query);
    $this->db->bind(':sin', $sin, PDO::PARAM_INT);
    $this->db->execute();

    return $this->db->single();
  }

  public function getStudentByNSN($nsn)
  {
    $query = 'SELECT * FROM ' . $this->table . ' WHERE nsn = :nsn';

    $this->db->query($query);
    $this->db->bind(':nsn', $nsn, PDO::PARAM_STR);
    $this->db->execute();

    return $this->db->single();
  }


  public function getAllStudents()
  {
    $query = 'SELECT * FROM ' . $this->table;

    $this->db->query($query);
    $this->db->execute();

    return $this->db->resultSet();
  }

  public function getStudentsByClassId($class_id)
  {
    $query = "SELECT * FROM " . $this->table . " WHERE class_id = :class_id";

    $this->db->query($query);
    $this->db->bind(':class_id', $class_id, PDO::PARAM_INT);
    $this->db->execute();

    return $this->db->resultSet();
  }

  public function addStudent($data)
  {
    $sin = htmlspecialchars($data['sin']);
    $nsn = htmlspecialchars($data['nsn']);
    $password = password_hash($data['student-password'], PASSWORD_BCRYPT);
    $student_name = htmlspecialchars($data['student-name']);
    $enrollment_date = htmlspecialchars($data['enrollment_date']);
    $term = htmlspecialchars($data['term']);
    $date_of_birth = htmlspecialchars($data['date-of-birth']);
    $religion = htmlspecialchars($data['religion']);
    $address = htmlspecialchars($data['address']);
    $class_id = htmlspecialchars($data['class_id']);

    $query = "INSERT INTO " . $this->table . " VALUES(:sin, :nsn, :password, :student_name, :enrollment_date, :term, :date_of_birth, :religion, :address, :class_id)";

    $this->db->query($query);
    $this->db->bind(':sin', $sin, PDO::PARAM_INT);
    $this->db->bind(':nsn', $nsn, PDO::PARAM_STR);
    $this->db->bind(':password', $password, PDO::PARAM_STR);
    $this->db->bind(':student_name', $student_name, PDO::PARAM_STR);
    $this->db->bind(':enrollment_date', $enrollment_date, PDO::PARAM_STR);
    $this->db->bind(':term', $term, PDO::PARAM_STR);
    $this->db->bind(':date_of_birth', $date_of_birth, PDO::PARAM_STR);
    $this->db->bind(':religion', $religion, PDO::PARAM_STR);
    $this->db->bind(':address', $address, PDO::PARAM_STR);
    $this->db->bind(':class_id', $class_id, PDO::PARAM_INT);
    $this->db->execute();

    return [
      'row_count' => $this->db->rowCount(),
      'sin' => $sin,
    ];
  }

  public function updateStudent($data)
  {
    $sin = htmlspecialchars($data['sin']);
    $student_name = htmlspecialchars($data['student-name']);
    $date_of_birth = htmlspecialchars($data['date-of-birth']);
    $religion = htmlspecialchars($data['religion']);
    $address = htmlspecialchars($data['address']);
    $class_id = htmlspecialchars($data['class_id']);

    $query = 'UPDATE ' . $this->table . ' SET student_name = :student_name, date_of_birth = :date_of_birth, religion = :religion, address = :address, class_id = :class_id WHERE sin = :sin';

    $this->db->query($query);
    $this->db->bind(':sin', $sin, PDO::PARAM_INT);
    $this->db->bind(':student_name', $student_name, PDO::PARAM_STR);
    $this->db->bind(':date_of_birth', $date_of_birth, PDO::PARAM_STR);
    $this->db->bind(':religion', $religion, PDO::PARAM_STR);
    $this->db->bind(':address', $address, PDO::PARAM_STR);
    $this->db->bind(':class_id', $class_id, PDO::PARAM_INT);
    $this->db->execute();

    return [
      'row_count' => $this->db->rowCount(),
      'sin' => $sin,
    ];
  }

  public function deleteStudent($sin)
  {
    $query = "DELETE FROM " . $this->table . " WHERE sin = :sin";

    $this->db->query($query);
    $this->db->bind(':sin', $sin, PDO::PARAM_INT);
    $this->db->execute();

    return [
      'row_count' => $this->db->rowCount(),
      'sin' => $sin,
    ];
  }

  public function getStudentByTerm($term)
  {
    $query = "SELECT * FROM " . $this->table . " WHERE term = :term";

    $this->db->query($query);
    $this->db->bind(':term', $term, PDO::PARAM_STR);
    $this->db->execute();

    return $this->db->resultSet();
  }

  public function getStudentByAny($keyword)
  {
    $query = 'SELECT * FROM ' . $this->table . ' WHERE sin LIKE :keyword OR student_name LIKE :keyword OR term LIKE :keyword OR enrollment_date LIKE :keyword OR class_id LIKE :keyword';

    $this->db->query($query);
    $this->db->bind(':keyword', "%$keyword%");
    $this->db->execute();

    return $this->db->resultSet();
  }

  public function getStudentWithLimit($start_data, $total_data_per_page, $keyword = null)
  {
    if ($keyword != null) {
      $query = "SELECT * FROM " . $this->table . " WHERE sin LIKE :keyword OR student_name LIKE :keyword OR term LIKE :keyword OR enrollment_date LIKE :keyword OR class_id LIKE :keyword LIMIT :start_data, :total_data_per_page";

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

  public function updatePassword($sin, $password)
  {
    $password = password_hash($password, PASSWORD_BCRYPT);

    $query = "UPDATE " . $this->table . " SET password = :password WHERE sin = :sin";

    $this->db->query($query);
    $this->db->bind(':sin', $sin, PDO::PARAM_INT);
    $this->db->bind(':password', $password, PDO::PARAM_STR);
    $this->db->execute();

    return [
      'row_count' => $this->db->rowCount(),
      'sin' => $sin,
    ];
  }
}
