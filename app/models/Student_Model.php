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
    $sql = 'SELECT * FROM ' . $this->table . ' WHERE sin = :sin';

    $this->db->query($sql);
    $this->db->bind(':sin', $sin);
    $this->db->execute();

    return $this->db->single();
  }


  public function getAllStudents()
  {
    $sql = 'SELECT * FROM ' . $this->table;

    $this->db->query($sql);
    $this->db->execute();

    return $this->db->resultSet();
  }

  public function getStudentsByClassId($class_id)
  {
    $query = "SELECT * FROM " . $this->table . " WHERE class_id=:class_id";

    $this->db->query($query);
    $this->db->bind('class_id', $class_id);
    $this->db->execute();

    return $this->db->resultSet();
  }

  public function addStudent($data)
  {
    $nama_siswa = htmlspecialchars($data['nama']);
    $nis = htmlspecialchars($data['nis']);
    $password = password_hash($data['password'], PASSWORD_BCRYPT);
    $nisn = htmlspecialchars($data['nisn']);
    $angkatan = htmlspecialchars($data['angkatan']);
    $tgl_masuk = htmlspecialchars($data['tgl-masuk']);
    $tgl_lahir = htmlspecialchars($data['tgl-lahir']);
    $agama = htmlspecialchars($data['agama']);
    $id_kelas = htmlspecialchars($data['id_kelas']);
    $alamat = htmlspecialchars($data['alamat']);

    $query = "INSERT INTO " . $this->table . " VALUES(null, :nis, :password, :angkatan, :tgl_masuk, :nisn, :nama_siswa, :tgl_lahir, :agama, :id_kelas, :alamat)";

    $this->db->query($query);
    $this->db->bind(":nis", $nis);
    $this->db->bind(":password", $password);
    $this->db->bind(":angkatan", $angkatan);
    $this->db->bind(":tgl_masuk", $tgl_masuk);
    $this->db->bind(":nisn", $nisn);
    $this->db->bind(":nama_siswa", $nama_siswa);
    $this->db->bind(":tgl_lahir", $tgl_lahir);
    $this->db->bind(":agama", $agama);
    $this->db->bind(":id_kelas", $id_kelas);
    $this->db->bind(":alamat", $alamat);

    $this->db->execute();
    return [
      'row_count' => $this->db->rowCount(),
      'last_insert_id' => $this->db->lastInsertedId(),
    ];
  }
}
